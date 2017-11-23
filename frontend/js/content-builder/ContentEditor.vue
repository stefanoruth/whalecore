<template>
    <div class="columns" v-if="template.length > 0">
        <pre class="column is-2">{{ cleanContent | pretty }}</pre>
        <pre class="column is-4">{{ content | pretty }}</pre>
        <pre class="column is-2">{{ body | pretty }}</pre>
        <div class="column">
            <button class="button" @click="saveContent">Save</button>
            <content-field v-for="(field, key) in template" :key="key" :field="field" :content="content[key]" :cleanContent="cleanContent[key]" :indentifier="key" style="margin-bottom:50px;"></content-field>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                model: null,
                template: [],
                content: [],
                cleanContent: [],
                body: [],
            }
        },

        mounted() {
            axios.get(route('pages.show', this.$route.params.id)).then(response => {
                this.model = response.data.data;
                this.template = response.data.data.template.structure;
                this.cleanContent = this.buildContent(this.template);
                let copyContent = JSON.parse(JSON.stringify(this.cleanContent));
                
                if (response.data.data.content.length == 0) {
                    this.content = copyContent;
                    return;
                }
                
                this.body = response.data.data.content[0].body;
                this.content = this.fillContent(copyContent, response.data.data.content[0].body);
            });
        },

        methods: {
            buildContent(template, parent) {
                // If is top level item
                if (typeof parent === 'undefined') {
                    var data = [];
                    for (var i = 0; i < template.length; i++) {
                        var newField = {};

                        // If repeater or section
                        if (template[i].fields.length > 0) {
                            newField[template[i].id] = this.buildContent(template[i].fields, template[i]);
                        } else {
                            newField[template[i].id] = null;
                        }

                        data.push(newField);
                    }
                } else {
                    var data = {};
                    for (var i = 0; i < template.length; i++) {

                        // If repeater or section
                        if (template[i].fields.length > 0) {
                            data[template[i].id] = this.buildContent(template[i].fields, template[i]);
                        } else {
                            data[template[i].id] = null;
                        }
                    }
                }

                if (typeof parent !== 'undefined' && parent.type == 'repeater') {
                    data = [data];
                }

                return data;
            },

            fillContent(original, newset) {
                // console.log(typeof original, original, newset);
            
                for (const key in original) {
                    const element = original[key];
                    const newElm = newset[key]; //newset.hasOwnProperty(key) ? newset[key] : element;
                    // console.log("NEW", newElm);
                    // console.log(typeof element, element, original, key);
                    if (Array.isArray(element)) {
                        // console.log("arr", key, element);
                        let baseElm = element[0];
                        if (newElm.length > 0) {
                            for (const arrKey in newElm) {
                                const arrElm = newElm[arrKey];
                                // console.log(element, arrElm);
                                element[arrKey] = this.fillContent(baseElm, arrElm);
                            }
                        }
                    } else if (typeof element === 'object' && element !== null) {
                        original[key] = this.fillContent(element, newElm);
                    } else {
                        original[key] = newElm;
                    }
                }
                
                return original;
            },

            saveContent(event) {
                axios.post(route('pages.update', this.$route.params.id), {_method:'PUT',content: this.content});
            },
        },
    }
</script>