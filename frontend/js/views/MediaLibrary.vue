<template>
    <div>
        <form :action="storeFile" class="dropzone" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="token">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </form>
        <div class="section">
            <div class="columns">
                <div class="column is-narrow">
                    <aside class="menu">
                        <p class="menu-label">Folders</p>
                        <ul class="menu-list">
                            <li v-for="(folder, i) in folders" :key="i"><a>{{ folder }}</a></li>
                        </ul>
                        <p class="menu-label">Media Types</p>
                        <ul class="menu-list">
                            <li v-for="(mime, i) in mimeTypes" :key="i"><a @click="toggleMimeType(mime)" :class="{'is-active': selectedMime == mime}">{{ mime }}</a></li>
                        </ul>
                    </aside>
                </div>
                <div class="column">
                    <div class="columns is-multiline is-mobile">
                        <div v-for="(file, i) in visibleFiles" :key="i" class="column is-3">
                            <div class="card">
                                <div v-if="isImage(file.mime_type)" class="card-image">
                                    <figure class="image is-square">
                                        <img :src="file.path" style="padding:15px;">
                                    </figure>
                                </div>
                                <div v-else class="card-content" style="display: flex;align-items: center;justify-content: center;">
                                    <i class="fa fa-file" style="font-size:40px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
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

    mounted() {
        axios.get(route('media.index')).then(response => {
            this.files = response.data.data;
            this.mimeTypes = response.data.meta.mime_types;
        });
    },

    methods: {
        toggleMimeType(type) {
            if (this.selectedMime == type) {
                this.selectedMime = null;
            } else {
                this.selectedMime = type;
            }
        },

        isImage(type) {
            return ['image/png', 'image/jpeg'].indexOf(type) > -1
        },
    },
}
</script>
