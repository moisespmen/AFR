import axios from 'axios';
import router from './routes.js';

const axiosInstance = axios.create({
    baseURL: import.meta.env.APP_URL,
});

axiosInstance.interceptors.request.use(
    (config) => {
        console.log('config axios')
        const token = localStorage.getItem('token');
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
            localStorage.removeItem('token');
            localStorage.removeItem('user_id');
            localStorage.removeItem('user_name');
            router.push('/');
        }
        return Promise.reject(error);
    }
);

export default axiosInstance;
