$(function() {

    $("#article").autocomplete({
        source: "charge_bdd.php"
    });


});

var url = window.location.href;
console.log(url);

if (url === 'http://localhost/lbp/index.php' || url === 'http://localhost/lbp/') {
    $('.bar_header').hide();
} else {
    $('.bar_header').show();
}