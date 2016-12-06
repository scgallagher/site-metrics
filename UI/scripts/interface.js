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

	update_security_ssl(obj.results.resultsSecurity.resultsSSL);
	update_security_sqlInjection(obj.results.resultsSecurity.resultsSQLInjection);

	update_seo_heading(obj.results.resultsSEO.resultsHeading);
	update_seo_metaDescription(obj.results.resultsSEO.resultsMetaDescription);
	update_seo_pageTitle(obj.results.resultsSEO.resultsPageTitle);

  update_mobile_responsiveness(obj.results.resultsMobile.resultsResponsiveness);
  update_mobile_viewportOptimization(obj.results.resultsMobile.resultsViewportOptimization);

  update_performance_browserCaching(obj.results.resultsPerformance.resultsBrowserCaching);
  update_performance_compression(obj.results.resultsPerformance.resultsCompression);
  update_performance_httpRequests(obj.results.resultsPerformance.resultsHTTPRequests);
  update_performance_pageLoad(obj.results.resultsPerformance.resultsPageLoad);
  update_performance_pageRedirects(obj.results.resultsPerformance.resultsPageRedirects);
  update_performance_pageSize(obj.results.resultsPerformance.resultsPageSize);
  update_performance_renderBlocking(obj.results.resultsPerformance.resultsRenderBlocking);

	$("#resultsPage").show();

}

function update_security_ssl(result){
  var rating = result.rating;
  console.log("SECURITY - SSL");
  console.log("  Has Cert:\t\t" + result.hasCert);
  console.log("  Cert Expired:\t\t" + result.certExpired);
  console.log("  Rating:\t\t" + result.rating);
	if(rating === "good"){
		$("#pf_ssl").parent().addClass("good");
	}
	else if(rating === "bad"){
		$("#pf_ssl").parent().addClass("bad");
	}
	else {
		$("#pf_ssl").parent().addClass("na");
	}
  $("#data_ssl").text("Has Cert: " + result.hasCert + "\tExpired: " + result.certExpired);
}

function update_security_sqlInjection(result){
  var rating = result.rating;
  console.log("SECURITY - SQL INJECTION");
  console.log("  Prepared Statements:\t\t" + result.preparedStatements);
  console.log("  Non-Prepared Statements:\t" + result.nonPreparedStatements);
  console.log("  Rating:\t\t\t" + result.rating);
	if(rating === "good"){
		$("#pf_sqlInjection").parent().addClass("good");
	}
	else if(rating === "bad"){
		$("#pf_sqlInjection").parent().addClass("bad");
	}
	else {
		$("#pf_sqlInjection").parent().addClass("na");
	}
  $("#data_sqlInjection").text("Prepared: " + result.preparedStatements +
    "\nNon-Prepared: " + result.nonPreparedStatements);
}

// Update SEO sections
function update_seo_heading(result){
  var rating = result.rating;
  console.log("SEO - HEADING");
  console.log("  Has H1:\t\t" + result.hasH1);
  console.log("  H1 Count:\t" +result.h1Count);
  console.log("  H2 Count:\t" +result.h2Count);
  console.log("  H3 Count:\t" +result.h3Count);
  console.log("  Rating:\t\t" + rating);
	if(rating === "good"){
		$("#pf_heading").parent().addClass("good");
	}
	else if(rating === "okay"){
		$("#pf_heading").parent().addClass("okay");
	}
  else if(rating === "bad"){
    $("#pf_heading").parent().addClass("bad");
  }
	else {
		$("#pf_heading").parent().addClass("na");
	}
  $("#data_heading").text("H1 Tags: " + result.h1Count +
    "\nH2 Tags: " + result.h2Count + "\nH3 Tags: " + result.h2Count);
}

function update_seo_metaDescription(result){
  var rating = result.rating;
  console.log("SEO - META DESCRIPTION");
  console.log("  Has Meta:\t" + result.hasMetaDescription);
  console.log("  Char Count:\t" + result.charCount);
  console.log("  Rating:\t" + rating);
	if(rating === "good"){
		$("#pf_metaDescription").parent().addClass("good");
	}
	else if(rating === "okay"){
		$("#pf_metaDescription").parent().addClass("okay");
	}
  else if(rating === "bad"){
		$("#pf_metaDescription").parent().addClass("bad");
	}
	else {
		$("#pf_metaDescription").parent().addClass("na");
	}
  $("#data_metaDescription").text("Characters: " + result.charCount);
}

function update_seo_pageTitle(result){
  var rating = result.rating;
  console.log("SEO - PAGE TITLE");
  console.log("  Has Title:\t" + result.hasTitle);
  console.log("  Char Count:\t" + result.charCount);
  console.log("  Rating:\t" + rating);
	if(rating === "good"){
		$("#pf_pageTitle").parent().addClass("good");
	}
	else if(rating === "okay"){
		$("#pf_pageTitle").parent().addClass("okay");
	}
  else if(rating === "bad"){
    $("#pf_pageTitle").parent().addClass("bad");
  }
	else {
		$("#pf_pageTitle").parent().addClass("na");
	}
  $("#data_pageTitle").text("Characters: " + result.charCount);
}

// Update Mobile sections
function update_mobile_responsiveness(result){
  var passed = result.testPassed;
  console.log("MOBILE - RESPONSIVENESS");
  console.log("  Uses Bootstrap:\t" + result.hasBootstrap);
  console.log("  Uses Media Queries:\t" + result.hasMediaQueries);
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
		$("#pf_responsiveness").text("n/a");
	}
}

function update_mobile_viewportOptimization(result){
  var passed = result.testPassed;
  console.log("MOBILE - VIEWPORT OPTIMIZATION");
  console.log("  " + result.usesContentViewport);
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
		$("#pf_viewportOptimization").text("n/a");
	}
}

// Update Performance sections

function update_performance_browserCaching(result){
  var passed = result.testPassed;
  console.log("PERFORMANCE - BROWSER CACHING");
  console.log("  Size:\t\t" + result.cookiesSizeInBytes + "b");
  console.log("  Cookies\t" + result.cookiesCount);
  console.log("  Rating:\t" + result.browserCachingResult);
	if(passed === true){
		$("#pf_browserCaching").parent().addClass("pass");
		$("#pf_browserCaching").text("pass");
	}
	else if(passed === false){
		$("#pf_browserCaching").parent().addClass("fail");
		$("#pf_browserCaching").text("fail");
	}
	else {
		$("#pf_browserCaching").parent().addClass("na");
		$("#pf_browserCaching").text("n/a");
	}
}

function update_performance_compression(result){
  var passed = result.testPassed;
  // log metrics to console here
  console.log("PERFORMANCE - COMPRESSION");
  console.log("  Percentage:\t" + result.compressionPercentage);
  console.log("  Rating:\t" + result.compressionResult);
	if(passed === true){
		$("#pf_compression").parent().addClass("pass");
		$("#pf_compression").text("pass");
	}
	else if(passed === false){
		$("#pf_compression").parent().addClass("fail");
		$("#pf_compression").text("fail");
	}
	else {
		$("#pf_compression").parent().addClass("na");
		$("#pf_compression").text("n/a");
	}
}

function update_performance_httpRequests(result){
  var rating = result.rating;
  console.log("PERFORMANCE - HTTP REQUESTS");
  console.log("  Requests:\t" + result.requestCount);
  console.log("  Rating:\t" + rating);
	if(rating === "good"){
		$("#pf_httpRequests").parent().addClass("good");
	}
	else if(rating === "okay"){
		$("#pf_httpRequests").parent().addClass("okay");
	}
  else if(rating === "bad"){
    $("#pf_httpRequests").parent().addClass("bad");
  }
	else {
		$("#pf_httpRequests").parent().addClass("na");
	}
  $("#data_httpRequests").text("Requests: " + result.requestCount);
}

function update_performance_pageLoad(result){
  var passed = result.testPassed;
  console.log("PERFORMANCE - PAGE LOAD");
  console.log("  Load Time:\t" + result.loadTimeInSeconds + "s");
  console.log("  Rating\t" + result.pageLoadResult);
	if(passed === true){
		$("#pf_pageLoad").parent().addClass("pass");
		$("#pf_pageLoad").text("pass");
	}
	else if(passed === false){
		$("#pf_pageLoad").parent().addClass("fail");
		$("#pf_pageLoad").text("fail");
	}
	else {
		$("#pf_pageLoad").parent().addClass("na");
		$("#pf_pageLoad").text("n/a");
	}
}


function update_performance_pageRedirects(result){
  var passed = result.testPassed;
  console.log("PERFORMANCE - PAGE REDIRECTS");
  console.log("  Rating:\t" + result.redirectsResult);
	if(passed === true){
		$("#pf_pageRedirects").parent().addClass("pass");
		$("#pf_pageRedirects").text("pass");
	}
	else if(passed === false){
		$("#pf_pageRedirects").parent().addClass("fail");
		$("#pf_pageRedirects").text("fail");
	}
	else {
		$("#pf_pageRedirects").parent().addClass("na");
		$("#pf_pageRedirects").text("n/a");
	}
}

function update_performance_pageSize(result){
  var passed = result.testPassed;
  console.log("PERFORMANCE - PAGE SIZE");
  console.log("  Rating:\t" + result.pageSizeResult);
	if(passed === true){
		$("#pf_pageSize").parent().addClass("pass");
		$("#pf_pageSize").text("pass");
	}
	else if(passed === false){
		$("#pf_pageSize").parent().addClass("fail");
		$("#pf_pageSize").text("fail");
	}
	else {
		$("#pf_pageSize").parent().addClass("na");
		$("#pf_pageSize").text("n/a");
	}
}

function update_performance_renderBlocking(result){
  var passed = result.testPassed;
  console.log("PERFORMANCE - RENDER BLOCKING");
  console.log("  CSS Import\t\t" + result.cssImportResult);
  console.log("  Link Tags:\t\t" + result.linkTagsWithMediaAttributeResult);
  console.log("  Multi CSS:\t\t" + result.multipleCssResult);
  console.log("  Scripts in Head:\t" + result.scriptTagsInHeadResult);
  console.log("  On Load:\t\t" + result.onLoadResult);
	if(passed === true){
		$("#pf_renderBlocking").parent().addClass("pass");
		$("#pf_renderBlocking").text("pass");
	}
	else if(passed === false){
		$("#pf_renderBlocking").parent().addClass("fail");
		$("#pf_renderBlocking").text("fail");
	}
	else {
		$("#pf_renderBlocking").parent().addClass("na");
		$("#pf_renderBlocking").text("n/a");
	}
}
