$(function() {
  $("#txtScanTarget").val("localhost");
	$("#resultsPage").hide();
	$("#btnScan").click(scan);
});

function scan(){
	$("#startPage").hide();
	var url = getURL();
	runScan(url);
}

function getURL(){
  var url = $("#txtURL").val();
  if(url == ""){
    url = "http://localhost/wordpress";
  }
  else if(url.match(/^(http:\/\/|https:\/\/)/) == null){
    url = "http://" + url;
  }
  return url;
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

	update_security_ssl(obj.results.resultsSecurity.resultsSSL);
	update_security_sqlInjection(obj.results.resultsSecurity.resultsSQLInjection);

	update_seo_heading(obj.results.resultsSEO.resultsHeading);
	update_seo_metaDescription(obj.results.resultsSEO.resultsMetaDescription);
	update_seo_pageTitle(obj.results.resultsSEO.resultsPageTitle);

  update_mobile_responsiveness(obj.results.resultsMobile.resultsResponsiveness.testPassed);
  update_mobile_viewportOptimization(obj.results.resultsMobile.resultsViewportOptimization.testPassed);

	$("#resultsPage").show();

}

function update_security_ssl(result){
  var passed = result.testPassed;
  console.log("SECURITY - SSL");
  console.log("  Has Cert:\t\t" + result.hasCert);
  console.log("  Cert Expired:\t\t" + result.certExpired);
	if(passed === true){
		$("#pf_ssl").parent().addClass("pass");
		$("#pf_ssl").text("pass");
	}
	else if(passed === false){
		$("#pf_ssl").parent().addClass("fail");
		$("#pf_ssl").text("fail");
	}
	else {
		$("#pf_ssl").addClass("na");
		$("#pf_ssl").text(passed);
	}
}

function update_security_sqlInjection(result){
  var passed = result.testPassed;
  console.log("SECURITY - SQL INJECTION");
  console.log("  Prepared Statements:\t\t" + result.preparedStatements);
  console.log("  Non-Prepared Statements:\t" + result.nonPreparedStatements);
	if(passed === true){
		$("#pf_sqlInjection").parent().addClass("pass");
		$("#pf_sqlInjection").text("pass");
	}
	else if(passed === false){
		$("#pf_sqlInjection").parent().addClass("fail");
		$("#pf_sqlInjection").text("fail");
	}
	else {
		$("#pf_sqlInjection").parent().addClass("na");
		$("#pf_sqlInjection").text(passed);
	}
}

// Update SEO sections
function update_seo_heading(result){
  var passed = result.testPassed;
  console.log("SEO - HEADING");
  console.log("  Has H1:\t\t" + result.hasH1);
  console.log("  H1 Count:\t" +result.h1Count);
  console.log("  H2 Count:\t" +result.h2Count);
  console.log("  H3 Count:\t" +result.h3Count);
	if(passed === true){
		$("#pf_heading").parent().addClass("pass");
		$("#pf_heading").text("pass");
	}
	else if(passed === false){
		$("#pf_heading").parent().addClass("fail");
		$("#pf_heading").text("fail");
	}
	else {
		$("#pf_heading").parent().addClass("na");
		$("#pf_heading").text(passed);
	}
}

function update_seo_metaDescription(result){
  var passed = result.testPassed;
  console.log("SEO - META DESCRIPTION");
  console.log("  Has Meta:\t" + result.hasMetaDescription);
  console.log("  Char Count:\t" + result.charCount);
	if(passed === true){
		$("#pf_metaDescription").parent().addClass("pass");
		$("#pf_metaDescription").text("pass");
	}
	else if(passed === false){
		$("#pf_metaDescription").parent().addClass("fail");
		$("#pf_metaDescription").text("fail");
	}
	else {
		$("#pf_metaDescription").parent().addClass("na");
		$("#pf_metaDescription").text(passed);
	}
}

function update_seo_pageTitle(result){
  var passed = result.testPassed;
  console.log("SEO - PAGE TITLE");
  console.log("  Has Title:\t" + result.hasTitle);
  console.log("  Char Count:\t" + result.charCount);
	if(passed === true){
		$("#pf_pageTitle").parent().addClass("pass");
		$("#pf_pageTitle").text("pass");
	}
	else if(passed === false){
		$("#pf_pageTitle").parent().addClass("fail");
		$("#pf_pageTitle").text("fail");
	}
	else {
		$("#pf_pageTitle").parent().addClass("na");
		$("#pf_pageTitle").text(passed);
	}
}

// Update Mobile sections
function update_mobile_responsiveness(result){
  var passed = result.testPassed;
	if(passed === true){
		$("#pf_responsiveness").parent().addClass("pass");
		$("#pf_responsiveness").text("pass");
	}
	else if(passed === false){
		$("#pf_responsiveness").parent().addClass("fail");
		$("#pf_responsiveness").text("fail");
	}
	else {
		$("#pf_responsiveness").parent().addClass("na");
		$("#pf_responsiveness").text(result);
	}
}

// function template
function update_mobile_viewportOptimization(result){
  var passed = result.testPassed;
	if(passed === true){
		$("#pf_viewportOptimization").parent().addClass("pass");
		$("#pf_viewportOptimization").text("pass");
	}
	else if(passed === false){
		$("#pf_viewportOptimization").parent().addClass("fail");
		$("#pf_viewportOptimization").text("fail");
	}
	else {
		$("#pf_viewportOptimization").parent().addClass("na");
		$("#pf_viewportOptimization").text(result);
	}
}
