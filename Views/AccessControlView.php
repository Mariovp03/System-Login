<div class="container w-100 d-flex col-12 vh-100" style="background-color: #00000ed1;">
    <div class="d-flex align-items-center text-center col-12 flex-column">
        <h1 class="text-white ">Controler de acesso</h1>
        <div>
            <a href="alterar-perfil" class="btn bg-primary text-white mt-4">Ir para alterar foto de perfil</a>
            <a href="home" class="btn bg-primary text-white mt-4">Ir para os repositórios</a>

        </div>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-white">Locais Acessados</h2>
                    <ul id="locais" class="list-group">
                        <?php foreach ($localizationUserAcess as $localization) { ?>
                            <li style="list-style-type:none;" class="text-white"><?= $localization['localization'] ?></li>
                        <?php } ?>
                    </ul>
                    <h2 class="text-white mt-5">Locais bloqueados</h2>
                    <ul id="lista-locais-bloqueados">
                        <?php foreach ($localizationUserAcess as $localization) { 
                            if(is_string($localization['region_block'])){ ?>
                            <li style="list-style-type:none;" class="text-white"><?= $localization['region_block'] ?></li>
                        <?php } }?>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2 class="text-white">Bloquear Região</h2>
                    <div class="input-group mb-3">
                        <input type="text" id="regiao" class="form-control" placeholder="Digite a região">
                        <button id="bloquearRegiao" class="btn btn-primary ">Bloquear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>