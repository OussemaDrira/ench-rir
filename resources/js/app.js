import { createApp } from 'vue';
import { createRouter, createWebHistory } from "vue-router";
import { routes } from "./routes";
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

import "@fortawesome/fontawesome-free/css/all.css";
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/lara-light-green/theme.css'


import App from './app.vue'
let app = createApp(App)
const router = createRouter({
history: createWebHistory(),
routes: routes,
})
app.use(router);
app.use(router).use(PrimeVue);

app.mount("#app")