<?php

get_header(); ?>

<div class="wrap container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main row" role="main">
			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					?>
					<div class="col-md-12">
					<?php
						get_template_part( 'template-parts/post/content', get_post_format() );
					?>
					</div>
					<?php
					?>
					<div class="col-md-12">
					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					?>
					</div>
					<?php
				endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
