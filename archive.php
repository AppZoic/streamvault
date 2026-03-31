<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package streamvault
 */

get_header();
?>

<section class="section-padding bg-gray">
	<div class="container">
		<div class="row justify-content-center">
			<div class="<?php if ( is_active_sidebar('sidebar') ){ echo'col-xl-9 col-lg-8 col-12'; } else { echo'col-lg-12'; } ?>">
				<?php if ( have_posts() ) { ?>
					<div class="row">
						<?php 
						/* Start the Loop */
						while ( have_posts() ) {
							the_post();

							get_template_part( 'template-parts/content', get_post_type() );

						}; ?>

						<div class="mt-4">
							<?php streamvault_pagination(); ?>
						</div>					
					</div>
				<?php } else {

					get_template_part( 'template-parts/content', 'none' );

				}; ?>
			</div>
			<?php if ( is_active_sidebar('sidebar') ){ ?>
				<div class="col-xl-3 col-lg-4 col-12">
					<div class="streamvault-blog-sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<?php get_footer();
