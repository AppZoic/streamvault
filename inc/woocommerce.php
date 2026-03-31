<?php


/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package streamvault
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-streamvault-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function streamvault_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'streamvault_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function streamvault_woocommerce_scripts() {
	wp_enqueue_style( 'streamvault-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css' );
	
	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'streamvault-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'streamvault_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function streamvault_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'streamvault_woocommerce_active_body_class' );

// Products per page.
function streamvault_woocommerce_products_per_page() {
	global $streamvault_opt; 
	$products_per_page = !empty( $streamvault_opt['products_per_page'] ) ? $streamvault_opt['products_per_page'] : '';
	return $products_per_page;
}
add_filter( 'loop_shop_per_page', 'streamvault_woocommerce_products_per_page' );

// Product gallery thumnbail columns.
function streamvault_woocommerce_thumbnail_columns() {
	global $streamvault_opt; 
	$products_per_page = !empty( $streamvault_opt['products_per_page'] ) ? $streamvault_opt['products_per_page'] : '';
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'streamvault_woocommerce_thumbnail_columns' );

// Default loop columns on product archives.
function streamvault_woocommerce_loop_columns() {
	global $streamvault_opt;

	$shop_columns = !empty( $streamvault_opt['shop_columns'] ) ? $streamvault_opt['shop_columns'] : 2;
	
	return $shop_columns;
}
add_filter( 'loop_shop_columns', 'streamvault_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function streamvault_woocommerce_related_products_args( $args ) {
	global $streamvault_opt; 
	$related_products_per_page = !empty( $streamvault_opt['related_products_per_page'] ) ? $streamvault_opt['related_products_per_page'] : 6;
	$related_products_columns = !empty( $streamvault_opt['related_products_columns'] ) ? $streamvault_opt['related_products_columns'] : 2;
	$defaults = array(
		'posts_per_page' => $related_products_per_page,
		'columns'        => $related_products_columns,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'streamvault_woocommerce_related_products_args' );

// Product Item
function streamvault_product_item() { 
	global $product;
	global $streamvault_opt; 
	$product_title_length = isset( $streamvault_opt['product_title_length'] ) ? $streamvault_opt['product_title_length'] : 25;
	$product_title_trimmarker = isset( $streamvault_opt['product_title_trimmarker'] ) ? $streamvault_opt['product_title_trimmarker'] : '...';
	$image_id = $product->get_gallery_image_ids();
	$has_rating = $product->get_rating_count() > 0; ?>

	<div class="product-item">
	  <div class="product-item-image">
			<a href="<?php the_permalink(); ?>">
			    <?php if ( has_post_thumbnail() ){
					the_post_thumbnail('streamvault-320x320');
				} else { ?>
					<img src="<?php echo get_template_directory_uri().'/assets/images/placeholder.png' ?>" alt="<?php the_title_attribute() ?>">
				<?php } ?>
			</a>
	      <?php woocommerce_show_product_loop_sale_flash() ?>
	    </div>
	    <div class="product-item-content">

			<a href="<?php the_permalink(); ?>">
				<h5><?php echo mb_strimwidth( get_the_title(), 0, $product_title_length, $product_title_trimmarker );?></h5>
			</a>

			<ul class="list-inline mb-0 p-0">
				<li class="list-inline-item">
					<?php woocommerce_template_single_price(); ?>
				</li>
				<?php if ($has_rating) { ?>
					<li class="list-inline-item float-right"><?php woocommerce_template_loop_rating(); ?></li>
				<?php } ?>
			</ul>
	    </div>
	</div>
<?php }

add_action( 'get_streamvault_product_item', 'streamvault_product_item' );
