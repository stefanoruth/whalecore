<template>
    <modal :show="show" @close="$emit('close')">
        <div class="mb-4" v-if="field != null">
            <label class="block text-grey-darker text-sm font-bold mb-2">Title</label>
            <input id="modalInput" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" v-model="field.title">
        </div>
        <button @click="$emit('save')">Save</button>
    </modal>
</template>

<script>
    export default {
        props: ['show', 'field'],
    }
</script>