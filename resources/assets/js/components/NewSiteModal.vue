<template>
    <modal :show="show" @close="$emit('close')">
        
        <div class="mb-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="email">Email</label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" :class="{'border-red': errors != null}" v-model="title" placeholder="Title..">
            <p class="text-red text-xs italic" v-if="errors != null">{{ errors.title[0] }}</p>
        </div>
        <button @click="newSite">Create</button>
    </modal>
</template>

<script>
    export default {
        props: ['show'],

        data() {
            return {
                title: null,
                errors: null,
            };
        },

        methods: {
            newSite() {
                axios.post(route('sites.store'), {title: this.title}).then((response) => {
                    axios.post(route('tenant.store'), {siteId: response.data.id}).then((response) => {
                        window.location = route('pages.index');
                    });
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>