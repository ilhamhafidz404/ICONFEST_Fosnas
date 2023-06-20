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
              <div class="hero-inner">
                <h2>
                  Welcome Back,
                  <span class="font-bold uppercase">{{ data.name }}</span
                  >!
                </h2>
                <p class="lead">
                  You almost arrived, complete the information about your
                  account to complete registration.
                </p>
                <div class="mt-4">
                  <a
                    href="#"
                    class="btn btn-outline-white btn-lg btn-icon icon-left"
                    ><i class="far fa-user"></i> Setup Account</a
                  >
                </div>
              </div>
            </div>
          </div>
          <div v-if="role != 'super admin'" class="col-md-6">
            <div
              id="carouselExampleIndicators"
              class="carousel slide rounded overflow-hidden"
            >
              <div class="carousel-indicators">
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="0"
                  class="active"
                  aria-current="true"
                  aria-label="Slide 1"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="1"
                  aria-label="Slide 2"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="2"
                  aria-label="Slide 3"
                ></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img
                    src="/template/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg"
                    class="d-block w-100"
                    alt="..."
                  />
                </div>
                <div class="carousel-item">
                  <img
                    src="/template/img/unsplash/andre-benz-1214056-unsplash.jpg"
                    class="d-block w-100"
                    alt="..."
                  />
                </div>
                <div class="carousel-item">
                  <img
                    src="/template/img/unsplash/eberhard-grossgasteiger-1207565-unsplash.jpg"
                    class="d-block w-100"
                    alt="..."
                  />
                </div>
              </div>
              <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev"
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
              </button>
              <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next"
              >
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                ></span>
              </button>
            </div>
          </div>
          <div v-if="role != 'super admin'" class="col-md-6">
            <div class="flex align-items-center justify-content-between">
              <h1 class="text-2xl font-bold">Informasi Sekolahmu</h1>
              <button
                v-if="role == 'admin sekolah'"
                class="btn btn-sm btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#schoolModalForm"
              >
                Edit Data Sekolah
              </button>
            </div>
            <h2 class="mt-4 text-xl font-semibold">{{ school.name }}</h2>
            <p>{{ school.address }}</p>
            <p>{{ school.description }}</p>
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
                      <i class="fas fa-user"></i>
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
                  class="form-control"
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
                  class="form-control"
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
                  class="form-control"
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
</template>

<script>
export default {
  props: ["role", "data"],
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