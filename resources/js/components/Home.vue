<template>
    <div>
        <img src="http://localhost:8000/image/justica.png" class="img-fluid image-body">
        <div>
            <!-- <h1 class="text-center header-text text-with-border">ANA FLÁVIA RIVEIRO</h1>
            <h6 class="text-center header-text">
                <span>PERITA & ADMINISTRADORA JUDICIAL</span>
            </h6> -->
            <img src="http://localhost:8000/image/anaflavia.webp" alt=""
                class="img-fluid img-background text-center header-text">
        </div>
        <div class="card-container d-flex justify-content-center">
            <div class="card home-card" style="width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title">Sobre:</h5>
                    <p class="card-text">Contadora, bacharel em Ciências Contábeis pela Pontifícia Universidade Católica
                        de
                        Goiás, inscrita no Conselho Federal de Contabilidade de Goiás. Perita Judicial e Extrajudicial
                        cadastrada no Banco de Peritos Judiciais da Corregedoria-Geral da Justiça do Estado de Goiás.
                        Administradora Judicial cadastrada no Banco de Administradores Judiciais da Corregedoria-Geral
                        da
                        Justiça do Estado de Goiás. Graduanda de Direito na Universidade Salgado Filho de Goiás.
                        Corretora e
                        Avaliadora de Imóveis, inscrita no Conselho Regional de Corretores de Imóveis de Goiás. </p>
                </div>
            </div>
            <div class="card home-card" style="width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title">Atua nos seguintes ramos:</h5>
                    <p class="card-text">Recuperação Judicial, Falência, Perícia Judicial e Extrajudicial, Avaliação de
                        Imóveis, Contabilidade Privada, Contabilidade Pública, Auditoria Operacional, Auditoria de
                        Conformidade, Auditoria Governamental, Accountability, Compliance, Pericia Financeira, Pericia
                        Bancária, Pericia Contábil, Valuation, Dissolução de Sociedades e Apuração de Haveres. </p>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.image-body {
    position: fixed;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    height: auto;
    z-index: -1;
}

.text-center {
    position: relative;
    z-index: 0;
    margin-top: 100px;
    margin-bottom: 20px;

}

.card,
.home-card {
    background-color: rgb(255, 255, 255);
    color: black;
    height: 100%;
    max-width: 400px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.img-background {
    position: relative;
}

.home-card:hover {
    transform: scale(1.02);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3);
}

.card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 80px;
    margin-top: 60px;
}

.card-text {
    text-align: justify;
}

.header-text {
    margin-top: 0px;
    color: rgb(255, 255, 255);
    text-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
    -webkit-text-stroke: 0.3px black;
}

@media (min-width: 768px) {
    .home-card {
        background-color: rgba(0, 0, 0, 0.8);
        color: aliceblue;
        width: calc(50% - 20px);
        /* Largura dos cards para telas médias (50% da largura do contêiner menos o espaçamento) */
    }
}

@media (min-width: 992px) {
    .home-card {
        width: calc(33.333% - 20px);
        /* Largura dos cards para telas grandes (33.333% da largura do contêiner menos o espaçamento) */
    }
}
</style>
