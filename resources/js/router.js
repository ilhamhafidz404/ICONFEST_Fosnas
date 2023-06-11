import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "./views/Dashboard.vue";
import About from "./views/About.vue";

const routes = [
    { path: "/dashboard", component: Dashboard },
    { path: "/about", component: About },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
