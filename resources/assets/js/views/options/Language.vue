<template>
    <base-option>
        <template slot="icon"><path d="M9 18v-7L0 2V0h20v2l-9 9v7l5 1v1H4v-1l5-1zm2-10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></template>
        <div slot="title">Langauge</div>

        <label class="field mb-4 max-w-xs">
            <div class="label">Default Language</div>
            <div class="relative mr-4">
                <select class="input pr-6" v-model="defaultLang">
                    <option v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.name }}</option>
                </select>
                <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </label>
        <label class="field mb-4 max-w-xs">
            <div class="label">Available Languanges</div>
            <div class="relative mr-4">
                <select class="input" multiple v-model="selectedLangs">
                    <option v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.name }}</option>
                </select>
            </div>
        </label>
        <div>
            <button class="btn-primary" @click="save">Save</button>
        </div>
    </base-option>
</template>

<script>
    export default {
        props: ['project'],

        data() {
            return {
                languages: [],
                selectedLangs: [],
                defaultLang: null,
            };
        },

        watch: {
            project(project) {
                this.updateLangs(project);
            },
        },

        mounted() {
            axios.get(route('languages.index')).then(response => {
                this.languages = response.data;
            });

            this.updateLangs(this.project);
        },

        methods: {
            save() {
                axios.put(route('projects.update', {project:'foobar'}), {
                    default_lang: this.defaultLang,
                    languages: this.selectedLangs,
                });
            },

            updateLangs(project) {
                this.defaultLang = project.language_code;
                this.selectedLangs = _.map(project.languages, 'code');
            },
        }
    }
</script>
