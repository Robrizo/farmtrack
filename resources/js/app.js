import './bootstrap';
// import { createApp } from 'vue';
// import App from './components/App.vue';
// import router from './router/index.js';

// createApp(App).use(router).mount('#app')

import { createApp } from 'vue';
import App from './components/App.vue';
import router from './router/index.js';
import { TailwindPagination } from 'laravel-vue-pagination';

const app = createApp(App);
app.component('tailwind-pagination', TailwindPagination);
app.use(router);
app.mount('#app');




