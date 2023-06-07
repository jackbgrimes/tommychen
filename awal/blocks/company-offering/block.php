<?php
    $image = get_field('image');
    $title = get_field('title');
    $description = get_field('description');
?>
<div class="offering module parallax-anchor">
    <div class="container">
        <div class="offering-container">
            <div class="img-container">
                <img src="<?php echo esc_url($image); ?>" alt="bg-offering" />
            </div>
            <div class="text-container">
                <div class="text-container-alt parallax fade">
                    <h6><?php echo esc_html($title); ?></h6>
                    <p><?php echo nl2br(esc_html($description));?></p>
                </div>
            </div>
        </div>
    </div>
</div>