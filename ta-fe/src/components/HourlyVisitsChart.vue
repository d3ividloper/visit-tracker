<script setup>
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  BarElement,
  Tooltip,
  Legend
} from 'chart.js'

import { Bar } from 'vue-chartjs'
import { computed } from 'vue'

ChartJS.register(
  CategoryScale,
  LinearScale,
  BarElement,
  Tooltip,
  Legend
)

const props = defineProps({
  visits: {
    type: Array,
    required: true
  }
})

const chartData = computed(() => ({
  labels: props.visits.map(v => v.hour),
  datasets: [
    {
        label: 'Visits',
        data: props.visits.map(v => v.visits),
        backgroundColor: '#4CAF50',
        borderColor: '#2E7D32',
        borderWidth: 2
    }
  ]
}))
</script>

<template>
  <Bar :data="chartData" />
</template>