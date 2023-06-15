<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Program Kerja</h1>
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
                    @click="reset"
                    class="absolute right-0 top-1/2 -translate-y-1/2 mr-[10px]"
                  >
                    <i class="fas fa-times"></i>
                  </span>
                </div>
              </form>
            </div>
            <div>
              <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#prokerModalForm"
              >
                Tambah Proker
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
              <div class="card-header flex justify-content-between">
                <h4 v-if="role == 'super admin'">Data Program Kerja Anggota FOSNAS</h4>
                <h4 v-else>Data Program Kerja {{ data.school.name }}</h4>

                <button v-if="!thisMyTasks" @click="getMyTask" class="btn btn-secondary">
                  Filter proker saya
                </button>
                <button v-else @click="getTasks(true)" class="btn btn-secondary">
                  Semua Proker
                </button>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>#</th>
                      <th>Nama Proker</th>
                      <th v-if="role == 'super admin'">Asal Sekolah</th>
                      <th>Panitia</th>
                      <th>Status</th>
                      <th>Opsi</th>
                    </tr>
                    <tbody v-if="!loading && tasks.length">
                      <tr v-for="(task, index) in tasks" :key="task.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ task.name }}</td>
                        <td v-if="role == 'super admin'">
                          {{ task.school.name }}
                        </td>
                        <td>
                          <span class="flex">
                            <img
                              v-for="user in task.users"
                              :key="user.id"
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
                              class="rounded-circle max-w-[35px] max-h-[35px] object-cover"
                              width="35"
                              data-toggle="tooltip"
                              data-placement="top"
                              :title="user.name"
                            />
                          </span>
                        </td>
                        <td>
                          <span
                            class="badge"
                            :class="{
                              'badge-success': task.status == 'success',
                              'badge-warning': task.status == 'progress',
                              'badge-danger': task.status == 'cancel',
                            }"
                          >
                            {{ task.status }}
                          </span>
                        </td>
                        <td>
                          <div>
                            <button
                              class="btn btn-primary"
                              title="Detail"
                              data-bs-toggle="modal"
                              @click="getTask(task, '#prokerModalDetail')"
                            >
                              <i class="fas fa-eye"></i>
                            </button>
                            <button
                              class="btn btn-info mx-2"
                              data-toggle="tooltip"
                              title="Edit"
                              @click="getTask(task, '#prokerModalForm')"
                            >
                              <i class="fas fa-pen"></i>
                            </button>
                            <button
                              class="btn btn-danger"
                              data-toggle="tooltip"
                              title="Hapus"
                              @click="deleteTask(task.id)"
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

    <nav aria-label="..." class="mb-20">
      <ul class="pagination">
        <li
          class="page-item"
          :class="{ active: link.label == page }"
          v-for="link in links"
          :key="link.url"
        >
          <span
            class="page-link"
            @click="changePage(link.label, link.url)"
            v-html="link.label"
          >
          </span>
        </li>
      </ul>
    </nav>

    <!-- Modal -->
    <div
      class="modal fade"
      id="prokerModalForm"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title text-xl font-bold">
              <span v-if="!task.id"> Tambah Proker </span>
              <span v-else> Edit Proker </span>
            </h1>
            <button
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data">
              <div class="form-group mb-1">
                <label>Proker</label>
                <div class="input-group">
                  <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': errors.name }"
                    placeholder="Name"
                    v-model="task.name"
                  />
                  <div class="invalid-feedback">
                    {{ errors.name }}
                  </div>
                </div>
              </div>
              <div class="form-group mb-1">
                <label>Description</label>
                <div class="input-group">
                  <textarea
                    class="form-control"
                    :class="{ 'is-invalid': errors.description }"
                    placeholder="Description"
                    v-model="task.description"
                  ></textarea>
                  <div class="invalid-feedback">
                    {{ errors.description }}
                  </div>
                </div>
              </div>
              <div v-if="task.id" class="form-group">
                <label>Status</label>
                <select
                  class="form-control"
                  :class="{ 'is-invalid': errors.status }"
                  v-model="task.status"
                >
                  <option value="progress">Progress</option>
                  <option value="success">Success</option>
                  <option value="cancel">Cancel</option>
                </select>
                <div class="invalid-feedback">
                  {{ errors.status }}
                </div>
              </div>
              <div v-if="!task.id" class="form-group">
                <label>Panitia</label>
                <select
                  class="form-control select2 !h-[150px]"
                  multiple=""
                  :class="{ 'is-invalid': errors.users }"
                  v-model="task.users"
                >
                  <option v-for="user in users" :key="user.id" :value="user.id">
                    {{ user.name }}
                  </option>
                </select>
                <div class="invalid-feedback">
                  {{ errors.users }}
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              @click="resetTask"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button @click="handleSubmit" class="btn btn-primary">
              Submit
            </button>
          </div>
        </div>
      </div>
    </div>
    <!--  -->
    <div
      class="modal fade"
      id="prokerModalDetail"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content card author-box card-primary">
          <div class="card-body">
            <div class="author-box-name flex gap-5 align-items-center">
              <h3 class="text-xl font-bold">{{ task.name }}</h3>
              <span
                class="badge"
                :class="{
                  'badge-danger': task.status == 'cancel',
                  'badge-warning': task.status == 'progress',
                  'badge-success': task.status == 'success',
                }"
              >
                {{ task.status }}
              </span>
            </div>
            <div class="author-box-description">
              <p>
                {{ task.description }}
              </p>
              <h5 class="font-bold mb-3 mt-5">Panitia:</h5>
              <div class="flex mb-2">
                <span v-for="user in task.users" :key="user.id">
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
                    class="rounded-circle max-w-[35px] max-h-[35px] object-cover"
                    width="35"
                    data-toggle="tooltip"
                    data-placement="top"
                    :title="user.name"
                  />
                </span>
              </div>
              <div>
                <span v-for="(user, index) in task.users" :key="user.name">
                  {{ user.name }}
                  <i v-if="task.users.length - 1 != index">, </i>
                </span>
              </div>
            </div>
            <div class="modal-footer mt-[10px]">
              <button
                @click="resetTask"
                class="btn btn-secondary cursor-pointer"
                data-bs-dismiss="modal"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  props: ["role", "data"],
  data() {
    return {
      // untuk get data
      tasks: [],
      schools: [],
      users: [],

      // untuk post data
      task: {
        id: 0,
        name: "",
        status: "progress",
        school_id: this.data.school_id,
        description: "",
        users: [],
      },

      filterSearch: "",
      loading: true,
      loadingSubmit: false,
      onSearch: false,

      // pagination
      page: "1",
      links: [],

      // error message
      errors: {
        name: "",
        status: "",
        school: "",
        description: "",
        users: "",
      },

      // 
      thisMyTasks: false
    };
  },
  methods: {
    filteredSearch() {
      // const urlRequest =
      //   this.role == "super admin"
      //     ? "http://127.0.0.1:8000/api/users?search=" + this.filterSearch
      //     : "http://127.0.0.1:8000/api/users?search=" +
      //       this.filterSearch +
      //       "&school=" +
      //       this.data.school_id;

      // this.loading = true;
      // axios.get(urlRequest).then((res) => {
      //   this.loading = false;
      //   this.onSearch = true;
      //   this.users = res.data.data;
      // });
    },
    reset() {
      const urlRequest =
        this.role == "super admin"
          ? "http://127.0.0.1:8000/api/tasks"
          : "http://127.0.0.1:8000/api/tasks?school=" + this.data.school_id;

      this.loading = true;
      this.filterSearch = "";
      axios.get(urlRequest).then((res) => {
        this.loading = false;
        this.onSearch = false;
        this.tasks = res.data;
      });
    },
    resetTask() {
      this.task.id = 0;
      this.task.name = "";
      this.task.description = "";
      this.task.status = "progress";
      this.task.users = [];
      this.task.school_id = this.data.school_id;

      this.errors.name = "";
      this.errors.status = "";
      this.errors.school = "";
      this.errors.description = "";
      this.errors.users = "";
      this.errors.countError = 0;
    },
    exportUser() {
      // this.$swal({
      //   title: "Konfirmasi Eksport Data User",
      //   icon: "question",
      //   text: "Apakah anda yakin ingin mengeksport data user",
      //   showCancelButton: true,
      //   confirmButtonColor: "#3085d6",
      //   cancelButtonColor: "#d33",
      //   confirmButtonText: "Ya, saya Yakin",
      //   cancelButtonText: "Batalkan",
      // }).then((res) => {
      //   if (res.isConfirmed) {
      //     window.open("http://127.0.0.1:8000/export/user", "_blank");
      //     this.$swal(
      //       "Berhasil Meng-eksport",
      //       "Data user telah berhasil dieksport",
      //       "success"
      //     );
      //   }
      // });
    },

    changePage(page, url) {
      console.log(url)
      let urlRequest = url;
      this.loading = true;

      if (this.role != "super admin") {
        urlRequest += `&school=${this.data.school_id}`;
      }

      this.page = page;

      axios.get(urlRequest).then((res) => {
        this.tasks = res.data.data;
        this.loading = false;
      });
    },
    getTask(data, modalTarget) {
      this.task.id = data.id;
      this.task.name = data.name;
      this.task.description = data.description;
      this.task.users = data.users;
      this.task.status = data.status;

      $(modalTarget).modal("show");
    },
    checkError() {
      if (this.task.name == "") {
        this.errors.name = "nama harus diisi";
        this.errors.countError += 1;
      } else {
        this.errors.name = "";
      }

      if (this.task.description == "") {
        this.errors.description = "deskripsi harus diisi";
        this.errors.countError += 1;
      } else {
        this.errors.description = "";
      }

      if (this.task.users.length == 0) {
        this.errors.users = "Pilih setidaknya 1 panitia";
        console.log(this.errors.users);
        this.errors.countError += 1;
      } else {
        this.errors.users = "";
      }
    },
    handleSubmit() {
      this.errors.countError = 0;
      this.checkError();

      // jika sedang edit, maka password errornya hilangkan
      if (this.task.id != 0 && this.errors.countError == 1) {
        this.errors.countError = 0;
      }

      if (!this.errors.countError) {
        this.loadingSubmit = true;
        $("#prokerModalForm").modal("hide");

        if (this.task.id == 0) {
          axios
            .post("http://127.0.0.1:8000/api/tasks", this.task)
            .then((res) => {
              this.loadingSubmit = false;
              this.loading = true;
              this.$swal(
                "Berhasil Menambah Program Kerja",
                "Proker telah berhasil ditambah",
                "success"
              );
              const urlRequest =
                this.role == "super admin"
                  ? "http://127.0.0.1:8000/api/tasks"
                  : "http://127.0.0.1:8000/api/tasks?school=" +
                    this.data.school_id;

              axios.get(urlRequest).then((res) => {
                this.loading = false;
                this.tasks = res.data.data;

                // reset user data
                this.resetTask();
              });
            })
            .catch((er) => {
              this.$swal(
                "Gagal Menambah Program Kerja",
                `${er.response.data.message}`,
                "error"
              );
              this.loadingSubmit = false;

              // reset user data
              this.resetTask();
            });
        } else {
          axios
            .put(`http://127.0.0.1:8000/api/tasks/${this.task.id}`, this.task)
            .then((res) => {
              this.loadingSubmit = false;
              this.loading = true;
              this.$swal(
                "Berhasil Edit Data Program Kerja",
                "Data proker telah berubah",
                "success"
              );
              const urlRequest =
                this.role == "super admin"
                  ? "http://127.0.0.1:8000/api/tasks"
                  : "http://127.0.0.1:8000/api/tasks?school=" +
                    this.data.school_id;

              axios.get(urlRequest).then((res) => {
                this.loading = false;
                this.tasks = res.data.data;

                // reset user data
                this.resetTask();
              });
            });
        }
      }
    },
    deleteTask(id) {
      const urlRequest =
        this.role == "super admin"
          ? "http://127.0.0.1:8000/api/tasks"
          : "http://127.0.0.1:8000/api/tasks?school=" + this.data.school_id;

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
          axios.delete("http://127.0.0.1:8000/api/tasks/" + id).then((res) => {
            axios.get(urlRequest).then((res) => {
              this.$swal(
                "Berhasil Dihapus",
                "Data proker telah berhasil dihapus",
                "success"
              );
              this.loading = false;
              this.tasks = res.data.data;
            });
          });
        }
      });
    },
    getTasks(forFilter = false){
      if(forFilter){
        this.thisMyTasks= !this.thisMyTasks;
      }
      const urlRequestTask =
        this.role == "super admin"
          ? "http://127.0.0.1:8000/api/tasks"
          : "http://127.0.0.1:8000/api/tasks?school=" + this.data.school_id;
      axios.get(urlRequestTask).then((res) => {
        this.loading = false;
        this.tasks = res.data.data;

        this.links = res.data.links;
      });
    },
    getMyTask(){
      this.thisMyTasks= !this.thisMyTasks;
      axios.get(`http://127.0.0.1:8000/api/tasks?school=${this.data.school_id}&user=${this.data.id}`)
        .then((res) => {
          this.loading = false;
          this.tasks = res.data.data;

          this.links = res.data.links;
      });
    }
  },
  mounted() {
    $("#prokerModalForm").modal({
      backdrop: "static",
    });
    $("#prokerModalDetail").modal({
      backdrop: "static",
    });

    if (this.role == "super admin") {
      this.user.role = "admin sekolah";
    }

    this.getTasks();

    // get users
    const urlRequestUser =
      this.role == "super admin"
        ? "http://127.0.0.1:8000/api/users"
        : "http://127.0.0.1:8000/api/users?school=" + this.data.school_id;
    axios.get(urlRequestUser).then((res) => {
      this.users = res.data.data;
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
select[multiple] option:checked {
  background-color: yellow;
}
</style>