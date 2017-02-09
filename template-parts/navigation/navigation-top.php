<?php
/**
 * Displays top navigation
 */
	define('__ROOT__', get_template_directory());
	require_once(__ROOT__.'/code/juddtheme_navigation.php');
?>
<nav id="site-navigation" class="main-navigation navbar navbar-default" role="navigation" aria-label="<?php _e( 'Top Menu', 'twentyseventeen' ); ?>">
	<!-- <button class="menu-toggle" aria-controls="top-menu" aria-expanded="false"><?php /* echo twentyseventeen_get_svg( array( 'icon' => 'bars' ) ); echo twentyseventeen_get_svg( array( 'icon' => 'close' ) ); _e( 'Menu', 'twentyseventeen' );*/ ?></button> -->
	<?php
		if (has_nav_menu('header')) {
			wp_nav_menu( array(
				'theme_location' => 'header',
				'menu_id'        => 'top-menu',
				'menu_class'=> 'nav',
				'walker'				 => new Juddtheme_Navigation_Walker(),
			) );
		} ?>
</nav><!-- #site-navigation -->
