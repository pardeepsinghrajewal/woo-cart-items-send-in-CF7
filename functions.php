<?php
/** Load Extra Content Into Footer **/
function wcLoadExtraContentIntoFooter() 
{
  if(file_exists(get_stylesheet_directory().'/footer-hook.php'))
  {
    include_once get_stylesheet_directory().'/footer-hook.php';
  }
}
add_action( 'wp_footer', 'wcLoadExtraContentIntoFooter' );

/** Contact-form-7 custom code **/
if(file_exists(get_stylesheet_directory().'/contact-form-7/contact-form-hooks.php'))
{
  include_once get_stylesheet_directory().'/contact-form-7/contact-form-hooks.php';
}


if(!function_exists('error_log_var'))
{
  function error_log_var( $object=null )
  {
    ob_start();
    print_r($object);
    $contents = ob_get_contents();
    ob_end_clean();
    error_log($contents);
  } 
}