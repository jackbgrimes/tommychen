<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=yes">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() . '/favicon.png'; ?>" type="image/x-icon">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<a href="#main" class="sr-only"><?php esc_html_e( 'Skip to content', 'awal' ); ?></a>
<?php
$search = sanitize_text_field( $_GET['s'] );
?>
<form id="header-search" action="<?php echo home_url(); ?>" method="GET">
	<label for="s" class="sr-only"><?php esc_html_e( 'Search', 'awal' ); ?></label>
	<input type="s" name="s" id="s" placeholder="<?php esc_attr_e( 'Find what you want...',
		'awal' ); ?>" value="<?php echo esc_attr( $search ); ?>"/>
	<a href="#">
		<i class="fa fa-close" aria-hidden="true"></i>
		<span class="sr-only"><?php esc_html_e( 'Close', 'awal' ); ?></span>
	</a>
</form>
<header id="header">
	<div class="container">
		<a href="<?php echo esc_url( home_url() ); ?>" class="logo-link">
			<img src="<?php echo get_template_directory_uri() . '/dist/img/logo/logo.png'; ?>" />
		</a>
		<div id="nav-collapse">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'main-menu',
					'container'      => 'nav',
					'item_spacing'   => 'discard'
				)
			);
			?>
			<div id="right-menu-mobile" class="right-menu">
				<ul class="socials">
					<li>
						<a href="https://twitter.com/awal" target="_blank">
							<i class="fa fa-twitter" aria-hidden="true"></i>
							<span class="sr-only"><?php esc_html_e( 'Twitter', 'awal' ); ?></span>
						</a>
					</li>
					<li>
						<a href="https://www.instagram.com/awal/" target="_blank">
							<i class="fa fa-instagram" aria-hidden="true"></i>
							<span class="sr-only"><?php esc_html_e( 'Instagram', 'awal' ); ?></span>
						</a>
					</li>
				</ul>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'right-menu',
						'container'      => 'nav',
						'item_spacing'   => 'discard'
					)
				);
				?>
			</div>
		</div>
		<div id="right-menu" class="right-menu">
			<ul class="socials">
				<li>
					<a href="https://twitter.com/awal" target="_blank">
						<i class="fa fa-twitter" aria-hidden="true"></i>
						<span class="sr-only"><?php esc_html_e( 'Twitter', 'awal' ); ?></span>
					</a>
				</li>
				<li>
					<a href="https://www.instagram.com/awal/" target="_blank">
						<i class="fa fa-instagram" aria-hidden="true"></i>
						<span class="sr-only"><?php esc_html_e( 'Instagram', 'awal' ); ?></span>
					</a>
				</li>
			</ul>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'right-menu',
					'container'      => 'nav',
					'item_spacing'   => 'discard'
				)
			);
			?>
			
			<button class="hamburger hamburger--collapse" type="button">
				<div class="hamburger-box">
					<div class="hamburger-inner"></div>
				</div>
				<span class="sr-only">
					<?php esc_attr_e( 'Toggle Menu', 'strahan' ); ?>
				</span>
			</button>
		</div>
	</div>
</header>
<main id="main">
