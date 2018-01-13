<template>
    <base-option>
        <template slot="icon"><path d="M9 18v-7L0 2V0h20v2l-9 9v7l5 1v1H4v-1l5-1zm2-10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></template>
        <div slot="title">Collaborators</div>
        
        <table class="mb-4 w-full">
            <tr v-for="(member, i) in project.members" :key="i">
                <td>{{ member.name }}</td>
                <td>{{ member.email }}</td>
                <td>
                    <select class="input" v-model="member.role" @change="updateRole(member)">
                        <option v-for="role in roles" :key="role.id" :value="role.name" :selected="role.name == member.role">{{ role.name }}</option>
                    </select>
                </td>
                <td>
                    <button class="btn-secondary" @click="deleteMember(member.user_id)">X</button>
                </td>
            </tr>
        </table>
        <label class="field mb-4">
            <div class="label">Find member</div>
            <input type="text" class="input max-w-xs" v-model="newMemberEmail">
            <p v-if="errors != null">{{ errors.email[0] }}</p> 
        </label>
        <div>
            <button class="btn-primary" @click="addMember">Add</button>
        </div>
    </base-option>
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
                return window.auth;
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
