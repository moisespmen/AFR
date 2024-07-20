<template>
    <nav class="navbar bg-dark navbar-expand-lg border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!--<li class="nav-item">
                            <RouterLink to="/">
                                <i class="fas fa-home"></i> Home
                            </RouterLink>
                        </li>
                        <li class="nav-item">
                            <RouterLink to="/arquivos">
                                <i class="fa-solid fa-file"></i> Arquivos
                            </RouterLink>
                        </li>-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" @click="toggle = !toggle"
                            aria-expanded="false">
                            <i class="fa-solid fa-user"></i> Acesar
                        </a>
                        <ul class="dropdown-menu" v-show="toggle">
                            <li class="dropdown-item">
                                <form class="px-4 py-3">
                                    <div class="mb-3">
                                        <label for="exampleDropdownFormEmail1" class="form-label">Login</label>
                                        <input type="email" class="form-control" id="exampleDropdownFormEmail1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleDropdownFormPassword1" class="form-label">Senha</label>
                                        <input type="password" class="form-control" id="exampleDropdownFormPassword1">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Acessar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
const name = 'NavBar';
var toggle = false;

methods: {
    const getLogin = () => {

    }
}

</script>

<style scoped>
nav {
    background-color: #333;
    color: #fff;
    padding: 1rem;
}

ul {
    list-style-type: none;
    display: flex;
    gap: 1rem;
}

a {
    color: #fff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>
