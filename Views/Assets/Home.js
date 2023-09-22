
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

    $('.view-commits').click(function () {
        var commitMessage = $(this).data('message');
        $('#commitMessage').text(commitMessage);
    });
    
    $(".viewCommit").click(function () {
        $("#myModal").css("display", "block");
    });

    $("#fecharModal").click(function () {
        $("#myModal").css("display", "none");
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
});



