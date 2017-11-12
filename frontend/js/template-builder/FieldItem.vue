<template>
    <div class="mb-2">
        <p><strong>{{ field.title }}</strong></p>
        <p>{{ field.type }}</p>
        <button @click="showEdit = true">Edit</button>
        <div v-if="hasSubFields">
            <div>
                <template-field-item v-for="(subField, key) in field.fields" :key="key" :field="subField"></template-field-item>
            </div>
            <button @click="showNew = true">Add Sub</button>
            <template-field-new :show="showNew" @close="showNew = false" @newField="addField"></template-field-new>
        </div>
        <template-field-edit :show="showEdit" :field="field" @close="showEdit = false" @save="showEdit = false"></template-field-edit>
    </div>
</template>

<script>
    export default {
        props: ['field'],

        data() {
            return {
                showEdit: false,
                showNew: false,
            };
        },

        methods: {
            hasSubFields() {
                return ['section', 'repeater'].indexOf(this.field.type) > -1;
            },

            addField(field) {
                this.field.fields.push(field);
            }
        },
    }
</script>