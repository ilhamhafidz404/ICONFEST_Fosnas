<template>
  <div class="main-content"></div>
</template>

<script>
import axios from "axios";
export default {
  props: ["role"],
  data() {
    return {
      //
      schools: [],
      selectedFilterSchoolName: "All Member",
      selectedFilterSchoolId: 0,

      //
      userCount: 0,
      anggotaCount: 0,
      pengurusCount: 0,
      schoolCount: 0,
    };
  },
  methods: {
    changeSelectedFilterSchool(selectedName, selectedId) {
      this.selectedFilterSchoolName = selectedName;
      this.selectedFilterSchoolId = selectedId;

      // get count user by id
      if (selectedId != 0) {
        axios
          .get("http://127.0.0.1:8000/api/countUser?schoolId=" + selectedId)
          .then((res) => {
            this.userCount = res.data.userCount;
            this.pengurusCount = res.data.pengurusCount;
            this.anggotaCount = res.data.anggotaCount;
          });
      } else {
        axios.get("http://127.0.0.1:8000/api/countUser").then((res) => {
          this.userCount = res.data;
          this.pengurusCount = res.data.pengurusCount;
          this.anggotaCount = res.data.anggotaCount;
        });
      }
    },
  },
  mounted() {
    // console.log(this.role);
    if (this.role == "super admin") {
      this.$router.push("/dashboard");
    } else if (this.role == "admin sekolah") {
      this.$router.push("/adminsekolah/dashboard");
    } else if (this.role == "pengurus osis") {
      this.$router.push("/pengurusosis/dashboard");
    } else if (this.role == "anggota") {
      this.$router.push("/anggota/dashboard");
    }
    axios.get("http://127.0.0.1:8000/api/countUser").then((res) => {
      this.userCount = res.data.totalCount;
      this.pengurusCount = res.data.pengurusCount;
      this.anggotaCount = res.data.anggotaCount;
    });
    axios.get("http://127.0.0.1:8000/api/countSchool").then((res) => {
      this.schoolCount = res.data;
    });
    axios.get("http://127.0.0.1:8000/api/schools").then((res) => {
      this.schools = res.data;
    });
  },
};
</script>

<style>
</style>