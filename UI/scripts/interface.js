$(function() {
  $("#txtScanTarget").val("localhost");
	$("#resultsPage").hide();
	$("#btnScan").click(scan);
});

function scan(){
	$("#startPage").hide();
	var url = $("#txtURL").val();
	if(url == "localhost/wordpress" || url == ""){
		url = "http://localhost/wordpress"
	}
	runScan(url);
}

function runScan(url){
	console.log("Client: Running scan on url " + url);
	jQuery.ajax({
		type: "POST",
		url: "../SiteScan.php",
		dataType: "json",
		data: {"url" : url},
		success: function(obj){
			scanComplete(obj);
		}
	});
}

function scanComplete(obj){

	//console.log(obj.results);

	update_security_ssl(obj.results.resultsSecurity.resultsSSL.testPassed);
	update_security_sqlInjection(obj.results.resultsSecurity.resultsSQLInjection.testPassed);

	update_seo_heading(obj.results.resultsSEO.resultsHeading.testPassed);
	update_seo_metaDescription(obj.results.resultsSEO.resultsMetaDescription.testPassed);
	update_seo_pageTitle(obj.results.resultsSEO.resultsPageTitle.testPassed);

	$("#resultsPage").show();

}

function update_security_ssl(result){
	if(result === true){
		$("#pf_ssl").parent().addClass("pass");
		$("#pf_ssl").text("pass");
	}
	else if(result === false){
		$("#pf_ssl").parent().addClass("fail");
		$("#pf_ssl").text("fail");
	}
	else {
		$("#pf_ssl").addClass("na");
		$("#pf_ssl").text(result);
	}
}

function update_security_sqlInjection(result){

	if(result === true){
		$("#pf_sqlInjection").parent().addClass("pass");
		$("#pf_sqlInjection").text("pass");
	}
	else if(result === false){
		$("#pf_sqlInjection").parent().addClass("fail");
		$("#pf_sqlInjection").text("fail");
	}
	else {
		$("#pf_sqlInjection").parent().addClass("na");
		$("#pf_sqlInjection").text(result);
	}
}

// Update SEO sections
function update_seo_heading(result){
	if(result === true){
		$("#pf_heading").parent().addClass("pass");
		$("#pf_heading").text("pass");
	}
	else if(result === false){
		$("#pf_heading").parent().addClass("fail");
		$("#pf_heading").text("fail");
	}
	else {
		$("#pf_heading").parent().addClass("na");
		$("#pf_heading").text(result);
	}
}

function update_seo_metaDescription(result){
	if(result === true){
		$("#pf_metaDescription").parent().addClass("pass");
		$("#pf_metaDescription").text("pass");
	}
	else if(result === false){
		$("#pf_metaDescription").parent().addClass("fail");
		$("#pf_metaDescription").text("fail");
	}
	else {
		$("#pf_metaDescription").parent().addClass("na");
		$("#pf_metaDescription").text(result);
	}
}

function update_seo_pageTitle(result){
	if(result === true){
		$("#pf_pageTitle").parent().addClass("pass");
		$("#pf_pageTitle").text("pass");
	}
	else if(result === false){
		$("#pf_pageTitle").parent().addClass("fail");
		$("#pf_pageTitle").text("fail");
	}
	else {
		$("#pf_pageTitle").parent().addClass("na");
		$("#pf_pageTitle").text(result);
	}
}

// function template
function update_category_scan(result){
	if(result === true){
		$("#").parent().addClass("pass");
		$("#").text("pass");
	}
	else if(result === false){
		$("#").parent().addClass("fail");
		$("#").text("fail");
	}
	else {
		$("#").parent().addClass("na");
		$("#").text(result);
	}
}
