export default [
    {
        path: '/books',
        name: 'book.index',
        component: () => import('./views/index.vue'),
        meta: {
            middlewares: ['auth']
        }
    },
    {
        path: '/books',
        name: 'book.form',
        component: () => import('./views/form.vue'),
        meta: {
            middlewares: ['auth']
        }
    }
]
