<?php
/*
 * Template Name: Releases
 */
get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<article class="inner-content">
			<div class="container">
				<div class="page-content">
					<h1 class="section-title"><?php the_title(); ?></h1>
					<?php
					get_template_part( 'partials/releases', 'search' );
					?>
					<div class="releases">
						<?php
						$paged    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$search   = sanitize_text_field( $_GET['search'] );
						$sort_by  = sanitize_text_field( $_GET['sort_by'] );
						$order    = $sort_by === 'oldest_to_newest' ? 'asc' : 'desc';
						$releases = new WP_Query( array(
							'post_type'      => 'release',
							'posts_per_page' => 24,
							'order'          => $order,
							'orderby'        => 'meta_value_num',
							'paged'          => $paged,
							's'              => $search,
							'meta_key'       => 'release_date',
							'meta_query'     => array(
								array(
									'key'     => '_thumbnail_id',
									'value'   => 0,
									'compare' => '!='
								)
							),
							'tax_query'      => array(
								array(
									'taxonomy' => 'release_type',
									'field'    => 'slug',
									'terms'    => 'vinyl',
									'operator' => 'NOT IN'
								),
							),
						) );

						if ( $releases->have_posts() ) {
							$offset = 0;
							$r      = 0;
							while ( $releases->have_posts() ) {
								$releases->the_post();
								include locate_template( 'partials/loop-release.php' );
								$offset += 200;
								$r ++;
								if ( $r === 4 ) {
									$offset = 0;
									$r      = 0;
								}
							}
							wp_reset_postdata();
						} else {
							?>
							<p class="not-found">
								<?php esc_html_e( 'No releases found.', 'milan' ); ?>
							</p>
							<?php
						}
						?>
					</div>
					<div class="pagination" data-aos="fade-up">
						<?php
						if ( function_exists( 'wp_pagenavi' ) ) {
							wp_pagenavi( array( 'query' => $releases ) );
						}
						?>
					</div>
				</div>
			</div>
		</article>
		<?php
	}
}
get_footer();