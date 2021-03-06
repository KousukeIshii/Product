/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import VueRouter from 'vue-router'

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.use(VueRouter);

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('search-query',require('./components/SearchQuery.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import index from './components/index.vue'
import create from './components/create.vue'
import show from './components/show.vue'
import update from './components/update.vue'
import search from './components/search.vue'
//

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/spa', component: index },
        { path: '/spa/create', component: create},
        { path: '/spa/show/:id', component: show},
        { path: '/spa/update/:id', component: update},
        { path: '/spa/search', component: search},
    ]
})

const app = new Vue({
    router,
    el: '#app'
})
