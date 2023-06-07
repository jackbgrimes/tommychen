<?php
/*
 * Template Name: Artists
 */
get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<div class="row-fluid">
			<div class="span12">
				<?php the_content(); ?>
			</div>
		</div>
		<?php
	}
}
get_footer();