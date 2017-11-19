<template>
    <div class="card">
        <div class="card-content">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <div>
                            <p class="title is-size-5">{{ field.title }}</p>
                        <p class="heading">{{ field.type }}</p>
                        </div>
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <button @click="showEdit = true" class="button is-small">Edit</button>
                    </div>
                </div>
            </div>
            
            <div class="card" v-if="hasSubFields()">
                <div class="card-cotent">
                    <template-field-item v-for="(subField, key) in field.fields" :key="key" :field="subField" @delete="deleteChild(key)"></template-field-item>
                </div>
            </div>

            <div class="card-footer" v-if="hasSubFields()">
                <div class="card-footer-item">
                    <button @click="showNew = true" class="button is-primary">Add Sub</button>
                    <template-field-new :show="showNew" @close="showNew = false" @newField="addField"></template-field-new>
                </div>
            </div> 
        </div>

        <template-field-edit :show="showEdit" :field="field" @close="showEdit = false" @save="showEdit = false" @delete="deleteSelf"></template-field-edit>
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