<template>
    <div>
        <div @click="openModal" class="cursor-pointer">
            <button v-if="value == null" class="btn-blue">Select File</button>
            <div v-else class="h-32 w-32 flex items-center">
                <img class="block h-full" :src="value">
            </div>
        </div>
        
        <modal v-show="modal" @close="modal = false">
            <div slot="header">Media Library</div>
            <div class="flex flex-wrap max-w-md h-full overflow-y-scroll">
                <div v-for="file in files" :key="file.id" class="w-1/4 p-2">
                    <div class="bg-white border overflow-hidden h-32 w-32 flex items-center">
                        <img class="block cursor-pointer" @click="selectFile(file)" :title="file.file_name" :src="file.path">
                    </div>
                </div>
            </div>
            <div slot="footer" class="flex justify-end">
                <button class="btn-red" @click="clearFile">Remove file</button>
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

            selectFile(file) {
                this.modal = false;
                this.$emit('input', file.path);
            },

            clearFile() {
                this.modal = false;
                this.$emit('input', null);
            },
        },
    }
</script>
