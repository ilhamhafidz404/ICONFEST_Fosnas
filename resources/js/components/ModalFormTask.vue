<template>
	<div
      class="modal fade"
      id="prokerModalForm"
      tabindex="-1"
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
                    :disabled="isSuccessorCancelTask"
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
                    :disabled="isSuccessorCancelTask"
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
                  :disabled="isSuccessorCancelTask"
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
                  <option 
                    v-for="user in users" 
                    :key="user.id" 
                    :value="user.id"
                    :class="{ 'hidden' : user.roles[0].name == 'anggota' }"
                  >
                    {{ user.name }}
                  </option>
                </select> 
                <div class="invalid-feedback">
                  {{ errors.users }}
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer" :class="{ ' flex justify-content-between' : isSuccessorCancelTask }">
            <small class="text-danger" v-if="isSuccessorCancelTask">Tidak bisa edit data yang sudah success / cancel</small>
            <div>
              <button
                @click="resetTask"
                class="btn btn-secondary mr-2"
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
    </div>
</template>

<script>
import { UserGet } from "./../actions/UserGet.js";
export default {
  props: ["role", "data"],
  data () {
    return {

    	users: [],

		task: {
        id: 0,
        name: "",
        status: "progress",
        school_id: this.data.school_id,
        description: "",
        users: [],
      },

      errors: {
        name: "",
        status: "",
        school: "",
        description: "",
        users: "",
      },

      isSuccessorCancelTask: false,
    }
  },
  methods: {
  	async getUsers(page = 1){
      try {
        let result = await UserGet(this.data.school_id, this.filterSearch, 100, page);
        this.users = result.data.data;
      } catch (error) {
        console.error(error);
      }
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
        this.$emit("setLoadingSubmit")
        $("#prokerModalForm").modal("hide");

        if (this.task.id == 0) {
          axios
            .post("http://127.0.0.1:8000/api/tasks", this.task)
            .then((res) => {
              this.$emit("setLoadingSubmit")
              this.$emit("setLoading")
              this.$swal(
                "Berhasil Menambah Program Kerja",
                "Proker telah berhasil ditambah",
                "success"
              );
              this.$emit("getTasks")
              this.resetTask();
            })
            .catch((er) => {
              this.$swal(
                "Gagal Menambah Program Kerja",
                `${er.response.data.message}`,
                "error"
              );
              this.$emit("setLoadingSubmit")
              this.resetTask();
            });
        } else {
          axios
            .put(`http://127.0.0.1:8000/api/tasks/${this.task.id}`, this.task)
            .then((res) => {
              this.$emit("setLoadingSubmit")
              this.$emit("setLoading")
              this.$swal(
                "Berhasil Edit Data Program Kerja",
                "Data proker telah berubah",
                "success"
              );
              this.$emit("getTasks")
              this.resetTask();
            });
        }
      }
    },
  	resetTask() {
      this.task.id = 0;
      this.task.name = "";
      this.task.description = "";
      this.task.status = "progress";
      this.task.users = [];
      this.task.school_id = this.data.school_id;
      this.isSuccessorCancelTask = false

      this.errors.name = "";
      this.errors.status = "";
      this.errors.school = "";
      this.errors.description = "";
      this.errors.users = "";
      this.errors.countError = 0;
    },
 	},
  mounted(){
  	$("#prokerModalForm").modal({
      backdrop: "static",
   });
   this.getUsers();
  }
}
</script>

<style lang="css" scoped>
</style>