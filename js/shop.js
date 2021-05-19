$(document).ready(function() {
    $('#article_search').keyup(function() {
        $('#result').html('');
        var article = $(this).val();

        if (article != "") {

            $.ajax({
                type: 'GET',
                url: 'views/shop/resultatArticles.php',
                data: 'article=' + encodeURIComponent(article),
                success: function(data) {

                    if (data != "") {
                        $('#result').append(data);
                    } else {
                        document.getElementById('result').innerHTML = "<div>Aucun article</div>"
                    }
                }

            });

        }
    });
});