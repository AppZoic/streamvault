<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package streamvault
 */

global $streamvault_opt;

$site_preloader = !empty( $streamvault_opt['site_preloader'] ) ? $streamvault_opt['site_preloader'] : '';
$blog_breadcrumb_title = !empty($streamvault_opt['blog_breadcrumb_title']) ? $streamvault_opt['blog_breadcrumb_title'] : esc_html__( 'Latest news', 'streamvault' );
$streamvault_header_sticky = !empty( $streamvault_opt['streamvault_header_sticky'] ) ? $streamvault_opt['streamvault_header_sticky'] : '';
$streamvault_breadcrumb_image = !empty( $streamvault_opt['streamvault_breadcrumb_image']['url'] ) ? $streamvault_opt['streamvault_breadcrumb_image']['url'] : '';
$streamvault_breadcrumb_image_icons = !empty( $streamvault_opt['streamvault_breadcrumb_image_icons']['url'] ) ? $streamvault_opt['streamvault_breadcrumb_image_icons']['url'] : '';
$login_btn_url = !empty( $streamvault_opt['login_btn_url'] ) ? $streamvault_opt['login_btn_url'] : '';
$signup_btn_url = !empty( $streamvault_opt['signup_btn_url'] ) ? $streamvault_opt['signup_btn_url'] : '';
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	 <?php wp_body_open(); ?>
		
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'streamvault' ); ?></a>

	<?php if ($site_preloader): ?>
	<div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_one"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_four"></div>
                <div class="object" id="object_five"></div>
            </div>
        </div>
    </div>    
	<?php endif ?>

	 <div class="modal offcanvas-modal streamvault-mobile-menu fade" id="offcanvas-modal">
        <div class="modal-dialog offcanvas-dialog">
            <div class="modal-content">
                <div class="modal-header offcanvas-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-remove"></i>
                    </button>
                </div>
                <div class="offcanvas-logo">
                    <?php if (has_custom_logo()) {
                        the_custom_logo();
                    } else { ?>
                        <a class="navbar-logo-text" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
                    <?php } ?>
                </div>
                <nav id="offcanvas-menu" class="offcanvas-menu">
                	<?php
                	if ( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array(
                        'theme_location'    => 'primary',
                        'depth'             => 3,
                        'container'         => 'ul',
                        'menu_class' => 'nav-menu menu list-unstyled navigation list-none ps-0',
                        'menu_item_class' => '',
                    ) ); } ?>
                </nav>
            </div>
        </div>
    </div>

    <?php

	if (strpos(home_url(add_query_arg(array(), $wp->request)), '/user/') === false){ ?>	    	
		<header class="streamvault-header">
		    <div class="streamvault-header__middle">
		        <div class="container-fluid">
		            <div class="row align-items-center">
		                <div class="col-12">
		                    <div class="streamvault-header__inside">
		                        <div class="streamvault-header__group">
		                            <div class="streamvault-header__logo">
		                            	<?php if (has_custom_logo()) {
					                        the_custom_logo();
					                    } else { ?>
					                        <a class="navbar-logo-text" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					                    <?php } ?>
		                            </div>
		                            <div class="streamvault-header__menu">
		                                <div class="navbar">
		                                    <div class="nav-item">
		                                    	<?php if ( has_nav_menu( 'primary' ) ) {
												    wp_nav_menu( array(
												        'theme_location'    => 'primary',
												        'depth'             => 3,
												        'container'         => 'ul',
												        'menu_class'        => 'nav-menu menu navigation list-none ps-0',
												        'menu_item_class'   => '',
												    ) );
												} ?>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                        <button type="button" class="offcanvas-toggler" data-bs-toggle="modal" data-bs-target="#offcanvas-modal"><span class="line"></span><span class="line"></span><span class="line"></span>
		                        </button>
		                        <div class="streamvault-header__button">	                            
		                            <?php if (is_user_logged_in()) { ?>
		                            	<a href="<?php echo esc_url(wp_logout_url(home_url('/login'))); ?>" class="w-btn-secondary-lg"><i class="fas fa-sign-out-alt"></i><?php echo esc_html__('Logout', 'streamvault'); ?></a>
		                            <?php } else { ?>
		                            	<a href="<?php echo get_the_permalink($login_btn_url); ?>" class="w-btn-secondary-lg"><i class="fas fa-user"></i><?php echo esc_html__('Login', 'streamvault'); ?></a>
		                            <?php } ?>
		                            
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</header>

		<!-- Secondary Nav -->
	    <div class="d-none d-xl-block">
	      <div class="container-fluid">
	        <div class="position-relative">
	          <nav
	            class="secondary-nav-container position-absolute w-100 start-0 z-3 border-top"
	          >
	          	<?php if ( has_nav_menu( 'secondary_menu' ) ) {
	          		wp_nav_menu( array(
				    'theme_location'    => 'secondary_menu',
				    'depth'             => 1,
				    'container'         => 'ul',
				    'menu_class' => 'secondary-nav list-unstyled d-flex justify-content-between align-items-center ps-0',
				    'menu_item_class' => '',
				) );} ?>
	          </nav>
	        </div>
	      </div>
	    </div>
	    <!-- Secondary Nav End -->
    <?php } ?>

	<?php if ( !is_page_template( 'custom-landing-page.php' ) && !is_singular( 'movies' ) && !is_singular( 'tv_shows' ) && !is_singular( 'videos' ) && !is_404() && strpos(home_url(add_query_arg(array(), $wp->request)), '/user/') === false) { ?>
		<section class="w-breadcrumb-area">
	        <div class="container">
	          <div class="row">
	            <div class="col-auto">
	              <div class="position-relative z-2">
	                <h2 class="section-title-light mb-2">
		                <?php
				      	if(is_home() && is_front_page()){
				            echo esc_html( $blog_breadcrumb_title ); 
				      	} elseif(strpos(home_url(add_query_arg(array(), $wp->request)), '/user/') == true){
				      		echo esc_html__('User Dashboard', 'streamvault');
				      	} else { 
				            echo wp_title('', false);
				      	} ?>
			      	</h2>
	                <nav class="breadcrumbs">
	                  <?php streamvault_breadcrumb(); ?>
	                </nav>
	              </div>
	            </div>
	          </div>
	        </div>
	    </section>
	<?php } ?>