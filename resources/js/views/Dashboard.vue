<template>
  <div class="main-content">
    <section class="section">
      <div class="section-header flex items-center justify-between">
        <h1>Dashboard</h1>
        <div>
          <button
            v-if="data.school_id != 1 || role == 'super admin'"
            @click="showGeneralToggle"
            class="btn btn-primary btn-sm"
          >
            <span v-if="!showGeneral">Tampilkan</span>
            <span v-else>Sembunyikan</span>
            General
          </button>
        </div>
      </div>

      <div class="section-body">
        <section v-if="showGeneral">
          <h2 class="section-title">General Statistic</h2>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Anggota</h4>
                  </div>
                  <div class="card-body">{{ general.anggotaCount }}</div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-id-card"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Pengurus</h4>
                  </div>
                  <div class="card-body">{{ general.pengurusCount }}</div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-school"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Sekolah</h4>
                  </div>
                  <div class="card-body">{{ general.schoolCount }}</div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Proker Selesai</h4>
                  </div>
                  <div class="card-body">{{ general.successTaskCount }}</div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <h2
          v-if="(showGeneral && data.school_id != 1) || role == 'super admin'"
          class="section-title"
        >
          School Statistic
        </h2>
        <div v-if="data.school_id != 1 || role == 'super admin'" class="row">
          <div class="col-lg-8 col-12">
            <div class="row">
              <div class="col-md-6 col-12">
                <div class="card card-statistic-2">
                  <div class="card-stats">
                    <div class="card-stats-title">
                      User Statistics -
                      <div
                        v-if="role == 'super admin'"
                        class="dropdown d-inline"
                      >
                        <a
                          class="font-weight-600 dropdown-toggle"
                          data-toggle="dropdown"
                          href="#"
                          id="orders-month"
                        >
                          {{ selectedFilterSchoolName }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-sm shadow-sm">
                          <li class="dropdown-title">Pilih Sekolah</li>
                          <li
                            class="dropdown-item text-sm lowercase cursor-pointer"
                            @click="changeSelectedFilterSchool('All Member', 0)"
                            :class="{
                              'bg-indigo-500 hover:bg-indigo-500 text-white':
                                selectedFilterSchoolName == 'All Member',
                            }"
                          >
                            All Member
                          </li>
                          <li v-for="school in schools" :key="school.id">
                            <span
                              class="dropdown-item text-sm lowercase cursor-pointer"
                              :class="{
                                'bg-indigo-500 hover:bg-indigo-500 text-white':
                                  school.name == selectedFilterSchoolName,
                              }"
                              @click="
                                changeSelectedFilterSchool(
                                  school.name,
                                  school.id
                                )
                              "
                            >
                              {{ school.name }}
                            </span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="card-stats-items">
                      <div class="card-stats-item">
                        <div class="card-stats-item-count">
                          {{ anggotaCount }}
                        </div>
                        <div class="card-stats-item-label">Anggota</div>
                      </div>
                      <div class="card-stats-item">
                        <div class="card-stats-item-count">
                          {{ pengurusCount }}
                        </div>
                        <div class="card-stats-item-label">Pengurus</div>
                      </div>
                      <div class="card-stats-item">
                        <div class="card-stats-item-count">
                          {{ adminCount }}
                        </div>
                        <div class="card-stats-item-label">Admin</div>
                      </div>
                    </div>
                  </div>
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Users</h4>
                    </div>
                    <div class="card-body">{{ userCount }}</div>
                  </div>
                </div>
              </div>

              <!--  -->

              <div class="col-md-6 col-12">
                <div class="card card-statistic-2">
                  <div class="card-stats">
                    <div class="card-stats-title">
                      Proker Statistics -
                      <div
                        v-if="role == 'super admin'"
                        class="dropdown d-inline"
                      >
                        <a
                          class="font-weight-600 dropdown-toggle"
                          data-toggle="dropdown"
                          href="#"
                          id="orders-month"
                        >
                          {{ selectedFilterSchoolNameTask }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-sm shadow-sm">
                          <li class="dropdown-title">Pilih Sekolah</li>
                          <li
                            class="dropdown-item text-sm lowercase cursor-pointer"
                            @click="
                              changeSelectedFilterSchoolTask('All Member', 0)
                            "
                            :class="{
                              'bg-indigo-500 hover:bg-indigo-500 text-white':
                                selectedFilterSchoolNameTask == 'All Member',
                            }"
                          >
                            All Member
                          </li>
                          <li v-for="school in schools" :key="school.id">
                            <span
                              class="dropdown-item text-sm lowercase cursor-pointer"
                              :class="{
                                'bg-indigo-500 hover:bg-indigo-500 text-white':
                                  school.name == selectedFilterSchoolNameTask,
                              }"
                              @click="
                                changeSelectedFilterSchoolTask(
                                  school.name,
                                  school.id
                                )
                              "
                            >
                              {{ school.name }}
                            </span>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="card-stats-items">
                      <div class="card-stats-item">
                        <div class="card-stats-item-count">
                          {{ successCount }}
                        </div>
                        <div class="card-stats-item-label">Success</div>
                      </div>
                      <div class="card-stats-item">
                        <div class="card-stats-item-count">
                          {{ progressCount }}
                        </div>
                        <div class="card-stats-item-label">Progress</div>
                      </div>
                      <div class="card-stats-item">
                        <div class="card-stats-item-count">
                          {{ cancelCount }}
                        </div>
                        <div class="card-stats-item-label">Cancel</div>
                      </div>
                    </div>
                  </div>
                  <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Proker</h4>
                    </div>
                    <div class="card-body">{{ taskCount }}</div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 v-if="role != 'super admin'">
                      Statistik Proker {{ data.school.name }}
                    </h4>
                    <h4 v-else>Statistik Proker Anggota FOSNAS</h4>
                    <div class="card-header-action"></div>
                  </div>
                  <div class="card-body sm:block hidden">
                    <TaskChart
                      v-if="!loading"
                      :chartData="chartData"
                      :options="chartOptions"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-12">
            <div class="card card-hero">
              <div class="card-header">
                <div class="card-icon">
                  <i class="far fa-question-circle"></i>
                </div>
                <!-- <h4>3</h4> -->
                <div class="card-description">
                  <h5 class="text-xl">Proker On Progress</h5>
                </div>
              </div>
              <div class="card-body p-0">
                <div class="tickets-list">
                  <div
                    v-for="task in taskOnProgress"
                    :key="task.id"
                    href="#"
                    class="ticket-item"
                  >
                    <div class="ticket-title">
                      <h4>{{ task.name }}</h4>
                    </div>
                    <div class="ticket-info mt-2">
                      <div>
                        <span v-if="role != 'super admin'" class="flex">
                          <img
                            v-for="user in task.users"
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
                            width="20"
                            data-toggle="tooltip"
                            data-placement="top"
                            :title="user.name"
                          />
                        </span>
                        <span v-else>
                          {{ task.school.name }}
                        </span>
                      </div>
                      <div class="bullet"></div>
                      <div class="text-primary">
                        {{ diffForHuman(task.created_at) }}
                      </div>
                    </div>
                  </div>
                  <a
                    href="features-tickets.html"
                    class="ticket-item ticket-more"
                  >
                    View All <i class="fas fa-chevron-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import moment from "moment";
import TaskChart from "../components/TaskChart.vue";

export default {
  props: ["role", "data"],
  components: {
    TaskChart,
  },
  data() {
    return {
      taskOnProgress: [],

      //
      userCount: 0,
      anggotaCount: 0,
      pengurusCount: 0,
      adminCount: 0,
      //
      taskCount: 0,
      cancelCount: 0,
      successCount: 0,
      progressCount: 0,
      //
      general: {
        anggotaCount: 0,
        pengurusCount: 0,
        schoolCount: 0,
        successTaskCount: 0,
      },
      //
      schools: [],
      selectedFilterSchoolName: "All Member",
      selectedFilterSchoolId: 0,
      //
      selectedFilterSchoolNameTask: "All Member",
      selectedFilterSchoolIdTask: 0,

      showGeneral: true,
      loading: true,
    };
  },
  methods: {
    diffForHuman(string) {
      const date = moment(string);
      return date.fromNow();
    },
    showGeneralToggle() {
      this.showGeneral = !this.showGeneral;
    },

    changeSelectedFilterSchoolTask(selectedName, selectedId) {
      this.selectedFilterSchoolNameTask = selectedName;
      this.selectedFilterSchoolIdTask = selectedId;

      // get count user by id
      if (selectedId != 0) {
        axios
          .get(`http://127.0.0.1:8000/api/countTask?schoolId=${selectedId}`)
          .then((res) => {
            this.taskCount = res.data.taskCount;
            this.successCount = res.data.successCount;
            this.progressCount = res.data.progressCount;
            this.cancelCount = res.data.cancelCount;
          });
      } else {
        axios
          .get(
            `http://127.0.0.1:8000/api/countTask?schoolId=${this.data.school_id}`
          )
          .then((res) => {
            this.taskCount = res.data.taskCount;
            this.successCount = res.data.successCount;
            this.progressCount = res.data.progressCount;
            this.cancelCount = res.data.cancelCount;
          });
      }
    },

    changeSelectedFilterSchool(selectedName, selectedId) {
      this.selectedFilterSchoolName = selectedName;
      this.selectedFilterSchoolId = selectedId;

      // get count user by id
      if (selectedId != 0) {
        axios
          .get("http://127.0.0.1:8000/api/countUser?schoolId=" + selectedId)
          .then((res) => {
            this.userCount = res.data.totalCount;
            this.pengurusCount = res.data.pengurusCount;
            this.anggotaCount = res.data.anggotaCount;
          });
      } else {
        axios
          .get(
            `http://127.0.0.1:8000/api/countUser?schoolId=${this.data.school_id}`
          )
          .then((res) => {
            this.userCount = res.data.totalCount;
            this.pengurusCount = res.data.pengurusCount;
            this.anggotaCount = res.data.anggotaCount;
            this.adminCount = res.data.adminCount;
          });
      }
    },
  },
  computed: {
    chartData() {
      return {
        labels: [
          "Januari",
          "Februari",
          "Maret",
          "April",
          "Mei",
          "Juni",
          "Juli",
          "Agustus",
          "September",
          "Oktober",
          "November",
          "Desember",
        ],
        datasets: [
          {
            label: "Success",
            backgroundColor: "#63ed7a",
            data: [0],
          },
          {
            label: "Progress",
            backgroundColor: "#ffc107",
            data: [0],
          },
          {
            label: "Cancel",
            backgroundColor: "#fc544b",
            data: [0],
          },
        ],
      };
    },
    chartOptions() {
      return {
        responsive: true,
      };
    },
  },
  mounted() {
    axios
      .get(`http://127.0.0.1:8000/api/dashboard?school=${this.data.school_id}`)
      .then((res) => {
        this.loading = false;
        // setting chart
        this.chartData.datasets[0].data = res.data.taskForChart.success;
        this.chartData.datasets[1].data = res.data.taskForChart.progress;
        this.chartData.datasets[2].data = res.data.taskForChart.cancel;

        // get task
        this.taskOnProgress = res.data.taskOnProgress;
      });

    axios
      .get(
        `http://127.0.0.1:8000/api/countUser?schoolId=${this.data.school_id}`
      )
      .then((res) => {
        this.userCount = res.data.totalCount;
        this.pengurusCount = res.data.pengurusCount;
        this.anggotaCount = res.data.anggotaCount;
        this.adminCount = res.data.adminCount;
      });

    // get Task
    axios
      .get(
        `http://127.0.0.1:8000/api/countTask?schoolId=${this.data.school_id}`
      )
      .then((res) => {
        this.taskCount = res.data.taskCount;
        this.successCount = res.data.successCount;
        this.progressCount = res.data.progressCount;
        this.cancelCount = res.data.cancelCount;
      });

    axios.get(`http://127.0.0.1:8000/api/countGeneral`).then((res) => {
      this.general.anggotaCount = res.data.anggotaCount;
      this.general.pengurusCount = res.data.pengurusCount;
      this.general.schoolCount = res.data.schoolCount;
      this.general.successTaskCount = res.data.successTaskCount;
    });
    // get school
    axios
      .get("http://127.0.0.1:8000/api/schools?search=&paginate=100&page=1")
      .then((res) => {
        this.schools = res.data.data;
      });
  },
};
</script>

<style>
</style>
