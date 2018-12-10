
<?php
get_header();

$gallery = get_posts(array('category_name' => 'gallery'));

if($gallery) :
  foreach ($gallery as $post) :
  setup_postdata($post);
  the_content();
endforeach;
endif;
 ?>

 <?php get_footer(); ?>
