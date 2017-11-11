<template>
    <div class="flex h-screen justify-center items-center" id="dashboard">
        
        <div v-for="site in sites" :key="site.id" class="w-48 h-48 cursor-pointer rounded overflow-hidden bg-white shadow-lg m-4" @click="loginToSite(site.id)">
            <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ site.title }}</div>
            </div>
        </div>

        <div class="w-48 h-48 cursor-pointer rounded overflow-hidden bg-white shadow-lg m-4" @click="showNewSiteModal = true">
            <div class="flex justify-center items-center h-full">
                <div class="font-bold text-xl mb-2">New site</div>
            </div>
        </div>
        <new-site-modal :show="showNewSiteModal" @close="showNewSiteModal = false"></new-site-modal>
    </div>
</template>
<script>
export default {
  data() {
    return {
      showNewSiteModal: false,
      sites: []
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
          //Add login
      });
    }
  }
};
</script>