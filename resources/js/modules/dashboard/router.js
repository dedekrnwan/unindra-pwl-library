export default [
    {
        path: '/',
        name: 'dashboard.index',
        component: () => import('./views/index.vue'),
        meta: {
            middlewares: ['auth']
        }
    }
]
