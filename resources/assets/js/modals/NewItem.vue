<template>
    <modal @close="$emit('close')">   
        <h1>New Page</h1>            
        <div>
            <div class="field">
                <label class="label" for="title">Page Title</label>
                <div class="control">
                    <input class="input" type="text" :class="{'border-red': errors != null}" v-model="title" autofocus placeholder="Title..">
                    <p class="help is-danger" v-if="errors != null">{{ errors.title[0] }}</p>           
                </div>
            </div>
            <div class="field">
                <label for="" class="label"></label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select v-model="template">
                            <option value="" selected disabled>Choose one</option>
                            <option v-for="template in templates" :key="template.id" :value="template.id">{{template.title}}</option>
                        </select>
                    </div>
                    <p class="help is-danger" v-if="errors != null">{{ errors.template[0] }}</p>                                   
                </div>
            </div>
        </div>
        <button class="button is-primary is-medium" @click="createItem">Create</button>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                errors: null,
                title: null,
                template: null,
                templates: [],
            };
        },

        mounted() {
            axios.get(route('templates.index'), {params:{type:'page'}}).then(response => {
                this.templates = response.data.data;
            });
        },

        methods: {
            createItem() {
                axios.post(route('items.store'), {title: this.pageTitle,template: this.pageTemplate}).then(response => {
                    this.$router.push('/pages/'+response.data.data.id);
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            },
        }
    }
</script>

