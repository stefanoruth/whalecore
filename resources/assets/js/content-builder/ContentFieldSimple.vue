<template>
    <div v-if="field.type == 'radio'" class="field">
        <div class="label">{{ field.title }}</div>
        <ul class="list-reset">
            <li v-for="(value, i) in field.values" :key="i">
                <label class="cursor-pointer">
                    <input type="radio" v-model="content[field.id]" v-bind:value="value.key">
                    <span>{{ value.label }}</span>
                </label>
            </li>
        </ul>
    </div>

    <label v-else class="field">
        <div class="label">{{ field.title }}</div>

        <input v-if="field.type == 'text'" class="input" type="text" v-model="content[field.id]" :placeholder="field.placeholder">

        <textarea v-else-if="field.type == 'textarea'" class="input" v-model="content[field.id]"></textarea>

        <tinymce v-else-if="field.type == 'text-editor'" :id="field.id+'-'+lang" v-model="content[field.id]"></tinymce>

        <div v-else-if="field.type == 'select'" class="inline-block relative w-full">
            <select class="input">
                <option v-for="(value, i) in field.values" :key="i" :value="value.key">{{ value.label }}</option>
            </select>
            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>

        <label v-else-if="field.type == 'checkbox'" class="">
            <input type="checkbox" v-model="content[field.id]">
            <span>{{ field.title }}</span>
        </label>

        <filebox v-else-if="field.type == 'image'" v-model="content[field.id]"></filebox>

        <div v-else class="input">Not yet whaled ({{ field.type }})</div>
    </label>
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

            open() {
                console.log('open');
                this.imageModal = true;
            }
        },
    }
</script>