$(document).ready(function () {

    //
    $('body').on('click', '.navAdmin', function () {
        $('#sectionAdmin').empty();

        if ($(this).is('#navAdminarticles')) {
            callSectionAdmin('adminarticles')
        } else if ($(this).is('#navAdminMessagerie')) {
            callSectionAdmin('adminMessagerie')
        } else if ($(this).is('#navAdminModeration')) {
            callSectionAdmin('adminModeration')
        } else if ($(this).is('#navAdminCategorie')) {
            callSectionAdmin('adminShop')
        }
    })


    $('body').on('click', '.showarticles', function () {
        let choice = $(this).attr('value');
        $('#listearticlesTries').empty()
        console.log(choice)
        $.post(
            'API/apiAdmin', {
                action: 'showarticles',
                choice: choice
            },
            function (data) {
                // console.log(data);
                let articles = JSON.parse(data);
                if (articles === 'none') {
                    $('#listearticlesTries').append("<p>Rien</p>")
                } else {
                    for (let article of articles) {
                        if (article.status == 'vendeur') {
                            $('#listearticlesTries').append("<tr value='" + article.identifiant + "' id='" + article.id + "'><td><a href='profilVendeur?id=" + article.id + "'>" + article.identifiant + "</a></td><td>" + article.status + "</td><td>Inscription : " + article.date_inscription + "</td><td><button class='contactarticle'>Contacter</button></td><td><button class='deletearticle'>Supprimer</button></td></tr>")
                        } else {
                            $('#listearticlesTries').append("<tr value='" + article.identifiant + "' id='" + article.id + "'><td>" + article.identifiant + "</td><td>" + article.status + "</td><td>Inscription : " + article.date_inscription + "</td><td><button class='contactarticle'>Contacter</button></td><td><button class='deletearticle'>Supprimer</button></td></tr>")
                        }
                    }
                }
            }
        )
    })

    //BOUTON SUPPRIMER article
    $('body').on('click', '.deletearticle', function () {
        let row = $(this).parents('tr')
        let idarticle = row.attr('id')
        $('#infoAdmin').empty()
        $(this).html('<button id="confirmSupprarticle">Êtes-vous sûr.e ? </button><button class="navAdmin">Non.</button>')
        $('#infoAdmin').append("<p>Si l'utilisateur est un vendeur, ses articles en vente seront aussi supprimés. Procéder avec prudence.</p>")
        $('body').on('click', '#confirmSupprarticle', function () {
            $.post(
                'API/apiAdmin', {action: 'deletearticle', id: idarticle},
                function (data) {
                    let message = JSON.parse(data);
                    row.hide()
                    $('#infoAdmin').html('<p>Utilisateur.ice supprimé.e.</p>')
                },
            );
        });
    })

    //BOUTON CONTACT article
    $('body').on('click', '.contactarticle', function (event) {
        $('#newMessage').remove()
        let row = $(this).parents('tr')
        let idDestinataire = row.attr('id')
        let loginDestinataire = row.attr('value')
        let form = "<form id='newMessage'><input placeholder='votre message' required><button type='submit'>Envoyer</button></form>"
        event.preventDefault()
        row.after(form)

        $('body').on('submit', '#newMessage', function (event) {
            event.preventDefault()
            $.post(
                'API/apiMessagerie', {
                    action: 'sendNewMessage',
                    idDestinataire: idDestinataire,
                    messageContent: $('#newMessage input').val()
                },
                function (data) {
                    let message = JSON.parse(data);
                    $('#newMessage').remove()
                    console.log(data);
                    $('#infoAdmin').append("<p>Message envoyé !</p>")
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
                // console.log(data);
                let articles = JSON.parse(data);
                if (articles === 'none') {
                    $('#moderationTriees').append("<p>Rien</p>")
                } else {
                    for (let articles of article) {
                        if (article.signal != 0 || article.signal != 'NULL' || article.signal.lenght != 0) {
                            $('#moderationTriees').append("<tr value='" + article.titre + "' id='" + article.id + "'><td><a href='profilVendeur?id=" + id_vendeur + "'>" + article.identifiant + "</a></td><td>" + article.status + "</td><td>Date création : " + article.date_ajout + "</td><td><button class='contactUser'>Contacter</button></td><td><button class='updateArticle'>Modifier</button><td><button class='deleteArticle'>Supprimer</button></td></tr>")
                        }
                    }
                }
            }
        )
    })
})

/*FUNCTIONS*/
function callSectionAdmin(page) {
    $.get('views/admin/' + page + '.php',
        function (data) {
            $('#sectionAdmin').html(data);
        });
}
