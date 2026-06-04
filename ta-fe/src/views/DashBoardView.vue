<script setup>
import { ref, onMounted } from 'vue'
import { fetchHourlyVisits } from '../api/analyticsApi'
import HourlyVisitsChart from '../components/HourlyVisitsChart.vue'
import StatsCards from '../components/StatsCards.vue'

const visits = ref([])

onMounted(async () => {
  visits.value = await fetchHourlyVisits()
})
</script>

<template>
  <div>
    <h1>Tree Planting Dashboard</h1>

    <StatsCards
      :visits="visits"
    />

    <HourlyVisitsChart
      :visits="visits"
    />
  </div>
</template>