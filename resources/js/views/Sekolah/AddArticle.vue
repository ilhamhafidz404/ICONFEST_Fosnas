<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Artikel</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active">
            <router-link to="/dashboard">Dashboard</router-link>
          </div>
          <div class="breadcrumb-item">
            <router-link to="/artikel">artikel</router-link>
          </div>
          <div class="breadcrumb-item">Tambah Artikel</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Tambah Artikel</h4>
              </div>
              <div class="card-body">
                <form @submit.prevent="submitHandler">
                  <div class="form-group row mb-4">
                    <label
                      class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                      >Title</label
                    >
                    <div class="col-sm-12 col-md-7">
                      <input
                        type="text"
                        class="form-control"
                        v-model="article.title"
                      />
                    </div>
                  </div>
                  <div class="form-group row mb-4">
                    <label
                      class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                      >Content</label
                    >
                    <div class="col-sm-12 col-md-7">
                      <QuillEditor
                        theme="snow"
                        v-model:content="article.body"
                        contentType="html"
                      />
                    </div>
                  </div>
                  <div class="form-group row mb-4">
                    <label
                      class="col-form-label text-md-right col-12 col-md-3 col-lg-3"
                    ></label>
                    <div class="col-sm-12 col-md-7 mt-5">
                      <router-link to="/artikel" class="btn btn-danger mr-3">
                        Kembali
                      </router-link>
                      <button class="btn btn-primary">Publish</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      article: {
        title: "",
        school_id: this.data.school_id,
        body: "",
      },
    };
  },
  methods: {
    submitHandler() {
      axios
        .post("http://127.0.0.1:8000/api/articles", this.article)
        .then((res) => {
          this.$swal(
            "Berhasil Menambah",
            "Artikel baru telah ditambahkan!",
            "success"
          ).then((res) => {
            this.$router.push("/artikel");
          });
        });
    },
  },
};
</script>

<style>
</style>