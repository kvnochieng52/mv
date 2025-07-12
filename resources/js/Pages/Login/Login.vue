

<template>
  <Head title="Dashboard" />

  <!-- Welcome Banner -->
  <form @submit.prevent="LoginUser">
    <div class="row">
      <div class="col-12">
        <div class="form-group">
          <label for="email">email</label>
          <input
            type="text"
            name="email"
            class="form-control"
            id="email"
            placeholder="email"
            v-model="form.email"
          />
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            class="form-control"
            id="password"
            placeholder="Password"
            v-model="form.password"
          />
        </div>
        <button type="submit" class="btn btn-primary">Login</button> &nbsp;
        <a href="/user-register" class="btn btn-info">Register</a>
      </div>
    </div>
  </form>
</template>

<script setup>
import { ref } from "vue";
import { Head, useForm } from "@inertiajs/vue3";
import DashboardLayout from "../../Layouts/DashboardLayout.vue";

let form = useForm({
  email: "",
  password: "",
});

let LoginUser = () => {
  form.post("/login-process", {
    preserveScroll: true,
    onSuccess: () => {
      // Reset form after successful submission
      form.reset();
      // Show success message
      console.log("sucesss");
    },
    onError: () => {
      console.log("failes");
    },
  });
};
</script>
