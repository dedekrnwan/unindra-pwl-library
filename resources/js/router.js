import { createRouter, createWebHistory } from 'vue-router'
import book from './modules/book/router'
import dashboard from './modules/dashboard/router'
import user from './modules/user/router'
import userLoan from './modules/userLoan/router'
import bookTurnover from './modules/bookTurnover/router'

export default createRouter({
    routes: [
        ...book,
        ...user,
        ...dashboard,
        ...userLoan,
        ...bookTurnover,
    ],
    history: createWebHistory()
})
