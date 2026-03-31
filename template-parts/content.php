<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package streamvault
 */

global $streamvault_opt;
 
$social_share = !empty( $streamvault_opt['social_share'] ) ? $streamvault_opt['social_share'] : '';
$streamvault_blog_details_post_navigation = !empty( $streamvault_opt['streamvault_blog_details_post_navigation'] ) ? $streamvault_opt['streamvault_blog_details_post_navigation'] : '';
$profile_image = get_user_meta(get_the_author_meta( 'ID' ), 'profile_image', true);

?>
<?php if ( is_single() ){ ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('streamvault-blog-details mb-0'); ?>>
		<?php the_title( '<h1 class="fw-bold text-dark-300 blog-details-title">', '</h1>' ); ?>

		<div class="blog-details-meta d-flex flex-wrap gap-3 gap-md-4 my-4 align-items-center">
		    <p class="d-flex gap-3 align-items-center text-dark-200 fst-italic">
		      <i class="far fa-user"></i>
		      <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php echo esc_html__('By ', 'streamvault'); ?><?php the_author(); ?></a>
		    </p>
		    <p class="d-flex gap-3 align-items-center text-dark-200 fst-italic">
		     	<i class="fal fa-calendar-alt"></i>
		      <?php echo get_the_date('d F Y'); ?>
		    </p>
		    <p class="d-flex gap-3 align-items-center text-dark-200 fst-italic">
		     	<i class="fal fa-comment-lines"></i>
		      	<?php echo get_comments_number(get_the_ID()). ' Comments'; ?>
		    </p>
		</div>

		<div class="entry-content">		

			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'streamvault' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'streamvault' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->

		<?php if (get_the_tags() OR $social_share){ ?>
		<!-- Tags -->
        <div class="blog-tags-wrapper mt-5">
            <div class="row g-3 justify-content-between">
              <div class="col-auto">
                <div class="d-flex align-items-center">
                  <div
                    class="d-flex flex-column flex-md-row align-items-lg-center gap-3 gap-lg-4"
                  >
                  <?php if (get_the_tags()){ ?>
                    <h4 class="text-dark-300 fw-semibold text-18"><?php echo esc_html__('Tags:', 'streamvault'); ?></h4>
                    <div
                      class="d-flex flex-wrap align-items-center gap-3 gap-md-4"
                    >
                      <?php the_tags( $before = '',' ','')	 ?>
                    </div>
                <?php } ?>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <div class="d-flex align-items-center gap-4">
                	<?php if ( $social_share == true ){ ?>
	                  <h4 class="text-dark-300 fw-semibold text-18"><?php echo esc_html__('Share:', 'streamvault'); ?></h4>
	                  <div class="d-flex align-items-center gap-3 social-links">
	                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>"><i class="fab fa-facebook-f"></i></a>
				        <a href="https://twitter.com/home?status=<?php the_permalink() ?>"><i class="fab fa-twitter"></i></a>
				        <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink() ?>&media=<?php echo wp_get_attachment_url( get_post_thumbnail_id() ) ?>&description=<?php echo get_the_excerpt(); ?>"><i class="fab fa-pinterest"> </i></a>
				        <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>"><i class="fab fa-linkedin-in"></i></a>
	                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
        </div>
	    <?php } if ( true == $streamvault_blog_details_post_navigation ) {
			the_post_navigation( array(
		        'prev_text' => esc_html__('&#171; Previous Post', 'streamvault'),
		        'next_text' => esc_html__('Next Post &#187;', 'streamvault')
		    ) );
		}  ?>
	</article>


	<?php if (get_the_author_meta('description')){ ?>
		<div class="row">
		    <div class="col-12">
		        <!-- Single Review -->
		        <div class="streamvault-blog-authors mg-top-60">
		            <div class="streamvault-blog-authors__head">
		            	<?php if ($profile_image){ ?>
                            <img src="<?php echo wp_get_attachment_image_src($profile_image,'streamvault-270x270')[0]; ?>" alt="<?php the_author(); ?>">
                        <?php } else { ?>
                            <img src="<?php echo get_avatar_url(get_the_author_meta( 'ID' )); ?>" alt="<?php the_author(); ?>">
                        <?php } ?>
		            </div>
		            <div class="streamvault-blog-authors__content">
		                <h4 class="streamvault-blog-authors__title"><?php echo esc_html__('Author:', 'streamvault'); ?> <?php the_author(); ?></h4>
		                <p class="streamvault-blog-authors__text"><?php echo get_the_author_meta('description'); ?></p>
		            </div>
		            <?php

				    $facebook = get_user_meta(get_the_author_meta('ID'), 'facebook', true);
				    $twitter = get_user_meta(get_the_author_meta('ID'), 'twitter', true);
				    $youtube = get_user_meta(get_the_author_meta('ID'), 'youtube', true);

				    if ($facebook || $twitter || $youtube) { ?>
			            <div class="streamvault-blog-authors__social">
							<ul class="streamvault-social streamvault-social__author">
							    <?php if ($facebook) { ?>
							        <li><a href="<?php echo esc_url($facebook); ?>"><i class="fab fa-facebook-f"></i></a></li>
							    <?php } ?>
							    <?php if ($twitter) { ?>
							        <li><a href="<?php echo esc_url($twitter); ?>"><i class="fab fa-twitter"></i></a></li>
							    <?php } ?>
							    <?php if ($youtube) { ?>
							        <li><a href="<?php echo esc_url($youtube); ?>"><i class="fab fa-youtube"></i></a></li>
							    <?php } ?>
							</ul>
							<span><?php echo esc_html__('Social Profile', 'streamvault'); ?></span>
			            </div>
			        <?php } ?>
		        </div>
		    </div>
		</div>
	<?php } ?>
<?php } else{ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-xl-3 col-lg-6 col-md-6 col-12'); ?>>
	<?php streamvault_get_post_item(); ?>
</article>
	
<?php } ?>
