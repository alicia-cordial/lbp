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
    /*
        $('body').on('click', '.navSearch', function() {
            $('#sectionSearch').empty();

            if ($(this).is('#navSearchSeller')) {
                callSectionSearch('profilVendeur')
            } else if ($(this).is('#navSearchObject')) {
                callSectionSearch('resultatArticles')
                $.post(
                    'API/apiSearch', {action: 'SelectResearch'},
                    function(data){
                        let research = JSON.parse(data);
                        let researchList = $('#result')
                        console.log(data);
                        if(research == 'none'){
                            researchList.append('Aucun résultat');
                        } else {

                        }
                    }
                )
            }
        })
    */


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
                    $('#result').append('<a href="article?id=' + article.id + '">' + article.titre + ' dans ' + article.nom + "</a></br>");

                }
            },
        );

    });





    /***********************BARRE DE RECHERCHE AVANCÉE************************/


    //RECHERCHE TITRE AVEC CATEGORIE
    /*
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
                        $('#message_form').append('<a href="resultatArticles?research=' + article.titre + '">' + article.titre + ' dans ' + article.nom + '</a ></br> ');
                    }
                },
            );
        });

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
                    $('#message').append('<a href="profilVendeur?id=' + user.id + '">' + user.identifiant + '</a></br>');

                }


            },

        );

    });


    $('#rechercher').keyup(function() {
        $('#message_form').html('');
        var recherche = $(this).val();
        console.log(recherche);

        $.get(
            'API/apiSearch.php', {
                research: recherche,

            },
            function(data) {
                let recherches = JSON.parse(data);
                console.log(recherches);

                for (let recherche of recherches) {
                    $('#message_form').append('<a href="resultatArticles?id=' + recherche.id + '">' + recherche.titre + recherche.nom + recherche.zip + '</a></br>');
                }
            },

        );


    });

})