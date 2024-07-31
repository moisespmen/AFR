<style>
.image-header {
    max-height: 90%;
}

.row .col .card {
    margin-top: 100px;
    background-color: rgb(242, 243, 243);
    max-width: 200px;
}
h3.text-center {
    margin-top: -650px;
    color: aliceblue;
}
</style>
<template>
    <div>
        <img src="http://localhost:8000/image/image-header.jpeg" class="img-fluid image-header">
    </div>
    <div>
        <h3 class="text-center">Texto centralizado</h3>
    </div>
    <div class="row cards-header">
        <div class="col">
            <div class="card" style="width: 40rem;">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div>

    </div>
</template>
