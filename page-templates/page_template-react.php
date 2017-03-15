<?php
/**
 * Template Name: React Template
 * The template for displaying the React single-page application
 *
 */
 if(get_current_template() == 'page_template-react.php'){// Stuff for Angular 1.x page
   require_once get_template_directory() . '/code/framework_react_class.php';
 	 $frameworkInit = new React_Framework_Builder (
     'react',
     array(
       array(
        "handle"	=> 'react-router',
        "src"			=> 'https://npmcdn.com/react-router@2.4.0/umd/ReactRouter.min.js',
        "deps"		=> array(),
        "ver"			=> '2.4.0',
        "in_foot"	=> false),
       array(
       	"handle"	=> 'babel-core',
       	"src"			=> 'https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js',
       	"deps"		=> array(),
       	"ver"			=> '5.8.23',
       	"in_foot"	=> false),
      array(
      	"handle"	=> 'react-dom',
      	"src"			=> 'https://unpkg.com/react-dom@15.3.2/dist/react-dom.js',
      	"deps"		=> array(),
      	"ver"			=> '15.3.2',
      	"in_foot"	=> false),
      array(
      	"handle"	=> 'react',
      	"src"			=> 'https://unpkg.com/react@15.3.2/dist/react.js',
      	"deps"		=> array(),
      	"ver"			=> '15.3.2',
      	"in_foot"	=> false),
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

  add_action('wp_enqueue_scripts',array($frameworkInit,'react_Enqueuing'));

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

				get_template_part( 'template-parts/page/content', 'react' );

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
