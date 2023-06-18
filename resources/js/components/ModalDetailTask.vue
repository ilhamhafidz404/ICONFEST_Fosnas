<template>
	<div
      class="modal fade"
      id="prokerModalDetail"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-md">
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
              <h5 class="font-bold mb-2 mt-5">Panitia:</h5>
              <div>
                <span v-for="(user, index) in task.users" :key="user.name">
                  {{ user.name }}
                  <i v-if="task.users.length - 1 != index">, </i>
                </span>
              </div>
            </div>
            <div class="mt-[10px] flex align-items-center justify-content-between">
              <div class="flex justify-content-start align-items-center">
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
		task: {
        id: 0,
        name: "",
        status: "progress",
        school_id: this.data.school_id,
        description: "",
        users: [],
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