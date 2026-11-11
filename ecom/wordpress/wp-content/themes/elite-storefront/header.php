<?php
/**
 * Theme Header
 *
 * @hooked best_shop_doctype
 */
do_action( 'best_shop_doctype' );
?>

<head itemscope itemtype="https://schema.org/WebSite">
<?php
/**
 * Before wp_head
 *
 * @hooked best_shop_head
 */
do_action( 'best_shop_before_wp_head' );
wp_head();
?>
</head>

<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">
<?php
wp_body_open();

/**
 * Before Header
 *
 * @hooked best_shop_page_start
 */
do_action( 'best_shop_before_header' );

/* =========================================================
 * HEADER LAYOUT RESOLUTION
 * ======================================================= */

$best_shop_header_layout = best_shop_get_header_style();

if ( $best_shop_header_layout === 'customizer-setting' || $best_shop_header_layout === '' ) {
  $best_shop_header_layout = best_shop_get_setting( 'header_layout' );
}

if ( ! class_exists( 'WooCommerce' ) && $best_shop_header_layout === 'woocommerce-bar' ) {
  $best_shop_header_layout = 'default';
}
?>

<header id="masthead"
        class="site-header style-one
        <?php
          if ( $best_shop_header_layout === 'transparent-header' ) {
            echo esc_attr( $best_shop_header_layout );
          }
          if ( $best_shop_header_layout === 'woocommerce-bar' ) {
            echo esc_attr( ' header-no-border hide-menu-cart ' );
          }
        ?>"
        itemscope itemtype="https://schema.org/WPHeader">

  <?php if ( best_shop_get_setting( 'enable_top_bar' ) ) : ?>
  <!-- ================= TOP BAR ================= -->
  <div class="top-bar-menu">
    <div class="container">

      <div class="left-menu">
        <?php
        if ( best_shop_get_setting( 'top_bar_left_content' ) === 'menu' ) {

          wp_nav_menu( array(
            'container_class' => 'top-bar-menu',
            'theme_location'  => 'top-bar-left-menu',
            'depth'           => 1,
          ) );

        } elseif ( best_shop_get_setting( 'top_bar_left_content' ) === 'contacts' ) {
        ?>
          <ul>
            <?php if ( best_shop_get_setting( 'phone_number' ) ) : ?>
              <li><?php echo esc_html( best_shop_get_setting( 'phone_title' ) . best_shop_get_setting( 'phone_number' ) ); ?></li>
            <?php endif; ?>

            <?php if ( best_shop_get_setting( 'address' ) ) : ?>
              <li><?php echo esc_html( best_shop_get_setting( 'address_title' ) . best_shop_get_setting( 'address' ) ); ?></li>
            <?php endif; ?>

            <?php if ( best_shop_get_setting( 'mail_description' ) ) : ?>
              <li><?php echo esc_html( best_shop_get_setting( 'mail_title' ) . best_shop_get_setting( 'mail_description' ) ); ?></li>
            <?php endif; ?>
          </ul>
        <?php
        } elseif ( best_shop_get_setting( 'top_bar_left_content' ) === 'text' ) {
        ?>
          <ul>
            <li><?php echo esc_html( best_shop_get_setting( 'top_bar_left_text' ) ); ?></li>
          </ul>
        <?php } ?>
      </div>

      <div class="right-menu">
        <?php
        if ( best_shop_get_setting( 'top_bar_right_content' ) === 'menu' ) {

          wp_nav_menu( array(
            'container_class' => 'top-bar-menu',
            'theme_location'  => 'top-bar-right-menu',
            'depth'           => 1,
          ) );

        } elseif ( best_shop_get_setting( 'top_bar_right_content' ) === 'social' ) {

          best_shop_social_links( true );

        } elseif ( best_shop_get_setting( 'top_bar_right_content' ) === 'menu_social' ) {

          wp_nav_menu( array(
            'container_class' => 'top-bar-menu',
            'theme_location'  => 'top-bar-right-menu',
            'depth'           => 1,
          ) );

          best_shop_social_links( true );
        }
        ?>
      </div>

    </div>
  </div>
  <?php endif; ?>
  <!-- =============== END TOP BAR =============== -->

  <!-- ================= MAIN HEADER ================= -->
  <div class="<?php echo ( best_shop_get_setting( 'menu_layout' ) === 'default' ) ? 'main-menu-wrap' : 'burger-banner'; ?>">
    <div class="container">
      <div class="header-wrapper">

        <?php best_shop_site_branding(); ?>

        <div class="nav-wrap">
          <?php if ( best_shop_get_setting( 'menu_layout' ) === 'default' ) : ?>
            <div class="header-left">
              <?php best_shop_primary_navigation(); ?>
            </div>
            <div class="header-right">
              <?php best_shop_header_search(); ?>
            </div>
          <?php else : ?>
            <div class="banner header-right">
              <img src="<?php echo esc_url( best_shop_get_setting( 'header_banner_img' ) ); ?>" alt="">
            </div>
          <?php endif; ?>
        </div>

      </div>
    </div>
  </div>
  <!-- =============== END MAIN HEADER =============== -->

  <?php if ( best_shop_get_setting( 'menu_layout' ) === 'full_width' ) : ?>
  <!-- ================= BURGER HEADER ================= -->
  <div class="burger main-menu-wrap">
    <div class="container">
      <div class="header-wrapper">
        <div class="nav-wrap">
          <div class="header-left">
            <?php best_shop_primary_navigation(); ?>
          </div>
          <div class="header-right">
            <?php best_shop_header_search(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>

  <?php
  /* ================= MOBILE NAVIGATION ================= */
  best_shop_mobile_navigation();

  /* ================= WOOCOMMERCE BAR ================= */
  if ( class_exists( 'WooCommerce' ) && $best_shop_header_layout === 'woocommerce-bar' ) :
  ?>
    <div class="woocommerce-bar">
      <nav>
        <div class="container">
          <?php
          best_shop_product_category_list();
          best_shop_product_search();
          best_shop_cart_wishlist_myacc();
          ?>
        </div>
      </nav>
    </div>
  <?php endif; ?>

</header>
<!-- #masthead -->

<?php
/**
 * Before posts content
 *
 * @hooked best_shop_primary_page_header
 */
do_action( 'best_shop_before_posts_content' );

/* ================= PRELOADER ================= */
if ( best_shop_get_setting( 'preloader_enabled' ) ) :
?>
  <div class="preloader-center">
    <div class="preloader-ring"></div>
    <span><?php echo esc_html__( 'loading...', 'elite-storefront' ); ?></span>
  </div>
<?php endif; ?>
