<template>
    <div class="d-flex flex-column min-vh-100">
        <main class="flex-grow-1">
            <div>
                <Navbar />
            </div>
        </main>

        <footer class="mt-auto text-white text-center p-3 footer-main">
            <span>Avenida Olinda, 960, Business Tower, Sala 304, Park Lozandes, Goiânia - GO, CEP: 74.884-120.</span>
            <br>
            <span>&copy; {{ ano }} Ana Flávia Ribeiro. Todos os direitos reservados.</span>
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


