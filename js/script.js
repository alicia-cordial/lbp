$(document).ready(function () {
    //MATERIALIZE
    $('.sidenav').sidenav();
    $('.dropdown-trigger').dropdown();
    $('select').formSelect();
    $('.collapsible').collapsible();

    //NOTIFICATIONS
    function load_unseen_notification(view = '') {
        $.ajax({
            url: "API/apiMessagerie.php",
            method: "POST",
            data: {view: view},
            dataType: "json",
            success: function (data) {
                console.log(data)
                if (data === 'none') {
                    $('#notification_dropdownContainer .collapsible-header').html('Rien de nouveau.')
                    $('#notification_dropdown').html("<p class='transition05 notificationIndividuelle'>...</p>")
                } else {
                    $('#notification_dropdownContainer .collapsible-header').html(data.length + " nouveaux messages !")
                    for (let notification of data) {
                        $('#notification_dropdown').append("<p class='transition05 notificationIndividuelle'>" + notification.identifiant + " : " + notification.shortContent + "</p>")
                    }
                }
            }
        });
    }

    load_unseen_notification();

    $(document).on('click', '#notification_dropdownContainer .collapsible-header', function (event) {
            event.stopPropagation();
            console.log("see")
            load_unseen_notification('yes');
    });

    $(document).on('click', '#notification_dropdown', function (event) {
        event.stopPropagation();
    });


    setInterval(function () {
        if ($('#notification_dropdown').is(':hidden')) {
            load_unseen_notification();
        }
    }, 5000);

})