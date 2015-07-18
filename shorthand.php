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

namespace goblindegook\WP\Shorthand;

use \goblindegook\WP\Shorthand;

if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

require_once __DIR__ . '/functions.php';

define( 'SHORTHAND_URL', \plugin_dir_url( __FILE__ ) );
define( 'SHORTHAND_VERSION', '1.0.0' );

\add_action( 'init', function () {
	$shortcodes = array(
		new Shorthand\Pull_Quote(),
		new Shorthand\Small_Caps(),
		new Shorthand\Underline(),
	);

	foreach ( $shortcodes as &$shortcode ) {
		$shortcode->replace();
		register_ui( $shortcode );
	}

	\add_action( 'wp_enqueue_scripts', function() {
		if ( styles_enabled() ) {
			// Enqueue frontend styles:
			\wp_enqueue_style( 'shorthand', SHORTHAND_URL . 'public/style.css',
				array(), SHORTHAND_VERSION );
		}
	} );
} );
