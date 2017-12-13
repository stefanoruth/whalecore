<template>
    <div class="columns">
        <div class="column is-narrow">
            <aside class="menu">
                <p class="menu-label">General</p>
                <ul class="menu-list">
                    <li @click="menuActive = 'options'"><a :class="{'is-active': menuActive == 'options'}">Options</a></li>
                    <li @click="menuActive = 'collaborators'"><a :class="{'is-active': menuActive == 'collaborators'}">Collaborators</a></li>
                    <li @click="menuActive = 'api'"><a :class="{'is-active': menuActive == 'api'}">Api</a></li>
                    <li @click="menuActive = 'billing'"><a :class="{'is-active': menuActive == 'billing'}">Billing</a></li>
                    <li @click="menuActive = 'language'"><a :class="{'is-active': menuActive == 'language'}">Languages</a></li>
                </ul>
            </aside>
        </div>

        <option-general :project="project" class="column" v-show="menuActive == 'options'"></option-general>
        <option-members :project="project" class="column" v-show="menuActive == 'collaborators'"></option-members>
        <option-api :project="project" class="column" v-show="menuActive == 'api'"></option-api>
        <option-billing class="column" v-show="menuActive == 'billing'"></option-billing>
        <option-language :project="project" class="column" v-show="menuActive == 'language'" ></option-language>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                project: null,
                menuActive: 'options',
            };
        },

        mounted() {
            axios.get(route('projects.show', {project:'foobar'})).then(response => {
                this.project = response.data.data;
            });

            
        },
        components: {
            'option-billing': require('./options/Billing'),
            'option-members': require('./options/Members'),
            'option-general': require('./options/General'),
            'option-api': require('./options/Api'),
            'option-language': require('./options/Language'),
        },
    }
</script>
