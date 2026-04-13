<?php
/**
 * Process Step Icon Meta Box Template
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get saved icon value
$icon = get_post_meta( $post->ID, '_process_step_icon', true );

$available_icons = array(
    'ri-search-line'           => 'Search',
    'ri-megaphone-line'        => 'Megaphone',
    'ri-user-community-line'   => 'Community',
    'ri-star-line'             => 'Star',
    'ri-flag-line'             => 'Flag',
    'ri-group-line'            => 'Group',
    'ri-hand-heart-line'       => 'Hand Heart',
    'ri-scales-line'           => 'Scales (Justice)',
    'ri-calendar-line'         => 'Calendar',
    'ri-map-pin-line'          => 'Location',
    'ri-chat-1-line'           => 'Chat',
    'ri-file-list-line'        => 'Document',
    'ri-flashlight-line'       => 'Flash',
    'ri-award-line'            => 'Award',
    'ri-check-line'            => 'Check',
    'ri-heart-line'            => 'Heart',
    'ri-shield-line'           => 'Shield',
    'ri-home-line'             => 'Home',
    'ri-mail-line'             => 'Mail',
    'ri-phone-line'            => 'Phone',
);
?>

<div class="jkjaac-icon-meta">
    <p>
        <label for="process_step_icon" style="display: block; font-weight: 600; margin-bottom: 8px; color: #e0e0e8;">
            <i class="ri-emotion-line" style="margin-right: 6px; color: #d4af37;"></i>
            Select Icon
        </label>
        <select name="process_step_icon" id="process_step_icon" style="width: 100%; padding: 8px 10px; background: #2a2222; border: 1px solid rgba(212, 175, 55, 0.3); border-radius: 6px; color: #fff; font-size: 14px;">
            <option value="">— Default (based on position) —</option>
            <?php foreach ( $available_icons as $value => $label ) : ?>
                <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $icon, $value ); ?>>
                    <?php echo esc_html( $label ); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    
    <!-- Icon Preview -->
    <div class="jkjaac-icon-preview" style="margin-top: 15px; padding: 12px; background: rgba(212, 175, 55, 0.05); border-radius: 6px; text-align: center;">
        <p style="margin: 0 0 8px; color: #86757b; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Icon Preview</p>
        <div id="icon-preview-area" style="font-size: 32px; color: #d4af37;">
            <i class="<?php echo ! empty( $icon ) ? esc_attr( $icon ) : 'ri-search-line'; ?>"></i>
        </div>
    </div>
    
    <p class="description" style="margin-top: 12px; color: #86757b; font-size: 12px; font-style: italic;">
        Choose an icon for this step. Leave empty to use default based on step position.
    </p>
</div>

<script>
jQuery(document).ready(function($) {
    // Live icon preview update
    $('#process_step_icon').on('change', function() {
        var selectedIcon = $(this).val();
        var defaultIcon = 'ri-search-line';
        
        if (selectedIcon) {
            $('#icon-preview-area').html('<i class="' + selectedIcon + '"></i>');
        } else {
            $('#icon-preview-area').html('<i class="' + defaultIcon + '"></i><span style="display: block; font-size: 11px; color: #86757b; margin-top: 5px;">Default (position-based)</span>');
        }
    });
});
</script>