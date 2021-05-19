$(document).ready(function () {

    /*1 - Module Inscription/Connexion*/
    //TOGGLE inscription / connexion
    $('body').on('click', '.callForm', function () {
        if ($(this).is('#callFormInscription')) {
            callform('inscription')
        } else {
            callform('connexion')
        }

        function callform(page) {
            $.get('views/user/' + page + '.php',
                function (data) {
                    $('#mainCompte').html(data);
                });
        };
    });

    /*INSCRIPTION*/
    //Display inscription blocks
    $('body').on('click', 'input[name=status]', function () {
        $('#bloc2').css('display', 'block')
    });
    $('body').on('change', '#password2', function () {
        $('#bloc3').css('display', 'block')
    });

    //Submit inscription
    $('body').on('submit', '#formInscription', function (event) {
        $('#message').empty();
        event.preventDefault()
        $.post(
            'API/apiModule',
            {
                form: 'inscription',
                status: $("input[name='status']:checked").val(),
                login: $('#login').val(),
                password: $('#password').val(),
                password2: $('#password2').val(),
                email: $('#email').val(),
                zip: $('#zip').val()
            },
            function (data) {
                console.log(data);
                let messages = JSON.parse(data);
                for (let message of messages) {
                    if (message === "success") {
                        $("#message").append("<p>Inscription réussie !</p>");
                    } else {
                        $('#message').append("<p>" + message + "</p>");
                    }
                }
            },
        );
    });

    /*CONNEXION*/
    //Display 2d block
    $('body').on('click', '#login', function () {
        $('#bloc2').css('display', 'block')
    });

    //Submit connexion
    $('body').on('submit', '#formConnexion', function (event) {
        $('#message').empty();
        event.preventDefault()
        $.post(
            'API/apiModule',
            {
                form: 'connexion',
                login: $('#login').val(),
                password: $('#password').val(),
            },
            function (data) {
                console.log(data);
                let messages = JSON.parse(data);
                for (let message of messages) {
                    if (message === "success") {
                        $("#message").append("<p>Connexion réussie !</p> <a href='compte'>Voir votre profil</a>");
                    } else {
                        $('#message').append("<p>" + message + "</p>");
                    }
                }
            },
        );
    });


    /*2 - ESPACE VENDEUR*/
    //TABULATIONS
    /* $('body').on('click', '.navUser', function () {
         if ($(this).is('.navNewArticle')) {
             callform('vendeurNewArticle')
         } else {
             callform('vendeurArticlesEnVente')
         }

         function callform(page) {
             $.get('views/user/' + page + '.php',
                 function (data) {
                     $('#sectionVendeur').html(data);
                 });
         };
     });*/

    $('body').on('click', '.navUser', function () {
        $('#sectionVendeur').empty();

        function callSectionUser(page) {
            $.get('views/user/' + page + '.php',
                function (data) {
                    $('#sectionVendeur').html(data);
                });
        }

        if ($(this).is('#navArticleSelling')) {
            callSectionUser('vendeurArticlesEnVente')
            $.post(
                'API/apiVendeur',
                {action: 'articleSelling',},
                function (data) {
                    let articles = JSON.parse(data);
                    console.log(data);
                    for (let article of articles) {
                        if (article === "none") {
                            $("#articlesSelling").append("<p>Il n'y a rien ici.</p><p class='navUser navNewArticle'> + Déposer une annonce</p>");
                        } else {
                            $('#articlesSelling').append("<p>" + article.titre + "</p>");
                        }
                    }
                },
            );
        } else if ($(this).is('.navNewArticle')) {
            callSectionUser('vendeurNewArticle')
        } else if ($(this).is('#navSoldArticle')) {
            callSectionUser('vendeurArticlesVendus')
        }
    });


});