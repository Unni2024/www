<?php
/**
 * The home template file
 */

if ( get_option( 'show_on_front' ) === 'home_sections' && is_home() ) {
    remove_action( 'best_shop_before_posts_content', 'best_shop_primary_page_header', 10 );
    get_header();
    // Do nothing else, as home sections are attached to best_shop_before_posts_content and get_footer hooks.
    get_footer();
} else {
    // Fallback to parent theme behavior. Since this is home.php, it's used for the blog index.
    // The parent theme does not have a home.php, so it would normally use index.php.
    require get_template_directory() . '/index.php';
}
