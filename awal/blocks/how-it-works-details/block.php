<?php
    $services = get_field('hiw_details_section');
?>
<?php foreach ($services as $idx => $service): ?>
<div>
    <div class="module mono-text module-tier">
        <div class="hiw-module-section">
            <div class="hiw-module-section--wrapper hiw-artist-tier">
                <div class="hiw-tier-introduction">
                    <h2><?php echo esc_html($service['heading']);?></h2>
                    <p><?php echo esc_html($service['description']);?></p>
                </div>
                <div class="hiw-tier-milestones">
                    <div class="hiw-milestones__slider" id="hiw-milestones__slider--<?php echo $idx; ?>" data-slick="{&quot;arrows&quot;: false, &quot;autoplay&quot;: true, &quot;autoplaySpeed&quot;: 3000, &quot;draggable&quot;: false, &quot;easing&quot;: &quot;easeInOut&quot;, &quot;pauseOnFocus&quot;: false, &quot;pauseOnHover&quot;: false, &quot;speed&quot;: 600, &quot;swipe&quot;: true, &quot;touchMove&quot;: true}">
                        <?php foreach ($service['milestones'] as $milestone): ?>
                        <div>
                            <article class="hiw-milestone" style="background: <?php echo esc_html($milestone['background_color']); ?>;">
                                <figure class="hiw-milestone__cover">
                                    <img class="lazyload" expand="-100" data-src="<?php echo esc_url($milestone['image']) ?>" alt="<?php echo esc_html($milestone['artist_name']);?>">
                                </figure>
                                <div class="hiw-milestone__content">
                                    <span><?php _e('milestone') ?></span>
                                    <h3><?php echo esc_html($milestone['description']);?></h3>
                                    <div class="hiw-milestone__content__artist">
                                    <figure>
                                        <img class="lazyload" expand="-100" data-src="<?php echo esc_url($milestone['image']) ?>" alt="<?php echo esc_html($milestone['artist_name']);?>">
                                    </figure>
                                    <span><?php echo esc_html($milestone['artist_name']);?></span>
                                </div>
                            </div>
                            </article>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="hiw-milestones__touchzones" data-target="<?php echo $idx; ?>">
                        <div class="hiw-milestones__touchzone hiw-milestones__touchzone--prev" data-target="<?php echo $idx; ?>"></div>
                        <div class="hiw-milestones__touchzone hiw-milestones__touchzone--next" data-target="<?php echo $idx; ?>"></div>
                        <span class="touchzone__tooltip touchzone__tooltip--<?php echo $idx; ?>" data-target="<?php echo $idx; ?>">Previous</span>
                    </div>
                    <div class="hiw-milestones__navigation">
                        <div class="hiw-navigation__progress">
                            <?php for ($i = 0; $i < count($service['milestones']); $i++): ?>
                            <div class="hiw-navigation__progress__item" data-target="<?php echo $idx; ?>" data-index="<?php echo $i; ?>">
                                <div></div>
                                <div></div>
                            </div>
                            <?php endfor; ?>
                        </div>
                        <div class="hiw-navigation__numbers">
                            <span class="nav-number">1</span> — <span class="nav-total"><?php echo count($service['milestones']); ?></span>
                        </div>
                    </div>
                </div>          
                <div class="hiw-tier-features">
                    <p class="hiw-tier-features__description"><?php echo esc_html($service['services_section_description']); ?></p>
                    <hr>
                    <div class="hiw-tier-features__wrapper">
                        <?php foreach ($service['services'] as $detail): ?>
                        <article class="hiw-feature">
                            <h3><?php echo esc_html($detail['title']); ?></h3>
                            <span><?php echo esc_html($detail['heading']); ?></span>
                            <p><?php echo esc_html($detail['description']); ?></p>

                            <?php if (!empty($detail['popup_link'])): ?>
                            <default-text-component>
                                <default-button class="default-button--transparent-dark" data-icon="cross">
                                    <?php echo esc_html($detail['popup_link']); ?>
                                </default-button>
                                <div class="overlay-component-wrapper">
                                    <overlay-component class="overlay-component--light overlay-component--360px">
                                    <?php echo esc_html($detail['popup_content']); ?>
                                    </overlay-component>
                                </div>
                                <div class="overlay-component-closezone"></div>
                            </default-text-component>
                            <?php endif; ?>
                        </article>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>