// Import Vue and Inertia
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

// Import Bootstrap.js
import './bootstrap';

// Load AdminLTE JS and other dependencies
import 'admin-lte/dist/js/adminlte.min.js';
import '@fortawesome/fontawesome-free/js/all.min.js';

// Direct mapping of component names to their import functions
const pages = {
  Test: () => import('./Pages/Test.vue'),
  Dashboard: () => import('./Pages/Dashboard.vue')
};

// Get page data from the global variable we set in the blade template
const initialPage = window.initialPage || null;

// Initialize Inertia with explicit page data
createInertiaApp({
  // Use our direct component resolution
  resolve: name => pages[name](),
  
  // Use provided initialPage or null
  page: initialPage,
  
  // Standard setup function
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el);
  },
}).then(() => {
  console.log('Inertia initialized successfully!');
}).catch(error => {
  console.error('Inertia initialization error:', error);
});

// Debug info to help troubleshoot
console.log('App setup completed. Available pages:', Object.keys(pages).join(', '));

