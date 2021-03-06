<?php
/**
 * Template Name: AngularJS 2.x Template
 * The template for displaying the AngularJS 2 single-page application
 *
 */
 if(get_current_template() == 'page_template-ng2.php'){// Stuff for Angular 1.x page
   require_once get_template_directory() . '/code/framework_ng2_class.php';
 	 $frameworkInit = new Ng2_Framework_Builder (
     'ng_2',
     array(
    	array(
      	"handle"	=> '',
      	"src"			=> '',
      	"deps"		=> array(),
      	"ver"			=> '0.1',
      	"in_foot"	=> true),
    ),
    array(
    	array(
    		"handle"=>'font-awesome',
    		"src"=>'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
    		"deps"=>'',
    		"media"=>''
    	),
    )
  );

  add_action('wp_enqueue_scripts',array($frameworkInit,'ng_2_Enqueuing'));

  function angular_rewrite_path_set() {
    add_rewrite_rule( '^index.php\/ng2\/(.*)\/?', "index.php?page_id="+get_the_ID(), 'top' );
  }
  add_action('init', 'angular_rewrite_path_set');

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

				get_template_part( 'template-parts/page/content', 'ng2' );

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
