import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "./views/Dashboard.vue";
import About from "./views/About.vue";

// school
import SchoolIndex from "./views/school/Index.vue";

// user
import UserIndex from "./views/user/Index.vue"

const routes = [
    { path: "/", component: Dashboard },
    { path: "/about", component: About },

    // school
    { path: "/schools", component: SchoolIndex },
    
    // user
    { path: "/users", component: UserIndex },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
