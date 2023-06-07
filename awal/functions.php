<?php
require_once('acf-blocks.php');

/**
 *
 */
function theme_setup() {
	$theme_supports = array(
		'html5',
		'title-tag',
		'post-thumbnails',
		'responsive-embeds',
		'align-wide',
		'editor-styles',
		'wp-block-styles',
	);

	foreach ( $theme_supports as $theme_support ) {
		add_theme_support( $theme_support );
	}

	add_image_size( 'slide', 1230, 510, array( 'center', 'top' ) );

	register_nav_menu( 'main-menu', __( 'Main Menu', 'awal' ) );
	register_nav_menu( 'right-menu', __( 'Right Menu', 'awal' ) );
}

add_action( 'after_setup_theme', 'theme_setup' );

/**
 * Enqueue Scripts
 *
 * @return void
 */
function theme_scripts() {
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', [], null );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Libre+Baskerville:400,700|Montserrat:300,300i,400,400i,700,700i,900&display=swap', [], null );
	wp_enqueue_style( 'awal', get_template_directory_uri() . '/dist/css/style.min.css?' . time(), [ 'font-awesome' ], null );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( '45press-script', get_template_directory_uri() . '/dist/js/bundle.min.js', [
		'jquery',
	], null, true );

	wp_localize_script( '45press-script', 'wp', array(
    'ajax_url' => admin_url( 'admin-ajax.php' ),
  ) );
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );

// Get YouTube ID
function get_youtube_id( $youtube_url ) {
	preg_match( "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $youtube_url, $matches );

	return $matches[0];
}

function releases_filter( $query ) {
	if ( ! is_admin() && $query->is_main_query() && ! empty( $query->query_vars['release_type'] ) ) {
		$search  = sanitize_text_field( $_GET['search'] );
		$sort_by = sanitize_text_field( $_GET['sort_by'] );
		$order   = $sort_by === 'oldest_to_newest' ? 'asc' : 'desc';

		$query->set( 'posts_per_page', 24 );
		$query->set( 'order', $order );
		$query->set( 'orderby', 'meta_value_num' );
		$query->set( 's', $search );
		$query->set( 'meta_key', 'release_date' );
		$query->set( 'meta_query', array(
			array(
				'key'     => '_thumbnail_id',
				'value'   => 0,
				'compare' => '!='
			)
		) );
	}
}

add_action( 'pre_get_posts', 'releases_filter' );

function nl2p($string) {
	return $string_with_paragraphs = "<p>".implode("</p><p>", explode("\n", $string))."</p>";
}

function mytheme_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );

function new_excerpt_more($more) {
	return "";
}
add_filter('excerpt_more','new_excerpt_more',11);


//Page Slug Body Class
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );