<template>
    <div v-if="content != null">
        <content-field v-for="(field, key) in template" :key="key" :field="field" :indentifier="key"></content-field>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                content: null,
                template: [],
                fields: [],
            }
        },

        mounted() {
            axios.get(route('pages.show', this.$route.params.id)).then(response => {
                this.content = response.data;
                this.template = response.data.template.structure;
            });
        },

        methods: {
            //
        },
    }
</script>