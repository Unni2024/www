<?php
/**
 * Counter shortcode handling
 *
 * @author YITH <plugins@yithemes.com>
 * @package YITH\Compare\Classes
 * @version 1.1.4
 */

defined( 'YITH_WOOCOMPARE' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'YITH_WooCompare_Counter_Shortcode' ) ) {
	/**
	 * Counter shortcode handling class
	 *
	 * @since 1.0.0
	 */
	class YITH_WooCompare_Counter_Shortcode {
		/**
		 * Renders the counter of the products in comparison list
		 *
		 * @param array $atts Array of additional attributes for the shortcode rendering.
		 * @return string Shortcode template.
		 */
		public static function render( $atts = array() ) {
			$args = shortcode_atts(
				array(
					'type'      => 'text',
					'show_icon' => 'yes',
					'text'      => '',
					'icon'      => '',
				),
				$atts
			);

			$args['text']      = htmlspecialchars( wp_strip_all_tags( $args['text'] ), ENT_QUOTES, 'UTF-8', true );
			$args['type']      = in_array( $args['type'], array( 'text', 'number' ), true ) ? $args['type'] : 'text';
			$args['show_icon'] = 'yes' === $args['show_icon'] ? 'yes' : 'no';
			$args['icon']      = esc_url_raw( $args['icon'] );

			$products = YITH_WooCompare_Products_List::instance()->get();
			$count    = count( $products );

			// Builds template arguments.
			$args['items']       = $products;
			$args['items_count'] = $count;

			if ( ! $args['icon'] ) {
				$args['icon'] = YITH_WOOCOMPARE_ASSETS_URL . 'images/compare-icon.png';
			}

			if ( ! $args['text'] ) {
				$args['text'] = _n( '{{count}} product in compare', '{{count}} products in compare', $count, 'yith-woocommerce-compare' );
			}

			// Add count in text.
			$args['text_o'] = $args['text'];
			$args['text']   = str_replace( '{{count}}', $count, $args['text'] );

			/**
			 * APPLY_FILTERS: yith_woocompare_shortcode_counter_args
			 *
			 * Filters the array with the arguments needed for the counter shortcode.
			 *
			 * @param array $args Array of arguments.
			 *
			 * @return array
			 */
			$args = apply_filters( 'yith_woocompare_shortcode_counter_args', $args );

			ob_start();
			wc_get_template( 'yith-compare-counter.php', $args, '', YITH_WOOCOMPARE_TEMPLATE_PATH );

			return ob_get_clean();
		}
	}
}
