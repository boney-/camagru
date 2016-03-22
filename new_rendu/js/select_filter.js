//retourne un tableau d'element dont la class correspond
var filters = document.getElementsByClassName("filter");

var selectFunction = function() {
    var id = this.getAttribute("id");
    var src = this.src;

	removeSelect(filters);
	document.getElementById(id).classList.add("selected");
    //alert(attribute);
    document.getElementById("select_filter").src = src;
};

function removeSelect(filters) {
		for (var i = 0; i < filters.length; i++) {
	    filters[i].classList.remove("selected");
	}
} 

for (var i = 0; i < filters.length; i++) {
    filters[i].addEventListener('click', selectFunction, false);
}

