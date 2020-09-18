import Vue from 'vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import VueSweetalert2 from 'vue-sweetalert2';

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueSweetalert2);
Vue.config.ignoredElements = ['trix-editor', 'trix-toolbar'];
Vue.component('fecha-receta', require('./components/FechaReceta.vue').default);
Vue.component('eliminar-receta', require('./components/EliminarReceta.vue').default);

const app = new Vue({
    el: '#app',
});
