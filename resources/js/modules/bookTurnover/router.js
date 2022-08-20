export default [
    {
        path: '/book-turnovers',
        name: 'bookTurnover.index',
        component: () => import('./views/index.vue'),
        meta: {
            middlewares: ['auth']
        }
    },
    {
        path: '/book-turnovers',
        name: 'bookTurnover.form',
        component: () => import('./views/form.vue'),
        meta: {
            middlewares: ['auth']
        }
    }
]
