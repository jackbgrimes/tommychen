<?php
/*
 * Post
 */
get_header();
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<div class="page-wipe">
			<div class="wrapper">
				<div class="blog-post">
					<div class="container">
						<div class="blog-post-container">
							<div class="featured-image">
								<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Blog Featured Image" />
							</div>
							<div class="blog-title-author">
                    			<h1><?php echo the_title(); ?></h1>
                    			<div class="author-date">
                        			<p><?php _e("by", "awal"); ?> <span><?php the_author(); ?></span> <?php _e("on", "awal"); ?> <span><?php echo the_date("M d, Y"); ?></span></p>
                    			</div>
								<div class="blog-share">
									<p><?php _e("Share", "awal"); ?></p>
									<span class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_blog_social_sharing" style="" data-hs-cos-general-type="widget" data-hs-cos-type="blog_social_sharing">
										<div class="hs-blog-social-share">
											<ul class="hs-blog-social-share-list">
												<li class="hs-blog-social-share-item hs-blog-social-share-item-twitter">
													<!-- Twitter social share -->
													<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-url="<?php the_permalink(); ?>" data-size="medium" data-text="<?php the_title(); ?>">Tweet</a>
												</li>
												<li class="hs-blog-social-share-item hs-blog-social-share-item-linkedin">
													<!-- LinkedIn social share -->
													<script type="IN/Share" data-url="<?php the_permalink(); ?>" data-showzero="true" data-counter="right"></script>
												</li>
												<li class="hs-blog-social-share-item hs-blog-social-share-item-facebook">
													<!-- Facebook share -->
													<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" data-width="120"></div>
												</li>
											</ul>
										</div>

									</span>
								</div>
							</div>
							<div class="blog-content-container">
								<div class="blog-content">
									<?php the_content(); ?>
								</div>
								<div class="blog-sidebar">
									<?php load_template(TEMPLATEPATH . '/partials/sidebar-subscribe-form.php'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
					if ($related):
				?>
				<div class="module featured-blog">
					<div class="container">
						<div class="section-intro has-overlap">
							<div class="intro-text-container container-alt">
								<span class="lead white"><?php _e("Related", "awal"); ?></span>
							</div>
						</div>
						<div class="blog-items container-alt">
							<ul>
							<?php foreach ($related as $rPost): ?>
								<li>
									<div class="img-container">
										<img src="<?php echo get_the_post_thumbnail_url($rPost); ?>">
									</div>
									<div class="text-container">
										<p><?php echo get_the_title($rPost);?></p>
										<p class="arrow"><?php _e("Read More", "awal"); ?></p>
									</div>
									<a href="<?php echo get_permalink($rPost); ?>"></a>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>		
		<?php
	}
}
get_footer();