<template>
    <div>
        <v-card color="white" variant="flat" class="mx-auto pa-6 mt-6 ml-6 mr-6">
            <div class="row mb-3">
                <h4>Documentos</h4>
            </div>
            <div class="row" v-if="user">
                <div class="col col-md-12 text-left">
                    <v-btn class="text-none text-subtitle-1" color="rgb(0, 46, 93)" size="small" variant="flat"
                        @click="modalDoc = !modalDoc">
                        <i class="fa-solid fa-plus"></i> Adicionar Documento
                    </v-btn>
                </div>
            </div>

            <div class="row mt-3 align-items-end input-group input-group-sm">
                <div class="col-md-4">
                    <label for="protocol">Protocolo</label>
                    <input type="text" id="protocol" class="form-control input-sm" aria-label="Protocolo"
                        @keyup.enter="getDocumentos()" v-model="filterProtocol">
                </div>
                <div class="col">
                    <v-btn class="text-none text-subtitle-1" color="rgb(0, 46, 93)" variant="flat"
                        @click="getDocumentos()">
                        <i class="fa-solid fa-magnifying-glass"></i> Buscar
                    </v-btn>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-2 text-primary mt-3" v-if="loading">
                <div class="spinner-border" role="status" />
                Carregando Documentos...
            </div>
            <div v-else class="table-responsive">
                <table class="table table table-striped table-hover table-sm align-middle mt-3"
                    v-if="documentos.length > 0">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Protocolo</th>
                            <th scope="col">Descrição</th>
                            <th scope="col" v-if="user">Adicionado em</th>
                            <th scope="col" v-if="user">Adicionado por</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(doc, index) in documentos" :key="index">
                            <td style="min-width: 50px;">
                                <a v-if="user" style="margin-right: 15px;" class="excluir" title="Excluir" href="#"
                                    @click="excluir(doc.id)">
                                    <i class="fa-regular fa-trash-can fa-2xl"></i>
                                </a>
                                <a v-if="getExtensao(doc.path) == 'pdf'" :href="doc.path.replace('public', 'storage')"
                                    target="_blank" title="Visualizar">
                                    <i class="fa-solid fa-file-pdf fa-2xl"></i>
                                </a>
                                <a v-else-if="getExtensao(doc.path) == 'jpg' || getExtensao(doc.path) == 'jpeg' || getExtensao(doc.path) == 'png'"
                                    :href="doc.path.replace('public', 'storage')" target="_blank" title="Visualizar">
                                    <i class="fa-solid fa-image fa-2xl"></i>
                                </a>
                            </td>
                            <td>{{ doc.protocolo }}</td>
                            <td>{{ doc.descricao }}</td>
                            <td v-if="user">{{ formatDate(doc.updated_at) }}</td>
                            <td v-if="user">{{ doc.user.name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </v-card>
        <v-dialog v-model="modalDoc" width="600" transition="dialog-top-transition">
            <v-card prepend-icon="mdi-update" title="Adicionar Documento">
                <v-card-text>
                    <div class="row">
                        <div class="input-group">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">Protocolo</span>
                                <input type="text" class="form-control" placeholder="123456789" v-model="protocolo"
                                    aria-label="Username" aria-describedby="addon-wrapping" :disabled="loadingModal">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">Descrição</span>
                            <input type="text" class="form-control" placeholder="Processo xyz" aria-label="Username"
                                v-model="descricao" aria-describedby="addon-wrapping" :disabled="loadingModal">
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="input-group flex-nowrap">
                            <input class="form-control" type="file" id="formFile" @change="addFile"
                                :disabled="loadingModal">
                        </div>
                    </div>
                </v-card-text>
                <template v-slot:actions>
                    <v-row>
                        <v-col class="text-right">
                            <v-btn class="ms-auto text-subtitle-1" color="rgb(0, 46, 93)" size="small" variant="flat"
                                @click.prevent="adicionar()" :disabled="loadingModal">
                                <i class="fa-solid fa-floppy-disk"></i> Adicionar
                            </v-btn>
                        </v-col>
                        <v-col>
                            <v-btn class="ms-auto" size="small" variant="flat" text="Fechar" @click="modalDoc = false"></v-btn>
                        </v-col>
                    </v-row>
                </template>
            </v-card>
        </v-dialog>

        <!-- Modal Documentos -->
        <!-- <div class="modal fade" id="modalDoc" tabindex="-1" aria-hidden="true" ref="modalDoc">
            <v-overlay :model-value="loadingModal" class="align-center justify-center">
                <v-progress-circular size="64" indeterminate></v-progress-circular>
            </v-overlay>
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
                        <v-btn class="text-none text-subtitle-1" color="rgb(0, 46, 93)" size="small" variant="flat"
                            @click.prevent="adicionar()" :disabled="loadingModal">
                            <i class="fa-solid fa-floppy-disk"></i> Adicionar
                        </v-btn>
                        <v-btn class="text-none text-subtitle-1" size="small" data-bs-toggle="modal"
                            color="grey-lighten-3" data-bs-target="#modalDoc" variant="flat" data-bs-dismiss="modal"
                            ref="fecharModal">
                            Fechar
                        </v-btn>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</template>

<script>
import axios from '../axios';
import moment from 'moment';
export default {
    data() {
        return {
            filterProtocol: "",
            modalDoc: false,
            documentos: [],
            protocolo: "",
            descricao: "",
            file: null,
            loading: false,
            loadingModal: false,
            paginate: {
                currentPage: 1,
                perPage: 20,
            }
        }
    },
    computed: {
        user() {
            return this.$store.state.user
        }
    },
    mounted() {

    },
    methods: {
        clearModal() {
            this.protocolo = "";
            this.descricao = "";
            this.file = null;
        },
        excluir(doc) {
            this.$swal({
                icon: 'warning',
                title: "Deseja realmente excluir este arquivo?",
                footer: 'Esta ação não poderá ser revertida!',
                showDenyButton: true,
                confirmButtonText: "Sim, Excluir",
                confirmButtonColor: '#87CEEB',
                denyButtonColor: '#DCDCDC',
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
            if (!this.user && !this.filterProtocol) {
                return this.$swal('Informe um número de protocolo', "", "error")
            }
            const url = this.user ? '/api/documentos-user' : '/api/documentos'
            vm.loading = true
            let form = {
                perPage: this.paginate.perPage,
                protocolo: this.filterProtocol
            }
            axios.get(url, { params: form })
                .then((response) => {
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
                    vm.loadingModal = false
                    vm.protocolo = ""
                    vm.descricao = "";
                    vm.file = null;
                    vm.getDocumentos();
                    vm.modalDoc = false;
                }).catch((error) => {
                    console.log(error)
                }).finally(() => {
                    vm.loadingModal = false
                })
        },
        formatDate(date) {
            return moment(date).format('D/MM/Y')
        },
    }

}
</script>

<style>
.excluir {
    color: crimson;
}

.card-document {
    padding-top: 50px;
    padding-left: 20px;
    margin: 20px;
}
</style>
