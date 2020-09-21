import Vue from 'vue';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import 'owl.carousel';

import VueSweetalert2 from 'vue-sweetalert2';

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueSweetalert2);
Vue.config.ignoredElements = ['trix-editor', 'trix-toolbar'];

Vue.component('fecha-receta', require('./components/FechaReceta.vue').default);
Vue.component('eliminar-receta', require('./components/EliminarReceta.vue').default);
Vue.component('like-button', require('./components/LikeButton.vue').default);

const app = new Vue({
    el: '#app',
});

// Carousel con OWL

jQuery(document).ready(function() {

    jQuery('.owl-carousel').owlCarousel({
        margin: 10,
        loop: true,
        autoplay: true,
        autoplayHoverPause: true,
        responsive: {
            0 : {
                items: 1
            },
            600 : {
                items: 2
            },
            1000 : {
                items: 3
            },
        }
    });

});
