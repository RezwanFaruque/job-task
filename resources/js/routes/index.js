import { createWebHistory, createRouter } from 'vue-router'


const router = createRouter({
    history: createWebHistory(),
    routes:[
        {
            path: '/',
            component:()=>import("@/pages/Home.vue")
        },

        {
            path: '/products',
            component:()=>import("@/pages/Products.vue")
        },

        {
            path: '/product/:id',
            component:()=>import("@/pages/EditProduct.vue")
        },

        {
            path: '/create-product',
            component:()=>import("@/pages/CreateProduct.vue")
        },
    ]
})


export default router;
