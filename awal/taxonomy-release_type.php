<?php
/*
 * Release Type
 */
get_header();
?>
	<article class="inner-content">
		<div class="container">
			<div class="page-content">
				<h1 class="section-title">
					<span><?php single_term_title(); ?></span>
				</h1>
				<?php
				get_template_part( 'partials/releases', 'search' );
				?>
				<div class="releases">
					<?php
					if ( have_posts() ) {
						$offset = 0;
						$r      = 0;
						while ( have_posts() ) {
							the_post();
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
							<?php esc_html_e( 'No releases found.', 'awal' ); ?>
						</p>
						<?php
					}
					?>
				</div>
				<div class="pagination">
					<?php
					if ( function_exists( 'wp_pagenavi' ) ) {
						wp_pagenavi();
					}
					?>
				</div>
			</div>
		</div>
	</article>
<?php

get_footer();