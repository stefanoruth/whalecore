<template>
    <modal @close="$emit('close')">   
        <div slot="header">New Content</div>            
        <div>
            <label class="field">
                <div class="label">Title</div>
                <input type="text" class="input" v-model="input.title">
            </label>

            <label class="field">
                <div class="label">Template</div>
                <div class="inline-block relative w-full">
                    <select v-model="input.template" class="input">
                        <option value="" selected disabled>Choose one</option>
                        <option v-for="template in templates" :key="template.id" :value="template.id">{{template.title}}</option>
                    </select>
                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </label>
        </div>
        <div class="flex justify-end">
            <button class="btn-primary" @click="createItem">Create</button>
        </div>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                errors: null,
                templates: [],
                input: {
                    title: null,
                    template: "",
                },
            };
        },

        mounted() {
            axios.get(route('templates.index'), {params:{type:'page'}}).then(response => {
                this.templates = response.data.data;
            });
        },

        methods: {
            createItem() {
                axios.post(route('items.store'), {title: this.input.title, template: this.input.template}).then(response => {
                    this.$router.push('/content/'+response.data.data.id);
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            },
        }
    }
</script>

