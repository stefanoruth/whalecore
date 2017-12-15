<template>
    <modal @close="$emit('close')">
        <div>Select file from Media Library</div>
        <div class="columns is-multiline">
            <div v-for="file in files" :key="file.id" class="column is-narrow">
                <div class="box" style="padding: 15px; cursor: pointer;" @click="updateValue(file.path)" :title="file.file_name">
                    <img v-if="isImage(file.mime_type)" :src="file.path" style="max-height: 40px;">
                    <i v-else class="fa fa-file" style="font-size: 40px;"></i>
                </div>
            </div>
        </div>
        <button class="button is-small is-danger" @click="$emit('clearFile'), $emit('close')">Remove file</button>
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
            }
        },
    }
</script>
