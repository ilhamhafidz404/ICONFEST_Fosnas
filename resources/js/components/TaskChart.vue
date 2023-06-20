<template>
  <Bar id="taskChart" :options="chartOptions" :data="chartData" />
</template>

<script>
import { Bar } from "vue-chartjs";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
} from "chart.js";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
);

export default {
  props: ["chartData", "options"],
  components: { Bar },
  data() {
    return {
      taskData: [],
      chartData: this.chartData,
      chartOptions: this.options,
    };
  },
};
</script>