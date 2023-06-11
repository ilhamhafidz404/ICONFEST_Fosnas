<template>
  <div>
    <h1>LARAVUE for ICONFEST</h1>
    <router-link to="/home">ke Home</router-link>
    <router-link to="/about">ke About</router-link>
    <example-component></example-component>
    <router-view></router-view>
  </div>
</template>

<script>
import ExampleComponent from "./components/ExampleComponent.vue";
export default {
  components: [ExampleComponent],
};
</script>

<style>
</style>