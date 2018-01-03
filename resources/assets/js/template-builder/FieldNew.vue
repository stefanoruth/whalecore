<template>
    <div>
        <modal v-show="showNew" @close="resetClose">
            <div slot="header">New Field</div>    
            <div class="flex flex-wrap max-w-md -mx-2">
                <div v-for="(title, id) in fields" :key="id" class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add(id)">{{ title }}</div>
                </div>
            </div>
        </modal>
        <template-field-edit v-show="showEdit" :field="field" @close="resetClose" @delete="resetClose" @save="submitField"></template-field-edit>
    </div>
</template>

<script>
    import FieldEmpty from './FieldEmpty';

    export default {
        props: {
            only: {
                default: function() {
                    return [];
                },
                type: Array,
            }
        },

        computed: {
            fields: function() {
                if (this.only.length == 0) {
                    return this.fieldList;
                }

                return _.filter(this.fieldList, (item, id) => {
                    return this.only.indexOf(id) > -1;
                });
            },
        },

        data() {
            return {
                showNew: true,
                showEdit: false,
                field: null,
                fieldList: {
                    text: 'Text',
                    textarea: 'Textarea',
                    'text-editor': 'Text Editor (TinyMCE)',
                    number: 'Number',
                    repeater: 'Repeater',
                    section: 'Section',
                    image: 'Image',
                    select: 'Select',
                    radio: 'Radio',
                    checkbox: 'Checkbox',
                }
            };
        },

        methods: {
            add(type) {
                this.showNew = false;
                this.field = new FieldEmpty(type);
                this.showEdit = true;
            },

            submitField() {
                this.$emit('newField', this.field);
                this.resetClose();
            },

            resetClose() {
                this.showNew = true;
                this.showEdit = false;
                this.$emit('close');
            }
        },
    }
</script>