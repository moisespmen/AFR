import { createStore } from 'vuex';
import axios from './axios';
import createPersistedState from "vuex-persistedstate";

const store = createStore({
    state: {
        user: null,
        token: null
    },

    mutations: {
        setToken(state, token) {
            state.token = token;
        },
        clearToken(state) {
            state.token = null
        },
        setUser(state, user) {
            state.user = user;
        },
        clearUser(state) {
            state.user = null;
        },
    },

    actions: {
        saveToken({ commit }, token) {
            commit('setToken', token);
        },
        fetchUser({ commit, state }) {
            if (!state.user) {
                axios.get('/api/user/me')
                    .then((response) => {
                        console.log(response.data);
                        const userResponse = response.data.user;
                        commit('setUser', userResponse);
                    })
                    .catch((error) => {
                        commit('setUser', null);
                        console.log('not user', error);
                    });
            } else {
                return state.user;
            }
        },
        logout({ commit }) {
            axios.post('/api/logout')
                .then((response) => {
                    commit('clearUser');
                    commit('clearToken');
                }).catch((error) => {
                    console.error('Logout failed:', error);
                });
        },
    },

    getters: {
        token: (state) => state.token,
        isAuthenticated: state => !!state.user,
        getUser: (state) => state.user
    },

    plugins: [createPersistedState()],
});

export default store;


