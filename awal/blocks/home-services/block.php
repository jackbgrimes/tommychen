<?php
    $heading = get_field('home_services_heading');
    $joinUs = get_field('home_services_join_us');
    $services = get_field('home_services');

?>
<div class="services-module-v2">
    <div class="services-module-v2__main">
        <div class="services-module-v2__content">
        <h2 class="services-module-v2__headline">
            <?php echo nl2br(esc_html($heading)); ?>
        </h2>
        <ul class="services-module-v2__services">
            <?php foreach ($services as $service): ?>
            <li class="services-module-v2__service">
                <span><?php echo esc_html($service['service']); ?></span>
            </li>
            <?php endforeach; ?>
        </ul>
        </div>
    </div>

    <div class="services-module-v2__footer">
        <h3></h3>
        <h1><?php echo esc_html($joinUs); ?></h1>
    </div>
</div>