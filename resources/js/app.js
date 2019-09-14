import './bootstrap'
import Vue from 'vue'
import VueRouter from 'vue-router'
import router from './routes'
import store from './store'

window.Vue = Vue
Vue.use(VueRouter)

new Vue({
    el: '#app',
    router,
    store
})
