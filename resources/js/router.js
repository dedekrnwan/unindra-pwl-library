import { createRouter, createWebHistory } from 'vue-router'
import book from './modules/book/router'
import dashboard from './modules/dashboard/router'
import user from './modules/user/router'
import userLoan from './modules/userLoan/router'
import bookTurnover from './modules/bookTurnover/router'
import auth from './modules/auth/router'

import store from './store'

const router = createRouter({
    routes: [
        ...book,
        ...user,
        ...dashboard,
        ...userLoan,
        ...bookTurnover,
        ...auth,
    ],
    history: createWebHistory()

})
router.beforeEach((to, from, next) => {
    if (to.meta.middlewares?.includes("admin")) {
        if (store.getters['auth/isLoggedIn'] && store.getters['auth/isAdmin']) {
            next();
        } else {
            next('/');
        }
    } else if (to.meta.middlewares?.includes("auth")) {
        //check localstorage
        if (store.getters['auth/isLoggedIn']) {
            next();
        } else {
            next('/login');
        }
    } else if(to.meta.auth && store.getters['auth/isLoggedIn']) {
        next('/');
    }

    next();
})
export default router
