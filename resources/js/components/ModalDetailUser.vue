<template>
  <div
    class="modal fade"
    id="userModalDetail"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-md">
      <div class="modal-content card author-box card-primary">
        <div class="card-body text-center">
          <div class="text-center">
            <img
              v-if="user.profile"
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
              class="rounded-circle min-w-[130px] min-h-[130px] max-w-[130px] max-h-[130px] mx-auto object-cover"
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
          <div class="mt-[15px]">
            <div class="author-box-name">
              <a href="#">{{ user.name }}</a>
            </div>
            <div class="author-box-job">{{ user.email }}</div>
            <!-- <div class="author-box-description">
              <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                enim ad minim veniam, quis nostrud exercitation ullamco laboris
                nisi ut aliquip ex ea commodo consequat.
              </p>
            </div> -->
            <div class="modal-footer mt-[10px]">
              <button
                @click="closeModal"
                class="btn btn-secondary cursor-pointer"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <!-- <button
                  v-if="role == 'admin sekolah'"
                  @click="giveTask"
                  class="btn btn-primary cursor-pointer"
                >
                  Beri Tugas
                </button> -->
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
  data() {
    return {
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
    };
  },
  methods: {
    closeModal() {
      this.user = {
        id: 0,
        name: "",
        email: "",
        password: "",
        school_id: this.data.school_id,
        profile: "",
        role: "Pilih Role",
      };

      this.$emit("getUser", this.user);
    },
  },
  mounted() {
    $("#userModalDetail").modal({
      backdrop: "static",
    });
  },
};
</script>

<style lang="css" scoped>
</style>