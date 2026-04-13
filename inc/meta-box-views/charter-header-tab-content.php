<?php
/**
 * Charter Header Tab Content
 * 
 * @package JKJAAC
 */

if (!defined('ABSPATH')) {
    exit;
}

// Add nonce field
wp_nonce_field('jkjaac_charter_header_meta_box', 'jkjaac_charter_header_meta_box_nonce');

// Get saved values
$charter_override = get_post_meta($post->ID, '_jkjaac_charter_header_override', true);
$charter_label = get_post_meta($post->ID, '_jkjaac_charter_header_label', true);
$charter_title_line1 = get_post_meta($post->ID, '_jkjaac_charter_header_title_line1', true);
$charter_title_line2 = get_post_meta($post->ID, '_jkjaac_charter_header_title_line2', true);
$charter_description = get_post_meta($post->ID, '_jkjaac_charter_header_description', true);
?>

<div class="jkjaac-meta-box">
    <div class="jkjaac-meta-body">
        <!-- Override Toggle -->
        <div class="jkjaac-toggle-row">
            <input type="checkbox" name="jkjaac_charter_header_override" id="jkjaac_charter_header_override" value="1" <?php checked($charter_override, '1'); ?> />
            <label for="jkjaac_charter_header_override">
                Override default charter header for this page
                <small>Enable custom charter header content below. Leave unchecked to use defaults.</small>
            </label>
        </div>
        
        <!-- Charter Header Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Charter Header</h3>
                <span>LABEL, TITLE & DESCRIPTION</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_charter_header_label">Section Label (s-label)</label>
                <input type="text" name="jkjaac_charter_header_label" id="jkjaac_charter_header_label" 
                       value="<?php echo esc_attr($charter_label); ?>" 
                       placeholder="Full Charter" />
                <small>The small label above the title</small>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_charter_header_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_charter_header_title_line1" id="jkjaac_charter_header_title_line1" 
                           value="<?php echo esc_attr($charter_title_line1); ?>" 
                           placeholder="All" />
                    <small>Regular text before line break</small>
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_charter_header_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_charter_header_title_line2" id="jkjaac_charter_header_title_line2" 
                           value="<?php echo esc_attr($charter_title_line2); ?>" 
                           placeholder="38 Demands" />
                    <small>This text will be italic/emphasized</small>
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_charter_header_description">Description Text</label>
                <textarea name="jkjaac_charter_header_description" id="jkjaac_charter_header_description" 
                          rows="4" placeholder="Enter the description text..."><?php echo esc_textarea($charter_description); ?></textarea>
                <small>The main description that appears below the title</small>
            </div>
        </div>
    </div>
</div>

