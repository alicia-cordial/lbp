$(document).ready(function () {

/*Toggle inscription / connexion *//*
function changeForm() {
    var changeSpan = event.target
    console.log(changeSpan)
    var idchangeSpan = changeSpan.id

    if (changeSpan.id === "changeToInscription") {
        httpRequest.open('GET', "views/user/inscription.php", true)
    } else {
        httpRequest.open('GET', "views/user/connexion.php", true)
    }
    httpRequest.send()
}*/

    $('body').on('click', '.callForm', function () {
        console.log(this)
        if ($(this).is('#callFormInscription')) {
            let page = 'inscription'
        } else {
            let page = 'connexion'
        }

        $.get('views/user/'+ page + '.php',
            function (data) {
                $('#mainCompte').html(data);
            });
    });

});