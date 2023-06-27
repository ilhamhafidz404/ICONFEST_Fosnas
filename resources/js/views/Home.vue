<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Home</h1>
      </div>
      <div class="section-body">
        <div class="row align-items-center">
          <div class="col-12 mb-4">
            <div
              class="hero text-white hero-bg-image"
              style="
                background-image: url('/template/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg');
              "
            >
              <div class="hero-inner md:!text-left !text-center">
                <h2>
                  Welcome Back,
                  <span class="font-bold uppercase">{{ data.name }}</span
                  >!
                </h2>
                <p class="lead">
                  Mari kita bangun FOSNAS sebagai Forum OSIS Nasional yang
                  kompeten dan professional.
                </p>
                <div class="mt-4">
                  <button
                    class="btn btn-outline-white btn-lg btn-icon icon-left mr-3"
                    @click="showSchool(school, '#schoolModalDetail')"
                  >
                    <i class="fas fa-school"></i>
                    Lihat Info Sekolah Saya
                  </button>
                  <button
                    v-if="role == 'admin sekolah'"
                    class="btn btn-outline-primary btn-lg btn-icon icon-left sm:mt-0 mt-[15px]"
                    data-bs-toggle="modal"
                    data-bs-target="#schoolModalForm"
                  >
                    <i class="fas fa-pen"></i>
                    Edit Data Sekolah
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--  -->
    <div
      class="modal fade"
      id="schoolModalForm"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title text-xl font-bold">
              <span> Edit Sekolah</span>
            </h1>
            <button
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group mb-1">
                <label>Name</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fas fa-school"></i>
                    </div>
                  </div>
                  <input
                    type="text"
                    class="form-control"
                    :class="{ 'is-invalid': errors.name }"
                    placeholder="Name"
                    v-model="school.name"
                  />
                  <div class="invalid-feedback">
                    {{ errors.name }}
                  </div>
                </div>
              </div>
              <div class="form-group mb-1">
                <label>Address</label>
                <textarea
                  class="form-control min-h-[100px]"
                  :class="{ 'is-invalid': errors.address }"
                  v-model="school.address"
                ></textarea>
                <div class="invalid-feedback">
                  {{ errors.address }}
                </div>
              </div>
              <div class="form-group mb-1">
                <label>Description</label>
                <textarea
                  class="form-control min-h-[100px]"
                  :class="{ 'is-invalid': errors.description }"
                  v-model="school.description"
                ></textarea>
                <div class="invalid-feedback">
                  {{ errors.description }}
                </div>
              </div>
              <div class="form-group mb-1">
                <label>Map</label>
                <textarea
                  class="form-control min-h-[100px]"
                  :class="{ 'is-invalid': errors.map }"
                  v-model="school.map"
                ></textarea>
                <div class="invalid-feedback">
                  {{ errors.map }}
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button
              @click="closeModal"
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
  </div>

  <ModalDetailSchool
    ref="modalSchoolDetail"
    :role="role"
    :data="data"
  ></ModalDetailSchool>
</template>

<script>
import ModalDetailSchool from "./../components/ModalDetailSchool.vue";
export default {
  props: ["role", "data"],
  components: {
    ModalDetailSchool,
  },
  data() {
    return {
      school: {
        id: 0,
        name: "",
        images: "",
        address: "",
        map: "",
        description: "",
        created_at: "",
      },
      errors: {
        name: "",
        address: "",
        description: "",
        images: "",
        map: "",
        countError: 0,
      },
    };
  },
  methods: {
    handleSubmit() {
      this.errors.countError = 0;
      this.checkError();

      if (!this.errors.countError) {
        $("#schoolModalForm").modal("hide");
        axios
          .put(
            `http://127.0.0.1:8000/api/schools/${this.data.school.id}`,
            this.school
          )
          .then((res) => {
            this.$swal(
              "Berhasil Edit Data Sekolah",
              "Data sekolah telah berhasil diedit",
              "success"
            );
          });
      }
    },
    showSchool(data, modalTarget) {
      const modalSchoolDetail = this.$refs.modalSchoolDetail;

      console.log(modalSchoolDetail);

      modalSchoolDetail.school.id = data.id;
      modalSchoolDetail.school.name = data.name;
      modalSchoolDetail.school.description = data.description;
      modalSchoolDetail.school.map = data.map;
      modalSchoolDetail.school.address = data.address;

      $(modalTarget).modal("show");
    },
    getMySchool() {
      axios
        .get(`http://127.0.0.1:8000/api/schools/${this.data.school.id}`)
        .then((res) => {
          this.school.id = res.data.id;
          this.school.name = res.data.name;
          this.school.images = res.data.images;
          this.school.address = res.data.address;
          this.school.map = res.data.map;
          this.school.description = res.data.description;
          this.school.created_at = res.data.created_at;
        });
    },
    checkError() {
      if (this.school.name == "") {
        this.errors.name = "nama harus diisi";
        this.errors.countError += 1;
      } else {
        this.errors.name = "";
      }

      if (this.school.address == "") {
        this.errors.address = "address harus diisi";
        this.errors.countError += 1;
      } else {
        this.errors.address = "";
      }

      if (this.school.description == "") {
        this.errors.description = "description harus diisi";
        this.errors.countError += 1;
      } else {
        this.errors.description = "";
      }
    },
    resetSchoolDataAndErrors() {
      this.school = {
        id: 0,
        name: "",
        address: "",
        description: "",
        images: "",
        map: "",
      };

      this.errors = {
        id: 0,
        name: "",
        address: "",
        description: "",
        images: "",
        map: "",
        countError: 0,
      };
    },
    closeModal() {
      this.resetSchoolDataAndErrors();
      this.getMySchool();
    },
  },
  mounted() {
    this.getMySchool();
  },
};
</script>

<style>
</style>