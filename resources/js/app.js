
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.VueAxios=require('vue-axios');
window.Axios = require('axios');

//progressbar import

import VueProgressBar from 'vue-progressbar' ;
import VueCharts from 'vue-chartjs'


//use progressbar

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '2px'
})

//Vform import
import { 
  Form,
  HasError,
  AlertError,
} from 'vform'

import Gate from "./Gate"
Vue.prototype.$gate = new Gate(window.user);

//momentjs import
import moment from 'moment' ;


import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify)
//vform call
window.Form = Form ;
//vform using
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));
//import vue table
import { TableComponent, TableColumn } from 'vue-table-component';
Vue.component('table-component', TableComponent);
Vue.component('table-column', TableColumn);

//import and using sweetalert and using
import Swal from 'sweetalert2';
window.swal = Swal ;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.Toast = Toast ;

//new instance 
let Fire = new Vue() ;

window.Fire = Fire ;

//import && use of vuerouter
import VueRouter from 'vue-router'
Vue.use(VueRouter , VueAxios , Axios)

//using of moment
Vue.filter('mydate' , function(created){
  return moment().format('LL');  
}); 

//routes


let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue') },
    { path: '/Absence', component: require('./components/Absence.vue') },
    { path: '/AbsenceNonJusifier', component: require('./components/AbsenceNonJusifier.vue') },
    { path: '/ConsulteAbsences', component: require('./components/ConsulteAbsences.vue') },
    { path: '/Conges', component: require('./components/Conges.vue') },
    { path: '/ConsulteConge', component: require('./components/ConsulteConge.vue') },
    { path: '/CongeAccepter', component: require('./components/CongeAccepter.vue') },
    { path: '/ConsulteCongeAdmin', component: require('./components/ConsultCongeAdmin.vue') },
    { path: '/Recrutements', component: require('./components/Recrutement.vue') },
    {path: '/RecrutementsAccepter', component: require('./components/RecrutementAccepter.vue') },
    { path: '/Employer', component: require('./components/Employe.vue') },
    { path: '/Profiles', component: require('./components/Profile.vue') },
   

  ]

  const router = new VueRouter({  
    routes // short for `routes: routes`
  })

 
  Vue.component('not-found', require('./components/NotFound.vue'));
  Vue.component('statisticConge', require('./components/statisticConge.vue'));
  Vue.component('', require('./components/Notification.vue'));
  
  Vue.component('Conges', require('./components/Conges.vue'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

//Vue.component('Articles', require('./components/Articles.vue'));



// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('line-chart', {
//   extends: VueCharts.Line,
//   mounted () {
//     this.renderChart({
//       labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
//       datasets: [
//         {
//           label: 'Data One',
//           backgroundColor: '#f87979',
//           data: [40, 39, 10, 40, 39, 80, 40]
//         }
//       ]
//     }, {responsive: true, maintainAspectRatio: false})
//   }
  
// })



const app = new Vue({
    el: '#app' , 
    router,
    data:{
      search :''
    },
    methods : {
      searchit : _.debounce(() => {
        Fire.$emit('searching');
      }, 1000)
    },
    
});


