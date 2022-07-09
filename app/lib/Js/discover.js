$(document).ready(function () {
    switch (document.title.substring(10)) {
        case 'Séries':
            $('#series').addClass('active');
            break;
        case 'Animes':
            $('#animes').addClass('active');
            break;

        default:
            $('#filmes').addClass('active');
            break;
    }
});

let formOptions = $('.form-options');
let btnOptions = $('.btn-options');
formOptions.click(function (e) {
    e.stopPropagation();
});
btnOptions.click(function (e) {
    e.stopPropagation();
    formOptions.toggleClass('d-none');
});
window.addEventListener("click", function (e) {
    e.stopPropagation();

    let btn = document.getElementsByClassName('btn-options')[0];
    let form = document.getElementsByClassName('form-options')[0];
    if ((!form.classList.contains('d-none')) && (e.target != btn) && (e.target != form)) {
        formOptions.addClass('d-none');
    }
});