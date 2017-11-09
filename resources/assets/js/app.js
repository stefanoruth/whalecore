
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.component('modal', require('./components/Modal'));
Vue.component('new-site-modal', require('./components/NewSiteModal'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if (document.getElementById('navbar') != null) {
    new Vue({
        el: '#navbar',
        name: 'NavBar',
        data: {
            mobile: false,
        },
    });
}

const app = new Vue({
    el: '#app',
    data: {
        showNewSiteModal: false,
    },

    methods: {
        loginToSite(SiteId) {
            axios.post(route('tenant.store'), {siteId: SiteId}).then((response) => {
                window.location = route('pages.index');
            });
        }
    }
});
