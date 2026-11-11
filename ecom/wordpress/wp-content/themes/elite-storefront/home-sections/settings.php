<?php

function elite_storefront_home_sections_customize_register( $wp_customize ) {

      $wp_customize->add_panel(
        'home_sections_panel',
        array(
          'title'       => esc_html__( 'HOME SECTIONS', 'elite-storefront' ),          
          'description' => esc_html__( 'Home sections are displayed in home page. You can show/hide each section.', "elite-storefront" ),
          'priority'    => 10,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_section(
        'home_sections',
        array(
          'title'       => esc_html__( 'Hero Slider (Product)', 'elite-storefront' ),
          'description' => esc_html__( 'Select Product category, Number of products to display', "elite-storefront" ), 
          'panel'       => 'home_sections_panel',
          'priority'    => 10,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'home_slider_priority',
        array(
          'default' => elite_storefront_home_default_settings( 'home_slider_priority' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'home_slider_priority',
        array(
          'label' => esc_html__( 'Section Priority (Order)', "elite-storefront" ),
          'description' => esc_html__( 'The lower value above in home sections', "elite-storefront" ), 
          'section' => 'home_sections',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'home_slider_enable',
        array(
          'default' => elite_storefront_home_default_settings( 'home_slider_enable' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
        )
      );
      $wp_customize->add_control(
        'home_slider_enable',
        array(
          'label' => esc_html__( 'Enable Hero Slider', "elite-storefront" ),
          'section' => 'home_sections',
          'type' => 'checkbox',
        )
      );

      $wp_customize->add_setting(
        'home_slider_count',
        array(
          'default' => elite_storefront_home_default_settings( 'home_slider_count' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'home_slider_count',
        array(
          'label' => esc_html__( 'Number of products to display', "elite-storefront" ),
          'section' => 'home_sections',
          'type' => 'number',
        )
      );

      $categories = array();
      if ( class_exists( 'WooCommerce' ) ) {
        $terms = get_terms( 'product_cat', array( 'hide_empty' => false ) );
        if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
          $categories[''] = esc_html__( 'All Categories', 'elite-storefront' );
          foreach ( $terms as $term ) {
            $categories[ $term->slug ] = $term->name;
          }
        }
      }

      $wp_customize->add_setting(
        'home_slider_category',
        array(
          'default' => elite_storefront_home_default_settings( 'home_slider_category' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'home_slider_category',
        array(
          'label' => esc_html__( 'Select product category', "elite-storefront" ),
          'section' => 'home_sections',
          'type' => 'select',
          'choices' => $categories,
        )
      );

      $wp_customize->add_setting(
        'home_slider_height',
        array(
          'default' => elite_storefront_home_default_settings( 'home_slider_height' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'home_slider_height',
        array(
          'label' => esc_html__( 'Maximum height (px)', "elite-storefront" ),
          'section' => 'home_sections',
          'type' => 'number',
        )
      );

      $wp_customize->add_section(
        'product_slider_section',
        array(
          'title'       => esc_html__( 'Product Attribute Slider', 'elite-storefront' ),
          'panel'       => 'home_sections_panel',
          'priority'    => 20,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'product_slider_priority',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_priority' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'product_slider_priority',
        array(
          'label' => esc_html__( 'Section Priority (Order)', "elite-storefront" ),
                      'description' => esc_html__( 'The lower value above in home sections', "elite-storefront" ), 

          'section' => 'product_slider_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'product_slider_enable',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_enable' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
        )
      );
      $wp_customize->add_control(
        'product_slider_enable',
        array(
          'label' => esc_html__( 'Enable Product Slider', "elite-storefront" ),
          'section' => 'product_slider_section',
          'type' => 'checkbox',
        )
      );

      $wp_customize->add_setting(
        'product_slider_title',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_title' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'product_slider_title',
        array(
          'label' => esc_html__( 'Section Title', "elite-storefront" ),
          'section' => 'product_slider_section',
          'type' => 'text',
        )
      );

 

      $wp_customize->add_setting(
        'product_slider_count',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_count' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'product_slider_count',
        array(
          'label' => esc_html__( 'Number of products to display', "elite-storefront" ),
          'section' => 'product_slider_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'product_slider_per_row',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_per_row' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'product_slider_per_row',
        array(
          'label' => esc_html__( 'Number of slides per row', "elite-storefront" ),
          'section' => 'product_slider_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'product_slider_type',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_type' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'product_slider_type',
        array(
          'label' => esc_html__( 'Select Product Attribute (ex: New, On Sale, Featured...)', "elite-storefront" ),
          'section' => 'product_slider_section',
          'type' => 'select',
          'choices' => array(
            'new' => esc_html__( 'New Arrivals', 'elite-storefront' ),
            'sale' => esc_html__( 'On Sale', 'elite-storefront' ),
            'featured' => esc_html__( 'Featured Products', 'elite-storefront' ),
            'trending' => esc_html__( 'Trending Products', 'elite-storefront' ),
          ),
        )
      );
    
     $wp_customize->add_setting(
        'product_slider_countdown',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_countdown' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'product_slider_countdown',
        array(
          'label' => esc_html__( 'Countdown Timer (Date & Time)', "elite-storefront" ),
          'description' => esc_html__( 'Leave empty to disable. Format: YYYY-MM-DD HH:MM (select date and type the time to work.)', "elite-storefront" ),
          'section' => 'product_slider_section',
          'type' => 'datetime-local',
        )
      );

      $wp_customize->add_section(
        'product_slider_2_section',
        array(
          'title'       => esc_html__( 'Product Attribute Slider (2)', 'elite-storefront' ),
          'panel'       => 'home_sections_panel',
          'priority'    => 21,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'product_slider_2_priority',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_2_priority' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'product_slider_2_priority',
        array(
          'label' => esc_html__( 'Section Priority (Order)', "elite-storefront" ),
          'description' => esc_html__( 'The lower value above in home sections', "elite-storefront" ), 
          'section' => 'product_slider_2_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'product_slider_2_enable',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_2_enable' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
        )
      );
      $wp_customize->add_control(
        'product_slider_2_enable',
        array(
          'label' => esc_html__( 'Enable Product Slider (2)', "elite-storefront" ),
          'section' => 'product_slider_2_section',
          'type' => 'checkbox',
        )
      );

      $wp_customize->add_setting(
        'product_slider_2_title',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_2_title' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'product_slider_2_title',
        array(
          'label' => esc_html__( 'Section Title', "elite-storefront" ),
          'section' => 'product_slider_2_section',
          'type' => 'text',
        )
      );


      $wp_customize->add_setting(
        'product_slider_2_count',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_2_count' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'product_slider_2_count',
        array(
          'label' => esc_html__( 'Number of products to display', "elite-storefront" ),
          'section' => 'product_slider_2_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'product_slider_2_per_row',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_2_per_row' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'product_slider_2_per_row',
        array(
          'label' => esc_html__( 'Number of slides per row', "elite-storefront" ),
          'section' => 'product_slider_2_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'product_slider_2_type',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_2_type' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'product_slider_2_type',
        array(
          'label' => esc_html__( 'Select Product Attribute, ex: New, On Sale, Featured...', "elite-storefront" ),
          'section' => 'product_slider_2_section',
          'type' => 'select',
          'choices' => array(
            'new' => esc_html__( 'New Arrivals', 'elite-storefront' ),
            'sale' => esc_html__( 'On Sale', 'elite-storefront' ),
            'featured' => esc_html__( 'Featured Products', 'elite-storefront' ),
            'trending' => esc_html__( 'Trending Products', 'elite-storefront' ),
          ),
        )
      );
    

      $wp_customize->add_setting(
        'product_slider_2_countdown',
        array(
          'default' => elite_storefront_home_default_settings( 'product_slider_2_countdown' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'product_slider_2_countdown',
        array(
          'label' => esc_html__( 'Countdown Timer (Date & Time)', "elite-storefront" ),
          'description' => esc_html__( 'Leave empty to disable. Format: YYYY-MM-DD HH:MM (select date and type the time to work.)', "elite-storefront" ),
          'section' => 'product_slider_2_section',
          'type' => 'datetime-local',
        )
      );

      $wp_customize->add_section(
        'post_slider_section',
        array(
          'title'       => esc_html__( 'Post Slider', 'elite-storefront' ),
          'description' => esc_html__( 'Select post category, Each post featured image and title will be displayed.', "elite-storefront" ),
          'panel'       => 'home_sections_panel',
          'priority'    => 24,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'post_slider_priority',
        array(
          'default' => elite_storefront_home_default_settings( 'post_slider_priority' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'post_slider_priority',
        array(
          'label' => esc_html__( 'Section Priority (Order)', "elite-storefront" ),
          'description' => esc_html__( 'The lower value above in home sections', "elite-storefront" ), 
          'section' => 'post_slider_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'post_slider_enable',
        array(
          'default' => elite_storefront_home_default_settings( 'post_slider_enable' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
        )
      );
      $wp_customize->add_control(
        'post_slider_enable',
        array(
          'label' => esc_html__( 'Enable Post Slider', "elite-storefront" ),
          'section' => 'post_slider_section',
          'type' => 'checkbox',
        )
      );

      $wp_customize->add_setting(
        'post_slider_count',
        array(
          'default' => elite_storefront_home_default_settings( 'post_slider_count' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'post_slider_count',
        array(
          'label' => esc_html__( 'Number of posts to display', "elite-storefront" ),
          'section' => 'post_slider_section',
          'type' => 'number',
        )
      );

      $post_categories = array();
      $post_terms = get_terms( 'category', array( 'hide_empty' => false ) );
      if ( ! is_wp_error( $post_terms ) && ! empty( $post_terms ) ) {
        $post_categories[''] = esc_html__( 'All Categories', 'elite-storefront' );
        foreach ( $post_terms as $term ) {
          $post_categories[ $term->slug ] = $term->name;
        }
      }

      $wp_customize->add_setting(
        'post_slider_category',
        array(
          'default' => elite_storefront_home_default_settings( 'post_slider_category' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'post_slider_category',
        array(
          'label' => esc_html__( 'Select post category', "elite-storefront" ),
          'section' => 'post_slider_section',
          'type' => 'select',
          'choices' => $post_categories,
        )
      );

      $wp_customize->add_setting(
        'post_slider_bg_color',
        array(
          'default' => elite_storefront_home_default_settings( 'post_slider_bg_color' ),
          'sanitize_callback' => 'sanitize_hex_color',
        )
      );
      $wp_customize->add_control(
        new WP_Customize_Color_Control(
          $wp_customize,
          'post_slider_bg_color',
          array(
            'label' => esc_html__( 'Right Content Background Color', 'elite-storefront' ),
            'section' => 'post_slider_section',
          )
        )
      );

      $wp_customize->add_section(
        'product_cat_slider_section',
        array(
          'title'       => esc_html__( 'Product Category Slider', 'elite-storefront' ),
          'panel'       => 'home_sections_panel',
          'priority'    => 25,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'product_cat_slider_priority',
        array(
          'default' => elite_storefront_home_default_settings( 'product_cat_slider_priority' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'product_cat_slider_priority',
        array(
          'label' => esc_html__( 'Section Priority (Order)', "elite-storefront" ),
                      'description' => esc_html__( 'The lower value above in home sections', "elite-storefront" ), 

          'section' => 'product_cat_slider_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'product_cat_slider_enable',
        array(
          'default' => elite_storefront_home_default_settings( 'product_cat_slider_enable' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
        )
      );
      $wp_customize->add_control(
        'product_cat_slider_enable',
        array(
          'label' => esc_html__( 'Enable Category Slider', "elite-storefront" ),
          'section' => 'product_cat_slider_section',
          'type' => 'checkbox',
        )
      );

      $wp_customize->add_setting(
        'product_cat_slider_title',
        array(
          'default' => elite_storefront_home_default_settings( 'product_cat_slider_title' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'product_cat_slider_title',
        array(
          'label' => esc_html__( 'Section Title', "elite-storefront" ),
          'section' => 'product_cat_slider_section',
          'type' => 'text',
        )
      );

      $wp_customize->add_setting(
        'product_cat_slider_count',
        array(
          'default' => elite_storefront_home_default_settings( 'product_cat_slider_count' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'product_cat_slider_count',
        array(
          'label' => esc_html__( 'Number of products to display', "elite-storefront" ),
          'section' => 'product_cat_slider_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'product_cat_slider_per_row',
        array(
          'default' => elite_storefront_home_default_settings( 'product_cat_slider_per_row' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'product_cat_slider_per_row',
        array(
          'label' => esc_html__( 'Number of slides per row', "elite-storefront" ),
          'section' => 'product_cat_slider_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'product_cat_slider_category',
        array(
          'default' => elite_storefront_home_default_settings( 'product_cat_slider_category' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'product_cat_slider_category',
        array(
          'label' => esc_html__( 'Select product category', "elite-storefront" ),
          'section' => 'product_cat_slider_section',
          'type' => 'select',
          'choices' => $categories,
        )
      );

      $wp_customize->add_setting(
        'product_cat_slider_category_2',
        array(
          'default' => elite_storefront_home_default_settings( 'product_cat_slider_category_2' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'product_cat_slider_category_2',
        array(
          'label' => esc_html__( 'Select second product category (optional)', "elite-storefront" ),
          'section' => 'product_cat_slider_section',
          'type' => 'select',
          'choices' => $categories,
        )
      );

      $wp_customize->add_section(
        'custom_page_section_2',
        array(
          'title'       => esc_html__( 'Custom Page Section 1', 'elite-storefront' ),
          'description' => esc_html__( 'Select a page to display on home page section.', 'elite-storefront' ),
          'panel'       => 'home_sections_panel',
          'priority'    => 27,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'home_custom_page_2_priority',
        array(
          'default' => elite_storefront_home_default_settings( 'home_custom_page_2_priority' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'home_custom_page_2_priority',
        array(
          'label' => esc_html__( 'Section Priority (Order)', "elite-storefront" ),
                      'description' => esc_html__( 'The lower value above in home sections', "elite-storefront" ), 

          'section' => 'custom_page_section_2',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'home_custom_page_2_enable',
        array(
          'default' => elite_storefront_home_default_settings( 'home_custom_page_2_enable' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
        )
      );
      $wp_customize->add_control(
        'home_custom_page_2_enable',
        array(
          'label' => esc_html__( 'Enable Custom Page Section 1', "elite-storefront" ),
          'section' => 'custom_page_section_2',
          'type' => 'checkbox',
        )
      );

      $wp_customize->add_setting(
        'home_custom_page_2_title',
        array(
          'default' => elite_storefront_home_default_settings( 'home_custom_page_2_title' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'home_custom_page_2_title',
        array(
          'label' => esc_html__( 'Section Title', "elite-storefront" ),
          'section' => 'custom_page_section_2',
          'type' => 'text',
        )
      );

      $wp_customize->add_setting(
        'home_custom_page_2_id',
        array(
          'default' => elite_storefront_home_default_settings( 'home_custom_page_2_id' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'home_custom_page_2_id',
        array(
          'label' => esc_html__( 'Select Page', "elite-storefront" ),
          'section' => 'custom_page_section_2',
          'type' => 'dropdown-pages',
        )
      );

      $wp_customize->add_section(
        'blog_section',
        array(
          'title'       => esc_html__( 'Blog Section', 'elite-storefront' ),
        'description' => esc_html__( 'Select post category with featured image. Image and title will be displayed.', "elite-storefront" ),  

          'panel'       => 'home_sections_panel',
          'priority'    => 29,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'home_blog_enable',
        array(
          'default' => elite_storefront_home_default_settings( 'home_blog_enable' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
        )
      );
      $wp_customize->add_control(
        'home_blog_enable',
        array(
          'label' => esc_html__( 'Enable Blog Section', "elite-storefront" ),
          'section' => 'blog_section',
          'type' => 'checkbox',
        )
      );

      $wp_customize->add_setting(
        'home_blog_title',
        array(
          'default' => elite_storefront_home_default_settings( 'home_blog_title' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'home_blog_title',
        array(
          'label' => esc_html__( 'Section Title', "elite-storefront" ),
          'section' => 'blog_section',
          'type' => 'text',
        )
      );

      $wp_customize->add_setting(
        'home_blog_count',
        array(
          'default' => elite_storefront_home_default_settings( 'home_blog_count' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'home_blog_count',
        array(
          'label' => esc_html__( 'Number of posts to display', "elite-storefront" ),
          'section' => 'blog_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_section(
        'home_banner_section',
        array(
          'title'       => esc_html__( 'Banner Section', 'elite-storefront' ),
        'description' => esc_html__( 'Selectected images are displayed in this section.', "elite-storefront" ),  

          'panel'       => 'home_sections_panel',
          'priority'    => 26,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'home_banner_priority',
        array(
          'default' => elite_storefront_home_default_settings( 'home_banner_priority' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'home_banner_priority',
        array(
          'label' => esc_html__( 'Section Priority (Order)', "elite-storefront" ),
          'description' => esc_html__( 'The lower value above in home sections', "elite-storefront" ), 
          'section' => 'home_banner_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'home_banner_enable',
        array(
          'default' => elite_storefront_home_default_settings( 'home_banner_enable' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
        )
      );
      $wp_customize->add_control(
        'home_banner_enable',
        array(
          'label' => esc_html__( 'Enable Banner Section', "elite-storefront" ),
          'section' => 'home_banner_section',
          'type' => 'checkbox',
        )
      );

      for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_setting(
          'home_banner_image_' . $i,
          array(
            'default' => elite_storefront_home_default_settings( 'home_banner_image_' . $i ),
            'sanitize_callback' => 'esc_url_raw',
          )
        );
        $wp_customize->add_control(
          new WP_Customize_Image_Control(
            $wp_customize,
            'home_banner_image_' . $i,
            array(
              'label' => sprintf( esc_html__( 'Banner Image %d', 'elite-storefront' ), $i ),
              'section' => 'home_banner_section',
            )
          )
        );
      }

      $wp_customize->add_section(
        'custom_page_section',
        array(
          'title'       => esc_html__( 'Custom Page Section 2', 'elite-storefront' ),
          'description' => esc_html__( 'Show content from the selected page on the home page. Shop page is suitable for storefront.', "elite-storefront" ),  

          'panel'       => 'home_sections_panel',
          'priority'    => 28,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'home_custom_page_enable',
        array(
          'default' => elite_storefront_home_default_settings( 'home_custom_page_enable' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
        )
      );
      $wp_customize->add_control(
        'home_custom_page_enable',
        array(
          'label' => esc_html__( 'Enable Custom Page Section 2 (Above footer)', "elite-storefront" ),
          'section' => 'custom_page_section',
          'type' => 'checkbox',
        )
      );

      $wp_customize->add_setting(
        'home_custom_page_title',
        array(
          'default' => elite_storefront_home_default_settings( 'home_custom_page_title' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'home_custom_page_title',
        array(
          'label' => esc_html__( 'Section Title', "elite-storefront" ),
          'section' => 'custom_page_section',
          'type' => 'text',
        )
      );

      $wp_customize->add_setting(
        'home_custom_page_id',
        array(
          'default' => elite_storefront_home_default_settings( 'home_custom_page_id' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'home_custom_page_id',
        array(
          'label' => esc_html__( 'Select Page', "elite-storefront" ),
                      'description' => esc_html__( '(Show content from the selected page on the home page)', "elite-storefront" ),  

          'section' => 'custom_page_section',
          'type' => 'dropdown-pages',
        )
      );

      $wp_customize->add_section(
        'portfolio_section',
        array(
          'title'       => esc_html__( 'Portfolio Section', 'elite-storefront' ),
                      'description' => esc_html__( 'Select post category with featured image. Image and title will be displayed.', "elite-storefront" ),  
          'panel'       => 'home_sections_panel',
          'priority'    => 29,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'home_portfolio_enable',
        array(
          'default' => elite_storefront_home_default_settings( 'home_portfolio_enable' ),
          'sanitize_callback' => 'best_shop_sanitize_checkbox',
        )
      );
      $wp_customize->add_control(
        'home_portfolio_enable',
        array(
          'label' => esc_html__( 'Enable Portfolio Section', "elite-storefront" ),
          'section' => 'portfolio_section',
          'type' => 'checkbox',
        )
      );

      $wp_customize->add_setting(
        'home_portfolio_title',
        array(
          'default' => elite_storefront_home_default_settings( 'home_portfolio_title' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'home_portfolio_title',
        array(
          'label' => esc_html__( 'Section Title', "elite-storefront" ),
          'section' => 'portfolio_section',
          'type' => 'text',
        )
      );
      
      $post_categories = array();
      $p_terms = get_terms( 'category', array( 'hide_empty' => false ) );
      if ( ! is_wp_error( $p_terms ) && ! empty( $p_terms ) ) {
        $post_categories[''] = esc_html__( 'All Categories', 'elite-storefront' );
        foreach ( $p_terms as $term ) {
          $post_categories[ $term->slug ] = $term->name;
        }
      }

      $wp_customize->add_setting(
        'home_portfolio_category',
        array(
          'default' => elite_storefront_home_default_settings( 'home_portfolio_category' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'home_portfolio_category',
        array(
          'label' => esc_html__( 'Select post category', "elite-storefront" ),
          'section' => 'portfolio_section',
          'type' => 'select',
          'choices' => $post_categories,
        )
      );

      $wp_customize->add_setting(
        'home_portfolio_columns',
        array(
          'default' => elite_storefront_home_default_settings( 'home_portfolio_columns' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'home_portfolio_columns',
        array(
          'label' => esc_html__( 'Number of columns', "elite-storefront" ),
          'section' => 'portfolio_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_setting(
        'home_portfolio_count',
        array(
          'default' => elite_storefront_home_default_settings( 'home_portfolio_count' ),
          'sanitize_callback' => 'absint',
        )
      );
      $wp_customize->add_control(
        'home_portfolio_count',
        array(
          'label' => esc_html__( 'Number of posts to display', "elite-storefront" ),
          'section' => 'portfolio_section',
          'type' => 'number',
        )
      );

      $wp_customize->add_section(
        'subscribe_section',
        array(
          'title'       => esc_html__( 'Subscribe Section', 'elite-storefront' ),
            
          'panel'       => 'home_sections_panel',
          'priority'    => 30,
          'capability'  => 'edit_theme_options',
        )
      );

      $wp_customize->add_setting(
        'home_subscribe_shortcode',
        array(
          'default' => elite_storefront_home_default_settings( 'home_subscribe_shortcode' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'home_subscribe_shortcode',
        array(
          'label' => esc_html__( 'Subscribe Plugin Shortcode', "elite-storefront" ),
          'section' => 'subscribe_section',
          'type' => 'text',
        )
      );

      $wp_customize->add_setting(
        'home_subscribe_title',
        array(
          'default' => elite_storefront_home_default_settings( 'home_subscribe_title' ),
          'sanitize_callback' => 'sanitize_text_field',
        )
      );
      $wp_customize->add_control(
        'home_subscribe_title',
        array(
          'label' => esc_html__( 'Section Title', "elite-storefront" ),
          'section' => 'subscribe_section',
          'type' => 'text',
        )
      );

      if ( isset( $wp_customize->selective_refresh ) ) {
          $wp_customize->selective_refresh->add_partial( 'home_slider_priority', array(
              'selector' => '#home-section-hero-slider .slider-title',
              'render_callback' => '__return_false',
          ) );
          $wp_customize->selective_refresh->add_partial( 'product_slider_priority', array(
              'selector' => '#home-section-product-slider .home-section-title',
              'render_callback' => '__return_false',
          ) );
          $wp_customize->selective_refresh->add_partial( 'product_slider_2_priority', array(
              'selector' => '#home-section-product-slider-2 .home-section-title',
              'render_callback' => '__return_false',
          ) );
          $wp_customize->selective_refresh->add_partial( 'post_slider_priority', array(
              'selector' => '#home-section-post-slider .post-slider-title',
              'render_callback' => '__return_false',
          ) );
          $wp_customize->selective_refresh->add_partial( 'product_cat_slider_priority', array(
              'selector' => '#home-section-product-cat-slider .home-section-title',
              'render_callback' => '__return_false',
          ) );
          $wp_customize->selective_refresh->add_partial( 'home_custom_page_2_title', array(
              'selector' => '#home-section-custom-page-2 .home-section-title',
              'render_callback' => '__return_false',
          ) );
          $wp_customize->selective_refresh->add_partial( 'home_blog_title', array(
              'selector' => '#home-section-blog .home-section-title',
              'render_callback' => '__return_false',
          ) );
          $wp_customize->selective_refresh->add_partial( 'home_banner_priority', array(
              'selector' => '#home-section-banner .banner-item',
              'render_callback' => '__return_false',
          ) );
          $wp_customize->selective_refresh->add_partial( 'home_custom_page_title', array(
              'selector' => '#home-section-custom-page .home-section-title',
              'render_callback' => '__return_false',
          ) );
          $wp_customize->selective_refresh->add_partial( 'home_portfolio_title', array(
              'selector' => '#home-section-portfolio .home-section-title',
              'render_callback' => '__return_false',
          ) );
          $wp_customize->selective_refresh->add_partial( 'home_subscribe_shortcode', array(
              'selector' => '.elite-storefront-subscribe-section .home-section-title',
              'render_callback' => '__return_false',
          ) );
      }

}
add_action( 'customize_register', 'elite_storefront_home_sections_customize_register' );
