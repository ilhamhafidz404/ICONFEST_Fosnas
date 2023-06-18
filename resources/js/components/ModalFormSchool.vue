<template>
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
              <span v-if="!school.id"> Tambah Sekolah </span>
              <span v-else> Edit Sekolah </span>
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
              @click="resetSchoolDataAndErrors"
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

    		school: {
	        id: 0,
	        name: "",
	        address: "",
	        description: "",
	        images: "",
	        map: ""
      	},
      	errors: {
	        name: "",
	        address: "",
	        description: "",
	        images: "",
	        map: "",
	        countError: 0,
	     	},

	     	// image
      	previewImage: "",
    	}
  	},
  	methods: {
  		handleSubmit(){
  			this.$emit("setLoadingSubmit")
  			$("#schoolModalForm").modal("hide");
  			axios.post("http://127.0.0.1:8000/api/schools", this.school).then((res) =>{
  				this.$emit("setLoadingSubmit")
           	this.$emit("setLoading")

           	this.$emit('getSchools')

           this.$swal(
             "Berhasil Menambah Sekolah",
             "Data sekolah telah berhasil ditambah",
             "success"
           );

           this.resetSchoolDataAndErrors();
  			}).catch((error) =>{
  				console.log(error)
  			})
  		},
      resetSchoolDataAndErrors() {
        this.school = {
          id: 0,
          name: "",
          address: "",
          description: "",
          images: "",
          map: ""
        };

        this.errors = {
          id: 0,
          name: "",
          address: "",
          description: "",
          images: "",
          map: "",
          countError: 0
        };
     }
 	},
  	mounted(){
  		$("#schoolModalForm").modal({
	      backdrop: "static",
	   });
  	}
}
</script>

<style lang="css" scoped>
</style>