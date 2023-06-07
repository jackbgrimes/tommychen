<?php
    $heroImage = get_field("hero_image");
    $heroName = get_field("hero_name");
    $heading = get_field("heading");
    $title = get_field("title");
    $description = get_field("description");
    $sections = get_field('sections');
?>
<section class="module hero small">
    <div class="small-image-container" style="background-image: url(<?php echo esc_url($heroImage); ?>);">
        <div class="container">
            <div class="artist-info">
                <p class="name"><?php echo esc_html($heroName); ?></p>
                <p class="streams"> <span></span></p>
            </div>
        </div>
    </div>
    <div class="small-text-container container gradient-border border-home">
        <div class="container">
            <div class="container-alt">
            <span class="lead"><?php echo esc_html($heading); ?></span>
                <div class="hero-text">
                    <h1><?php echo esc_html($title); ?></h1>        
                    <p><?php echo esc_html($description); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="faqs">
    <div class="container">
        <div class="container-alt">
            <?php foreach ($sections as $section): ?>
            <div class="faq-row">
        		<h6><?php echo esc_html($section['title']); ?></h6>
                <ul class="faq-list">
                    <?php foreach ($section['details'] as $row): ?>
                    <li>
                        <div class="faq-title">
                            <p><?php echo esc_html($row['question']) ;?></p>
                        </div>
                        <div class="faq-text">
                            <?php echo nl2p(esc_html($row['answer'])) ;?>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
      