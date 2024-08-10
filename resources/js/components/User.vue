<template>
    <div class="card-document user-table table-responsive">
        <div class="row mb-3">
            <h4>Usuários</h4>
        </div>
        <div class="row mb-3">
            <div class="col">
                <v-btn class="text-none text-subtitle-1" color="rgb(0, 46, 93)" size="small" variant="flat"
                    @click="edit(null)">
                    <i class="fa-solid fa-plus"></i> Novo Usuário
                </v-btn>
            </div>
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
                        <v-btn class="text-none text-subtitle-1" color="rgb(0, 46, 93)" size="small" variant="flat"
                            @click="edit(user)">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </v-btn>
                    </td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ formatDate(user.created_at) }}</td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="modalUser" aria-hidden="true">
            <v-overlay :model-value="loading" class="align-center justify-center">
                <v-progress-circular color="primary" size="64" indeterminate></v-progress-circular>
            </v-overlay>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            {{ user.name && user.id ? user.name : "Novo usuário" }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nome:</label>
                                <input type="text" class="form-control" v-model="user.name">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" v-model="user.email">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Senha:</label>
                                <input type="password" class="form-control" v-model="user.password">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Confirma:</label>
                                <input type="password" class="form-control" v-model="user.confirm">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <v-btn :disabled="loadingUser" class="text-none text-subtitle-1" color="rgb(0, 46, 93)"
                            size="small" variant="flat" @click="save()">
                            <i class="fa-solid fa-floppy-disk"></i> Salvar
                        </v-btn>
                        <v-btn :disabled="loadingUser" class="text-none text-subtitle-1"
                            size="small" variant="secondary" data-bs-dismiss="modal">
                            Fechar
                        </v-btn>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from '../axios';
import moment from 'moment';
import { Modal } from 'bootstrap';
export default {
    data() {
        return {
            users: [],
            loading: false,
            loadingUser: false,
            error: "",
            user: {
                id: "",
                name: "",
                email: "",
                password: "",
                confirm: ""
            },
            modalElement: null
        }
    },
    computed: {
        validUser() {
            let valid = true;
            if (!this.user) {
                this.error = 'Erro ao salvar usuário'
                valid = false
            } else if (!this.user.id && !this.user.password) {
                this.error = 'Informe uma senha válida'
                valid = false
            } else if (this.user.password && (!this.user.confirm || this.user.password !== this.user.confirm)) {
                this.error = 'A senha não é igual a confirmação'
                valid = false
            } else if (this.user.password && this.user.password.length < 6) {
                this.error = 'Senha muito curta'
                valid = false
            } if (!this.valEmail(this.user.email)) {
                this.error = 'Email inválido'
                valid = false
            }

            return valid
        },
    },
    methods: {
        save() {
            const vm = this
            if (!this.validUser) {
                vm.$swal({
                    icon: 'warning',
                    title: 'Atenção',
                    text: this.error
                });
                return
            }
            vm.loading = true
            axios.post('/api/user', vm.user)
                .then((response) => {
                    if (vm.modalInstance) {
                        vm.modalInstance.hide();
                    }
                    vm.user = {
                        id: "",
                        name: "",
                        email: "",
                        password: "",
                        confirm: ""
                    }
                    vm.getUsers();
                }).catch((error) => {
                    console.log(error)
                    vm.$swal({
                        icon: 'warning',
                        title: 'Atenção',
                        text: error.data
                    });
                }).finally(() => {
                    vm.loading = false
                })
        },
        edit(user) {
            if (user) {
                this.user = user
            } else {
                this.user = {
                    id: "",
                    name: "",
                    email: "",
                    password: "",
                    confirm: ""
                }
            }
            const modalElement = document.getElementById('modalUser');
            this.modalInstance = new Modal(modalElement);
            this.modalInstance.show();
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
            return moment(date).format('DD/MM/Y')
        },
        valEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
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

.bts {
    color: blueviolet;
}
</style>
