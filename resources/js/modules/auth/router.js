export default [
    {
        path: '/login',
        name: 'auth.login',
        component: () => import('./views/login.vue'),
        meta: {
            auth: true
        }
    },
]
