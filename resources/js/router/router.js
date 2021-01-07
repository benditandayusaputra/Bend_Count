import Vue from 'vue';
import Router from 'vue-router'
import store from '../store/index'

// Component
import Login from '../views/auth/Login'
import Register from '../views/auth/Register'
import Dashboard from '../views/dashboard/Index'

Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login
        }, 
        {
            path: '/register',
            name: 'register',
            component: Register
        }, 
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard,
            meta: {requiresAuth: true}
        }
    ]
})

router.beforeEach((to, from, next) => {
    if ( to.matched.some(record => record.meta.requiresAuth) ) {
        let auth = store.getters.isAuth
        if ( !auth ) {
            next({name: "login"})
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router