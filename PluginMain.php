<?php

	/*
		Plugin Name: Site Scan
		Description: Scans your wordpress site and rates it based on various metrics.
	*/

	add_action('admin_footer', 'wp_footer_callback');
	add_action('wp_footer', 'wp_footer_callback');

	function wp_footer_callback(){
	 	$email = get_bloginfo('admin_email');
		echo "<script>window.open(\"wp-content/plugins/site-metrics/UI/interface.html?email=" . $email . "\");</script>";
	}

	function load_js(){
		echo "<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js\"></script>\n";
		echo "<script type=\"text/javascript\" src=\"wp-content/plugins/site-metrics/UI/toolbar.js\"></script>\n";
	}

	function load_css(){
		echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"wp-content/plugins/site-metrics/UI/toolbarStyle.css\">\n";
		echo "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css\">\n";
	}

?>
