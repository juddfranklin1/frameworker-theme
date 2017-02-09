<?php
/**
 * The main template file
 */

get_header(); ?>

<div class="container">
	<div id="primary" class="row">
		<main id="main" class="col-xs-12 site-main" role="main">
			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header class="page-header">
					<h1 class="page-title"><?php single_post_title(); ?></h1>
				</header>
			<?php else : ?>
			<header class="page-header">
				<h2 class="page-title"><?php _e( 'Posts', 'twentyseventeen' ); ?></h2>
			</header>
			<?php endif; ?>

					<?php
					if ( have_posts() ) :
						if(is_singular()){
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/post/content', get_post_format() );

							endwhile;

							echo '<!-- Pagination could go here -->';

						} else {
							while ( have_posts() ) : the_post();
							
								get_template_part( 'template-parts/post/content-listing' );

							endwhile;

							echo '<!-- Pagination could go here -->';
						}
						/* Start the Loop */

					else :

						get_template_part( 'template-parts/post/content', 'none' );

					endif;
					?>
				</main><!-- #main -->
			</div><!-- #primary -->

	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
