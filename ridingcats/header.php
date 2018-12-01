<?php
wp_nav_menu( array( 'theme_location' => 'header-menu' ) );

$categories = get_categories();
foreach($categories as $cat) {
  echo '<a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a>';
}
 ?>
