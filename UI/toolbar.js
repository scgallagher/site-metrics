var toggleCloseClass = "fa fa-chevron-left fa-stack-1x fa-inverse";
var toggleOpenClass = "fa fa-chevron-right fa-stack-1x fa-inverse";

function $$(id) {
	return document.getElementById(id);
}

$(function() {
	insertHTML();
	$("#toggle_button").click(toggleButtonHandler);
	$("#scan_button").click(scanButtonHandler);

	$("#message").text("Would you like to run a scan?");
});

function insertHTML(){
	// var html;
	// html += "<div id=\"sitescan_toolbar\">";
	// html += "<button id=\"toggle_button\" class=\"toolbarButton\">";
	// html += "<span class=\"fa-stack\">";
	// html += "<i id=\"toggleIconBkgrnd\" class=\"fa fa-circle fa-stack-2x\"></i>";
	// html += "<i id=\"toggleIcon\" class=\"fa fa-chevron-left fa-stack-1x\"></i>";
	// html += "</span>";
	// html += "</button>";
	// html += "<div id=\"content\">";
	// html += "<span id=\"message\"></span>";
	// html += "<input id=\"scanTarget_input\" type=\"text\" placeholder=\"website to be scanned . .\">";
	// html += "<button id=\"scan_button\" class=\"toolbarButton\">Scan</button>";
	// html += "</div>";
	// html += "</div>";

	$("body").before("<div id=\"sitescan_toolbar\"></div>");
	$("#sitescan_toolbar").load("/wp-content/plugins/site-metrics/UI/toolbar.html");

}

// Handlers ***************

function toggleButtonHandler() {
	if(window.getComputedStyle($$("content")).getPropertyValue('display') == "none") {
		$$("content").style.display = "inline";
		$$("toggleIcon").className = toggleCloseClass;
	}
	else {
		slideContentClosed();
	}
}

function scanButtonHandler() {
	$("#toggle_button").attr("disabled", true);

	$("#message").text("Scanning . . .");
	$("#scanTarget_input").hide();
	$("#scan_button").hide();

	//run scan
	console.log("run scan");
}

//

function lockToggleButton() {

}

function slideContentClosed() {
	/*console.log("sliding closed");
  var content = $("content");
  var width = window.getComputedStyle($("content")).getPropertyValue('width');
	console.log("initial width = " + width);
  var id = setInterval(frame, 5);
  function frame() {
    if (width == 0) {
      clearInterval(id);
		$("content").style.display = "none";
		$("toggleIcon").className = toggleOpenClass;
    } else {
      width--;
      content.style.width = width + 'px';
    }
  }*/
	$$("content").style.display = "none";
	$$("toggleIcon").className = toggleOpenClass;
}

//window.addEventListener("load", start, false);
