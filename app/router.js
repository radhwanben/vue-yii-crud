import {createRouter, createWebHistory} from 'vue-router';
import ProductList from './components/ProductList';
import Productitem from './components/Productitem';
import ProductForm from './components/ProductForm';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'products',
            path: '/',
            component: ProductList,
        },
        {
            name: 'product-form',
            path: '/product/edit/:productId?',
            component: ProductForm,
            props: true,
            alias: '/product/add'
        },
        {
            name: 'product-item',
            path: '/product/:productId(\\d+)',
            component: Productitem,
            props: true
        },
    ],
});

export default router;
