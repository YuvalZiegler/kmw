<?php

	add_theme_support('post-formats');
	add_theme_support('post-thumbnails');
	add_theme_support('menus');

	add_filter('get_twig', 'add_to_twig');
	add_filter('timber_context', 'add_to_context');

	add_action('wp_enqueue_scripts', 'load_scripts');

	define('THEME_URL', get_template_directory_uri());
	function add_to_context($data){
		/* this is where you can add your own data to Timber's context object */
		$data['menu'] = new TimberMenu();
    $data['user'] = wp_get_current_user();
		return $data;
	}

	function add_to_twig($twig){
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension(new Twig_Extension_StringLoader());
		$twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));
		return $twig;
	}


	function load_scripts(){
		wp_enqueue_script('jquery');
	}

// Cleanup Admin
function remove_menus(){

  remove_menu_page( 'edit.php?post_type=page' );
  remove_menu_page( 'edit-comments.php' );
  remove_menu_page( 'edit.php' );
  remove_menu_page( 'themes.php' );                 //Appearance

  if(current_user_can("author")){
    remove_menu_page( 'index.php' );                  //Dashboard
    remove_menu_page( 'upload.php' );                 //Media
    remove_menu_page( 'plugins.php' );                //Plugins
    remove_menu_page( 'users.php' );                  //Users
    remove_menu_page( 'tools.php' );                  //Tools
    remove_menu_page( 'options-general.php' );        //Settings
  }
}
add_action( 'admin_menu', 'remove_menus' );

function example_remove_dashboard_widgets() {
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
  remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );

// Custom post types
function create_post_type()
{
  // Register Custom Post Type

  $article_labels = array(
    'name' => _x('Articles', 'Post Type General Name', 'text_domain'),
    'singular_name' => _x('Article', 'Post Type Singular Name', 'text_domain'),
    'menu_name' => __('Article', 'text_domain'),
    'parent_item_colon' => __('Parent Article:', 'text_domain'),
    'all_items' => __('All Articles', 'text_domain'),
    'view_item' => __('View Articles', 'text_domain'),
    'add_new_item' => __('Add New Article', 'text_domain'),
    'add_new' => __('New Article', 'text_domain'),
    'edit_item' => __('Edit Article', 'text_domain'),
    'update_item' => __('Update Article', 'text_domain'),
    'search_items' => __('Search Article', 'text_domain'),
    'not_found' => __('No articles found', 'text_domain'),
    'not_found_in_trash' => __('No articles found in Trash', 'text_domain'),
  );

  $article_args = array(
    'label' => __('article', 'text_domain'),
    'description' => __('Magazine Articles', 'text_domain'),
    'labels' => $article_labels,
    'supports' => array('title', 'excerpt','editor','post-formats','page-attributes'),
    'taxonomies' => array('category', 'post_tag'),
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 1,
    'menu_icon' => '',
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'page',
  );

  $issue_labels = array(
    'name' => _x('Issues', 'Post Type General Name', 'text_domain'),
    'singular_name' => _x('Issue', 'Post Type Singular Name', 'text_domain'),
    'menu_name' => __('Issue', 'text_domain'),
    'parent_item_colon' => __('Parent Issue:', 'text_domain'),
    'all_items' => __('All Issues', 'text_domain'),
    'view_item' => __('View Issues', 'text_domain'),
    'add_new_item' => __('Add New Issue', 'text_domain'),
    'add_new' => __('New Issue', 'text_domain'),
    'edit_item' => __('Edit Issue', 'text_domain'),
    'update_item' => __('Update Issue', 'text_domain'),
    'search_items' => __('Search Issue', 'text_domain'),
    'not_found' => __('No issue found', 'text_domain'),
    'not_found_in_trash' => __('No issue found in Trash', 'text_domain'),
  );

  $issue_args = array(
    'label' => __('issue', 'text_domain'),
    'description' => __('Magazine Issues', 'text_domain'),
    'labels' => $issue_labels,
    'supports' => array('title'),
    'taxonomies' => array('category', 'post_tag'),
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_nav_menus' => true,
    'show_in_admin_bar' => true,
    'menu_position' => 0,
    'menu_icon' => '',
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'capability_type' => 'page',
  );

  register_post_type('article', $article_args);
  register_post_type('issue', $issue_args);

}

add_action('init', 'create_post_type');

