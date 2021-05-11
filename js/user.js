/*Toggle inscription / connexion */
function changeForm() {
    var button = event.target
    var idButton = button.id
    var httpRequest = new XMLHttpRequest()
    httpRequest.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var main = document.getElementById('mainCompte')
                main.innerHTML = this.responseText;
        }
    }
    if(idButton === "buttonInscription") {
        httpRequest.open('GET', "views/user/inscription.php", true)
    } else {
        httpRequest.open('GET', "views/user/connexion.php", true)
    }
    httpRequest.send()
}