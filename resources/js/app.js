require('./bootstrap');

import Vue from 'vue'
import router from './router/router'
import store from './store/index'
import App from './App.vue'
import VueSweetalert2 from 'vue-sweetalert2'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueSweetalert2)

new Vue({
    el: '#app',
    router,
    store,
    components: {
        App
    }
})
