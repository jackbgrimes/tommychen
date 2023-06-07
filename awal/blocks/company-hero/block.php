<?php
    $artistImage = get_field("hero_image");
    $artistName = get_field("hero_name");
    $heading = get_field("heading");
    $description = get_field("description");
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
    <div class="small-text-container container gradient-border border-home">
        <div class="container">
            <div class="container-alt">
                <span class="lead"><?php echo esc_html($heading); ?></span>
                <div class="hero-text">
                    <h1><?php echo esc_html($description); ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>