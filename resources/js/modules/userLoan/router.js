export default [
    {
        path: '/user-loans',
        name: 'userLoan.index',
        component: () => import('./views/index.vue'),
        meta: {
            middlewares: ['auth']
        }
    },
    {
        path: '/user-loans',
        name: 'userLoan.form',
        component: () => import('./views/form.vue'),
        meta: {
            middlewares: ['auth']
        }
    }
]
