<?php get_header();?>

<section class="main">

<?php
$actus = get_posts(array('post_type' => 'videos'));

if($actus) :
  foreach ($actus as $post) :
    setup_postdata($post);
    $meta = get_post_meta( $post->ID, 'video_fields', true );
    if ($meta['text']) :
    ?>

    <article class="video-details">
      <div class="video"><iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $meta['text']; ?>?wmode=opaque&amp;rel=0&amp;autohide=1&amp;showinfo=0&amp;wmode=transparent&amp;modestbranding=1" frameborder="0" allowfullscreen></iframe></div>
      <div class="video-title"><div><?php the_title(); ?></div></div>
    </article>


        <?php endif ?>
    <?php
  endforeach;
endif;
?>
</section>
<?php get_footer(); ?>
