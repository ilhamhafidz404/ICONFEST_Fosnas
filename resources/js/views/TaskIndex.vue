<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Program Kerja</h1>
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
                    @click="reset"
                    class="absolute right-0 top-1/2 -translate-y-1/2 mr-[10px]"
                  >
                    <i class="fas fa-times"></i>
                  </span>
                </div>
              </form>
            </div>
            <div class="md:mt-0 mt-[15px]">
              <button
                v-if="
                  role != 'anggota' &&
                  role != 'pengurus osis' &&
                  role != 'super admin'
                "
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#prokerModalForm"
              >
                Tambah Proker
              </button>
              <button class="btn btn-success ml-3" @click="exportTask">
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
              <div
                class="card-header flex sm:justify-content-between justify-content-center"
              >
                <h4 v-if="role == 'super admin'">
                  Data Program Kerja Anggota FOSNAS
                </h4>
                <h4 v-else class="sm:text-left text-center">
                  Data Program Kerja {{ data.school.name }}
                </h4>

                <button
                  v-if="
                    !thisMyTasks && role != 'super admin' && role != 'anggota'
                  "
                  @click="getMyTask(1, data.id)"
                  class="btn btn-secondary sm:mt-0 mt-[15px]"
                >
                  Filter proker saya
                </button>
                <button
                  v-if="
                    thisMyTasks && role != 'super admin' && role != 'anggota'
                  "
                  @click="getMyTask(1, 0)"
                  class="btn btn-secondary"
                >
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
                              v-if="role != 'anggota' && role != 'super admin'"
                              class="btn btn-info mx-2"
                              data-toggle="tooltip"
                              title="Edit"
                              @click="getTask(task, '#prokerModalForm')"
                            >
                              <i class="fas fa-pen"></i>
                            </button>
                            <button
                              v-if="
                                role != 'anggota' && role != 'pengurus osis'
                              "
                              class="btn btn-danger ml-2"
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

    <Pagination
      ref="pagination"
      @setLoading="setLoading"
      @getNewPageData="getTasks"
    ></Pagination>

    <!-- Modal -->
    <ModalFormTask
      ref="modalFormTask"
      :role="role"
      :data="data"
      @getTasks="getTasks"
      @setLoadingSubmit="setLoadingSubmit"
      @setLoading="setLoading"
    ></ModalFormTask>
    <!--  -->
    <ModalDetailTask
      ref="modalDetailTask"
      :role="role"
      :data="data"
      @getTask="getTask"
    ></ModalDetailTask>
  </div>
</template>
<script>
import axios from "axios";
import { UserGet } from "./../actions/UserGet.js";
import { TaskGet } from "./../actions/TaskGet.js";
//
import ModalFormTask from "./../components/ModalFormTask.vue";
import ModalDetailTask from "./../components/ModalDetailTask.vue";
import Pagination from "./../components/Pagination.vue";
export default {
  props: ["role", "data"],
  components: {
    ModalFormTask,
    ModalDetailTask,
    Pagination,
  },
  data() {
    return {
      // untuk get data
      tasks: [],
      users: [],

      filterSearch: "",
      loading: true,
      loadingSubmit: false,
      onSearch: false,

      //
      thisMyTasks: false,
    };
  },
  methods: {
    setLoadingSubmit() {
      this.loadingSubmit = !this.loadingSubmit;
    },
    setLoading() {
      this.loading = !this.loading;
    },
    async getTasks(page = 1, userId) {
      this.loading = true;
      try {
        let result = await TaskGet(
          this.data.school_id,
          this.filterSearch,
          10,
          page,
          userId
        );
        this.tasks = result.data.data;

        const pagination = this.$refs.pagination;
        pagination.links = result.data.links;

        this.loading = false;

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
      this.onSearch = false;
      this.getTasks();
    },
    reset() {
      this.loading = true;
      this.filterSearch = "";
      this.getTasks();
    },
    resetTask() {
      this.task.id = 0;
      this.task.name = "";
      this.task.description = "";
      this.task.status = "progress";
      this.task.users = [];
      this.task.school_id = this.data.school_id;
      this.isSuccessorCancelTask = false;

      this.errors.name = "";
      this.errors.status = "";
      this.errors.school = "";
      this.errors.description = "";
      this.errors.users = "";
      this.errors.countError = 0;
    },
    exportTask() {
      this.$swal({
        title: "Konfirmasi Eksport Data Proker",
        icon: "question",
        text: "Apakah anda yakin ingin mengeksport data proker",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, saya Yakin",
        cancelButtonText: "Batalkan",
      }).then((res) => {
        if (res.isConfirmed) {
          window.open("http://127.0.0.1:8000/export/task", "_blank");
          this.$swal(
            "Berhasil Meng-eksport",
            "Data proker telah berhasil dieksport",
            "success"
          );
        }
      });
    },
    getTask(data, modalTarget) {
      const modalFormTaskComp = this.$refs.modalFormTask;
      const modalDetailTaskComp = this.$refs.modalDetailTask;

      modalFormTaskComp.task.id = data.id;
      modalFormTaskComp.task.name = data.name;
      modalFormTaskComp.task.description = data.description;
      modalFormTaskComp.task.users = data.users;
      modalFormTaskComp.task.status = data.status;

      modalDetailTaskComp.task.id = data.id;
      modalDetailTaskComp.task.name = data.name;
      modalDetailTaskComp.task.description = data.description;
      modalDetailTaskComp.task.users = data.users;
      modalDetailTaskComp.task.status = data.status;

      if (data.status == "success" || data.status == "cancel") {
        modalFormTaskComp.isSuccessorCancelTask = true;
        modalDetailTaskComp.isSuccessorCancelTask = true;
      } else {
        modalFormTaskComp.isSuccessorCancelTask = false;
        modalDetailTaskComp.isSuccessorCancelTask = false;
      }

      $(modalTarget).modal("show");
    },
    deleteTask(id) {
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
            this.$swal(
              "Berhasil Dihapus",
              "Data proker telah berhasil dihapus",
              "success"
            );
            this.loading = false;
            this.getTasks();
          });
        }
      });
    },
    getMyTask(page, userId) {
      this.thisMyTasks = !this.thisMyTasks;
      this.getTasks(page, userId);
    },
  },
  mounted() {
    this.getTasks();
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