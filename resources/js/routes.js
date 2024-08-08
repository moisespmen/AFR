import { createRouter, createWebHistory } from 'vue-router';
import App from './components/App.vue';
import Home from './components/Home.vue';
import About from './components/About.vue';
import Document from './components/Document.vue';
import Contact from './components/Contact.vue';
import User from './components/User.vue';

const routes = [
    { path: '/', component: Home },
    { path: '/about', component: About },
    { path: '/contacts', component: Contact },
    { path: '/users', component: User },

    { path: '/document', component: Document },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
