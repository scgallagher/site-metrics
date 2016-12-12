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

?>
