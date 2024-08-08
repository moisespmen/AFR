import { createApp } from 'vue';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import '@fortawesome/fontawesome-free/js/all.js';
import App from './components/App.vue';
import store from './store';
import router from './routes';


const app = createApp(App);
app.use(router);
app.use(store);
app.use(VueSweetalert2);
app.mount('#app');
