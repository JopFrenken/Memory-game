import { createRouter, createWebHistory } from 'vue-router';
import Home from './views/HomePage.vue';
import Error from "./views/404.vue";

const routes = [
    {
        path: '/',
        name: 'Home',
        alias: ['/Memory-game'],
        component: Home
    },
    {
        path: '/:pathMatch(.*)*',
        name: "404",
        component: Error
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router