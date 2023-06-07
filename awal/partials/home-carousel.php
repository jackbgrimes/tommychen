<section id="home-carousel">
	<div class="container">
		<h1 class="section-title sr-only">
			<span><?php esc_html_e( 'Milan Records', 'awal' ); ?></span>
		</h1>
		<div class="section-content" data-aos="fade-up">
			<?php
			$slides = get_field( 'slides' );
			if ( ! empty( $slides ) ) {
				?>
				<div class="owl-carousel">
					<?php
					foreach ( $slides as $slide ) {
						?>
						<article>
							<?php
							if ( ! empty( $slide['url'] ) ) {
							?>
							<a href="<?php echo esc_url( $slide['url'] ); ?>" target="_blank">
								<?php
								}
								echo wp_kses_post( wp_get_attachment_image( $slide['image'], 'slide' ) );
								if ( ! empty( $slide['url'] ) ) {
								?>
							</a>
						<?php
						}
						?>
						</article>
						<?php
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</section>