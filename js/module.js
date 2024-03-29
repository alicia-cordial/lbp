$(document).ready(function() {

    //TOGGLE inscription / connexion
    $('body').on('click', '.callForm', function() {
        if ($(this).is('#callFormInscription')) {
            callform('inscription')
        } else {
            callform('connexion')
        }
    });

    /*INSCRIPTION*/
    //Display inscription blocks
    $('body').on('click', 'input[name=status]', function() {
        $('#bloc2').css('display', 'block')
    });
    $('body').on('change', '#password2', function() {
        $('#bloc3').css('display', 'block')
    });

    //Submit inscription
    $('body').on('submit', '#formInscription', function(event) {
        $('#message').empty();
        event.preventDefault()
        $.post(
            'API/apiModule.php', {
                form: 'inscription',
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
                        $('#formInscription button').fadeOut("fast", function() {
                            M.toast({html: 'Inscription réussie !', displayLength: 1000, completeCallback: function(){location.reload()}})
                        })
                    } else {
                        $('#message').append("<p>" + message + "</p>");
                    }
                }
            },
        );
    });

    /*CONNEXION*/
    //Display 2d block
    $('body').on('click', '#login', function() {
        $('#bloc2').css('display', 'block')
    });

    //Submit connexion
    $('body').on('submit', '#formConnexion', function(event) {
        $('#message').empty();
        event.preventDefault()
        $.post(
            'API/apiModule.php', {
                form: 'connexion',
                login: $('#login').val(),
                password: $('#password').val(),
            },
            function(data) {
                console.log(data);
                let messages = JSON.parse(data);
                for (let message of messages) {
                    if (message === "success") {
                        $('#formConnexion button').fadeOut("fast", function() {
                            $("#message").append("<p><a class='goldText' href='compte'>Voir votre profil</a>");
                            M.toast({html: 'Connexion réussie !', displayLength: 1000, completeCallback: function(){location.reload()}})
                        })
                    } else {
                        $('#message').append("<p>" + message + "</p>");
                    }
                }
            },
        );
    });

/*DECONNEXION*/
    $('body').on('click', '.logoutButton', function(event) {
        event.preventDefault()
        console.log("logout");
        $.post(
            'API/apiModule.php', {
                action: 'deconnexion',
            },
            function(data) {
                console.log(data);
                M.toast({html: 'Déconnexion réussie !', displayLength: 1000, completeCallback: function(){location.reload()}})
            },
        );
    });

    function callform(page) {
        $.get('views/user/' + page + '.php',
            function(data) {
                $('#mainCompte').html(data);
            });
    };
})