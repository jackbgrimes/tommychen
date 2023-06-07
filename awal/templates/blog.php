<?php
/*
 * Template Name: Blog
 */

$blogPage = get_page_by_path("blog");

$featuredPost = get_field("featured_post", $blogPage->ID);
if (is_category()) {
    $currentCategoryId = get_query_var('cat');
} else {
    $currentCategoryId = null;
}
get_header();
?>
<div class="page-wipe"></div>
<div class="wrapper">
    <div class="blog-landing">
        <?php if ($featuredPost): ?>
        <div class="container top">
            <div class="featured-blog-post">            
                <img src="<?php echo get_the_post_thumbnail_url($featuredPost); ?>" alt="<?php echo get_the_title($featuredPost); ?>">
                <div class="blog-post-info">
                    <h1><?php echo get_the_title($featuredPost); ?></h1>
                    <p></p>
                        <p class="arrow"><?php _e("Read", "awal"); ?></p>
                    <a href="<?php echo get_permalink($featuredPost); ?>"></a>
                    <div id="blog-topic"></div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="blog-filter">
            <div class="container">
                <div class="filter-container">
                    <?php
                        $categories = get_categories();
                        $uncategorizedId = get_cat_ID( 'Uncategorized' );
                        
                    ?>
                    <ul>
                        <li class="<?php echo $currentCategoryId === null ? 'active' : ''?>"><p><a href="<?php echo get_permalink($blogPage); ?>"><?php _e("All", "awal"); ?></a></p></li>
                        <?php foreach ($categories as $cat): if ($cat->cat_ID == $uncategorizedId) continue;?>
                        <li class="<?php echo ($currentCategoryId && $currentCategoryId == $cat->cat_ID) ? 'active' : ''?>">
                            <p><a href="<?php echo get_category_link($cat->cat_ID); ?>"><?php echo $cat->name; ?></a></p>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="search"></div>
                </div>
            </div>
        </div>
        <div class="container bottom">
            <div class="blog-container">
                <div class="blog-list">
                    <?php
                        $posts = get_posts(['category' => !$currentCategoryId ? 0 : $currentCategoryId]);
                    ?>
                    <ul>
                        <?php for ($i = 0; $i < 10; $i++): ?>
                        <?php foreach ($posts as $post): ?>
                        <li>
                            <div class="img-container">
                                <span><img src="<?php echo get_the_post_thumbnail_url($post); ?>" alt="<?php echo get_the_title($post); ?>"></span>
                            </div>
                            <div class="blog-post-info">
                                <h4><?php echo get_the_title($post); ?></h4>
                                <p><?php echo get_the_excerpt($post); ?></p>
                                <p class="arrow"><?php _e("Read More", "awal"); ?></p>
                            </div>
                            <a href="<?php echo get_permalink($post); ?>"><?php _e("Read More", "awal"); ?></a>
                        </li>
                        <?php endforeach; ?>
                        <?php endfor; ?>
                    </ul>
                    <div class="btn-container">
                        <div class="btn show-more"><?php _e("Show More", "awal"); ?></div>
                    </div>
                </div>
                <div class="blog-sidebar">
                    <?php load_template(TEMPLATEPATH . '/partials/sidebar-subscribe-form.php'); ?>
                    <?php
                        $popularPosts = get_posts( array( 'numberposts' => 5 ) );
                    ?>
                    <div class="most-shared">
                        <span><?php _e("Most Shared"); ?></span>
                        <ul>
                            <?php foreach ($popularPosts as $pPost): ?>
                            <li>
                                <a href="<?php echo get_permalink($pPost); ?>">
                                    <p><?php echo get_the_title($rPost);?></p>
                                    <p class="arrow"><?php _e("Read More", "awal"); ?></p>
                                    <span></span>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer();