<?php
    $artists = get_field('home_artists_slider');
?>
<div class="horizontal-image-slider-v2__wrapper">
    <section class="image-slider horizontal-image-slider-v2">
        <div class="slider-wrap">
            <div class="slider-image">
                <?php foreach ($artists as $artist): ?>
                <div class="slide">
                    <div class="slider-image-container">
                        <img class="lazyload" data-src="<?php echo esc_url($artist['image']) ?>" expand="-100" alt="<?php echo esc_attr($artist['name']) ?>">          
                    </div>
                    <a class="link" href="<?php echo esc_url($artist['link']); ?>" target="_blank" rel="noopener noreferrer">
                        <?php echo esc_html($artist['link_label']); ?>
                    </a>
                    <div class="info">
                        <p class="artist">
                            <?php echo esc_html($artist['name']); ?>
                        </p>
                        <p>
                        </p>
                        <p class="sub" href="<?php echo esc_url($artist['link']); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo esc_html($artist['link_label']); ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </diV>
    </section>
</div>