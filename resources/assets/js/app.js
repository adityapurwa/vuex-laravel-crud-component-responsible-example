/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

window.Vuex = require('vuex');
Vue.use(Vuex);
window.store = new Vuex.Store({
    state: {
        laravelToken: document.head.querySelector('meta[name="csrf-token"]').content
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

require('./modules/user-management/Module');

const app = new Vue({
    el: '#app',
    store: store
});
