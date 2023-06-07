<?php
/*
 * Release
 */
get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		$associated_artist = get_field( 'associated_artist' );
		$release_date      = get_field( 'release_date' );
		$listen_now_url    = get_field( 'listen_now_url' );
		$media             = get_field( 'media' );
		?>
		<article class="inner-content">
			<div class="container">
				<div class="page-content">
					<div class="page-body">
						<div class="art-col">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'large' );
							}
							?>
						</div>
						<div class="clearfix">
							<header>
								<h1>
									<?php the_title(); ?>
								</h1>
							</header>
							<?php the_content(); ?>
						</div>
					</div>
					<div class="divider">
						<?php
						if ( ! empty( $listen_now_url ) ) {
							?>
							<div class="listen-now">
								<a href="<?php echo esc_url( $listen_now_url ); ?>" target="_blank"
								   class="btn btn-black-border">
									<?php esc_html_e( 'Listen Now', 'awal' ); ?>
								</a>
							</div>
							<?php
						}
						?>
					</div>
					<?php
					if ( ! empty( $media ) ) {
						?>
						<section id="release-media" class="release-section">
							<!--<h2 class="release-sub-title"><?php esc_html_e( 'Media', 'awal' ); ?></h2>-->
							<div class="media">
								<?php
								foreach ( $media as $media_item ) {
									?>
									<div data-aos="fade-up">
										<?php
										if ( $media_item['type'] === 'embed' ) {
											if ( strpos( $media_item['embed'], 'youtube' ) !== false ||
											     strpos( $media_item['embed'], 'vimeo' ) !== false ) {
												?>
												<div class="embed-container">
													<?php echo $media_item['embed']; ?>
												</div>
												<?php
											} else {
												echo $media_item['embed'];
											}
										} elseif ( $media_item['type'] === 'image' ) {
											if ( ! empty( $media_item['image_url'] ) ) {
												?>
												<a href="<?php echo esc_url( $media_item['image_url'] ); ?>"
												   target="_blank">
													<?php
													echo wp_kses_post( wp_get_attachment_image( $media_item['image'], 'full' ) );
													?>
												</a>
												<?php
											} else {
												echo wp_kses_post( wp_get_attachment_image( $media_item['image'], 'full' ) );
											}
										}
										?>
									</div>
									<?php
								}
								?>
							</div>
						</section>
						<?php
					}

					if ( ! empty( $associated_artist ) ) {
						$other_releases = new WP_Query( array(
							'post_type'      => 'release',
							'order'          => 'desc',
							'orderby'        => 'meta_value_num',
							'posts_per_page' => - 1,
							'meta_key'       => 'release_date',
							'post__not_in'   => array( get_the_ID() ),
							'meta_query'     => array(
								'relation' => 'AND',
								array(
									'key'     => 'associated_artist',
									'value'   => $associated_artist->ID,
									'compare' => '='
								),
								array(
									'key'     => '_thumbnail_id',
									'value'   => 0,
									'compare' => '!='
								)
							)
						) );
						if ( $other_releases->have_posts() ) {
							?>
							<section id="release-other-releases" class="release-section">
								<h2 class="release-sub-title">
									<?php printf(
										'%s %s',
										esc_html__( 'Other Releases By', 'awal' ),
										esc_html( $associated_artist->post_title )
									) ?>
								</h2>
								<div class="other-releases">
									<?php
									while ( $other_releases->have_posts() ) {
										$other_releases->the_post();
										?>
										<article id="release-<?php the_ID(); ?>" <?php post_class(); ?>
										         data-aos="fade-up">
											<div class="inner">
												<a href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail( 'large' ); ?>
												</a>
												<span><?php echo esc_html( $associated_artist->post_title ); ?></span>
												<span><?php the_title(); ?></span>
											</div>
										</article>
										<?php
									}
									?>
								</div>
							</section>
							<?php
						}
					}
					?>
				</div>
			</div>
		</article>
		<?php
	}
}
get_footer();