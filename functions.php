<?php
/**
 * Plugin functions.
 */

namespace goblindegook\WP\Shorthand;

/**
 * Filter asset list.
 * 
 * @param  string $type   Asset type, either 'styles' or 'scripts'.
 * @param  array  $assets List of assets for a shortcode.
 * @param  string $tag    Tag name.
 * @return array          Filtered list of assets.
 *
 * @uses \apply_filters()
 */
function filter_assets( $type, $assets = array(), $tag = null ) {

	/**
	 * Allows developers to filter styles and scripts bundled by Shorthand.
	 * @param array  $assets Tag assets.
	 * @param string $tag    Tag name.
	 */
	return \apply_filters( 'shorthand_' . $type, $assets, $tag );	
}

/**
 * Register shortcode UI using Shortcake.
 * 
 * @param \Syllables\Shortcode $shortcode Shortcode object.
 *
 * @uses \add_action()
 * @uses \esc_url()
 * @uses \shortcode_ui_register_for_shortcode()
 */
function register_ui( Shortcode $shortcode ) {
	if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
		return;
	}

	$ui = $shortcode->get_ui();

	if ( empty( $ui ) ) {
		return;
	}

	\shortcode_ui_register_for_shortcode( $shortcode->get_tag(), $ui );

	\add_action( 'shortcode_ui_after_do_shortcode', function( $tag ) use ( $shortcode ) {
		if ( stripos( $tag, '[' . $shortcode->get_tag() ) === false ) {
			return;
		}

		$styles = filter_assets( 'styles', $shortcode->get_styles(), $tag );

		foreach( $styles as $style ) {
			printf( '<link rel="stylesheet" href="%s">', \esc_url( $style ) );
		}

		$scripts = filter_assets( 'scripts', $shortcode->get_styles(), $tag );

		foreach( $scripts as $script ) {
			printf( '<script type="text/javascript" src="%s">', \esc_url( $script ) );
		}
	});
}
