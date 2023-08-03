$(document).ready(function () {
    $(".btn-submit").on("click", function () {
        var contentInputEmail = $(".formCreate-email").val();
        var contentInputPassword = $(".formCreate-password").val();

        if (contentInputEmail.trim() === "" || contentInputPassword.trim() === "" ) {
            Swal.fire({
                title: 'Todos os campos precisam ser preenchidos',
                icon: 'error',
                confirmButtonText: 'Ok'
              })
        }
    });
});