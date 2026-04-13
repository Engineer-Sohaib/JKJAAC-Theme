<?php
/**
 * Dynamic Charter Progress Template Part
 * 
 * @package JKJAAC
 */

$progress = jkjaac_get_charter_progress_data();

if ($progress['hide_section']) {
    return;
}
?>

<section id="population" class="section dark">
    <div class="s-inner">
        <div class="pop-layout">
            <div class="pop-text sr">
                <?php if (!empty($progress['label'])) : ?>
                    <p class="s-label"><?php echo esc_html($progress['label']); ?></p>
                <?php endif; ?>
                
                <h2 class="s-title">
                    <?php echo esc_html($progress['title_line1']); ?>
                    <?php if (!empty($progress['title_line2'])) : ?>
                        <br /><em><?php echo esc_html($progress['title_line2']); ?></em>
                    <?php endif; ?>
                </h2>
                
                <div class="bar-content">
                    <?php if (!empty($progress['section_label'])) : ?>
                        <p class="s-label pg-azad_kashmir-9">
                            <?php echo esc_html($progress['section_label']); ?>
                        </p>
                    <?php endif; ?>
                    
                    <div class="bar-stats">
                        <?php foreach ($progress['bars'] as $bar) : ?>
                            <?php if (!empty($bar['label'])) : ?>
                                <div class="bs-row<?php echo !empty($bar['warning']) ? ' warning' : ''; ?>">
                                    <span class="bs-lbl"><?php echo esc_html($bar['label']); ?></span>
                                    <div class="bs-track">
                                        <div class="bs-fill" 
                                             data-width="<?php echo esc_attr($bar['width']); ?>%" 
                                             style="width: <?php echo esc_attr($bar['width']); ?>%"></div>
                                    </div>
                                    <span class="bs-val"><?php echo esc_html($bar['value']); ?></span>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="pop-visual sr sr-d2">
                <div class="pg-azad_kashmir-10 sr sr-d3">
                    <?php if (!empty($progress['counters']['success'])) : ?>
                        <div class="count success">
                            <div class="pg-azad_kashmir"><?php echo esc_html($progress['counters']['success']['number']); ?></div>
                            <div class="pg-azad_kashmir-12"><?php echo esc_html($progress['counters']['success']['label']); ?></div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($progress['counters']['warning'])) : ?>
                        <div class="count warning">
                            <div class="pg-azad_kashmir"><?php echo esc_html($progress['counters']['warning']['number']); ?></div>
                            <div class="pg-azad_kashmir-14"><?php echo esc_html($progress['counters']['warning']['label']); ?></div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($progress['counters']['danger'])) : ?>
                        <div class="count danger">
                            <div class="pg-azad_kashmir"><?php echo esc_html($progress['counters']['danger']['number']); ?></div>
                            <div class="pg-azad_kashmir-16"><?php echo esc_html($progress['counters']['danger']['label']); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
                
                <?php if (!empty($progress['quote_primary']['text'])) : ?>
                    <div class="short-info">
                        <blockquote class="short-info-block">
                            "<?php echo esc_html($progress['quote_primary']['text']); ?>"
                        </blockquote>
                        <?php if (!empty($progress['quote_primary']['cite'])) : ?>
                            <cite><?php echo esc_html($progress['quote_primary']['cite']); ?></cite>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($progress['quote_secondary']['text'])) : ?>
                    <div class="short-info<?php echo !empty($progress['quote_secondary']['success']) ? ' success' : ''; ?>">
                        <blockquote class="short-info-block">
                            "<?php echo esc_html($progress['quote_secondary']['text']); ?>"
                        </blockquote>
                        <?php if (!empty($progress['quote_secondary']['cite'])) : ?>
                            <cite><?php echo esc_html($progress['quote_secondary']['cite']); ?></cite>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>