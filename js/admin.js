$(document).ready(function () {

    //
    $('body').on('click', '.navAdmin', function () {
        $('#sectionAdmin').empty();

        if ($(this).is('#navAdminUsers')) {
            callSectionAdmin('adminUsers')
        } else if ($(this).is('#navAdminMessagerie')) {
            callSectionAdmin('adminMessagerie')
        } else if ($(this).is('#navAdminModeration')) {
            callSectionAdmin('adminModeration')
        } else if ($(this).is('#navAdminCategorie')) {
            callSectionAdmin('adminShop')
        }
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
                // console.log(data);
                let users = JSON.parse(data);
                if (users === 'none') {
                    $('#listeUsersTries').append("<p>Rien</p>")
                } else {
                    for (let user of users) {
                        if (user.status == 'vendeur') {
                            $('#listeUsersTries').append("<tr id='" + user.id + "'><td><a href='profilVendeur?id=" + user.id + "'>" + user.identifiant + "</a></td><td>" + user.status + "</td><td>Inscription : " + user.date_inscription + "</td><td><button class='contactUser'>Contacter</button></td><td><button class='deleteUser'>Supprimer</button></td></tr>")
                        } else {
                            $('#listeUsersTries').append("<tr id='" + user.id + "'><td>" + user.identifiant + "</td><td>" + user.status + "</td><td>Inscription : " + user.date_inscription + "</td><td><button class='contactUser'>Contacter</button></td><td><button class='deleteUser'>Supprimer</button></td></tr>")
                        }
                    }
                }
            }
        )
    })


    $('body').on('click', '.deleteUser', function () {
        let row = $(this).parents('tr')
        let idUser = row.attr('id')
        $('#infoUser').empty()
        $(this).html('<button id="confirmSupprUser">Êtes-vous sûr.e ? </button><button class="navAdmin">Non.</button>')
        $('#infoUser').append("<p>Si l'utilisateur est un vendeur, ses articles en vente seront aussi supprimés. Procéder avec prudence.</p>")
        $('body').on('click', '#confirmSupprUser', function () {
            $.post(
                'API/apiAdmin', {action: 'deleteUser', id: idUser},
                function (data) {
                    let message = JSON.parse(data);
                    row.hide()
                    $('#infoUser').append('<p>Utilisateur.ice supprimé.e.</p>')
                },
            );
        });
    })
})

/*FUNCTIONS*/
function callSectionAdmin(page) {
    $.get('views/admin/' + page + '.php',
        function (data) {
            $('#sectionAdmin').html(data);
        });
}
