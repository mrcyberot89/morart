import { createRouter, createWebHistory } from 'vue-router';
import HomePages from '@/components/HomePages.vue';

const routes = [
    {
        path: "/",
        name: "Home",
        component: HomePages
    },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;