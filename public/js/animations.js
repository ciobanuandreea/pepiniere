$(document).ready(function () {
    $("html,body").css( 'cursor', 'url(https://img.icons8.com/doodle/48/000000/apple-tree.png), auto');
    $("#form-login").animate({
        bottom: '100px'
    }, 600, 'linear');
    $("#form-signup").animate({
        bottom: '40px'
    }, 200, 'linear');
    $(".emplacement").animate({
        left: '100px'
    }, 500, 'linear');
    $(".carte").animate({
        right: '100px'
    }, 500, 'linear');
    $("#btn-signup").click(function () {
        window.location.href = 'inscription.php';
    });
    $("#btn-cancel").click(function () {
        window.location.href = 'index.php';
    });
    $('#form-contact > fieldset > div.field').show().animate({
        marginTop: "40px"
    }, 1500).animate({
        marginTop: "0px"
    }, 800);
    var input = $('.input');
    input.each(function () {
        $(this).focusin(function () {
            $(this).addClass('inp-act');
        });
        $(this).focusout(function () {
            $(this).removeClass('inp-act');
        });
    });
});