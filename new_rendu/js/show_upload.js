var e = document.getElementById("show_upload");

if (e) {
	e.onclick = function() {
		var upload_div = document.getElementById("upload");
		//alert(upload_div);
		//if (upload_div)
    	 	document.getElementById("upload").innerHTML = '<form method="POST" action="" enctype="multipart/form-data"><input type="file" name="img"/><input type="submit" name="send" value="Envoyer"/></form>';
		//else*/

	}
}