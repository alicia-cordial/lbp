$(function() {

    $("#article").autocomplete({
        source: "../view/autocompletion.php"
    });


});

var url = window.location.href;
console.log(url);

if (url === 'http://localhost/lbp/index.php' || url === 'http://localhost/lbp/') {
    $('.bar_header').hide();
} else {
    $('.bar_header').show();
}


// (C) ATTACH AUTOCOMPLETE TO INPUT FIELDS
window.addEventListener("DOMContentLoaded", function() {
    ac.attach({
        target: "demoA",
        data: "../views/Database.php",
        post: { type: "name" }
    });

    ac.attach({
        target: "demoB",
        data: "2b-search.php",
        post: { type: "email" },
        // OPTIONAL
        delay: 1000,
        min: 3
    });
});