<template>
    <modal @close="$emit('close')">
        <div slot="header">Edit field</div>    
        <div v-if="field != null">
            <label class="field">
                <div class="label">Title</div>
                <input class="input" type="text" v-model="field.title">
            </label>

            <label class="field">
                <div class="label">Id</div>
                <input class="input" type="text" v-model="field.id">
            </label>

            <label class="field" v-if="!hasSubFields()">
                <div class="label">Placeholder</div>
                <input class="input" type="text" v-model="field.placeholder">
            </label>

            <label class="field" v-if="!hasSubFields()">
                <div class="label">Default</div>
                <input class="input" type="text" v-model="field.default">
            </label>

            <label class="field" v-if="!hasSubFields()">
                <div class="label">Description</div>
                <textarea class="input" v-model="field.description"></textarea>
            </label>

            <label class="field" v-if="hasSubFields()">
                <div class="label">Direction</div>
                    <div class="inline-block relative w-full">
                        <select v-model="field.dir" class="input">
                            <option value="rows">Rows</option>
                            <option value="columns">Columns</option>
                        </select>
                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </label>

            <div class="field" v-if="!hasSubFields()">
                <label class="cursor-pointer">          
                    <input type="checkbox" class="leading-normal" v-model="field.required">
                    <span class="label inline leading-normal align-top">Required</span>
                </label>
            </div>

            <label class="field" v-if="isRepeater()">
                <div class="label">Minimum items in repeater</div>
                <input type="number" class="input" v-model="field.min">
            </label>

            <label class="field" v-if="isRepeater()">
                <div class="label">Maximum items in repeater</div>
                <input type="number" class="input" v-model="field.max">
            </label>

            <div class="field" v-if="needsValues()">
                <div class="label">Values</div>

                <div class="" v-for="(value, i) in field.values" :key="i">
                    <div class="flex mb-2">
                        <div class="flex-1 pr-1">
                            <input class="input" type="text" placeholder="Key" v-model="value.key">
                        </div>
                        <div class="flex-1 pr-1">
                            <input class="input" type="text" placeholder="Label" v-model="value.label">
                        </div>
                        <div class="flex items-center">
                            <button class="btn-red" @click="removeValue(i)">X</button>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <button @click="addEmptyValue" class="btn-blue">Add Value</button>
                </div>
            </div>
        </div>

        <div slot="footer" class="flex justify-between">
            <button class="btn-red mr-2" @click="$emit('delete')">Delete</button>
            <button class="btn-green" @click="save">Save</button>
        </div>
    </modal>
</template>

<script>
    export default {
        props: ['field'],

        methods: {
            hasSubFields() {
                return ['section', 'repeater'].indexOf(this.field.type) > -1;
            },

            isRepeater() {
                return ['repeater'].indexOf(this.field.type) > -1;
            },

            needsValues() {
                return ['select', 'radio'].indexOf(this.field.type) > -1;
            },

            addEmptyValue() {
                this.field.values.push({key:null,label:null});
            },

            removeValue(key) {
                this.field.values.splice(key, 1);
            },

            save() {
                if (this.field.title !== null && this.field.id !== null && this.field.title.length > 0 && this.field.id.length > 0) {
                    this.$emit('save');
                } else {
                    alert('Title & Id is Required');
                }
            },
        },
    };
</script>