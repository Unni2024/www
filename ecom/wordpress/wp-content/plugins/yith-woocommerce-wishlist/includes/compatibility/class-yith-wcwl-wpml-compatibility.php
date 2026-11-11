<?php
/**
 * WPML compatibility class
 *
 * @author  YITH <plugins@yithemes.com>
 * @package YITH\Wishlist\Classes
 */

defined( 'YITH_WCWL' ) || exit; // Exit if accessed directly.

if ( ! class_exists( 'YITH_WCWL_WPML_Compatibility' ) ) {
	/**
	 * Class to initialize the compatibility with WPML
	 */
	class YITH_WCWL_WPML_Compatibility extends YITH_WCWL_Compatibility {

		/**
		 * Construct
		 */
		public function __construct() {
			add_filter( 'wcml_multi_currency_ajax_actions', array( $this, 'register_ajax_actions' ) );
		}

		/**
		 * Filter WooCommerce Multilingual AJAX actions to include all wishlist-related actions
		 *
		 * @param array $actions Ajax actions.
		 *
		 * @return array
		 */
		public function register_ajax_actions( $actions ) {
			$actions = array_merge(
				$actions,
				array(
					'add_to_wishlist',
					'remove_from_wishlist',
					'delete_item',
					'save_title',
					'load_mobile',
					'reload_wishlist_and_adding_elem',
					'load_fragments',
				)
			);

			return $actions;
		}
	}
}
