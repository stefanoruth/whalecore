<template>
    <div class="flex h-screen justify-center items-center" id="dashboard">    
        <div v-for="site in sites" :key="site.id" class="w-48 h-48 cursor-pointer rounded overflow-hidden bg-white shadow-lg m-4" @click="loginToSite(site.id)">
            <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ site.title }}</div>
            </div>
        </div>

        <div class="w-48 h-48 cursor-pointer rounded overflow-hidden bg-white shadow-lg m-4" @click="showModal = true">
            <div class="flex justify-center items-center h-full">
                <div class="font-bold text-xl mb-2">New site</div>
            </div>
        </div>
        <modal :show="showModal" @close="showModal = false">   
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">Email</label>
                <input id="modalInput" class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" type="text" :class="{'border-red': errors != null}" v-model="newSiteTitle" autofocus placeholder="Title..">
                <p class="text-red text-xs italic" v-if="errors != null">{{ errors.title[0] }}</p>
            </div>
            <button @click="newSite">Create</button>
        </modal>
    </div>
</template>
<script>
export default {
  data() {
    return {
      showModal: false,
      sites: [],
      newSiteTitle: null,
      errors: null,
    };
  },
  mounted() {
    axios.get(route("sites.index")).then(response => {
      this.sites = response.data;
    });
  },

  methods: {
    loginToSite(SiteId) {
      axios.post(route("tenant.store"), { siteId: SiteId }).then(response => {
       this.$router.push('/pages');
      });
    },
    newSite() {
                axios.post(route('sites.store'), {title: this.newSiteTitle}).then((response) => {
                    axios.post(route('tenant.store'), {siteId: response.data.id}).then((response) => {
                        this.$router.push('/pages');                                            
                    });
                }).catch((error) => {
                    this.errors = error.response.data.errors;
                });
            }
  }
};
</script>