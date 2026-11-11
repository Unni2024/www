<?php
  // Exit if accessed directly
  if ( !defined( 'ABSPATH' ) )exit;


  function elite_storefront_settings( $values ) {

    $values[ 'hide_product_cat_search' ]  = false;
    $values[ 'primary_color' ] = '#552fda';
    $values[ 'secondary_color' ] = '#ffdc00';
    $values[ 'heading_font' ] = 'Jost';
    $values[ 'body_font' ] = 'Poppins';

    $values[ 'woo_bar_color' ] = '#fff';
    $values[ 'woo_bar_bg_color' ] = '#562fe2';
    $values[ 'woo_category_title' ] = esc_html__( 'Top Categories', "elite-storefront" );

    $values[ 'preloader_enabled' ] = false;

    $values[ 'logo_width' ] = 130;
    $values[ 'layout_width' ] = 1280;

    $values[ 'header_layout' ] = 'woocommerce-bar';
    $values[ 'menu_layout' ] = 'default';
    $values[ 'enable_search' ] = true;
    $values[ 'ed_social_links' ] = true;

    $values[ 'subscription_shortcode' ] = '';

    $values[ 'enable_top_bar' ] = true;
    $values[ 'top_bar_left_content' ] = 'none';
    $values[ 'top_bar_left_text' ] = esc_html__( 'edit top bar text', "elite-storefront" );
    $values[ 'top_bar_right_content' ] = 'menu_social';
    $values[ 'enable_top_bar' ] = true;
    $values[ 'topbar_bg_color' ] = '#383535';
    $values[ 'topbar_text_color' ] = '#fff';


    $values[ 'footer_text_color' ] = '#fff';
    $values[ 'footer_color' ] = '#000';
    $values[ 'footer_link' ] = 'https://gradientthemes.com/';
    $values[ 'footer_copyright' ] = esc_html__( 'A theme by GradientThemes', "elite-storefront" );
    $values[ 'footer_num_of_colums' ] = 3;
    
    $values[ 'page_sidebar_layout' ] = 'right-sidebar';
    $values[ 'post_sidebar_layout' ] = 'right-sidebar';
    $values[ 'layout_style' ] = 'right-sidebar';
    $values[ 'woo_sidebar_layout' ] = 'left-sidebar';


    return $values;

  }


  add_filter( 'best_shop_settings', 'elite_storefront_settings' );

  /**
   * Sets up theme defaults and registers support for various WordPress features.
   */
  function elite_storefront_setup() {
    load_child_theme_textdomain( 'elite-storefront', get_stylesheet_directory() . '/languages' );
  }
  add_action( 'after_setup_theme', 'elite_storefront_setup' );


  /*
   * Add default header image
   */

  function elite_storefront_header_style() {
    add_theme_support(
      'custom-header',
      apply_filters(
        'elite_storefront_custom_header_args',
        array(
          'default-text-color' => '#000000',
          'width' => 1920,
          'height' => 760,
          'flex-height' => true,
          'video' => true,
          'wp-head-callback' => 'elite_storefront_header_style',
        )
      )
    );
    add_theme_support( 'automatic-feed-links' );
  }

  add_action( 'after_setup_theme', 'elite_storefront_header_style' );


  //  PARENT ACTION

    function elite_storefront_cfg_locale_css( $uri ) {
      if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
        $uri = get_template_directory_uri() . '/rtl.css';
      return $uri;
    }

  add_filter( 'locale_stylesheet_uri', 'elite_storefront_cfg_locale_css' );

    function elite_storefront_cfg_parent_css() {
      wp_enqueue_style( 'elite_storefront_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array() );
    }

  add_action( 'wp_enqueue_scripts', 'elite_storefront_cfg_parent_css', 10 );

  
  // Add prealoder js
  function elite_storefront_custom_scripts() {
    wp_enqueue_script( "elite-storefront", get_stylesheet_directory_uri() . '/assests/preloader.js', array( 'jquery' ), '', true );
    wp_enqueue_style( 'elite-storefront-swiper-css', get_stylesheet_directory_uri() . '/home-sections/assests/swiper-bundle.min.css', array(), '11.0.0' );
    wp_enqueue_script( 'elite-storefront-swiper-js', get_stylesheet_directory_uri() . '/home-sections/assests/swiper-bundle.min.js', array(), '11.0.0', true );
    wp_enqueue_style( 'elite-storefront-home-sections-css', get_stylesheet_directory_uri() . '/home-sections/home-sections.css', array('elite-storefront-swiper-css'), '1.0.0' );
    wp_enqueue_script( 'elite-storefront-home-sections-js', get_stylesheet_directory_uri() . '/home-sections/home-sections.js', array( 'jquery', 'elite-storefront-swiper-js' ), '1.0.0', true );
  }

  // Load home section settings and content
  require_once get_stylesheet_directory() . '/home-sections/home-sections.php';
  require_once get_stylesheet_directory() . '/home-sections/settings.php';
  require_once get_stylesheet_directory() . '/home-sections/tutorial.php';
 

  add_action( 'wp_enqueue_scripts', 'elite_storefront_custom_scripts' );

  // END ENQUEUE PARENT ACTION

    function elite_storefront_customize_register( $wp_customize ) {

    
      //preloader
      $wp_customize->add_section(
        'preloader_settings',
        array(
          'title' => esc_html__( 'Preloader', "elite-storefront" ),
          'priority' => 200,
          'capability' => 'edit_theme_options',
          'panel' => 'theme_options',

        )
      );

      $wp_customize->add_setting(
        'preloader_enabled',
        array(
          'default' => best_shop_default_settings( 'preloader_enabled' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
          'transport' => 'refresh'
        )
      );

      $wp_customize->add_control(
        'preloader_enabled',
        array(
          'label' => esc_html__( 'Enable Preloader', "elite-storefront" ),
          'section' => 'preloader_settings',
          'type' => 'checkbox',
        )
      );

      // Add 'Home sections' to Homepage Settings options
      $show_on_front = $wp_customize->get_control( 'show_on_front' );
      if ( $show_on_front ) {
          $choices = $show_on_front->choices;
          $choices['home_sections'] = esc_html__( 'Home sections only', 'elite-storefront' );
          $show_on_front->choices = $choices;
      }

    }
  add_action( 'customize_register', 'elite_storefront_customize_register' );
 
  // Add swiper-slide class to WooCommerce products in our custom sliders
  add_filter( 'woocommerce_post_class', function( $classes, $product ) {
      if ( isset( $GLOBALS['is_elite_slider'] ) && $GLOBALS['is_elite_slider'] ) {
          $classes[] = 'swiper-slide';
      }
      return $classes;
  }, 10, 2 );

  // Ensure woocommerce body class is present on home sections so that styles don't break
  add_filter( 'body_class', function( $classes ) {
      if ( class_exists( 'WooCommerce' ) && ( is_front_page() || is_home() ) ) {
          if ( ! in_array( 'woocommerce', $classes ) ) {
              $classes[] = 'woocommerce';
          }
          if ( ! in_array( 'woocommerce-page', $classes ) ) {
              $classes[] = 'woocommerce-page';
          }
      }
      return $classes;
  } );

  /**
   * Register widget area.
   *
   * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
   */
  function elite_storefront_widgets_init() {
  	register_sidebar(
  		array(
  			'name'          => esc_html__( 'Advanced Footer Widget 1', 'elite-storefront' ),
  			'id'            => 'advanced-footer-widget-1',
  			'description'   => esc_html__( 'Add widgets here.', 'elite-storefront' ),
  			'before_widget' => '<section id="%1$s" class="widget %2$s">',
  			'after_widget'  => '</section>',
  			'before_title'  => '<h4 class="widget-title">',
  			'after_title'   => '</h4>',
  		)
  	);
  	register_sidebar(
  		array(
  			'name'          => esc_html__( 'Advanced Footer Widget 2', 'elite-storefront' ),
  			'id'            => 'advanced-footer-widget-2',
  			'description'   => esc_html__( 'Add widgets here.', 'elite-storefront' ),
  			'before_widget' => '<section id="%1$s" class="widget %2$s">',
  			'after_widget'  => '</section>',
  			'before_title'  => '<h4 class="widget-title">',
  			'after_title'   => '</h4>',
  		)
  	);
  	register_sidebar(
  		array(
  			'name'          => esc_html__( 'Advanced Footer Widget 3', 'elite-storefront' ),
  			'id'            => 'advanced-footer-widget-3',
  			'description'   => esc_html__( 'Add widgets here.', 'elite-storefront' ),
  			'before_widget' => '<section id="%1$s" class="widget %2$s">',
  			'after_widget'  => '</section>',
  			'before_title'  => '<h4 class="widget-title">',
  			'after_title'   => '</h4>',
  		)
  	);
  	register_sidebar(
  		array(
  			'name'          => esc_html__( 'Advanced Footer Widget 4', 'elite-storefront' ),
  			'id'            => 'advanced-footer-widget-4',
  			'description'   => esc_html__( 'Add widgets here.', 'elite-storefront' ),
  			'before_widget' => '<section id="%1$s" class="widget %2$s">',
  			'after_widget'  => '</section>',
  			'before_title'  => '<h4 class="widget-title">',
  			'after_title'   => '</h4>',
  		)
  	);
  }
  add_action( 'widgets_init', 'elite_storefront_widgets_init' );

