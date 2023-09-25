<div class="container w-100 d-flex col-12 vh-100" style="background-color: #00000ed1;">
    <div class="d-flex align-items-center text-center col-12 flex-column">
        <h1 class="text-white ">Repositórios</h1>
        <div>
            <a href="alterar-perfil" class="btn bg-primary text-white mt-4">Ir para alterar foto de perfil</a>
            <div class="btn bg-primary text-white mt-4 controlAcess">Controle de Acesso</div>
            <div class="d-flex mt-5">
                <input class="form-control me-2" id="filtro" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
        <?php
        if (!is_string($repositoryData)) { ?>
            <div id="lista-repositorios">
                <?php
                $i = 0;
                foreach ($repositoryData as $value) {
                    $i++;
                ?>
                    <div>
                        <div class="card row mt-5 " style="width: 18rem; height:auto;">
                            <div class="card-body bg-dark">
                                <h5 class="card-title text-white"><?= $value['name'] ?></h5>
                                <p class="card-text text-light"><?= $value['description'] ?></p>
                                <a href="<?= $value['html_url'] ?>" target="_blank" class="btn bg-primary text-light">Entrar no repositório</a>
                                <div class="btn bg-primary text-light mt-3 viewCommit" data-toggle="modal" data-target="#modal<?= $i ?>">Ver commits</div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $i ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel<?= $i ?>">Modal de Commits</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            <?php foreach ($repositoryCommits as $value2) {
                                                if (strpos($value2["commit"]["url"], $value['name'])) { ?>
                                                    <li style="list-style-type: none;"><?= $value2["commit"]["message"] ?></li>
                                            <?php }
                                            } ?>
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>
