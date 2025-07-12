<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";

// Define props
const props = defineProps({
  movie: Object,
  averageRate: Number,
});

let ratingList = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

const form = useForm({
  rating: "",
  movie_id: props.movie.id,
});

const submit = () => {
  console.log("FORM RATING: ", form.rating);
  form.post(route("movie.rate"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
  <Head title="Movies" />

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <!-- <h1 class="text-2xl font-bold mb-6">{{ movie.movie_title }}</h1> -->

          <!-- Movies Grid -->
          <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
          ></div>

          <div class="row">
            <div class="col-md-4">
              <img
                :src="movie.movie_image"
                :alt="movie.movie_title"
                class="w-full h-48 object-cover"
              />
            </div>

            <div class="col-md-6">
              <h2 class="text-xl font-semibold mb-2">
                {{ movie.movie_title }}
              </h2>
              <p class="text-gray-600">
                {{ movie.movie_description }}
              </p>

              <h3>Rating: {{ Number($props.averageRate).toFixed(1) }}</h3>

              <hr />
              <form @submit.prevent="submit">
                <label for="rating">Rate this movie:</label>
                <select id="rating" name="rating" v-model="form.rating">
                  <option
                    v-for="rating in ratingList"
                    :value="rating"
                    :key="rating"
                  >
                    {{ rating }}
                  </option>
                </select>
                <button type="submit">Submit</button>
              </form>
            </div>
          </div>

          <!-- Empty State -->
        </div>
      </div>
    </div>
  </div>

  <div class="mt-8 flex justify-center"></div>
</template>