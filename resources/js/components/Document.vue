<style>
.excluir {
    color: crimson;
}

.card-document {
    padding-top: 50px;
}
</style>
<template>
    <div class="card-document">
        <div class="card" style="min-height: 500px;">
            <div class="card-body">
                <div class="row" v-if="user">
                    <div class="col col-md-12 text-right">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalDoc">
                            <i class="fa-solid fa-plus"></i> Adicionar Documento
                        </button>
                    </div>
                </div>

                <div class="row mt-3 align-items-end input-group input-group-sm">
                    <div class="col">
                        <label for="protocol">Protocolo</label>
                        <input type="text" id="protocol" class="form-control input-sm" aria-label="Protocolo"
                            @keyup.enter="getDocumentos()" v-model="protocolo">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" @click="getDocumentos()">
                            <i class="fa-solid fa-magnifying-glass"></i> Buscar
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-2 text-primary mt-3" v-if="loading">
                    <div class="spinner-border" role="status" />
                    Carregando Documentos...
                </div>
                <div v-else>
                    <table class="table table-striped table-hover mt-3 responsive" v-if="documentos.length > 0">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Protocolo</th>
                                <th scope="col">Descrição</th>
                                <th scope="col" v-if="user">Alterado em</th>
                                <th scope="col" v-if="user">Alterado por</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(doc, index) in documentos" :key="index">
                                <td style="min-width: 50px;">
                                    <a v-if="user" style="margin-right: 15px;" class="excluir" title="Excluir" href="#"
                                        @click="excluir(doc.id)">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </a>
                                    <a v-if="getExtensao(doc.path) == 'pdf'"
                                        :href="doc.path.replace('public', 'storage')" target="_blank"
                                        title="Visualizar">
                                        <i class="fa-solid fa-file-pdf fa-2xl"></i>
                                    </a>
                                    <a v-else-if="getExtensao(doc.path) == 'jpg' || getExtensao(doc.path) == 'jpeg' || getExtensao(doc.path) == 'png'"
                                        :href="doc.path.replace('public', 'storage')" target="_blank"
                                        title="Visualizar">
                                        <i class="fa-solid fa-image"></i>
                                    </a>
                                </td>
                                <td>{{ doc.protocolo }}</td>
                                <td>{{ doc.descricao }}</td>
                                <td v-if="user">{{ formatDate(doc.updated_at) }}</td>
                                <td v-if="user">{{ doc.user.name }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example" class="mt-3">
                       <!--  <ul class="pagination">
                            <li class="page-item" :class="{ disabled: !paginate.prev_page_url }">
                                <a class="page-link" href="#"
                                    @click.prevent="fetchItems(items.prev_page_url)">Previous</a>
                            </li>
                            <li class="page-item" :class="{ disabled: !paginate.next_page_url }">
                                <a class="page-link" href="#" @click.prevent="fetchItems(items.next_page_url)">Next</a>
                            </li>
                        </ul> -->
                    </nav>
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
                                                v-model="protocolo" aria-label="Username"
                                                aria-describedby="addon-wrapping" :disabled="loadingModal">
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
    </div>
</template>

<script>
import axios from '../axios';
import moment from 'moment';
export default {
    data() {
        return {
            documentos: [],
            protocolo: "",
            descricao: "",
            file: null,
            user: "",
            loading: false,
            loadingModal: false,
            paginate: {
                currentPage: 1,
                perPage: 20,
            }
        }
    },
    computed: {

    },
    mounted() {
        this.user = this.$store.state.user
        if (this.user) {

        }
    },
    methods: {
        excluir(doc) {
            this.$swal({
                icon: 'warning',
                title: "Deseja realmente excluir este arquivo?",
                showDenyButton: true,
                confirmButtonText: "Sim, Excluir",
                confirmButtonColor: '#0d6efd',
                denyButtonText: `Cancelar`
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/documentos/' + doc)
                        .then((response) => {
                            this.$swal.fire("Arquivo exclído com sucesso!", "", "success");
                            this.getDocumentos();
                        }).catch((error) => {
                            this.$swal.fire("Erro ao excluir documento", "", "error");
                        })
                }
            });
        },
        getExtensao(path) {
            const extension = path.split('.').pop().toLowerCase();
            return extension;
        },
        getDocumentos() {
            const vm = this;
            if (!this.user && !this.protocolo) {
                return this.$swal('Informe um numero de protocolo', "", "error")
            }
            const url = localStorage.getItem('token') && this.user ? '/api/documentos-user' : '/api/documentos'
            vm.loading = true
            let form = {
                perPage: this.paginate.perPage,
                protocolo: this.protocolo
            }
            axios.get(url, { params: form })
                .then((response) => {
                    console.log(response.data)
                    vm.documentos = response.data.data;
                    vm.paginate.currentPage = response.data.current_page;
                    vm.paginate.total = response.data.total;
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
        },
        formatDate(date) {
            return moment(date).format('D/MM/Y')
        }
    }

}
</script>
