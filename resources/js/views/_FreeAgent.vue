<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Free Agent</h1>
        <div class="section-header-breadcrumb">
          <div class="flex align-items-center justify-content-center">
            <div class="mr-3">
              <form @submit.prevent="filteredSearch">
                <div class="relative">
                  <input
                    type="text"
                    class="border border-red-500 rounded p-[10px] bg-gray-50 w-[300px]"
                    v-model="filterSearch"
                    placeholder="Search"
                    @change="filteredSearch"
                  />
                  <span
                    v-if="!onSearch"
                    class="absolute right-0 top-1/2 -translate-y-1/2 mr-[10px]"
                  >
                    <i class="fas fa-search"></i>
                  </span>
                  <span
                    v-else
                    @click="resetSearch"
                    class="absolute right-0 top-1/2 -translate-y-1/2 mr-[10px]"
                  >
                    <i class="fas fa-times"></i>
                  </span>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div v-if="!loadingSubmit" class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Data Anggota Free Agent</h4>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>#</th>
                      <th>Nama Anggota</th>
                      <th>Opsi</th>
                    </tr>
                    <tbody v-if="!loading && users.length">
                      <tr v-for="(user, index) in users" :key="user.id">
                        <td>{{ index + 1 }}</td>
                        <td>
                          <div class="flex align-items-center">
                            <img
                              alt="image"
                              :src="
                                user.profile == 'avatar-1.png' ||
                                user.profile == 'avatar-2.png' ||
                                user.profile == 'avatar-3.png' ||
                                user.profile == 'avatar-4.png' ||
                                user.profile == 'avatar-5.png'
                                  ? `/images/profiles/default/${user.profile}`
                                  : `/images/profiles/${user.profile}`
                              "
                              class="rounded-circle max-w-[35px] max-h-[35px] object-cover mr-3"
                              width="35"
                              data-toggle="tooltip"
                              data-placement="top"
                              :title="user.name"
                            />
                            {{ user.name }}
                          </div>
                        </td>
                        <td>
                          <div>
                            <button
                              class="btn btn-success"
                              title="Beri Keanggotaan"
                              @click="giveSchool(user)"
                            >
                              <i class="fas fa-check"></i>
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
      </div>
      <div v-else class="text-center h-[500px]">
        <div
          class="loader absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
        ></div>
      </div>
    </section>

    <Pagination
      ref="pagination"
      @setLoading="setLoading"
      @getNewPageData="getUsers"
    ></Pagination>
  </div>
</template>
<script>
import axios from "axios";
import { UserGet } from "./../actions/UserGet.js";
//
import Pagination from "./../components/Pagination.vue";
export default {
  props: ["role", "data"],
  components: {
    Pagination,
  },
  data() {
    return {
      // untuk get data
      users: [],

      filterSearch: "",
      loading: true,
      loadingSubmit: false,
      onSearch: false,
    };
  },
  methods: {
    setLoadingSubmit() {
      this.loadingSubmit = !this.loadingSubmit;
    },
    setLoading() {
      this.loading = !this.loading;
    },
    async getUsers(page = 1) {
      try {
        let result = await UserGet(0, this.filterSearch, 10, page);
        this.users = result.data.data;

        const pagination = this.$refs.pagination;

        this.loading = false;

        pagination.links = result.data.links;

        if (this.filterSearch != "") {
          this.onSearch = true;
        } else {
          this.onSearch = false;
        }
      } catch (error) {
        console.error(error);
      }
    },

    filteredSearch() {
      this.loading = true;
      this.getUsers();
    },
    resetSearch() {
      this.loading = true;
      this.filterSearch = "";

      this.getUsers();
    },
    giveSchool(user) {
      this.$swal({
        title: "Apakah kamu yakin?",
        icon: "question",
        text: "Free Agent akan menjadi anggota sekolah",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, saya Yakin",
        cancelButtonText: "Batalkan",
      }).then((result) => {
        if (result.value) {
          this.setLoadingSubmit();
          axios
            .put(`http://127.0.0.1:8000/api/giveschool/${user.id}`, {
              school: this.data.school_id,
            })
            .then((res) => {
              this.getUsers();
              this.setLoadingSubmit();
              this.setLoading();
              this.$swal(
                "Berhasil Menjadikan Anggota",
                "Anggota bertambah dari free agent",
                "success"
              );
            });
        }
      });
    },
  },
  mounted() {
    this.getUsers();
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