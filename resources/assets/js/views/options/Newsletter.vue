<template>
    <base-option>
        <template slot="icon"><path d="M9 18v-7L0 2V0h20v2l-9 9v7l5 1v1H4v-1l5-1zm2-10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></template>
        <div slot="title">Newsletter</div>
        <!-- <label class="field max-w-sm mb-4">
            <div class="label"></div>
            <input type="checkbox">
        </label> -->
        <label class="checkbox mb-4"><input type="checkbox"><span></span>Yes I would love to recieve awesome news monthly!</label>
        <input type="checkbox">
        <div>
            <a class="btn-primary" @click="updateNewsLetter">Save</a>
        </div>
    </base-option>
</template>

<script>
    export default {
        props: ['project'],

        methods: {
            // updateNewsLetter() {
            //     axios.put(route('projects.api.update', {id:'foobar'})).then(response => {
            //         this.project.api_key = response.data.api_key;
            //     });
            // },
        }
    }
</script>

