<template>
    <div class="container mx-auto" v-if="model != null">
        <div class="bg-white shadow rounded mb-8 p-4">
            <div class="flex">
                <input class="text-3xl w-full p-1" type="text" v-model="model.title">
                <button class="btn-green ml-4" @click="saveContent">Publish</button>
            </div>
            <div class="mb-3">
                <div class="text-sm text-grey-darker" title="Slug">{{ model.slug }}</div>
            </div>
            <div class="flex justify-between">
                <ul class="list-reset flex">
                    <li class="mr-1" v-for="lang in languages" :key="lang.code">
                        <div class="inline-block rounded py-1 px-3 cursor-pointer" :class="{'bg-blue text-white': selectedLang == lang.code, 'text-blue hover:bg-grey-lighter': selectedLang != lang.code}" @click="selectedLang = lang.code">{{ lang.name }}</div>
                    </li>
                </ul>
                <ul class="list-reset flex">
                    <li class="mr-1">
                        <div class="inline-block rounded py-1 px-3 cursor-pointer" :class="{'bg-blue text-white': showOutput, 'text-blue hover:bg-grey-lighter': !showOutput}" @click="showOutput = true">Json</div>
                    </li>
                    <li class="">
                        <div class="inline-block rounded py-1 px-3 cursor-pointer" :class="{'bg-blue text-white': !showOutput, 'text-blue hover:bg-grey-lighter': showOutput}" @click="showOutput = false">Content</div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container mx-auto">
            <div v-if="showOutput" class="bg-white rounded shadow p-4 w-full overflow-x-scroll">
                <pre v-for="lang in languages" :key="lang.code" v-show="lang.code == selectedLang" class="text-xs text-grey-darkest">{{ content[lang.code] | pretty }}</pre>
            </div>
            <div v-else>
                <div v-for="lang in languages" :key="lang.code" v-show="lang.code == selectedLang">
                    <content-field v-for="(field, key) in template" :key="key" :field="field" :content="content[lang.code][key]" :baseContent="baseContent[key]" :lang="lang.code" class="bg-white shadow rounded mb-4"></content-field>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
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

            /**
             * Saves the current content
             */
            saveContent(event) {
                axios.post(route('items.update', this.$route.params.id), {_method:'PUT',content: this.content});
            },
        },
    }
</script>