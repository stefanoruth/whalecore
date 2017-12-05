<template>
    <modal :show="show" @close="$emit('close')">
        <div slot="title">Select File</div>
        <div class="columns is-multiline">
            <div v-for="file in files" :key="file.id" class="column is-narrow">
                <div class="box" style="width:100px;" @click="updateValue(file.path)">
                    <img :src="file.path">
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
    export default {
        props: [
            'show',
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
        },
    }
</script>
