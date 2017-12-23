<template>
    <modal @close="$emit('close')">
        <div slot="header">Media Library</div>
        <div class="flex flex-wrap max-w-md">
            <div v-for="file in files" :key="file.id" class="w-1/4 p-2">
                <div class="flex justify-center" @click="updateValue(file.path)" :title="file.file_name">
                    <img class="w-auto block h-24 shadow rounded cursor-pointer" v-if="isImage(file.mime_type)" :src="file.path">
                    <svg v-else class="h-24 w-24 p-4 shadow rounded cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4 18h12V6h-4V2H4v16zm-2 1V0h12l4 4v16H2v-1z"/></svg>
                </div>
            </div>
        </div>
        <div slot="footer" class="flex justify-end">
            <button class="btn-red">Remove file</button>
        </div>
    </modal>
</template>

<script>
    export default {
        props: [
            'value',
        ],

        data() {
            return {
                files: [],
            };
        },

        mounted() {
            axios.get(route('media.index')).then(response => {
                this.files = response.data.data;
            });
        },

        methods: {
            updateValue(value) {
                this.$emit('input', value);
                this.$emit('close');
            },

            isImage(mime) {
                return ['image/png', 'image/jpeg'].indexOf(mime) > -1;
            },
        },
    }
</script>
