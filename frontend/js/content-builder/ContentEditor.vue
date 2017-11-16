<template>
    <div class="columns" v-if="template.length > 0">
        <pre style="column">{{ content | pretty }}</pre>
        <div class="column">
            <form action="" enctype="multipart/form-data" method="post" v-on:submit.prevent="onSubmit">
                <input type="hidden" name="_method" value="put">
                <button type="submit" class="button">Submit</button>
                <content-field v-for="(field, key) in template" :key="key" :field="field" :content="content" :indentifier="key"></content-field>
            </form>
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
                axios.post(route('pages.update', this.$route.params.id), new FormData(event.target));
            }
        },
    }
</script>