<template>
    <nav v-if="$route.path != '/'" class="hidden md:flex bg-primary-darkest text-white flex-col border-r border-primary-lighter select-none flex-no-shrink">
       <div class="flex flex-col items-center p-4">
           <img class="w-16 h-16 inline bg-white p-2 rounded-full mb-4" src="/logo.png">
       </div>

       <div class="py-8 px-6 flex-1 flex flex-col">
           <div class="uppercase mb-4 pl-2">Main</div>
           <ul class="list-reset mb-8">
                <li class="mb-2">
                    <router-link to="/content" class="flex text-white no-underline hover:bg-primary-dark py-2 block px-4 rounded">
                        <svg class="fill-current text-white h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 4c0-1.1.9-2 2-2h7l2 2h7a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4z"/></svg>
                        <span>Content</span>
                    </router-link>
                </li>
                <li class="mb-2">
                    <router-link to="/templates" class="flex text-white no-underline hover:bg-primary-dark py-2 block px-4 rounded">
                        <svg class="fill-current text-white h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 1l10 6-10 6L0 7l10-6zm6.67 10L20 13l-10 6-10-6 3.33-2L10 15l6.67-4z"/></svg>
                        <span>Templates</span>
                    </router-link>
                </li>
                <li class="mb-2">
                    <router-link to="/media" class="flex text-white no-underline hover:bg-primary-dark py-2 block px-4 rounded">
                        <svg class="fill-current text-white h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1z"/></svg>
                        <span>Media Library</span>
                    </router-link>
                </li>
                <li class="mb-2">
                    <a href="/logout" class="flex text-white no-underline hover:bg-primary-dark py-2 block px-4 rounded">
                        <svg class="fill-current text-white h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M11 7l1.44 2.16c.31.47 1.01.84 1.57.84H17V8h-3l-1.44-2.16a5.94 5.94 0 0 0-1.4-1.4l-1.32-.88a1.72 1.72 0 0 0-1.7-.04L4 6v5h2V7l2-1-3 14h2l2.35-7.65L11 14v6h2v-8l-2.7-2.7L11 7zm1-3a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg>
                        <span>Logout</span>
                    </a>
                </li>
           </ul>
           <div class="uppercase mb-4 pl-2">Help</div>
           <ul class="list-reset">
                <li class="mb-2">
                    <router-link to="/settings" class="flex text-white no-underline hover:bg-primary-dark py-2 block px-2 rounded">
                        <svg class="fill-current text-white h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M17 16v4h-2v-4h-2v-3h6v3h-2zM1 9h6v3H1V9zm6-4h6v3H7V5zM3 0h2v8H3V0zm12 0h2v12h-2V0zM9 0h2v4H9V0zM3 12h2v8H3v-8zm6-4h2v12H9V8z"/></svg>
                        <span>Settings</span>    
                    </router-link>
                </li>
                <li class="mb-2">
                    <a href="mailto:hello.whalecore@gmail.com" class="flex text-white no-underline hover:bg-primary-dark py-2 block px-2 rounded">
                        <svg class="fill-current text-white h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm2-13c0 .28-.21.8-.42 1L10 9.58c-.57.58-1 1.6-1 2.42v1h2v-1c0-.29.21-.8.42-1L13 9.42c.57-.58 1-1.6 1-2.42a4 4 0 1 0-8 0h2a2 2 0 1 1 4 0zm-3 8v2h2v-2H9z"/></svg>
                        <span>Support</span>    
                    </a>
                </li>
           </ul>
       </div>

       <div class="py-4 px-6">
            <router-link to="/" v-if="project != null" class="flex text-white no-underline bg-primary-dark hover:bg-primary py-2 block px-4 rounded">
                <span>Project: {{ project.title }}</span>
            </router-link>
       </div>
    </nav>
</template>

<script>
    export default {
        data() {
            return {
                mobile: false,
                modal: false,
                projects: [],
                project: null,
            };
        },

        computed: {
            otherProjects: function() {
                if (this.project == null) {
                    return [];
                }

                return _.filter(this.projects, (item) => {
                    return item.id != this.project.id;
                });
            },
        },

        mounted() {
            axios.get(route('tenant.index')).then(response => {
                this.project = response.data.data;
            });

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
    };
</script>