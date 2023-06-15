<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Artikel</h1>
        <div class="section-header-breadcrumb">
          <div class="flex align-items-center justify-content-center">
            <div class="mr-3">
              <form action="" @submit.prevent="filteredSearch">
                <div class="relative">
                  <input
                    type="text"
                    class="border border-red-500 rounded p-[10px] bg-gray-50 w-[300px]"
                    v-model="filterSearch"
                  />
                  <span
                    class="absolute right-0 top-1/2 -translate-y-1/2 mr-[10px]"
                  >
                    <i class="fas fa-search"></i>
                  </span>
                </div>
              </form>
            </div>
            <div>
              <router-link to="/admin/articles/add" class="btn btn-primary"
                >Tambah Artikel</router-link
              >
              <router-link
                to="/admin/articles/add"
                class="btn btn-info ml-3"
                v-if="role != 'super admin'"
              >
                Lihat Artikel Saya
              </router-link>
            </div>
          </div>
        </div>
      </div>
      <!--  -->
      <div class="section-body">
        <div v-if="!loading" class="row">
          <div
            v-for="article in articles"
            :key="article.id"
            class="col-12 col-md-4 col-lg-4"
          >
            <article class="article article-style-c">
              <div class="article-header">
                <div
                  class="article-image"
                  data-background="../../../public/template/img/news/img13.jpg"
                ></div>
              </div>
              <div class="article-details">
                <div class="article-category">
                  <a href="#">News</a>
                  <div class="bullet"></div>
                  <a href="#">{{ diffForHuman(article.created_at) }}</a>
                </div>
                <div class="article-title">
                  <h2>
                    <router-link :to="'/artikel/' + article.slug">{{
                      article.title
                    }}</router-link>
                  </h2>
                </div>
                <p v-html="limitString(article.body, 150)"></p>
                <div class="article-user">
                  <img
                    alt="image"
                    src="../../../public/template/img/avatar/avatar-1.png"
                  />
                  <div class="article-user-details">
                    <div class="user-detail-name">
                      <a href="#">INI NAMA GROUP</a>
                    </div>
                    <div class="text-job">{{ article.school.name }}</div>
                  </div>
                </div>
              </div>
            </article>
          </div>
        </div>
        <div v-else class="text-center h-[500px]">
          <div
            class="loader absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
          ></div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
export default {
  props: ["role"],
  data() {
    return {
      articles: [],

      //
      filterSearch: "",
      loading: true,
    };
  },
  methods: {
    filteredSearch() {
      if (this.filterSearch != "") {
        axios
          .get("http://127.0.0.1:8000/api/articles?search=" + this.filterSearch)
          .then((res) => {
            this.loading = false;
            this.articles = res.data;
          });
      } else {
        axios.get("http://127.0.0.1:8000/api/articles").then((res) => {
          this.loading = false;
          this.articles = res.data;
        });
      }
    },

    //
    limitString(str, limit) {
      if (str.length > limit) {
        return str.substring(0, limit) + "...";
      } else {
        return str;
      }
    },
    diffForHuman(string) {
      const date = moment(string);
      return date.fromNow();
    },
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/articles").then((res) => {
      this.loading = false;
      this.articles = res.data;
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