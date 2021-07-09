$(document).ready(function () {

    //NAVIGATION
    $('body').on('click', '.navAdmin', function () {
        $('.navAdmin').removeClass('activeTab');
        $(this).addClass('activeTab');
        $('#sectionAdmin').empty();

        if ($(this).is('#navAdminUsers')) {
            callSectionAdmin('adminUsers')
        } else if ($(this).is('#navAdminMessagerie')) { //MESSAGERIE CONVERSATION
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
                            contactList.append("<p class='individualConversation' id='" + value.id + "'><a href='profilVendeur?id=" + value.id + "'><span class='initialIdentifiant'>" + value.initial + "</span></a> " + value.identifiant + "</p>")
                            if (value.status != 'vendeur') {
                                $('#' + value.id + ' a').addClass('disabled')
                                if (value.status == 'supprimé') {
                                    $('#' + value.id).addClass('supprimé')
                                }
                            }
                        })
                    }
                }
            );

        } else if ($(this).is('#navAdminModeration')) {
            callSectionAdmin('adminModeration')
        } else if ($(this).is('#navAdminCategorie')) { //CATEGORIES
            callSectionAdmin('adminShop')
            $.post(
                'API/apiAdmin.php', {action: 'selectCategories'},
                function (data) {
                    console.log(data);
                    let categories = JSON.parse(data);
                    if (categories === 'none') {
                        $('#categories tbody').append("<p>Rien</p>")
                        $('#categoriesVides tbody').append("<p>Rien</p>")
                    } else {
                        for (let cat of categories) {
                            if ($('#' + cat.id).length === 0) {
                                if (cat.titre) {
                                    $('#categories tbody').append("<tr value='" + cat.nom + "' id='" + cat.id + "'><td><input class='catNameInput' type='text' disabled value='" + cat.nom + "'></input></td><td><a href='#modalArticlesTries' rel='modal:open' class='btn-small btn-flat rowCategorie'>Voir</a></td><td><a class='btn-small btn-flat updateCat'>Modifier</a></td></tr>")
                                } else {
                                    $('#categoriesVides tbody').append("<tr value='" + cat.nom + "' id='" + cat.id + "'><td class='rowCategorie'>" + cat.nom + "</td><td><a class='btn-small btn-flat deleteCat'>Supprimer</a></td></tr>")
                                }
                            }
                        }
                    }
                }
            )

        }
    })

    //TOGGLE CAT
    $('body').on('click', '.toggleCat', function () {
        if ($(this).is('#toggleVide')) {
            $("#categoriesVides").toggle("slow", function () {
            });
            $("#categories").hide()
        } else {
            $("#categories").toggle("slow", function () {
            });
            $("#categoriesVides").hide()
        }

    });

    //CATEGORIES VOIR ARTICLES
    $('body').on('click', '.rowCategorie', function () {
        let row = $(this).parents('tr')
        let idCategory = row.attr('id');
        console.log(idCategory)
        $('#modalArticlesTries h3').text(row.attr('value'))
        $('#articlesTries tbody').empty()
        $.post(
            'API/apiAdmin.php', {action: 'showArticlesCategorie', idCategory: idCategory},
            function (data) {
                console.log(data);
                let articles = JSON.parse(data);
                for (let article of articles) {
                    $('#articlesTries tbody').append("<tr value='" + article.identifiant + "' id='" + article.article_id + "'><td><a href='article?id=" + article.article_id + "'>" + article.titre + "</a></td><td><img height='100' width='100' src='img/articles/" + article.photo + "'></td><td>" + article.date_ajout + "</td><td><a href='profilVendeur?id="+ article.id_vendeur + "'> " + article.identifiant + "</td><td><a id ='" + article.id_vendeur + "' class='contactUser btn-flat btn-small' href='#ex1' rel='modal:open'><i class='material-icons'>message</i></a></td><td><a class='btn-flat deleteArticle'>Supprimer</a></td></tr>")
                }

            }
        )
    })

    //UPDATE CATEGORIE
    $('body').on('click', '.updateCat', function () {
        ($('.catNameInput')).prop('disabled', true)
        let row = $(this).parents('tr')
        let idCategory = row.attr('id');
        let thisInput = row.find($('.catNameInput'))
        thisInput.prop('disabled', false)
        $('.updateCat').text('MODIFIER')
        $('.updateCat').removeClass('confirmUpdate')
        $(this).text('CONFIRMER')
        $(this).addClass('confirmUpdate')
        $('body').on('change', thisInput, function () {
            if (thisInput.val().length == 0) {
                thisInput.val(row.attr('value'))
            }
        })
    })
    //UPDATE CATEGORIE CONFIRMATION
    $('body').on('click', '.confirmUpdate', function () {
        let row = $(this).parents('tr')
        let idCategory = row.attr('id');
        let thisInput = row.find($('.catNameInput'))
        $.post(
            'API/apiAdmin', {action: 'updateCat', idCategory: idCategory, newName: thisInput.val()},
            function (data) {
                ($('.catNameInput')).prop('disabled', true)
                M.toast({html: 'Nom de la catégorie updatée !'})
                $('.updateCat').removeClass('confirmUpdate')
                $('.updateCat').text('MODIFIER')
                console.log(data);
            }
        )
    })


    //SUPPRIMER CATEGORIE
    $('body').on('click', '.deleteCat', function () {
        let row = $(this).parents('tr')
        let idCategory = row.attr('id');
        console.log('lol')
        $.post(
            'API/apiAdmin.php', {action: 'deleteCat', id: idCategory},
            function (data) {
                console.log(data);
                let message = JSON.parse(data);
                row.hide()
                M.toast({html: 'Catégorie supprimée !'})

            }
        )
    })

    //Button nouvelle catégorie
    $('body').one('click', '#addNewCat', function () {
        if ($('#newCatName').length == 0) {
            $(this).after("<input id='newCatName'>")
        }
        $('body').on('click', '#addNewCat', function () {
            if ($('#newCatName').val().length != 0) {
                $.post(
                    'API/apiAdmin.php', {action: 'addNewCat', name: $('#newCatName').val()},
                    function (data) {
                        console.log(data);
                        let cat = JSON.parse(data);
                        if (cat == "same") {
                            M.toast({html: 'Cette catégorie existe déjà'})
                        } else {
                            $('#newCatName').val('')
                            $('#categoriesVides').append("<tr value='" + cat.nom + "' id='" + cat.id + "'><td class='rowCategorie'>" + cat.nom + "</td><td><a class='btn-small btn-flat  deleteCat'>Supprimer</a></td></tr>")
                            M.toast({html: 'Catégorie créée!'})
                        }
                    }
                )
            } else {
                M.toast({html: 'Champ vide...'})
            }
        })
    })

    //SHOW UTILISATEURS
    $('body').on('click', '.showUsers', function () {
        let choice = $(this).attr('value');
        $('.showUsers').removeClass('activeTab')
        $(this).addClass('activeTab')
        $('#listeUsersTries tbody').empty()
        console.log(choice)
        $.post(
            'API/apiAdmin.php', {action: 'showUsers', choice: choice},
            function (data) {
                console.log(data);
                let users = JSON.parse(data);

                if (users === 'none') {
                    $('#listeUsersTries tbody').append("<tr><td>Rien</td></tr>")
                } else {
                    for (let user of users) {
                        if (user.status == 'vendeur') {
                            $('#listeUsersTries tbody').append("<tr value='" + user.identifiant + "' id='" + user.id + "'><td><a class='titleArticle' href='profilVendeur?id=" + user.id + "'>" + user.identifiant + "</a></td><td>" + user.status + "</td><td>" + user.nb_articles_vendus + "</td><td>" + user.date_inscription + "</td><td><a id ='" + user.id_vendeur + "' class='contactUser' href='#ex1' rel='modal:open'><i class='material-icons'>message</i></a></td><td><a href='mailto:" + user.mail + "' target='blank'><i class='material-icons'>mail</i></a></td></t><td><button class='btn-flat deleteUser'>Supprimer</button></td></tr>")
                        } else {
                            $('#listeUsersTries tbody').append("<tr value='" + user.identifiant + "' id='" + user.id + "'><td>" + user.identifiant + "</td><td>" + user.status + "</td><td> - </td><td>" + user.date_inscription + "</td><td><a id ='" + user.id_vendeur + "' class='contactUser' href='#ex1' rel='modal:open'><i class='material-icons'>message</i></a></td><td><a href='mailto:" + user.mail + "' target='blank'><i class='material-icons'>mail</i></a><td><button class='btn-flat deleteUser'>Supprimer</button></td></tr>")
                        }
                    }
                    $('#nbInscrits').text(users.length)
                }
            }
        )
    })

    //BOUTON SUPPRIMER user
    $('body').on('click', '.deleteUser', function () {
        let row = $(this).parents('tr')
        let idUser = row.attr('id')
        $(this).css('background', 'none')
        $(this).html('<a class="btn-flat btn-small" id="confirmSupprUser">Oui</a> <a class="btn-flat btn-small navAdmin">Non</a>')
        $('#infoAdmin').append("<p>Si l'utilisateur est un vendeur, ses articles en vente seront aussi supprimés. Procéder avec prudence.</p>")
    })

    $('body').on('click', '#confirmSupprUser', function () {
        $.post(
            'API/apiAdmin.php', {action: 'deleteUser', id: idUser},
            function (data) {
                let message = JSON.parse(data);
                row.hide()
                M.toast({html: 'Utilisateur.ice supprimé.e !'})
            },
        );
    });

    //BOUTON CONTACT user
    $('body').on('click', '.contactUser', function (event) {
        $('#nameDestinataire').empty()
        $('#newMessage textarea').val('')
        let row = $(this).parents('tr')
        let idDestinataire = row.attr('id')

        if ($(this).attr('id')) {
            idDestinataire = $(this).attr('id')
        }
        let loginDestinataire = row.attr('value')
        console.log(idDestinataire)
        $('#nameDestinataire').append('<p>' + loginDestinataire + '</p>')
        $('body').on('submit', '#newMessage', function (event) {
            console.log($('#newMessage input').val())
            event.preventDefault()
            $.post(
                'API/apiMessagerie.php', {
                    action: 'sendNewMessage',
                    idDestinataire: idDestinataire,
                    messageContent: $('#newMessage textarea').val()
                },
                function (data) {
                    let message = JSON.parse(data);
                    console.log(data);
                    $('#newMessage textarea').val('')
                    M.Toast.dismissAll();
                    M.toast({html: 'Message envoyé !'})
                }
            )
        })
    });


    //MODERATION
    $('body').on('click', '.showModeration', function () {
        let choice = $(this).attr('value');
        $('.showModeration').removeClass('activeTab')
        $(this).addClass('activeTab')
        $('#moderationTriees tbody').empty()
        console.log(choice)
        $.post(
            'API/apiAdmin.php', {
                action: 'showModeration',
                choice: choice
            },
            function (data) {
                console.log(data);
                let articles = JSON.parse(data);
                if (articles === 'none') {
                    $('#moderationTriees tbody').append("<tr><td>Rien</td></tr>")
                    $('#nbModeration').text('0')
                } else {
                    for (let article of articles) {
                        if (article.categorie_suggeree != null) {
                            console.log("cat")
                            $('#moderationTriees tbody').append("<tr id='" + article.article_id + "'><td>" + article.titre + "</td><td><img height='100' width='100' src='img/articles/" + article.photo + "'></td><td><a class='titleArticle' id='" + article.id_vendeur + "' href='profilVendeur?id=" + article.id_vendeur + "'>" + article.identifiant + "</a></td><td>" + article.date_ajout + "</td><td><input value='" + article.categorie_suggeree + "'></td><td>" + article.description + "</td><td><a class='btn-flat acceptArticleNewCat'>Accepter</a></td><td><a class='deleteArticle btn-flat'>Supprimer</a></td></tr>")
                        } else if (article.signal == 2 && article.categorie_suggeree == null && article.nom != null) {
                            console.log('signal')
                            $('#moderationTriees tbody').append("<tr id='" + article.article_id + "'><td>" + article.titre + "</td><td class='categorie' id='" + article.id_categorie + "'>" + article.nom + "</td><td><a class='titleArticle' href='profilVendeur?id=" + article.id_vendeur + "'>" + article.identifiant + "</a></td><td>" + article.date_ajout + "</td><td>" + article.description + "</td><td><a class='btn-flat acceptArticleSignal'>Accepter</a></td><td><a class='deleteArticle btn-flat '>Supprimer</a></td></tr>")
                        }
                    }
                    $('#nbModeration').text(articles.length)
                }
            })
    })


    /*SUPPRIMER UN ARTICLE*/
    $('body').on('click', '.deleteArticle', function () {
        let row = $(this).parents('tr')
        let thisButton = $(this)
        thisButton.css('background', 'none')
        let idArticle = row.attr('id')
        console.log(idArticle)
        $(this).html('<a class="btn-flat btn-small" id="confirmSupprArticle">Oui</a><a class="reloadPopUp btn-flat btn-small">Non.</a>')
        $('body').on('click', '#confirmSupprArticle', function () {
            $.post(
                'API/apiAdmin.php', {action: 'deleteArticle', id: idArticle},
                function (data) {
                    let message = JSON.parse(data);
                    row.hide()
                    M.toast({html: 'Article supprimé !'})
                },
            );
        });
    })

    $('body').on('click', '.reloadPopUp', function () {
        location.reload();
    })



    //ACCEPTER UN ARTICLE AVEC CREATION D'UNE NOUVELLE CATEGORIE
    $('body').on('click', '.acceptArticleNewCat', function () {
        let row = $(this).parents('tr')
        let idArticle = row.attr('id')
        let categoryName = row.find('input').val()
        let idVendeur = row.find('.titleArticle').attr('id')
        console.log(idArticle)
        console.log(idVendeur)
        console.log(categoryName)
        $('#infoAdmin').empty()
        $.post(
            'API/apiAdmin.php', {
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
                    M.toast({html: 'Article en ligne !'})
                    $('#infoAdmin').html("<p><a href='article?id=" + idArticle + "'>Voir la fiche produit</a></p>")
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
            'API/apiAdmin.php', {action: 'acceptArticleSignal', id: idArticle},
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


