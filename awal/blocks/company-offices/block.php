<?php
    $bg = get_field('background_image');
    $heading = get_field('heading');
    $title = get_field('title');
    $offices = get_field('offices');
?>
<section class="offices module parallax-anchor">
    <div class="container-alt">
        <div class="img-container">
            <img class="lazyload" expand="-20" data-src="<?php echo esc_url($bg); ?>" alt="bg-offices" />
        </div>
        <div class="office-list parallax no-mobile">
            <span class="lead"><?php echo esc_html($heading);?></span>
            <h6><?php echo esc_html($title);?></h6>
            <ul>
                <?php foreach ($offices as $office): ?>
                    <li>
                        <a href="<?php echo esc_url($office['google_map']); ?>" target="_blank">
                            <span><?php echo esc_html($office['name']); ?></span>
                            <?php echo nl2p(esc_html($office['address'])); ?>
                        </a>
                    </li>    
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</section>