//retourne un tableau d'element dont la class correspond
var filters = document.getElementsByClassName("filter");

var selectFunction = function() {
    var id = this.getAttribute("id");
    var src = this.src;

	removeSelect(filters);
	document.getElementById(id).classList.add("selected");
    document.getElementById("select_filter").src = src;


    //update filter id
    document.getElementById("filterId").value = id;
};

function removeSelect(filters) {
		for (var i = 0; i < filters.length; i++) {
	    filters[i].classList.remove("selected");
	}
}

for (var i = 0; i < filters.length; i++) {
    filters[i].addEventListener('click', selectFunction, false);
}

//Filters position

var updateFilterCoord = function() {
	var x = document.getElementById('filter_x_coord');
	var y = document.getElementById('filter_y_coord');
	var filter = document.getElementById('select_filter');

	filter.style.left = x.value+"%";
	filter.style.top = y.value+"%";
}

var positionFilter = function() {
	var coord = document.getElementsByClassName("coord");
	if (coord.length) {
		for (var i = 0; i < coord.length; i++) {
    		coord[i].addEventListener('change', updateFilterCoord, false);
    	}
	}
}

/* WIP */
/*
// update selected filter apply function parameters

var updateApplyInfo = function() {
	var filterId = document.getElementById('');
	var x = document.getElementById('filter_x_coord');
	var y = document.getElementById('filter_y_coord');



}

var applyFilter = function(filterId) {
	var applyBtn = document.getElementById("apply_filter");
	var coord = document.getElementsByClassName("coord");

	if (coord.length){
		applyBtn = document.getElementById("apply_filter");
		applyBtn.getAttribute("onclick").value = "toto";
		alert(applyBtn.value);
	}

    applyBtn.getAttribute("onlcick").value = "img_merge($ext, "+filterId+", 0, 0)";

}
*/
positionFilter();