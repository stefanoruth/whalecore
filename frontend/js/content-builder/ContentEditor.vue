<template>
    <div class="columns" v-if="template.length > 0">
        <div class="column is-3">
            <div class="box">
                <div class="field">
                    <label class="label">Title</label>
                    <div class="field is-grouped">
                        <div class="control is-expanded">
                            <input class="input" type="text" v-model="model.title">
                        </div>
                        <div class="control">
                            <button class="button is-success" @click="saveContent">Publish</button>
                        </div>
                    </div>
                </div>
            </div>  

            <div class="tabs is-boxed">
                <ul>
                    <li :class="{'is-active': menu == 'base'}" @click="menu = 'base'"><a>Base</a></li>
                    <li :class="{'is-active': menu == 'raw'}" @click="menu = 'raw'"><a>Raw</a></li>
                </ul>
            </div>
            <div class="columns">
                <pre class="column" v-show="menu == 'base'">{{ baseContent | pretty }}</pre>
                <pre class="column" v-show="menu == 'raw'">{{ content | pretty }}</pre>
            </div>
        </div>
        <div class="column">
            <div class="tabs is-boxed">
                <ul>
                    <li v-for="(lang, i) in langs" :key="i" :class="{'is-active':currentLang == lang}" @click="currentLang = lang"><a class="is-uppercase">{{ lang }}</a></li>
                </ul>
            </div>
            <div class="box">
                <content-field v-for="(field, key) in template" :key="key" :field="field" :content="content[key]" :baseContent="baseContent[key]" :indentifier="key" style="margin-bottom:50px;"></content-field>
            </div>
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
                baseContent: [],
                langs: [],
                currentLang: null,
                menu: 'base',
            }
        },

        mounted() {
            // Fetches all information about the current page.
            axios.get(route('items.show', this.$route.params.id)).then(response => {
                this.model = response.data.data;

                if (typeof this.model.project.meta.languages !== 'undefined') {
                    this.langs = this.model.project.meta.languages;
                }

                if (response.data.data.template.structure !== null) {
                    this.template = response.data.data.template.structure;
                }
                
                this.baseContent = this.buildBase(this.template);
                let copyContent = JSON.parse(JSON.stringify(this.baseContent));
                
                if (response.data.data.content.length == 0) {
                    this.content = copyContent;
                    return;
                }
                
                this.content = this.fillContent(copyContent, response.data.data.content[0].body);
            });
        },

        methods: {
            /**
             * Takes a template and converts is to an usable datastructure
             */
            buildBase(template, parent) {
                // If is top level item
                if (typeof parent === 'undefined') {
                    var data = [];
                    for (var i = 0; i < template.length; i++) {
                        var newField = {};

                        // If repeater or section
                        if (template[i].fields.length > 0) {
                            newField[template[i].id] = this.buildBase(template[i].fields, template[i]);
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
                            data[template[i].id] = this.buildBase(template[i].fields, template[i]);
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

            /**
             * Takes to data sets and uses the original as a base for filling with the new set of data.
             */
            fillContent(original, newset) {
                for (const key in original) {
                    const element = original[key];
                    const newElm = newset[key];

                    if (Array.isArray(element)) {
                        if (newElm.length > 0) {
                            for (const arrKey in newElm) {
                                const arrElm = newElm[arrKey];
                                element[arrKey] = this.fillContent(JSON.parse(JSON.stringify(element[0])), arrElm);
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

            /**
             * Saves the current content
             */
            saveContent(event) {
                axios.post(route('items.update', this.$route.params.id), {_method:'PUT',content: this.content});
            },
        },
    }
</script>