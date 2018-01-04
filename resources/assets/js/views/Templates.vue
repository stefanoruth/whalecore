<template>
    <div>
        <div class="bg-white border-b flex justify-between">
            <div class="px-8 py-4 flex-1">
                <div class="text-3xl">Templates</div>
            </div>           
            <div>
                <button class="btn-flat-blue" @click="modal = true">New</button>
                <new-template v-show="modal" @close="modal = false"></new-template>    
            </div>
        </div>
        <div class="container p-8 mx-auto max-w-md">
            <div class="bg-white border py-4 mb-4">
                <div v-for="template in templates" :key="template.id" class="group flex justify-between mb-4 px-4 py-2 hover:bg-blue-lightest">
                    <div>
                        <div class="text-xl">{{ template.title }}</div>
                    </div>
                    <div class="flex">
                        <router-link class="invisible group-hover:visible no-underline text-blue self-center p-2" :to="{name: 'template.edit', params: {id: template.id}}">Edit</router-link>
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
