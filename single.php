<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package streamvault
 */

global $streamvault_opt;
 
$related_posts = !empty( $streamvault_opt['related_posts'] ) ? $streamvault_opt['related_posts'] : '';




get_header(); ?>

<section class="py-110 bg-offWhite">
    <div class="container">
    	<div class="row justify-content-center">
            <div class="col-xl-8">
        		<?php
                
        		while ( have_posts() ) : the_post();
                    if (function_exists('setPostViews')) {
                        setPostViews(get_the_id());
                    }
        			
        			get_template_part( 'template-parts/content', get_post_type() );
                    

        			// If comments are open or we have at least one comment, load up the comment template.
        			if ( comments_open() || get_comments_number() ) :
        				comments_template();
        			endif;

        		endwhile; // End of the loop.

                if ( $related_posts == true ){
                    streamvault_related_posts();
                } ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer();