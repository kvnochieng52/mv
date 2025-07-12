

<template>
  <Head title="Dashboard" />
  <div class="section">
    <form @submit.prevent="LoginUser">
      <div class="row">
        <div class="col-12">
          <div class="form-group">
            <label for="name">name</label>
            <input
              type="text"
              name="name"
              class="form-control"
              id="name"
              placeholder="name"
              v-model="form.name"
            />
          </div>
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
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { Head, useForm } from "@inertiajs/vue3";
import DashboardLayout from "../../Layouts/DashboardLayout.vue";

let form = useForm({
  email: "",
  password: "",
  name: "",
});

let LoginUser = () => {
  form.post("/register-user", {
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
