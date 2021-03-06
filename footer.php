<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

		</div><!-- #content -->
	</div><!-- .site-content-contain -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrap container">
			<?php
			get_template_part( 'template-parts/footer/footer', 'widgets' );

			get_template_part( 'template-parts/footer/site', 'info' );
			?>
		</div><!-- .wrap -->
	</footer><!-- #colophon -->
<?php wp_footer(); ?>

</body>
</html>
