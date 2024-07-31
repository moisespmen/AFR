<!-- CompanyInfoCard.vue -->
<template>
    <div class="card">
      <img src="https://www.google.com/imgres?q=imagem%20escritorio%20de%20contabilidade&imgurl=https%3A%2F%2Fwww.cora.com.br%2Fblog%2Fwp-content%2Fuploads%2Felementor%2Fthumbs%2Fcomo-abrir-um-escritorio-de-contabilidade-pqpix8idhrjcber0cuuflms02fc40ukedytjdl5yf4.jpg&imgrefurl=https%3A%2F%2Fwww.cora.com.br%2Fblog%2Fcomo-abrir-um-escritorio-de-contabilidade%2F&docid=kZoT-Iwqkpid0M&tbnid=K_QFfZFoIBWe9M&vet=12ahUKEwiIjM7q_M-HAxUprJUCHartCn0QM3oECBUQAA..i&w=1152&h=576&hcb=2&ved=2ahUKEwiIjM7q_M-HAxUprJUCHartCn0QM3oECBUQAA"
      class="card-img-top" alt="Company Image">
      <div class="card-body">
        <h5 class="card-title">{{ title }}</h5>
        <p class="card-text">{{ description }}</p>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: {
      title: String,
      description: String
    }
  };
  </script>
