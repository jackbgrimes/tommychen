<?php
    $backgroundVideo = get_field("hero_background_video");
    $backgroundImage = get_field("hero_background_image");
    $awalLogo = get_field("hero_awal_logo");
    $popupLink = get_field("hero_popup_link");
    $popupContent = get_field("hero_popup_content");
?>
<div id="home-hero-block">
    <div class="splash-hero splash-hero-v2">
        <div class="splash-hero-v2__video-wrapper" style="background-image: url('<?php echo esc_url($backgroundImage); ?>');">
            <video class="splash-hero-v2__video splash-hero-v2__video--hidden js-splash-hero-v2-video" src="<?php echo esc_url($backgroundVideo); ?>" muted loop playsinline></video>
        </div>
        <div class="splash-hero-v2__content-wrapper">
            <div class="splash-hero-v2__content">
                <img class="splash-hero-v2__image lazyload" data-src="<?php echo esc_url($awalLogo); ?>">
                <div>
                    <button class="splash-hero-v2__cta js-splash-hero-popup-cta">
                        <?php echo esc_html($popupLink); ?>
                        <span class="splash-hero-v2__icon-plus"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="splash-hero-v2__popup" style="display: none">
        <div class="splash-hero-v2__popup-content">    
            <button class="splash-hero-v2__popup-close js-splash-hero-popup-close">
                Close
                <span class="splash-hero-v2__icon-plus"></span>
            </button>
            <?php echo nl2p(esc_html($popupContent)); ?>
        </div>
    </div>
</div>