<?php
/*
	Theme Name:  Sahu4You Lite
	Description: Custom child theme for the <a href="http://sahu4you.com">Genesis Child Thmes</a>.
	Author:       Vikas Sahu
	Author URI:  https://www.sahu4you.com
	Version:     1.0.0
	License:     GPL-2.0+
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	Template:    genesis
*/

/**
 * Offline Content
 *
 */
function ea_pwa_offline_content() {
	echo '<h1>Oops, it looks like you\'re offline</h1>';
	if( function_exists( 'wp_service_worker_error_message_placeholder' ) )
		wp_service_worker_error_message_placeholder();

}
add_action( 'genesis_loop', 's4y_pwa_offline_content' );
remove_action( 'genesis_loop', 'ea_archive_loop' );
remove_action( 'genesis_loop', 'genesis_do_loop' );

// Build the page
genesis();
