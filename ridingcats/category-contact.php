
<?php get_header(); ?>

<section class="main-contact">


<?php
$contacts = get_posts(array('category_name' => 'contact', 'nopaging' => true));

if($contacts) :
  foreach ($contacts as $post) :
  setup_postdata($post);
?>


     <article class="contact">
       <img src="<?php the_post_thumbnail_url()?>"/>
       <div class="contact-detail"><b><?php the_content()?></b></div>
     </article>


    <?php
  endforeach;
endif;
wp_reset_postdata();
 ?>

</section>

<?php get_footer(); ?>
