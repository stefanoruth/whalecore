<template>
    <div v-if="template.length > 0">
        <pre style="float:left;">{{ template | pretty }}</pre>
        <pre style="float:left;">{{ content | pretty }}</pre>
        <div style="clear:both;"></div>
        <form action="" method="post" v-on:submit.prevent="onSubmit">
            <content-field v-for="(field, key) in template" :key="key" :field="field" :indentifier="key"></content-field>
            <button type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                model: null,
                template: [],
                content: [],
                form: null,
            }
        },

        mounted() {
            axios.get(route('pages.show', this.$route.params.id)).then(response => {
                this.model = response.data;
                this.template = response.data.template.structure;


                this.content = this.buildContent(this.template);
            });
        },

        methods: {
            buildContent(template, parent) {
                if (typeof parent !== 'undefined') {
                    var data = {};
                    for (var i = 0; i < template.length; i++) {
                        if (template[i].fields.length > 0) {
                            data[template[i].id] = this.buildContent(template[i].fields, template[i]);
                        } else {
                            data[template[i].id] = null;
                        }
                    }
                } else {
                    var data = [];
                    for (var i = 0; i < template.length; i++) {
                        var newField = {};

                        if (template[i].fields.length > 0) {
                            newField[template[i].id] = this.buildContent(template[i].fields, template[i]);
                        } else {
                            newField[template[i].id] = null;
                        }

                        data.push(newField);
                    }
                }

                if (typeof parent !== 'undefined' && parent.type == 'repeater') {
                    data = [data];
                }

                return data;
            },

            onSubmit(event) {
                this.form = new FormData(event.target);
                console.log(this.form);
            }
        },
    }
</script>