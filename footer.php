<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package streamvault
 */

namespace Elementor;

global $streamvault_opt;

$footer_widget_display = !empty( $streamvault_opt['footer_widget_display'] ) ? $streamvault_opt['footer_widget_display'] : true;
$streamvault_footer_template = !empty( $streamvault_opt['streamvault_footer_template'] ) ? $streamvault_opt['streamvault_footer_template'] : '';
$streamvault_copyright_info = isset( $streamvault_opt['streamvault_copyright_info'] ) ? $streamvault_opt['streamvault_copyright_info'] : '';
$social_media = isset( $streamvault_opt['social_media'] ) ? $streamvault_opt['social_media'] : '';
$cta_title = isset( $streamvault_opt['cta_title'] ) ? $streamvault_opt['cta_title'] : '';
$cta_image = isset( $streamvault_opt['cta_image'] ) ? $streamvault_opt['cta_image'] : '';
$cta_btn_text = isset( $streamvault_opt['cta_btn_text'] ) ? $streamvault_opt['cta_btn_text'] : '';
$cta_btn_url = isset( $streamvault_opt['cta_btn_url'] ) ? $streamvault_opt['cta_btn_url'] : '';
$backtotop = isset( $streamvault_opt['backtotop'] ) ? $streamvault_opt['backtotop'] : true;


	if (strpos(home_url(add_query_arg(array(), $wp->request)), '/user/') === false){ ?>
		<footer id="colophon" class="site-footer">
		    <?php 
			if ( $footer_widget_display == true ){

				if (did_action( 'elementor/loaded' )) {
					echo Plugin::instance()->frontend->get_builder_content_for_display( $streamvault_footer_template );
				}			
			}
			?>
			<div class="footer-copyright py-4">
				<div class="container-fluid">
				  <div class="row row-gap-4 justify-content-between">
				    <div class="col-auto">
				      <div>
				        <p class="text-white">
				          <?php 
				          	if( $streamvault_copyright_info ) {
								echo wp_kses( $streamvault_copyright_info , array(
									'a'       => array(
									'href'    => array(),
									'title'   => array()
									),
									'br'      => array(),
									'em'      => array(),
									'strong'  => array(),
									'img'     => array(
										'src' => array(),
										'alt' => array()
									),
								));
							} else {
								echo esc_html__('Copyright', 'streamvault'); ?> &copy; <?php echo esc_html( date("Y") ).' '.esc_html( get_bloginfo('name') ).' '.esc_html__(' All Rights Reserved.', 'streamvault' );
							} ?>
				        </p>
				      </div>
				    </div>
				    <div class="col-auto">
				      <div class="footer-social d-flex align-items-center gap-4">
						<?php if ($social_media) { ?>
							<?php foreach ( $social_media as $key => $currency ) { ?>
								<a href="<?php echo esc_url($currency['url']) ?>" class="footer-social-link" target="_blank"><i class="<?php echo esc_attr($currency['title']) ?>"></i></a>
							<?php } ?>
						<?php } ?>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</footer>
	<?php } ?>
	
	<?php if ($backtotop == true) {?>
		<!--======= Back to Top =======-->
		<a href="#" class="scrollToTop"><i class="fal fa-arrow-circle-up"></i></a>
	<?php } ?>

	<?php wp_footer(); ?>

	</body>
</html>
