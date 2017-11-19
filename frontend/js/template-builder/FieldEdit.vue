<template>
    <modal :show="show" @close="$emit('close')">
        <h1 slot="title">Edit field</h1>    
        <div v-if="field != null">
            <div class="field">
                <label class="label is-small">Title</label>
                <div class="control">
                    <input class="input is-small" type="text" v-model="field.title">
                </div>
            </div>
             <div class="field">
                <label class="label is-small">Id</label>
                <div class="control">
                    <input class="input is-small" type="text" v-model="field.id">
                </div>
            </div>
            <div class="field" v-if="!hasSubFields()">
                <label class="label is-small">Placeholder</label>
                <div class="control">
                    <input class="input is-small" type="text" v-model="field.placeholder">
                </div>
            </div>
            <div class="field" v-if="!hasSubFields()">
                <label class="label is-small">Default</label>
                <div class="control">
                    <input class="input is-small" type="text" v-model="field.default">
                </div>
            </div>
             <div class="field">
                <label class="label is-small">Description</label>
                <div class="control">
                    <textarea class="textarea" placeholder="e.g. Hello world" v-model="field.description"></textarea>
                </div>
            </div>
            <div class="field" v-if="!hasSubFields()">
                <div class="control">
                    <label class="checkbox">          
                        <input type="checkbox" v-model="field.required">
                        Required
                    </label>
                </div>
            </div>
            <div class="field" v-if="hasSubFields()">
                <label class="label is-small">Minimum items in repeater</label>
                <div class="control">
                    <input class="input is-small" type="number" v-model="field.min">
                </div>
            </div>
            <div class="field" v-if="hasSubFields()">
                <label class="label is-small">Maximum items in repeater</label>
                <div class="control">
                    <input class="input is-small" type="number" v-model="field.max">
                </div>
            </div>
            <div class="field" v-if="needsValues()">
                <label class="label is-small">Add Values</label>
                <div class="field is-horizontal" v-for="(value, i) in field.values" :key="i">
                    <div class="field-body">
                        <div class="field">
                            <div class="control">
                                <input class="input is-small" type="text" placeholder="Key" v-model="value.key">
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input class="input is-small" type="text" placeholder="Label" v-model="value.label">
                            </div>
                        </div>
                        <div class="field">
                            <button class="button is-danger is-small" @click="removeValue(i)">X</button>
                        </div>
                    </div>
                </div>
                
                <button @click="addEmptyValue" class="button is-small">Add Value</button>
                
            </div>
        </div>
        <button slot="footer" class="button is-success is-small" @click="$emit('save')">Save</button>
        <button slot="footer" class="button is-danger is-small" @click="$emit('delete')">Delete</button>
    </modal>
</template>

<script>
    export default {
        props: ["show", "field"],

        methods: {
            hasSubFields() {
                return ["section", "repeater"].indexOf(this.field.type) > -1;
            },

            needsValues() {
                return ["select", 'radio'].indexOf(this.field.type) > -1;
            },

            addEmptyValue() {
                this.field.values.push({key:null,label:null});
            },

            removeValue(key) {
                this.field.values.splice(key, 1);
            }
        }
    };
</script>