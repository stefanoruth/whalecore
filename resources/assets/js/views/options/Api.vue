<template>
    <base-option>
        <template slot="icon"><path d="M9 18v-7L0 2V0h20v2l-9 9v7l5 1v1H4v-1l5-1zm2-10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></template>
        <div slot="title">Api</div>
        <label class="field max-w-sm mb-4">
            <div class="label">Apikey</div>
            <input type="text" class="input" disabled v-model="project.api_key">
        </label>
        <div>
            <a class="btn-blue" @click="generateNewKey">New Key</a>
        </div>
    </base-option>
</template>

<script>
    export default {
        props: ['project'],

        methods: {
            generateNewKey() {
                axios.put(route('projects.api.update', {id:'foobar'})).then(response => {
                    this.project.api_key = response.data.api_key;
                });
            },
        }
    }
</script>

