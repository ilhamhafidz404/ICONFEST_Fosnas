<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Aktifitas</h1>
      </div>
      <div class="section-body">
        <div v-if="!loading" class="row">
          <div class="col-12">
            <div v-if="activities.length" class="activities">
              <div v-for="activity in activities" :key="activity.id" class="activity">
                <div 
                  class="activity-icon text-white"
                  :class="{ 
                    'bg-primary shadow-primary' : activity.status == 'success',
                    'bg-secondary shadow-secondary' : activity.status == 'cancel',
                  }"
                >
                  <i 
                    class="far text-xl" 
                    :class="{ 
                      'fa-thumbs-up' : activity.status == 'success',
                      'fa-thumbs-down' : activity.status == 'cancel', 
                    }"
                  ></i>
                </div>
                <div class="activity-detail min-w-[300px]">
                  <div class="mb-2">
                    <span class="text-job font-semibold">{{ activity.name }}</span>
                    <span class="bullet"></span>
                    <span class="text-job text-primary">{{ diffForHuman(activity.updated_at) }}</span>
                  </div>
                  <p>{{ activity.description }}</p>

                  <div class="flex mt-[20px]">
                    <img
                      v-for="user in activity.users"
                      :key="user.id"
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
                      class="rounded-circle max-w-[20px] max-h-[20px] object-cover"
                      width="35"
                      data-toggle="tooltip"
                      data-placement="top"
                      :title="user.name"
                    />
                  </div>
                  <p v-if="role == 'super admin'" class="text-primary">{{ activity.school.name }}</p>
                </div>
              </div>
            </div>
            <div v-else class="card">
              <div class="card-body">
                <div class="empty-state" data-height="400">
                  <div class="empty-state-icon">
                    <i class="fas fa-question"></i>
                  </div>
                  <h2>Tidak ada data aktifitas yang ditemukan</h2>
                  <p class="lead">
                    Silahkan selesaikan 1 program kerja untuk record activity anda!
                  </p>
                  <router-link to="/tasks" class="btn btn-primary mt-4">Lihat Program Kerja</router-link>
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
      </div>
    </section>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
export default {
  props: ["role", "data"],
  data () {
    return {
      activities: [],
      loading: true,
    }
  },
  methods : {
    diffForHuman(string) {
      const date = moment(string);
      return date.fromNow();
    },
  },
  mounted(){
    const urlRequest =
      this.role == "super admin"
        ? "http://127.0.0.1:8000/api/activities"
        : "http://127.0.0.1:8000/api/activities?school=" + this.data.school_id;

    axios.get(urlRequest).then((res) => {
      this.loading = false;
      this.activities= res.data;
    })
  }
}
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