<?php
/* Template Name: Submit Form Page */
get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<article class="inner-content">
			<div class="container">
				<div class="page-content">
					<div class="page-body clearfix">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</article>
		<?php
	}
}
get_footer();