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
                                <div class="select" @change="updateRole(member.user_id)">
                                    <select>
                                        <option>Select dropdown</option>
                                        <option>With options</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <button class="button is-danger is-small">X</button>
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

        </div>
        <div class="column" v-show="menuActive == 'billing'">

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
            };
        },

        computed: {
            authId() {
                return window.user.id;
            },
        },

        mounted() {
            axios.get(route('projects.show', {project:'foo'})).then(response => {
                this.project = response.data.data;
            });
        },

        methods: {
            addMember() {
                axios.post(route('members.store'), {email:this.newMemberEmail}).then(response => {
                    this.project.members.push(response.data.data);
                    this.newMemberEmail = null;
                });
            },

            updateRole(userId) {
                console.log(userId);
            },
        },
    }
</script>
