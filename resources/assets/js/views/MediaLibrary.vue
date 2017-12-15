<template>
    <div>
        <form :action="storeFile" class="dropzone mb-2" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="token">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </form>

        <ul class="list-reset flex border-b" v-if="mimeTypes.length > 0">
            <li class="mr-1" :class="{'-mb-px':selectedMime == null}">
                <a class="bg-white inline-block py-2 px-4 font-semibold no-underline text-blue cursor-pointer" :class="{'border-l border-t border-r rounded-t text-blue-dark': selectedMime == null}" @click="toggleMimeType(null)">All</a>
            </li>

            <li class="mr-1" v-for="mime in mimeTypes" :key="mime">
                <a class="bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold cursor-pointer" :class="{'border-l border-t border-r rounded-t text-blue-dark': selectedMime == mime}" @click="toggleMimeType(mime)">{{ mime }}</a>
            </li>
        </ul>

        <div class="flex flex-wrap -mx-2">
            <div v-for="(file, i) in visibleFiles" :key="i" class="w-full sm:w-1/4 p-2">
                <div class="bg-white rounded shadow p-1">
                    <img :src="file.path" class="block">
                </div>
            </div>
        </div>
    </div>  
</template>

<script>
import Dropzone from 'dropzone';

export default {
    data() {
        return {
            files: [],
            mimeTypes: [],
            folders: [],
            selectedMime: null,
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
                if (typeof this.selectedMime !== 'undefined' && this.selectedMime !== null) {
                    return file.mime_type == this.selectedMime;
                }

                return true;
            });
        },
    },

    created() {
        axios.get(route('media.index')).then(response => {
            this.files = response.data.data;
            this.mimeTypes = response.data.meta.mime_types;
        });
    },

    methods: {
        toggleMimeType(type) {
            this.selectedMime = type;
        },

        isImage(type) {
            return ['image/png', 'image/jpeg'].indexOf(type) > -1
        },
    },
}
</script>
