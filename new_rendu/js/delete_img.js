function delete_img(id) {
    if (confirm("Are you sure you want to delete this image?")){
        if (id.length != 0) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("sidebar").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", "delete_img.php?id="+id, true);
            xhttp.send();
        }
        return;
    }
    else{
        return;
    }
}/**
 * Created by jbonnet on 3/29/16.
 */
