<?php

namespace goblindegook\WP\Shorthand;

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
function register_ui( Shortcode $shortcode ) {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
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
