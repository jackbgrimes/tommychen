<?php
/*
 * 404
 */
get_header();
?>
	<article class="inner-content">
		<div class="container">
			<div class="page-content">
				<h1 class="section-title"><?php esc_html_e( 'Page Not Found', 'awal' ); ?></h1>
				<div class="page-body clearfix">
					<p>
						<?php esc_html_e( 'Sorry, but the page that you are searching for could not be found.', 'awal' ); ?>
					</p>
				</div>
			</div>
		</div>
	</article>
<?php
get_footer();