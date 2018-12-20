<?php get_header();?>

<section class="main">

<?php
$actus = get_posts(array('post_type' => 'actus', 'post_status' => 'publish,future', 'nopaging' => true));

if($actus) :
  foreach ($actus as $post) :
    setup_postdata($post);
    $meta = get_post_meta( $post->ID, 'actu_fields', true );
    ?>

    <article class="actu">
        <div class="date">
          <div class="day"><?php echo get_the_date("d");?></div>
          <div class="month"><?php echo get_the_date("M");?></div>
          <div class="year"><?php echo get_the_date("Y");?></div>
        </div>
        <?php
          $thumbnail = get_theme_root_uri()."/ridingcats/assets/images/actus-default.png";
          if(has_post_thumbnail()):
            $thumbnail = get_the_post_thumbnail_url();
          endif
         ?>
        <div class="thumbnail"><img src="<?php echo $thumbnail?>"/></div>
        <div class="actu-content">
          <div class="title"><?php the_title()?></div>
          <div class="location"><?php echo strip_tags(get_the_term_list( $post->ID, 'lieux' )); ?></div>
        </div>

        <?php if ($meta['text']) :?>
        <div class="fblink"><a href="<?php echo $meta['text']; ?>"><img src="<?php echo get_theme_root_uri()?>/ridingcats/assets/images/fb.png" width="120px" height="120px"/></a></div>
        <?php endif ?>
      </article>
    <?php
  endforeach;
endif;
wp_reset_postdata();
?>
</section>
<?php get_footer(); ?>
