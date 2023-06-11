<template>
  <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">FOSNAS</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">Fn</a>
      </div>
      <ul class="sidebar-menu">
        <li @click="activate('/')" :class="{ active: activeEl == '/' }">
          <router-link class="nav-link" to="/">
            <i class="fas fa-fire"></i>
            <span>Dashboard</span>
          </router-link>
        </li>
        <li @click="activate('/users')" :class="{ active: activeEl == '/users' }">
          <router-link class="nav-link" to="/users">
            <i class="far fa-user"></i>
            <span>User</span>
          </router-link>
        </li>
        <li @click="activate('/schools')" :class="{ active: activeEl == '/schools' }">
          <router-link class="nav-link" to="/schools">
            <i class="fas fa-school"></i>
            <span>Sekolah</span>
          </router-link>
        </li>
      </ul>

      <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
        <a
          href="https://getstisla.com/docs"
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