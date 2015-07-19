<?php
/**
 * Implements the [pull-quote] shortcode.
 */

namespace goblindegook\WP\Shorthand;

/**
 * Implements the [pull-quote] shortcode.
 */
class Pull_Quote extends Shortcode {

	/**
	 * Shortcode constructor.
	 */
	public function __construct() {
		parent::__construct( 'pull-quote' );
	}

    /**
     * Pull quote shortcode rendering.
     *
     * @param  array  $atts    The shortcode's attributes.
     * @param  string $content (Optional) Content enclosed in shortcode.
     * @param  string $tag     (Optional) Shortcode tag being rendered.
     * @return string          The rendered shortcode.
     */
    public function render( $atts, $content = null, $tag = null ) {
    	$atts = \shortcode_atts( array(
    		'align' => 'center',
    	), $atts, $tag );

    	$class = array( $tag, $tag . '--' . $atts['align'] );

        return sprintf( '<aside class="%s">%s</aside>',
        	\esc_attr( implode( ' ', $class ) ),
        	\do_shortcode( $content ) );
    }

    /**
     * Shortcode UI arguments.
     * 
     * @return array Shortcode UI arguments.
     */
    public function ui() {
		return array(
			'label'         => \esc_html__( 'Pull Quote', 'shorthand' ),
			'listItemImage' => 'dashicons-editor-quote',
			'inner_content' => array(
				'label' => \esc_html__( 'Quote', 'shorthand' ),
			),
			'attrs'         => array(
				array(
					'label'   => \esc_html__( 'Alignment', 'shorthand' ),
					'attr'    => 'align',
					'type'    => 'select',
					'options' => array(
						'right'  => \esc_html__( 'Right', 'shorthand' ),
						'center' => \esc_html__( 'Center', 'shorthand' ),
						'left'   => \esc_html__( 'Left', 'shorthand' ),
					),
				),
			),
		);
    }

}
