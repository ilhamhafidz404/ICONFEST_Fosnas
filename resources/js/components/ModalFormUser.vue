<template>
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
              <span v-if="!user.id"> Tambah Anggota </span>
              <span v-else> Edit Anggota </span>
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
                  'min-w-[130px] min-h-[130px]': previewImage,
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
                    :class="{ 'is-invalid': errors.name }"
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
                    :class="{ 'is-invalid': errors.email }"
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
                    :class="{ 'is-invalid': errors.password }"
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
                  :class="{ 'is-invalid': errors.role }"
                  v-model="user.role"
                >
                  <option selected hidden>Pilih Role</option>
                  <option v-if="user.role == 'admin sekolah'" value="admin sekolah">Admin Sekolah</option>
                  <option value="pengurus osis">Pengurus</option>
                  <option value="anggota">Anggota</option>
                </select>
                <div class="invalid-feedback">
                  {{ errors.role }}
                </div>
              </div>
              <div v-else-if="user.id == 0 && role == 'admin sekolah'" class="form-group">
                <label>Sebagai</label>
                <select class="custom-select" v-model="user.role">
                  <option selected value="admin sekolah">Admin Sekolah</option>
                  <option value="pengurus osis">Pengurus</option>
                  <option value="anggota">Anggota</option>
                </select>
              </div>
              <div v-if="role == 'super admin' && user.id == 0" class="form-group">
                <label>Sekolah</label>
                <select 
                  class="custom-select" 
                  v-model="user.school_id"
                  :class="{ 'is-invalid': errors.school }"
                >
                  <option selected value="1" hidden>Pilih Sekolah</option>
                  <option
                    v-for="school in schools"
                    :key="school.id"
                    :value="school.id"
                  >
                    {{ school.name }}
                  </option>
                </select>
                <div class="invalid-feedback">
                  {{ errors.school }}
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              @click="resetUserDataAndErrors"
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
</template>

<script>
export default {
  props: ["role", "data"],
	data () {
    	return {
    		schools: [],

    		user: {
	        id: 0,
	        name: "",
	        email: "",
	        password: "",
	        profile: "",
	        school_id: this.data.school_id,
	        role: "Pilih Role",
	        uploadProfile: false,
      	},
      	errors: {
	        name: "",
	        email: "",
	        password: "",
	        profile: "",
	        school: "",
	        role: "",
	        countError: 0,
	     	},

	     	// image
      	previewImage: "",
    	}
  	},
  	methods: {
  		// fungsi saat user input profile
  		onImageChange(e) {
	      this.user.profile = e.target.files[0];

	      const input = e.target;
	      if (input.files) {
	        var reader = new FileReader();
	        reader.onload = (e) => {
	          this.previewImage = e.target.result;
	        };
	        reader.readAsDataURL(input.files[0]);
	      }

	      this.user.uploadProfile = true;
	   },

  		handleSubmit() {
      	this.errors.countError = 0;
      	this.checkError();

	      // jika sedang edit, maka password errornya hilangkan
	      if (this.user.id != 0 && this.errors.countError == 1) {
	        this.errors.countError = 0;
	      }

	      const config = {
	        headers: { "Content-Type": "multipart/form-data" },
	      };

      if (!this.errors.countError) {

      	this.$emit("setLoadingSubmit")

        $("#userModalForm").modal("hide");

        if (this.user.id == 0) {
          axios
            .post("http://127.0.0.1:8000/api/users", this.user, config)
            .then((res) => {
              this.$emit("setLoadingSubmit")
              this.$emit("setLoading")
              this.$swal(
                "Berhasil Menambah Anggota",
                "Data user telah berhasil ditambah",
                "success"
              );
              
              this.$emit('getUsers')

              // reset user data
              this.resetUserDataAndErrors();
            })
            .catch((er) => {
              this.$swal(
                "Gagal Menambah Anggota",
                `${er.response.data.message}`,
                "error"
              );
              this.$emit("setLoadingSubmit")

              // reset user data
              this.resetUserDataAndErrors();
            });
        } else {
          axios
            .put(`http://127.0.0.1:8000/api/users/${this.user.id}`, this.user)
            .then((res) => {
              this.$emit("setLoadingSubmit")
              this.$emit("setLoading")
              this.$swal(
                "Berhasil Edit Data Anggota",
                "Data user telah berubah",
                "success"
              );

              this.$emit('getUsers')

              // reset user data
              this.resetUserDataAndErrors();
          });
        }
      }
   },
	   getSchools() {
	      axios.get("http://127.0.0.1:8000/api/schools?search=&paginate=100&page=1").then((res) => {
	        this.schools = res.data.data;
	      });
	   },
	   checkError() {
	      if (this.user.name == "") {
	        this.errors.name = "nama harus diisi";
	        this.errors.countError += 1;
	      } else {
	        this.errors.name = "";
	      }

	      if (this.user.email == "") {
	        this.errors.email = "email harus diisi";
	        this.errors.countError += 1;
	      } else {
	        this.errors.email = "";
	      }

	      if (this.user.password == "") {
	        this.errors.password = "password harus diisi";
	        this.errors.countError += 1;
	      } else {
	        this.errors.password = "";
	      }

	      if (this.user.role == "Pilih Role" || this.user.role == "") {
	        this.errors.role = "Role harus dipilih";
	        this.errors.countError += 1;
	      } else {
	        this.errors.role = "";
	      }

        if (this.user.school_id == this.data.school_id) {
          this.errors.school = "Pilih Sekolah Terlebih dahulu";
          this.errors.countError += 1;
        } else {
          this.errors.school = "";
        }

	      if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.user.email)) {
	        this.errors.email = "masukkan format email dengan benar";
	        this.errors.countError += 1;
	      } else {
	        this.errors.email = "";
	      }
	    },
	   resetUserDataAndErrors() {
	      this.user = {
	        id: 0,
	        name: "",
	        email: "",
	        password: "",
	        school_id: this.data.school_id,
	        profile: "",
	        role: "Pilih Role"
	      };

	      this.errors = {
	        name: "",
	        email: "",
	        password: "",
	        profile: "",
	        school: "",
	        role: "",
	        countError: 0
	      };

	      if (this.role == "super admin") {
		      this.user.role = "admin sekolah";
		   }

	      this.previewImage = "";

	      document.getElementById("profile").value = "";
	   },
 	},
  	mounted(){
  		$("#userModalForm").modal({
	      backdrop: "static",
	   });

	   // super admin hanya bisa buat user dengan role admin sekolah
	   if (this.role == "super admin") {
	      this.user.role = "admin sekolah";
	   }
	   this.getSchools();

     console.log(this.user.role)
  	}
}
</script>

<style lang="css" scoped>
</style>