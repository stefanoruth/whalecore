require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import tinymce from 'tinymce/tinymce';
import 'tinymce/themes/modern/theme';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/link';
import 'tinymce/plugins/code';
import 'tinymce/plugins/table';
import 'tinymce/plugins/image';

window.Vue = Vue;
Vue.use(VueRouter);
Vue.use(tinymce);
Vue.component('modal', require('./components/Modal'));
Vue.component('tinymce', require('./components/TinyMCE'));
Vue.component('navigation', require('./components/Navbar'));
Vue.component('content-field', require('./content-builder/ContentField'));
Vue.component('content-field-simple', require('./content-builder/ContentFieldSimple'));
Vue.component('template-editor', require('./template-builder/TemplateEditor'));
Vue.component('template-field-item', require('./template-builder/FieldItem'));
Vue.component('template-field-edit', require('./template-builder/FieldEdit'));
Vue.component('template-field-new', require('./template-builder/FieldNew'));

Vue.filter('pretty', function(value) {
    return JSON.stringify(value, null, 2);
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router: new VueRouter({
        routes: require('./routes'),
    }),
});
