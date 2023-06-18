<template>
  <div>
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
      <form class="form-inline mr-auto">
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
          />
          <button class="btn" type="submit">
            <i class="fas fa-search"></i>
          </button>
          <div class="search-backdrop"></div>
          <div class="search-result">
            <div class="search-header">Histories</div>
            <div class="search-item">
              <a href="#">How to hack NASA using CSS</a>
              <a href="#" class="search-close"><i class="fas fa-times"></i></a>
            </div>
            <div class="search-item">
              <a href="#">Kodinger.com</a>
              <a href="#" class="search-close"><i class="fas fa-times"></i></a>
            </div>
            <div class="search-item">
              <a href="#">#Stisla</a>
              <a href="#" class="search-close"><i class="fas fa-times"></i></a>
            </div>
            <div class="search-header">Result</div>
            <div class="search-item">
              <a href="#">
                <img
                  class="mr-3 rounded"
                  width="30"
                  src="assets/img/products/product-3-50.png"
                  alt="product"
                />
                oPhone S9 Limited Edition
              </a>
            </div>
            <div class="search-item">
              <a href="#">
                <img
                  class="mr-3 rounded"
                  width="30"
                  src="assets/img/products/product-2-50.png"
                  alt="product"
                />
                Drone X2 New Gen-7
              </a>
            </div>
            <div class="search-item">
              <a href="#">
                <img
                  class="mr-3 rounded"
                  width="30"
                  src="assets/img/products/product-1-50.png"
                  alt="product"
                />
                Headphone Blitz
              </a>
            </div>
            <div class="search-header">Projects</div>
            <div class="search-item">
              <a href="#">
                <div class="search-icon bg-danger text-white mr-3">
                  <i class="fas fa-code"></i>
                </div>
                Stisla Admin Template
              </a>
            </div>
            <div class="search-item">
              <a href="#">
                <div class="search-icon bg-primary text-white mr-3">
                  <i class="fas fa-laptop"></i>
                </div>
                Create a new Homepage Design
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
            :class="{ 'beep' : beep }"
            @click="readNotifications"
            ><i class="far fa-bell"></i
          ></a>
          <div class="dropdown-menu dropdown-list dropdown-menu-right overflow-hidden">
            <div class="dropdown-header">
              Notifications
              <div class="float-right">
                <a href="#">Mark All As Read</a>
              </div>
            </div>

            <div class="dropdown-list-content dropdown-list-icons" style="overflow: auto">
              <div 
                v-for="notification in notifications" 
                :key="notification.id"
                class="dropdown-item cursor-pointer"
              >
                <div class="dropdown-item-icon bg-primary text-white">
                  <i class="fas fa-code"></i>
                </div>
                <div class="dropdown-item-desc">
                  <b>{{ notification.title }}</b>
                  <p>Nama Tugas : {{ notification.body }}</p>
                  
                  <p 
                    v-if="notification.status == 'pending'" 
                    class="time text-primary"
                  >
                    {{ diffForHuman(notification.created_at) }}
                  </p>
                  <p v-else class="time text-primary">
                    Sudah Dilihat - {{ diffForHuman(notification.created_at) }}
                  </p>
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
            <!-- <img
              alt="image"
              src="assets/img/avatar/avatar-1.png"
              class="rounded-circle mr-1"
            /> -->
            <div class="d-sm-none d-lg-inline-block">
              {{ data.name }}
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-title">Logged in 5 min ago</div>
            <a href="features-profile.html" class="dropdown-item has-icon">
              <i class="far fa-user"></i> Profile
            </a>
            <a href="features-activities.html" class="dropdown-item has-icon">
              <i class="fas fa-bolt"></i> Activities
            </a>
            <a href="features-settings.html" class="dropdown-item has-icon">
              <i class="fas fa-cog"></i> Settings
            </a>
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
  data(){
    return{
      notifications: [],
      beep: false,
    }
  },
  methods : {
    diffForHuman(string) {
      const date = moment(string);
      return date.fromNow();
    },
    //
    getNotifications() {
      axios.get(`http://127.0.0.1:8000/api/notifications?user_id=${this.data.id}`)
        .then((res) => {
          this.notifications = res.data;
          this.beep = res.data.find(item => item.status === "pending") !== undefined;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    readNotifications(){
      axios.put(`http://127.0.0.1:8000/api/notifications/${this.data.id}?user_id=${this.data.id}`, { status: "read" });
    },
  },
  mounted(){
    this.getNotifications();
    setInterval(this.getNotifications, 20000); // Kirim permintaan setiap 20 detik
  }
};
</script>

<style>
div.dropdown-list-content.dropdown-list-icons::after{
  display: none !important;
}
</style>