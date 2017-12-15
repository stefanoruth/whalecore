<template>
    <modal @close="$emit('close')">   
        <div slot="header">New Template</div>   
         
        <div>
            <label class="field">
                <div class="label">Title</div>
                <input type="text" class="input" v-model="input.title">
            </label>

            <label class="field">
                <div class="label">Type</div>
                <div class="inline-block relative w-full">
                    <select v-model="input.type" class="input">
                        <option value="" selected disabled>Choose one</option>
                        <option v-for="Type in types" :key="Type.id" :value="Type.id">{{Type.name}}</option>
                    </select>
                    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </label>
        </div>

        <div slot="footer" class="flex justify-end">
            <button class="btn-blue" @click="createTemplate">Create</button>
        </div>
    </modal>
</template>

<script>
    export default {
        data() {
            return {
                types: [],
                errors: null,
                input: {
                    title: null,
                    type: "",
                },
            };
        },

        mounted() {
            axios.get(route('types.index')).then(response => {
                this.types = response.data;
            });
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
