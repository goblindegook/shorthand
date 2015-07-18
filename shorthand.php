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

define( 'SHORTHAND_URL', \plugin_dir_url( __FILE__ ) );
define( 'SHORTHAND_VERSION', '1.0.0' );


/**
 * Determines whether bundled styles are enabled.
 * @return boolean True if styles are enabled, otherwise false.
 */
function styles_enabled() {
	/**
	 * Allows developers to disable the styles bundled by Shorthand.
	 * @param bool $enabled Styles enabled.
	 */
	return \apply_filters( 'shorthand_styles_enabled', true );
}


/**
 * Register shortcode UI using Shortcake.
 * @param \Syllables\Shortcode $shortcode Shortcode object.
 */
function register_ui( \Syllables\Shortcode $shortcode ) {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		return;
	}

	if ( ! method_exists( $shortcode, 'get_ui' ) ) {
		return;
	}

	\shortcode_ui_register_for_shortcode( $shortcode->get_tag(), $shortcode->get_ui() );

	\add_action( 'shortcode_ui_after_do_shortcode', function( $tag ) use ( $shortcode ) {
		if ( stripos( $tag, '[' . $shortcode->get_tag() ) !== false && styles_enabled() ) {
			// Enqueue styles in the Shortcake live preview:
			echo '<link rel="stylesheet" href="' . \esc_url( SHORTHAND_URL . 'public/style.css' ) . '">';
		}
	});
}


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
