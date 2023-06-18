<template>
  <div
      class="modal fade"
      id="schoolModalDetail"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content card author-box card-primary">
          <div class="card-body">
            <h3 class="text-2xl font-bold">{{ school.name }}</h3>
            <hr class="my-4">
            <div v-if="school.map != '-'" v-html="school.map" class="w-full flex justify-content-center"></div>
            <div v-else class="text-center">
              <p>Tidak Ada Map</p>
            </div>
            <hr class="my-2">
            <div class="author-box-description">
              <p class="font-bold">Description:</p>
              <p>
                {{ school.description }}
              </p>
            </div>
            <div class="mt-[10px] flex align-items-center justify-content-between">
              <div class="flex justify-content-start align-items-center">
                <!-- <span v-for="user in task.users" :key="user.id">
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
                </span> -->
              </div>
              <div>
                <button
                  @click="closeModal"
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
export default {
  props: ["role", "data"],
  data () {
    return {
    school: {
        id: 0,
        name: "",
        description: "",
        map: "",
        address: "",
        images: ""
      },
    }
  },
  methods:{
    closeModal(){

      this.task= {
        id: 0,
        name: "",
        status: "progress",
        school_id: this.data.school_id,
        description: "",
        users: [],
      }

      this.$emit("getTask", this.task)
    }
  },
}
</script>

<style lang="css" scoped>
</style>