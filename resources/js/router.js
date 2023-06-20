import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "./views/Dashboard.vue";
import Home from "./views/Home.vue";

// route for all
import ArtikelIndex from "./views/ArtikelIndex.vue";
import UserIndex from "./views/UserIndex.vue";
import ShowArtikel from "./views/ShowArtikel.vue";
import TaskIndex from "./views/TaskIndex.vue";
import ActivityIndex from "./views/ActivityIndex.vue";
import SchoolIndex from "./views/SchoolIndex.vue";

// khusus
import FreeAgent from "./views/_FreeAgent.vue";

const routes = [
    { path: "/", component: Home },

    // route for all
    { path: "/artikel", component: ArtikelIndex },
    { path: "/artikel/:slug", component: ShowArtikel },
    { path: "/users", component: UserIndex },
    { path: "/tasks", component: TaskIndex },
    { path: "/activities", component: ActivityIndex },
    { path: "/schools", component: SchoolIndex },
    { path: "/dashboard", component: Dashboard },

    // khusus
    { path: "/freeagents", component: FreeAgent },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
