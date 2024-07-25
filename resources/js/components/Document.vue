<template>
    <div class="card m-3" style="min-height: 500px;">
        <div class="card-body">
            <div class="row" v-if="user">
                <div class="col col-md-12 text-right">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#modalDoc">
                        <i class="fa-solid fa-plus"></i> Adicionar Documento
                    </button>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col">
                    <button type="button" class="btn btn-primary btn-sm" @click="getDocumentos()">
                        <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </button>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-2 text-primary" v-if="loading">
                <div class="spinner-border" role="status" />
                Carregando Documentos...
            </div>
            <div v-else>
                <table class="table table-striped table-hover mt-3" v-if="documentos.length > 0">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Protocolo</th>
                            <th scope="col">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(doc, index) in documentos" :key="index">
                            <th scope="row">
                                <!--Excluir arquivo-->
                                <div v-if="getExtensao(doc.path) == 'pdf'">
                                    <a :href="doc.path.replace('public', 'storage')" target="_blank">
                                        <i class="fa-solid fa-file-pdf"></i>
                                    </a>
                                </div>
                                <div
                                    v-else-if="getExtensao(doc.path) == 'jpg' || getExtensao(doc.path) == 'jpeg' || getExtensao(doc.path) == 'png'">
                                    <a :href="doc.path.replace('public', 'storage')" target="_blank">
                                        <i class="fa-solid fa-image"></i>
                                    </a>
                                </div>
                            </th>
                            <td>{{ doc.protocolo }}</td>
                            <td>{{ doc.descricao }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Documentos -->
        <div class="modal fade" id="modalDoc" tabindex="-1" aria-hidden="true" ref="modalDoc">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Documento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            :disabled="loadingModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">Protocolo</span>
                                        <input type="text" class="form-control" placeholder="123456789"
                                            v-model="protocolo" aria-label="Username" aria-describedby="addon-wrapping"
                                            :disabled="loadingModal">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping">Descrição</span>
                                    <input type="text" class="form-control" placeholder="Processo xyz"
                                        aria-label="Username" v-model="descricao" aria-describedby="addon-wrapping"
                                        :disabled="loadingModal">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="input-group flex-nowrap">
                                    <input class="form-control" type="file" id="formFile" @change="addFile"
                                        :disabled="loadingModal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" @click="adicionar()"
                            :disabled="loadingModal">
                            <div class="spinner-border spinner-border-sm" role="status" v-if="loadingModal">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <i class="fa-solid fa-floppy-disk" v-else></i> Adicionar
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"
                            ref="fecharModal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from '../axios';
export default {
    data() {
        return {
            documentos: [],
            protocolo: "",
            descricao: "",
            file: null,
            user: "",
            loading: false,
            loadingModal: false
        }
    },
    computed: {

    },
    mounted() {
        this.user = localStorage.getItem('user_id');
        if (this.user) {
            this.getDocumentos();
        }
    },
    methods: {
        getExtensao(path) {
            const extension = path.split('.').pop().toLowerCase();
            return extension;
        },
        getDocumentos() {
            const vm = this;
            const url = localStorage.getItem('token') && this.user ? '/api/documentos-user' : '/api/documentos'
            vm.loading = true
            let form = {
                perPage: 20
            }
            axios.get(url, { form: form })
                .then((response) => {
                    vm.documentos = response.data;
                }).catch((error) => {
                    console.log(error)
                }).finally(() => {
                    vm.loading = false
                })
        },
        addFile(event) {
            this.file = event.target.files.length ? event.target.files[0] : null;
            console.log(this.file);
        },
        adicionar() {
            if (!this.file || !this.descricao || !this.protocolo) {
                this.$swal({
                    icon: 'error',
                    title: 'Erro',
                    text: 'Todos os campos são obrigatórios!'
                });
                return
            }
            const vm = this;
            var form = new FormData();
            form.append('file', this.file);
            form.append('descricao', this.descricao);
            form.append('protocolo', this.protocolo);
            vm.loadingModal = true

            axios.post('/api/documentos', form)
                .then((response) => {
                    vm.getDocumentos();
                    vm.$refs.fecharModal.click();
                }).catch((error) => {
                    console.log(error)
                }).finally(() => {
                    vm.loadingModal = false
                })
        }
    }

}
</script>
