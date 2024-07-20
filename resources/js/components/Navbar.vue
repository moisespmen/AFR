<template>
    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <button class="navbar-toggler border-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="text-light"><i class="fa-solid fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link active text-light" to="/"><i class="fa-solid fa-house"></i>
                            Home</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link active text-light" to="/about"><i
                                class="fa-solid fa-circle-info"></i> Sobre</router-link>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user"></i> Acessar
                        </a>
                        <ul class="dropdown-menu" style="width: 260px;">
                            <li>
                                <form class="p-3" @submit.prevent="handleSubmit">
                                    <div class="row">
                                        <div class="col">
                                            <label for="exampleInputEmail1" class="form-label">Login</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                v-model="formData.login" aria-describedby="emailHelp">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Senha</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1"
                                            v-model="formData.password">
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-door-open"></i>
                                        Entrar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>




</template>

<script>
export default {
    name: 'Navbar',
    data() {
        return {
            formData: {
                login: '',
                password: ''
            }
        };
    },

    methods: {
        handleSubmit() {
            if (!this.formData.login || !this.formData.password) {
                return this.$swal({
                    title: "Atenção",
                    text: "Informe usuário e senha válido",
                    icon: "warning"
                });
            }

            axios.post('/api/login', this.formData)
            .then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
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
