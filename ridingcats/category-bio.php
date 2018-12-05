
<?php get_header(); ?>

<section class="main">

  <article class="bio">
    <img src="<?php echo get_theme_root_uri()?>/ridingcats/assets/images/logo.png"/>
  </article>

<?php
$biblio = get_posts(array('category_name' => 'bio'));

if($biblio) :
  foreach ($biblio as $post) :
  setup_postdata($post);
?>

  <article class="bio">
      <div class="bio-img">
        <img class="rounded box-shadowed" src="<?php the_post_thumbnail_url()?>"/>
      </div>
      <div class="bio-txt">
        <div>
          <?php the_content(); ?>
        </div>
      </div>
    </article>


    <?php
  endforeach;
endif;
 ?>

</section>

<?php get_footer(); ?>
