<div class="container w-100 d-flex col-12 vh-100" style="background-color: #00000ed1;">
    <div class="d-flex align-items-center text-center col-12 flex-column">
        <?php foreach ($repositoryData as $value) { ?>
            <div class="row mt-5">
            <div class="card" style="width: 18rem; height:205px;">
                <div class="card-body bg-dark">
                    <h5 class="card-title text-white"><?= $value['name'] ?></h5>
                    <p class="card-text text-light"><?= $value['description'] ?></p>
                    <a href="<?= $value['html_url'] ?>" target="_blank" class="btn btn-light">Entrar no repositório</a>
                </div>
            </div>
            </div>
        <?php } ?>
    </div>
</div>