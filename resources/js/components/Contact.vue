<template>
    <div class="ml-6 mt-6 text-left c-contacts">
        <div class="row">
            <h4>Contatos</h4>
        </div>
        <div class="row mt-6" v-for="(contato, index) in contatos" :key="index">
            <div class="col">
                <div class="card card-contacts">
                    <div class="card-body text-left">
                        <span> <b><i :class="contato.icon"></i> {{ contato.text }}: </b>
                            <a :href="contato.url" target="_blank">
                                {{ contato.data }}
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            contatos: [
                {
                    icon: "fa-brands fa-instagram",
                    text: "Instagram",
                    url: "https://www.instagram.com/anaflaviaribeiro.cont",
                    data: "anaflaviaribeiro.cont"
                },
                {
                    icon: "fa-brands fa-whatsapp",
                    text: "Whatsapp",
                    url: "https://wa.me/5562996132702",
                    data: "(62) 99613-2702"
                },
                {
                    icon: "fa-brands fa-whatsapp",
                    text: "Email",
                    url: "mailto:assessoriarj@soluccontconsultorias.com",
                    data: "assessoriarj@soluccontconsultorias.com"
                },
                {
                    icon: "fa-brands fa-linkedin",
                    text: "Linkedin",
                    url: "https://www.linkedin.com/in/ana-flavia-ribeiro-0b9008224",
                    data: "Ana Flavia Ribeiro"
                },
            ]
        }
    }
}

</script>
<style>
.c-contacts {
    max-width: 550px;
}

.card-contacts {
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.card-contacts:hover{
    transform: scale(1.1);
}


</style>
