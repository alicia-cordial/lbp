$(document).ready(function () {

    //UPDATE PROFIL
    $('body').on('click', '.navUser', function () {
        $('#sectionVendeur').empty();
        if ($(this).is('#navUpdateProfil')) {
            callSectionUser('updateProfile')
            $('body').on('change', 'input[name="status"]', function () {
                if (!$(this).hasClass('originalStatus')) {
                    $('#statusInfo').css('display', 'block')
                } else {
                    $('#statusInfo').css('display', 'none')
                }
            })

            //MESSAGERIE
        } else if ($(this).is('#navMessagerie')) {
            callSectionUser('messagerie')
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


//Formulaire modification profil
    $('body').on('submit', '#formUpdateUser', function (event) {
        $('#message').empty();
        event.preventDefault()
        $.post(
            'API/apiModule', {
                form: 'updateProfil',
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
                        $("#message").append("<p>Modification du profil réussie !</p>");
                    } else {
                        $('#message').append("<p>" + message + "</p>");
                    }
                }
            },
        );
    });


})


/*FUNCTIONS*/
function callSectionUser(page) {
    $.get('views/user/' + page + '.php',
        function (data) {
            $('#sectionVendeur').html(data);
        });
}




