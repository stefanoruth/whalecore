<template>
    <div class="border">
        <div class="flex py-2 px-4 group hover:bg-primary-lightest">
            <div class="flex-1">
                <div class="text-xl">{{ field.title }}</div>
                <div class="uppercase text-xs">{{ field.type }}</div>
            </div>
            <div class="flex">
                <a @click="showEdit = true" class="invisible group-hover:visible self-center text-primary no-underline cursor-pointer p-2">Edit</a>
            </div>
        </div>

        <div class="py-2 px-4" v-if="hasSubFields()">
            <template-field-item v-for="(subField, key) in field.fields" :key="key" :field="subField" @delete="deleteChild(key)"></template-field-item>
        </div>

        <div class="flex justify-end py-2 px-4" v-if="hasSubFields()">
            <button @click="showNew = true" class="btn-primary">Add Sub</button>
            <template-field-new v-show="showNew" @close="showNew = false" @newField="addField"></template-field-new>
        </div>

        <template-field-edit v-show="showEdit" :field="field" @close="showEdit = false" @save="showEdit = false" @delete="deleteSelf"></template-field-edit>
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

            deleteSelf() {
                this.showEdit = false;
                this.$emit('delete');
            },

            deleteChild(key) {
                this.field.fields.splice(key, 1);
            },

            addField(field) {
                this.field.fields.push(field);
            },
        },
    }
</script>