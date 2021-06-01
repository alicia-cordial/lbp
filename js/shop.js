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


    /*************************AUTOCOMPLETION HEADER************************/

    //RECHERCHE ARTICLE


    //$('#sectionArticle').empty();


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

    /*
        ('body').on('click', '#login', function() {

            //$('#sectionArticle').empty();
            $('#message').empty();
            event.preventDefault()

            if ($(this).is('#sectionArticle')) {
                $.get(
                    'API/apiAutocompletion', { titre: resultat },
                    function(data) {
                        let resultat = JSON.parse(data);
                        console.log(resultat)
                        for (let resultat of resultats) {
                            if (message === "success")
                                $('#recherche_titre').append("<tr id='" + resultat.id + "'><td>" + resultat.titre + "</td></tr>")
                        }
                    }
                );
            };

        });*/
    /***********************BARRE DE RECHERCHE AVANCÉE************************/

    //FORMULAIRE RECHERCHE OBJET

    $('body').on('submit', '#form_objet', function(event) {
        $('#message_form').empty();
        event.preventDefault()
        $.post(
            'API/apiSearch.php', {
                form: 'home',
                nom: $('#nom').val(),
                zip: $('#zip').val(),
                titre: $('#titre').val(),

            },
            function(data) {
                console.log(data);
                let articles = JSON.parse(data);
                for (let article of articles) {
                    if (article === "success") {
                        $('#message_form').append('<a href="resultatArticles' + article.id + '" > ' + article.zip + ' </a></br > ');
                    }
                }
            },
        );
    });

    //RECHERCHE TITRE AVEC CATEGORIE

    $('#titre').keyup(function() {
        $('#message_form').html('');
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
                    $('#message_form').append('<a href="resultatArticles?article=' + article.id + '">' + article.titre + ' dans ' + article.nom + '</a ></br> ');
                }
            },
        );
    });
    /*
        //PRICE RANGE

        var rangeslider = document.getElementById("sliderRange");
        var output = document.getElementById("demo");
        output.innerHTML = rangeslider.value;

        rangeslider.oninput = function() {
            output.innerHTML = this.value;
        }
    */








    //RECHERCHE VENDEUR

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
                    //$('#input-id').bind('autocompleteSelect', function(event, node) });
                }



            },

        );

    });



    /*
        jQuery(function() {
            $("#user").autocomplete("API/apiSearch");
        });
    */



})