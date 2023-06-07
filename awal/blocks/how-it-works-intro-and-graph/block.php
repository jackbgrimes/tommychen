<?php
    $heading = get_field('hiw_heading');
    $description = get_field('hiw_description');
    $graph = get_field('hiw_graph_detail');
    $detailDescription = get_field('hiw_details_description');
    
    if (!$graph) {
        $graph = [];
    }
?>
<div>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=Element.prototype.closest"></script>
    <background-component></background-component>
</div>
<div class="hiw-module-section" id="intro-and-graph-module">
    <div class="hiw-module-section--wrapper">
        <div class="hiw-module-section--component hiw__intro">
            <h1><?php echo esc_html($heading); ?></h1>
            <p><?php echo esc_html($description); ?></p>
        </div>
        <stages-component class="hiw-module-section--component hiw__stages">
            <div class="stages-component--flex-container">
                <div class="stages-component--mobile-icon-wrapper" data-icon-active>
                    <?php for ($i = 0; $i < count($graph); $i++): ?>
                    <div class="stages-component--mobile-icon" data-icon="<?php echo $i; ?>"></div>
                    <?php endfor; ?>
                </div>
                <div class="stages-component--tooltip">Gaining Momentum</div>
                <div class="stages-component--graph-wrapper">
                    <div class="stages-component--graph-animation-wrapper">
                        <?php for ($i = 0; $i < count($graph); $i++): ?>
                        <div class="stages-component--graph-wrapper-section" data-section="<?php echo $i; ?>">
                            <div class="stages-component--graph-wrapper-section-copy">
                                <h4><?php echo esc_html($graph[$i]['heading']); ?></h4>
                                <p><?php echo esc_html($graph[$i]['description']); ?></p>
                            </div>
                            <hr>
                            <div class="stages-component--graph-wrapper-section-graph">
                                <?php for ($j = 0; $j < count($graph[$i]["services"]); $j++): ?>
                                    <div class="stages-component--graph-wrapper-section-graph-bar" data-height="<?php echo esc_attr($graph[$i]["services"][$j]["height"]) ?>">
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <?php endfor; ?>
                        <div class="stages-component-graph-intro-line"></div>
                    </div>
                </div>
                <div class="stages-component--label-wrapper" data-section-active>
                    <span><?php _e("Services", "awal"); ?>:</span>
                    <?php 
                        for ($i = 0; $i < count($graph); $i++): 
                            for ($j = 0; $j < count($graph[$i]["services"]); $j++):
                    ?>
                    <div class="stages-component--label"><?php echo esc_html($graph[$i]["services"][$j]["name"]); ?></div>
                    <?php
                            endfor;
                        endfor;
                    ?>
                </div>
            </div>
        </stages-component>
        <block-quote-component class="hiw-module-section--component">
            <p><?php echo esc_html($detailDescription); ?></p>
        </block-quote-component>
        <dynamic-gradient-component data-active-color="none"></dynamic-gradient-component>
    </div>
</div>
