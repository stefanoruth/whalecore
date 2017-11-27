<template>
    <div class="columns" v-if="model != null">
        <div class="column is-4">
            <div class="box">
                <div class="field">
                    <label class="label">Title</label>
                    <div class="field is-grouped">
                        <div class="control is-expanded">
                            <input class="input" type="text" v-model="model.title">
                        </div>
                        <div class="control">
                            <button class="button is-success" @click="saveContent">Publish</button>
                        </div>
                    </div>
                </div>
            </div>  

            <div class="tabs is-boxed">
                <ul>
                    <li :class="{'is-active': menu == 'base'}" @click="menu = 'base'"><a>Base</a></li>
                    <li :class="{'is-active': menu == 'raw'}" @click="menu = 'raw'"><a>Raw ({{ selectedLang }})</a></li>
                </ul>
            </div>
            <div class="columns">
                <pre class="column" v-show="menu == 'base'">{{ baseContent | pretty }}</pre>
                <div class="column" v-show="menu == 'raw'">
                    <pre v-for="lang in languages" :key="lang.code" v-show="lang.code == selectedLang">{{ content[lang.code] | pretty }}</pre>
                </div>
            </div>
        </div>
        <div class="column">
            <div class="tabs is-boxed">
                <ul>
                    <li v-for="lang in languages" :key="lang.code" :class="{'is-active':selectedLang == lang.code}" @click="selectedLang = lang.code"><a>{{ lang.name }}</a></li>
                </ul>
            </div>
            <div class="box" v-for="lang in languages" :key="lang.code" v-show="lang.code == selectedLang">
                <content-field v-for="(field, key) in template" :key="key" :field="field" :content="content[lang.code][key]" :baseContent="baseContent[key]" :indentifier="key" style="margin-bottom:50px;"></content-field>
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
                menu: 'raw',
            }
        },

        mounted() {
            // Fetches all information about the current page.
            axios.get(route('items.show', this.$route.params.id)).then(response => {
                this.model = response.data.data;

                this.selectedLang = this.model.project.language_code;

                if (response.data.data.template.structure !== null) {
                    this.template = response.data.data.template.structure;
                }

                // Languages
                let langs = [this.model.project.language];
                for (const key in this.model.project.languages) {
                    langs.push(this.model.project.languages[key]);
                }
                this.languages = _.uniqBy(langs, 'code');
                
                this.baseContent = this.buildBase(this.template);
                
                let sets = {};
                for (const key in this.languages) {
                    const lang = this.languages[key];
                    
                    let data = JSON.parse(JSON.stringify(this.baseContent));

                    if (response.data.data.content.length > 0) {
                        let old = _.find(response.data.data.content, function(content){
                            return content.language_code == lang.code;
                        });

                        if (old != null) {
                            data = this.fillContent(data, old.body);
                        }
                    }

                    sets[lang.code] = data;
                }

                this.content = sets;
            });
        },

        methods: {
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