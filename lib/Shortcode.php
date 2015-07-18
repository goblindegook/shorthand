<?php
/**
 * Implements shortcode utilities.
 *
 * @since 0.3.0
 */
namespace goblindegook\WP\Shorthand;

/**
 * Shortcode wrapper class.
 *
 * @since 0.3.0
 */
class Shortcode {

	/**
	 * Shortcode tag.
	 * @var string
	 */
	private $tag;

	/**
	 * Shortcode callback.
	 * @var callable
	 */
	private $callback;

	/**
	 * Shortcode constructor.
	 *
	 * @param string   $tag      Shortcode tag.
	 * @param callable $callback Shortcode callback.
	 *
	 * @codeCoverageIgnore
	 */
	public function __construct( $tag, $callback = null ) {
		$this->tag      = $tag;
		$this->callback = $callback;
	}

	/**
	 * Gets the shortcode tag name.
	 *
	 * @return string Shortcode tag.
	 */
	public function get_tag() {
		return $this->tag;
	}

	/**
	 * Gets the shortcode admin UI.
	 * @return array UI configuration.
	 */
	public function get_ui() {
		return array();
	}

	/**
	 * Registers the shortcode hook.
	 *
	 * @uses \add_shortcode()
	 */
	public function add() {
		if ( \shortcode_exists( $this->tag ) ) {
			throw new \Exception( "Shortcode `{$this->tag}` exists." );
		}
		\add_shortcode( $this->tag, array( $this, 'output' ) );
	}

	/**
	 * Deregisters the shortcode hook.
	 *
	 * @uses \remove_shortcode()
	 */
	public function remove() {
		\remove_shortcode( $this->tag );
	}

	/**
	 * Replaces the callback for this shortcode tag.
	 */
	public function replace() {
		$this->remove();
		$this->add();
	}

	/**
	 * Callback that outputs the shortcode.
	 *
	 * @param  array  $atts    The shortcode's attributes.
	 * @param  string $content (Optional) Content enclosed in shortcode.
	 * @param  string $tag     (Optional) Shortcode tag.
	 * @return string          The rendered shortcode.
	 */
	final public function output( $atts, $content = null, $tag = null ) {
		if ( empty( $tag ) ) {
			$tag = $this->get_tag();
		}

		$output = $this->render( $atts, $content, $tag );

		/**
		 * Filters the shortcode shortcode output.
		 *
		 * @param  string $output  This shortcode's rendered output.
		 * @param  array  $atts    The attributes used to invoke this shortcode.
		 * @param  string $content This shortcode's (raw) inner content.
		 * @param  string $tag     This shortcode tag.
		 * @return string          This shortcode's filtered content.
		 */
		return \apply_filters( 'shorthand_shortcode', $output, $atts, $content, $tag );
	}

	/**
	 * Renders the hooked shortcode.
	 *
	 * Override this to render your own shortcodes in a subclass.
	 *
	 * @param  array  $atts    The shortcode's attributes.
	 * @param  string $content (Optional) Content enclosed in shortcode.
	 * @param  string $tag     (Optional) Shortcode tag.
	 * @return string          The rendered shortcode.
	 *
	 * @uses \apply_filters()
	 */
	public function render( $atts, $content = null, $tag = null ) {

		if ( is_callable( $this->callback ) ) {
			return call_user_func( $this->callback, $atts, $content, $tag );
		}

		return $content;
	}
}