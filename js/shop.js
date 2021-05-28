$(document).ready(function() {

    // PAGE INDEX TOGGLE
    var objet = $('#objet'); // formulaire recherche objet
    var vendeur = $('#vendeur'); // formulaire recherche vendeur

    var formobj = $('#formObjet'); // lien vers le formulaire de recherche objet
    var formvendeur = $('#formVendeur'); // lien vers le formulaire de recherche vendeur

    //fonctions pour qu'un seul formulaire ne s'affiche
    objet.hide();

    formobj.click(function() {
        objet.show();

        if (objet.css('display') == 'block') {
            vendeur.hide();
        }
    });

    formvendeur.click(function() {
        vendeur.show();

        if (vendeur.css('display') == 'block') {
            objet.hide();
        }
    });


    /*AUTOCOMPLETION HEADER*/


    $('#article_search').keyup(function() {
        $('#result').html('');
        var article = $(this).val();
        console.log(article);
        $.get(
            'API/apiAutocompletion.php', {
                term: article,
            },
            function(data) {
                console.log(data)
                let articles = JSON.parse(data);
                console.log(articles);
                for (let article of articles) {
                    $('#result').append('<a href="article?article=' + article.id + '">' + article.titre + '</a></br>');
                }
            },
        );

    });





    /*BARRE DE RECHERCHE AVANCÉE*/

    $('body').on('submit', '#form_objet', function(event) {
        $('#message').empty();
        event.preventDefault()
        $.post(
            'API/apiSearch.php', {
                form: 'home',
                nom: $('#categorie').val(),
                zip: $('#zip').val(),
                titre: $('#titre').val(),

            },
            function(data) {
                console.log(data);
                let messages = JSON.parse(data);
                for (let message of messages) {
                    if (message === "success") {
                        $('#message').append("<a href='resultatArticles'></a>");
                    } else {
                        $('#message').append("<p>" + message + "</p>")
                    }
                }
            },
        );
    });


    $('#titre').keyup(function() {
        $('#message').html('');
        var article = $(this).val();
        console.log(article);
        $.get(
            'API/apiSearch.php', {
                term: article,
            },
            function(data) {
                console.log(data)
                let articles = JSON.parse(data);
                console.log(articles);
                for (let article of articles) {
                    $('#message').append('<a href="resultatArticles?article=' + article.id + '">' + article.titre + ' dans ' + article.nom + '</a ></br> ');
                }
            },
        );
    });

    //PRICE RANGE
    var rangeslider = document.getElementById("sliderRange");
    var output = document.getElementById("demo");
    output.innerHTML = rangeslider.value;

    rangeslider.oninput = function() {
        output.innerHTML = this.value;
    }



    $('#user').keyup(function() {
        $('#message').html('');
        var user = $(this).val();
        console.log(user);
        $.get(
            'API/apiSearch.php', {
                search: user,
            },
            function(data) {
                console.log(data)
                let users = JSON.parse(data);
                console.log(users);
                for (let user of users) {
                    $('#message').append('<a href="profilVendeur?vendeur=' + user.id + '">' + user.identifiant + '</a></br>');
                }
            },
        );

    });

});