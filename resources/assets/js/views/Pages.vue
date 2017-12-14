<template>
    <div class="container mx-auto max-w-md">
        <div class="bg-white rounded shadow py-4 mb-4">
            <div v-for="item in items" :key="item.id" class="group flex justify-between mb-4 px-4 py-2 hover:bg-blue-lightest">
                <div>
                    <div class="text-xl">{{ item.title }}</div>
                    <div class="text-sm uppercase text-grey-darker">{{ item.template.title }}</div>
                </div>
                <div class="flex">
                    <router-link class="invisible group-hover:visible no-underline text-blue self-center p-2" :to="{name: 'page.edit', params: {id: item.id}}">Edit</router-link>
                </div>
            </div>
        </div>

        <div class="bg-white rounded shadow p-4 flex justify-end">
            <button class="bg-blue text-white py-1 px-2 rounded hover:bg-blue-dark" @click="modal = true">New</button>
            <new-item v-show="modal" @close="modal = false"></new-item>         
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items: [],
                modal: false,
            };
        },

        mounted() {
            axios.get(route('items.index'), {params:{type:'page'}}).then(response => {
                this.items = response.data.data;
            });
        },

        components: {
            newItem: require('../modals/NewItem')
        },
    }
</script>
