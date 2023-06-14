<template>
  <div class="main-content">
    <section v-if="!loading" class="section">
      <div class="section-header">
        <h1>Default Layout</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Layout</a></div>
          <div class="breadcrumb-item">Default Layout</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">This is Example Page</h2>
        <p class="section-lead">
          This page is just an example for you to create your own page.
        </p>
        <div class="card">
          <div class="card-header">
            <h4>{{ article.title }}</h4>
          </div>
          <div class="card-body">
            <p v-html="article.body"></p>
          </div>
          <div class="card-footer bg-whitesmoke">This is card footer</div>
        </div>
      </div>
    </section>
    <div v-else class="text-center h-[500px]">
      <div
        class="loader absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
      ></div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      article: {
        title: "",
        body: "",
      },

      // loading
      loading: true,
    };
  },
  mounted() {
    axios
      .get("http://127.0.0.1:8000/api/articles/" + this.$route.params.slug)
      .then((res) => {
        this.article.title = res.data.title;
        this.article.body = res.data.body;

        //
        this.loading = false;
      });
  },
};
</script>

<style>
.loader {
  border: 10px solid #f3f3f3; /* Light grey */
  border-top: 10px solid #6777ef; /* Blue */
  border-radius: 50%;
  width: 70px;
  height: 70px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>