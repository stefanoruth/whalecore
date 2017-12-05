<template>
<div class="container">
<div class="columns is-multiline">
  <div v-for="project in projects" :key="project.id" class="column is-4" @click="loginToProject(project.id)">
   <div class="card card-equal-height">
    <div class="card-content">
    <div class="media">
      <div class="media-left">
        <figure class="image is-48x48">
          <img src="/hvalborg.png" alt="Placeholder image">
        </figure>
      </div>
      <div class="media-content">
        <p class="title is-4">{{project.title}}</p>
      </div>
    </div>
  </div>
  </div> 
  </div>
  <div class="column is-4">
    <div class="card card-equal-height" @click="showModal = true">
        <div class="card-content">
          <div class="media"> 
            <div class="media-content">
              <p class="title is-4">New Project</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <modal :show="showModal" @close="showModal = false">   
        <h1 slot="title">New project</h1>            
        <div>
            <div class="field">
                <label class="label" for="title">Project title</label>
                <div class="control">
                    <input class="input" type="text" :class="{'border-red': errors != null}" v-model="newProjectTitle" autofocus placeholder="Title..">
                    <p class="help is-danger" v-if="errors != null && typeof errors.title !== 'undefined'">{{ errors.title[0] }}</p>           
                </div>
            </div>
            <div class="field">
                <label class="label">Language</label>
                <div class="control">
                    <div class="select">
                        <select v-model="newProjectLang">
                            <option v-for="lang in languages" :key="lang.code" :value="lang.code">{{ lang.name }}</option>
                        </select>
                    </div>
                    <p class="help is-danger" v-if="errors != null && typeof errors.language_code !== 'undefined'">{{ errors.language_code[0] }}</p>
                </div>
            </div>
        </div>
        <button class="button is-primary is-medium" slot="footer" @click="newProject">Create</button>
  </modal>
</div>
</div>
</template>
<script>
export default {
    data() {
        return {
            showModal: false,
            projects: [],
            languages: [],
            newProjectTitle: null,
            newProjectLang: null,
            errors: null
        };
    },
    mounted() {
        axios.get(route("projects.index")).then(response => {
            this.projects = response.data.data;
        });
        axios.get(route('languages.index')).then(response => {
            this.languages = response.data;
        });
    },

    methods: {
        loginToProject(projectId) {
            axios.post(route("tenant.store"), { projectId: projectId }).then(response => {
                this.$router.push("/pages");
            });
        },
        newProject() {
            axios.post(route("projects.store"), { title: this.newProjectTitle, language_code:this.newProjectLang }).then(response => {
                axios.post(route("tenant.store"), { projectId: response.data.id }).then(response => {
                    this.$router.push("/pages");
                });
            }).catch(error => {
                this.errors = error.response.data.errors;
            });
        }
    }
};
</script>