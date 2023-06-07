<section id="home-news">
	<div class="container">
		<h2 class="section-title">
			<span><?php esc_html_e( 'The Latest', 'awal' ); ?></span>
		</h2>
		<div class="section-content">
			<?php
			$news = new WP_Query( array(
				'posts_per_page' => 3,
				'order'          => 'desc',
				'orderby'        => 'date',
				'post_type'      => 'post'
			) );
			if ( $news->have_posts() ) {
				while ( $news->have_posts() ) {
					$news->the_post();
					get_template_part( 'partials/loop', 'post' );
				}
			}
			wp_reset_postdata();
			?>
			<div class="more">
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"
				   class="btn btn-black-border">
					<?php esc_html_e( 'See More', 'awal' ); ?>
				</a>
			</div>
		</div>
	</div>
</section>