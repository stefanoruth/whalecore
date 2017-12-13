<template>
    <div v-show="show">
        <modal class="fieldSelector" v-show="showNew" @close="resetClose">
            <h1 slot="title">New Field</h1>    
            <div class="fieldSelectorItem" @click="add('text')">Text</div>
            <div class="fieldSelectorItem" @click="add('textarea')">Textarea</div>
            <div class="fieldSelectorItem" @click="add('text-editor')">Text Editor (TinyMCE)</div>
            <div class="fieldSelectorItem" @click="add('number')">Number</div>
            <div class="fieldSelectorItem" @click="add('repeater')">Repeater</div>
            <div class="fieldSelectorItem" @click="add('section')">Section</div>
            <div class="fieldSelectorItem" @click="add('image')">Image</div>
            <div class="fieldSelectorItem" @click="add('select')">Select</div>
            <div class="fieldSelectorItem" @click="add('radio')">Radio</div>
            <div class="fieldSelectorItem" @click="add('checkbox')">Checkbox</div>
        </modal>
        <template-field-edit :show="showEdit" :field="field" @close="resetClose" @delete="resetClose" @save="submitField"></template-field-edit>
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