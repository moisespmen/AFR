<style>
.container {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.image-header {
    position: absolute;
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

.card {
    max-width: 290px;
    background-color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Suaviza as transições */
}

.card:hover {
    transform: scale(1.02); /* Zoom do card */
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.3); /* Sombra mais forte ao passar o mouse */
}

.card-container {
    display: flex;
    gap: 20px; /* Espaço entre os cards */
}
.card-text {
    text-align: justify;
}
.header-text {
    color: rgb(255, 255, 255);
    text-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
}
</style>
<template>
    <div class="container">
        <img src="http://localhost:8000/image/image-header.jpeg" class="img-fluid image-header">
        <h2 class="text-center header-text">Texto centralizado</h2>
        <div class="card-container">
            <div class="card" style="width: 40rem;">
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
            <div class="card" style="width: 40rem;">
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
