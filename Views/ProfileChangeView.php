<div class="container w-100 d-flex col-12 " style="background-color: #00000ed1; height:100vh;">
    <div class="d-flex align-items-center text-center col-12 flex-column">
        <h1 class="text-white ">Alterar foto de perfil</h1>
        <div>
            <a href="home" class="btn bg-primary text-white mt-4">Ir para os repositórios</a>            
            <div class="btn bg-primary text-white mt-4 controlAcess">Controle de Acesso</div>
        </div>
        <form method="post" enctype="multipart/form-data">
            <div class="mt-5">
                <input class="form-control" type="file" id="formFile" name="file[]" multiple>
                <button type="submit" class="btn btn-white mt-3">Enviar imagem</button>
            </div>
        </form>
        <img src="<?= $patchArchive ?>" alt="Imagem" class="img-thumbnail mt-5 border border-dark" style="height: 300px; width:300px;">
    </div>
</div>