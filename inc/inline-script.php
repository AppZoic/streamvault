<?php 
//inline style
function streamvault_inline_style() {
    ob_start();
    global $streamvault_opt;

    $primary_color_from = !empty($streamvault_opt['primary_color']['from']) ? $streamvault_opt['primary_color']['from'] : '#6e52c3';
    $primary_color_to = !empty($streamvault_opt['primary_color']['to']) ? $streamvault_opt['primary_color']['to'] : '#6e52c3';
    $secondary_color = !empty($streamvault_opt['secondary_color']) ? $streamvault_opt['secondary_color'] : '#6e52c3'; ?>
	
	.streamvault-btn, .edit-btn , .single-product .product_meta .tagged_as a:hover, .single-product .product_meta .posted_in a:hover, .woocommerce.single-product .onsale, .single_add_to_cart_button, .dashboard-main .button-secondary,.dashboard-main button, #loading .object {
		background: <?php echo esc_attr( $primary_color_from ) ?>;
		background: -webkit-linear-gradient(to right, <?php echo esc_attr( $primary_color_from ) ?>, <?php echo esc_attr( $primary_color_to ) ?>);
		background: linear-gradient(to right, <?php echo esc_attr( $primary_color_from ) ?>, <?php echo esc_attr( $primary_color_to ) ?>);
	}
	
	.scrollToTop, .company-card-list i, .job-type i, .blog-details-meta i, .comment-reply-link, .nav-previous a, .nav-next a, .review-card i, .streamvault-breadcrumb__menu a, .add-extra, .comment .fa-star, .plan-body i.fa-check-circle, .about-list i.fa-check-circle{
		color: <?php echo esc_attr( $primary_color_from ) ?>;
	}

	.single_add_to_cart_button, .nav-previous a, .nav-next a {
		border-color: <?php echo esc_attr( $primary_color_from ) ?>;
	}

	/*----------------------------------------
	IF SCREEN SIZE LESS THAN 769px WIDE
	------------------------------------------*/

	@media screen and (max-width: 768px) {
		{
	 		background: <?php echo esc_attr( $primary_color_from ) ?>;
		}
	}
<?php
return ob_get_clean();
}