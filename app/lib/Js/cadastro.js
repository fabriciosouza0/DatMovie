$(document).ready(function () {

    $("#submit-cadastro").click(function (e) {
        e.preventDefault();

        let nome = $('input[type=email]#email-input').val().trim();
        let sobrenome = $('input[type=password]#senha-input').val().trim();
        let email = $('input[type=email]#email-input').val().trim();
        let senha = $('input[type=password]#senha-input').val().trim();
        let nome_de_usuario = $('input[type=email]#email-input').val().trim();

        let page = '../controller/cadastro.php';

        /* if (email == '' || senha == '') {
            $('div#alert-login').show();
            $('span#msg').text('E-mail ou senha incorretos!');
            return;
        } */

        $.ajax({
            type: "POST",
            url: page,
            data: {
                /* email: email,
                senha: senha */
            },
            dataType: 'json',
            success: (dados) => {
                /* if (!dados.estado) {
                    $('div#alert-login').show();
                    $('span#msg').text(dados.msg);
                    return;
                }
                window.location.href = "../view/recuperar_senha.php"; */
            },
            erro: (dados, statusText, xhr) => {
                /* console.log(dados, statusText, xhr); */
            }
        });
    });

    /* $('#fechar').click(function () {
        $('div#alert-login').hide();
    }); */

});