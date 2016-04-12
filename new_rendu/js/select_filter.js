
//retourne un tableau d'element dont la class correspond
var filters = document.getElementsByClassName("filter");

var selectFunction = function() {
    var applyBtn = document.getElementById("apply_filter");
    var id = this.getAttribute("id");
    var src = this.src;
    var selectedFilter = document.getElementById("select_filter");

	removeSelect(filters);
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

function removeSelect(filters) {
		for (var i = 0; i < filters.length; i++) {
	    filters[i].classList.remove("selected");
	}
}

for (var i = 0; i < filters.length; i++) {
    filters[i].addEventListener('click', selectFunction, false);
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

keypressCapture();
