<template>
  <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">FOSNAS</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">Fn</a>
      </div>

      <!-- untuk super admin -->
      <ul class="sidebar-menu" v-if="role == 'super admin'">
        <li @click="activate('/')" :class="{ active: activeEl == '/' }">
          <router-link class="nav-link" to="/">
            <i class="fas fa-home"></i>
            <span>Home</span>
          </router-link>
        </li>
        <li
          @click="activate('/dashboard')"
          :class="{ active: activeEl == '/dashboard' }"
        >
          <router-link class="nav-link" to="/dashboard">
            <i class="fas fa-fire"></i>
            <span>Dashboard</span>
          </router-link>
        </li>
        <li
          @click="activate('/schools')"
          :class="{ active: activeEl == '/schools' }"
        >
          <router-link class="nav-link" to="/schools">
            <i class="fas fa-school"></i>
            <span>Sekolah</span>
          </router-link>
        </li>
        <li
          @click="activate('/users')"
          :class="{ active: activeEl == '/users' }"
        >
          <router-link class="nav-link" to="/users">
            <i class="far fa-user"></i>
            <span>User</span>
          </router-link>
        </li>
        <li
          @click="activate('/tasks')"
          :class="{ active: activeEl == '/tasks' }"
        >
          <router-link class="nav-link" to="/tasks">
            <i class="fas fa-tasks"></i>
            <span>Proker</span>
          </router-link>
        </li>
        <li
          @click="activate('/activities')"
          :class="{ active: activeEl == '/activities' }"
        >
          <router-link class="nav-link" to="/activities">
            <i class="fas fa-chart-line"></i>
            <span>Aktifitas</span>
          </router-link>
        </li>
        <!-- <li
          @click="activate('/artikel')"
          :class="{ active: activeEl == '/artikel' }"
        >
          <router-link class="nav-link" to="/artikel">
            <i class="far fa-newspaper"></i>
            <span>Artikel</span>
          </router-link>
        </li> -->
      </ul>

      <!-- Untuk admin sekolah -->
      <ul class="sidebar-menu" v-else-if="role == 'admin sekolah'">
        <li @click="activate('/')" :class="{ active: activeEl == '/' }">
          <router-link class="nav-link" to="/">
            <i class="fas fa-home"></i>
            <span>Home</span>
          </router-link>
        </li>
        <li
          @click="activate('/dashboard')"
          :class="{ active: activeEl == '/dashboard' }"
        >
          <router-link class="nav-link" to="/dashboard">
            <i class="fas fa-fire"></i>
            <span>Dashboard</span>
          </router-link>
        </li>
        <li
          @click="activate('/users')"
          :class="{ active: activeEl == '/users' }"
        >
          <router-link class="nav-link" to="/users">
            <i class="far fa-user"></i>
            <span>User</span>
          </router-link>
        </li>
        <li
          @click="activate('/tasks')"
          :class="{ active: activeEl == '/tasks' }"
        >
          <router-link class="nav-link" to="/tasks">
            <i class="fas fa-tasks"></i>
            <span>Proker</span>
          </router-link>
        </li>
        <li
          @click="activate('/activities')"
          :class="{ active: activeEl == '/activities' }"
        >
          <router-link class="nav-link" to="/activities">
            <i class="fas fa-chart-line"></i>
            <span>Aktifitas</span>
          </router-link>
        </li>
        <li
          @click="activate('/freeagents')"
          :class="{ active: activeEl == '/freeagents' }"
        >
          <router-link class="nav-link" to="/freeagents">
            <i class="far fa-id-badge"></i>
            <span>Free Agent</span>
          </router-link>
        </li>
        <li
          @click="activate('/schools')"
          :class="{ active: activeEl == '/schools' }"
        >
          <router-link class="nav-link" to="/schools">
            <i class="fas fa-school"></i>
            <span>Sekolah</span>
          </router-link>
        </li>
        <!-- <li
          @click="activate('/artikel')"
          :class="{ active: activeEl == '/artikel' }"
        >
          <router-link class="nav-link" to="/artikel">
            <i class="far fa-newspaper"></i>
            <span>Artikel</span>
          </router-link>
        </li> -->
      </ul>

      <!-- Untuk pengurus osis -->
      <ul class="sidebar-menu" v-else-if="role == 'pengurus osis'">
        <li @click="activate('/')" :class="{ active: activeEl == '/' }">
          <router-link class="nav-link" to="/">
            <i class="fas fa-home"></i>
            <span>Home</span>
          </router-link>
        </li>
        <li
          @click="activate('/dashboard')"
          :class="{ active: activeEl == '/dashboard' }"
        >
          <router-link class="nav-link" to="/dashboard">
            <i class="fas fa-fire"></i>
            <span>Dashboard</span>
          </router-link>
        </li>
        <li
          @click="activate('/users')"
          :class="{ active: activeEl == '/users' }"
        >
          <router-link class="nav-link" to="/users">
            <i class="far fa-user"></i>
            <span>User</span>
          </router-link>
        </li>
        <li
          @click="activate('/tasks')"
          :class="{ active: activeEl == '/tasks' }"
        >
          <router-link class="nav-link" to="/tasks">
            <i class="fas fa-tasks"></i>
            <span>Proker</span>
          </router-link>
        </li>
        <li
          @click="activate('/activities')"
          :class="{ active: activeEl == '/activities' }"
        >
          <router-link class="nav-link" to="/activities">
            <i class="fas fa-chart-line"></i>
            <span>Aktifitas</span>
          </router-link>
        </li>
        <li
          @click="activate('/schools')"
          :class="{ active: activeEl == '/schools' }"
        >
          <router-link class="nav-link" to="/schools">
            <i class="fas fa-school"></i>
            <span>Sekolah</span>
          </router-link>
        </li>
        <!-- <li
          @click="activate('/artikel')"
          :class="{ active: activeEl == '/artikel' }"
        >
          <router-link class="nav-link" to="/artikel">
            <i class="far fa-newspaper"></i>
            <span>Artikel</span>
          </router-link>
        </li> -->
      </ul>

      <!-- untuk anggota -->
      <ul class="sidebar-menu" v-else-if="role == 'anggota'">
        <li @click="activate('/')" :class="{ active: activeEl == '/' }">
          <router-link class="nav-link" to="/">
            <i class="fas fa-home"></i>
            <span>Home</span>
          </router-link>
        </li>
        <li
          @click="activate('/dashboard')"
          :class="{ active: activeEl == '/dashboard' }"
        >
          <router-link class="nav-link" to="/dashboard">
            <i class="fas fa-fire"></i>
            <span>Dashboard</span>
          </router-link>
        </li>
        <li
          @click="activate('/schools')"
          :class="{ active: activeEl == '/schools' }"
        >
          <router-link class="nav-link" to="/schools">
            <i class="fas fa-school"></i>
            <span>Sekolah</span>
          </router-link>
        </li>
        <li
          @click="activate('/users')"
          :class="{ active: activeEl == '/users' }"
          v-if="school != 1"
        >
          <router-link class="nav-link" to="/users">
            <i class="far fa-user"></i>
            <span>User</span>
          </router-link>
        </li>
        <li
          @click="activate('/tasks')"
          :class="{ active: activeEl == '/tasks' }"
          v-if="school != 1"
        >
          <router-link class="nav-link" to="/tasks">
            <i class="fas fa-tasks"></i>
            <span>Proker</span>
          </router-link>
        </li>
        <li
          @click="activate('/activities')"
          :class="{ active: activeEl == '/activities' }"
          v-if="school != 1"
        >
          <router-link class="nav-link" to="/activities">
            <i class="fas fa-chart-line"></i>
            <span>Aktifitas</span>
          </router-link>
        </li>
        <!-- <li
          @click="activate('/artikel')"
          :class="{ active: activeEl == '/artikel' }"
        >
          <router-link class="nav-link" to="/artikel">
            <i class="far fa-newspaper"></i>
            <span>Artikel</span>
          </router-link>
        </li> -->
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a
          href="https://drive.google.com/drive/u/1/folders/19bZB74Wk9Gq41VeiWJDpfILwJZljNfTr"
          target="_blank"
          class="btn btn-primary btn-lg btn-block btn-icon-split"
        >
          <i class="fas fa-rocket"></i> Documentation
        </a>
      </div>
    </aside>
  </div>
</template>

<script>
export default {
  props: ["role", "school"],
  data() {
    return {
      activeEl: window.location.pathname,
    };
  },
  methods: {
    activate(el) {
      this.activeEl = el;
    },
  },
};
</script>

<style>
</style>