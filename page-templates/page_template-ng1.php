<?php
/**
 * Template Name: AngularJS 1.x Template
 * The template for displaying the AngularJS 1.x single-page application
 *
 */
 if(get_current_template() == 'page_template-ng1.php'){// Stuff for Angular 1.x page
   require_once get_template_directory() . '/code/framework_ng1_class.php';
 	 $frameworkInit = new Ng1_Framework_Builder (
     'ng_1',
     array(
      array(
      	"handle"	=> 'ng1-scramblr-service',
      	"src"			=> get_template_directory_uri() . '/ng1/js/services/scramblr-service.js',
        "deps"		=> array(),
      	"ver"			=> '0.1',
      	"in_foot"	=> true),
      array(
        "handle"	=> 'ng1-wordpress-service',
        "src"			=> get_template_directory_uri() . '/ng1/js/services/wordpress-service.js',
        "deps"		=> array(),
        "ver"			=> '0.1',
        "in_foot"	=> true),
    	array(
      	"handle"	=> 'ng1-routes',
      	"src"			=> get_template_directory_uri() . '/ng1/js/ng1-routes.js',
      	"deps"		=> array(),
      	"ver"			=> '0.1',
      	"in_foot"	=> true),
    	array(
      	"handle"	=> 'ng1-implementation',
      	"src"			=> get_template_directory_uri() . '/ng1/js/ng1-app.js',
      	"deps"		=> array(),
      	"ver"			=> '0.1',
      	"in_foot"	=> true),
    ),
    array(
    	array(
    		"handle"=>'',
    		"src"=>'',
    		"deps"=>'',
    		"media"=>''
    	),
    )
  );

  add_action('wp_enqueue_scripts',array($frameworkInit,'ng_1_Enqueuing'));

  add_action( 'rest_api_init', function() {
    register_rest_field( 'post', 'karma', array(
      'get_callback' => function( $meta_arr ) {
          $meta_obj = get_meta( $meta_arr['id'] );
          return (int) $meta_obj->meta_karma;
      },
      'schema' => array(
          'description' => __( 'Meta karma.' ),
          'type'        => 'integer'
      ),
    ) );
  } );
}

get_header(); ?>

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'ng1' );

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
