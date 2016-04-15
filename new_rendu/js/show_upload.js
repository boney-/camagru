
var k = document.getElementById('yes_keep');
var n = document.getElementById('no_keep');

if (k) {
	k.onclick = function() {
	edit_div = document.getElementById("edit_div");
	edit_div.innerHTML = '<form id="editform" action="add_photo.php" method="post"><input class="form_element" type="text" name="title" placeholder="Titre ..."/><textarea class="form_element" name="comment" form="editform" placeholder="Commentaire..."></textarea><button type="submit" id="save_photo">Enregistrer</button></form>';
	}
}

if (n) {
	n.onclick = function() {
	 	window.location.replace("capture.php");
	}
}