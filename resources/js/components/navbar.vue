<template>
  <div>
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
      <form class="form-inline mr-auto" @submit.prevent="filteredSearch">
        <ul class="navbar-nav mr-3">
          <li>
            <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"
              ><i class="fas fa-bars"></i
            ></a>
          </li>
          <li>
            <a
              href="#"
              data-toggle="search"
              class="nav-link nav-link-lg d-sm-none"
              ><i class="fas fa-search"></i
            ></a>
          </li>
        </ul>
        <div class="search-element">
          <input
            class="form-control"
            type="search"
            placeholder="Search"
            aria-label="Search"
            data-width="250"
            v-model="filterSearch"
          />
          <button class="btn" type="submit">
            <i class="fas fa-search"></i>
          </button>
          <div class="search-backdrop"></div>
          <div v-if="users.length && tasks.length" class="search-result">
            <div v-if="users.length" class="search-header">User</div>
            <div v-for="user in users" :key="user.id" class="search-item">
              <a href="#">
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
                  class="rounded-circle max-w-[35px] max-h-[35px] object-cover mr-3 inline-block"
                  width="35"
                  data-toggle="tooltip"
                  data-placement="top"
                  :title="data.name"
                />
                {{ user.name }}
              </a>
            </div>

            <div v-if="tasks.length" class="search-header">Proker</div>
            <div v-for="task in tasks" :key="task.id" class="search-item">
              <a href="#">
                <span 
                  class="badge mr-3" 
                  :class="{
                    'badge-success' : task.status == 'success',
                    'badge-warning' : task.status == 'progress',
                    'badge-danger' : task.status == 'cancel',
                  }"
                >
                  {{ task.status }}
                </span>
                {{ task.name }}
              </a>
            </div>
          </div>
          <div v-else class="search-result">
            <div class="search-item">
              <a href="#">
                Tidak Ada Data
              </a>
            </div>
          </div>
        </div>
      </form>
      <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle">
          <a
            href="#"
            data-toggle="dropdown"
            class="nav-link notification-toggle nav-link-lg"
            :class="{ beep: beep }"
            @click="readNotifications"
            ><i class="far fa-bell"></i
          ></a>
          <div
            class="dropdown-menu dropdown-list dropdown-menu-right overflow-hidden"
          >
            <div class="dropdown-header">
              Notifications
              <!-- <div class="float-right">
                <a href="#">Mark All As Read</a>
              </div> -->
            </div>

            <div
              class="dropdown-list-content dropdown-list-icons"
              style="overflow: auto"
            >
              <div v-if="notifications.length">
                <div
                  v-for="notification in notifications"
                  :key="notification.id"
                  class="dropdown-item cursor-pointer"
                >
                  <div
                    class="dropdown-item-icon text-white"
                    :class="{
                      'bg-primary': notification.type == 'notification',
                      'bg-info': notification.type == 'request',
                    }"
                  >
                    <i
                      class="fas"
                      :class="{
                        'fa-bell': notification.type == 'notification',
                        'fa-user': notification.type == 'request',
                      }"
                    ></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b class="font-bold">{{ notification.title }}</b>
                    <p class="leading-5 mt-[5px]">
                      <span v-if="notification.type == 'notification'"
                        >Nama Tugas :
                      </span>
                      {{ notification.body }}
                    </p>

                    <p
                      v-if="notification.status == 'pending'"
                      class="time text-primary"
                    >
                      {{ diffForHuman(notification.created_at) }}
                    </p>
                    <p v-else class="time text-primary">
                      Sudah Dilihat -
                      {{ diffForHuman(notification.created_at) }}
                    </p>
                  </div>
                </div>
              </div>
              <div v-else>
                <div class="dropdown-item cursor-pointer">
                  <p>Tidak ada notifikasi</p>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="dropdown">
          <a
            href="#"
            data-toggle="dropdown"
            class="nav-link dropdown-toggle nav-link-lg nav-link-user"
          >
            <img
              alt="image"
              :src="
                data.profile == 'avatar-1.png' ||
                data.profile == 'avatar-2.png' ||
                data.profile == 'avatar-3.png' ||
                data.profile == 'avatar-4.png' ||
                data.profile == 'avatar-5.png'
                  ? `/images/profiles/default/${data.profile}`
                  : `/images/profiles/${data.profile}`
              "
              class="rounded-circle max-w-[35px] max-h-[35px] object-cover mr-3 inline-block"
              width="35"
              data-toggle="tooltip"
              data-placement="top"
              :title="data.name"
            />
            <div class="inline-block">
              {{ data.name }}
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <!-- <div class="dropdown-title">Logged in 5 min ago</div>
            <a href="features-profile.html" class="dropdown-item has-icon">
              <i class="far fa-user"></i> Profile
            </a>
            <a href="features-activities.html" class="dropdown-item has-icon">
              <i class="fas fa-bolt"></i> Activities
            </a>
            <a href="features-settings.html" class="dropdown-item has-icon">
              <i class="fas fa-cog"></i> Settings
            </a> -->
            <div class="dropdown-divider"></div>
            <a
              href="http://127.0.0.1:8000/confirm-logout"
              class="dropdown-item has-icon text-danger"
            >
              <i class="fas fa-sign-out-alt"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
export default {
  props: ["data"],
  data() {
    return {
      notifications: [],
      beep: false,

      filterSearch: "",

      users: [],
      tasks: [],
    };
  },
  methods: {
    diffForHuman(string) {
      const date = moment(string);
      return date.fromNow();
    },
    //
    filteredSearch() {
      axios.get(`
        http://127.0.0.1:8000/api/users?school=${this.data.school_id}&search=${this.filterSearch}&paginate=3&page=1
      `).then((res) => {
        this.users = res.data.data
      });

      axios.get(`
        http://127.0.0.1:8000/api/tasks?school=${this.data.school_id}&search=${this.filterSearch}&paginate=3&page=1&user=0
      `).then((res) => {
        this.tasks = res.data.data
      });
    },
    getNotifications() {
      axios
        .get(`http://127.0.0.1:8000/api/notifications?user_id=${this.data.id}`)
        .then((res) => {
          this.notifications = res.data;
          this.beep =
            res.data.find((item) => item.status === "pending") !== undefined;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    readNotifications() {
      axios.put(
        `http://127.0.0.1:8000/api/notifications/${this.data.id}?user_id=${this.data.id}`,
        { status: "read" }
      );
    },
  },
  mounted() {
    this.getNotifications();
    setInterval(this.getNotifications, 20000); // Kirim permintaan setiap 20 detik
    this.filteredSearch()
  },
};
</script>

<style>
div.dropdown-list-content.dropdown-list-icons::after {
  display: none !important;
}
</style>