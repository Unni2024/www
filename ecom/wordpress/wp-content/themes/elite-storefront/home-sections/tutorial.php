<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Add menu page
function elite_storefront_theme_info_menu() {
    add_theme_page(
        esc_html__( 'Elite Storefront Setup', 'elite-storefront' ),
        esc_html__( 'Theme Setup', 'elite-storefront' ),
        'manage_options',
        'elite-storefront-setup',
        'elite_storefront_theme_info_page'
    );
}
add_action( 'admin_menu', 'elite_storefront_theme_info_menu' );

// Render page
function elite_storefront_theme_info_page() {
    ?>
    <div class="wrap about-wrap full-width-layout" style="max-width: 800px; margin: 20px auto;">
        <h1><?php esc_html_e( 'Welcome to Elite Storefront!', 'elite-storefront' ); ?></h1>
        <p class="about-text"><?php esc_html_e( 'Follow this step-by-step guide to set up your beautiful homepage within a minute.', 'elite-storefront' ); ?></p>
        
        <div class="elite-storefront-setup-steps">
            <h2><?php esc_html_e( 'Home Sections Setup Tutorial', 'elite-storefront' ); ?></h2>
            
            <ol>
                <li>
                    <h3><?php esc_html_e( 'Step 1: Set Your Homepage', 'elite-storefront' ); ?></h3>
                    <p><?php esc_html_e( 'Navigate to Settings > Reading and set your "Homepage displays" to shop page if you are creating a ecommerce site. Our home sections are automatically hooked to display before / after the content on the front page that you set up. ', 'elite-storefront' ); ?></p>
                </li>
                <li>
                    <h3><?php esc_html_e( 'Step 2: Access the Customizer', 'elite-storefront' ); ?></h3>
                    <p><?php esc_html_e( 'Go to Appearance > Customize, and look for the "HOME SECTIONS" panel.', 'elite-storefront' ); ?></p>
                </li>
                <li>
                    <h3><?php esc_html_e( 'Step 3: Enable & Configure Sections', 'elite-storefront' ); ?></h3>
                    <p><?php esc_html_e( 'Inside the Home Sections panel, you will find settings for:', 'elite-storefront' ); ?></p>
                    <ul style="list-style-type: disc; margin-left: 20px;">
                        <li><strong><?php esc_html_e( 'Hero Slider', 'elite-storefront' ); ?></strong>: <?php esc_html_e( 'Showcase your top products or specific categories in a large banner slider.', 'elite-storefront' ); ?></li>
                        <li><strong><?php esc_html_e( 'Product Attribute Slider', 'elite-storefront' ); ?></strong>: <?php esc_html_e( 'Display new arrivals, on-sale, featured, or trending products.', 'elite-storefront' ); ?></li>
                        <li><strong><?php esc_html_e( 'Product Category Slider', 'elite-storefront' ); ?></strong>: <?php esc_html_e( 'Highlight products from up to two specific categories.', 'elite-storefront' ); ?></li>
                        <li><strong><?php esc_html_e( 'Custom Pages & Blog', 'elite-storefront' ); ?></strong>: <?php esc_html_e( 'Embed content from standard pages (like Q & A) or show your latest blog posts.', 'elite-storefront' ); ?></li>
                    </ul>
                </li>
                <li>
                    <h3><?php esc_html_e( 'Step 4: Reorder Your Sections', 'elite-storefront' ); ?></h3>
                    <p><?php esc_html_e( 'Each section has a "Section Priority (Order)" setting. Assign a lower number to the section you want to appear first!', 'elite-storefront' ); ?></p>
                </li>
            </ol>
            
            <p style="margin-top: 30px;">
                <a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=home_sections_panel' ) ); ?>" class="button button-primary button-hero"><?php esc_html_e( 'Go to Customizer', 'elite-storefront' ); ?></a>
            </p>
        </div>
    </div>
    <style>
        .elite-storefront-setup-steps {
            background: #fff;
            padding: 30px;
            border: 1px solid #ccd0d4;
            box-shadow: 0 1px 1px rgba(0,0,0,.04);
            margin-top: 20px;
        }
        .elite-storefront-setup-steps h2 {
            margin-top: 0;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .elite-storefront-setup-steps h3 { margin-top: 0; font-size: 1.2em; }
        .elite-storefront-setup-steps li { margin-bottom: 25px; padding-bottom: 25px; border-bottom: 1px solid #eee; }
        .elite-storefront-setup-steps li:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
    </style>
    <?php
}

// Redirect to Customizer on activation
function elite_storefront_theme_activation_redirect() {
    global $pagenow;
    if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
        wp_redirect( admin_url( 'customize.php' ) );
        exit;
    }
}
add_action( 'admin_init', 'elite_storefront_theme_activation_redirect' );
