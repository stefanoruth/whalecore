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
                </ul>
            </aside>
        </div>

        <div class="column" v-show="menuActive == 'options'">
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
                        <confirm-box :show="showDelete" @close="showDelete = false" @ok="deleteProject">Are you sure?</confirm-box>
                    </div>
                </div>
            </div>
        </div>

        <div class="column" v-show="menuActive == 'collaborators'">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title">Collaborators</div>
                </div>
                <div class="card-content">
                    <table class="table is-fullwidth is-striped" v-if="project != null">
                        <tr v-for="(member, i) in project.members" :key="i" v-if="member.user_id != authId">
                            <td>{{ member.name }}</td>
                            <td>{{ member.email }}</td>
                            <td>
                                <div class="select is-small">
                                    <select v-model="member.role" @change="updateRole(member)">
                                        <option v-for="role in roles" :key="role.id" :value="role.name" :selected="role.name == member.role">{{ role.name }}</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <button class="button is-danger is-small" @click="deleteMember(member.user_id)">X</button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="card-footer-item">
                        <div class="field has-addons">
                            <div class="control is-expanded">
                                <input class="input" type="text" v-model="newMemberEmail" placeholder="Find a member">
                            </div>
                            <div class="control">
                                <a class="button is-primary" @click="addMember">Add</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="column" v-show="menuActive == 'api'">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title">Api</div>
                </div>
                <div class="card-content" v-if="project != null">
                    <div class="field has-addons">
                        <div class="control is-expanded">
                            <input class="input" type="text" disabled v-model="project.api_key">
                        </div>
                        <div class="control">
                            <a class="button is-primary" @click="generateNewKey">New Key</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="column" v-show="menuActive == 'billing'">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-title">Billing</div>
                </div>
                <div class="card-content">
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                project: null,
                menuActive: 'options',
                newMemberEmail: null,
                showDelete: false,
                roles: [],
            };
        },

        computed: {
            authId() {
                return window.user.id;
            },
        },

        mounted() {
            axios.get(route('projects.show', {project:'foobar'})).then(response => {
                this.project = response.data.data;
            });
            axios.get(route('roles.index')).then(response => {
                this.roles = response.data;
            });
        },

        methods: {
            addMember() {
                axios.post(route('members.store'), {email:this.newMemberEmail}).then(response => {
                    this.project.members.push(response.data.data);
                    this.newMemberEmail = null;
                });
            },

            updateRole(member) {
                axios.put(route('members.update', {member:member.user_id}), {role:member.role});
            },

            deleteMember(userId) {
                axios.delete(route('members.destroy', {member:userId})).then(response => {
                    this.project.members = _.reject(this.project.members, function(member) {
                        return member.user_id == userId;
                    });
                });
            },

            generateNewKey() {
                axios.put(route('projects.api.update', {id:'foobar'})).then(response => {
                    this.project.api_key = response.data.api_key;
                });
            },

            deleteProject() {
                axios.delete(route('projects.destroy', {project:'foobar'})).then(response => {
                    this.$router.push("/");
                });
            },

            updateProject() {
                axios.put(route('projects.update', {project: 'foobar'}), {title: this.project.title}).then(response => {

                });
            },
        },
    }
</script>
