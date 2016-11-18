<?php
/*  --- TO DO LOG --

-   Contactknoppen veranderen naar OS specifiek
-   Responsive check hovercards
-   Statistieken arraylist veranderen in fadein/out slideshow.

-   Kleuren aanpassen en logo's toepassen

-   Apple Health stappen omzetten (op een gemiddelde maandag ed)
-   Mailfetch all goed maken
-   PDF Viewer inbouwen

    --- TO DO LOG --    */

/// STIJLEN EN JAVASCRIPT
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', PHP_INT_MAX);
function theme_enqueue_styles() { 
    
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    
    wp_dequeue_style( 'mellow-ie8' );
    wp_deregister_style( 'mellow-ie8' );

    $query_args = array(
		'family' => 'Merriweather|Raleway'
	);
	wp_enqueue_style( 'sngrs-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
    
    
    wp_dequeue_style( 'mellow-fonts' );
    wp_deregister_style( 'mellow-fonts' );
    
    wp_enqueue_style( 'sngrs-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false, '4.7.0', 'all' );
    wp_dequeue_style( 'mellow-font-awesome' );
    wp_deregister_style( 'mellow-font-awesome' );
    
    if( is_front_page() || is_page_template() )
		wp_enqueue_script( 'mellow-isotope', get_bloginfo( 'template_url' ) . '/js/jquery.isotope.js', array( 'jquery' ), '1.5.25', true );
    
    wp_register_script('sngrs-js', get_stylesheet_directory_uri() . '/script.js', array('jquery'),'1.1', true);
wp_enqueue_script('sngrs-js');

    
}

/// INCLUDES
include( get_stylesheet_directory() . '/inc/cpt_tax.php');
include( get_stylesheet_directory() . '/inc/template-tags.php');
include( get_stylesheet_directory() . '/inc/shortcodes.php');
include( get_stylesheet_directory() . '/inc/cronjobs.php');
include( get_stylesheet_directory() . '/inc/widgets.php');
include( get_stylesheet_directory() . '/inc/secure.php'); // WANNEER LIVE VERWIJDEREN!!

/// FEED UITZETTEN
function wpb_disable_feed() {
wp_die( __('No feed available,please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
}
add_action('do_feed', 'wpb_disable_feed', 1);
add_action('do_feed_rdf', 'wpb_disable_feed', 1);
add_action('do_feed_rss', 'wpb_disable_feed', 1);
add_action('do_feed_rss2', 'wpb_disable_feed', 1);
add_action('do_feed_atom', 'wpb_disable_feed', 1);
add_action('do_feed_rss2_comments', 'wpb_disable_feed', 1);
add_action('do_feed_atom_comments', 'wpb_disable_feed', 1);

/// DISABLE COMMENTS
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');

/// GROTE THUMBNAIL
function sngrs_featured_meta_size( $content ) {

	global $post;

	// To get the $post object when removing the featured image
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		if ( isset( $_REQUEST['post_id'] ) ) {
			$post = get_post( $_REQUEST['post_id'] );
		}
	}
	$label = '';
    $text = __( 'Large project thumb.', 'mellow' );
    $id = 'large_thumb';

    $value = esc_attr( get_post_meta( $post->ID, $id, true ) );
    $label = '<label for="' . $id . '" class="selectit"><input name="' . $id . '" type="checkbox" id="' . $id . '" value="' . $value . ' "'. checked( $value, 1, false) .'> ' . $text .'</label>';
	return $content .= $label;
	

}
add_filter( 'admin_post_thumbnail_html', 'sngrs_featured_meta_size' );
function sngrs_save_featured_meta_size( $post_id, $post, $update ) {

	$value = 0;

	if ( isset( $_REQUEST['large_thumb'] ) ) {
		$value = 1;
	}

	// Set meta value to either 1 or 0
	update_post_meta( $post_id, 'large_thumb', $value );

}
add_action( 'save_post', 'sngrs_save_featured_meta_size', 10, 3 );

/// EERSTE AFBEELDING ALS FEATURED
function auto_featured_image() {
    global $post;

    if (!has_post_thumbnail($post->ID)) {
        $attached_image = get_children( "post_parent=$post->ID&amp;post_type=attachment&amp;post_mime_type=image&amp;numberposts=1" );

        if ($attached_image) {
            foreach ($attached_image as $attachment_id => $attachment) {
                set_post_thumbnail($post->ID, $attachment_id);
            }
        }
    }
}
// Use it temporary to generate all featured images
add_action('the_post', 'auto_featured_image');
// Used for new posts
add_action('save_post', 'auto_featured_image');
add_action('draft_to_publish', 'auto_featured_image');
add_action('new_to_publish', 'auto_featured_image');
add_action('pending_to_publish', 'auto_featured_image');
add_action('future_to_publish', 'auto_featured_image');

/// IMAGE SIZES
add_image_size( 'sngrs_home_image', 480, 480, true ); // Hard Crop Mode
add_image_size( 'sngrs_home_image_l', 960, 960, true ); // Hard Crop Mode
add_image_size( 'sngrs_singlepost_image', 2048 ); // Unlimited Height Mode

add_filter( 'image_size_names_choose', 'sngrs_custom_sizes' );
function sngrs_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'sngrs_singlepost_image' => __( 'Paginabreedte' ),
    ) );
}

/// UPDATER
if( ! class_exists( 'Smashing_Updater' ) ){
	include_once( get_stylesheet_directory() . '/inc/updater.php' );
};
$updater = new Smashing_Updater( __FILE__ );
$updater->set_username( 'HahaIkBenRogier' );
$updater->set_repository( 'WP-SNGRS2016-Theme' );
// $updater->authorize( '' ); // Your auth code goes here for private repos
$updater->initialize();

/// // unregister all widgets 
function unregister_default_widgets() {     
    unregister_widget('WP_Widget_Pages');     
    unregister_widget('WP_Widget_Calendar');     
    unregister_widget('WP_Widget_Archives');     
    unregister_widget('WP_Widget_Links');     
    unregister_widget('WP_Widget_Meta');     
    unregister_widget('WP_Widget_Search');     
    unregister_widget('TTrust_Flickr');     
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');   
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');     
    unregister_widget('WP_Widget_Tag_Cloud');     
    unregister_widget('TTrust_Recent_Posts'); } 
add_action('widgets_init', 'unregister_default_widgets', 11);


/// OVERIGE DINGEN
add_filter('widget_text','do_shortcode'); // Shortcodes in textwidgets toestaan

?>