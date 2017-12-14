<template>
    <modal @close="$emit('close')">   
        <h1>New Template</h1>            
        <div>
            <div class="field">
                <label class="label" for="title">Template title</label>
                <div class="control">
                    <input class="input" type="text" :class="{'border-red': errors != null}" v-model="inputTitle" autofocus placeholder="Title..">
                    <p class="help is-danger" v-if="errors != null">{{ errors.title[0] }}</p>           
                </div>
            </div>
            <div class="field">
                <label for="" class="label"></label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select v-model="inputType">
                            <option value="" selected disabled>Choose one</option>
                            <option v-for="Type in types" :key="Type.id" :value="Type.id">{{Type.name}}</option>
                        </select>
                    </div>
                    <p class="help is-danger" v-if="errors != null">{{ errors.type[0] }}</p>                                   
                </div>
            </div>
        </div>
        <button class="button is-primary is-medium" @click="createTemplate">Create</button>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                types: [],
                errors: null,
                inputTitle: null,
                inputType: null,
            };
        },

        mounted() {
            axios.get(route('types.index')).then(response => {
                this.types = response.data;
            });
        },

        methods: {
            createTemplate() {
                axios.post(route('templates.store'), {title: this.inputTitle,type: this.inputType}).then(response => {
                    this.$router.push('/templates/' + response.data.data.id);
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
