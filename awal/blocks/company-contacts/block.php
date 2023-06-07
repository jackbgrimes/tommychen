<?php
    $heading = get_field('heading');
    $contacts = get_field('contact_information');
?>
<section class="contact-us module">
    <div class="container-alt">
        <div class="contact-container">
            <span class="lead"><?php echo esc_html($heading) ;?></span>
            <ul>
                <?php foreach ($contacts as $contact): ?>
                    <li>
                        <p><?php echo esc_html($contact['title']) ;?></p>
                        <a href="mailto:<?php echo esc_html($contact['address']) ;?>"><?php echo esc_html($contact['address']) ;?></a>
                    </li>   
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

