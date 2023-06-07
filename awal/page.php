<?php
/*
 * Page
 */
get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<div class="page-legal">
			<div class="container">
				<div class="legal-container">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		<?php
	}
}
get_footer();