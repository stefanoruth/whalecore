<template>
<div class="border-b py-3 px-3 h-full">
    <div class="py-2">
        <h2 class="italic text-grey text-lg py-1">Langauge</h2>
        <span>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae, eius voluptates adipisci nemo porro dolorem architecto dolore est quam quisquam necessitatibus. Dolores, natus obcaecati perspiciatis voluptatum veniam fugiat quisquam voluptate.</span>
    </div>
    <div class="flex-my-3">
        <div class="flex-1">
            <div class="field">
                <label class="label">Default Language</label>
                <div class="control">
                    <div class="select">
                        <select v-model="defaultLang">
                            <option v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.name }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label">Available Languanges</label>
                <div class="control">
                    <div class="columns is-multiline">
                        <div v-for="lang in languages" :key="lang.code" class="column is-3" v-show="lang.code != defaultLang">
                            <label class="checkbox"><input type="checkbox" v-model="selectedLangs" :value="lang.code">{{ lang.name }}</label>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="flex-1 flex justify-end items-end">
            <button class="btn-green" @click="save">Save</button>
        </div>
    </div>
</div>
    <!-- <div>
        <div class="card">
            <div class="card-header">
                <div class="card-header-title">Language</div>
            </div>
            <div class="card-content" v-if="project != null">
                <div class="field">
                    <label class="label">Default Language</label>
                    <div class="control">
                        <div class="select">
                        <select v-model="defaultLang">
                            <option v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.name }}</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Available Languanges</label>
                    <div class="control">
                        <div class="columns is-multiline">
                            <div v-for="lang in languages" :key="lang.code" class="column is-3" v-show="lang.code != defaultLang">
                                <label class="checkbox"><input type="checkbox" v-model="selectedLangs" :value="lang.code">{{ lang.name }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="card-footer-item">
                    <button class="button is-primary" @click="save">Save</button>
                </div>
            </div>
        </div>
    </div> -->
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
                this.defaultLang = project.language_code;
                this.selectedLangs = _.map(project.languages, 'code');
            },
        },

        mounted() {
            axios.get(route('languages.index')).then(response => {
                this.languages = response.data;
            });
        },

        methods: {
            save() {
                axios.put(route('projects.update', {project:'foobar'}), {
                    default_lang: this.defaultLang,
                    languages: this.selectedLangs,
                });
            },
        }
    }
</script>
