<template>
    <div v-if="template != null" class="columns">
        <pre class="column">{{ fields | pretty }}</pre>
        <div class="column">
            <section>
                <template-field-item v-for="(field, key) in fields" :key="key" :field="field" @delete="deleteField(key)"></template-field-item>
            </section>
            <div class="box">
                <button @click="showNewField = true" class="button is-small is-primary">Add Field</button>
                <template-field-new :show="showNewField" @close="showNewField = false" @newField="addField"></template-field-new>
                <button @click="save" class="button is-small is-success">Save Template</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                template: null,
                fields: [],
                showNewField: false,
            };
        },

        mounted() {
            axios.get(route('templates.show', this.$route.params.id)).then(response => {
                this.template = response.data.data;
                if (response.data.data.structure != null) {
                    this.fields = response.data.data.structure;
                }
            });
        },

        methods: {
            addField(field) {
                this.fields.push(field);
            },

            deleteField(fieldKey){
                this.fields.splice(fieldKey, 1);
            },

            save() {
                axios.patch(route('templates.update', this.template.id), {
                    title: this.template.title,
                    structure: this.fields,
                });
            },
        },
    }
</script>