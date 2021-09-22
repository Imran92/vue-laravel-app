import AllProduct from './components/List.vue';
import CreateProduct from './components/Add.vue';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllProduct,
        meta: {
            requiresAuth: false,
        },
    },
    {
        name: 'create',
        path: '/create',
        component: CreateProduct,
        meta: {
            requiresAuth: true,
        },
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: CreateProduct,
        meta: {
            requiresAuth: true,
        },
    }
];
