<template>
    <div>
        <v-card class="ml-6 my-8 card-about mr-3" elevation="20" max-width="600">
            <v-card-item>
                <v-card-title>
                    Sobre:
                </v-card-title>
                <v-card-subtitle>
                    Ana Flávia Ribeiro
                </v-card-subtitle>
            </v-card-item>
            <v-card-text>
                <p>
                    Contadora, bacharel em Ciências Contábeis pela Pontifícia Universidade
                    Católica de Goiás, inscrita no Conselho Federal de Contabilidade de Goiás. Perita Judicial e
                    Extrajudicial cadastrada no Banco de Peritos Judiciais da Corregedoria-Geral da Justiça do Estado de
                    Goiás.
                    Administradora Judicial cadastrada no Banco de Administradores Judiciais da
                    Corregedoria-Geral
                    da
                    Justiça do Estado de Goiás. Graduanda de Direito na Universidade Salgado Filho de Goiás.
                    Corretora e
                    Avaliadora de Imóveis, inscrita no Conselho Regional de Corretores de Imóveis de Goiás.
                </p>
            </v-card-text>
        </v-card>
        <v-card class="ml-6 my-8 card-about mr-3" elevation="20" max-width="600">
            <v-card-item>
                <v-card-title>
                    Atua nos seguintes ramos:
                </v-card-title>
            </v-card-item>
            <v-card-text>
                <p>
                    Recuperação Judicial, Falência, Perícia Judicial e Extrajudicial,
                    Avaliação de
                    Imóveis, Contabilidade Privada, Contabilidade Pública, Auditoria Operacional, Auditoria
                    de
                    Conformidade, Auditoria Governamental, Accountability, Compliance, Pericia Financeira,
                    Pericia
                    Bancária, Pericia Contábil, Valuation, Dissolução de Sociedades e Apuração de Haveres.
                </p>
            </v-card-text>
        </v-card>
    </div>
</template>


<style>
.card-about {
    background-color: rgba(255, 255, 255, 0.9);
    text-align: justify;
}

.row-card-home {
    margin: 10px;
    padding: 20px;
}

.home-card {
    background-color: rgba(0, 0, 0, 0.8);
    color: rgb(255, 255, 255);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
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
}

.card-text {
    text-align: justify;
    padding: 15px;
    margin: 10px;
    padding-bottom: 30px;
}

</style>
