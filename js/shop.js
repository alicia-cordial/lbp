$(function() {

    $("#article").autocomplete({
        source: "home.php"
    });

});


$(function() {

    $("#article_header").autocomplete({
        source: "home.php"
    });

});


var url = window.location.href;
console.log(url);

if (url === 'http://localhost/lbp/home.php' || url === 'http://localhost/lbp/') {
    $('.bar_header').hide();
} else {
    $('.bar_header').show();
}