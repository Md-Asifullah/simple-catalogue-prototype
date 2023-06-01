import { createRouter, createWebHistory } from "vue-router";
import catalogueIndex from "../components/catalogue/index.vue";
import orderIndex from "../components/orders/index.vue";
import notFound from "../components/NotFound.vue";
import addToCart from "../components/catalogue/addToCart.vue";

const routes = [
    {
        path: "/",
        component: catalogueIndex,
    },
    {
        path: "/addToCart/:id",
        name: "cart",
        component: addToCart,
    },
    {
        path: "/orders",
        name: "order",
        component: orderIndex,
    },
    {
        path: "/:pathMatch(.*)*",
        component: notFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
