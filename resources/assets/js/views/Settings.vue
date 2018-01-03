<template>

    <div>
        <div class="bg-white shadow flex justify-between">
            <div class="px-8 py-4 w-full">
                <div class="text-3xl">Settings</div>
            </div>
        </div>

        <div class="container p-8 mx-auto max-w-md">
            <div class="bg-white py-4 mb-4">
                <!-- I want a header section in here -->
                <div class="border-b" style="height:400px">
                </div>
                 <div class="border-b" style="height:400px">
                </div>
                 <div class="border-b" style="height:400px">
                </div>
                 <div class="border-b" style="height:400px">
                </div>

                <!-- Here I want to add all of the options -->
                <!-- An option should include a header and the specific alterations available -->
                <!-- Every option including the header, should be divided by a grey area -->
            </div>
        </div>

        <!-- <div class="p-8">
            <ul class="list-reset flex border-b">
                <li class="mr-1" :class="{'-mb-px': menu == 'options'}">
                    <a class="cursor-pointer bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" :class="{'text-blue-dark border-l border-t border-r rounded-t': menu == 'options'}" @click="menu = 'options'">Options</a>
                </li>
                <li class="mr-1" :class="{'-mb-px': menu == 'collaborators'}">
                    <a class="cursor-pointer bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" :class="{'text-blue-dark border-l border-t border-r rounded-t': menu == 'collaborators'}" @click="menu = 'collaborators'">Collaborators</a>
                </li>
                <li class="mr-1" :class="{'-mb-px': menu == 'api'}">
                    <a class="cursor-pointer bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" :class="{'text-blue-dark border-l border-t border-r rounded-t': menu == 'api'}" @click="menu = 'api'">Api</a>
                </li>
                <li class="mr-1" :class="{'-mb-px': menu == 'billing'}">
                    <a class="cursor-pointer bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" :class="{'text-blue-dark border-l border-t border-r rounded-t': menu == 'billing'}" @click="menu = 'billing'">Billing</a>
                </li>
                <li class="mr-1" :class="{'-mb-px': menu == 'language'}">
                    <a class="cursor-pointer bg-white inline-block py-2 px-4 text-blue hover:text-blue-darker font-semibold" :class="{'text-blue-dark border-l border-t border-r rounded-t': menu == 'language'}" @click="menu = 'language'">Languages</a>
                </li>
            </ul>

            <div class="bg-white border-l border-r border-b shadow p-4 ">
                <option-general  :project="project" class="column" v-show="menu == 'options'"></option-general>
                <option-members  :project="project" class="column" v-show="menu == 'collaborators'"></option-members>
                <option-api      :project="project" class="column" v-show="menu == 'api'"></option-api>
                <option-billing  :project="project" class="column" v-show="menu == 'billing'"></option-billing>
                <option-language :project="project" class="column" v-show="menu == 'language'" ></option-language>
            </div>
        </div> -->
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
            axios.get(route('projects.show', {project:'foobar'})).then(response => {
                this.project = response.data.data;
            });

            
        },
        components: {
            'option-billing': require('./options/Billing'),
            'option-members': require('./options/Members'),
            'option-general': require('./options/General'),
            'option-api': require('./options/Api'),
            'option-language': require('./options/Language'),
        },
    }
</script>
