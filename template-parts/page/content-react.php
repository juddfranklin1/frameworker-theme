<?php
/**
 * Template part for displaying page content in page-angularjs.php
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
		<?php require get_template_directory()."/react/index.php"; ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
