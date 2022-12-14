export default [
    {
        path: '/users',
        name: 'user.index',
        component: () => import('./views/index.vue'),
        meta: {
            middlewares: ['auth','admin']
        }
    },
    {
        path: '/users',
        name: 'user.form',
        component: () => import('./views/form.vue'),
        meta: {
            middlewares: ['auth','admin']
        }
    }
]
