<template>
    <modal :show="show" @close="$emit('close')">
        <div v-if="field != null">
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2">Title</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" v-model="field.title">
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2">Id</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" v-model="field.id">
            </div>
            <div class="mb-4" v-if="!hasSubFields()">
                <label class="block text-grey-darker text-sm font-bold mb-2">Placeholder</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" v-model="field.placeholder">
            </div>
            <div class="mb-4" v-if="!hasSubFields()">
                <label class="block text-grey-darker text-sm font-bold mb-2">Default</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" v-model="field.default">
            </div>
            <div class="mb-4" v-if="!hasSubFields()">
                <label class="block text-grey-darker text-sm font-bold mb-2">Description</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" v-model="field.description"></textarea>
            </div>
            <div class="mb-4" v-if="!hasSubFields()">
                <label class="block text-grey-darker text-sm font-bold mb-2">
                    <input class="mr-2" type="checkbox" v-model="field.required">
                    <span>Required</span>
                </label>
            </div>
            <div class="mb-4" v-if="hasSubFields()">
                <label class="block text-grey-darker text-sm font-bold mb-2">Min</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="number" v-model.number="field.min">
            </div>
            <div class="mb-4" v-if="hasSubFields()">
                <label class="block text-grey-darker text-sm font-bold mb-2">Max</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="number" v-model.number="field.max">
            </div>

            <button @click="$emit('save')">Save</button>
            <button @click="$emit('delete')">Delete</button>
        </div>
    </modal>
</template>

<script>
    export default {
        props: ['show', 'field'],

        methods: {
            hasSubFields() {
                return ['section', 'repeater'].indexOf(this.field.type) > -1;
            },
        }
    }
</script>