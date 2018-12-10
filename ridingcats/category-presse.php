
<?php get_header(); ?>

<section class="main">


  <?php
  $presse = get_posts(array('category_name' => 'presse'));
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
 ?>

</section>

<?php get_footer(); ?>
