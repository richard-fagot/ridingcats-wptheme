<?php
/**
 * Riding Cats functions and definitions
 *
 * @link https://www.riding-cats.fr
 *
 * @package WordPress
 * @subpackage Riding_Cats
 * @since 1.0
 */


// Add suport for menu
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' )
     )
   );
 }
 add_action( 'init', 'register_my_menus' );

// Add support for thumbnails for all posts
 add_theme_support( 'post-thumbnails' );

// Add support for background image and the abaility to customize it from the interface.
$bckgnd = array(
  'default-repeat' => 'no-repeat',
  'default-attachment' => 'fixed',
  'default-position' => 'center',
  'default-image' => '%1$s/assets/images/site-background.jpg'
);
 add_theme_support( 'custom-background', $bckgnd );


// Add custom style stylesheet to the header.
 wp_enqueue_style('style', get_stylesheet_uri());


/*******************************************************************************
Create the Actu post type
from (https://wpmarmite.com/snippet/creer-custom-post-type/)
*******************************************************************************/
 function wpm_actus_post_type() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'Actus', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'Actu', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'Actus'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Toutes les actus'),
		'view_item'           => __( 'Voir les actus'),
		'add_new_item'        => __( 'Ajouter une actu'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer'),
		'update_item'         => __( 'Modifier'),
		'search_items'        => __( 'Rechercher'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);

	// On peut définir ici d'autres options pour notre custom post type

	$args = array(
		'label'               => __( 'Actus'),
		'description'         => __( 'Toutes les actus'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'thumbnail' ),
		/*
		* Différentes options supplémentaires
		*/
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'actus'),

	);

	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type( 'actus', $args );

}
add_action( 'init', 'wpm_actus_post_type', 0 );


/******************************************************
Add custom field FacebookLink
(from https://www.taniarascia.com/wordpress-part-three-custom-fields-and-metaboxes/)
******************************************************/
//Add facebook link field to the Actu post
function add_actus_meta_box() {
	add_meta_box(
		'fb_link', // $id
		'Lien Facebook', // $title
		'show_your_fields_meta_box', // $callback
		'actus', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_actus_meta_box' );

// Display the input box to enter the facebook link
function show_your_fields_meta_box() {
	global $post;
		$meta = get_post_meta( $post->ID, 'actu_fields', true ); ?>

	<input type="hidden" name="actu_fb_link" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

  <p>
	<input type="text" name="actu_fields[text]" id="actu_fields[text]" class="regular-text" value="<?php  if (is_array($meta) && isset($meta['text'])){ echo $meta['text']; } ?>">
</p>

	<?php }


function save_actu_fields_meta( $post_id ) {
  	// verify nonce
  	if ( !wp_verify_nonce( $_POST['actu_fb_link'], basename(__FILE__) ) ) {
  		return $post_id;
  	}
  	// check autosave
  	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
  		return $post_id;
  	}
  	// check permissions
  	if ( 'page' === $_POST['actus'] ) {
  		if ( !current_user_can( 'edit_page', $post_id ) ) {
  			return $post_id;
  		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
  			return $post_id;
  		}
  	}

  	$old = get_post_meta( $post_id, 'actu_fields', true );
  	$new = $_POST['actu_fields'];

  	if ( $new && $new !== $old ) {
  		update_post_meta( $post_id, 'actu_fields', $new );
  	} elseif ( '' === $new && $old ) {
  		delete_post_meta( $post_id, 'actu_fields', $old );
  	}
  }
  add_action( 'save_post', 'save_actu_fields_meta' );


/**************************************
Add taxonomy Lieu to the actu post
***************************************/
function wpm_add_taxonomies() {
	// Taxonomie Lieux

	$labels_lieux = array(
		'name'                       => _x( 'Lieux', 'taxonomy general name'),
		'singular_name'              => _x( 'Lieu', 'taxonomy singular name'),
		'search_items'               => __( 'Rechercher un lieu'),
		'popular_items'              => __( 'Lieux populaires'),
		'all_items'                  => __( 'Tous les lieux'),
		'edit_item'                  => __( 'Editer un lieu'),
		'update_item'                => __( 'Mettre à jour un lieu'),
		'add_new_item'               => __( 'Ajouter un nouveau lieu'),
		'new_item_name'              => __( 'Nom du nouveau lieu'),
		'separate_items_with_commas' => __( 'Séparer les lieux avec une virgule'),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer un lieu'),
		'choose_from_most_used'      => __( 'Choisir parmi les plus utilisés'),
		'not_found'                  => __( 'Pas de lieu trouvé'),
		'menu_name'                  => __( 'Lieux'),
	);

	$args_lieux = array(
		'hierarchical'          => false,
		'labels'                => $labels_lieux,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'lieux' ),
	);

	register_taxonomy( 'lieux', 'actus', $args_lieux );
}
add_action( 'init', 'wpm_add_taxonomies', 0 );

/*******************************************************************************
Add default categories
*******************************************************************************/
function example_insert_category() {
	wp_insert_term(
		'BIOGRAPHIE',
		'category',
		array(
		  'description'	=> 'Entrées de biographie',
		  'slug' 		=> 'bio'
		)
	);
	wp_insert_term(
		'ACTUS',
		'category',
		array(
		  'description'	=> 'Toutes les actus',
		  'slug' 		=> 'actus'
		)
	);
	wp_insert_term(
		'PHOTOS',
		'category',
		array(
		  'description'	=> 'Gallerie photo',
		  'slug' 		=> 'gallery'
		)
	);
	wp_insert_term(
		'VIDEOS',
		'category',
		array(
		  'description'	=> 'Video Playlist',
		  'slug' 		=> 'video'
		)
	);
	wp_insert_term(
		'PRESSE',
		'category',
		array(
		  'description'	=> 'Articles de presse',
		  'slug' 		=> 'presse'
		)
	);
	wp_insert_term(
		'CONTACT',
		'category',
		array(
		  'description'	=> 'Les moyens de contact',
		  'slug' 		=> 'contact'
		)
	);
}
add_action( 'after_setup_theme', 'example_insert_category' );
?>
