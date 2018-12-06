<?php
get_header();

$actus = get_posts(array('post_type' => 'actus'));

if($actus) :
  foreach ($actus as $post) :
    setup_postdata($post);
    ?>

    <p>Concert : <?php the_title()?></p>
    <p>Facebook : <?php $meta = get_post_meta( $post->ID, 'actu_fields', true ); echo $meta['text']; ?></p>
    <p>Lieu : <?php the_terms( $post->ID, 'lieux' ); ?></p>
    <p><img class="rounded box-shadowed" src="<?php the_post_thumbnail_url()?>"/></p>
    <?php
  endforeach;
endif;
get_footer(); ?>
