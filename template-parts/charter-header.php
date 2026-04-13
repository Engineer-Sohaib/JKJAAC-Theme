<?php
/**
 * Dynamic Charter Header Template Part
 * 
 * @package JKJAAC
 */

$charter = jkjaac_get_charter_header_data();
?>

<div class="sr in">
    <?php if (!empty($charter['label'])) : ?>
        <p class="s-label"><?php echo esc_html($charter['label']); ?></p>
    <?php endif; ?>
    
    <h2 class="s-title">
        <?php echo esc_html($charter['title_line1']); ?>
        <?php if (!empty($charter['title_line2'])) : ?>
            <br /><em><?php echo esc_html($charter['title_line2']); ?></em>
        <?php endif; ?>
    </h2>
    
    <?php if (!empty($charter['description'])) : ?>
        <div class="prose">
            <p><?php echo wp_kses_post($charter['description']); ?></p>
        </div>
    <?php endif; ?>
</div>