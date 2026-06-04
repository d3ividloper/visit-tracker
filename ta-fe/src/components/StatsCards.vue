<script setup>
import { computed } from 'vue'

const props = defineProps({
  visits: {
    type: Array,
    required: true
  }
})

const totalVisits = computed(() =>
  props.visits.reduce(
    (sum, item) => sum + item.visits,
    0
  )
)
</script>

<template>
  <div class="card">
    <h2>Total Visits</h2>
    <p>{{ totalVisits }}</p>
  </div>
</template>