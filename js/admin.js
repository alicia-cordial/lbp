$(document).ready(function () {
    //
    $('body').on('click', '.navAdmin', function () {
        $('#sectionAdmin').empty();

        if ($(this).is('#navAdminUsers')) {
            callSectionAdmin('adminUsers')
        } else if ($(this).is('#navAdminMessagerie')) {
            callSectionAdmin('adminMessagerie')
            $.post(
                'API/apiMessagerie', {action: 'selectContacts'},
                function (data) {
                    let contacts = JSON.parse(data);
                    let contactList = $('#contacts')
                    console.log(data);
                    if (contacts == 'none') {
                        contactList.append("Aucune conversation");
                    } else {
                        $.each(contacts, function (key, value) {
                            contactList.append("<p class='individualConversation' id='" + value.id + "'>" + value.identifiant + "</p>")
                        })
                    }
                }
            );
        } else if ($(this).is('#navAdminModeration')) {
            callSectionAdmin('adminModeration')
        } else if ($(this).is('#navAdminCategorie')) {
            callSectionAdmin('adminShop')
            $.post(
                'API/apiAdmin', {
                    action: 'selectCategories',
                },
                function (data) {
                    console.log(data);
                    let categories = JSON.parse(data);
                    if (categories === 'none') {
                        $('#categories').append("<p>Rien</p>")
                    } else {
                        for (let cat of categories) {
                            if ($('#' + cat.id).length === 0) {
                                if (cat.titre) {
                                    $('#categories').append("<tr value='" + cat.nom + "' id='" + cat.id + "'><td><td class='rowCategorie'>" + cat.nom + "</td><td class='rowCategorie'>Voir les articles</td><td><button class='updateCat'>Modifier le nom</button></td></tr>")
                                } else {
                                    $('#categoriesVides').append("<tr value='" + cat.nom + "' id='" + cat.id + "'><td><td class='rowCategorie'>" + cat.nom + "</td><td><button class='deleteCat'>Supprimer la catégorie</button></td></tr>")
                                }
                            }
                        }
                    }
                }
            )

        }
    })

    //MESSAGERIE
    $('body').on('click', '.individualConversation', function (event) {
        let idDestinataire = $(this).attr('id')
        // console.log(idDestinataire)
        let conversation = $('#conversation')
        conversation.empty()
        $.post(
            'API/apiMessagerie', {action: 'showConversation', idDestinataire: idDestinataire},
            function (data) {
                $('#formNewMessage').css('display', 'block')
                $('#formNewMessage').attr('value', idDestinataire)
                let messages = JSON.parse(data);
                console.log(messages);
                for (let message of messages) {
                    conversation.append("<p id='message" + message.id + "'>Envoyé le : " + message.date + " - " + message.contenu + "</p>")
                    if (message.id_expediteur == idDestinataire) {
                        $('#message' + message.id).addClass('messageDestinataire')
                    } else {
                        $('#message' + message.id).addClass('messageUtilisateur')
                    }
                }
            })
    })

    //NEW MESSAGE IN CONVERSATION
    $('body').on('submit', '#formNewMessage', function (event) {
        let idDestinataire = $(this).attr('value')
        event.preventDefault()
        let conversation = $('#conversation')
        console.log(idDestinataire)
        console.log($('#newMessage').val())
        $.post(
            'API/apiMessagerie', {
                action: 'sendNewMessage',
                idDestinataire: idDestinataire,
                messageContent: $('#newMessage').val()
            },
            function (data) {
                let message = JSON.parse(data);
                $('#newMessage').val('')
                console.log(data);
                conversation.append("<p id='message" + message.id + "' class='messageUtilisateur'>Envoyé le : " + message.date + " - " + message.contenu + "</p>")
            }
        )
    })

    $('body').on('click', '.rowCategorie', function () {
        let row = $(this).parents('tr')
        let idCategory = row.attr('id');
        console.log(idCategory)
        $('#articlesTries').empty()
        $.post(
            'API/apiAdmin', {action: 'showArticlesCategorie', idCategory: idCategory},
            function (data) {
                console.log(data);
                let articles = JSON.parse(data);
                for (let article of articles) {
                    $('#articlesTries').append("<tr id='" + article.article_id + "'><td><a href='article?id=" + article.id + "'>" + article.titre + "</a></td><td>Mise en vente : " + article.date_ajout + "</td><td>Vendeur.se : " + article.identifiant + "</td><td><a id ='" + article.id_vendeur + "' class='contactUser' href='#ex1' rel='modal:open'>Contacter le vendeur</a></td><td><button class='deleteArticle'>Supprimer</button></td></tr>")
                }

            }
        )
    })

    $('body').one('click', '.updateCat', function () {
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
    })


    $('body').one('click', '.deleteCat', function () {
        let row = $(this).parents('tr')
        let idCategory = row.attr('id');
        $.post(
            'API/apiAdmin', {action: 'deleteCat', id: idCategory},
            function (data) {
                console.log(data);
                let message = JSON.parse(data);
                row.hide()
                $('#infoAdmin').html('<p>Catégorie supprimée.</p>')

            }
        )
    })

    //Button nouvelle catégorie
    $('body').one('click', '#addNewCat', function () {
        if ($('#newCatName').length == 0) {
            $(this).after("<input id='newCatName'>")
        }
        $('body').on('click', '#addNewCat', function () {
            $.post(
                'API/apiAdmin', {action: 'addNewCat', name: $('#newCatName').val()},
                function (data) {
                    console.log(data);
                    let cat = JSON.parse(data);
                    $('#newCatName').empty()
                    $('#categoriesVides').append("<tr value='" + cat.nom + "' id='" + cat.id + "'><td><td class='rowCategorie'>" + cat.nom + "</td><td><button class='deleteCat'>Supprimer la catégorie</button></td></tr>")
                    $('#infoAdmin').html('<p>Catégorie créée.</p>')

                }
            )
        })
    })

    $('body').on('click', '.showUsers', function () {
        let choice = $(this).attr('value');
        $('#listeUsersTries').empty()
        console.log(choice)
        $.post(
            'API/apiAdmin', {
                action: 'showUsers',
                choice: choice
            },
            function (data) {
                console.log(data);
                let users = JSON.parse(data);
                if (users === 'none') {
                    $('#listeUsersTries').append("<p>Rien</p>")
                } else {
                    for (let user of users) {
                        if (user.status == 'vendeur') {
                            $('#listeUsersTries').append("<tr value='" + user.identifiant + "' id='" + user.id + "'><td><a href='profilVendeur?id=" + user.id + "'>" + user.identifiant + "</a></td><td>" + user.status + "</td><td>Inscription : " + user.date_inscription + "</td><td><a id ='" + user.id_vendeur + "' class='contactUser' href='#ex1' rel='modal:open'>Contacter le vendeur</a></td><td><button class='deleteUser'>Supprimer</button></td></tr>")
                        } else {
                            $('#listeUsersTries').append("<tr value='" + user.identifiant + "' id='" + user.id + "'><td>" + user.identifiant + "</td><td>" + user.status + "</td><td>Inscription : " + user.date_inscription + "</td><td><a id ='" + user.id_vendeur + "' class='contactUser' href='#ex1' rel='modal:open'>Contacter le vendeur</a></td><td><button class='deleteUser'>Supprimer</button></td></tr>")
                        }
                    }
                }
            }
        )
    })

    //BOUTON SUPPRIMER user
    $('body').on('click', '.deleteUser', function () {
        let row = $(this).parents('tr')
        let idUser = row.attr('id')
        $('#infoAdmin').empty()
        $(this).html('<button id="confirmSupprUser">Êtes-vous sûr.e ? </button><button class="navAdmin">Non.</button>')
        $('#infoAdmin').append("<p>Si l'utilisateur est un vendeur, ses articles en vente seront aussi supprimés. Procéder avec prudence.</p>")
        $('body').on('click', '#confirmSupprUser', function () {
            $.post(
                'API/apiAdmin', {action: 'deleteUser', id: idUser},
                function (data) {
                    let message = JSON.parse(data);
                    row.hide()
                    $('#infoAdmin').html('<p>Utilisateur.ice supprimé.e.</p>')
                },
            );
        });
    })



    //BOUTON CONTACT user
    $('body').on('click', '.contactUser', function (event) {
        $('#nameDestinataire').empty()
        let row = $(this).parents('tr')
        let idDestinataire = row.attr('id')
        let loginDestinataire = row.attr('value')
        $('#nameDestinataire').append('<p>'+loginDestinataire+'</p>')
        $('body').on('submit', '#newMessage', function (event) {

            console.log($('#newMessage input').val())
            event.preventDefault()
            $.post(
                'API/apiMessagerie', {
                    action: 'sendNewMessage',
                    idDestinataire: idDestinataire,
                    messageContent: $('#newMessage input').val()
                },
                function (data) {
                    let message = JSON.parse(data);
                    console.log(data);
                    $('#infoMessage').append("<p>Message envoyé !</p>")
                }
            )
        })
    });


    //MODERATION
    $('body').on('click', '.showModeration', function () {
        let choice = $(this).attr('value');
        $('#moderationTriees').empty()
        console.log(choice)
        $.post(
            'API/apiAdmin', {
                action: 'showModeration',
                choice: choice
            },
            function (data) {
                console.log(data);
                let articles = JSON.parse(data);
                if (articles === 'none') {
                    $('#moderationTriees').append("<p>Rien</p>")
                } else {
                    for (let article of articles) {
                        if (article.categorie_suggeree != null) {
                            console.log("cat")
                            $('#moderationTriees').append("<tr id='" + article.article_id + "'><td>" + article.titre + "</td><td><a id='" + article.id_vendeur + "' href='profilVendeur?id=" + article.id_vendeur + "'>" + article.identifiant + "</a></td><td>Date création : " + article.date_ajout + "</td><td>Catégorie suggérée : <input value='" + article.categorie_suggeree + "'></td><td>" + article.description + "</td><td><button class='acceptArticleNewCat'>Accepter</button></td><td><button class='deleteArticle'>Supprimer</button></td></tr>")
                        } else if (article.signal == 2 && article.categorie_suggeree == null && article.nom != null) {
                            console.log('signal')
                            $('#moderationTriees').append("<tr id='" + article.article_id + "'><td>" + article.titre + "</td><td class='categorie' id='" + article.id_categorie + "'>" + article.nom + "</td><td><a href='profilVendeur?id=" + article.id_vendeur + "'>" + article.identifiant + "</a></td><td>Date création : " + article.date_ajout + "</td><td>" + article.description + "</td><td><button class='acceptArticleSignal'>Accepter</button></td><td><button class='deleteArticle'>Supprimer</button></td></tr>")
                        }
                    }
                }
            })
    })


    /*SUPPRIMER UN ARTICLE*/
    $('body').on('click', '.deleteArticle', function () {
        let row = $(this).parents('tr')
        let idArticle = row.attr('id')
        $('#infoAdmin').empty()
        console.log(idArticle)
        $(this).html('<button id="confirmSupprArticle">Êtes-vous sûr.e ? </button><button class="navAdmin">Non.</button>')
        $('body').on('click', '#confirmSupprArticle', function () {
            $.post(
                'API/apiAdmin', {action: 'deleteArticle', id: idArticle},
                function (data) {
                    let message = JSON.parse(data);
                    row.hide()
                    $('#infoAdmin').html('<p>Article supprimé.</p>')
                },
            );
        });
    })

    //ACCEPTER UN ARTICLE AVEC CREATION D'UNE NOUVELLE CATEGORIE
    $('body').on('click', '.acceptArticleNewCat', function () {
        let row = $(this).parents('tr')
        let idArticle = row.attr('id')
        let categoryName = row.find('input').val()
        let idVendeur = row.find('a').val()
        console.log(idArticle)
        $('#infoAdmin').empty()
        $.post(
            'API/apiAdmin', {
                action: 'acceptArticleNewCat',
                id: idArticle,
                categoryName: categoryName,
                idVendeur: idVendeur
            },
            function (data) {
                let result = JSON.parse(data);
                if (result === "fail") {
                    $('#infoAdmin').html("<p>Un problème est survenu.</p>")
                } else {
                    row.hide()
                    $('#infoAdmin').html("<p><a href='article?id=" + idArticle + "'>Article en ligne !</a></p>")
                }
            },
        );
    });


    //ACCEPTER UN ARTICLE SIGNALE
    $('body').on('click', '.acceptArticleSignal', function () {
        let row = $(this).parents('tr')
        let idArticle = row.attr('id')
        console.log(idArticle)
        $('#infoAdmin').empty()
        $.post(
            'API/apiAdmin', {action: 'acceptArticleSignal', id: idArticle},
            function (data) {
                let result = JSON.parse(data);
                if (result === "fail") {
                    $('#infoAdmin').html("<p>Un problème est survenu.</p>")
                } else {
                    row.hide()
                    $('#infoAdmin').html("<p><a href='article?id=" + idArticle + "'>Article en ligne !</a></p>")
                }
            },
        );
    });
})

/*FUNCTIONS*/
function callSectionAdmin(page) {
    $.get('views/admin/' + page + '.php',
        function (data) {
            $('#sectionAdmin').html(data);
        });
}


