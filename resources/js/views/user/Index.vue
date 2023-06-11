<template>
  <div class="main-content">
    <section class="section">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Anggota FOSNAS</h4>
              <div class="card-header-form">
                <form v-on:submit.prevent="filteredSearch">
                  <div class="input-group">
                    <input
                      v-model="filterSearch"
                      type="text"
                      class="form-control"
                      placeholder="Search"
                      @change="filteredSearch"
                    />
                    <div class="input-group-btn">
                      <button
                        v-if="!onSearch || !filterSearch"
                        class="btn btn-primary"
                      >
                        <i class="fas fa-search"></i>
                      </button>
                      <button v-else class="btn btn-danger" @click="reset">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <th>#</th>
                    <th>Nama Anggota</th>
                    <th>Asal Sekolah</th>
                    <th>Opsi</th>
                  </tr>
                  <tbody v-if="!loading && users.length">
                    <tr v-for="(user, index) in users" :key="user.id">
                      <td>{{ index + 1 }}</td>
                      <td>{{ user.name }}</td>
                      <td>{{ user.school.name }}</td>
                      <td>
                        <div>
                          <button
                            class="btn btn-primary mr-2"
                            data-toggle="tooltip"
                            title="Detail"
                          >
                            <i class="fas fa-eye"></i>
                          </button>
                          <button
                            class="btn btn-danger"
                            data-toggle="tooltip"
                            title="Hapus"
                            @click="deleteUser(user.id)"
                          >
                            <i class="fas fa-trash"></i>
                          </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                  <tbody v-else>
                    <tr>
                      <td colspan="5" class="text-center">
                        <span v-if="loading"> Loading get data... </span>
                        <span v-else>
                          <span v-if="filterSearch">
                            Tidak ada data yang sesuai
                          </span>
                          <span v-else> Tidak ada data </span>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      users: [],

      filterSearch: "",
      loading: true,
      onSearch: false,
    };
  },
  methods: {
    filteredSearch() {
      this.loading = true;
      axios
        .get("http://127.0.0.1:8000/api/users?search=" + this.filterSearch)
        .then((res) => {
          this.loading = false;
          this.onSearch = true;
          this.users = res.data;
        });
    },
    reset() {
      this.loading = true;
      this.filterSearch = "";
      axios.get("http://127.0.0.1:8000/api/users").then((res) => {
        this.loading = false;
        this.onSearch = false;
        this.users = res.data;
      });
    },
    deleteUser(id) {
      this.$swal({
        title: "Apakah kamu yakin?",
        icon: "question",
        text: "Data yang sudah dihapus akan hilang selamanya",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, saya Yakin",
        cancelButtonText: "Batalkan",
      }).then((result) => {
        if (result.value) {
          axios.delete("http://127.0.0.1:8000/api/users/" + id).then((res) => {
            axios.get("http://127.0.0.1:8000/api/users").then((res) => {
              this.$swal(
                "Berhasil Dihapus",
                "Data user telah berhasil dihapus",
                "success"
              );
              this.loading = false;
              this.users = res.data;
            });
          });
        }
      });
    },
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/users").then((res) => {
      this.loading = false;
      this.users = res.data;
    });
  },
};
</script>

<style>
</style>