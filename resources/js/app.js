
import { createApp } from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
import './bootstrap';
import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import About from './components/About.vue';
import App from './components/App.vue';
import Document from './components/Document.vue';
import '@/assets/scss/app.scss'  // './assets/scss/_variables';

// import router from './routes';

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/document', component: Document },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

const app = createApp(App);

app.use(router);
app.use(VueSweetalert2);

app.mount('#app');
