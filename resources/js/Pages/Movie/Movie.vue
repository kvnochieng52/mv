<script setup>
import { Head, Link } from "@inertiajs/vue3";

// Define props
const props = defineProps({
  movies: Array,
  filters: Object,
});
</script>

<template>
  <Head title="Movies" />

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <h1 class="text-2xl font-bold mb-6">Movie List</h1>

          <!-- Search Filter -->
          <div class="mb-6">
            <input
              type="text"
              placeholder="Search movies..."
              class="border rounded px-3 py-2 w-full max-w-md"
            />
          </div>

          <!-- Movies Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div
              v-for="movie in movies.data"
              :key="movie.id"
              class="border rounded-lg overflow-hidden shadow row"
            >
              <div class="col-md-3">
                <img
                  :src="movie.movie_image"
                  :alt="movie.movie_title"
                  class="w-full h-48 object-cover"
                />
              </div>

              <div class="col-md-9">
                <div class="p-4">
                  <h2 class="text-xl font-semibold mb-2">
                    {{ movie.movie_title }}
                  </h2>
                  <p class="text-gray-600 mb-4">
                    {{ movie.movie_description }}
                  </p>
                  <Link
                    class="text-blue-600 hover:text-blue-800"
                    :href="'/movie/' + movie.id"
                  >
                    View Details
                  </Link>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-if="movies.length === 0" class="text-center py-12">
            <p class="text-gray-500">No movies found.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div v-if="movies.data.length === 0" class="text-center py-12">
    <p class="text-gray-500">No movies found.</p>
    <Link
      :href="route('movies.index')"
      class="text-blue-500 hover:underline"
      v-if="filters.search"
    >
      Clear search
    </Link>
  </div>

  <div class="mt-8 flex justify-center">
    <br />
    <nav class="flex items-center space-x-1">
      <template v-for="(link, key) in movies.links" :key="key">
        <Link
          v-if="link.url"
          :href="link.url"
          v-text="link.label"
          class="px-4 py-2 border rounded"
          :class="{
            'bg-blue-500 text-white': link.active,
            'text-gray-700 hover:bg-gray-100': !link.active,
          }"
          preserve-scroll
          preserve-state
        />
        <span v-else v-html="link.label" class="px-4 py-2 text-gray-400"></span>
      </template>
    </nav>
  </div>
</template>