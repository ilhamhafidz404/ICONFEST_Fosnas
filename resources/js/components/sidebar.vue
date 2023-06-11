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
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="#" class="nav-link has-dropdown"
            ><i class="fas fa-fire"></i><span>Dashboard</span></a
          >
          <ul class="dropdown-menu">
            <li>
              <router-link class="nav-link" to="/dashboard"
                >General Dashboard</router-link
              >
            </li>
            <li class="active">
              <router-link class="nav-link" to="/about"
                >Ecommerce Dashboard</router-link
              >
            </li>
          </ul>
        </li>
        <li class="menu-header">Starter</li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"
            ><i class="fas fa-columns"></i> <span>Layout</span></a
          >
          <ul class="dropdown-menu">
            <li>
              <a class="nav-link" href="layout-default.html">Default Layout</a>
            </li>
            <li>
              <a class="nav-link" href="layout-transparent.html"
                >Transparent Sidebar</a
              >
            </li>
            <li>
              <a class="nav-link" href="layout-top-navigation.html"
                >Top Navigation</a
              >
            </li>
          </ul>
        </li>
        <li>
          <a class="nav-link" href="blank.html"
            ><i class="far fa-square"></i> <span>Blank Page</span></a
          >
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
export default {};
</script>

<style>
</style>