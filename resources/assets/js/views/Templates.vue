<template>
    <div>
        <div class="bg-white border-b flex justify-between">
            <div class="px-8 py-4 flex-1">
                <div class="text-3xl">Templates</div>
            </div>           
            <div>
                <button class="btn-flat-primary" @click="modal = true">New Template</button>
                <new-template v-show="modal" @close="modal = false"></new-template>    
            </div>
        </div>
        <div class="p-4">
            <div class="container bg-white shadow max-w-lg mx-auto w-full">
                <table class="border-collapse w-full">
                    <thead>
                        <tr>
                            <th class="p-4 text-left">Template</th>
                            <th class="p-4 text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="template in templates" :key="template.id" class="group hover:bg-grey border-t border-b">
                            <td class="p-4 text-left">{{ template.title }}</td>
                            <td class="p-4 text-right">
                                <div class="group-hover:visible invisible whitespace-no-wrap">
                                    <router-link class="no-underline text-primary hover:text-primary-dark" :to="{name: 'template.edit', params: {id: template.id}}">Edit</router-link>
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
                templates: [],
                modal: false,
            };
        },

        mounted() {
            axios.get(route('templates.index')).then(response => {
                this.templates = response.data.data;
            });
        },

        components: {
            newTemplate: require('../modals/NewTemplate'),
        }
    };
</script>
