<?php
    $description = get_field('description');
    $blog = get_field('blog');
    $submitUrl = get_field('submit_your_music');
?>
<div class="module mono-text dark module-intro">
    <div class="hiw-module-section" id="hiw-cta-module">
        <div class="hiw-module-section--wrapper">
            <div class="hiw-module-section--component hiw__cta">
            
            <p><?php echo esc_html($description); ?></p>
            
            
            <default-button class="default-button--transparent-light" data-url="<?php echo esc_url($blog['url']);?>">
                <?php echo esc_html($blog['title']); ?>
            </default-button>
            
            
            <a hs-cta-wrapper-fe9574d9-7ec3-4108-ae9d-50688d188629 href="<?php echo esc_url($submitUrl['url']); ?>">
                <?php echo esc_html($submitUrl['title']); ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="33" height="33" fill="#000" viewbox="0 0 33 33">
                <path d="M8 16h17v1H8z" />
                <path d="M19.21 10.1l6.37 6.37-.71.7-6.36-6.36z" />
                <path d="M18.5 22.13l6.37-6.37.7.71-6.36 6.37z" />
                </svg>
            </a>
            <script charset="utf-8" src="https://js.hscta.net/cta/current.js"></script>
            <script type="text/javascript">
                hbspt.cta.load(4045246, 'fe9574d9-7ec3-4108-ae9d-50688d188629', {});
            </script>
            </div>
            <dynamic-gradient-component data-active-color="none"></dynamic-gradient-component>
        </div>
    </div>
</div>