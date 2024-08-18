<template>
    <div>
        <v-card class="mx-left ml-6 mt-6 mr-3 home-card animated-card" max-width="500"><v-card-title><i class="fa-solid fa-pen-nib"></i> RECUPERAÇÃO JUDICIAL</v-card-title></v-card>
        <v-card class="mx-left ml-6 mt-6 mr-3 home-card animated-card" max-width="500"><v-card-title><i class="fa-solid fa-pen-nib"></i> AVALIAÇÃO DE IMÓVEIS</v-card-title></v-card>
        <v-card class="mx-left ml-6 mt-6 mr-3 home-card animated-card" max-width="500"><v-card-title><i class="fa-solid fa-pen-nib"></i> PERÍCIA CONTÁBIL</v-card-title></v-card>
        <v-card class="mx-left ml-6 mt-6 mr-3 home-card animated-card" max-width="500"><v-card-title><i class="fa-solid fa-pen-nib"></i> PERÍCIA FINANCEIRA E GRAFOTÉCNICA</v-card-title></v-card>
        <v-card class="mx-left ml-6 mt-6 mr-3 home-card animated-card" max-width="500"><v-card-title><i class="fa-solid fa-pen-nib"></i> DISSOLUÇÃO DE SOCIEDADE E VALUATION</v-card-title></v-card>
    </div>
</template>

<style>
.animated-card {
  transition: transform 0.3s ease, background-color 0.3s ease;
  background-color: #f5f5f5;
}

.animated-card:hover {
  transform: scale(1.1);
  background-color: #b6791c;
}

.image-body {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1;
}

.header-text {
    margin-top: 0px;
    color: rgb(255, 255, 255);
    text-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
    -webkit-text-stroke: 0.3px black;
}

</style>
