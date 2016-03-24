var e = document.getElementById("show_upload");

if (e) {
	e.onclick = function() {
    	 document.getElementById("upload").innerHTML = '<form method="POST" action="" enctype="multipart/form-data"><input type="file" name="img"/><input type="submit" name="send" value="Envoyer"/></form>';
	}
}