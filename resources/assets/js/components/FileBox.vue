<template>
    <div class="flex">
        <div v-if="value == null" class="btn-blue" @click="openModal">Select File</div>

        <div v-else class="flex justify-center flex-1">
            <div class="h-32 border" @click="openModal">
                <img class="block h-full" :src="value">
            </div>
        </div>
        
        <modal v-show="modal" @close="closeModal">
            <div slot="header">Media Library</div>
            <div class="flex flex-wrap max-w-md h-full overflow-y-scroll">
                <div v-for="file in files" :key="file.id" class="w-1/4 p-2">
                    <div class="bg-white border overflow-hidden h-32 w-32 flex items-center">
                        <img class="block cursor-pointer" @click="selectFile(file.path)" :alt="file.file_name" :title="file.file_name" :src="file.path">
                    </div>
                </div>
            </div>
            <div slot="footer" class="flex justify-end">
                <div class="btn-red" @click="clearFile">Remove file</div>
            </div>
        </modal>
    </div>
</template>

<script>
    export default {
        props: [
            'value',
        ],

        data() {
            return {
                modal: false,
                files: [],
            };
        },

        mounted() {
            this.loadFiles();
        },

        methods: {
            openModal() {
                this.modal = true;
                this.loadFiles();
            },

            loadFiles() {
                if (this.files.length > 0) {
                    return;
                }

                axios.get(route('media.index')).then(response => {
                    this.files = response.data.data;
                });
            },

            selectFile(path) {
                this.closeModal();
                this.$emit('input', path);
            },

            closeModal() {
                this.modal = false;
            },

            clearFile() {
                this.closeModal();
                this.$emit('input', null);
            },
        },
    }
</script>
