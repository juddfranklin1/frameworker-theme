<?php
  // Exit if accessed directly
  defined( 'ABSPATH' ) || exit;

  class Ng1_Framework_Builder extends Framework_Builder {
    public function ng_1_Enqueuing(){
      $scripts = self::set_more_scripts(array(
        array(
          "handle"	=> 'angular-messages',
          "src"			=> 'https://code.angularjs.org/1.5.7/angular-messages.min.js',
          "deps"			=> array(),
          "ver"			=> '1.5.7',
          "in_foot"	=> true),
        array(
          "handle"	=> 'angular-resource',
          "src"			=> 'https://code.angularjs.org/1.5.7/angular-resource.min.js',
          "deps"			=> array(),
          "ver"			=> '1.5.7',
          "in_foot"	=> true),
        array(
          "handle"	=> 'angular-sanitize',
          "src"			=> 'https://code.angularjs.org/1.5.7/angular-sanitize.min.js',
          "deps"			=> array(),
          "ver"			=> '1.5.7',
          "in_foot"	=> true),
        array(
          "handle"	=> 'angular-routes',
          "src"			=> 'https://code.angularjs.org/1.5.7/angular-route.min.js',
          "deps"			=> array(),
          "ver"			=> '1.5.7',
          "in_foot"	=> true),
        array(
          "handle"	=> 'angular-spinners',
          "src"			=> get_template_directory_uri() . '/ng1/js/angular-spinners.min.js',
          "deps"			=> array(),
          "ver"			=> '3.1.2',
          "in_foot"	=> true),
        array(
          "handle"	=> 'angular',
          "src"			=> 'https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js',
          "deps"			=> array(),
          "ver"			=> '1.5.7',
          "in_foot"	=> true),
        ),true);
      $styles = self::get_more_styles();
      $scripts = self::get_more_scripts();
      for ($i = 0; $i < sizeof($styles); $i++) {
        wp_enqueue_style($styles[$i]['handle'], $styles[$i]['src'], $styles[$i]['deps'], $styles[$i]['media'] );
      }
      for ($i=0; $i < sizeof($scripts); $i++) {
        wp_enqueue_script( $scripts[$i]['handle'], $scripts[$i]['src'], $scripts[$i]['deps'], $scripts[$i]['ver'], $scripts[$i]['in_foot'] );
      }
    }
  }
?>
