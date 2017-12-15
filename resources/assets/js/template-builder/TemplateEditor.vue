<template>
    <div v-if="template != null" class="container mx-auto max-w-md">
        <div class="bg-white shadow rounded mb-2 p-4">
            <div class="text-3xl">{{ template.title }}</div>
        </div>

        <div class="bg-white shadow rounded mb-2">
            <template-field-item v-for="(field, key) in structure" :key="key" :field="field" @delete="deleteField(key)"></template-field-item>       
        </div>

        <div class="bg-white shadow rounded p-4 flex justify-end">
            <button @click="showNewField = true" class="btn-blue mr-2">Add Field</button>
            <template-field-new v-show="showNewField" @close="showNewField = false" @newField="addField"></template-field-new>
            <button @click="save" class="btn-green">Save Template</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                template: null,
                structure: [],
                showNewField: false,
            };
        },

        mounted() {
            axios.get(route('templates.show', this.$route.params.id)).then(response => {
                this.template = response.data.data;
                if (response.data.data.structure != null) {
                    this.structure = response.data.data.structure;
                }
            });
        },

        methods: {
            addField(field) {
                this.structure.push(field);
            },

            deleteField(fieldKey){
                this.structure.splice(fieldKey, 1);
            },

            save() {
                axios.patch(route('templates.update', this.template.id), {
                    title: this.template.title,
                    structure: this.structure,
                });
            },
        },
    }
</script>