<template>
    <div class="flex h-screen justify-center items-center" id="dashboard">    
        <div v-for="project in projects" :key="project.id" class="w-48 h-48 cursor-pointer rounded overflow-hidden bg-white shadow-lg m-4" @click="loginToProject(project.id)">
            <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ project.title }}</div>
            </div>
        </div>

        <div class="w-48 h-48 cursor-pointer rounded overflow-hidden bg-white shadow-lg m-4" @click="showModal = true">
            <div class="flex justify-center items-center h-full">
                <div class="font-bold text-xl mb-2">New project</div>
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
</template>
<script>
export default {
    data() {
        return {
            showModal: false,
            projects: [],
            newProjectTitle: null,
            errors: null,
        };
    },
    mounted() {
        axios.get(route("projects.index")).then(response => {
            this.projects = response.data;
        });
    },

    methods: {
        loginToProject(projectId) {
            axios.post(route("tenant.store"), { projectId: projectId }).then(response => {
             this.$router.push('/pages');
            });
        },
        newProject() {
            axios.post(route('projects.store'), {title: this.newProjectTitle}).then((response) => {
                axios.post(route('tenant.store'), {projectId: response.data.id}).then((response) => {
                    this.$router.push('/pages');                                            
                });
            }).catch((error) => {
                this.errors = error.response.data.errors;
            });
        },
    }
};
</script>