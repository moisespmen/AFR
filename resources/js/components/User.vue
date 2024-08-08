<template>
    <div class="card-document user-table table-responsive">
        <div class="row mb-3">
            <h4>Usuários</h4>
        </div>
        <table class="table table table-striped table-hover table-sm align-middle">
            <thead>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Criação</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="index">
                    <td>
                        <button type="button" class="btn btn-primary btn-sm" @click="edit(user)">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ formatDate(user.created_at) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from '../axios';
import moment from 'moment';
export default {
    data() {
        return {
            users: [],
            loading: false,
        }
    },
    computed: {

    },
    methods: {
        edit(user){

        },
        getUsers() {
            const vm = this;
            vm.loading = true
            axios.get('/api/users')
                .then((response) => {
                    vm.users = response.data;
                }).catch((error) => {
                    console.log(error)
                }).finally(() => {
                    vm.loading = false
                })
        },
        formatDate(date) {
            return moment(date).format('D/MM/Y')
        }
    },
    mounted() {
        this.getUsers();
    }
}

</script>



<style>
.card-document {
    height: 100vh;
}

.user-table {
    padding-right: 20px;
    padding-left: 20px;
}

.card {
    height: 90%;
    width: 90%;
    margin: 0;
    padding: 0;
}
</style>
