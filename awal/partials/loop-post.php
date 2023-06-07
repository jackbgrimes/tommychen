<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-aos="fade-up">
	<div>
		<?php
		if ( has_post_thumbnail() ) {
			?>
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'large' ); ?>
			</a>
			<?php
		}
		?>
	</div>
	<div>
		<div class="top">
			<header>
				<time pubdate="<?php the_time( 'c' ); ?>"><?php the_time( 'F jS, Y' ); ?></time>
				<h3>
					<a href="<?php the_permalink(); ?>">
						<?php the_title(); ?>
					</a>
				</h3>
			</header>
			<blockquote>
				<?php
				$excerpt = get_post_field( 'post_excerpt' );
				if ( ! empty( $excerpt ) ) {
					echo wp_kses_post( $excerpt );
				} elseif ( function_exists( 'the_advanced_excerpt' ) ) {
					the_advanced_excerpt();
				}
				?>
			</blockquote>
		</div>
		<div class="bottom">
			<a href="<?php the_permalink(); ?>" class="btn btn-black">
				<?php esc_html_e( 'Read More', 'awal' ); ?>
			</a>
		</div>
	</div>
</article>