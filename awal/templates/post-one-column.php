<?php
/*
 * Template Name: One Column
 * Template Post Type: post
 */
get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$banner_image            = get_field( 'banner_image' );
		$featured_image_override = get_field( 'featured_image_override' );
		?>
		<article class="inner-content">
			<div class="container">
				<div class="page-content">
					<?php
					if ( ! empty( $banner_image ) ) {
						echo wp_kses_post( wp_get_attachment_image( $banner_image, 'large', false, array( 'class' => 'post-banner' ) ) );
					}
					?>
					<div class="page-body">
						<div>
							<?php
							if ( ! empty( $featured_image_override ) ) {
								echo wp_kses_post( wp_get_attachment_image( $featured_image_override, 'large' ) );
							} else if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'large' );
							}
							?>
						</div>
						<div class="clearfix">
							<header>
								<h1>
									<?php the_title(); ?>
								</h1>
								<time pubdate="<?php the_time( 'c' ); ?>"><?php the_time( 'F jS, Y' ); ?></time>
							</header>
							<?php the_content(); ?>
						</div>
					</div>
					<div class="more">
						<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"
						   class="btn btn-black">
							<?php esc_html_e( 'See More', 'milan' ); ?>
						</a>
					</div>
				</div>
			</div>
		</article>
		<?php
	}
}
get_footer();