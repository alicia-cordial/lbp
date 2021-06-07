HTML

//MODAL
<div id="ex1" class="modal">
    <div id="nameDestinataire"></div>
    <form id='newMessage'>
        <input placeholder='votre message' required>
        <button type='submit'>Envoyer</button>
    </form>
    <div id="infoMessage"></div>
    <a href="#" rel="modal:close">Close</a>
</div>




//BOUTON DECLENCHEUR
<a id ='" + user.id_vendeur + "' class='contactUser' href='#ex1' rel='modal:open'>Contacter le vendeur</a>


//JS

$('body').on('click', '.contactUser', function (event) {
$('#nameDestinataire').empty()
let idDestinataire = //id
let loginDestinataire = //login
$('#nameDestinataire').append('<p>'+loginDestinataire+'</p>')
$('body').on('submit', '#newMessage', function (event) {

console.log($('#newMessage input').val())
event.preventDefault()
$.post(
'API/apiMessagerie', {
action: 'sendNewMessage',
idDestinataire: idDestinataire,
messageContent: $('#newMessage input').val()
},
function (data) {
let message = JSON.parse(data);
console.log(data);
$('#infoMessage').append("<p>Message envoyé !</p>")
}
)
})
});