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
import { ref, onMounted, watch } from 'vue';
// Import our pre-configured Chart.js instance
import Chart from '../../chart-init';

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

onMounted(() => {
  createChart();
});

watch(() => props.chartData, (newData) => {
  if (chartInstance.value) {
    chartInstance.value.data = newData;
    chartInstance.value.update();
  }
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
