<template>
    <div>
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
                            <p class="help is-danger" v-if="errors != null">{{ errors.email[0] }}</p>  
                        </div>
                        <div class="control">
                            <a class="button is-primary" @click="addMember">Add</a>
                        </div>
                    </div>
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
                newMemberEmail: null,
                roles: [],
                errors: null,
            };
        },

        computed: {
            authId() {
                return window.user.id;
            },
        },

        mounted() {
            axios.get(route('roles.index')).then(response => {
                this.roles = response.data;
            });
        },

        methods: {
            addMember() {
                axios.post(route('members.store'), {email:this.newMemberEmail}).then(response => {
                    this.project.members.push(response.data.data);
                    this.newMemberEmail = null;
                }).catch(error => {
                    this.errors = error.response.data.errors;
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
        },
    }
</script>
