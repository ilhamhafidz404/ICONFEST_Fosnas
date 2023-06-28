<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>User</h1>
        <div class="section-header-breadcrumb">
          <div class="flex md:flex-row flex-col items-center justify-center">
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
            <div class="md:mt-0 mt-[15px]">
              <button
                v-if="role != 'anggota' && role != 'pengurus osis'"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#userModalForm"
              >
                Tambah Anggota
              </button>
              <button class="btn btn-success ml-3" @click="exportUser">
                Export Excel
              </button>
            </div>
          </div>
        </div>
      </div>
      <div v-if="!loadingSubmit" class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 v-if="role == 'super admin'">Data Anggota FOSNAS</h4>
                <h4 v-else>Data Anggota OSIS {{ data.school.name }}</h4>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>#</th>
                      <th>Nama Anggota</th>
                      <th v-if="role == 'super admin'">Asal Sekolah</th>
                      <th>Role</th>
                      <th>Opsi</th>
                    </tr>
                    <tbody v-if="!loading && users.length">
                      <tr v-for="(user, index) in users" :key="user.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ user.name }}</td>
                        <td v-if="role == 'super admin'">
                          {{ user.school.name }}
                        </td>
                        <td>
                          <span
                            class="badge"
                            :class="{
                              'badge-success':
                                user.roles[0].name == 'admin sekolah',
                              'badge-warning':
                                user.roles[0].name == 'pengurus osis',
                              'badge-danger': user.roles[0].name == 'anggota',
                            }"
                          >
                            {{ user.roles[0].name }}
                          </span>
                        </td>
                        <td>
                          <div class="flex">
                            <button
                              class="btn btn-primary"
                              title="Detail"
                              data-bs-toggle="modal"
                              @click="getUser(user, '#userModalDetail')"
                            >
                              <i class="fas fa-eye"></i>
                            </button>
                            <button
                              v-if="
                                role != 'anggota' && role != 'pengurus osis'
                              "
                              class="btn btn-info mx-2"
                              data-toggle="tooltip"
                              title="Edit"
                              @click="getUser(user, '#userModalForm')"
                            >
                              <i class="fas fa-pen"></i>
                            </button>
                            <button
                              v-if="
                                role != 'anggota' && role != 'pengurus osis'
                              "
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

    <!-- Modal -->
    <ModalFormUser
      ref="modalFormUser"
      :data="data"
      :role="role"
      @getUsers="getUsers"
      @setLoadingSubmit="setLoadingSubmit"
      @setLoading="setLoading"
    ></ModalFormUser>
    <!--  -->
    <ModalDetailUser
      ref="modalDetailUser"
      :data="data"
      :role="role"
      @getUser="getUser"
    ></ModalDetailUser>
  </div>
</template>
<script>
import axios from "axios";
import { UserGet } from "./../actions/UserGet.js";
//
import ModalFormUser from "./../components/ModalFormUser.vue";
import ModalDetailUser from "./../components/ModalDetailUser.vue";
import Pagination from "./../components/Pagination.vue";
export default {
  props: ["role", "data"],
  components: {
    ModalFormUser,
    ModalDetailUser,
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
        let result = await UserGet(
          this.data.school_id,
          this.filterSearch,
          10,
          page
        );
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
    getUser(data, modalTarget) {
      const defaultAvatars = [
        "avatar-1.png",
        "avatar-2.png",
        "avatar-3.png",
        "avatar-4.png",
        "avatar-5.png",
      ];

      const { modalDetailUser, modalFormUser } = this.$refs;

      const { id, name, email, roles, profile } = data;
      const role = data.role != "Pilih Role" ? roles[0].name : "Pilih Role";

      modalDetailUser.user = { id, name, email, role, profile };
      modalFormUser.user = { id, name, email, role, profile };

      if (data.role != "Pilih Role") {
        const imagePath = defaultAvatars.includes(profile)
          ? `/images/profiles/default/${profile}`
          : `/images/profiles/${profile}`;

        modalDetailUser.previewImage = imagePath;
        modalFormUser.previewImage = imagePath;
      } else {
        modalDetailUser.previewImage = "";
        modalFormUser.previewImage = "";
      }

      $(modalTarget).modal("show");
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
    exportUser() {
      this.$swal({
        title: "Konfirmasi Eksport Data User",
        icon: "question",
        text: "Apakah anda yakin ingin mengeksport data user",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, saya Yakin",
        cancelButtonText: "Batalkan",
      }).then((res) => {
        if (res.isConfirmed) {
          window.open("http://127.0.0.1:8000/export/user", "_blank");
          this.$swal(
            "Berhasil Meng-eksport",
            "Data user telah berhasil dieksport",
            "success"
          );
        }
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
            this.getUsers();
            this.$swal(
              "Berhasil Dihapus",
              "Data user telah berhasil dihapus",
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