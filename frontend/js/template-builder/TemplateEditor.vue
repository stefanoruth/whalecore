<template>
    <div v-if="template != null">
        <pre>{{ fields | pretty }}</pre>
        <section>
            <template-field-item v-for="(field, key) in fields" :key="key" :field="field" @delete="deleteField(key)"></template-field-item>
        </section>
        <button @click="showNewField = true">Add Field</button>
        <template-field-new :show="showNewField" @close="showNewField = false" @newField="addField"></template-field-new>
        <button @click="save">Save Template</button>
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
                this.template = response.data;
                if (response.data.structure != null) {
                    this.fields = response.data.structure;
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