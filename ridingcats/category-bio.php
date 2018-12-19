
<?php get_header(); ?>

<section class="main">

  <article class="bio">
    <img src="<?php echo get_theme_root_uri()?>/ridingcats/assets/images/logo.png"/>
  </article>

<?php
$lang = get_query_var('lang', 'fr');
$biblio = get_posts(array('category_name' => 'bio+'.$lang, 'nopaging' => true));

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
wp_reset_postdata();
 ?>

</section>

<?php get_footer(); ?>
