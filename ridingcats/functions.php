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


function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' )
     )
   );
 }
 add_action( 'init', 'register_my_menus' );

 add_theme_support( 'post-thumbnails' );

$bckgnd = array(
  'default-repeat' => 'no-repeat',
  'default-attachment' => 'fixed',
  'default-position' => 'center',
  'default-image' => '%1$s/assets/images/site-background.jpg'
);
 add_theme_support( 'custom-background', $bckgnd );

 wp_enqueue_style('style', get_stylesheet_uri());

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
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
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


add_action( 'init', 'wpm_add_taxonomies', 0 );

//On crée 3 taxonomies personnalisées: Année, Réalisateurs et Catégories de série.

function wpm_add_taxonomies() {

	// Taxonomie Année

	// On déclare ici les différentes dénominations de notre taxonomie qui seront affichées et utilisées dans l'administration de WordPress
	$labels_annee = array(
		'name'              			=> _x( 'Années', 'taxonomy general name'),
		'singular_name'     			=> _x( 'Année', 'taxonomy singular name'),
		'search_items'      			=> __( 'Chercher une année'),
		'all_items'        				=> __( 'Toutes les années'),
		'edit_item'         			=> __( 'Editer l année'),
		'update_item'       			=> __( 'Mettre à jour l année'),
		'add_new_item'     				=> __( 'Ajouter une nouvelle année'),
		'new_item_name'     			=> __( 'Valeur de la nouvelle année'),
		'separate_items_with_commas'	=> __( 'Séparer les réalisateurs avec une virgule'),
		'menu_name'         => __( 'Année'),
	);

	$args_annee = array(
	// Si 'hierarchical' est défini à false, notre taxonomie se comportera comme une étiquette standard
		'hierarchical'      => false,
		'labels'            => $labels_annee,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'annees' ),
	);

	register_taxonomy( 'annees', 'actus', $args_annee );

	// Taxonomie Réalisateurs

	$labels_realisateurs = array(
		'name'                       => _x( 'Réalisateurs', 'taxonomy general name'),
		'singular_name'              => _x( 'Réalisateur', 'taxonomy singular name'),
		'search_items'               => __( 'Rechercher un réalisateur'),
		'popular_items'              => __( 'Réalisateurs populaires'),
		'all_items'                  => __( 'Tous les réalisateurs'),
		'edit_item'                  => __( 'Editer un réalisateur'),
		'update_item'                => __( 'Mettre à jour un réalisateur'),
		'add_new_item'               => __( 'Ajouter un nouveau réalisateur'),
		'new_item_name'              => __( 'Nom du nouveau réalisateur'),
		'separate_items_with_commas' => __( 'Séparer les réalisateurs avec une virgule'),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer un réalisateur'),
		'choose_from_most_used'      => __( 'Choisir parmi les plus utilisés'),
		'not_found'                  => __( 'Pas de réalisateurs trouvés'),
		'menu_name'                  => __( 'Réalisateurs'),
	);

	$args_realisateurs = array(
		'hierarchical'          => false,
		'labels'                => $labels_realisateurs,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'realisateurs' ),
	);

	register_taxonomy( 'realisateurs', 'actus', $args_realisateurs );

	// Catégorie de série

	$labels_cat_serie = array(
		'name'                       => _x( 'Catégories de série', 'taxonomy general name'),
		'singular_name'              => _x( 'Catégories de série', 'taxonomy singular name'),
		'search_items'               => __( 'Rechercher une catégorie'),
		'popular_items'              => __( 'Catégories populaires'),
		'all_items'                  => __( 'Toutes les catégories'),
		'edit_item'                  => __( 'Editer une catégorie'),
		'update_item'                => __( 'Mettre à jour une catégorie'),
		'add_new_item'               => __( 'Ajouter une nouvelle catégorie'),
		'new_item_name'              => __( 'Nom de la nouvelle catégorie'),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer une catégorie'),
		'choose_from_most_used'      => __( 'Choisir parmi les catégories les plus utilisées'),
		'not_found'                  => __( 'Pas de catégories trouvées'),
		'menu_name'                  => __( 'Catégories de série'),
	);

	$args_cat_serie = array(
	// Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
		'hierarchical'          => true,
		'labels'                => $labels_cat_serie,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'categories-series' ),
	);

	register_taxonomy( 'categoriesseries', 'actus', $args_cat_serie );
}

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
