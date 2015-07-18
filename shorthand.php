<?php
/*
Plugin Name: Shorthand
Plugin URI:  https://github.com/goblindegook/shorthand
Description: A shortcode pack, from my site to yours.
Version:     1.0.0
Author:      Luís Rodrigues
Author URI:  http://goblindegook.net/
License:     GPLv2
*/

if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use \goblindegook\WP\Shorthand;

define( 'SHORTHAND_URL', \plugin_dir_url( __FILE__ ) );
define( 'SHORTHAND_VERSION', '1.0.0' );

\add_action( 'init', function () {
	$shortcake = function_exists( 'shortcode_ui_register_for_shortcode' );
	
	$shortcodes = array(
		new Shorthand\Pull_Quote(),
		new Shorthand\Small_Caps(),
		new Shorthand\Underline(),
	);

	foreach ( $shortcodes as &$shortcode ) {
		$shortcode->replace();

		if ( $shortcake && method_exists( $shortcode, 'get_ui' ) ) {
			\shortcode_ui_register_for_shortcode( $shortcode->get_tag(), $shortcode->get_ui() );
		}
	}
} );
