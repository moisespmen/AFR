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
            <table class="table table-striped table-hover" v-if="documentos.length > 0">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Protocolo</th>
                        <th scope="col">Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(doc, index) in documentos" :key="index">
                        <th scope="row">Botao</th>
                        <td>{{ doc.protocolo }}</td>
                        <td>{{ doc.descricao }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal Documentos -->
        <div class="modal fade" id="modalDoc" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Documento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="input-group">
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">Protocolo</span>
                                        <input type="text" class="form-control" placeholder="123456789"
                                            v-model="protocolo" aria-label="Username" aria-describedby="addon-wrapping">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping">Descrição</span>
                                    <input type="text" class="form-control" placeholder="Processo xyz"
                                        aria-label="Username" v-model="descricao" aria-describedby="addon-wrapping">
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="input-group flex-nowrap">
                                    <input class="form-control" type="file" id="formFile" @change="addFile">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-sm" @click="adicionar()">
                            <i class="fa-solid fa-floppy-disk"></i> Adicionar
                        </button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>
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
            user: ""
        }
    },
    mounted() {
        this.user = localStorage.getItem('user_id');
    },
    methods: {
        getDocumentos() {
            const vm = this;
            const url = localStorage.getItem('token') && this.user ? '/api/documentos-user' : '/api/documentos'
            let data = {
                perPage: 20
            }
            axios.get(url, { data: data })
                .then((response) => {
                    vm.documentos = response.data;
                    console.log(response)
                }).catch((error) => {
                    console.log(error)
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
            }
            var form = new FormData();
            form.append('file', this.file);
            form.append('descricao', this.descricao);
            form.append('protocolo', this.protocolo);

            axios.post('/api/documentos', form)
                .then((response) => {
                    console.log(response)
                }).catch((error) => {
                    console.log(error)
                })

        }
    }

}
</script>
