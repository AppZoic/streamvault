<?php
/**
 * streamvault functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package streamvault
 */


if ( ! function_exists( 'streamvault_setup' ) ) :

	function streamvault_setup() {

		load_theme_textdomain( 'streamvault', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'streamvault' ),
			'secondary_menu' => esc_html__( 'Secondary', 'streamvault' )
		) );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-background', apply_filters( 'streamvault_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_image_size( 'streamvault-1280x720', 1280,720,true );
		add_image_size( 'streamvault-1280x650', 1280,650, array( 'center', 'top' ));
		add_image_size( 'streamvault-800x500', 800,500,true );
		add_image_size( 'streamvault-800x800', 800,800,true );
		add_image_size( 'streamvault-320x320', 320,320,true );
		add_image_size( 'streamvault-500x400', 500,400,true );
		add_image_size( 'streamvault-576x456', 576,456,true );
		add_image_size( 'streamvault-440x530', 440,530,true );
		add_image_size( 'streamvault-462x294', 462,294,true );
		add_image_size( 'streamvault-400x250', 400,250,true );
		add_image_size( 'streamvault-270x270', 270,270,true );
		add_image_size( 'streamvault-200x200', 200,200,true );
		add_image_size( 'streamvault-125x158', 125,158,true );
		add_image_size( 'streamvault-120x90', 120,90,true );
		add_image_size( 'streamvault-100x100', 100,100,true );
		add_image_size( 'streamvault-80x80', 80,80,true );
		add_image_size( 'streamvault-32x32', 32,32,true );
	}

endif;
add_action( 'after_setup_theme', 'streamvault_setup' );

function streamvault_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'streamvault_content_width', 640 );
}
add_action( 'after_setup_theme', 'streamvault_content_width', 0 );

function streamvault_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Store Sidebar', 'streamvault' ),
		'id'            => 'store_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'streamvault' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="streamvault-service-sidebar__title m-0">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Product Sidebar', 'streamvault' ),
		'id'            => 'product_sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'streamvault' ),
		'before_widget' => '<div class="product-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
	
}
add_action( 'widgets_init', 'streamvault_widgets_init' );


// Register Fonts
function streamvault_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'streamvault' ) ) {
	    $font_url = "https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700;14..32,800&family=Space+Grotesk:wght@400;500;600;700&display=swap";
	}

    return $font_url;
}

// Scripts
function streamvault_scripts() {

	// CSS
	wp_enqueue_style( 'streamvault-fonts', streamvault_fonts_url());
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome-all.min.css');
	wp_enqueue_style( 'streamvault-theme', get_template_directory_uri() . '/assets/css/theme.css');
	wp_enqueue_style( 'streamvault-style', get_stylesheet_uri());
	wp_enqueue_style( 'resposive', get_template_directory_uri() . '/assets/css/resposive.css');

	// JS

    wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'streamvault-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get( 'Version' ), true );

	$currency_symbol = class_exists( 'WooCommerce' ) ? get_woocommerce_currency_symbol() : '';
	
	wp_localize_script( 'streamvault-main', 'streamvaultAjaxUrlObj', array( 
		'homeurl' => home_url( '/' ),
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'currency' => $currency_symbol,
		'nonce'   => wp_create_nonce('ajax_nonce'),
		'current_user_id'  =>  get_current_user_id(),
		'checkout_url' => class_exists('WooCommerce') ? wc_get_checkout_url() : ''
    ));
  
	//'streamvault-style' is main style of the theme
  	wp_add_inline_style( 'streamvault-style', streamvault_inline_style());
}

add_action( 'wp_enqueue_scripts', 'streamvault_scripts' );

// Denqueue scripts and styles.
function streamvault_dequeue_script() {
    wp_dequeue_style( 'elementor-animations' );
    wp_deregister_style( 'elementor-animations' );
}
add_action( 'wp_enqueue_scripts', 'streamvault_dequeue_script', 20 );

// Includes files
require get_template_directory() . '/inc/inline-script.php';
require get_template_directory() . '/inc/redux-framework.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/breadcrumb.php';
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

if (get_option( 'license_key_activated' )!='activated') {
	// require get_template_directory() . '/inc/validate-license.php';
}

require get_template_directory() . '/inc/hooks.php';
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

// TGM required plugins
function streamvault_register_required_plugins() {
    $plugins = array(
        array(
            'name'        => esc_html__('Redux Framework', 'streamvault'),
            'slug'        => 'redux-framework',
            'required'    => true,
        ),
        array(
            'name'        => esc_html__('Elementor', 'streamvault'),
            'slug'        => 'elementor',
            'required'    => true,
        ),
        array(
            'name'        => esc_html__('WooCommerce', 'streamvault'),
            'slug'        => 'woocommerce',
            'required'    => true,
        ),
        array(
            'name'        => esc_html__('CMB2', 'streamvault'),
            'slug'        => 'cmb2',
            'required'    => true,
        ),
        array(
            'name'        => esc_html__('WP Mail SMTP', 'streamvault'),
            'slug'        => 'wp-mail-smtp',
            'required'    => true,
        ),
        array(
            'name'        => esc_html__('Loco Translate', 'streamvault'),
            'slug'        => 'loco-translate',
            'required'    => true,
        ),
        array(
            'name'        => esc_html__('Contact Form 7', 'streamvault'),
            'slug'        => 'contact-form-7',
            'required'    => true,
        ),
        array(
            'name'        => esc_html__('Mailchimp', 'streamvault'),
            'slug'        => 'mailchimp-for-wp',
            'required'    => true,
        ),
        array(
            'name'        => esc_html__('One Click Demo Import', 'streamvault'),
            'slug'        => 'one-click-demo-import',
            'required'    => true,
        )
    );

    // Check if license key is set
    if (get_option('license_key_activated') == 'activated') {
        // Add the custom plugin with the dynamic source URL
        $plugins[] = array(
            'name'        => esc_html__('streamvault Element (license required)', 'streamvault'),
            'slug'        => 'streamvault-element',
            'source'      => 'https://appzoic.com/wp-json/plugin/v1/install/streamvault-element/' . get_option('license_key'),
            'required'    => true,
        );
    }

    $config = array(
        'id'           => 'streamvault',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgmpa($plugins, $config);
}

add_action('tgmpa_register', 'streamvault_register_required_plugins');

// One click demo import
function streamvault_import_files() {
	return array(
		array(
			'import_file_name'             => esc_html__( 'Default', 'streamvault' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/default/content.xml',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo/default/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demo/default/redux.json',
					'option_name' => 'streamvault_opt',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri(). '/inc/demo/default/demo.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to set up the menu URLs separately.', 'streamvault' ),
			'preview_url'                  => 'https://appzoic.com/wp/streamvault/',
		),
		array(
			'import_file_name'             => esc_html__( 'RTL Arabic', 'streamvault' ),
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo/arabic/content.xml',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo/arabic/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'inc/demo/arabic/redux.json',
					'option_name' => 'streamvault_opt',
				),
			),
			'import_preview_image_url'     => get_template_directory_uri(). '/inc/demo/arabic/demo.jpg',
			'import_notice'                => esc_html__( 'After you import this demo, you will have to set up the menu URLs separately.', 'streamvault' ),
			'preview_url'                  => 'https://appzoic.com/wp/streamvault-rtl',
		)
	);
}

// if (get_option('license_key_activated') == 'activated') {
	add_filter( 'pt-ocdi/import_files', 'streamvault_import_files' );
// }

// Default Home and Blog Setup
function streamvault_after_import_setup() {
    // Assign menus to their locations.
    set_theme_mod( 'nav_menu_locations', array(
        'primary' => get_term_by( 'name', 'Primary', 'nav_menu' )->term_id,
        'secondary_menu' => get_term_by( 'name', 'Secondary', 'nav_menu' )->term_id
    ));

    // Assign front page and posts page (blog page).
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', get_page_by_title( 'Home' )->ID );
    update_option( 'page_for_posts', get_page_by_title( 'Blog' )->ID );
    
    // Set permalink structure
    update_option('permalink_structure', '/%postname%/');
}

add_action( 'pt-ocdi/after_import', 'streamvault_after_import_setup' );

// Plugin update
if (function_exists('is_plugin_active')) {
    if (is_admin()) {
        $plugin_file = WP_PLUGIN_DIR . '/streamvault-element/streamvault-element.php';

        if (file_exists($plugin_file)) {
            $plugin_data = get_plugin_data($plugin_file);
            
            if ($plugin_data && version_compare($plugin_data['Version'], '1.0.0', '<')) {
                // Attempt to deactivate the plugin
                $deactivated = deactivate_plugins('streamvault-element/streamvault-element.php');
                
                if ($deactivated) {
                    // Provide feedback to the user/administrator
                    $message = __('The streamvault Element plugin was deactivated because it is an older version.', 'streamvault');
                    add_action('admin_notices', function () use ($message) {
                        echo '<div class="notice notice-error"><p>' . esc_html($message) . '</p></div>';
                    });
                    
                    // Attempt to delete the plugin
                    $deleted = delete_plugins(array('streamvault-element/streamvault-element.php'));
                    
                    if ($deleted) {
                        $delete_message = __('The streamvault Element plugin was successfully deleted.', 'streamvault');
                        add_action('admin_notices', function () use ($delete_message) {
                            echo '<div class="notice notice-success"><p>' . esc_html($delete_message) . '</p></div>';
                        });
                    } else {
                        $delete_error_message = __('Failed to delete the streamvault Element plugin.', 'streamvault');
                        add_action('admin_notices', function () use ($delete_error_message) {
                            echo '<div class="notice notice-error"><p>' . esc_html($delete_error_message) . '</p></div>';
                        });
                    }
                } else {
                    $deactivate_error_message = __('Failed to deactivate the streamvault Element plugin.', 'streamvault');
                    add_action('admin_notices', function () use ($deactivate_error_message) {
                        echo '<div class="notice notice-error"><p>' . esc_html($deactivate_error_message) . '</p></div>';
                    });
                }
            }
        }
    }
}


function streamvault_get_post_item(){

	global $streamvault_opt;
	$streamvault_excerpt_length = !empty( $streamvault_opt['streamvault_excerpt_length'] ) ? $streamvault_opt['streamvault_excerpt_length'] : 40; ?>


	<div class="blog-card">
        <div class="position-relative">   
          	<a href="<?php the_permalink() ?>" class="d-block">
          		<?php if (has_post_thumbnail()){
          			the_post_thumbnail('streamvault-576x456', array( 'class' => 'img-fluid blog-thumb w-100' ));
          		} else {
          			if (class_exists('WooCommerce')) {
	          			echo '<img src="' . esc_url( wc_placeholder_img_src() ) . '" alt="' . esc_attr(get_the_title(get_the_ID())) . '" class="img-fluid blog-thumb w-100" />';
	          		}
          		} ?>
	        </a>
	        <?php if (has_post_thumbnail()){ ?>
	          	<span class="blog-date position-absolute"><?php echo get_the_date('d/F/Y'); ?></span>
	        <?php } ?>
        </div>
        <div class="blog-meta">
			<div class="d-flex justify-content-between mb-3">
				<p class="d-flex align-items-center gap-2 text-dark-200">
				  <i class="far fa-user"></i><?php echo esc_html__('By','streamvault'); ?> <span><?php the_author(); ?>
				</p>
				<p class="d-flex align-items-center gap-2 text-dark-200">
				  	<i class="fal fa-comment-lines"></i>
		      		<?php echo get_comments_number(get_the_ID()). ' Comments'; ?>
				</p>
			</div>
          	<h3 class="blog-title fw-bold mb-3">
            	<a href="<?php the_permalink() ?>"><?php echo mb_strimwidth(get_the_title(), 0, $streamvault_excerpt_length, '..'); ?></a>
          	</h3>
          	<a href="<?php the_permalink() ?>" class="blog-link d-flex gap-3 align-items-center text-dark-200">
            Learn More
	            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="10" viewBox="0 0 15 10" fill="none">
	              <path d="M12.6222 4.38176C12.5582 4.38176 12.4984 4.38176 12.4344 4.38176C8.56253 4.38176 4.69065 4.38176 0.818766 4.38176C0.716312 4.38176 0.613859 4.37785 0.515674 4.40129C0.195508 4.4677 -0.0307435 4.76459 0.00340761 5.05758C0.0418276 5.37791 0.30223 5.60839 0.643741 5.62793C0.712043 5.63183 0.780345 5.63183 0.852917 5.63183C4.71199 5.63183 8.57534 5.63183 12.4344 5.63183C12.4984 5.63183 12.5582 5.63183 12.6649 5.63183C12.5966 5.69824 12.5582 5.73731 12.5155 5.77637C11.38 6.8194 10.2402 7.86243 9.10468 8.90546C8.82293 9.16329 8.79305 9.51878 9.03211 9.77661C9.27117 10.0383 9.68525 10.0774 9.9798 9.86646C10.0268 9.8352 10.0652 9.79614 10.1079 9.75707C11.6489 8.34684 13.19 6.93269 14.7268 5.51855C15.0982 5.17868 15.0982 4.83882 14.7268 4.49895C13.1772 3.077 11.6233 1.65504 10.0737 0.229173C9.86881 0.0416613 9.63829 -0.0481873 9.35228 0.0260353C8.8827 0.147137 8.7034 0.670605 9.0065 1.01437C9.04492 1.06125 9.09187 1.10032 9.13883 1.14329C10.2658 2.1746 11.3885 3.20982 12.5198 4.24113C12.5625 4.28019 12.618 4.29972 12.6649 4.33098C12.6479 4.34269 12.6351 4.36223 12.6222 4.38176Z" fill="currentColor"></path>
	            </svg>
          	</a>
        </div>
    </div>
<?php
}

// Related Posts
function streamvault_related_posts(){

    global $streamvault_opt;

    if (!empty($streamvault_opt['related_posts']) && $streamvault_opt['related_posts']!='') {
         $posts_per_page = !empty( $streamvault_opt['posts_per_page'] ) ? $streamvault_opt['posts_per_page'] : '';
         $related_posts_columns = !empty( $streamvault_opt['related_posts_columns'] ) ? $streamvault_opt['related_posts_columns'] : '';
         $related_post_title = !empty( $streamvault_opt['related_post_title'] ) ? $streamvault_opt['related_post_title'] : '';
        
        global $post;

        $related = get_posts( array( 
            'category__in' => wp_get_post_categories($post->ID),
            'posts_per_page' => $posts_per_page,
            'post_type' => 'post', 
            'post__not_in' => array($post->ID) 
        ) ); ?>

      <?php if ($related): ?>
        <div class="related-posts">
          <h4><?php echo esc_html( $related_post_title ) ?></h4>
          <div class="row">
              <?php
                  if( $related ) foreach( $related as $post ) { 
                  setup_postdata($post); ?>
                  <div class="col-md-12 col-xl-<?php echo esc_attr( $related_posts_columns ) ?>">
                	<?php streamvault_get_post_item(); ?>
                  </div>
              <?php } wp_reset_postdata(); ?> 
          </div>
      </div><!-- .related-posts --> 

      <?php endif ?>
    <?php } 
}


// Comment List
function streamvault_comment_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('article' == $args['style']) {
        $tag = 'article';
        $add_below = 'comment';
    } else {
        $tag = 'div';
        $add_below = 'comment';
    }

    $rating = get_comment_meta($comment->comment_ID, 'rating', true);
    $additional_class = 'bg-white blog-single-comment ';
?>

<<?php echo esc_html($tag); ?> <?php comment_class( $additional_class . ($args['has_children'] ? '' : 'parent ') ); ?> id="comment-<?php comment_ID(); ?>" itemscope itemtype="http://schema.org/Comment">

	<?php if (get_post_type() == 'services'){
		if ($rating && empty($args['has_children'])) { ?>

			<!-- Buyer Review -->
            <div class="bg-white">
                <div>
                    <div class="d-flex justify-content-between mb-3">
                    	<div class="d-flex">
                        <?php if ($rating) {
		                    for ($i = 1; $i <= 5; $i++) { // Loop to display star ratings
		                        if ($i <= $rating) {
		                            echo '<i class="fas fa-star"></i>';
		                        } else {
		                            echo '<i class="far fa-star"></i>';
		                        }
		                    }
		                } ?>
		                </div>
                        <span class="text-dark-200 fs-6"><?php echo get_comment_date('j F Y', $comment); ?></span>
                    </div>
                    <p class="text-dark-200 fs-6">
                    	<?php comment_text(); ?>
                    </p>
                    <div class="d-flex align-items-center buyer-info justify-content-between mt-4">
                        <div class="d-flex align-items-center gap-3">
                            <div>
                                <?php echo get_avatar($comment, 50); ?>
                            </div>
                            <div>
                                <h4 class="text-18 text-dark-300 fw-semibold"><?php echo esc_html($comment->comment_author); ?></h4>
                                <p class="text-dark-200 fs-6"><?php echo esc_html(get_user_meta($comment->comment_author, 'billing_country', true)); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

		<?php }
	} else { ?>

		<div class="d-flex flex-column flex-md-row gap-3">
		    <div>
		        <?php echo get_avatar( $comment, 90 ); ?>
		    </div>
		    <div>
		        <div class="d-flex align-items-center justify-content-between">
		            <h4 class="text-18 fw-semibold text-dark-300">
			        	<?php echo get_comment_author_link(); ?>
			      	</h4>
		            <p class="fs-6 text-dark-200"><?php comment_date('jS F Y , ').comment_time() ?></p>
		        </div>
		        <p class="py-2 text-dark-200 fs-6">
		            <?php comment_text() ?>
		        </p>
		        <?php comment_reply_link(array_merge($args, array(
				    'add_below' => $add_below,
				    'depth' => $depth,
				    'max_depth' => $args['max_depth'],
				    'reply_text' => '<i class="fas fa-reply-all"></i> Reply',
				    'class' => 'comment-reply-btn d-flex gap-2 align-items-center'
				)));

				if ($comment->comment_approved == '0') { ?>
			        <p class="comment-meta-item"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'streamvault' ) ?></p>
			    <?php } ?>
			    <?php edit_comment_link('<p class="comment-meta-item float-end">' . esc_html__('Edit this comment', 'streamvault') . '</p>', '', ''); ?>
		    </div>
		</div>
<?php }
}


//Comment Field to Bottom
function streamvault_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter( 'comment_form_fields', 'streamvault_comment_field_to_bottom' );


function streamvault_display_rating_field_for_logged_in_users($commenter) {
	if (get_post_type() == 'services') {
	    echo '<div class="col-lg-12">
	            <ul class="streamvault-rating list-inline">
		            <li><i class="fal fa-star" data-rating="1"></i></li>
		            <li><i class="fal fa-star" data-rating="2"></i></li>
		            <li><i class="fal fa-star" data-rating="3"></i></li>
		            <li><i class="fal fa-star" data-rating="4"></i></li>
		            <li><i class="fal fa-star" data-rating="5"></i></li>
		        </ul>
		        <input type="hidden" name="rating" id="rating" value="1">
	         </div>';
    }
}
add_action('comment_form_logged_in', 'streamvault_display_rating_field_for_logged_in_users');


function streamvault_save_comment_rating($comment_id) {
    if (isset($_POST['rating'])) {
        $rating = sanitize_text_field($_POST['rating']);
        add_comment_meta($comment_id, 'rating', $rating, true);

        // Retrieve the post ID associated with the comment
        $post_id = get_comment($comment_id)->comment_post_ID;
        $reviews = get_comments(array(
            'post_id' => $post_id,
            'status' => 'approve',
        ));

        $rating_count = 0;
        $average_rating = 0;

        foreach ($reviews as $review) {
            $rating = get_comment_meta($review->comment_ID, 'rating', true);

            if ($rating !== '' && is_numeric($rating)) {
                $rating_count++;
                $average_rating += $rating;
            }
        }

        $average_rating = $rating_count > 0 ? $average_rating / $rating_count : 0;
        update_post_meta($post_id, 'average_rating', round($average_rating));
    }
}

add_action('comment_post', 'streamvault_save_comment_rating');

// Archive count on rightside
function streamvault_archive_count_on_rightside($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="float-right">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

add_filter( 'get_archives_link', 'streamvault_archive_count_on_rightside' );

// Category count on rightside
function streamvault_category_count_on_rightside( $links ) {
    $links = str_replace( '</a> (', ' <span class="float-end">(', $links );
    $links = str_replace( ')', ')</span></a>', $links );
    return $links;
}

add_filter( 'wp_list_categories', 'streamvault_category_count_on_rightside' );

// Get option list
function streamvault_get_option_list($taxonomy, $meta, $post_id) { 
	$current_term = get_the_terms( $post_id, $taxonomy )[0]->slug;

	$terms = get_terms( array(
	    'taxonomy' => $taxonomy,
	    'hide_empty' => false,
		'orderby'   => 'name',
	) );
	$hierarchy ='';
	$hierarchy = _get_term_hierarchy($taxonomy);

	foreach ($terms as $term) { 
		if($term->parent) {
			continue;
		} ?>						
		<option <?php if ($term->slug == $current_term ){echo'selected ="selected"';} ?> value="<?php echo esc_attr( $term->term_id ); ?>"><?php echo esc_html( $term->name ); ?></option>

			<?php if (isset($hierarchy[$term->term_id])) {
				foreach ($hierarchy[$term->term_id] as $child){
					$child = get_term($child, $taxonomy); ?>

					<option <?php if ($child->slug == $current_term ){echo'selected ="selected"';} ?> value="<?php echo esc_attr( $child->term_id ); ?>">- <?php echo esc_html( $child->name ); ?></option>

					<?php if (isset($hierarchy[$child->term_id])) {
						foreach ($hierarchy[$child->term_id] as $child2){
							$child2 = get_term($child2, $taxonomy); ?>

							<option <?php if ($child2->slug == $current_term ){echo'selected ="selected"';} ?> value="<?php echo esc_attr( $child2->term_id ); ?>">-- <?php echo esc_html( $child2->name ); ?></option>

								<?php if (isset($hierarchy[$child2->term_id])) {
									foreach ($hierarchy[$child2->term_id] as $child3){
										$child3 = get_term($child3, $taxonomy); ?>

										<option <?php if ($child3->slug == $current_term ){echo'selected ="selected"';} ?> value="<?php echo esc_attr( $child3->term_id ); ?>">--- <?php echo esc_html( $child3->name ); ?></option>
									<?php }
								} ?>
						<?php }
					} ?>
				<?php }
			} ?>
	<?php }
}

// How to Remove Featured Image When Deleting a Post with wp_delete_attachment
function streamvault_remove_attachment_with_product($post_id)
{
 	if ( 'product' == get_post_type( $post_id ) ){
	    if(has_post_thumbnail( $post_id ))
	        {
	      $attachment_id = get_post_thumbnail_id( $post_id );
	      wp_delete_attachment($attachment_id, true);
	    }
	}
}

add_action( 'before_delete_post', 'streamvault_remove_attachment_with_product', 10 );

// Post view count.
function streamvault_track_post_views($postID) {
    if (!is_single()) return;
    if (empty($postID)) {
        global $post;
        $postID = $post->ID;
    }

    if (get_post_type($postID) === 'post') {
        $views = get_post_meta($postID, 'post_views', true);
        $views = empty($views) ? 0 : $views;
        $views++;
        update_post_meta($postID, 'post_views', $views);
    }
}
add_action('wp_head', 'streamvault_track_post_views');


// All product category ids
function streamvault_get_product_category_ids(){
  $all_categories = get_terms( array('taxonomy' => 'product_cat','hide_empty' => false, 'parent' => 0));
  if (is_wp_error($all_categories)) {
      return [];
  }
  foreach ($all_categories as $key => $term) {
      $options[$key] = $term->term_id;
  }
  return $options;
}


// Session start
function streamvault_start_session(){
    if(!session_id()) {
        session_start();
    }
}
add_action('init', 'streamvault_start_session', 1);


function streamvault_pagination($post_query = null, $total_pages = null, $total_items = null, $items_per_page = 10) {
    global $wp_query;

    // Calculate the total pages if total items are provided
    if ($total_items) {
        $total_pages = ceil($total_items / $items_per_page);
    } elseif ($post_query) {
        $total_pages = $post_query->max_num_pages;
    } else {
        $total_pages = $wp_query->max_num_pages;
    }

    if ($total_pages > 1) {
        echo '<div class="row justify-content-center mt-3">
        <div class="col-auto">
          <nav aria-label="Page navigation example">
            <ul class="custom-pagination pagination">';
        
        $current_page = max(1, get_query_var('paged'));

        // Previous button
        if ($current_page > 1) {
            echo '<li class="custom-page-item page-item"><a class="custom-page-link page-link prev" href="' . get_pagenum_link($current_page - 1) . '">Previous</a></li>';
        }

        // Display first page
        if ($current_page > 3) {
            echo '<li class="custom-page-item page-item"><a class="custom-page-link page-link" href="' . get_pagenum_link(1) . '">1</a></li>';
            if ($current_page > 4) {
                echo '<li class="custom-page-item page-item disabled"><span class="custom-page-link page-link">...</span></li>';
            }
        }

        // Page numbers around the current page
        for ($i = max(1, $current_page - 2); $i <= min($total_pages, $current_page + 2); $i++) {
            if ($i == $current_page) {
                echo '<li class="custom-page-item page-item active" aria-current="page"><a class="custom-page-link page-link" href="#">' . $i . '</a></li>';
            } else {
                echo '<li class="custom-page-item page-item"><a class="custom-page-link page-link" href="' . get_pagenum_link($i) . '">' . $i . '</a></li>';
            }
        }

        // Display last page
        if ($current_page < $total_pages - 2) {
            if ($current_page < $total_pages - 3) {
                echo '<li class="custom-page-item page-item disabled"><span class="custom-page-link page-link">...</span></li>';
            }
            echo '<li class="custom-page-item page-item"><a class="custom-page-link page-link" href="' . get_pagenum_link($total_pages) . '">' . $total_pages . '</a></li>';
        }

        // Next button
        if ($current_page < $total_pages) {
            echo '<li class="custom-page-item page-item"><a class="custom-page-link page-link next" href="' . get_pagenum_link($current_page + 1) . '">Next</a></li>';
        }

        echo '</ul>
            </nav>
        </div>
      </div>';
    }
}

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );
// Disables the block editor from managing widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );