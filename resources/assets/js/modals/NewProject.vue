<template>
    <modal @close="$emit('close')">   
        <div slot="header">New project</div>
        <div>
            <label class="field">
                <div class="label">Title</div>
                <input type="text" class="input" v-model="title" autofocus>
            </label>
            <label class="field">
                <div class="label">Language</div>
                <div class="relative">
                    <select class="input pr-6" v-model="lang">
                            <option v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.name }}</option>
                        </select>
                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </label>
        </div>
        <div slot="footer" class="flex justify-end">
            <button class="btn-primary" @click="createProject">Create</button>
        </div>
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
