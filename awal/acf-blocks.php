<?php

function press45_block_categories( $categories ) {
	$category_slugs = wp_list_pluck( $categories, 'slug' );
	return in_array( '45press', $category_slugs, true ) ? $categories : array_merge(
			$categories,
			array(
					array(
							'slug'  => '45press',
							'title' => __( '45Press', '45press' ),
							'icon'  => null,
					),
			)
	);
}
add_filter( 'block_categories', 'press45_block_categories' );

function press45_acf_register_blocks() {

	$blocks = array(
		array(
			'name'				=> 'home-hero',
			'title'				=> __('Home Hero'),
			'description'		=> __('A custom blcok for the home hero.'),
			'render_template'	=> 'blocks/home-hero/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
				wp_enqueue_script( '45press_home_hero', get_template_directory_uri() . '/blocks/home-hero/custom.js?t='.time(), array(), '1.0.0', true );
			},
			'keywords'			=> array('home-hero')
		),
		array(
			'name'				=> 'home-services',
			'title'				=> __('Home Services'),
			'description'		=> __('A custom blcok for the home services.'),
			'render_template'	=> 'blocks/home-services/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'keywords'			=> array('home-services')
		),
		array(
			'name'				=> 'home-artist-slider',
			'title'				=> __('Home Artists Slider'),
			'description'		=> __('A custom blcok for the home artists slider.'),
			'render_template'	=> 'blocks/home-artists-slider/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
				wp_enqueue_script( 'slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), '1.0.0', true );
				wp_enqueue_script( '45press_home_artists_slider', get_template_directory_uri() . '/blocks/home-artists-slider/custom.js?t='.time(), array(), '1.0.0', true );
			},
			'keywords'			=> array('home-artists-slider')
		),
		array(
			'name'				=> 'home-departments',
			'title'				=> __('Home Departments'),
			'description'		=> __('A custom blcok for the home departments.'),
			'render_template'	=> 'blocks/home-departments/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'keywords'			=> array('home-departments')
		),
		array(
			'name'				=> 'home-image-highlight-cta',
			'title'				=> __('Home Image Highlight CTA'),
			'description'		=> __('A custom blcok for the home image highlight cta.'),
			'render_template'	=> 'blocks/home-image-highlight-cta/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
				wp_enqueue_script( '45press_home_image_highlight_cta', get_template_directory_uri() . '/blocks/home-image-highlight-cta/custom.js?t='.time(), array(), '1.0.0', true );
			},
			'keywords'			=> array('home-image-highlight-cta')
		),
		array(
			'name'				=> 'home-artists-grid',
			'title'				=> __('Home Artists Grid'),
			'description'		=> __('A custom blcok for the home artists grid.'),
			'render_template'	=> 'blocks/home-artists-grid/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
				wp_enqueue_script('masonry');
				wp_enqueue_script( '45press_waypoints', get_template_directory_uri() . '/blocks/home-artists-grid/jquery.waypoints.min.js' );
				wp_enqueue_script( '45press_home_artists_grid', get_template_directory_uri() . '/blocks/home-artists-grid/custom.js?t='.time(), array(), '1.0.0', true );
			},
			'keywords'			=> array('home-artists-grid')
		),
		array(
			'name'				=> 'artists_hero',
			'title'				=> __('Artists Hero'),
			'description'		=> __('A custom blcok for the hero on the Artists page.'),
			'render_template'	=> 'blocks/artists-hero/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'keywords'			=> array('artists_hero')
		),
		array(
			'name'				=> 'artists',
			'title'				=> __('Artists'),
			'description'		=> __('A custom blcok for the artists on the Artists page.'),
			'render_template'	=> 'blocks/artists/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
				wp_enqueue_script( '45press_tweenmax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js' );
				wp_enqueue_script( '45press_waypoints', get_template_directory_uri() . '/blocks/home-artists-grid/jquery.waypoints.min.js' );
				wp_enqueue_script( '45press_artists', get_template_directory_uri() . '/blocks/artists/custom.js' );
			},
			'keywords'			=> array('artists')
		),
		array(
			'name'				=> 'spotlight',
			'title'				=> __('Spotlight'),
			'description'		=> __('A custom blcok for the spotlight on the Artists page.'),
			'render_template'	=> 'blocks/spotlight/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
				wp_enqueue_script( '45press_spotlight', get_template_directory_uri() . '/blocks/spotlight/custom.js' );
			},
			'keywords'			=> array('spotlight')
		),
		array(
			'name'				=> 'how-it-works-intro-and-graph',
			'title'				=> __('How it works intro and graph'),
			'description'		=> __('A custom blcok for the How it works intro and graph.'),
			'render_template'	=> 'blocks/how-it-works-intro-and-graph/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
				wp_enqueue_script( 'threejs', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/0.145.0/three.min.js' );
				wp_enqueue_script( '45press_tweenmax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js' );
				wp_enqueue_script( '45press_hiw-intro', get_template_directory_uri() . '/blocks/how-it-works-intro-and-graph/custom.js' );
			},
			'keywords'			=> array('how-it-works-intro-and-graph')
		),
		array(
			'name'				=> 'how-it-works-details',
			'title'				=> __('How it works Details'),
			'description'		=> __('A custom blcok for the How it works Details.'),
			'render_template'	=> 'blocks/how-it-works-details/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
				wp_enqueue_script( 'slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js' );
				wp_enqueue_style( 'slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
				wp_enqueue_style( 'slick-theme', '//cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css' );
				wp_enqueue_script( '45press_hiw-details', get_template_directory_uri() . '/blocks/how-it-works-details/custom.js' );
			},
			'keywords'			=> array('how-it-works-details')
		),
		array(
			'name'				=> 'how-it-works-submit-your-music',
			'title'				=> __('How it works Submit your music'),
			'description'		=> __('A custom blcok for the How it works Submit your music.'),
			'render_template'	=> 'blocks/how-it-works-submit-your-music/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
			},
			'keywords'			=> array('how-it-works-submit-your-music')
		),
		array(
			'name'				=> 'company-hero',
			'title'				=> __('Company Hero'),
			'description'		=> __('A custom blcok for the Company Hero.'),
			'render_template'	=> 'blocks/company-hero/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
			},
			'keywords'			=> array('company-hero')
		),
		array(
			'name'				=> 'company-offering',
			'title'				=> __('Company Offering'),
			'description'		=> __('A custom blcok for the Company Offering.'),
			'render_template'	=> 'blocks/company-offering/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
			},
			'keywords'			=> array('company-offering')
		),
		array(
			'name'				=> 'company-offices',
			'title'				=> __('Company Offices'),
			'description'		=> __('A custom blcok for the Company Offices.'),
			'render_template'	=> 'blocks/company-offices/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
			},
			'keywords'			=> array('company-offices')
		),
		array(
			'name'				=> 'company-contacts',
			'title'				=> __('Company Contacts'),
			'description'		=> __('A custom blcok for the Company Contacts.'),
			'render_template'	=> 'blocks/company-contacts/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
			},
			'keywords'			=> array('company-contacts')
		),
		array(
			'name'				=> 'faq',
			'title'				=> __('FAQ'),
			'description'		=> __('A custom blcok for the FAQ.'),
			'render_template'	=> 'blocks/faq/block.php',
			'category'			=> '45press',
			'icon'				=> [
				'src' => 'excerpt-view',
				'foreground' => '#fd9600'
			],
			'enqueue_assets' 	=> function() {
			},
			'keywords'			=> array('faq')
		),
	);

	if (function_exists('acf_register_block')) {
		foreach ($blocks as $block) {
			acf_register_block($block);
		}
	}

}

add_action('acf/init', 'press45_acf_register_blocks');
