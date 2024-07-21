// resources/js/router.js
import { createRouter, createWebHistory } from 'vue-router';
import App from './components/App.vue';
import Home from './components/Home.vue';
import About from './components/About.vue';
import Document from './components/Document.vue';


const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/document', component: Document },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
