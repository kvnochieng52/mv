<template>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">{{ title }}</h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button v-if="isRemovable" type="button" class="btn btn-tool" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div class="chart-container" style="position: relative; height: 300px;">
        <canvas :id="chartId"></canvas>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch, nextTick } from 'vue';
// Import our pre-configured Chart.js instance
import Chart from '../../chart-init';
// Import Inertia stuff to detect navigation
import { router } from '@inertiajs/vue3';

const props = defineProps({
  title: {
    type: String,
    default: 'Chart'
  },
  chartId: {
    type: String,
    required: true
  },
  chartData: {
    type: Object,
    required: true
  },
  chartOptions: {
    type: Object,
    default: () => ({})
  },
  isRemovable: {
    type: Boolean,
    default: true
  }
});

const chartInstance = ref(null);

// Initialize the chart and handle cleanup
function initChart() {
  // Destroy existing chart if it exists to prevent duplicates
  if (chartInstance.value) {
    chartInstance.value.destroy();
    chartInstance.value = null;
  }
  
  // Use nextTick to ensure DOM is fully updated
  nextTick(() => {
    // Small delay to ensure the DOM is fully rendered
    setTimeout(() => {
      createChart();
    }, 50);
  });
}

// Initialize chart when component is mounted
onMounted(() => {
  initChart();
  
  // Listen for Inertia navigation events to reinitialize charts
  router.on('finish', () => {
    // After navigation is complete, reinitialize charts
    initChart();
  });
});

// Watch for changes in chart data and re-render if needed
watch(() => props.chartData, () => {
  initChart();
}, { deep: true });

function createChart() {
  const ctx = document.getElementById(props.chartId);
  if (ctx) {
    // For Chart.js v4, we need to handle the data structure properly
    // Determine if we have a nested data structure (preferred) or not
    const data = props.chartData.data ? props.chartData.data : props.chartData;
    const type = props.chartData.type || 'line';
    
    try {
      // Create chart with proper structure for Chart.js v4
      chartInstance.value = new Chart(ctx, {
        type: type,
        data: data,
        options: props.chartOptions
      });
      console.log(`Chart created successfully: ${props.chartId}`);
    } catch (error) {
      console.error(`Error creating chart ${props.chartId}:`, error);
    }
  } else {
    console.warn(`Canvas element not found for chart: ${props.chartId}`);
  }
}
</script>
