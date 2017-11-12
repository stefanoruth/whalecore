<template>
    <div v-show="show">
        <modal :show="showNew" @close="resetClose">
            <div @click="add('text')">Text</div>
            <div @click="add('textarea')">Textarea</div>
            <div @click="add('number')">Number</div>
            <div @click="add('repeater')">Repeater</div>
            <div @click="add('section')">Section</div>
            <div @click="add('image')">Image</div>
            <div @click="add('select')">Select</div>
            <div @click="add('radio')">Radio</div>
            <div @click="add('bool')">Bool</div>
        </modal>
        <template-field-edit :show="showEdit" :field="field" @close="resetClose" @save="submitField"></template-field-edit>
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