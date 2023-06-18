<template>
	<nav aria-label="..." class="mb-20">
      <ul class="pagination">
        <li
          class="page-item"
          v-for="link in links"
          :class="{ active: link.label == page }"
          :key="link.label"
        >
          <span
            class="page-link"
            @click="changePage(link.label)"
            v-html="link.label"
          >
          </span>
        </li>
      </ul>
    </nav>
</template>

<script>
export default {
  data () {
    return {
    	page: "1",
      links: [],
    }
  },
  methods: {
    changePage(page) {
    	this.$emit("setLoading")
      this.page = page;

      this.$emit("getNewPageData", page);
    },
  }
}
</script>

<style lang="css" scoped>
</style>