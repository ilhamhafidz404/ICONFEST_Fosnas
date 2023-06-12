<template>
  <div class="main-content">
    <section class="section">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-stats">
              <div class="card-stats-title">
                User Statistics -
                <a class="font-weight-600" href="#" id="orders-month">
                  {{ selectedFilterSchoolName }}
                </a>
              </div>
              <div class="card-stats-items">
                <div class="card-stats-item">
                  <div class="card-stats-item-count">{{ anggotaCount }}</div>
                  <div class="card-stats-item-label">Anggota</div>
                </div>
                <div class="card-stats-item">
                  <div class="card-stats-item-count">{{ pengurusCount }}</div>
                  <div class="card-stats-item-label">Pengurus</div>
                </div>
                <div class="card-stats-item">
                  <div class="card-stats-item-count">
                    FS-{{ selectedFilterSchoolId }}
                  </div>
                  <div class="card-stats-item-label">ID Sekolah</div>
                </div>
              </div>
            </div>
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-archive"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Users</h4>
              </div>
              <div class="card-body">{{ userCount }}</div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h4>Sekolah Anggota FOSNAS</h4>
              <div class="card-header-action">
                <a href="#" class="btn btn-danger"
                  >View More <i class="fas fa-chevron-right"></i
                ></a>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive table-invoice">
                <table class="table table-striped">
                  <tr>
                    <th>ID</th>
                    <th>Nama Sekolah</th>
                    <th>Status</th>
                    <th>Tanggal Bergabung</th>
                    <th>Action</th>
                  </tr>
                  <tr v-for="school in schools" :key="school.id">
                    <td>FS-{{ school.id }}</td>
                    <td class="font-weight-600">{{ school.name }}</td>
                    <td><div class="badge badge-warning">Unpaid</div></td>
                    <td>July 19, 2018</td>
                    <td>
                      <a href="#" class="btn btn-primary">Detail</a>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-md-4">
          <div class="card card-hero">
            <div class="card-header">
              <div class="card-icon">
                <i class="far fa-question-circle"></i>
              </div>
              <h4>14</h4>
              <div class="card-description">Kinerja of The Year</div>
            </div>
            <div class="card-body p-0">
              <div class="tickets-list">
                <a href="#" class="ticket-item">
                  <div class="ticket-title">
                    <h4>My order hasn't arrived yet</h4>
                  </div>
                  <div class="ticket-info">
                    <div>Laila Tazkiah</div>
                    <div class="bullet"></div>
                    <div class="text-primary">1 min ago</div>
                  </div>
                </a>
                <a href="#" class="ticket-item">
                  <div class="ticket-title">
                    <h4>Please cancel my order</h4>
                  </div>
                  <div class="ticket-info">
                    <div>Rizal Fakhri</div>
                    <div class="bullet"></div>
                    <div>2 hours ago</div>
                  </div>
                </a>
                <a href="#" class="ticket-item">
                  <div class="ticket-title">
                    <h4>Do you see my mother?</h4>
                  </div>
                  <div class="ticket-info">
                    <div>Syahdan Ubaidillah</div>
                    <div class="bullet"></div>
                    <div>6 hours ago</div>
                  </div>
                </a>
                <a href="features-tickets.html" class="ticket-item ticket-more">
                  View All <i class="fas fa-chevron-right"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>


<script>
import axios from "axios";
export default {
  props: ["role", "data"],
  data() {
    return {
      //
      selectedFilterSchoolName: this.data.school.name,
      selectedFilterSchoolId: this.data.school.id,

      //
      userCount: 0,
      anggotaCount: 0,
      pengurusCount: 0,
    };
  },
  mounted() {
    console.log(this.data);

    axios
      .get(
        "http://127.0.0.1:8000/api/countUser?schoolId=" + this.data.school_id
      )
      .then((res) => {
        this.userCount = res.data.totalCount;
        this.pengurusCount = res.data.pengurusCount;
        this.anggotaCount = res.data.anggotaCount;
      });
  },
};
</script>

<style>
</style>