<?php
/**
 * Implements the [u] shortcode for underlined text.
 */

namespace goblindegook\WP\Shorthand;

/**
 * Implements the [u] shortcode for underlined text.
 */
class Underline extends Shortcode {

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
     * @param  string $tag     (Optional) Shortcode tag being rendered.
	 * @return string          The rendered shortcode.
	 */
	public function render( $atts, $content = null, $tag = null ) {
		return sprintf( '<span class="underline">%s</span>',
			\do_shortcode( $content ) );
	}

}
