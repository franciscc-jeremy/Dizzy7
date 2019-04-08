<?php
  header('Content-type: text/css');
  require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
?> 
/*Custom CSS for editor from the customizer*/
<?php if (get_theme_mod( 'diz-custom-typography-css')) {
      echo get_theme_mod( 'diz-custom-typography-css', '' );
  }?>