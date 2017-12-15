<template>
    <div>
        <modal v-show="showNew" @close="resetClose">
            <div slot="header">New Field</div>    
            <div class="flex flex-wrap max-w-md -mx-2">
                <div class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add('text')">Text</div>
                </div>
                <div class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add('textarea')">Textarea</div>
                </div>
                <div class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add('text-editor')">Text Editor (TinyMCE)</div>
                </div>
                <div class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add('number')">Number</div>
                </div>
                <div class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add('repeater')">Repeater</div>
                </div>
                <div class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add('section')">Section</div>
                </div>
                <div class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add('image')">Image</div>
                </div>
                <div class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add('select')">Select</div>
                </div>
                <div class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add('radio')">Radio</div>
                </div>
                <div class="w-1/3 p-2">
                    <div class="bg-blue text-white py-2 px-4 cursor-pointer" @click="add('checkbox')">Checkbox</div>
                </div>
            </div>
        </modal>
        <template-field-edit v-show="showEdit" :field="field" @close="resetClose" @delete="resetClose" @save="submitField"></template-field-edit>
    </div>
</template>

<script>
    import FieldEmpty from './FieldEmpty';

    export default {
        props: ['show'],

        data() {
            return {
                showNew: true,
                showEdit: false,
                field: null,
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