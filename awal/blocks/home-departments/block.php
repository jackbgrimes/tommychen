<?php
    $heading = get_field('home_departments_heading');
    $headingImage = get_field('home_departments_heading_image');
    $departments = get_field('home_departments');
?>
<section class="departments-module-v2">
  <div class="departments-module-v2__content">
    <h2 class="departments-module-v2__title">
      <?php echo esc_html($heading); ?>
      <img src="<?php echo esc_url($headingImage); ?>">
    </h2>
    <ul class="departments-module-v2__services">
        <?php foreach ($departments as $row): ?>
        <li class="departments-module-v2__service">
            <?php echo $row['item']; ?>
        </li>
        <?php endforeach; ?>
    </ul>
  </div>
</section>