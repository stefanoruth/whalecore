<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="card-header-title">Options</div>
            </div>
            <div class="card-content" v-if="project != null">
                <div class="field">
                    <label class="label">Project Name</label>
                    <div class="control">
                        <input class="input" type="text" v-model="project.title">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="card-footer-item">
                    <button class="button is-primary" @click="updateProject">Save</button>
                </div>
                <div class="card-footer-item">
                    <button class="button is-danger" @click="showDelete = true">Delete</button>
                    <confirm-box v-show="showDelete" @close="showDelete = false" @ok="deleteProject">Are you sure, you want to delete this project?</confirm-box>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['project'],

        data() {
            return {
                showDelete: false,
            };
        },

        methods: {
            deleteProject() {
                axios.delete(route('projects.destroy', {project:'foobar'})).then(response => {
                    this.$router.push("/");
                });
            },

            updateProject() {
                axios.put(route('projects.update', {project: 'foobar'}), {title: this.project.title}).then(response => {

                });
            },
        }
    }
</script>
