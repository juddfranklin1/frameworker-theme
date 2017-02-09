<?php
/**
 * The template for displaying standard pages
 *
 */

get_header(); ?>

<div class="container">
	<div id="primary" class="row">
		<main id="main" class="col-xs-12 site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();
				if (is_front_page()){
					get_template_part( 'template-parts/page/content', 'home' );
				} else {
					get_template_part( 'template-parts/page/content', 'page' );
				}

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
