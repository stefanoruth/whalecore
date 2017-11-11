require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

window.Vue = Vue;
Vue.use(VueRouter);
Vue.component('modal', require('./components/Modal'));
Vue.component('navigation', require('./components/Navbar'));
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        showNavbar: true,
    },
    router: new VueRouter({
        routes: require('./routes'),
    }),
});
