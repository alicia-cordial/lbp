/*AUTOCOMPLETION HEADER*/

$(document).ready(function() {
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
                    $('#result').append('<a href="article?article=' + article.id + '">' + article.titre + '</a>');
                }
            },
        );

    });
});




// PAGE INDEX TOGGLE
var objet = $('#objet'); // formulaire recherche objet
var vendeur = $('#vendeur'); // formulaire recherche vendeur

var formobj = $('#form_objet'); // lien vers le formulaire de recherche objet
var formvendeur = $('#form_vendeur'); // lien vers le formulaire de recherche vendeur

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


/*BARRE DE RECHERCHE AVANCÉE*/


$(document).ready(function() {
    $('#search_all').keyup(function() {
        $('#result_search').html('');
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
                    $('#result_search').append('<a href="resultatArticle?article=' + article.id + '">' + article.titre + '</a>');
                }
            },
        );

    });
});


$(document).ready(function() {
    $('#search_zip').keyup(function() {
        $('#result_search').html('');
        var user = $(this).val();
        console.log(user);
        $.get(
            'API/apiSearch.php', {
                zip: user,
            },
            function(data) {
                console.log(data)
                let users = JSON.parse(data);
                console.log(articles);
                for (let user of users) {
                    $('#result_search').append('<a href="resultatArticle?article=' + user.id + '"></a>');
                }
            },
        );

    });
});

$(document).ready(function() {
    $('#search_user').keyup(function() {
        $('#result_search').html('');
        var user = $(this).val();
        console.log(user);
        $.get(
            'API/apiSearch.php', {
                vendeur: user,
            },
            function(data) {
                console.log(data)
                let users = JSON.parse(data);
                console.log(articles);
                for (let user of users) {
                    $('#result_search').append('<a href="profilVendeur?vendeur=' + user.id + '"></a>');
                }
            },
        );

    });
});