<?php
    $heading = get_field('home_image_highlight_cta_heading');
    $findOut = get_field('home_image_highlight_cta_find_out_more');
    $artists = get_field('home_image_highlight_cta_artists');
?>
<div class="image-highlight-cta-module">
    <div class="image-highlight-cta-module__card-container">
        <?php foreach ($artists as $artist):?>
            <div class="image-highlight-cta-module__card">
                <img class="lazyload" expand="-100" data-src="<?php echo esc_url($artist['image']); ?>" alt="<?php echo esc_html($artist['name']); ?>">
                <div class="image-highlight-cta-module__card-info">
                    <?php echo esc_html($artist['name']); ?>
                </div>
            </div>
        <?php endforeach; ?>    
    </div>
    <div class="image-highlight-cta-module__content">
        <div class="image-highlight-cta-module__content-inner">
            <h2>
                <?php echo esc_html($heading); ?>
            </h2>
            <a class="image-highlight-cta-module__cta" href="<?php echo esc_url($findOut['url']); ?>">
                <?php echo esc_html($findOut['title']); ?>
                <span class="image-highlight-cta-module__icon-arrow"></span>
            </a>
        </div>
    </div>
</div>