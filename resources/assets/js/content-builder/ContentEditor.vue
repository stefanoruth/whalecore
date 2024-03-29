<template>
    <div class="" v-if="model != null">
        <div class="bg-white border-b flex">
            <div class="px-8 py-4 flex-1">
                <input class="text-2xl w-full p-1" type="text" v-model="model.title">
                <a href="#" target="_blank" class="text-sm text-grey-darker no-underline" title="Slug">{{ model.slug }}</a>
            </div>

            <div class="flex items-center">
                <div class="self-center mr-4">
                    <div class="label">Language</div>
                    <div v-if="languages.length > 1" class="relative">
                        <select class="input pr-6" v-model="selectedLang">
                            <option v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.name }}</option>
                        </select>
                        <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                <div class="self-center mr-4">
                    <div class="label">Display</div>
                    <div class="relative">
                        <select class="input pr-6" v-model="showOutput">
                            <option :value="false">Content</option>
                            <option :value="true">Json</option>
                        </select>
                        <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                </div>
                <button class="btn-flat-primary" @click="saveContent">Publish</button>
            </div>
        </div>

        <div class="container p-8 mx-auto">
            <div v-for="lang in languages" :key="lang.code" v-show="lang.code == selectedLang">

                <div v-if="showOutput" class="bg-white border p-4 w-full overflow-x-scroll">
                    <pre class="text-xs text-grey-darkest">{{ content[lang.code] | pretty }}</pre>
                </div>

                <div v-else class="md:flex">
                    <div class="flex-1 md:mr-4">
                        <content-field v-for="(field, key) in template" :key="key" :field="field" :content="content[lang.code][key]" :baseContent="baseContent[key]" :lang="lang.code" class="bg-white rounded mb-4"></content-field>
                    </div>
                    <div class="flex-no-grow">
                        <div class="bg-white border">
                            <div class="p-4 border-b">
                                <div class="text-lg uppercase">Seo</div>
                            </div>
                            <div class="p-4">
                                <label class="field">
                                    <div class="label">Title:</div>
                                    <input type="text" class="input" v-model="seo[lang.code].title">
                                </label>
                                <label class="field">
                                    <div class="label">Description:</div>
                                    <textarea class="input"  v-model="seo[lang.code].description"></textarea>
                                </label>
                                <label class="field">
                                    <div class="label">Image:</div>
                                    <filebox v-model="seo[lang.code].image"></filebox>
                                </label>
                            </div>
                        </div>
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
                seo: [],
                model: null,
                template: [],
                content: null,
                baseContent: [],
                languages: [],
                selectedLang: null,
                showOutput: false,
            }
        },

        mounted() {
            // Fetches all information about the current page.
            axios.get(route('items.show', this.$route.params.id)).then(response => {
                this.model = response.data.data;
                this.setTemplate(response.data.data.template);
                this.setLanguages(this.model.project);
                this.baseContent = this.buildBase(this.template);
                this.content = this.fillLanguageContent(response.data.data.content);
                this.seo = this.fillSeo(response.data.data.content);
            });
        },

        methods: {
            /**
             * Sets the template if a structure has been defined.
             */
            setTemplate(template) {
                if (template.structure !== null) {
                    this.template = template.structure;
                }
            },

            /**
             * This all languages for contents.
             */
            setLanguages(project) {
                // Set start language.
                this.selectedLang = project.language_code;
                let langs = [project.language];

                // Find all other languages for this project
                for (const key in project.languages) {
                    langs.push(project.languages[key]);
                }

                this.languages = _.uniqBy(langs, 'code');
            },

            /**
             * Check each language for pre existing content and fill it into the template.
             */
            fillLanguageContent(contentList) {
                let sets = {};
                for (const key in this.languages) {
                    const lang = this.languages[key];
                    
                    let data = JSON.parse(JSON.stringify(this.baseContent));

                    if (contentList.length > 0) {
                        let old = _.find(contentList, function(content){
                            return content.language_code == lang.code;
                        });

                        if (old != null) {
                            data = this.fillContent(data, old.body);
                        }
                    }

                    sets[lang.code] = data;
                }

                return sets;
            },

            /**
             * Takes a template and converts is to an usable datastructure
             */
            buildBase(template, parent) {
                // If is top level item
                if (typeof parent === 'undefined') {
                    var data = [];
                    for (var i = 0; i < template.length; i++) {
                        var newField = {};

                        // If repeater or section
                        if (template[i].fields.length > 0) {
                            newField[template[i].id] = this.buildBase(template[i].fields, template[i]);
                        } else {
                            newField[template[i].id] = null;
                        }

                        data.push(newField);
                    }
                } else {
                    var data = {};
                    for (var i = 0; i < template.length; i++) {

                        // If repeater or section
                        if (template[i].fields.length > 0) {
                            data[template[i].id] = this.buildBase(template[i].fields, template[i]);
                        } else {
                            data[template[i].id] = null;
                        }
                    }
                }

                if (typeof parent !== 'undefined' && parent.type == 'repeater') {
                    data = [data];
                }

                return data;
            },

            /**
             * Takes to data sets and uses the original as a base for filling with the new set of data.
             */
            fillContent(original, newset) {
                for (const key in original) {
                    if (typeof newset[key] === 'undefined') {
                        continue;
                    }

                    const element = original[key];
                    const newElm = newset[key];

                    if (Array.isArray(element)) {
                        if (newElm.length > 0) {
                            for (const arrKey in newElm) {
                                const arrElm = newElm[arrKey];
                                element[arrKey] = this.fillContent(JSON.parse(JSON.stringify(element[0])), arrElm);
                            }
                        }
                    } else if (typeof element === 'object' && element !== null) {
                        original[key] = this.fillContent(element, newElm);
                    } else {
                        original[key] = newElm;
                    }
                }
                
                return original;
            },

            fillSeo(contentList) {
                let sets = {};
                for (const key in this.languages) {
                    const lang = this.languages[key];
                    
                    let data = JSON.parse(JSON.stringify({
                        title: null,
                        description: null,
                        image: null,
                    }));

                    if (contentList.length > 0) {
                        let old = _.find(contentList, function(content){
                            return content.language_code == lang.code;
                        });

                        if (old != null) {
                            data = this.fillContent(data, old.body);
                        }
                    }

                    sets[lang.code] = data;
                }

                return sets;
            },

            /**
             * Saves the current content
             */
            saveContent(event) {
                axios.post(route('items.update', this.$route.params.id), {
                    _method:'PUT',
                    content: this.content,
                    seo: this.seo,
                });
            },
        },
    }
</script>