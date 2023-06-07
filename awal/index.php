<?php
/*
 * Posts
 */
get_header();
?>
	<article class="inner-content">
		<div class="container">
			<h1 class="section-title">
				<span><?php esc_html_e( 'The Latest', 'awal' ); ?></span>
			</h1>
			<div class="page-content">
				<div class="posts">
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							get_template_part( 'partials/loop', 'post' );
						}
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