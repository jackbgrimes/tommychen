<?php
    $artistImage = get_field("artist_hero_image");
    $artistName = get_field("artist_hero_name");
    $heading = get_field("artist_heading");
    $description = get_field("artist_description");
?>
<section class="module hero small">
    <div class="small-image-container" style="background-image: url(<?php echo esc_url($artistImage); ?>); background-position: 50% 0px;">
        <div class="container">
        <div class="artist-info">
            <p class="name"><?php echo esc_html($artistName); ?></p>
            <p class="streams"> <span></span></p>
        </div>
        </div>
    </div>
    <div class="small-text-container container gradient-border border-artists">
        <div class="container">
            <div class="container-alt">
                <span class="lead"><?php echo esc_html($heading); ?></span>
                <div class="hero-text">
                    <h1></h1>
                    <p><?php echo esc_html($description); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>