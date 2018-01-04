<template>
    <div class="flex items-center h-full w-full">
        <div class="flex justify-center items-center flex-wrap -mx-4 w-full">
            <div v-for="project in projects" :key="project.id" class="w-full sm:w-1/4 p-4">
                <div class="bg-white p-4 rounded shadow cursor-pointer" @click="loginToProject(project.id)">{{ project.title }}</div>
            </div>

            <div class="w-full sm:w-1/4 p-4">
                <div class="bg-white p-4 rounded shadow cursor-pointer" @click="modal = true">New Project</div>
                <new-project v-show="modal" @close="modal = false" @login="loginToProject"></new-project>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                modal: false,
                projects: [],
            };
        },

        mounted() {
            axios.get(route('projects.index')).then(response => {
                this.projects = response.data.data;
            });
        },

        methods: {
            loginToProject(id) {
                axios.post(route('tenant.store'), {projectId: id}).then(response => {
                    this.project = response.data.data;
                    this.$router.push('/content');
                    window.location.reload();
                });
            },
        },

        components: {
            newProject: require('../modals/NewProject'),
        },
    }
</script>
