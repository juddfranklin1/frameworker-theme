<?php
// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class Framework_Builder {
  function __construct($framework_name, $more_scripts=array(), $more_styles=array()){
    //set some specific data for given frameworks
    self::set_framework_name($framework_name);
    self::set_more_scripts($more_scripts, true);
    self::set_more_styles($more_styles);
  }

  private $framework_name = '';

  protected function set_framework_name($name){
    $this->framework_name = $name;
  }

  protected function get_framework_name(){
    return $this->framework_name;
  }

  private $more_scripts = [];

  protected function set_more_scripts($more_scripts,$prepend){
    if(!isset($prepend)) {
      $prepend = false;
    }
    if($prepend) {
      foreach ($more_scripts as $script){
        array_unshift($this->more_scripts, $script);
      }
    } else {
      foreach ($more_scripts as $script){
        $this->more_scripts[] = $script;
      }
    }
  }

  protected function get_more_scripts(){
    return $this->more_scripts;
  }

  private $more_styles = array();

  protected function set_more_styles($more_styles){
    $this->more_styles = $more_styles;
  }

  protected function get_more_styles(){
    return $this->more_styles;
  }

  // Set up baseline scripts based upon the framework name/version
  // being passed in the initialization script.
  // then include the baseline scripts in the enqueuing script below.

}
?>
