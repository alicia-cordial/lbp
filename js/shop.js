window.addEventListener("DOMContentLoaded", (function() {

    window.addEventListener("#article").autocomplete({
        source: "../view/autocompletion.php"
    });


}));
/*
var url = window.location.href;
console.log(url);

if (url === 'http://localhost/lbp/home.php' || url === 'http://localhost/lbp/') {
    window.addEventListener('.bar_header').hide();
} else {
    window.addEventListener('.bar_header').show();
}*/