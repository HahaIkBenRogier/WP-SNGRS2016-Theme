<?php 

/// CUSTOM POST TYPE - ROGIER
if ( ! function_exists('sngrs_rgr_cpt_func') ) {
function sngrs_rgr_cpt_func() {
	$labels = array(
		'name'                  => _x( 'Over Rogiers', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Over Rogier', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Over Rogiers', 'text_domain' ),
		'name_admin_bar'        => __( 'Over Rogier', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'rogier',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Over Rogier', 'text_domain' ),
		'description'           => __( 'Eigen portfolio dingen', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'post-formats', ),
		'taxonomies'            => array( 'category','sngrs_rgr_tax' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-smiley',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'query_var'             => 'sngrs_rgr',
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'sngrs_rgr_cpt', $args );

}
add_action( 'init', 'sngrs_rgr_cpt_func', 0 );
}

/// CUSTOM TAXONOMY - ROGIER
if ( ! function_exists( 'sngrs_rgr_tax_func' ) ) {
function sngrs_rgr_tax_func() {

	$labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'rgr-tag',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'sngrs_tax',
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'sngrs_rgr_tax', array( 'sngrs_rgr_cpt' ), $args );

}
add_action( 'init', 'sngrs_rgr_tax_func', 0 );
}

/// ADD TO CATEGORY - ROGIER

function sngrs_rgr_cat_func( $post_ID ) {
    $post_type = 'sngrs_rgr_cpt';
    $cat_id = 27; // Your reviews category id (for example: 123)
    $post_categories=array($cat_id);

    // check if current post type is movie review
    if(get_post_type($post_ID)==$post_type) {
        // assign a category for this post by default
        wp_set_post_categories( $post_ID->ID, $post_categories );
    }

   return $post_ID;
}
add_action('the_post', 'sngrs_rgr_cat_func');
add_action('save_post', 'sngrs_rgr_cat_func');
add_action('draft_to_publish', 'sngrs_rgr_cat_func');
add_action('new_to_publish', 'sngrs_rgr_cat_func');
add_action('pending_to_publish', 'sngrs_rgr_cat_func');
add_action('future_to_publish', 'sngrs_rgr_cat_func');

/// CUSTOM POST TYPE - SCHOOL
if ( ! function_exists('sngrs_school_cpt_func') ) {
function sngrs_school_cpt_func() {

	$labels = array(
		'name'                  => _x( 'Schooldingen', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Schoolding', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Schooldingen', 'text_domain' ),
		'name_admin_bar'        => __( 'Schoolding', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'school',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Schoolding', 'text_domain' ),
		'description'           => __( 'Schoolportfolio dingen', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'            => array( 'category', 'sngrs_school_tax' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-book',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'query_var'             => 'sngrs_school',
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'sngrs_school_cpt', $args );

}
add_action( 'init', 'sngrs_school_cpt_func', 0 );

}

/// CUSTOM TAXONOMY - SCHOOL

if ( ! function_exists( 'sngrs_school_tax_func' ) ) {
function sngrs_school_tax_func() {

	$labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'school-tag',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'sngrs_tax',
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'sngrs_school_tax', array( 'sngrs_school_cpt' ), $args );

}
add_action( 'init', 'sngrs_school_tax_func', 0 );

}

/// ADD TO CATEGORY - SCHOOL

function sngrs_school_cat_func( $post_ID ) {
    $post_type = 'sngrs_school_cpt';
    $cat_id = 28; // Your reviews category id (for example: 123)
    $post_categories=array($cat_id);

    // check if current post type is movie review
    if(get_post_type($post_ID)==$post_type) {
        // assign a category for this post by default
        wp_set_post_categories( $post_ID->ID, $post_categories );
    }

   return $post_ID;
}
add_action('the_post', 'sngrs_school_cat_func');
add_action('save_post', 'sngrs_school_cat_func');
add_action('draft_to_publish', 'sngrs_school_cat_func');
add_action('new_to_publish', 'sngrs_school_cat_func');
add_action('pending_to_publish', 'sngrs_school_cat_func');
add_action('future_to_publish', 'sngrs_school_cat_func');

/// CUSTOM POST TYPE - SNGRS

if ( ! function_exists('sngrs_sngrs_cpt_func') ) {

// Register Custom Post Type
function sngrs_sngrs_cpt_func() {

	$labels = array(
		'name'                  => _x( 'Portfoliodingen', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Portfolioding', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Portfoliodingen', 'text_domain' ),
		'name_admin_bar'        => __( 'Portfolioding', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'portfolio',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Portfolioding', 'text_domain' ),
		'description'           => __( 'Eigen portfolio dingen', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'            => array('category', 'sngrs_sngrs_tax' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-awards',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'query_var'             => 'sngrs_sngrs',
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'sngrs_sngrs_cpt', $args );

}
add_action( 'init', 'sngrs_sngrs_cpt_func', 0 );

}

/// CUSTOM TAXONOMY - SNGRS

if ( ! function_exists( 'sngrs_sngrs_tax_func' ) ) {
function sngrs_sngrs_tax_func() {

	$labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'sngrs-tag',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'sngrs_tax',
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'sngrs_sngrs_tax', array( 'sngrs_sngrs_cpt' ), $args );

}
add_action( 'init', 'sngrs_sngrs_tax_func', 0 );

}

/// ADD TO CATEGORY - SNGRS

function sngrs_sngrs_cat_func( $post_ID ) {
    $post_type = 'sngrs_sngrs_cpt';
    $cat_id = 29; // Your reviews category id (for example: 123)
    $post_categories=array($cat_id);

    // check if current post type is movie review
    if(get_post_type($post_ID)==$post_type) {
        // assign a category for this post by default
        wp_set_post_categories( $post_ID->ID, $post_categories );
    }

   return $post_ID;
}
add_action('the_post', 'sngrs_sngrs_cat_func');
add_action('save_post', 'sngrs_sngrs_cat_func');
add_action('draft_to_publish', 'sngrs_sngrs_cat_func');
add_action('new_to_publish', 'sngrs_sngrs_cat_func');
add_action('pending_to_publish', 'sngrs_sngrs_cat_func');
add_action('future_to_publish', 'sngrs_sngrs_cat_func');

/// CUSTOM POST TYPE - PHOTOS

if ( ! function_exists('sngrs_photo_cpt_func') ) {
function sngrs_photo_cpt_func() {

	$labels = array(
		'name'                  => _x( 'Foto\'s', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Foto', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Foto\'s', 'text_domain' ),
		'name_admin_bar'        => __( 'Foto', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'photo',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'Foto', 'text_domain' ),
		'description'           => __( 'Foto;s', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'            => array( 'category','sngrs_photo_tax' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-camera',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'query_var'             => 'sngrs_photo',
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
	);
	register_post_type( 'sngrs_photo_cpt', $args );

}
add_action( 'init', 'sngrs_photo_cpt_func', 0 );

}

/// CUSTOM TAXONOMY - PHOTOS

if ( ! function_exists( 'sngrs_photo_tax_func' ) ) {

// Register Custom Taxonomy
function sngrs_photo_tax_func() {

	$labels = array(
		'name'                       => _x( 'Tags', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
		'all_items'                  => __( 'All Items', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Item Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Item', 'text_domain' ),
		'edit_item'                  => __( 'Edit Item', 'text_domain' ),
		'update_item'                => __( 'Update Item', 'text_domain' ),
		'view_item'                  => __( 'View Item', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'photo-tag',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'sngrs_tax',
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'sngrs_photo_tax', array( 'sngrs_photo_cpt' ), $args );

}
add_action( 'init', 'sngrs_photo_tax_func', 0 );

}

/// ADD TO CATEGORY - PHOTOS

function sngrs_photo_cat_func( $post_ID ) {
    $post_type = 'sngrs_photo_cpt';
    $cat_id = 26; // Your reviews category id (for example: 123)
    $post_categories=array($cat_id);

    // check if current post type is movie review
    if(get_post_type($post_ID)==$post_type) {
        // assign a category for this post by default
        wp_set_post_categories( $post_ID->ID, $post_categories );
    }

   return $post_ID;
}
add_action('the_post', 'sngrs_photo_cat_func');
add_action('save_post', 'sngrs_photo_cat_func');
add_action('draft_to_publish', 'sngrs_photo_cat_func');
add_action('new_to_publish', 'sngrs_photo_cat_func');
add_action('pending_to_publish', 'sngrs_photo_cat_func');
add_action('future_to_publish', 'sngrs_photo_cat_func');

/// Mellow_Post_meta
function mellow_post_meta() {
        
        $post = get_the_ID();
        //echo $post;
        $categories  = get_the_category();	
        if (get_post_type() === "post") {
                $categories  = get_the_category(); 
        } if (get_post_type() === "sngrs_rgr_cpt") {
                $categories  = get_the_terms($post,'sngrs_rgr_tax');
        } if (get_post_type() === "sngrs_school_cpt") {
                $categories  = get_the_terms($post,'sngrs_school_tax');
        } if (get_post_type() === "sngrs_sngrs_cpt") {
                $categories  = get_the_terms($post,'sngrs_sngrs_tax');
        } if (get_post_type() === "sngrs_photo_cpt") {
                $categories  = get_the_terms($post,'sngrs_photo_tax');
        } 
    
		$separator   = ', ';
		$output      = '';

		// Get the categories string
		if ( $categories ) {

			$i = 0;
			$len = count( $categories );

			foreach ( $categories as $category ) {
				// Add and to multi-category lists
				if( $i == $len && $len > 1 )
					$separator = " & ";

				    $output .= '' . $category->name. $separator;

				$i++;
			}

			$category_string = '' . trim( $output, $separator );

		} else {

			$category_string = 'Geen categorie';

		}

		// Get the time string
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' geleden'
		);

    
		$output = sprintf( __( '/%1$s /%3$s /%2$s<br /> ', 'mellow' ),
			sprintf( '%1$s',
				//esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_post_type_object(get_post_type( ) )->labels->name)
			),
			sprintf( '%1$s',
				//esc_url( get_permalink() ),
				$time_string
			),
			sprintf( '%s', $category_string )
		);

		echo $output;

	}

?>