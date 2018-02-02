<template>
    <div>
        <div class="flex bg-white border-b">
            <div class="px-8 py-4 text-3xl">Media</div>
            <div class="flex-1 mr-4 self-center">
                <input class="w-full text-2xl p-1 outline-none" v-model="search" type="text" placeholder="Search...">
            </div>
            <div class="self-center mr-4">
                <div class="label">Filter:</div>
                <div class="relative">
                    <select class="input pr-6 capitalize" v-model="showType">
                        <option class="capitalize" :value="null">All</option>
                        <option class="capitalize" v-for="item in types" :key="item" :value="item">{{ item }}</option>
                    </select>
                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
            <div>
                <button class="btn-flat-primary" @click="showUpload = true">Upload</button>
                <form v-show="showUpload" :action="storeFile" class="fixed pin bg-grey flex justify-center items-center flex-wrap p-8 overflow-y-scroll" enctype="multipart/form-data" ref="dropzoneBox">
                    <input type="hidden" name="_token" :value="token">
                    <div class="dz-message text-center">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"/></svg>
                        </div>
                        <div class="text-3xl uppercase font-bold">Drag & Drop</div>
                        <div class="text-xl mb-2">Click to store your images, or browse</div>
                        <div class="flex justify-center">
                            <div class="text-sm border p-2 uppercase mr-2">jpeg</div>
                            <div class="text-sm border p-2 uppercase mr-2">png</div>
                            <div class="text-sm border p-2 uppercase">pdf</div>
                        </div>
                    </div>

                    <div class="fixed pin-t pin-r p-8 cursor-pointer" @click="closeUpload">
                        <svg class="h-8 w-8 fill-current text-grey-darkest" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/></svg>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-8 container mx-auto flex flex-wrap">
            <div @click="showImageInfo = true" v-for="(file, i) in visibleFiles" :key="i" class="p-2">
                <div class="bg-white shadow overflow-hidden h-48 w-48 flex items-center">
                    <img :src="file.path" class="block w-full">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showUpload: false,
                showImageInfo: false,
                dropzone: null,
                reloadFiles: false,
                files: [],
                types: [],
                folders: [],
                showType: null,
                search: null,
            }
        },

        computed: {
            storeFile() {
                return route('media.store');
            },

            token() {
                return document.head.querySelector('meta[name="csrf-token"]').content;
            },

            visibleFiles() {
                return _.filter(this.files, (file) => {
                    if (this.showType !== null) {
                        return file.type == this.showType;
                    }

                    return true;
                }).filter((file) => {
                    if (this.search == null || this.search == '') {
                        return true;
                    }

                    return file.file_name.indexOf(this.search) > -1;
                });
            },
        },

        mounted() {
            this.loadFiles();
            this.initDropzone();
        },

        methods: {
            isImage(type) {
                return ['image/png', 'image/jpeg'].indexOf(type) > -1
            },

            loadFiles() {
                axios.get(route('media.index')).then(response => {
                    this.files = response.data.data;
                    this.types = response.data.meta.types;
                });
            },

            initDropzone() {
                let Dropzone = require('dropzone');
                Dropzone.autoDiscover = false;

                this.dropzone = new Dropzone(this.$refs.dropzoneBox,{
                    previewTemplate: `<div class="p-4 blur group">
                        <div class="relative">
                            <div class="overflow-hidden w-32 h-32">
                                <img class="block w-full" data-dz-thumbnail />
                            </div>
                            <div class="absolute pin invisible opacity-75 group-hover:visible p-4 flex flex-col items-center justify-around">
                                <div class="bg-grey p-1" data-dz-size></div>
                                <div class="bg-grey p-1"><span data-dz-name></span></div>
                            </div>
                        </div>
                    </div>`,
                    success: () => {
                        this.reloadFiles = true;
                    },
                });
            },

            closeUpload() {
                this.showUpload = false;
                this.dropzone.removeAllFiles();

                if (this.reloadFiles) {
                    this.reloadFiles = false;
                    this.loadFiles();
                }
            },
        },
    }
</script>
