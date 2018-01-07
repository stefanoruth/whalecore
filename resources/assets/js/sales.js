require('./bootstrap');

import Vue from 'vue';
window.Vue = Vue;
Vue.config.productionTip = false;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#sales',
    data() {
        return {
            mail: null,
            successMsg: null,
            errorMsg: null,
        }
    },

    methods: {
        subscribe() {
            axios.post('mail/subscribe', {
                mail: this.mail
            }).then(response => {
                this.errorMsg = null;
                this.successMsg = 'Thanks for signing up.';
            }).catch(error => {
                this.successMsg = null;
                this.errorMsg = error.response.data.errors.mail[0];
            });
        },
    },
});