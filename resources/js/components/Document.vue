<template>
    <div class="card m-3">
        <div class="card-body">

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
    </div>
</template>

<script>
import axios from '../axios';
export default {
    data() {
        return {
            documentos: []
        }
    }
}
</script>
