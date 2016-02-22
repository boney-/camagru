function vote(id) {
    if (id.length == 0) {
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById(id).className = "like-vote";
            }
        };
        xmlhttp.open("GET", "vote.php?id="+id, true);
        xmlhttp.send();
    }
}
function send_comment(id) {
    var comment = "";
    if (id.length == 0) {
        return;
    } else {
        var xhttp = new XMLHttpRequest();
        //xhttp.onreadystatechange = function() {
        //    if (xhttp.readyState == 4 && xhttp.status == 200) {
        //        comment = document.getElementById("comment").value;
        //        document.getElementById("comment").innerHTML = "";
        //    }
        //};
        xhttp.open("POST", "comment.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("comment="+document.getElementById("comment").value+"&id="+id);
        //document.getElementById("allcomments").innerHTML = xhttp.responseText;
    }
}