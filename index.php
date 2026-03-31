<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package streamvault
 */

get_header();

//HTTP GET
if(!empty($_GET['blog_layout'])){
    $blog_layout_setting = $_GET['blog_layout'];
}
// http://localhost/streamvault/?blog_layout=left

?>

<section class="py-110 bg-offWhite">
	<div class="container">
		<?php if ( have_posts() ) { ?>
			<div class="row">
				<?php 
				/* Start the Loop */
				while ( have_posts() ) { the_post();

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
</section>

<?php get_footer();