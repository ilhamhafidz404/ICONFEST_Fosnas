<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>User</h1>
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
                data-bs-target="#userModalForm"
              >
                Tambah Anggota
              </button>
              <button
                class="btn btn-success ml-3" 
                @click="exportUser"
              >Export Excel</button>
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
                          <div>
                            <button
                              class="btn btn-primary"
                              title="Detail"
                              data-bs-toggle="modal"
                              @click="getUser(user, '#userModalDetail')"
                            >
                              <i class="fas fa-eye"></i>
                            </button>
                            <button
                              class="btn btn-info mx-2"
                              data-toggle="tooltip"
                              title="Edit"
                              @click="getUser(user, '#userModalForm')"
                            >
                              <i class="fas fa-pen"></i>
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
      id="userModalForm"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title text-xl font-bold">
              <span v-if="!user.id">
                Tambah Anggota
              </span>
              <span v-else>
                Edit Anggota
              </span>
            </h1>
            <button
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form enctype="multipart/form-data">
              <img 
                :src="previewImage" 
                class="rounded-circle max-w-[130px] max-h-[130px] mx-auto object-cover"
                :class="{
                  'min-w-[130px] min-h-[130px]' 
                  : previewImage 
                }" 
              />
              <div class="form-group mb-1" v-if="!user.id">
                <label for="profile">Profile</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-image"></i>
                    </div>
                  </div>
                  <input
                    type="file"
                    class="form-control"
                    id="profile"
                    @change="onImageChange"
                  />
                </div>
              </div>
              <div class="form-group mb-1">
                <label>Name</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-user"></i>
                    </div>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid' : errors.name }"
                    placeholder="Name"
                    v-model="user.name"
                  />
                  <div class="invalid-feedback">
                    {{ errors.name }}
                  </div>
                </div>
              </div>
              <div class="form-group mb-1">
                <label>Email</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-envelope"></i>
                    </div>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid' : errors.email }"
                    placeholder="Email"
                    v-model="user.email"
                  />
                  <div class="invalid-feedback">
                    {{ errors.email }}
                  </div>
                </div>
              </div>
              <div class="form-group mb-1" v-if="user.id == 0">
                <label>Password</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-lock"></i>
                    </div>
                  </div>
                  <input
                    type="password"
                    class="form-control"
                    :class="{ 'is-invalid' : errors.password }"
                    placeholder="Password"
                    v-model="user.password"
                  />
                  <div class="invalid-feedback">
                    {{ errors.password }}
                  </div>
                </div>
              </div>
              <div v-if="role != 'super admin'" class="form-group">
                <label>Sebagai</label>
                <select 
                  class="custom-select" 
                  :class="{ 'is-invalid' : errors.role }" 
                  v-model="user.role"
                >
                  <option selected hidden>Pilih Role</option>
                  <option value="pengurus osis">Pengurus</option>
                  <option value="anggota">Anggota</option>
                </select>
                <div class="invalid-feedback">
                    {{ errors.role }}
                  </div>
              </div>
              <div v-else class="form-group">
                <label>Sebagai</label>
                <select class="custom-select" v-model="user.role">
                  <option selected value="admin sekolah">Admin Sekolah</option>
                </select>
              </div>
              <div v-if="role == 'super admin'" class="form-group">
                <label>Sekolah</label>
                <select class="custom-select" v-model="user.school_id">
                  <option selected value="1" hidden>Pilih Sekolah</option>
                  <option
                    v-for="school in schools"
                    :key="school.id"
                    :value="school.id"
                  >
                    {{ school.name }}
                  </option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              @click="resetUser"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button @click="handleSubmit" class="btn btn-primary">
              Save changes
            </button>
          </div>
        </div>
      </div>
    </div>
    <!--  -->
    <div
      class="modal fade"
      id="userModalDetail"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content card author-box card-primary">
          <div class="card-body flex justify-start gap-10">
            <div class="author-box-left text-center w-[40%]">
              <img
                alt="image"
                :src="
                  user.profile == 'avatar-1.png' ||
                  user.profile == 'avatar-2.png' ||  
                  user.profile == 'avatar-3.png' ||  
                  user.profile == 'avatar-4.png' ||  
                  user.profile == 'avatar-5.png' ? 
                  `/images/profiles/default/${user.profile}` : 
                  `/images/profiles/${user.profile}`
                "
                class="
                  rounded-circle 
                  min-w-[130px] 
                  min-h-[130px] 
                  max-w-[130px] 
                  max-h-[130px] 
                  mx-auto 
                  object-cover
                "
              />
              <span
                class="mt-3 badge"
                :class="{
                  'badge-danger': user.role == 'anggota',
                  'badge-warning': user.role == 'pengurus osis',
                }"
                data-follow-action="alert('follow clicked');"
                data-unfollow-action="alert('unfollow clicked');"
              >
                {{ user.role }}
              </span>
            </div>
            <div>
              <div class="author-box-name">
                <a href="#">{{ user.name }}</a>
              </div>
              <div class="author-box-job">{{ user.email }}</div>
              <div class="author-box-description">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                  do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                  Ut enim ad minim veniam, quis nostrud exercitation ullamco
                  laboris nisi ut aliquip ex ea commodo consequat.
                </p>
              </div>
              <div class="modal-footer mt-[10px]">
                <button
                  @click="resetUser"
                  class="btn btn-secondary cursor-pointer"
                  data-bs-dismiss="modal"
                >
                  Close
                </button>
                <!-- <button
                  @click="handleSubmit"
                  class="btn btn-primary cursor-pointer"
                >
                  Save changes
                </button> -->
              </div>
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
      users: [],
      schools: [],

      // untuk post data
      user: {
        id: 0,
        name: "",
        email: "",
        password: "",
        profile: "",
        school_id: this.data.school_id,
        role: "Pilih Role",
        uploadProfile: false
      },

      filterSearch: "",
      loading: true,
      loadingSubmit: false,
      onSearch: false,

      // pagination
      page: "1",
      links: [],

      // image
      previewImage: "",

      // error message
      errors : {
        name: "",
        email: "",
        password: "",
        profile: "",
        school: "",
        role: "",
        countError: 0,
      }
    };
  },
  methods: {
    filteredSearch() {
      const urlRequest =
        this.role == "super admin"
          ? "http://127.0.0.1:8000/api/users?search=" + this.filterSearch
          : "http://127.0.0.1:8000/api/users?search=" +
            this.filterSearch +
            "&school=" +
            this.data.school_id;

      this.loading = true;
      axios.get(urlRequest).then((res) => {
        this.loading = false;
        this.onSearch = true;
        this.users = res.data.data;
      });
    },
    reset() {
      const urlRequest =
        this.role == "super admin"
          ? "http://127.0.0.1:8000/api/users"
          : "http://127.0.0.1:8000/api/users?school=" + this.data.school_id;

      this.loading = true;
      this.filterSearch = "";
      axios.get(urlRequest).then((res) => {
        this.loading = false;
        this.onSearch = false;
        this.users = res.data.data;
      });
    },
    resetUser() {
      this.user.id = 0;
      this.user.name = "";
      this.user.email = "";
      this.user.password = "";
      this.user.school_id = this.data.school_id;
      this.user.profile = "";
      this.user.role = "Pilih Role";

      this.errors.name= "";
      this.errors.email= "";
      this.errors.password= "";
      this.errors.profile= "";
      this.errors.school= "";
      this.errors.role= "";
      this.errors.countError= 0;

      this.previewImage = ""

      document.getElementById("profile").value = "";
    },
    exportUser(){
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
         if(res.isConfirmed){
          window.open("http://127.0.0.1:8000/export/user", '_blank');
          this.$swal(
            "Berhasil Meng-eksport",
            "Data user telah berhasil dieksport",
            "success"
          );
         }
      });
    },
    
    changePage(page, url) {
      let urlRequest = url;
      this.loading = true;

      if (this.role != "super admin") {
        urlRequest += `&school=${this.data.school_id}`;
      }

      this.page = page;

      axios.get(urlRequest).then((res) => {
        this.users = res.data.data;
        this.loading = false;
      });
    },
    getUser(data, modalTarget) {
      this.user.id = data.id;
      this.user.name = data.name;
      this.user.email = data.email;
      this.user.role = data.roles[0].name;
      this.user.profile = data.profile


      if(
        data.profile == 'avatar-1.png' ||
        data.profile == 'avatar-2.png' ||  
        data.profile == 'avatar-3.png' ||  
        data.profile == 'avatar-4.png' ||  
        data.profile == 'avatar-5.png'
      ){
        this.previewImage= `/images/profiles/default/${data.profile}`;
      } else{
        this.previewImage= `/images/profiles/${data.profile}`;
      }

      $(modalTarget).modal("show");
    },
    getSchools() {
      axios.get("http://127.0.0.1:8000/api/schools").then((res) => {
        this.schools = res.data;
      });
    },
    onImageChange(e){
        this.user.profile = e.target.files[0];

        const input = e.target;
        if (input.files) {
          var reader = new FileReader();
          reader.onload = (e) => {
            this.previewImage = e.target.result;
          }
          reader.readAsDataURL(input.files[0]);
        }

        this.user.uploadProfile = true;
    },
    checkError(){
      if(this.user.name == ""){
        this.errors.name = "nama harus diisi";
        this.errors.countError+=1;
      } else{
        this.errors.name = "";
      }

      if(this.user.email == ""){
        this.errors.email = "email harus diisi";
        this.errors.countError+=1;
      } else{
        this.errors.email = "";
      }

      if(this.user.password == ""){
        this.errors.password = "password harus diisi";
        this.errors.countError+=1;
      } else{
        this.errors.password = "";
      }

      if(this.user.role == "Pilih Role" || this.user.role == ""){
        this.errors.role = "Role harus dipilih";
        this.errors.countError+=1;
      } else{
        this.errors.role = "";
      }

      if(
        this.user.email != "" && 
        !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email)
      ){
        this.errors.email = "masukkan format email dengan benar";
        this.errors.countError+=1;
      } else{
        this.errors.email = "";
      }
    },
    handleSubmit() {
      this.errors.countError = 0;
      this.checkError();
      
      // jika sedang edit, maka password errornya hilangkan
      if(this.user.id != 0 && this.errors.countError == 1){
        this.errors.countError = 0;
      }

      const config = {
        headers: { "Content-Type": "multipart/form-data" },
      };
      
      if(!this.errors.countError){

        this.loadingSubmit = true;
        $("#userModalForm").modal("hide");
  
        if (this.user.id == 0) {
          axios.post("http://127.0.0.1:8000/api/users", this.user, config).then((res) => {
            this.loadingSubmit = false;
            this.loading = true;
            this.$swal(
              "Berhasil Menambah Anggota",
              "Data user telah berhasil ditambah",
              "success"
            );
            const urlRequest =
              this.role == "super admin"
                ? "http://127.0.0.1:8000/api/users"
                : "http://127.0.0.1:8000/api/users?school=" + this.data.school_id;

            axios.get(urlRequest).then((res) => {
              this.loading = false;
              this.users = res.data.data;

              // reset user data
              this.resetUser();
            });
          }).catch((er) => {
            this.$swal(
              "Gagal Menambah Anggota",
              `${er.response.data.message}`,
              "error"
            );
            this.loadingSubmit = false;

            // reset user data
            this.resetUser();
          });
        } else {

          const formData = new FormData();
          formData.append('id', this.user.id);
          formData.append('name', this.user.name);
          formData.append('email', this.user.email);
          formData.append('password', this.user.password);
          formData.append('profile', this.user.profile);
          formData.append('school_id', this.data.school_id);
          formData.append('role', this.user.role);
          formData.append('uploadProfile', this.user.uploadProfile);

          axios
            .put(`http://127.0.0.1:8000/api/users/${this.user.id}`, this.user)
            .then((res) => {
              console.log(res)
              this.loadingSubmit = false;
              this.loading = true;
              this.$swal(
                "Berhasil Edit Data Anggota",
                "Data user telah berubah",
                "success"
              );
              const urlRequest =
                this.role == "super admin"
                  ? "http://127.0.0.1:8000/api/users"
                  : "http://127.0.0.1:8000/api/users?school=" +
                    this.data.school_id;

              axios.get(urlRequest).then((res) => {
                this.loading = false;
                this.users = res.data.data;

                // reset user data
                this.resetUser();
              });
            });
        }
      }
    },
    deleteUser(id) {
      const urlRequest =
        this.role == "super admin"
          ? "http://127.0.0.1:8000/api/users"
          : "http://127.0.0.1:8000/api/users?school=" + this.data.school_id;

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
            axios.get(urlRequest).then((res) => {
              this.$swal(
                "Berhasil Dihapus",
                "Data user telah berhasil dihapus",
                "success"
              );
              this.loading = false;
              this.users = res.data.data;
            });
          });
        }
      });
    },
  },
  mounted() {
    $("#userModalForm").modal({
      backdrop: "static",
    });
    $("#userModalDetail").modal({
      backdrop: "static",
    });

    if (this.role == "super admin") {
      this.user.role = "admin sekolah";
    }

    this.getSchools();

    const urlRequest =
      this.role == "super admin"
        ? "http://127.0.0.1:8000/api/users"
        : "http://127.0.0.1:8000/api/users?school=" + this.data.school_id;

    axios.get(urlRequest).then((res) => {
      this.loading = false;
      this.users = res.data.data;

      this.links = res.data.links;
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