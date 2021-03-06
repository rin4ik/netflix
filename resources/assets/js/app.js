import VModal from 'vue-js-modal';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.events = new Vue();
window.flash = function(message, level = 'success') {
        window.events.$emit('flash', { message, level });
    }
    /**
     * Next, we will create a fresh Vue application instance and attach it to
     * the page. Then, you may begin adding components to this application
     * or customize the JavaScript scaffolding to fit your unique needs.
     */
Vue.component('flash', require('./components/Flash.vue'));
Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));
Vue.component('video-upload', require('./components/VideoUpload.vue'));
Vue.component('edit', require('./components/Edit.vue'));
Vue.component('video-player', require('./components/VideoPlayer.vue'));
Vue.use(VModal);
const app = new Vue({
    el: '#app'
});