$(document).ready(function () {
    /*1 - Module Inscription/Connexion*/
    //TOGGLE inscription / connexion
    $('body').on('click', '.callForm', function () {
        if ($(this).is('#callFormInscription')) {
            callform('inscription')
        } else {
            callform('connexion')
        }
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
            'API/apiModule', {
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
            'API/apiModule', {
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

    /*NAVIGATION*/
    $('body').on('click', '.navUser', function () {
        $('#sectionVendeur').empty();

        if ($(this).is('#navUpdateProfil')) {
            callSectionUser('updateProfile')

            //Articles en vente
        } else if ($(this).is('#navArticleSelling')) {
            callSectionUser('vendeurArticlesEnVente')
            $.post(
                'API/apiVendeur', {action: 'articlesSelling'},
                function (data) {
                    let articles = JSON.parse(data);
                    console.log(articles)
                    if (articles == 'none') {
                        $("#articlesSelling").append("<tr><td>Il n'y a rien ici.</td><td class='navUser navNewArticle'> + Déposer une annonce</td></tr>");
                    } else {
                        for (let article of articles) {
                            $('#articlesSelling').append("<tr id ='" + article.id_article + "'><td><a href='article?id=" + article.id_article + "'>" + article.titre + "</a></td><td>Annonce créee le : " + article.date_ajout + "</td><td><button class='afficherDetails' >Modifier</button></td><td><select class='marquerCommeVendu'><option value=''>Vendu à : </option></select></td><td><button class='supprimerArticle' >Supprimer</button></td></tr>");
                        }
                        let select = $('.marquerCommeVendu')
                        $.post(
                            'API/apiVendeur', {action: 'selectContacts'},
                            function (data) {
                                let contacts = JSON.parse(data);
                                console.log(data);
                                if (contacts == 'none') {
                                    select.append("<option>Aucun contact</option>");
                                } else {
                                    $.each(contacts, function (key, value) {
                                        select.append("<option value='" + value.id + "'>" + value.identifiant + "</option>")
                                    })
                                }
                            },
                        );
                    }
                })

//Créer nouvelle annonce
        } else if ($(this).is('.navNewArticle')) {
            $.post(
                'API/apiVendeur', {action: 'afficherNewArticle'},
                function (data) {
                    if (data === 'maximum') {
                        $('#sectionVendeur').html('Vous avez atteint le maximum d\'annonces en ligne.');
                    } else {
                        $('#sectionVendeur').html(data);
                    }

                })

            //Historique de vente
        } else if ($(this).is('#navSoldArticle')) {
            callSectionUser('vendeurArticlesVendus')
            console.log($(this))
            $.post(
                'API/apiVendeur', {action: 'articlesSold'},
                function (data) {
                    let articles = JSON.parse(data);
                    console.log(data);
                    if (articles == 'none') {
                        $("#articlesVendus").append("<tr><td>Il n'y a rien ici.</td></tr>");
                    } else {
                        for (let article of articles) {
                            $('#articlesVendus').append("<tr id = '" + article.id_article + "'><td>" + article.titre + "</td><td> Acheté par : " + article.identifiant + "</td><td> Vendu le : " + article.date_vente + "</td><td><button class='supprimerArticle' >Supprimer</button></td></tr>");
                        }
                    }
                });
        }
    });

    /*Submit New Article*/
    //Suggérer une nouvelle catégorie
    $('body').on('click', 'select[name="categorie"] option', function (event) {
        if ($(this).is('#autreCat')) {
            if ($('#infoCat').length === 0) {
                $('<input id="catSuggeree" placeholder="categorie suggérée">').insertAfter('select[name="categorie"]')
                $("#message").append("<p id='infoCat'>La création d'une nouvelle catégorie envoie votre article en modération</p>");
            }
        } else {
            $('#catSuggeree').remove()
            $('#infoCat').remove()
        }
    })

    /*Submit New Article*/
    $('body').on('submit', '#formNewArticle', function (event) {
        event.preventDefault()
        $.post(
            'API/apiVendeur', {
                form: 'newArticle',
                titre: $('#titre').val(),
                description: $('#description').val(),
                prix: $('#prix').val(),
                etat: $('select[name="etat"] option:selected').val(),
                categorie: $('select[name="categorie"] option:selected').val(),
                negociation: $('#negociation input:checked').val(),
                catSuggeree: $('#catSuggeree').val()
            },
            function (data) {
                $('#formNewArticle').empty();
                $('#message').empty();
                console.log(data);
                let message = JSON.parse(data);
                if (message === "success") {
                    $("#message").append("<p>Annonce créée !</p>");
                } else if (message === "moderation") {
                    $("#message").append("<p>Annonce en modération. Veuillez attendre 48 heures avant de contacter un.e administrateur.ice.</p>");
                } else {
                    $('#message').append("<p>" + message + "</p>");
                }
            });
    });

    /*BOUTONS D'ACTION*/
    //Supprimer article de la bdd
    $('body').on('click', '.supprimerArticle', function () {
        let row = $(this).parents('tr')
        let idArticle = row.attr('id')
        $(this).html('<button id="confirmSupprArticle">Êtes-vous sûr.es ? </button><button class="navUser">Non.</button>')
        $('body').on('click', '#confirmSupprArticle', function () {
            $.post(
                'API/apiVendeur', {action: 'supprimerArticle', id: idArticle},
                function (data) {
                    let message = JSON.parse(data);
                    row.hide()
                    console.log(message)
                },
            );
        });
    });

//Quand un acheteur est sélectionné, append le bouton confirmer
    $('body').on('click', '.marquerCommeVendu option:selected', function () {
        if (($('option:selected').val().length > 0 && $('#confirmerVente').length === 0)) {
            $('<button id ="confirmerVente">Confirmer la vente</button>').insertAfter('.marquerCommeVendu')
        } else if ($('option:selected').val().length === 0) {
            $('#confirmerVente').remove()
        }
    });

    //Marquer comme vendu
    $('body').on('click', '#confirmerVente', function () {
        let row = $(this).parents('tr')
        let idArticle = row.attr('id')
        if ($('option:selected').val().length > 0) {
            $.post(
                'API/apiVendeur', {
                    action: 'marquerCommeVendu',
                    idArticle: idArticle,
                    idAcheteur: $('option:selected').val()
                },
                function (data) {
                    let message = JSON.parse(data);
                    row.hide()
                    console.log(message)
                }
            );
        }
    });

    //Afficher formulaire modification article
    $('body').on('click', '.afficherDetails', function () {
        $('#detailsArticles').empty()
        let row = $(this).parents('tr')
        let idArticle = row.attr('id')
        $.post(
            'API/apiVendeur', {
                action: 'afficherDetails',
                idArticle: idArticle,
            },
            function (data) {
                $('#detailsArticles').append(data)
            },
        );
    });

    //Formulaire modification article
    $('body').on('submit', '.formUpdateArticle', function (event) {
        $('#message').empty();
        event.preventDefault()
        console.log($('.formUpdateArticle').attr('id'))
        $.post(
            'API/apiVendeur', {
                form: 'updateArticle',
                idArticle: $('.formUpdateArticle').attr('id'),
                titre: $('#titre').val(),
                description: $('#description').val(),
                prix: $('#prix').val(),
                etat: $('select[name="etat"] option:selected').val(),
                categorie: $('select[name="categorie"] option:selected').val(),
                negociation: $('#negociation input:checked').val()
            },
            function (data) {
                console.log(data);
                let message = JSON.parse(data);
                if (message === "success") {
                    $("#message").append("<p>Update réussie !</p>");
                    // $(".formUpdateArticle").load(location.href + ' .formUpdateArticle')
                } else {
                    $('#message').append("<p>" + message + "</p>");
                }
            },
        );
    });


    /*FUNCTIONS*/
    function callform(page) {
        $.get('views/user/' + page + '.php',
            function (data) {
                $('#mainCompte').html(data);
            });
    };


    function callSectionUser(page) {
        $.get('views/user/' + page + '.php',
            function (data) {
                $('#sectionVendeur').html(data);
            });
    }

});