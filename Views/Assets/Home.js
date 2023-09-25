
$(document).ready(function() {
    
    $("#filtro").on("keyup", function() {
        var inputText = $(this).val().toLowerCase();
        $("#lista-repositorios .card").each(function() {
            var repoName = $(this).find(".card-title").text().toLowerCase();
            if (repoName.indexOf(inputText) === -1) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });

    $(".controlAcess").click(function () {
        window.location.href = 'controle-de-acesso';
    });

    $("#bloquearRegiao").click(function () {
        var regiao = $("#regiao").val();
        $.ajax({
            type: "POST",
            url: "controle-de-acesso",
            data: { action: "bloquearRegiao", regiao: regiao },
            success: function (response) {
                console.log(response);
                var novaLi = $("<li class='text-white' style='list-style-type:none;'>").text(regiao);
                $("#lista-locais-bloqueados").append(novaLi);
                $("#novoItem").val("");
            }
        });
    });

    $('.viewCommit').click(function () {
        var modalId = $(this).data('target');
        $(modalId).modal('show'); 
    });

    $('.closeModal').click(function () {
        var modalId = $(this).closest('.modal').attr('id'); 
        $('#' + modalId).modal('hide'); 
    });

});



