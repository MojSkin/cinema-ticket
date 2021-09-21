require('./bootstrap');

import Vue from 'vue';
import helpers from './plugins/helpers';
import swal from 'vue-sweetalert2';
import Toasted from 'vue-toasted';

Vue.use(Toasted);
Vue.use(swal);

window.EventBus = new Vue();

// *************************************************************************
// Admin Panel Menu Components
// *************************************************************************

// Home
Vue.component('register-component', require('./components/Auth/RegisterComponent').default);
Vue.component('login-component', require('./components/Auth/LoginComponent').default);

Vue.component('movie-detail-component', require('./components/MovieDetailComponent').default);
Vue.component('tickets-report-component', require('./components/TicketsReportComponent').default);
// Vue.component('home-component', require('./components/HomeComponent').default);

// *************************************************************************
// General Components
// *************************************************************************

Vue.prototype.$helpers = helpers;
window.Vue = Vue

const app = new Vue({
    el: '#app',
    swal,
});
