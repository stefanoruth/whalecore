<template>
    <div>
        <div class="bg-white flex justify-between border-b">
            <div class="flex-1 px-8 py-4">
                <div class="text-3xl">Content</div>
            </div>
            <div>
                <button class="btn-flat-primary" @click="modal = true">New Item</button>
                <new-item v-show="modal" @close="modal = false"></new-item>  
            </div>
        </div>
        <div class="p-4">
            <div class="container bg-white shadow max-w-lg mx-auto w-full">
                <table class="border-collapse w-full">
                    <thead>
                        <tr>
                            <th class="px-4 text-left py-4">Content</th>
                            <th class="px-4 text-left py-4">Template</th>
                            <th class="px-4 text-left py-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in items" :key="item.id" class="group hover:bg-grey-light border-t border-b">
                            <td class="py-4 px-4 text-left">{{ item.title }}</td>
                            <td class="py-4 px-4 text-left">{{ item.template.title }}</td>
                            <td class="py-4 px-4 text-right">
                                <div class="group-hover:visible invisible whitespace-no-wrap">
                                    <router-link :to="{name:'content.edit', params:{id:item.id}}" class="no-underline text-primary hover:text-primary-dark" href="#">Edit</router-link>
                                    <span>|</span>
                                    <a class="no-underline text-primary hover:text-primary-dark" href="#">Delete</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
