<?php
$featured_items = get_field( 'featured_items' );
?>
<section id="home-featured" data-aos="fade-up">
	<div class="container">
		<h2 class="section-title">
			<span><?php esc_html_e( 'Featured', 'awal' ); ?></span>
		</h2>
		<div class="section-content">
			<?php
			if ( ! empty( $featured_items ) ) {
				?>
				<div class="owl-carousel">
					<?php
					foreach ( $featured_items as $featured_item ) {

						if ( $featured_item['type'] === 'video' ) {
							$youtube_id    = get_youtube_id( $featured_item['youtube_url'] );
							$youtube_image = ! empty( $featured_item['youtube_image_override'] ) ? $featured_item['youtube_image_override'] : "https://img.youtube.com/vi/$youtube_id/maxresdefault.jpg";
							$video_title   = $featured_item['video_title'];
							?>
							<a href="<?php echo esc_url( $featured_item['youtube_url'] ); ?>"
							   class="featured-video">
								<img
									src="<?php echo esc_url( $youtube_image ); ?>"
									alt="<?php echo esc_attr( $youtube_id ); ?>"/>
								<?php
								if ( ! empty( $video_title ) ) {
									?>
									<div class="video-title">
										<i class="fa fa-play" aria-hidden="true"></i>
										<?php echo esc_html( $video_title ); ?>
									</div>
									<?php
								}
								?>
							</a>
							<?php
						} elseif ( $featured_item['type'] === 'release' ) {
							if ( has_post_thumbnail( $featured_item['release']->ID ) ) {
								?>
								<a href="<?php echo esc_url( get_permalink( $featured_item['release']->ID ) ); ?>"
								   class="featured-release">
									<?php echo wp_kses_post( get_the_post_thumbnail( $featured_item['release']->ID, 'large' ) ); ?>
								</a>
								<?php
							}
						} elseif ( $featured_item['type'] === 'custom' ) {
							?>
							<a href="<?php echo esc_url( $featured_item['custom_url'] ); ?>"
							   class="featured-custom">
								<?php echo wp_kses_post( wp_get_attachment_image( $featured_item['custom_image'], 'large' ) ); ?>
							</a>
							<?php
						}
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>