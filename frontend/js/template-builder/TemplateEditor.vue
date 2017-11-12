<template>
    <div>
        <pre>{{ fields | pretty }}</pre>
        <section>
            <template-field-item v-for="(field, key) in fields" :key="key" :field="field"></template-field-item>
        </section>
        <button @click="showNewField = true">Add Field</button>
        <template-field-new :show="showNewField" @close="showNewField = false" @newField="addField"></template-field-new>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                fields: [],
                showNewField: false,
            };
        },

        mounted() {
            // Load template data.
        },

        methods: {
            addField(field) {
                this.fields.push(field);
            }
        },
    }
</script>