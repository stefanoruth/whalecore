<template>
    <div class="border-b py-3 px-3 h-full">
        <div class="py-2">
            <h2 class="italic text-grey text-lg py-1">Project settings</h2>
            <span>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto cum, perferendis accusamus velit numquam quibusdam possimus vitae blanditiis, suscipit atque quasi ipsum optio consequatur consectetur. Similique repellendus nam tenetur adipisci?</span>
        </div>
        <div class="flex my-3">
            <div class="flex-1">
                <div class="field">
                    <label class="label">Project Name</label>
                    <div class="control">
                        <input class="input" type="text" v-model="project.title">
                    </div>
                </div>
            </div>
            <div class="flex-1 flex justify-end items-end">
                <button class="btn-green mr-2" @click="updateProject">Save</button>    
                <button class="btn-red" @click="showDelete = true">Delete project</button> 
                <confirm-box v-show="showDelete" @close="showDelete = false" @ok="deleteProject">Are you sure, you want to delete this project?</confirm-box>
            </div>
        </div>
    </div>
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
