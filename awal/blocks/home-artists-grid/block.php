<?php
    $artists = get_field('home_artists_grid');

    function get_item_size($size)
    {
        $r = '';
        switch ($size) {
            case 'Large':
                $r = 'large';
                break;
            case 'Medium':
                $r = 'med';
                break;
            case 'Small':
                $r = 'small';
                break;
        }
        return $r;
    }
?>
<section class="module trending artist-grid-module-v2 dark" style=" 
  background-image: 
    url('https://www.awal.com/hubfs/noise-overlay-pattern_2-400.png'),
    linear-gradient(to bottom right, #EBE9EE 60%, #FB6E5A);
  background-size: 200px, auto;
">
    <div class="container">
        <img data-size="{src=," alt="" size_type="exact}" class="artist-grid-module-v2__headline-imag lazyload" expand="-100" data-src="">
        <div class="trending-wrap trending-section">
            <div class="grid-sizer"></div>
            <div class="gutter-sizer"></div>
            <?php foreach ($artists as $row): ?>
                <?php if ($row['type'] === "Video"):?>
                    <div class="trend-item video <?php echo get_item_size($row['size']); ?>" data-videoid="<?php echo esc_url($row['link']); ?>">
                        <img class="lazyload" expand="-100" data-src="<?php echo esc_url($row['image']); ?>" alt="<?php echo esc_html($row['title']); ?>">
                        <div class="info">
                            <p>
                                <img class="artist-grid-module-v2__play-icon lazyload" expand="-100" data-src="<?php echo get_template_directory_uri(); ?>/dist/img/image-slider-play@2x.webp">
                            </p>
                            <p class="title"><?php echo esc_html($row['title']); ?></p>
                            <p class="sub"><?php echo esc_html($row['sub_title']); ?></p>
                            <p class="additional"></p>
                        </div>
                    </div>
                <?php elseif ($row['type'] === 'Tweet'): ?>
                    <div class="trend-item tweet no-hover">
                        <div class="tweet-container">
                        <div class="icon"></div>
                            <p><?php echo esc_html($row['tweet_information']); ?></p>
                        </div>
                        
                        <p class="handle"><?php echo esc_html($row['tweet_username']); ?></p>
                        <a href="<?php echo esc_url($row['link']); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($row['tweet_username']); ?></a>
                    </div>
                <?php elseif ($row['type'] === 'Playlist'): ?>
                    <div class="trend-item playlist no-hover">
                        <div class="playlist-container">
                        <div class="title">
                            <h5><?php echo esc_html($row['title']); ?></h5>
                            <h6><?php echo esc_html($row['sub_title']); ?></h6>
                        </div>
                        <div>
                            <div class="spacer"></div>
                            <p class="featured"><?php _e("featured on", "awal"); ?></p>
                        </div>
                        <div class="playlist">
                            <h5><?php echo esc_html($row['playlist_title']); ?></h5>
                            <p class="followers"><?php echo esc_html($row['playlist_followers']); ?></p>
                        </div>
                        <a href="<?php echo esc_url($row['link']); ?>" target="_blank" rel="noopener noreferrer" class="arrow"><?php _e("Listen", "awal"); ?></a>
                        </div>
                    </div>
                <?php elseif ($row['type'] === 'Instagram'): ?>
                    <div class="trend-item instagram <?php echo get_item_size($row['size']); ?>">
                        <img class="lazyload" expand="-100" data-src="<?php echo esc_url($row['image']); ?>">
                        <div class="info">
                            <img class="artist-grid-module-v2_instagram-icon lazyload" expand="-100" data-src="<?php echo get_template_directory_uri(); ?>/dist/img/instagram-white.webp" alt="instagram icon">
                            <p class="title"><?php echo esc_html($row['title']); ?></p>
                            <p class="sub"><?php echo esc_html($row['sub_title']); ?></p>
                            <p class="additional"></p>
                        </div>
                        <a href="<?php echo esc_url($row['link']); ?>" target="_blank" rel="noopener noreferrer"></a>
                    </div>
                <?php elseif ($row['type'] === 'Other'): ?>
                    <div class="trend-item <?php echo get_item_size($row['size']); ?>">
                        <img class="lazyload" expand="-100" data-src="<?php echo esc_url($row['image']); ?>" alt="<?php echo esc_html($row['title']); ?>">
                        <div class="info">
                            <p class="title"><?php echo esc_html($row['title']); ?></p>
                            <p class="sub"><?php echo esc_html($row['sub_title']); ?></p>
                            <p class="additional"></p>
                        </div>
                        <a href="<?php echo esc_url($row['link']); ?>" target="_blank" rel="noopener noreferrer"><?php _e("Listen", "awal"); ?></a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="btn-container mason-load-more">
            <p><?php _e("Load More", "awal"); ?> <span>+</span></p>
        </div>
    </div>
</section>
            