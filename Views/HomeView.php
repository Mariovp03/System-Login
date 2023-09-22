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
        <?php if(!is_string($repositoryData)){ ?>
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
                        <div class="btn bg-primary text-light mt-3 viewCommit" data-id="<?= $i ?>">Ver commits</div>
                    </div>
                </div>
                <!-- Modal -->
                <div id="myModal">
                    <div id="modalContent">
                        <!-- Conteúdo do modal aqui -->
                        <h2>Modal de Commits</h2>
                        <!-- Adicione aqui o conteúdo que deseja exibir no modal -->
                        <button id="fecharModal">Fechar</button>
                    </div>
                </div>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
