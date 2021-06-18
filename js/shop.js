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



    /**************MESSAGERIE**********/


    $('body').on('click', '.contactUser', function(event) {
        $('#nameDestinataire').empty()
        let idDestinataire = $('#idDestinataire').attr('value'); //id 
        console.log(idDestinataire)
        let loginDestinataire = $('#nameDestinataire').attr('value'); //login
        console.log(loginDestinataire)
        $('#nameDestinataire').append('<p>' + loginDestinataire + '</p>')
        $('body').on('submit', '#newMessage', function(event) {

            console.log($('#newMessage input').val())
            event.preventDefault()
            $.post(
                'API/apiMessagerie.php', {
                    action: 'sendNewMessage',
                    idDestinataire: idDestinataire,
                    messageContent: $('#newMessage input').val()
                },
                function(data) {
                    let message = JSON.parse(data);
                    console.log(data);
                    $('#infoMessage').append("<p>Message envoyé !</p>")
                }
            )
        })
    });



    /*
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
    */



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



    /*******************RECHERCHE COMPLETE**********************/

    $('#form_objet').submit(function(e) {
        e.preventDefault();

        //.serialize à la place des var va chercher dans POST
        //function filter_data() {
        $('#message_form').html('');
        var action = 'apiSearch'; //je sais pas d'où ça vient
        //var minimum_price = $('#hidden_minimum_price').val();
        //var maximum_price = $('#hidden_maximum_price').val();
        var nom = $('nom').val();
        var titre = $('titre').val();
        var zip = $('zip').val();
        $.ajax({
            url: "API/apiSearch.php",
            method: "POST",
            data: { nom: nom, titre: titre, zip: zip },
            dataType: "json",
            encode: true,
            success: function(data) {
                $('#message_form').append("<p>Message envoyé !</p>");

            }
        });


        // }


        /*
                $('#price_range').slider({
                    range: true,
                    min: 1000,
                    max: 65000,
                    values: [1000, 65000],
                    step: 500,
                    stop: function(event, ui) {
                        $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                        $('#hidden_minimum_price').val(ui.values[0]);
                        $('#hidden_maximum_price').val(ui.values[1]);
                        filter_data();
                    }
                });*/
    });

})