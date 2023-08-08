$(document).ready(function () {

    $(".btn-submit").on("click", function () {
        var contentInputEmail = $(".formValidateEmail").val();
        var contentInputPassword = $(".formValidatePassword").val();

        if (contentInputEmail.trim() === "" || contentInputPassword.trim() === "") {
            Swal.fire({
                title: 'Todos os campos precisam ser preenchidos',
                icon: 'error',
                confirmButtonText: 'Ok'
              })
        }
    });

});