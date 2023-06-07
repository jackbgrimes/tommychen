<?php 
    $heading = get_field('spotlight_heading');
    $articles = get_field('spotlight_articles');
?>
<section class="spotlight">
    <div class="container">
        <div class="section-intro gradient-border border-artists">
            <div class="intro-text-container container-alt">
                <span class="lead white"><?php echo esc_html($heading); ?></span>
            </div>
        </div>
        <div class="spotlight-list">
            <div class="container-alt">
                <div class="spotlight-item featured fade-in">
                    <?php if (isset($articles[0])): ?>
                    <div class="video-content-container">
                        <div class="video-container">
                            <iframe id="video" src="<?php echo esc_url($articles[0]['video_url']); ?>" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                            <div class="video-poster">                                
                                <img class="lazyload" expand="-100" data-src="<?php echo esc_url($articles[0]['image']); ?>" alt="gus">
                                <div class="btn-play"></div>
                            </div>
                        </div>
                        <div class="text-container">
                            <h6><?php echo esc_html($articles[0]['title']); ?></h6>
                            <p><?php echo esc_html($articles[0]['description']); ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="spotlight-list-lower">
                    <?php for ($i = 1; $i < count($articles); $i++):?>
                        <div class="spotlight-item fade-in">
                            <div class="video-content-container">
                                <div class="video-container">
                                    <div class="video-thumbnail">
                                          <img class="lazyload" expand="-100" data-src="<?php echo esc_url($articles[$i]['image']); ?>" alt="<?php echo esc_html($articles[$i]['title']); ?>">
                                        
                                        <div class="btn-play"><?php echo esc_url($articles[$i]['video_url']); ?></div>
                                    </div>
                                </div>
                                <div class="text-container">
                                    <h6><?php echo esc_html($articles[$i]['title']); ?></h6>
                                    <p><?php echo esc_html($articles[$i]['description']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
                <div class="btn-container">
                    <div class="btn show-more"><?php _e("Show More", "awal"); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>