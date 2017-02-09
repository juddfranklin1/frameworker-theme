<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">

		<?php
			/* translators: %s: Name of current post */
			$postFormat = get_post_format();
			if ($postFormat === "video" || $postFormat === "quote"){
				the_content( sprintf( 'Continue reading<span class="screen-reader-text"> "%s"</span>',
					get_the_title()
				) );
				?><a href="<?php echo get_permalink() ?>">Single This Post Out</a><?php
			} else {
				the_excerpt();
				?><a href="<?php echo get_permalink() ?>">Single This Post Out</a><?php
			}


			wp_link_pages( array(
				'before'      => '<div class="page-links">Pages:',
				'after'       => '</div>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
</section><!-- #post-## -->
