<template>
  <div class="col-lg-3 col-6">
    <div :class="`small-box ${bgColor}`">
      <div class="inner">
        <h3>{{ value }}</h3>
        <p>{{ title }}</p>
      </div>
      <div class="icon">
        <i :class="icon"></i>
      </div>
      <a href="#" class="small-box-footer" @click.prevent="$emit('click')">
        {{ linkText }} <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: {
    type: String,
    required: true
  },
  value: {
    type: [String, Number],
    required: true
  },
  icon: {
    type: String,
    default: 'fas fa-chart-bar'
  },
  bgColor: {
    type: String,
    default: 'bg-info'
  },
  linkText: {
    type: String,
    default: 'More info'
  }
});

defineEmits(['click']);
</script>
