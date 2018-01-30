require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
window.Vue = Vue;
Vue.config.productionTip = false;
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#sales',
    router: new VueRouter({
        routes: [
            {
                path: '/',
                component: require('./views/Welcome'),
            }
        ]
    }),
});