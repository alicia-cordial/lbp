$(document).ready(function () {
    $('select').formSelect();
    /*NAVIGATION*/
    $('body').on('click', '.navUser', function () {
        $('.navUser').removeClass('activeTab');
        $(this).addClass('activeTab');
        $('#sectionVendeur').empty();

        //Articles en vente
        if ($(this).is('#navArticleSelling')) {
            callSectionUser('vendeurArticlesEnVente')
            $.post(
                'API/apiVendeur.php', {action: 'articlesSelling'},
                function (data) {
                    let articles = JSON.parse(data);
                    console.log(articles)
                    if (articles == 'none') {
                        $("#articlesSelling tbody").append("<tr><td>Il n'y a rien ici.</td><td class='navUser navNewArticle'> + Déposer une annonce</td></tr>");
                    } else {
                        for (let article of articles) {
                            d = new Date();
                            $('#articlesSelling tbody').append("<tr id ='" + article.id_article
                                + "'><td><a class='titleArticle' href='article?id=" + article.id_article + "'>" + article.titre + "</a></td><td>" +
                                "<img height='100' width='100' src='img/articles/" + article.photo + '?' + d.getTime() + "'>" +
                                "</td><td>" + article.date + "</td><td>" +
                                "    <select class='marquerCommeVendu'>" +
                                "      <option selected value=''>Vendu à : </option>" +
                                "    </select></td><td><a href='#detailsArticle' rel='modal:open' class='btn-flat afficherDetails' >Modifier</a></td>" +
                                "<td><a class='btn-flat supprimerArticle' >Supprimer</a></td></tr>");
                        }
                        let select = $('.marquerCommeVendu') //MENU DEROULANT
                        $.post(
                            'API/apiMessagerie', {action: 'selectContacts'},
                            function (data) {
                                let contacts = JSON.parse(data);
                                console.log(data);
                                if (contacts == 'none') {
                                    select.append("<option>Aucun contact</option>");
                                } else {
                                    $.each(contacts, function (key, value) {
                                        if (value.status != 'supprimé') {
                                            select.append("<option value='" + value.id + "'>" + value.identifiant + "</option>")
                                        }
                                    })
                                }
                            },
                        );
                    }
                })

            //Créer nouvelle annonce
        } else if ($(this).is('.navNewArticle')) {
            $.post(
                'API/apiVendeur.php', {action: 'afficherNewArticle'},
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
                'API/apiVendeur.php', {action: 'articlesSold'},
                function (data) {
                    let articles = JSON.parse(data);
                    console.log(data);
                    if (articles == 'none') {
                        $("#articlesVendus").append("<tr><td>Il n'y a rien ici.</td></tr>");
                    } else {
                        for (let article of articles) {
                            $('#articlesVendus').append("<tr id = '" + article.id_article + "'><td>" + article.titre + "</td><td>" +
                                "<img height='100' width='100' src='img/articles/" + article.photo + "'>" +
                                "</td>" +
                                "<td>" + article.identifiant + "</td><td>" + article.date + "</td><td><a class='btn-flat supprimerArticle' >Supprimer</a></td></tr>");
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
                $('<input type="text" id="catSuggeree" placeholder="categorie suggérée">').insertAfter('select[name="categorie"]')
                $("#message").append("<p id='infoCat'>La création d'une nouvelle catégorie envoie votre article en modération</p>");
            }
        } else {
            $('#catSuggeree').remove()
            $('#infoCat').remove()
        }
    })

    /*Formulaire New Article*/
    $('body').on('submit', '#formNewArticle', function (event) {
        event.preventDefault()
        $.post(
            'API/apiVendeur.php', {
                form: 'newArticle',
                titre: $('#titre').val(),
                description: $('#description').val(),
                prix: $('#prix').val(),
                etat: $('select[name="etat"] option:selected').val(),
                categorie: $('select[name="categorie"] option:selected').val(),
                negociation: $('#negociation input:checked').val(),
                catSuggeree: $('#catSuggeree').val(),
                picture: $('#uploadPicNew').attr('value')
            },
            function (data) {
                $('#message').empty();
                console.log(data);
                let message = JSON.parse(data);
                $('#formNewArticle').empty();
                if (message === "success") {
                    M.toast({html: 'Annonce Créée !'})
                } else if (message === "moderation") {
                    M.toast({html: 'Annonce en modération. Veuillez attendre 48 heures avant de contacter un.e administrateur.ice.'})
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
        $(this).css('background', 'none')
        $(this).html('<a class="btn-flat btn-small" id="confirmSupprArticle">Oui</a> <a class="btn-flat btn-small navUser">Non</a>')
        $('body').on('click', '#confirmSupprArticle', function () {
            $.post(
                'API/apiVendeur.php', {action: 'supprimerArticle', id: idArticle},
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
            let thisSelect = $(this).closest('.marquerCommeVendu')
            $('<br><a class="btn-flat" id ="confirmerVente">Confirmer</a>').insertAfter(thisSelect)
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
        $('#detailsArticle').empty()
        let row = $(this).parents('tr')
        let idArticle = row.attr('id')
        $.post(
            'API/apiVendeur.php', {
                action: 'afficherDetails',
                idArticle: idArticle,
            },
            function (data) {
                console.log(data)
                $('#detailsArticle').append(data)
                let src = $('.preview').attr('value')
                $('.preview').css("background-image", "url('img/articles/" + src + "')")
            },
        );
    });

    //Formulaire modification article
    $('body').on('submit', '.formUpdateArticle', function (event) {
        $('#message').empty();
        event.preventDefault()
        let idArticle = ($('.formUpdateArticle').attr('id'))
        $.post(
            'API/apiVendeur.php', {
                form: 'updateArticle',
                idArticle: idArticle,
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
                    M.toast({html: 'Update réussie !'})
                    $('#' + idArticle + ' a').first().text($('#titre').val())
                    d = new Date();
                    $('#' + idArticle).find('img').css("background-image", "url('img/articles/" + $('#uploadPicUpdate').attr('value') + '?' + d.getTime() + "')")
                } else {
                    $('#message').append("<p>" + message + "</p>");
                }
            },
        );
    });

    /*FICHIER PHOTO*/
    $('body').on('click', '.uploadPic', function (event) {
            let button = $(this)
            console.log($(this))
            $('#messageFile').empty()
            var fd = new FormData();
            var files = $('#file')[0].files;
            if (button.is('uploadPicUpdate')) {
                var action = "update"
            } else if (button.is('uploadPicNew')) {
                var action = "newArticle"
            }
            var src = button.attr('value')

            // Check file selected or not
            if (files.length > 0) {
                fd.append('file', files[0]);
                fd.append('action', action);
                fd.append('src', src);

                $.ajax({
                    url: 'API/apiVendeur.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response)
                        if (response != 0) {
                            d = new Date();
                            $(".preview").css("background-image", "url('img/articles/" + response + '?' + d.getTime() + "')")
                            button.attr('value', response)
                        } else {
                            $('#messageFile').html("Le fichier ne s'est pas envoyé")
                        }
                    },
                });
            } else {
                $('#messageFile').html("Sélectionnez un fichier SVP");
            }
        }
    );
});