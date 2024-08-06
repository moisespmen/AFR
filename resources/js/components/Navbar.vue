<template>
    <div>
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <button class="navbar-toggler border-light" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="text-light"><i class="fa-solid fa-bars"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <router-link class="nav-link active text-light" to="/">
                                <i class="fa-solid fa-house"></i> Inicio
                            </router-link>
                        </li>
                        <!-- <li class="nav-item">
                            <router-link class="nav-link active text-light" to="/about">
                                <i class="fa-solid fa-circle-info"></i> Sobre</router-link>
                        </li>-->
                        <li class="nav-item">
                            <router-link class="nav-link active text-light" to="/document">
                                <i class="fa-solid fa-file"></i> Documentos</router-link>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown" v-if="!hasUser">
                            <a class="nav-link text-light" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-user"></i> Acessar
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 260px;">
                                <li>
                                    <form class="p-3">
                                        <div class="row">
                                            <div class="col">
                                                <label for="" class="form-label">Login</label>
                                                <input type="text" class="form-control" v-model="formData.login">
                                            </div>
                                        </div>
                                        <div class="mb-3"></div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Senha</label>
                                            <input type="password" class="form-control" v-model="formData.password">
                                        </div>
                                        <button class="btn btn-primary" @click.prevent="login()">
                                            <i class="fa-solid fa-door-open"></i> Entrar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" v-else>
                            <a class="nav-link text-light" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-user"></i> {{ getUserName }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 260px;">
                                <li>
                                    <button class="btn btn-outline-light btn-sm" data-bs-target="#modalSenha"
                                        data-bs-toggle="modal" style="color:black"><i class="fa-solid fa-lock"></i>
                                        Alterar Senha </button>
                                </li>
                                <li class="mt-3">
                                    <button class="btn btn-outline-light btn-sm" style="color:black" @click="logoff"><i
                                            class="fa-solid fa-right-from-bracket"></i> Sair</button>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="modal fade" id="modalSenha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-key"></i> Alterar
                            Senha</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="">Senha Atual</label>
                                <input type="password" class="form-control" :disabled="loadingSenha"
                                    v-model="senha.atual">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="">Nova Senha</label>
                                <input type="password" class="form-control" :disabled="loadingSenha"
                                    v-model="senha.nova">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <label for="">Confirmação</label>
                                <input type="password" class="form-control" :disabled="loadingSenha"
                                    v-model="senha.confirmacao">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" :disabled="loadingSenha"
                            @click="alterarSenha()">
                            <i class="fa-solid fa-floppy-disk"></i> Salvar
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                            :disabled="loadingSenha">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from '../axios';
import { mapActions } from 'vuex';
// import store from '../store';

export default {
    data() {
        return {
            senha: {
                atual: "",
                nova: "",
                confirmacao: ""
            },
            formData: {
                login: '',
                password: ''
            },
            userName: "",
            loadingSenha: false
        };
    },

    computed: {

        getUserName() {
            return this.$store.state.user.name;
        },
        hasUser(){
            return this.$store.state.user;
        }
    },

    methods: {
        ...mapActions(['saveToken']),
        logoff(){
            this.$store.dispatch('logout');
        },
        alterarSenha() {
            const vm = this;
            vm.loadingSenha = true
            axios.post('/api/alterar-senha', this.senha)
                .then((response) => {
                    console.log(response)
                }).catch((error) => {
                    const errors = error.response.data.errors;
                    let errorMessages = '';
                    for (const [field, messages] of Object.entries(errors)) {
                        errorMessages += `${messages.join(', ')}\n`;
                    }

                    vm.$swal({
                        icon: 'error',
                        title: 'Erro',
                        text: errorMessages.trim()
                    });
                }).finally(() => {
                    vm.loadingSenha = false
                })
        },
        async login() {
            const vm = this;
            if (!vm.formData.login || !vm.formData.password) {
                vm.$swal({
                    title: "Atenção",
                    text: "Informe usuário e/ou senha válido",
                    icon: "warning"
                });
                return
            }
            await axios.post('/api/login', vm.formData)
                .then((response) => {
                    this.$store.dispatch('fetchUser');
                    this.saveToken(response.data.token);
                    vm.userName = response.data.user.name;
                }).catch((error) => {
                    console.log(error);
                    vm.$swal({
                        title: "Atenção",
                        text: "Usuário e/ou senha inválido",
                        icon: "warning"
                    });
                })
        }
    }
};


</script>

<style scoped>
nav {
    background-color: #333;
    padding: 1rem;
}

router-link {
    color: white;
    margin: 0 1rem;
    text-decoration: none;
}

router-link:hover {
    text-decoration: underline;
}
</style>
