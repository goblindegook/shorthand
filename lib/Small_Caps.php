<?php
/**
 * Implements the [small-caps] shortcode for text in small caps.
 */

namespace goblindegook\WP\Shorthand;

/**
 * Implements the [small-caps] shortcode for text in small caps.
 */
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
	public function render( $atts, $content = null, $tag = null ) {
		return sprintf( '<span class="%s">%s</span>',
			$tag, \do_shortcode( $content ) );
	}

	/**
	 * Shortcode styles.
	 * @return array Style assets.
	 */
    public function get_styles() {
    	return array(
	    	'shorthand-small-caps' => SHORTHAND_URL . 'public/small-caps.css',
    	);
    }

}
