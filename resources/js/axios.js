import axios from 'axios';
import router from './routes.js';
import store from './store';

const axiosInstance = axios.create({
    baseURL: import.meta.env.APP_URL,
});

axiosInstance.interceptors.request.use(
    (config) => {
        const token = store.getters.token;

        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

axiosInstance.interceptors.response.use(
    (response) => {
        return response;
    },
    (error) => {
        if (error.response && (error.response.status === 403 || error.response.data.message == 'Unauthenticated.')) {
            store.dispatch('logoff')
            router.push('/');
        }
        return Promise.reject(error);
    }
);

export default axiosInstance;
