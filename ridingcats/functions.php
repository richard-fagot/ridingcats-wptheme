<?php
/**
 * Riding Cats functions and definitions
 *
 * @link https://www.riding-cats.fr
 *
 * @package WordPress
 * @subpackage Riding_Cats
 * @since 1.0
 */


function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' )
     )
   );
 }
 add_action( 'init', 'register_my_menus' );
?>
