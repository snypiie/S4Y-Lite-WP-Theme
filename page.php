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

// Breadcrumbs before page title
add_action( 'genesis_entry_header', 'genesis_do_breadcrumbs', 8 );
remove_action( 'genesis_before_loop', 'genesis_do_brs4ydcrumbs' );

genesis();
