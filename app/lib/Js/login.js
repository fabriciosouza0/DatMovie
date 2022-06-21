$(document).ready(function () {

    $("#submit_login").click(function (e) {
        e.preventDefault();

        let email = $('input[type=email]#email_input').val().trim();
        let senha = $('input[type=password]#senha_input').val().trim();

        let page = 'controller/login.php';

        if (email == '' || senha == '') {
            $('div#alert_login').show();
            $('span#msg').text('Por favor, preencha todos os campos');
            return;
        }

        $.ajax({
            type: "POST",
            url: page,
            data: {
                email: email,
                senha: senha
            },
            dataType: 'json',
            success: (dados) => {
                if (!dados.estado) {
                    $('div#alert_login').show();
                    $('span#msg').text(dados.msg);
                    return;
                }
                window.location.href = "view/recuperar_senha.php";
            },
            erro: (dados, statusText, xhr) => {
                console.log(dados, statusText, xhr);
            }
        });
    });

    $('#fechar').click(function () {
        $('div#alert_login').hide();
    });

});