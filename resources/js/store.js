import { createStore } from "vuex";
import dashboard from './modules/dashboard/store';
import book from './modules/book/store';
import user from './modules/user/store';
import userLoan from './modules/userLoan/store';
import bookTurnover from './modules/bookTurnover/store';

export default createStore({
    state: {},
    mutations: {},
    actions: {},
    modules: {
        dashboard,
        book,
        user,
        userLoan,
        bookTurnover,
    },
    devtools: true,
})
