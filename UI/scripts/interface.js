$(function() {
  $("#txtScanTarget").val("localhost");
	$("#resultsPage").hide();
	$("#btnScan").click(scan);
});

function scan(){
	$("#startPage").hide();
	jQuery.ajax({
		type: "POST",
		url: "../SiteScan.php",
		dataType: "json",
		success: function(obj){
			scanComplete(obj);
		}
	});
	//
}


function scanComplete(obj){

	console.log(obj.results);
	console.log("SSL Result: " + obj.results.resultsSecurity.resultsSSL.testPassed);
	update_security_ssl(obj.results.resultsSecurity.resultsSSL.testPassed);
	update_security_sqlInjection(obj.results.resultsSecurity.resultsSQLInjection.testPassed);
	$("#resultsPage").show();

}

function update_security_ssl(result){
	if(result === true){
		$("#pf_ssl").addClass("pass");
		$("#pf_ssl").text("pass");
	}
	else if(result === false){
		$("#pf_ssl").addClass("fail");
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
}
