/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Tasks from "./components/Organization/Tasks";


require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import Profile from "./components/Organization/Profile";
import Dashboard from "./components/Organization/Dashboard";
import Users from "./components/Organization/Users";
import NotFound from "./components/NotFound";
import VueRouter from 'vue-router';
import { Form, HasError, AlertError } from 'vform';
import VueProgressBar from 'vue-progressbar'
import swal from 'sweetalert2';
import Swal from "sweetalert2";

window.Swal = Swal;
window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.use(VueRouter)

Vue.component('pagination', require('laravel-vue-pagination'));

const routes = [
    { path: '/org/dashboard', component: Dashboard },
    { path: '/org/profile', component: Profile },
    { path: '/org/users', component: Users },
    { path: '/org/tasks', component: Tasks },
    { path: '*', component: NotFound}

];


Vue.filter('upText',function (value) {
    return value.charAt(0).toUpperCase() + value.slice(1)
});
Vue.filter('myDate',function (date) {
    return moment(date).format('MMM Do YYYY')
});

window.Fire = new Vue();



const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.6s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}

Vue.use(VueProgressBar, options)

/*
The default mode for vue-router is hash mode - it uses the URL hash to simulate a full URL so that the page won't be reloaded when the URL changes.
To get rid of the hash, we can use the router's history mode, which leverages the history.pushState API to achieve URL navigation without a page reload
 */
const router = new VueRouter({
    mode: 'history',

    routes // short for `routes: routes`
})



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

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
    require('./components/NotFound.vue')
);

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router
}).$mount('#app')

