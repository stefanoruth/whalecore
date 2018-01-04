<template>

    <div>
        <div class="bg-white border-b flex">
            <div class="px-8 py-4 flex-1">
                <div class="text-3xl">Settings</div>
            </div>
        </div>
        <div class="p-8">
            <div class="bg-white mx-auto max-w-xl">
                <div class="border-b px-3 py-3 flex h-full">
                    <h1 class="italic text-grey text-xl">Administer your site settings</h1>
                </div>
                <option-general :project="project"></option-general> 
                <option-members :project="project"></option-members>  
                <option-api :project="project"></option-api>
                <option-billing></option-billing>
                <option-language :project="project"></option-language>                 
            </div>
        </div>                        
    </div>
</template>

<script>
export default {
  data() {
    return {
      project: null,
      menu: "options"
    };
  },

  mounted() {
    axios.get(route("projects.show", { project: "foobar" })).then(response => {
      this.project = response.data.data;
    });
  },
  components: {
    "option-billing": require("./options/Billing"),
    "option-members": require("./options/Members"),
    "option-general": require("./options/General"),
    "option-api": require("./options/Api"),
    "option-language": require("./options/Language")
  }
};
</script>
