/*$(function() {
    $("#article_search").autocomplete({
        source: 'controllers/shop/ResultatArticles.php',
    });
});*/


$(document).ready(function() {
    $('#article_search').keyup(function() {
        $('#result').html('');
        var article = $(this).val();
        console.log(article);
        // if (article != "") {
        $.get(
            'API/apiAutocompletion.php', {
                term: article,

            },
            function(data) {
                console.log(data)
                let articles = JSON.parse(data);
                console.log(articles);
                //if (data != "") {
                for (let article of articles) {
                    $('#result').append('<a href="article?article=' + article.id + '">' + article.titre + '</a>');
                }

                // } else {
                //   document.getElementById('result').innerHTML = "<div>Aucun article</div>"
                //}
            },
        );
        /*$.ajax({
            type: 'GET',
            url: 'test.php',
            data: { term: +'ok' },
            success: function(data) {
                console.log(data);
                if (data != "") {
                    $('#result').append(data);
                } else {
                    document.getElementById('result').innerHTML = "<div>Aucun article</div>"
                }
            }

        });*/

        //}
    });
});