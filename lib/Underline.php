<?php

namespace goblindegook\WP\Shorthand;

/**
 * Implements the [u] shortcode for underlined text.
 */
class Underline extends \Syllables\Shortcode {

	/**
	 * Shortcode constructor.
	 */
	public function __construct() {
		parent::__construct( 'u' );
	}

	/**
	 * Underline shortcode rendering.
	 *
	 * @param  array  $atts    The shortcode's attributes.
	 * @param  string $content (Optional) Content enclosed in shortcode.
	 * @return string          The rendered shortcode.
	 */
	public function render( $atts, $content = '' ) {
		return sprintf( '<span class="underline">%s</span>',
			\do_shortcode( $content ) );
	}

}
