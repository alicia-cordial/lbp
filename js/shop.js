$(document).ready(function() {


    $('select').formSelect();


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


    $('body').on('keyup', '.article_search', function(e) {
        e.preventDefault()
        $('.result').empty();
        var article = $(this).val();
        // console.log(article);
        $.get(
            'API/apiAutocompletion.php', { term: article },
            function(data) {
                console.log(data)
                    // console.log(articles);
                if (data) {
                    let articles = JSON.parse(data);
                    for (let article of articles) {
                        $('.result').append('<li><a href="article?id=' + article.article_id + '">' + article.titre + ' <em>dans ' + article.nom + "</em></a></li>");
                    }
                }
            },
        );
    });




    //RECHERCHE VENDEUR
    $('#user').keyup(function() {
        $('#message').html('');
        var user = $(this).val();
        console.log(user);
        $.post(
            'API/apiSearch.php', { search: user },
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
    $('body').on('click', '.containerContactUser', function(event) {

        if ($(this).find('.contactUser').hasClass('disabled')) {
            M.toast({ html: 'Action impossible' })
        }
    })





    /**************MESSAGERIE**********/
    //BOUTON CONTACT user
    $('body').on('click', '.contactUser', function(event) {
        let idDestinataire = $('#idDestinataire').attr('value'); //id
        if (idDestinataire != $('#idExpediteur').attr('value')) {
            console.log(idDestinataire)
            let loginDestinataire = $('#nameDestinataire').attr('value'); //login
            console.log(loginDestinataire)
            $('body').on('submit', '#newMessage', function(event) {
                console.log($('#newMessage input').val())
                event.preventDefault()
                $.post(
                    'API/apiMessagerie.php', {
                        action: 'sendNewMessage',
                        idDestinataire: idDestinataire,
                        messageContent: $('#newMessage textarea').val()
                    },
                    function(data) {
                        let message = JSON.parse(data);
                        console.log(data);
                        $('#newMessage textarea').val('')
                        M.Toast.dismissAll();
                        M.toast({ html: 'Message envoyé !' })
                    }
                )
            })
        }

    });



})

$(document).ready(function() {

    filter_data();

    function filter_data() {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        var ram = get_filter('ram');
        var storage = get_filter('storage');
        $.ajax({
            url: "fetch_data.php",
            method: "POST",
            data: { action: action, minimum_price: minimum_price, maximum_price: maximum_price, brand: brand, ram: ram, storage: storage },
            success: function(data) {
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function() {
        filter_data();
    });

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
    });

});