import VueRouter from 'vue-router'
import Home from './components/HomeComponent.vue'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home
    },
    { path: '/login', component: () => import('./components/Login.vue') }
]

export default new VueRouter({
    hashbang: false,
    mode: 'history',
    base: '/',
    fallback: true,
    routes
})
