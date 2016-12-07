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
	if(rating.toLowerCase() === "good"){
		$("#pf_ssl").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "bad"){
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
	if(rating.toLowerCase() === "good"){
		$("#pf_sqlInjection").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "bad"){
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
	if(rating.toLowerCase() === "good"){
		$("#pf_heading").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_heading").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
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
	if(rating.toLowerCase() === "good"){
		$("#pf_metaDescription").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_metaDescription").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
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
	if(rating.toLowerCase() === "good"){
		$("#pf_pageTitle").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_pageTitle").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
    $("#pf_pageTitle").parent().addClass("bad");
  }
	else {
		$("#pf_pageTitle").parent().addClass("na");
	}
  $("#data_pageTitle").text("Characters: " + result.charCount);
}

// Update Mobile sections
function update_mobile_responsiveness(result){
  var rating = result.rating;
  console.log("MOBILE - RESPONSIVENESS");
  console.log("  Uses Bootstrap:\t" + result.hasBootstrap);
  console.log("  Uses Media Queries:\t" + result.hasMediaQueries);
	if(rating.toLowerCase() === "good"){
		$("#pf_responsiveness").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_responsiveness").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
    $("#pf_responsiveness").parent().addClass("bad");
  }
	else {
		$("#pf_responsiveness").parent().addClass("na");
	}
  $("#data_responsiveness").text("Bootstrap: " + result.hasBootstrap +
    "\nMedia Queries: " + result.hasMediaQueries);
}

function update_mobile_viewportOptimization(result){
  var rating = result.rating;
  console.log("MOBILE - VIEWPORT OPTIMIZATION");
  console.log("  Using Content Viewport:\t" + result.usesContentViewport);
	if(rating.toLowerCase() === "good"){
		$("#pf_viewportOptimization").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "bad"){
		$("#pf_viewportOptimization").parent().addClass("bad");
	}
	else {
		$("#pf_viewportOptimization").parent().addClass("na");
		$("#pf_viewportOptimization").text("n/a");
	}
  $("#data_viewportOptimization").text("Uses Content Viewport: " + result.usesContentViewport);
}

// Update Performance sections

function update_performance_browserCaching(result){
  var rating = result.rating;
  console.log("PERFORMANCE - BROWSER CACHING");
  console.log("  Size:\t\t" + result.cookiesSizeInBytes + "b");
  console.log("  Cookies\t" + result.cookiesCount);
  console.log("  Rating:\t" + result.rating.toLowerCase());
	if(rating.toLowerCase() === "good"){
    $("#pf_browserCaching").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_browserCaching").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
    $("#pf_browserCaching").parent().addClass("bad");
  }
	else {
		$("#pf_browserCaching").parent().addClass("na");
		$("#pf_browserCaching").text("n/a");
	}
  $("#data_browserCaching").text("Cache Size:\t" + result.cookiesSizeInBytes +
    "\nCookies:\t" + result.cookiesCount);
}

function update_performance_compression(result){
  var rating = result.rating;
  // log metrics to console here
  console.log("PERFORMANCE - COMPRESSION");
  console.log("  Percentage:\t" + result.compressionPercentage);
  console.log("  Rating:\t" + result.compressionResult);
	if(rating.toLowerCase() === "good"){
		$("#pf_compression").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_compression").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
    $("#pf_compression").parent().addClass("bad");
  }
	else {
		$("#pf_compression").parent().addClass("na");
		$("#pf_compression").text("n/a");
	}
  $("#data_compression").text("Compression:\t" + result.compressionPercentage + "%");
}

function update_performance_httpRequests(result){
  var rating = result.rating;
  console.log("PERFORMANCE - HTTP REQUESTS");
  console.log("  Requests:\t" + result.requestCount);
  console.log("  Rating:\t" + rating);
	if(rating.toLowerCase() === "good"){
		$("#pf_httpRequests").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_httpRequests").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
    $("#pf_httpRequests").parent().addClass("bad");
  }
	else {
		$("#pf_httpRequests").parent().addClass("na");
	}
  $("#data_httpRequests").text("Requests: " + result.requestCount);
}

function update_performance_pageLoad(result){
  var rating = result.rating;
  console.log("PERFORMANCE - PAGE LOAD");
  console.log("  Load Time:\t" + result.loadTimeInSeconds + "s");
  console.log("  Rating\t" + result.rating);
	if(rating.toLowerCase() === "good"){
		$("#pf_pageLoad").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_pageLoad").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
    $("#pf_pageLoad").parent().addClass("bad");
  }
	else {
		$("#pf_pageLoad").parent().addClass("na");
	}
  $("#data_pageLoad").text("Load Time:\t" + result.loadTimeInSeconds + "s");
}


function update_performance_pageRedirects(result){
  var rating = result.rating;
  console.log("PERFORMANCE - PAGE REDIRECTS");
  console.log("  Rating:\t" + result.redirectsResult);
	if(rating.toLowerCase() === "good"){
		$("#pf_pageRedirects").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_pageRedirects").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
		$("#pf_pageRedirects").parent().addClass("bad");
	}
	else {
		$("#pf_pageRedirects").parent().addClass("na");
		$("#pf_pageRedirects").text("n/a");
	}
  $("#data_pageRedirects").text("Redirects:\t" + result.redirectCount);
}

function update_performance_pageSize(result){
  var rating = result.rating;
  console.log("PERFORMANCE - PAGE SIZE");
  console.log("  Rating:\t" + result.pageSizeResult);
	if(rating.toLowerCase() === "good"){
		$("#pf_pageSize").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_pageSize").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
    $("#pf_pageSize").parent().addClass("bad");
  }
	else {
		$("#pf_pageSize").parent().addClass("na");
		$("#pf_pageSize").text("n/a");
	}
  var pageSizeInKB = Math.round(result.pageSizeInBytes / 1024);
  $("#data_pageSize").text("Page Size:\t" + pageSizeInKB + "KB");
}

function update_performance_renderBlocking(result){
  var rating = result.rating;
  console.log("PERFORMANCE - RENDER BLOCKING");
  console.log("  CSS Import\t\t" + result.cssImportResult);
  console.log("  Link Tags:\t\t" + result.linkTagsWithMediaAttributeResult);
  console.log("  Multi CSS:\t\t" + result.multipleCssResult);
  console.log("  Scripts in Head:\t" + result.scriptTagsInHeadResult);
  console.log("  On Load:\t\t" + result.onLoadResult);
  console.log("  Score:\t\t" + result.score + "%");
	if(rating.toLowerCase() === "good"){
		$("#pf_renderBlocking").parent().addClass("good");
	}
	else if(rating.toLowerCase() === "okay"){
		$("#pf_renderBlocking").parent().addClass("okay");
	}
  else if(rating.toLowerCase() === "bad"){
    $("#pf_renderBlocking").parent().addClass("bad");
  }
	else {
		$("#pf_renderBlocking").parent().addClass("na");
		$("#pf_renderBlocking").text("n/a");
	}
  $("#data_renderBlocking").text("Score:\t" + result.score + "%");
}
