<template>
    <div>
        <div class="bg-white border-b flex">
            <div class="px-8 py-4 flex-1">
                <div class="text-3xl">Settings</div>
            </div>
        </div>
        <div class="p-8">
            <div class="bg-white shadow max-w-lg">
                <div class="border-b p-8">
                    <div class="text-2xl mb-4">Administer your site settings</div>
                    <div class="text-grey">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis vitae voluptatum, laboriosam reiciendis facere suscipit exercitationem, odit nemo, minima nostrum impedit aliquam nam ipsa pariatur rem. Ipsum modi optio accusamus.</div>
                </div>
                <div v-if="project != null">
                    <option-general class="border-b" :project="project"></option-general> 
                    <option-members class="border-b" :project="project"></option-members>
                    <option-api class="border-b" :project="project"></option-api>
                    <option-billing class="border-b"></option-billing>
                    <option-language :project="project"></option-language>
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
                menu: 'options',
            };
        },

        mounted() {
            axios.get(route('projects.show', {project: 'foobar'})).then(response => {
                this.project = response.data.data;
            });
        },
        components: {
            'option-billing': require('./options/Billing'),
            'option-members': require('./options/Members'),
            'option-general': require('./options/General'),
            'option-api': require('./options/Api'),
            'option-language': require('./options/Language'),
        }
    };
</script>
