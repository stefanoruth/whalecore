<template>
    <modal @close="$emit('close')">   
        <div slot="header">New Template</div>   
         
        <div>
            <label class="field">
                <div class="label">Title</div>
                <input type="text" class="input" v-model="input.title">
            </label>
        </div>

        <div slot="footer" class="flex justify-end">
            <button class="btn-primary" @click="createTemplate">Create</button>
        </div>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                errors: null,
                input: {
                    title: null,
                },
            };
        },

        methods: {
            createTemplate() {
                axios.post(route('templates.store'), {title: this.input.title,type: this.input.type}).then(response => {
                    this.$router.push('/templates/' + response.data.data.id);
                }).catch(error => {
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
