function vote(id) {
    if (id.length == 0) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("vote_scr").className = "has_voted float_right";
            }
        };
        xmlhttp.open("GET", "vote.php?id"+id, true);
        xmlhttp.send();
    }
}
function send_comment(id) {
    if (id.length == 0 || document.getElementById("comment").value == '') {
        return;
    } else {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("allcomments").innerHTML = xhttp.responseText;
            }
        }
        xhttp.open("POST", "comment.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("comment="+document.getElementById("comment").value+"&id="+id);

    }
    document.getElementById("comment").value = '';
}