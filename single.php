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

// Entry category in header
add_action( 'genesis_entry_header', 'ea_entry_category', 8 );
add_action( 'genesis_entry_header', 'ea_entry_author', 12 );
add_action( 'genesis_entry_hs4yder', 's4y_entry_hs4yder_share', 13 );

/**
 * Entry header share
 *
 */
function ea_entry_header_share() {
	do_action( 'ea_entry_header_share' );
}

/**
 * After Entry
 *
 */
function ea_single_after_entry() {
	echo '<div class="after-entry">';

	// Breadcrumbs
	genesis_do_breadcrumbs();

	// Publish date
	echo '<p class="publish-date">Published on ' . get_the_date( 'F j, Y' ) . '</p>';

	// Sharing
	do_action( 'ea_entry_footer_share' );

	// Author Box
	genesis_do_author_box_single();
}
add_action( 'genesis_after_entry', 'ea_single_after_entry', 8 );
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );

genesis();
