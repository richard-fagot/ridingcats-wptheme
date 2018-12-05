<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="content">
    <header>
      <nav>
        <ul class="navigation">
        <?php

          $menu = wp_get_nav_menu_object( get_nav_menu_locations()['header-menu'] );
          $menu_items = wp_get_nav_menu_items($menu->term_id);

          foreach ( $menu_items as $menu_item ) {
            $title = $menu_item->title;
            $url = $menu_item->url;
            echo '<li><a href="' . $url . '">' . $title . '</a></li>';
          }
        //wp_nav_menu( array( 'theme_location' => 'header-menu' ) );
        ?>
<!--
        <ul class="navigation">
<?php

$categories = get_categories();
foreach($categories as $cat) {
  echo '<li><a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a></li>';
}
 ?>
-->
</ul>

</nav>
</header>
