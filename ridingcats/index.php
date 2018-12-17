
<?php
get_header();
 ?>

<?php echo apply_filters( 'the_content', get_post(get_query_var( 'page_id', 1 ))->post_content );  ?>

 <?php get_footer(); ?>
