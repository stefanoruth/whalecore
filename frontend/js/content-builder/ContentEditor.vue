<template>
    <div class="columns" v-if="template.length > 0">
        <!-- <pre class="column">{{ template | pretty }}</pre> -->
        <pre class="column is-4">{{ content | pretty }}</pre>
        <div class="column">
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
            }
        },

        mounted() {
            axios.get(route('pages.show', this.$route.params.id)).then(response => {
                this.model = response.data;
                this.template = response.data.template.structure;
                this.cleanContent = this.buildContent(this.template);
                this.content = JSON.parse(JSON.stringify(this.cleanContent));
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

            onSubmit(event) {
                axios.post(route('pages.update', this.$route.params.id), new FormData(event.target));
            },
        },
    }
</script>