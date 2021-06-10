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


    $('body').on('click', '.updateStatus', function() {
        let row = $(this).parents('tr')
        let idArticle = row.attr('id');
        let articleName = row.attr('value');

        if ($('newName').length == 0) {

        }
    })

    /* $('body').one('click', '.updateCat', function () {
        let row = $(this).parents('tr')
        let idCategory = row.attr('id');
        let categoryName = row.attr('value');
        if ($('#newName').length == 0) {
            $(this).after("<input id='newName' value='" + categoryName + "'>")
        }
        $('body').on('click', '.updateCat', function () {
            $.post(
                'API/apiAdmin', {action: 'updateCat', idCategory: idCategory, newName: $('#newName').val()},
                function (data) {
                    console.log(data);
                    $('#infoAdmin').html('<p>Nom de la catégorie updatée !</p>')
                    setTimeout(
                        function () {
                            $("#mainAdmin").load(location.href + " #mainAdmin")
                        }, 2000);
                }
            )
        })
    }) */
    /*******************RECHERCHE COMPLETE**********************/

    $('#form_objet').submit(function(e) {
        e.preventDefault();

        //.serialize à la place des var va chercher dans POST
        //function filter_data() {
        $('#message_form').html('');

        var nom = $('nom').attr('value');
        var titre = $('titre').attr('value');
        var zip = $('zip').attr('value');
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