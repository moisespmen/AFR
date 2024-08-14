import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import Document from './components/Document.vue';
import Contact from './components/Contact.vue';
import User from './components/User.vue';
import About from './components/About.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/contacts', component: Contact },
    { path: '/users', component: User },
    { path: '/document', component: Document },
    { path: '/about', component: About}
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
