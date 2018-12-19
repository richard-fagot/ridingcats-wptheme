
<?php get_header(); ?>

<section class="main">


  <?php
  $lang = get_query_var('lang', 'fr');
  $presse = get_posts(array('category_name' => 'presse+'.$lang, 'nopaging' => true));
  if($presse) :
    foreach ($presse as $post) :
      setup_postdata($post);
      ?>

  <article class="presse">
    <h2><?php the_title()?></h2>
    <div><?php the_content(); ?></div>
  </article>

    <?php
  endforeach;
endif;
wp_reset_postdata();
 ?>

</section>

<?php get_footer(); ?>
