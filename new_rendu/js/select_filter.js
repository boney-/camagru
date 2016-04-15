/*
** Select Filter
*/

//retourne un tableau d'element dont la class correspond
var filters = document.getElementsByClassName("filter");

var selectFunction = function() {
    var applyBtn = document.getElementById("apply_filter");
    var id = this.getAttribute("id");
    var src = this.src;
    var selectedFilter = document.getElementById("select_filter");

	removeClass(filters, "selected");
	document.getElementById(id).classList.add("selected");
    selectedFilter.src = src;

    //update filter id
    document.getElementById("filterId").value = id;

    if (id == 0) {
    	selectedFilter.style.display = "none";
        applyBtn.style.display = "none";
    } else {
    	selectedFilter.style.display = "";
        if (applyBtn){
            applyBtn.style.display = "block"; 
        }
    }
};

function removeClass(tab, classToRemove) {
		for (var i = 0; i < tab.length; i++) {
	    tab[i].classList.remove(classToRemove);
	}
}

function setEventListenerOnClass(tab, triggerEvent, functionToUse) {
    for (var i = 0; i < tab.length; i++) {
        tab[i].addEventListener(triggerEvent, functionToUse, false);
    }
}



/*
** Filter position
*/

var keypressCapture = function() {

	window.addEventListener("keydown", checkKeyPressed, false);
}

var checkKeyPressed = function(e) {
	
	var x = document.getElementById('filter_x_coord');
	var y = document.getElementById('filter_y_coord');
	var size = document.getElementById('filterSize');
	var filter = document.getElementById('select_filter');

    if (e.keyCode == "38") {
        console.log("The 'up' key is pressed.");
        y.value--;
        filter.style.top = y.value+"%";
    }
	
	if (e.keyCode == "40") {
        console.log("The 'down' key is pressed.");
        y.value++;
        filter.style.top = y.value+"%";
    }
	
	if (e.keyCode == "37") {
        console.log("The 'left' key is pressed.");
        x.value--;
        filter.style.left = x.value+"%";
    }
	
	if (e.keyCode == "39") {
        console.log("The 'right' key is pressed.");
        x.value++;
        filter.style.left = x.value+"%";
    }

    if (e.keyCode == "107") {
        console.log("The '+' key is pressed.");
        size.value++;
        filter.style.width = size.value+"%";
    }

    if (e.keyCode == "109") {
        console.log("The '-' key is pressed.");
        size.value--;
        filter.style.width = size.value+"%";
    }
}

/*
** Select Capture Mode
*/

//retourne un tableau d'element dont la class correspond
var triggers = document.getElementsByClassName("trigger");

var CaptureSelect = function() {
    var SelectedModeId = this.getAttribute("id");
    removeClass(triggers, "selected_capture");
    document.getElementById(SelectedModeId).classList.add("selected_capture");

    if(SelectedModeId == 'up_trigger'){
        document.getElementById("preview").innerHTML = '<form method="POST" action="" enctype="multipart/form-data"><input type="file" name="img"/><input type="submit" name="send" value="Envoyer"/></form>';
    } else {
        window.location = "capture.php";
    }
};

setEventListenerOnClass(filters, 'click', selectFunction);
keypressCapture();
setEventListenerOnClass(triggers, 'click', CaptureSelect);
