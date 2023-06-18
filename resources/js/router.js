import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "./views/Dashboard.vue";
import Home from "./views/Home.vue";

// admin
import DashboardAdmin from "./views/Admin/DashboardAdmin.vue";

// admin sekolah
import DashboardSekolah from "./views/Sekolah/DashboardSekolah.vue";
import UserIndexSekolah from "./views/Sekolah/UserIndex.vue";
import AddArticle from "./views/Sekolah/AddArticle.vue";

// user
import UserIndex from "./views/UserIndex.vue";

// pengurus osis
import DahsboardPengurus from "./views/Pengurus/DashboardPengurus.vue";

// anggota
import DashboardAnggota from "./views/Anggota/DashboardAnggota.vue";

// route for all
import ArtikelIndex from "./views/ArtikelIndex.vue";
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

    // url pengurus
    { path: "/pengurus/dashboard", component: DahsboardPengurus },
    // { path: "/pengurus/users", component: UserIndexSekolah },

    // url anggota
    { path: "/anggota/dashboard", component: DashboardAnggota },
    // { path: "/anggota/users", component: UserIndexSekolah },

    // url admin sekolah
    { path: "/admin/dashboard", component: DashboardSekolah },
    // { path: "/admin/users", component: UserIndexSekolah },
    { path: "/admin/articles/add", component: AddArticle },

    // url super admin
    { path: "/dashboard", component: DashboardAdmin },

    // khusus
    { path: "/freeagents", component: FreeAgent },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
