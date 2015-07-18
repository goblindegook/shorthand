<?php

namespace goblindegook\WP\Shorthand;

use \Syllables\Shortcode;

class Small_Caps extends Shortcode {

	/**
	 * Shortcode constructor.
	 */
	public function __construct() {
		parent::__construct( 'small-caps' );
	}

	/**
	 * Underline shortcode rendering.
	 *
	 * @param  array  $atts    The shortcode's attributes.
	 * @param  string $content (Optional) Content enclosed in shortcode.
	 * @param  string $tag     (Optional) Shortcode tag being rendered.
	 * @return string          The rendered shortcode.
	 */
	public function render( $atts, $content = '', $tag = null ) {
		return sprintf( '<span class="%s">%s</span>',
			$tag, \do_shortcode( $content ) );
	}

}