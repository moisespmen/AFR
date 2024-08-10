<template>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-grow-1">
            <div>
                <Navbar />
            </div>
        </main>

        <footer class="mt-auto text-white text-center p-3 footer-main">
            <p>Avenida D, esquina com Rua 09, Nº 419, Qd G-11, Lt 01, Edifício Comercial Marista, 4º Andar, Setor
                Marista, Goiânia – GO</p>
            <p>&copy; {{ ano }} Ana Flávia Ribeiro. Todos os direitos reservados.</p>
        </footer>
    </div>
</template>

<script>
import Navbar from './Navbar.vue';
import moment from 'moment';

export default {
    components: {
        Navbar,
    },
    data() {
        return {
            ano: moment().format('Y')
        };
    },
};
</script>

<style>
.footer-main{
    background-color: rgb(0, 46, 93);
}
</style>


