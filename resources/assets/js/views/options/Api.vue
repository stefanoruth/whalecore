<template>
<div class="border-b py-3 h-full">
    <div class="py-2">
        <h2 class="italitc texr-grey text-lg py-1">Api</h2>
        <span>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam laudantium ea, obcaecati dolor aliquid quis! Voluptatibus explicabo in harum pariatur quia, dolor corrupti obcaecati dolores quibusdam deleniti consectetur voluptas expedita.</span>
        <div class="flex-my-3">
            <div class="flex-1"></div>
            <div class="flex-1 flex-justify-end"></div>
        </div>
    </div>
</div>
    
    <!-- <div>
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
    </div> -->
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

