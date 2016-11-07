<?php

	/*
		Plugin Name: Site Scan
		Description: Scans your wordpress site and rates it based on various metrics.
	*/

	//chdir("/home/sean/site-scan/");

	add_action('wp_footer', 'wp_footer_callback');
	//wp_footer_callback();

	function wp_footer_callback(){

		echo "<script>window.open(\"wp-content/plugins/site-metrics/scan-interface.html\");</script>";
	}

?>