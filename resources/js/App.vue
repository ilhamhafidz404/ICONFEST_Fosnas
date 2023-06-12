<template>
  <div class="main-wrapper main-wrapper-1">
    <navbar :data="data"></navbar>
    <sidebar :role="data.roles[0].name"></sidebar>
    <router-view :role="data.roles[0].name" :data="data"></router-view>
    <!-- <feet></feet> -->
  </div>
</template>

<script>
export default {
  props: ["data"],
};
</script>

<style>
</style>