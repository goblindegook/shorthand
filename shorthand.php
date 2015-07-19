<?php
/**
 * Plugin Name: Shorthand
 * Plugin URI:  https://github.com/goblindegook/shorthand
 * Description: A shortcode pack, from my site to yours.
 * Version:     1.0.0
 * Author:      Luís Rodrigues
 * Author URI:  http://goblindegook.net/
 * License:     GPLv2
 *
 * Main plugin file.
 */

namespace goblindegook\WP\Shorthand;

use \goblindegook\WP\Shorthand;

if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/functions.php';

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

} );
