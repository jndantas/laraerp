/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
moment.locale("pt-BR");
import { Form, HasError, AlertError } from 'vform';

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);


import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.Toast = Toast;

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})


import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';
import 'select2';

const router = new VueRouter({
    mode: 'history'
})

$(function() {
    $(".select2").select2({
        width: 'resolve', // need to override the changed default
        theme: "classic"
    });
});


Vue.mixin({
    methods: {
        route: route
    }
});

$(function() {
    $("#datepicker").datepicker({
        showOn: "focus",
        dateFormat: "dd/mm/yy",
        dayNames: ["Domingo", "Segunda", "Terça", "Quarte", "Quinta", "Sexta", "Sábado"],
        dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
        monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
    });
});

Vue.filter('upText', function(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

Vue.filter('myDate', function(created) {
    return moment(created).format('LL');
});

Vue.filter('myHour', function(created) {
    return moment(created).format('LTS');
});

window.Fire = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
    'not-found',
    require('./components/NotFound.vue').default
);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('sesmt-category', require('./components/sesmt/Category.vue').default);


Vue.component('profile', require('./components/Profile.vue').default);
Vue.component('developer', require('./components/Developer.vue').default);
Vue.component('users', require('./components/Users.vue').default);
Vue.component('sesmt-accident', require('./components/sesmt/Accident.vue').default);
Vue.component('sesmt-employee', require('./components/sesmt/Employee.vue').default);
Vue.component('sesmt-certificate', require('./components/sesmt/Certificate.vue').default);
Vue.component('sesmt-enterprise', require('./components/sesmt/Enterprise.vue').default);
Vue.component('sesmt-exam', require('./components/sesmt/Exam.vue').default);
Vue.component('sesmt-input', require('./components/sesmt/Input.vue').default);
Vue.component('sesmt-output', require('./components/sesmt/Output.vue').default);
Vue.component('sesmt-position', require('./components/sesmt/Position.vue').default);
Vue.component('sesmt-product', require('./components/sesmt/Product.vue').default);
Vue.component('sesmt-training', require('./components/sesmt/Training.vue').default);
Vue.component('sesmt-typeaccident', require('./components/sesmt/TypeAccident.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});