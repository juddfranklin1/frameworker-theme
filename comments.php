<?php

/**
 * comments
 *
*/

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( '1' == $comments_number ) {
					/* translators: %s: post title */
					printf('One Reply to &ldquo;%s&rdquo;', get_the_title() );
				} else {
					printf(
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						get_the_title()
					);
				}
			?>
		</h2>

		<ol class="comment-list list-unstyled">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'ul',
					'short_ping'  => true,
					'reply_text'  => 'Reply',
          'walker'      => new WP_Bootstrap_Comments_Walker(),
        ) );
			?>
		</ol>

		<?php the_comments_pagination( array(
			'prev_text' => '<span class="screen-reader-text">Previous</span>',
			'next_text' => '<span class="screen-reader-text">Next</span>' ) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php echo 'Comments are closed.'; ?></p>
	<?php
	endif;

  $comment_form_settings = array(
    'class_form' => 'comment-form form-group',
    'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label><textarea id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true">' .
    '</textarea></p>',

  );

	comment_form($comment_form_settings);
	?>

</div><!-- #comments -->
