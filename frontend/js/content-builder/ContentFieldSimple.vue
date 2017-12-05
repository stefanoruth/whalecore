<template>
    <div class="field">
        <label class="label is-small">{{ field.title }}</label>
        <p class="help">{{ field.description }}</p>
        <div class="control">

            <input v-if="field.type == 'text'" class="input is-small" type="text" v-model="content[field.id]" :placeholder="field.placeholder">

            <div v-else-if="field.type == 'image'" class="file is-small has-name">
                <img :src="content[field.id]" style="width:100px;height:100px;">
                <button class="button" @click="imageModal = true">Select Image</button>
                <file-modal :show="imageModal" @close="imageModal = false" v-model="content[field.id]"></file-modal>
            </div>

            <textarea v-else-if="field.type == 'textarea'" class="textarea is-small" v-model="content[field.id]"></textarea>

            <tinymce v-else-if="field.type == 'text-editor'" :id="field.id" v-model="content[field.id]"></tinymce>

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
        ],

        data() {
            return {
                imageModal: false,
            };
        },
    }
</script>