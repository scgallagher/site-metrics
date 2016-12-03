<?php

	/*
		Plugin Name: Site Scan
		Description: Scans your wordpress site and rates it based on various metrics.
	*/

	//chdir("/home/sean/site-scan/");
	add_action('admin_footer', 'wp_footer_callback');
	add_action('wp_footer', 'wp_footer_callback');

	// add_action('admin_head', 'load_js');
	// add_action('wp_head', 'load_js');
	//
	// add_action('admin_head', 'load_css');
	// add_action('wp_head', 'load_css');

	// add_action('admin_footer', 'load_html');
  // add_action('wp_footer', 'load_html');

	function wp_footer_callback(){

		echo "<script>window.open(\"wp-content/plugins/site-metrics/scan-interface.html\");</script>";
	}

	function load_js(){
		echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"wp-content/plugins/site-metrics/UI/toolbar.js\"></script>\n";
	}

	function load_css(){
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"wp-content/plugins/site-metrics/UI/toolbarStyle.css\">\n";
		echo "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css\">\n";
	}

	function load_html(){
		//echo "<script src=\"wp-content/plugins/site-metrics/UI/insertHTML.js\"></script>";
		// echo "<div id=\"sitescan_toolbar\">\n";
		// echo "<button id=\"toggle_button\" class=\"toolbarButton\">\n";
		// echo "<span class=\"fa-stack\">\n";
		// echo "<i id=\"toggleIconBkgrnd\" class=\"fa fa-circle fa-stack-2x\"></i>\n";
		// echo "<i id=\"toggleIcon\" class=\"fa fa-chevron-left fa-stack-1x\"></i>\n";
		// echo "</span>\n";
		// echo "</button>\n";
		// echo "<div id=\"content\">\n";
		// echo "<span id=\"message\"></span>\n";
		// echo "<input id=\"scanTarget_input\" type=\"text\" placeholder=\"website to be scanned . .\">\n";
		// echo "<button id=\"scan_button\" class=\"toolbarButton\">Scan</button>\n";
		// echo "</div>\n";
		// echo "</div>\n";
	}

?>
