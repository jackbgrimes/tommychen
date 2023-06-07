<?php
    $artists = get_field('artists');

    function renderArtist($artist, $class = '')
    {
        ?>
            <div class="artist-thumb <?php echo $class ?> fade">
                <div class="img-container">
                    <img class="lazyload" data-src="<?php echo esc_url($artist['image']); ?>" alt="<?php echo esc_attr($artist['name']); ?>">
                </div>
                <div class="artist-info">
                    <p><?php echo esc_html($artist['name']); ?></p>
                    <div class="url">
                        <p><?php _e('More', 'awal'); ?></p>
                    </div>
                </div>
                <a href="<?php echo esc_url($artist['link']); ?>" target="_blank"><?php _e('Link', 'awal'); ?></a>
            </div>
        <?php
    }
?>
<section class="artist-list">
    <div class="container">
        <div class="artist-list-actual">
            <div class="container-alt">
                <div class="artist-row">
                    <div class="col-container">
                        <?php if (count($artists) > 0): ?>
                        <div class="col">
                            <?php renderArtist($artists[0], 'large'); ?>
                        </div>
                        <div class="col">
                            
                            <?php if (count($artists) > 1): ?>                            
                            <div class="top">
                                <?php renderArtist($artists[1], 'horizontal'); ?>
                            </div>
                            <?php endif;?>

                            <div class="bottom">
                                <?php if (count($artists) > 2): ?>
                                    <?php renderArtist($artists[2], 'small'); ?>
                                <?php endif; ?>
                                <?php if (count($artists) > 3): ?>
                                    <?php renderArtist($artists[3], 'small'); ?>
                                <?php endif; ?>
                            </div>

                        </div>                        
                        <?php endif; ?>
                    </div>
                </div>
                <div class="artist-row">
                    <?php for ($i = 4; $i < min(count($artists), 8); $i++): ?>
                        <?php if (isset($artists[$i])): ?>
                            <?php renderArtist($artists[$i], 'small'); ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <div class="artist-row">
                    <div class="col-container">
                        <div class="col">
                            <div class="top">
                                <?php if (count($artists) > 8): ?>
                                    <?php renderArtist($artists[8], 'horizontal'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="bottom">
                                <?php if (count($artists) > 9): ?>
                                    <?php renderArtist($artists[9], 'small'); ?>
                                <?php endif; ?>
                                <?php if (count($artists) > 10): ?>
                                    <?php renderArtist($artists[10], 'small'); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col">
                            <?php if (count($artists) > 11): ?>
                                <?php renderArtist($artists[11], 'large'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if (count($artists) > 12): ?>
                    <?php for ($i = 0; $i < ceil(count($artists) - 12) / 4; $i++): ?>
                        <div class="artist-row">
                            <?php 
                                for ($j = 0; $j < 4; $j++): 
                                    if (isset($artists[12 + $i * 4 + $j])):  
                                        renderArtist($artists[12 + $i * 4 + $j], 'small'); 
                                    endif; 
                                endfor; 
                            ?>
                        </div>
                    <?php endfor; ?>
                <?php endif; ?>
                <div class="btn-container">
                    <div class="btn show-more"><?php _e('Show More', 'awal'); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>