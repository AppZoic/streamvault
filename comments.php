<?php

if ( post_password_required() ) {
	return;
}

if ( have_comments() ) { ?>
<div class="pt-5">
	<div id="comments" class="streamvault-blog-comments">
		<h2 class="fw-bold text-dark-300 text-18 mb-4">
		    <?php
		    $streamvault_comment_count = get_comments_number();
	
	        // Display regular comments count
	        if ('1' === $streamvault_comment_count) {
	            printf(
	                esc_html__('One comment on &ldquo;%1$s&rdquo;', 'streamvault'),
	                '<span>' . get_the_title() . '</span>'
	            );
	        } else {
	            printf(
	                esc_html(_nx('%1$s comments', '%1$s comments', $streamvault_comment_count, 'comments title', 'streamvault')),
	                number_format_i18n($streamvault_comment_count),
	                '<span>' . get_the_title() . '</span>'
	            );
	        }
		    ?>
		</h2>
		<!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<div class="d-flex flex-column gap-4">
			<?php
			wp_list_comments( array(
				'style'      => 'div',
				'short_ping' => true,
				'avatar_size' => 95,
				'callback' => 'streamvault_comment_list',
			) );
			?>
		</div><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'streamvault' ); ?></p>
			<?php
		endif; ?>
	</div>
</div>
<?php } // Check for have_comments().?>

<div class="row">
	<div class="col-12">
		<div class="comment-form mt-5">
			<?php

			// Define the default comment form fields
			$comment_form_fields = array(
			    'id_form'           => 'commentform',
			    'class_form'        => 'row',
			    'submit_field'      => '<div class="col-lg-12">%1$s %2$s</div>',
			    'submit_button'     => '<button type="submit" class="w-btn-secondary-lg">%4$s</button>',
			    'label_submit'      => esc_html__('Post Comment', 'streamvault'),
			    'title_reply'       => esc_html__('Write Your Comment', 'streamvault'),
			    'format'            => 'html5',
			    'comment_notes_before' => false,
			    'comment_field' =>  '
			      	<div class="col-xl-12">
				      	<div class="comment-form-input">
				      		<textarea id="comment" class="form-control form-textarea" name="comment" placeholder="' . esc_attr__('Type your comment....', 'streamvault') . '" aria-required="true">' . '</textarea>
				 	 	</div>
			 	 	</div>',
			    'fields' => apply_filters('streamvault_comment_form_default_fields', array(
			        'author' =>
			            '<div class="col-lg-6">
				            <div class="comment-form-input">
							    <input id="author" class="form-control" name="author" type="text" placeholder="' . esc_attr__('Type your name....', 'streamvault') . '" value="' . esc_attr($commenter['comment_author']) . '" aria-required="true" />
							</div>
						</div>',
			        'email' =>
			            '<div class="col-lg-6">
				            <div class="comment-form-input">
							    <input id="email" class="form-control" name="email" type="text" placeholder="' . esc_attr__('Type your email....', 'streamvault') . '" value="' . esc_attr($commenter['comment_author_email']) . '" aria-required="true" />
							</div>
						</div>',
			    )),
			);

			// Output the comment form with the specified fields
			comment_form($comment_form_fields); ?>

		</div>
	</div>
</div><!-- #comments -->


