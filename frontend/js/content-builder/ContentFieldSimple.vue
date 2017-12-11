<template>
    <div class="field">
        <label class="label is-small">{{ field.title }}</label>
        <p class="help">{{ field.description }}</p>
        <div class="control">

            <input v-if="field.type == 'text'" class="input is-small" type="text" v-model="content[field.id]" :placeholder="field.placeholder">

            <div v-else-if="field.type == 'image'" class="file is-small has-name" @click="imageModal = true">
                <template v-if="content[field.id] != null">
                    <div class="box" style="padding: 15px;cursor: pointer;" title="Change File">
                        <img v-if="isImage(content[field.id])" :src="content[field.id]" style="max-height:40px;">
                        <i v-else class="fa fa-file" style="font-size: 40px;"></i>
                    </div>
                </template>
                <template v-else>
                    <button class="button is-small">Select Image</button>
                </template>
                
                <file-modal :show="imageModal" @close="imageModal = false" @clearFile="content[field.id] = null" v-model="content[field.id]"></file-modal>
            </div>

            <textarea v-else-if="field.type == 'textarea'" class="textarea is-small" v-model="content[field.id]"></textarea>

            <tinymce v-else-if="field.type == 'text-editor'" :id="field.id+'-'+lang" v-model="content[field.id]"></tinymce>

            <div v-else-if="field.type == 'select'" class="select">
                <select v-model="content[field.id]">
                    <option v-for="(value, i) in field.values" :key="i" :value="value.key">{{ value.label }}</option>
                </select>
            </div>

            
            <div v-else-if="field.type == 'multi-select'" class="select is-multiple">
                <select multiple size="5">
                    <option v-for="(value, i) in field.values" :key="i" :value="value.key">{{ value.label }}</option>
                </select>
            </div>

            <div v-else-if="field.type == 'radio'" class="control">
                <label v-for="(value, i) in field.values" :key="i" class="radio"><input type="radio" v-model="content[field.id]" v-bind:value="value.key">{{ value.label }}</label>
            </div>
            
            <label v-else-if="field.type == 'checkbox'" class="checkbox"><input type="checkbox" v-model="content[field.id]">{{ field.title }}</label>
            
            <div v-else>Not yet whaled</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'field',
            'content',
            'lang',
        ],

        data() {
            return {
                imageModal: false,
            };
        },

        methods: {
            isImage(file) {
                if (file == null) {
                    return false;
                }

                let bool = false;

                ['.png','.jpg','.jpeg','.svg',].forEach(ext => {
                    if (file.indexOf(ext) > -1) {
                        bool = true;
                    }
                });

                return bool;
            },
        },
    }
</script>