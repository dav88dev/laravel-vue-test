import store from "./store";
import Vue from 'vue';
import VueRouter from 'vue-router';
import {routes} from './routes'
import AppComponent from './components/AppComponent.vue'


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'open active',
    scrollBehavior: () => ({y: 0}),
    routes,
})


router.beforeEach((to, from, next) => {

    // check if the route requires authentication and user is not logged in
    if (to.matched.some(route => route.meta.requiresAuth) && !store.state.isLoggedIn) {
        // redirect to login page
        next({name: 'login'})
        return
    }

    // if logged in redirect to dashboard
    if (to.path === '/login' && store.state.isLoggedIn) {
        next({name: 'dashboard'})
        return
    }

    next()
})

new Vue({
    el: '#app',
    components: {
        AppComponent
    },
    router
});
