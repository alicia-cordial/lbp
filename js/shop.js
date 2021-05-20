$(document).ready(function() {
    $('#article_search').keyup(function() {
        $('#result').html('');
        var article = $(this).val();

        if (article != "") {

            $.ajax({
                type: 'GET',
                url: 'test.php',
                data: 'article=' + encodeURIComponent(article),
                success: function(data) {
                    console.log(data);
                    /*if (data != "") {
                        $('#result').append(data);
                    } else {
                        document.getElementById('result').innerHTML = "<div>Aucun article</div>"
                    }*/
                }

            });

        }
    });
});