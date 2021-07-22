$(document).ready(function() {

    $('body').on('click', '.navUser', function() {
        $('.navUser').removeClass('activeTab');
        $(this).addClass('activeTab');

        $('#sectionVendeur').empty();

        //UPDATE PROFIL
        if ($(this).is('#navUpdateProfil')) {
            callSectionUser('updateProfile')
            $('body').on('change', 'input[name="status"]', function() {
                if (!$(this).hasClass('originalStatus')) {
                    $('#statusInfo').css('display', 'block')
                } else {
                    $('#statusInfo').css('display', 'none')
                }
            })

            //ARTICLES ACHETES
        } else if ($(this).is('#navBoughtArticle')) {
            callSectionUser('clientArticlesAchetes')
            $.post(
                'API/apiClient.php', { action: 'selectArticlesAchetes' },
                function(data) {
                    let articles = JSON.parse(data);
                    console.log(data);
                    if (articles == 'none') {
                        $("#articlesAchetes tbody").append("<tr><td>Il n'y a rien ici.</td></tr><tr><td>Que diriez-vous de <a class='goldHover' href='home'>chiner de nouveaux objets de valeur ?</a></td></tr>");
                    } else {
                        for (let article of articles) {
                            $('#articlesAchetes tbody').append("<tr><td id = '" + article.id_article + "'>" + article.titre + "</td><td><img height='100' width='100' src='img/articles/" + article.photo + "'></td><td><a class='goldHover' href='profilVendeur?id=" + article.id_vendeur + "'> @" + article.identifiant + "</a></td><td>" + article.date_vente + "</td><td><button value=" + article.id_vendeur + " id=" + article.id_article + " class='noterVendeur btn-flat btn-small' ><a href='#ex2' rel='modal:open'>Noter</a></button></td><td><button class='supprimerArticle  btn-flat  btn-small' >Supprimer</button></td></tr>");
                        }
                    }
                }
            );

            //MESSAGERIE
        } else if ($(this).is('#navMessagerie')) {
            callSectionUser('messagerie')
            $.post(
                'API/apiMessagerie.php', { action: 'selectContacts' },
                function(data) {
                    let contacts = JSON.parse(data);
                    let contactList = $('#contacts')
                    console.log(data);
                    if (contacts == 'none') {
                        contactList.append("Aucune conversation");
                    } else {
                        $.each(contacts, function(key, value) {
                            contactList.append("<p class='individualConversation' id='" + value.id + "'><a href='profilVendeur?id=" + value.id + "'><span  class='initialIdentifiant'>" + value.initial + "</span></a> " + value.identifiant + "</p>")
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
        }
    })

    //MESSAGERIE CONVERSATION INDIVIDUELLE
    $('body').on('click', '.individualConversation', function(event) {
        let idDestinataire = $(this).attr('id')
        $('.individualConversation').removeClass('activeTab')
        $(this).addClass('activeTab')
            // console.log(idDestinataire)
        let conversation = $('#conversation')
        conversation.empty()
        if ($(this).is('.supprimé')) {
            $('#formNewMessage').css('display', 'none')
        } else {
            $('#formNewMessage').css('display', 'block')
        }
        $('#formNewMessage').attr('value', idDestinataire)
        $.post(
            'API/apiMessagerie.php', { action: 'showConversation', idDestinataire: idDestinataire },
            function(data) {

                let messages = JSON.parse(data);
                console.log(messages);
                let dates = []
                for (let message of messages) {

                    if (!dates.includes(message.shortday)) {
                        conversation.append("<p id='" + message.shortday + "' class='dateMessage'>" + message.day + "</p>")
                        dates.push(message.shortday)
                    }

                    conversation.append("<p class='pIndividualMessage' id='message" + message.id + "'><span class='individualMessage'>" + message.contenu + "</span><span>" + message.time + "</span></p>")
                    if (message.id_expediteur == idDestinataire) {
                        $('#message' + message.id).addClass('messageDestinataire')
                    } else {
                        $('#message' + message.id).addClass('messageUtilisateur')
                    }
                }
            })
    })

    //NEW MESSAGE IN CONVERSATION
    $('body').on('submit', '#formNewMessage', function(event) {
        let idDestinataire = $(this).attr('value')
        event.preventDefault()
        let conversation = $('#conversation')
        console.log(idDestinataire)
        console.log($('#newMessage').val())
        $.post(
            'API/apiMessagerie.php', {
                action: 'sendNewMessage',
                idDestinataire: idDestinataire,
                messageContent: $('#newMessage').val()
            },
            function(data) {
                let message = JSON.parse(data);
                $('#newMessage').val('')
                console.log(data);
                if ($('#' + message.shortday).length === 0) {
                    conversation.append("<p id='" + message.shortday + "' class='dateMessage'>" + message.day + "</p>")
                }
                conversation.append("<p class='pIndividualMessage messageUtilisateur' id='message" + message.id + "'><span class='individualMessage'>" + message.contenu + "</span><span>" + message.time + "</span></p>")
            }
        )
    })


    var x = window.matchMedia("(max-width: 640px)")
    mediaQueryContact(x) // Call listener function at run time
    x.addListener(mediaQueryContact)
    $('body').on('click', '#menuContacts', function() {
        $('#contacts').toggle()
    })


    //Formulaire modification profil
    $('body').on('submit', '#formUpdateUser', function(event) {
        $('#message').empty();
        event.preventDefault()
        $.post(
            'API/apiModule.php', {
                form: 'updateProfil',
                status: $("input[name='status']:checked").val(),
                login: $('#login').val(),
                password: $('#password').val(),
                password2: $('#password2').val(),
                email: $('#email').val(),
                zip: $('#zip').val()
            },
            function(data) {
                console.log(data);
                let messages = JSON.parse(data);
                for (let message of messages) {
                    if (message === "success") {
                        M.toast({ html: 'Modification du profil réussie !' })
                        setTimeout(
                            function() {
                                $("#mainCompte").load(location.href + " #mainCompte")
                            }, 1000);
                    } else {
                        $('#message').append("<p>" + message + "</p>");
                    }
                }
            },
        );
    });


    //BOUTON NOTER VENDEUR
    $('body').on('click', '.noterVendeur', function(event) {

        //ouverture d'une modale avec des étoiles ? Un commentaire ?
        //Il faudrait faire en sorte qu'une fois que la note a été donnée, on ne puisse plus
        // recliquer.
        let idArticle = $(this).attr('id')
        let idVendeur = $(this).attr('value')
        console.log(idArticle)
        console.log(idVendeur)
        $('body').on('submit', '#formNotation', function(event) {
            // console.log($('#formRadio input').val())
            event.preventDefault()
            $.post(
                'API/apiAutocompletion.php', {
                    action: 'addReview',
                    note: $("input[name='note']:checked").val(),
                    idArticle: idArticle,
                    idVendeur: idVendeur

                },
                function(data) {
                    let notes = JSON.parse(data);
                    console.log(data);
                    //$('.note').val('')
                    M.Toast.dismissAll();
                    M.toast({ html: 'Note envoyée !' })
                }
            )
        })


    })


})


/*FUNCTION*/
function callSectionUser(page) {
    $.get('views/user/' + page + '.php',
        function(data) {
            $('#sectionVendeur').html(data);
        });
}


function mediaQueryContact(x) {
    if (x.matches) { // If media query matches
        $('#contacts').hide()
    } else {
        $('#contacts').show()
    }
}