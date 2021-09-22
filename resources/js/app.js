require('./bootstrap');
import vue from 'vue'
import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import {routes} from './routes';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';
import Form from 'vform';
import Swal from 'sweetalert2'
import { VueEditor } from "vue2-editor";
import VuePdfEmbed from 'vue-pdf-embed/dist/vue2-pdf-embed';
import { store } from './store/store'

window.Vue = vue;

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

Vue.component('v-select', vSelect);
Vue.component(VueEditor.name, VueEditor);
Vue.component(VuePdfEmbed.name, VuePdfEmbed);

window.Swal = Swal
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast
window.Form = Form;

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (store.getters.isAdmin) {
            next()
        } else {
            next('/')
        }
    } else {
        next()
    }
})
const app = new Vue({
    el: '#app',
    store,
    router: router,
    render: h => h(App),
});
