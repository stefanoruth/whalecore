<template>
    <div>
        <div class="bg-white flex justify-between border-b">
            <div class="flex-1 px-8 py-4">
                <div class="text-3xl">Content</div>
            </div>
            <div>
                <button class="btn-flat-blue" @click="modal = true">New Item</button>
                <new-item v-show="modal" @close="modal = false"></new-item>  
            </div>
        </div>
        <div class="container p-8 mx-auto max-w-md">
            <div v-if="items.length > 0" class="bg-white border py-4 mb-4">
                <div v-for="item in items" :key="item.id" class="group flex justify-between mb-4 hover:bg-blue-lightest">
                    <div class="cursor-pointer flex-1 mr-4 pl-4 py-2" @click="$router.push({name:'content.edit', params:{id:item.id}})">
                        <div class="text-xl">{{ item.title }}</div>
                        <div class="text-sm uppercase text-grey-darker">{{ item.template.title }}</div>
                    </div>
                    <div class="flex items-center invisible group-hover:visible">
                        <div class="relative">
                            <svg class="fill-current h-4 w-4 cursor-pointer text-grey-darker" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0-6a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
                            <div class="absolute pin-t bg-white hidden shadow">
                                <div>Edit</div>
                                <div>Delete</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            axios.get(route('items.index')).then(response => {
                this.items = response.data.data;
            });
        },

        components: {
            newItem: require('../modals/NewItem')
        },
    }
</script>
