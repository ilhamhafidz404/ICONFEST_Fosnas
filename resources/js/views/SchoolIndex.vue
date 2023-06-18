<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Sekolah</h1>
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
            <div v-if="role == 'super admin'">
              <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#schoolModalForm"
              >
                Tambah Sekolah
              </button>
              <button 
                class="btn btn-success ml-3" 
                @click="exportSchool"
              >
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
                <h4>Data Sekolah Anggota FOSNAS</h4>
              </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      <th>ID</th>
                      <th>Nama Sekolah</th>
                      <th>Alamat</th>
                      <th>Deskripsi</th>
                      <th>Opsi</th>
                    </tr>
                    <tbody v-if="!loading && schools.length">
                      <tr v-for="school in schools" :key="school.id">
                        <td>FS-{{ school.id }}</td>
                        <td>{{ school.name }}</td>
                        <td>{{ school.address }}</td>
                        <td>
                          {{ school.description }}
                        </td>
                        <td>
                          <div>
                            <button
                              class="btn btn-primary mr-2"
                              data-toggle="tooltip"
                              title="Detail"
                              @click="getSchool(school, '#schoolModalDetail')"
                            >
                              <i class="fas fa-eye"></i>
                            </button>
                            <button
                              v-if="role == 'super admin'"
                              class="btn btn-danger"
                              data-toggle="tooltip"
                              title="Hapus"
                              @click="deleteSchool(school.id)"
                            >
                              <i class="fas fa-trash"></i>
                            </button>
                            <button
                              v-if="role == 'anggota'"
                              class="btn btn-info"
                              data-toggle="tooltip"
                              title="request keanggotaan"
                              @click="requestAnggota(school)"
                            >
                              Request Keanggotaan
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

          <Pagination 
            ref="pagination"
            @setLoading="setLoading"
            @getNewPageData="getTasks"
          ></Pagination>
        </div>
      </div>
      <div v-else class="text-center h-[500px]">
        <div
          class="loader absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
        ></div>
      </div>
    </section>

    <ModalFormSchool
      :role="role"
      :data="data"
      @getSchools="getSchools"
      @setLoading="setLoading"
      @setLoadingSubmit="setLoadingSubmit"
    ></ModalFormSchool>
    <ModalDetailSchool
      ref="modalSchoolDetail"
      :role="role"
      :data="data"
    ></ModalDetailSchool>
  </div>
</template>

<script>
import axios from "axios";
import { SchoolGet } from "./../actions/SchoolGet.js";
//
import Pagination from "./../components/Pagination.vue";
import ModalFormSchool from "./../components/ModalFormSchool.vue";
import ModalDetailSchool from "./../components/ModalDetailSchool.vue";
export default {
  props: ["role", "data"],
  components : {
    Pagination,
    ModalFormSchool,
    ModalDetailSchool
  },
  data() {
    return {
      schools: [],

      dataRequest : {
        id: 0,
        name: ""
      },

      filterSearch: "",
      loading: true,
      loadingSubmit: false,
      onSearch: false,
    };
  },
  methods: {
    setLoadingSubmit(){
      this.loadingSubmit = !this.loadingSubmit;
    },
    setLoading(){
      this.loading = !this.loading;
    },
    getSchool(data, modalTarget){
      // const modalFormTaskComp = this.$refs.modalFormTask;
      const modalSchoolDetail = this.$refs.modalSchoolDetail;

      // modalFormTaskComp.task.id = data.id; 
      // modalFormTaskComp.task.name = data.name;
      // modalFormTaskComp.task.description = data.description;
      // modalFormTaskComp.task.users = data.users;
      // modalFormTaskComp.task.status = data.status;

      modalSchoolDetail.school.id = data.id; 
      modalSchoolDetail.school.name = data.name;
      modalSchoolDetail.school.description = data.description;
      modalSchoolDetail.school.map = data.map;
      modalSchoolDetail.school.address = data.address;

      $(modalTarget).modal("show");
    },
    async getSchools(page = 1){
      try {
        let result = await SchoolGet(this.filterSearch, 10, page);
        this.schools = result.data.data;

        const pagination = this.$refs.pagination;
        pagination.links = result.data.links;

        this.loading = false;

        if(this.filterSearch != ""){
          this.onSearch = true;
        } else{
          this.onSearch = false;
        }
      } catch (error) {
        console.error(error);
      }
    },
    filteredSearch() {
      this.loading = true;
      this.getSchools();
    },
    resetSearch() {
      this.loading = true;
      this.filterSearch = "";
      this.getSchools();
    },
    exportSchool() {
      this.$swal({
        title: "Konfirmasi Eksport Data Sekolah",
        icon: "question",
        text: "Apakah anda yakin ingin mengeksport data Sekolah",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, saya Yakin",
        cancelButtonText: "Batalkan",
      }).then((res) => {
        if (res.isConfirmed) {
          window.open("http://127.0.0.1:8000/export/school", "_blank");
          this.$swal(
            "Berhasil Meng-eksport",
            "Data sekolah telah berhasil dieksport",
            "success"
          );
        }
      });
    },
    deleteSchool(id) {      
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
          this.loadingSubmit = true;
          axios.delete("http://127.0.0.1:8000/api/schools/" + id).then(() => {
            this.loadingSubmit = false;
            this.getSchools();
            this.$swal(
              "Berhasil Dihapus",
              "Data Sekolah telah berhasil dihapus",
              "success"
            );  
          });
        }
      });
    },
    requestAnggota(school){
      this.loadingSubmit = !this.loadingSubmit;

      this.dataRequest.id = school.id;
      this.dataRequest.name = this.data.name;
      axios.post(`http://127.0.0.1:8000/api/notifications`, this.dataRequest).then((res) =>{
        this.$swal(
            "Berhasil Meminta Keanggotaan",
            "Tunggu admin untuk menerima keanggotaan anda",
            "success"
          );
        this.loadingSubmit = !this.loadingSubmit;
      })
    }
  },
  mounted() {
    this.getSchools();
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