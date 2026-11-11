<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function elite_storefront_home_default_settings( $setting_name ) {
	$defaults = array(
		'home_slider_enable'          => true,
		'home_slider_count'           => 3,
		'home_slider_category'        => '',
		'home_slider_priority'        => 2,
		'home_slider_height'          => 500,
		'product_slider_enable'       => true,
		'product_slider_title'        => '',
		'product_slider_count'        => 6,
		'product_slider_per_row'      => 4,
		'product_slider_type'         => 'recent',
		'product_slider_countdown'    => '',
		'product_slider_priority'     => 5,
		'product_slider_2_enable'       => true,
		'product_slider_2_title'        => '',
		'product_slider_2_count'        => 6,
		'product_slider_2_per_row'      => 4,
		'product_slider_2_type'         => 'recent',
		'product_slider_2_countdown'    => '',
		'product_slider_2_priority'     => 10,
		'post_slider_enable'          => true,
		'post_slider_count'           => 6,
		'post_slider_category'        => '',
		'post_slider_bg_color'        => '#f5f5f5',
		'post_slider_priority'        => 4,
		'product_cat_slider_enable'   => true,
		'product_cat_slider_title'    => '',
		'product_cat_slider_count'    => 6,
		'product_cat_slider_per_row'  => 4,
		'product_cat_slider_category' => '',
		'product_cat_slider_category_2' => '',
		'product_cat_slider_priority' => 15,

		'home_banner_enable'          => true,
		'home_banner_priority'        => 20,
		'home_banner_image_1'         => '',
		'home_banner_image_2'         => '',
		'home_banner_image_3'         => '',
		'home_banner_image_4'         => '',

		'home_custom_page_2_enable'   => false,
		'home_custom_page_2_id'       => '',
		'home_custom_page_2_priority' => 30,
 
		'home_custom_page_enable'     => false,
		'home_custom_page_id'         => '',

		'home_portfolio_enable'       => true,
		'home_portfolio_title'        => '',
		'home_portfolio_category'     => '',
		'home_portfolio_columns'      => 3,
		'home_portfolio_count'        => 6,

		'home_subscribe_shortcode'    => '[newsletter_form]',
		'primary_color'               => '#552fda',
		'secondary_color'             => '#ffdc00',
		'home_blog_enable'            => true,
		'home_blog_count'             => 4,
	);

	if ( $setting_name === 'home_custom_page_2_title' ) {
		return esc_html__( 'Select a page like Services...', 'elite-storefront' );
	}
	if ( $setting_name === 'home_custom_page_title' ) {
		return esc_html__( 'Select a page like Q and A', 'elite-storefront' );
	}
	if ( $setting_name === 'home_portfolio_title' ) {
		return esc_html__( 'Our Portfolio', 'elite-storefront' );
	}
	if ( $setting_name === 'home_subscribe_title' ) {
		return esc_html__( 'Subscribe to our Newsletters', 'elite-storefront' );
	}
	if ( $setting_name === 'home_blog_title' ) {
		return esc_html__( 'Our Latest News & Blogs', 'elite-storefront' );
	}
	if ( $setting_name === 'product_slider_title' ) {
		return esc_html__( 'Our Products', 'elite-storefront' );
	}
	if ( $setting_name === 'product_slider_2_title' ) {
		return esc_html__( 'More Products', 'elite-storefront' );
	}
	if ( $setting_name === 'product_cat_slider_title' ) {
		return esc_html__( 'Shop by Category', 'elite-storefront' );
	}

	return isset( $defaults[ $setting_name ] ) ? $defaults[ $setting_name ] : null;
}

function elite_storefront_home_slider() {
  if ( ! class_exists( 'WooCommerce' ) ) {
    return;
  }

  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $enable = get_theme_mod( 'home_slider_enable', elite_storefront_home_default_settings( 'home_slider_enable' ) );
  if ( ! $enable ) {
    return;
  }

  $count = get_theme_mod( 'home_slider_count', elite_storefront_home_default_settings( 'home_slider_count' ) );
  $category = get_theme_mod( 'home_slider_category', elite_storefront_home_default_settings( 'home_slider_category' ) );
  $height = get_theme_mod( 'home_slider_height', elite_storefront_home_default_settings( 'home_slider_height' ) );

  $args = array(
    'post_type'      => 'product',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
  );

  if ( ! empty( $category ) ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'product_cat',
        'field'    => 'slug',
        'terms'    => $category,
      ),
    );
  }

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    ?>
    <div id="home-section-hero-slider" style="position:relative;">
    <div class="elite-storefront-hero-slider swiper" style="height: <?php echo esc_attr( $height ); ?>px;">
      <div class="swiper-wrapper">
        <?php while ( $query->have_posts() ) : $query->the_post(); global $product; ?>
          <div class="swiper-slide">
            <?php 
              $hero_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
              if ( ! $hero_image ) {
                $hero_image = get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg';
              }
            ?>
            <div class="slider-image" style="background-image: url('<?php echo esc_url( $hero_image ); ?>');">
              <div class="slider-content">
                <h2 class="slider-title" style="font-size: 3em; margin-bottom: 15px; font-weight: bold;"><?php the_title(); ?></h2>
                <div class="slider-price" style="font-size: 1.5em; margin-bottom: 25px;"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
                <a href="<?php the_permalink(); ?>" class="button slider-button"><?php esc_html_e( 'Shop Now', 'elite-storefront' ); ?></a>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
      <div class="swiper-pagination"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
    </div>
    <?php
    wp_reset_postdata();
  }
}
add_action( 'best_shop_before_posts_content', 'elite_storefront_home_slider', get_theme_mod( 'home_slider_priority', elite_storefront_home_default_settings( 'home_slider_priority' ) ) );


function elite_storefront_product_slider() {
  if ( ! class_exists( 'WooCommerce' ) ) {
    return;
  }

  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $enable = get_theme_mod( 'product_slider_enable', elite_storefront_home_default_settings( 'product_slider_enable' ) );
  if ( ! $enable ) {
    return;
  }

  $title = get_theme_mod( 'product_slider_title', elite_storefront_home_default_settings( 'product_slider_title' ) );
  $count = get_theme_mod( 'product_slider_count', elite_storefront_home_default_settings( 'product_slider_count' ) );
  $per_row = get_theme_mod( 'product_slider_per_row', elite_storefront_home_default_settings( 'product_slider_per_row' ) );
  $type = get_theme_mod( 'product_slider_type', elite_storefront_home_default_settings( 'product_slider_type' ) );

  $args = array(
    'post_type'      => 'product',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
  );

  if ( $type === 'sale' ) {
    $args['meta_query'] = WC()->query->get_meta_query();
    $args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
  } elseif ( $type === 'featured' ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'product_visibility',
        'field'    => 'name',
        'terms'    => 'featured',
        'operator' => 'IN',
      ),
    );
  } elseif ( $type === 'trending' ) {
    $args['meta_key'] = 'total_sales';
    $args['orderby'] = 'meta_value_num';
  } else {
    // new arrivals
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
  }

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    ?>
    <div class="container" id="home-section-product-slider" style="position:relative;">
      <?php 
      $countdown = get_theme_mod( 'product_slider_countdown', elite_storefront_home_default_settings( 'product_slider_countdown' ) );
      if ( ! empty( $title ) || ! empty( $countdown ) ) : ?>
        <div class="slider-header-wrapper" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; margin-top: 25px;">
          <?php if ( ! empty( $title ) ) : ?>
            <h2 class="home-section-title" style="margin: 0; text-align: left;"><?php echo esc_html( $title ); ?></h2>
          <?php else: ?>
            <div></div>
          <?php endif; ?>
          
          <?php if ( ! empty( $countdown ) ) : ?>
            <div class="product-slider-countdown" data-date="<?php echo esc_attr( $countdown ); ?>">
              <div class="countdown-item"><span class="days">00</span> <small>Days</small></div>
              <div class="countdown-item"><span class="hours">00</span> <small>Hrs</small></div>
              <div class="countdown-item"><span class="minutes">00</span> <small>Min</small></div>
              <div class="countdown-item"><span class="seconds">00</span> <small>Sec</small></div>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    <div class="elite-storefront-product-slider swiper" style="padding:20px 0;" data-per-row="<?php echo esc_attr( $per_row ); ?>">
      <ul class="swiper-wrapper products">
        <?php 
        $GLOBALS['is_elite_slider'] = true;
        while ( $query->have_posts() ) : $query->the_post(); 
          wc_get_template_part( 'content', 'product' ); 
        endwhile; 
        $GLOBALS['is_elite_slider'] = false;
        ?>
      </ul>

      <div class="swiper-button-prev-product" style="position: absolute; top: 50%; left: 10px; z-index: 10; cursor: pointer; color: #552fda; transform: translateY(-50%); font-size: 24px;">&#10094;</div>
      <div class="swiper-button-next-product" style="position: absolute; top: 50%; right: 10px; z-index: 10; cursor: pointer; color: #552fda; transform: translateY(-50%); font-size: 24px;">&#10095;</div>
    </div> 
    </div>
    <?php if ( ! empty( $countdown ) ) : ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var countdownEl = document.querySelector('.product-slider-countdown');
          if (countdownEl) {
            var dateStr = countdownEl.getAttribute('data-date');
            var targetDate = new Date(dateStr).getTime();
            if (isNaN(targetDate)) {
              // Fallback for Safari
              targetDate = new Date(dateStr.replace(/-/g, '/').replace('T', ' ')).getTime();
            }
            if (!isNaN(targetDate)) {
              var interval = setInterval(function() {
                var now = new Date().getTime();
                var distance = targetDate - now;

                if (distance < 0) {
                  clearInterval(interval);
                  countdownEl.style.display = 'none';
                  return;
                }

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownEl.querySelector('.days').innerText = days < 10 ? '0' + days : days;
                countdownEl.querySelector('.hours').innerText = hours < 10 ? '0' + hours : hours;
                countdownEl.querySelector('.minutes').innerText = minutes < 10 ? '0' + minutes : minutes;
                countdownEl.querySelector('.seconds').innerText = seconds < 10 ? '0' + seconds : seconds;
              }, 1000);
            } else {
               countdownEl.style.display = 'none';
            }
          }
        });
      </script>
    <?php endif; ?>
    <?php
    wp_reset_postdata();
  }
}
add_action( 'best_shop_before_posts_content', 'elite_storefront_product_slider', get_theme_mod( 'product_slider_priority', elite_storefront_home_default_settings( 'product_slider_priority' ) ) );

function elite_storefront_product_slider_2() {
  if ( ! class_exists( 'WooCommerce' ) ) {
    return;
  }

  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $enable = get_theme_mod( 'product_slider_2_enable', elite_storefront_home_default_settings( 'product_slider_2_enable' ) );
  if ( ! $enable ) {
    return;
  }

  $title = get_theme_mod( 'product_slider_2_title', elite_storefront_home_default_settings( 'product_slider_2_title' ) );
  $count = get_theme_mod( 'product_slider_2_count', elite_storefront_home_default_settings( 'product_slider_2_count' ) );
  $per_row = get_theme_mod( 'product_slider_2_per_row', elite_storefront_home_default_settings( 'product_slider_2_per_row' ) );
  $type = get_theme_mod( 'product_slider_2_type', elite_storefront_home_default_settings( 'product_slider_2_type' ) );

  $args = array(
    'post_type'      => 'product',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
  );

  if ( $type === 'sale' ) {
    $args['meta_query'] = WC()->query->get_meta_query();
    $args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
  } elseif ( $type === 'featured' ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'product_visibility',
        'field'    => 'name',
        'terms'    => 'featured',
        'operator' => 'IN',
      ),
    );
  } elseif ( $type === 'trending' ) {
    $args['meta_key'] = 'total_sales';
    $args['orderby'] = 'meta_value_num';
  } else {
    // new arrivals
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
  }

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    ?>
    <div class="container" id="home-section-product-slider-2" style="position:relative;">
      <?php 
      $countdown = get_theme_mod( 'product_slider_2_countdown', elite_storefront_home_default_settings( 'product_slider_2_countdown' ) );
      if ( ! empty( $title ) || ! empty( $countdown ) ) : ?>
        <div class="slider-header-wrapper" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; margin-top: 25px;">
          <?php if ( ! empty( $title ) ) : ?>
            <h2 class="home-section-title" style="margin: 0; text-align: left;"><?php echo esc_html( $title ); ?></h2>
          <?php else: ?>
            <div></div>
          <?php endif; ?>
          
          <?php if ( ! empty( $countdown ) ) : ?>
            <div class="product-slider-countdown product-slider-2-countdown" data-date="<?php echo esc_attr( $countdown ); ?>">
              <div class="countdown-item"><span class="days">00</span> <small>Days</small></div>
              <div class="countdown-item"><span class="hours">00</span> <small>Hrs</small></div>
              <div class="countdown-item"><span class="minutes">00</span> <small>Min</small></div>
              <div class="countdown-item"><span class="seconds">00</span> <small>Sec</small></div>
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    <div class="elite-storefront-product-slider-2 swiper" style="padding:20px 0;" data-per-row="<?php echo esc_attr( $per_row ); ?>">
      <ul class="swiper-wrapper products">
        <?php 
        $GLOBALS['is_elite_slider'] = true;
        while ( $query->have_posts() ) : $query->the_post(); 
          wc_get_template_part( 'content', 'product' ); 
        endwhile; 
        $GLOBALS['is_elite_slider'] = false;
        ?>
      </ul>

      <div class="swiper-button-prev-product-2" style="position: absolute; top: 50%; left: 10px; z-index: 10; cursor: pointer; color: #552fda; transform: translateY(-50%); font-size: 24px;">&#10094;</div>
      <div class="swiper-button-next-product-2" style="position: absolute; top: 50%; right: 10px; z-index: 10; cursor: pointer; color: #552fda; transform: translateY(-50%); font-size: 24px;">&#10095;</div>
    </div> 
    </div>
    <?php if ( ! empty( $countdown ) ) : ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          var countdownEl = document.querySelector('.product-slider-2-countdown');
          if (countdownEl) {
            var dateStr = countdownEl.getAttribute('data-date');
            var targetDate = new Date(dateStr).getTime();
            if (isNaN(targetDate)) {
              // Fallback for Safari
              targetDate = new Date(dateStr.replace(/-/g, '/').replace('T', ' ')).getTime();
            }
            if (!isNaN(targetDate)) {
              var interval = setInterval(function() {
                var now = new Date().getTime();
                var distance = targetDate - now;

                if (distance < 0) {
                  clearInterval(interval);
                  countdownEl.style.display = 'none';
                  return;
                }

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                countdownEl.querySelector('.days').innerText = days < 10 ? '0' + days : days;
                countdownEl.querySelector('.hours').innerText = hours < 10 ? '0' + hours : hours;
                countdownEl.querySelector('.minutes').innerText = minutes < 10 ? '0' + minutes : minutes;
                countdownEl.querySelector('.seconds').innerText = seconds < 10 ? '0' + seconds : seconds;
              }, 1000);
            } else {
               countdownEl.style.display = 'none';
            }
          }
        });
      </script>
    <?php endif; ?>
    <?php
    wp_reset_postdata();
  }
}
add_action( 'best_shop_before_posts_content', 'elite_storefront_product_slider_2', get_theme_mod( 'product_slider_2_priority', elite_storefront_home_default_settings( 'product_slider_2_priority' ) ) );

function elite_storefront_post_slider_display() {
  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $enable = get_theme_mod( 'post_slider_enable', elite_storefront_home_default_settings( 'post_slider_enable' ) );
  if ( ! $enable ) {
    return;
  }

  $count = get_theme_mod( 'post_slider_count', elite_storefront_home_default_settings( 'post_slider_count' ) );
  $category = get_theme_mod( 'post_slider_category', elite_storefront_home_default_settings( 'post_slider_category' ) );
  $bg_color = get_theme_mod( 'post_slider_bg_color', elite_storefront_home_default_settings( 'post_slider_bg_color' ) );

  $args = array(
    'post_type'      => 'post',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
    'ignore_sticky_posts' => true,
  );

  if ( ! empty( $category ) ) {
    $args['category_name'] = $category;
  }

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    ?>
    <div class="slider-container-full-width" id="home-section-post-slider" style="position:relative;">
      <div class="elite-storefront-post-slider swiper">
        <div class="swiper-wrapper">
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="swiper-slide">
              <div class="post-slider-item">
                <div class="post-slider-image">
                  <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover;' ) );
                  } else {
                    echo '<img src="' . esc_url( get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg' ) . '" alt="Placeholder" style="width: 100%; height: 100%; object-fit: cover;">';
                  } ?>
                </div>
                <div class="post-slider-content" style="background-color: <?php echo esc_attr( $bg_color ); ?>;">
                  <h3 class="post-slider-title"><?php the_title(); ?></h3>
                  <div class="post-slider-excerpt">
                    <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                  </div>
                  <a href="<?php the_permalink(); ?>" class="button post-slider-button"><?php esc_html_e( 'Read More', 'elite-storefront' ); ?></a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
        <div class="swiper-button-prev-post" style="position: absolute; top: 50%; left: 10px; z-index: 10; cursor: pointer; color: #552fda; transform: translateY(-50%); font-size: 24px;">&#10094;</div>
        <div class="swiper-button-next-post" style="position: absolute; top: 50%; right: 10px; z-index: 10; cursor: pointer; color: #552fda; transform: translateY(-50%); font-size: 24px;">&#10095;</div>
      </div>
    </div>
    <?php
    wp_reset_postdata();
  }
}
add_action( 'best_shop_before_posts_content', 'elite_storefront_post_slider_display', get_theme_mod( 'post_slider_priority', elite_storefront_home_default_settings( 'post_slider_priority' ) ) );

function elite_storefront_product_category_slider() {
  if ( ! class_exists( 'WooCommerce' ) ) {
    return;
  }

  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $enable = get_theme_mod( 'product_cat_slider_enable', elite_storefront_home_default_settings( 'product_cat_slider_enable' ) );
  if ( ! $enable ) {
    return;
  }

  $title = get_theme_mod( 'product_cat_slider_title', elite_storefront_home_default_settings( 'product_cat_slider_title' ) );
  $count = get_theme_mod( 'product_cat_slider_count', elite_storefront_home_default_settings( 'product_cat_slider_count' ) );
  $per_row = get_theme_mod( 'product_cat_slider_per_row', elite_storefront_home_default_settings( 'product_cat_slider_per_row' ) );
  $category = get_theme_mod( 'product_cat_slider_category', elite_storefront_home_default_settings( 'product_cat_slider_category' ) );
  $category_2 = get_theme_mod( 'product_cat_slider_category_2', elite_storefront_home_default_settings( 'product_cat_slider_category_2' ) );

  $args = array(
    'post_type'      => 'product',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
  );

  $cat_terms = array();
  if ( ! empty( $category ) ) {
    $cat_terms[] = $category;
  }
  if ( ! empty( $category_2 ) ) {
    $cat_terms[] = $category_2;
  }

  if ( ! empty( $cat_terms ) ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'product_cat',
        'field'    => 'slug',
        'terms'    => $cat_terms,
        'operator' => 'IN',
      ),
    );
  }

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    ?>
    <div class="container" id="home-section-product-cat-slider" style="position:relative;">
      <?php if ( ! empty( $title ) ) : ?>
        <div class="slider-header-wrapper" style="display: flex; align-items: center; margin-bottom: 25px; margin-top: 25px;">
          <h2 class="home-section-title" style="margin: 0; text-align: left;"><?php echo esc_html( $title ); ?></h2>
        </div>
      <?php endif; ?>
    <div class="elite-storefront-product-cat-slider swiper" style="padding: 20px 0;" data-per-row="<?php echo esc_attr( $per_row ); ?>">
      <ul class="swiper-wrapper products">
        <?php 
        $GLOBALS['is_elite_slider'] = true;
        while ( $query->have_posts() ) : $query->the_post(); 
          wc_get_template_part( 'content', 'product' ); 
        endwhile; 
        $GLOBALS['is_elite_slider'] = false;
        ?>
      </ul>

      <div class="swiper-button-prev-cat" style="position: absolute; top: 50%; left: 10px; z-index: 10; cursor: pointer; color: #552fda; transform: translateY(-50%); font-size: 24px;">&#10094;</div>
      <div class="swiper-button-next-cat" style="position: absolute; top: 50%; right: 10px; z-index: 10; cursor: pointer; color: #552fda; transform: translateY(-50%); font-size: 24px;">&#10095;</div>
    </div>
    </div>
    <?php
    wp_reset_postdata();
  }
}
add_action( 'best_shop_before_posts_content', 'elite_storefront_product_category_slider', get_theme_mod( 'product_cat_slider_priority', elite_storefront_home_default_settings( 'product_cat_slider_priority' ) ) );

function elite_storefront_custom_page_section_2_display() {
  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $enable = get_theme_mod( 'home_custom_page_2_enable', elite_storefront_home_default_settings( 'home_custom_page_2_enable' ) );
  if ( ! $enable ) {
    return;
  }

  $title = get_theme_mod( 'home_custom_page_2_title', elite_storefront_home_default_settings( 'home_custom_page_2_title' ) );
  $page_id = get_theme_mod( 'home_custom_page_2_id', elite_storefront_home_default_settings( 'home_custom_page_2_id' ) );

  if ( ! $page_id ) {
    return;
  }

  $page_query = new WP_Query( array(
    'page_id' => $page_id,
    'post_type' => 'page',
  ) );

  if ( $page_query->have_posts() ) {
    ?>
    <div class="elite-storefront-custom-page-section-2" id="home-section-custom-page-2" style="padding: 40px 0; position:relative;">
      <div class="container">
        <?php if ( ! empty( $title ) ) : ?>
          <h2 class="home-section-title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
        <div class="custom-page-content-2">
          <?php while ( $page_query->have_posts() ) : $page_query->the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <?php
    wp_reset_postdata();
  }
}
add_action( 'best_shop_before_posts_content', 'elite_storefront_custom_page_section_2_display', get_theme_mod( 'home_custom_page_2_priority', elite_storefront_home_default_settings( 'home_custom_page_2_priority' ) ) );

function elite_storefront_subscribe_section_display() {
  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $shortcode = get_theme_mod( 'home_subscribe_shortcode', elite_storefront_home_default_settings( 'home_subscribe_shortcode' ) );
  if ( empty( $shortcode ) ) {
    return;
  }

  $title = get_theme_mod( 'home_subscribe_title', elite_storefront_home_default_settings( 'home_subscribe_title' ) );
  $primary_color = get_theme_mod( 'primary_color', elite_storefront_home_default_settings( 'primary_color' ) );
  $secondary_color = get_theme_mod( 'secondary_color', elite_storefront_home_default_settings( 'secondary_color' ) );
  ?>
  <div class="elite-storefront-subscribe-section" style="background-color: <?php echo esc_attr( $primary_color ); ?>;">
    <div class="container">
      <div class="subscribe-wrapper">
        <?php if ( ! empty( $title ) ) : ?>
          <div class="subscribe-title">
            <h2 class="home-section-title"><?php echo esc_html( $title ); ?></h2>
          </div>
        <?php endif; ?>
        <div class="subscribe-form">
          <?php echo do_shortcode( wp_kses_post( $shortcode ) ); ?>
        </div>
      </div>
    </div>
  </div>
  <style>
    .elite-storefront-subscribe-section input[type="submit"],
    .elite-storefront-subscribe-section button {
      background-color: <?php echo esc_attr( $secondary_color ); ?>;
    }
  </style>
  <?php
}
add_action( 'get_footer', 'elite_storefront_subscribe_section_display', 10 );

function elite_storefront_blog_section_display() {
  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $enable = get_theme_mod( 'home_blog_enable', elite_storefront_home_default_settings( 'home_blog_enable' ) );
  if ( ! $enable ) {
    return;
  }

  $title = get_theme_mod( 'home_blog_title', elite_storefront_home_default_settings( 'home_blog_title' ) );
  $count = get_theme_mod( 'home_blog_count', elite_storefront_home_default_settings( 'home_blog_count' ) );

  $args = array(
    'post_type'      => 'post',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
    'ignore_sticky_posts' => true,
  );

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    ?>
    <div class="elite-storefront-blog-section" id="home-section-blog" style="position:relative;">
      <div class="container">
        <?php if ( ! empty( $title ) ) : ?>
          <h2 class="home-section-title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
        <div class="blog-grid">
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="blog-card">
              <div class="blog-image">
                <a href="<?php the_permalink(); ?>">
                  <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'medium_large' );
                  } else {
                    echo '<img src="' . esc_url( get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg' ) . '" alt="Placeholder">';
                  } ?>
                </a>
              </div>
              <div class="blog-content">
                <div class="blog-meta">
                  <span class="author">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 2px;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <?php the_author(); ?>
                  </span>
                  <span class="date">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 2px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <?php echo get_the_date( 'd/m/Y' ); ?>
                  </span>
                </div>
                <h3 class="blog-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="blog-excerpt">
                  <?php echo wp_trim_words( get_the_excerpt(), 6, ' [...]' ); ?>
                </div>
                <div class="blog-footer">
                  <span class="comments">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 2px;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    Comments <?php
                    $comments_number = get_comments_number();
                    echo esc_html( sprintf( '%02d', $comments_number ) );
                    ?>
                  </span>
                  <a href="<?php the_permalink(); ?>" class="read-more">Read More &rsaquo;</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <?php
    wp_reset_postdata();
  }
}
add_action( 'get_footer', 'elite_storefront_blog_section_display', 5 );

function elite_storefront_custom_page_section_display() {
  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $enable = get_theme_mod( 'home_custom_page_enable', elite_storefront_home_default_settings( 'home_custom_page_enable' ) );
  if ( ! $enable ) {
    return;
  }

  $title = get_theme_mod( 'home_custom_page_title', elite_storefront_home_default_settings( 'home_custom_page_title' ) );
  $page_id = get_theme_mod( 'home_custom_page_id', elite_storefront_home_default_settings( 'home_custom_page_id' ) );

  if ( ! $page_id ) {
    return;
  }

  $page_query = new WP_Query( array(
    'page_id' => $page_id,
    'post_type' => 'page',
  ) );

  if ( $page_query->have_posts() ) {
    ?>
    <div class="elite-storefront-custom-page-section" id="home-section-custom-page" style="padding: 60px 0; background: #fdfdfd; position:relative;">
      <div class="container">
        <?php if ( ! empty( $title ) ) : ?>
          <h2 class="home-section-title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
        <div class="custom-page-content">
          <?php while ( $page_query->have_posts() ) : $page_query->the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <?php
    wp_reset_postdata();
  }
}
add_action( 'get_footer', 'elite_storefront_custom_page_section_display', 4 );

function elite_storefront_portfolio_section_display() {
  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $enable = get_theme_mod( 'home_portfolio_enable', elite_storefront_home_default_settings( 'home_portfolio_enable' ) );
  if ( ! $enable ) {
    return;
  }

  $title = get_theme_mod( 'home_portfolio_title', elite_storefront_home_default_settings( 'home_portfolio_title' ) );
  $category = get_theme_mod( 'home_portfolio_category', elite_storefront_home_default_settings( 'home_portfolio_category' ) );
  $columns = get_theme_mod( 'home_portfolio_columns', elite_storefront_home_default_settings( 'home_portfolio_columns' ) );
  $primary_color = get_theme_mod( 'primary_color', elite_storefront_home_default_settings( 'primary_color' ) );
  $count = get_theme_mod( 'home_portfolio_count', elite_storefront_home_default_settings( 'home_portfolio_count' ) );

  $args = array(
    'post_type'      => 'post',
    'posts_per_page' => $count,
    'post_status'    => 'publish',
    'ignore_sticky_posts' => true,
  );

  if ( ! empty( $category ) ) {
    $args['category_name'] = $category;
  }

  $query = new WP_Query( $args );

  if ( $query->have_posts() ) {
    ?>
    <div class="elite-storefront-portfolio-section" id="home-section-portfolio" style="padding: 15px 0; background: #fff; position:relative;">
      <div class="container">
        <?php if ( ! empty( $title ) ) : ?>
          <h2 class="home-section-title"><?php echo esc_html( $title ); ?></h2>
        <?php endif; ?>
        <div class="portfolio-grid" style="display: grid; grid-template-columns: repeat(<?php echo esc_attr( $columns ); ?>, 1fr); gap: 0;">
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="portfolio-item" style="position: relative; overflow: hidden; background-color: <?php echo esc_attr( $primary_color ); ?>;">
              <div class="portfolio-image" style="height: 100%;">
                <?php if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'medium_large', array( 'style' => 'width: 100%; height: 100%; display: block; object-fit: cover;' ) );
                } else {
                  echo '<img src="' . esc_url( get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg' ) . '" alt="Placeholder" style="width: 100%; height: 100%; display: block; object-fit: cover;">';
                } ?>
              </div>
              <div class="portfolio-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); color: #fff; display: flex; flex-direction: column; justify-content: center; align-items: center; opacity: 0; transition: opacity 0.3s ease; text-align: center; padding: 20px; box-sizing: border-box;">
                <h3 class="portfolio-title" style="color: #fff; margin-bottom: 10px;"><a href="<?php the_permalink(); ?>" style="color: #fff; text-decoration: none;"><?php the_title(); ?></a></h3>
                <div class="portfolio-excerpt" style="font-size: 14px; margin-bottom: 15px; color: #fff;">
                  <?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="portfolio-link" style="color: #fff; border: 1px solid #fff; padding: 5px 15px; border-radius: 4px; text-decoration: none;"><?php esc_html_e('View', 'elite-storefront'); ?></a>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <style>
      .portfolio-item:hover .portfolio-overlay {
        opacity: 1 !important;
      }
    </style>
    <?php
    wp_reset_postdata();
  }
}
add_action( 'get_footer', 'elite_storefront_portfolio_section_display', 4 );

function elite_storefront_home_banner_section_display() {
  if ( ! is_front_page() && ! is_home() ) {
    return;
  }

  $enable = get_theme_mod( 'home_banner_enable', elite_storefront_home_default_settings( 'home_banner_enable' ) );
  if ( ! $enable ) {
    return;
  }

  $images = array();
  for ( $i = 1; $i <= 4; $i++ ) {
    $img = get_theme_mod( 'home_banner_image_' . $i, elite_storefront_home_default_settings( 'home_banner_image_' . $i ) );
    if ( ! empty( $img ) ) {
      $images[] = $img;
    }
  }

  if ( empty( $images ) ) {
    return;
  }

  $count = count( $images );
  ?>
  <div class="elite-storefront-banner-section" id="home-section-banner" style="padding: 40px 0; position:relative;">
    <div class="container">
      <div class="banner-grid" style="display: grid; grid-template-columns: repeat(<?php echo esc_attr( $count ); ?>, 1fr); gap: 20px;">
        <?php foreach ( $images as $image ) : ?>
          <div class="banner-item">
            <img src="<?php echo esc_url( $image ); ?>" alt="<?php esc_attr_e( 'Banner', 'elite-storefront' ); ?>" style="width: 100%; height: auto; display: block;" />
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <?php
}
add_action( 'best_shop_before_posts_content', 'elite_storefront_home_banner_section_display', get_theme_mod( 'home_banner_priority', elite_storefront_home_default_settings( 'home_banner_priority' ) ) );

function elite_storefront_custom_woocommerce_placeholder( $image_url ) {
  return get_stylesheet_directory_uri() . '/assets/images/placeholder.jpg';
}
add_filter( 'woocommerce_placeholder_img_src', 'elite_storefront_custom_woocommerce_placeholder', 10 );
