<template>
    <modal @close="$emit('close')">   
        <h1>New project</h1>            
        <div>
            <div class="field">
                <label class="label" for="title">Project title</label>
                <div class="control">
                    <input class="input" type="text" :class="{'border-red': errors != null}" v-model="title" autofocus placeholder="Title..">
                    <p class="help is-danger" v-if="errors != null && typeof errors.title !== 'undefined'">{{ errors.title[0] }}</p>           
                </div>
            </div>
            <div class="field">
                <label class="label">Language</label>
                <div class="control">
                    <div class="select">
                        <select v-model="lang">
                            <option v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.name }}</option>
                        </select>
                    </div>
                    <p class="help is-danger" v-if="errors != null && typeof errors.language_code !== 'undefined'">{{ errors.language_code[0] }}</p>
                </div>
            </div>
        </div>
        <button class="button is-primary is-medium" @click="createProject">Create</button>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                languages: [],
                title: null,
                lang: null,
                errors: null,
            };
        },

        mounted() {
            axios.get(route('languages.index')).then(response => {
                this.languages = response.data;
            });
        },

        methods: {
            createProject() {
                axios.post(route('projects.store'), { title: this.title, language_code: this.lang }).then(response => {
                    this.$emit('login', response.data.id);
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
