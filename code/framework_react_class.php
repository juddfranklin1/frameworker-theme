<?php
  // Exit if accessed directly
  defined( 'ABSPATH' ) || exit;

  class React_Framework_Builder extends Framework_Builder {
    public function react_Enqueuing(){
      $scripts = self::set_more_scripts(array(
        array(
          "handle"	=> '',
          "src"			=> '',
          "deps"		=> array(),
          "ver"			=> '0.1',
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
