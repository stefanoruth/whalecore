<template>
    <div v-if="template != null" class="">
        <div class="bg-white shadow py-4 px-8 flex justify-between">
            <input class="text-3xl p-1 flex-1 mr-4" type="text" v-model="template.title">
            <button @click="save" class="btn-green self-center">Save Template</button>
        </div>

        <div class="container mx-auto p-8 max-w-md">
            <div class="bg-white shadow rounded mb-2">
                <template-field-item v-for="(field, key) in structure" :key="key" :field="field" @delete="deleteField(key)"></template-field-item>       
            </div>

            <div class="bg-white shadow border rounded p-4 flex justify-end">
                <button @click="showNewField = true" class="btn-blue">Add Field</button>
                <template-field-new v-show="showNewField" @close="showNewField = false" @newField="addField"></template-field-new>
            </div>
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