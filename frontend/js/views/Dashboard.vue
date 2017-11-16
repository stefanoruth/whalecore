<template>
<div class="container">
<div class="columns is-multiline is-mobile">
  <div v-for="project in projects" :key="project.id" class="column">
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
  <div class="column">
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
       <div class="mb-4">
          <label class="block text-grey-darker text-sm font-bold mb-2" for="email">Email</label>
          <input id="modalInput" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" :class="{'border-red': errors != null}" v-model="newProjectTitle" autofocus placeholder="Title..">
          <p class="text-red text-xs italic" v-if="errors != null">{{ errors.title[0] }}</p>
          </div>
          <button @click="newProject">Create</button>
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
      newProjectTitle: null,
      errors: null
    };
  },
  mounted() {
    this.$emit('disablenavbar');

    axios.get(route("projects.index")).then(response => {
      this.projects = response.data;
    });
  },

  methods: {
    loginToProject(projectId) {
      axios
        .post(route("tenant.store"), { projectId: projectId })
        .then(response => {
          this.$router.push("/pages");
        });
    },
    newProject() {
      axios
        .post(route("projects.store"), { title: this.newProjectTitle })
        .then(response => {
          axios
            .post(route("tenant.store"), { projectId: response.data.id })
            .then(response => {
              this.$router.push("/pages");
            });
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
    }
  }
};
</script>