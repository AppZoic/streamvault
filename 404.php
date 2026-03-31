<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package streamvault 
 */
global $streamvault_opt;

$streamvault_error_title = !empty( $streamvault_opt['streamvault_error_title'] ) ? $streamvault_opt['streamvault_error_title'] : __( 'Oops! Page Not Found.', 'streamvault' );
$streamvault_error_image = !empty( $streamvault_opt['streamvault_error_image'] ) ? $streamvault_opt['streamvault_error_image'] : '';

get_header(); ?>

<!-- Error Page -->
<section class="bg-offWhite py-80">
	<div class="container">
	  	<div class="row justify-content-center">
		    <div class="col-lg-7 col-12">
		      <div
		        class="p-5 rounded-3 not-found-img d-flex flex-column flex-wrap align-items-center"
		      >
		        <img src="<?php echo esc_url($streamvault_error_image['url']); ?>" alt="<?php echo esc_attr( $streamvault_error_title ); ?>">
		      </div>
		      <div class="pt-5 text-center">
		        <h2 class="section-title mb-4"><?php echo esc_html( $streamvault_error_title ); ?></h2>
		        <div>
		          <a href="<?php echo esc_url( get_home_url() ); ?>" class="w-btn-secondary-lg d-inline-flex"
		            ><?php echo esc_html__( 'Back to Home Page', 'streamvault' ); ?></a
		          >
		        </div>
		      </div>
		    </div>
	  	</div>
	</div>
</section>
<!-- End Error Page -->

<?php get_footer();