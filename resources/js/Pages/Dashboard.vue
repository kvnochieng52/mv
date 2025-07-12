<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import DashboardLayout from "../Layouts/DashboardLayout.vue";

// Get stats from props with fallback defaults
</script>

<template>
  <Head title="Dashboard" />

  <DashboardLayout>
    <!-- Welcome Banner -->
    <div class="row mb-4">
      <div class="col-12">
        <h2>Hello World</h2>
      </div>
    </div>
  </DashboardLayout>
</template>
