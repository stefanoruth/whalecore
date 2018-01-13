<template>
    <base-option>
        <template slot="icon"><path d="M9 18v-7L0 2V0h20v2l-9 9v7l5 1v1H4v-1l5-1zm2-10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></template>
        <div slot="title">Project Settings</div>
        <div slot="desc">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores quia libero temporibus excepturi repudiandae, qui voluptate, optio reiciendis, quam doloremque officia! Adipisci eum ex veritatis facere, voluptatem asperiores quos dolores.</div>
        <label class="field mb-4  max-w-xs">
            <div class="label">Project Name</div>
            <input class="input" type="text" v-model="project.title">
        </label>
        <div class="flex">
            <button class="btn-primary mr-2" @click="updateProject">Save</button>    
            <button class="btn-secondary" @click="showDelete = true">Delete project</button> 
            <confirm-box v-show="showDelete" @close="showDelete = false" @ok="deleteProject">Are you sure, you want to delete this project?</confirm-box>
        </div>
    </base-option>
</template>

<script>
export default {
  props: ["project"],

  data() {
    return {
      showDelete: false
    };
  },

  methods: {
    deleteProject() {
      axios
        .delete(route("projects.destroy", { project: "foobar" }))
        .then(response => {
          this.$router.push("/");
        });
    },

    updateProject() {
      axios
        .put(route("projects.update", { project: "foobar" }), {
          title: this.project.title
        })
        .then(response => {});
    }
  }
};
</script>
