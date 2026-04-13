<?php
/**
 * Struggles Tab Content - Struggles Page Settings
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wp_nonce_field( 'jkjaac_struggles_meta_box', 'jkjaac_struggles_meta_box_nonce' );

// Get saved values
$struggles_override = get_post_meta( $post->ID, '_jkjaac_struggles_override', true );

// Intro Section (From Sit-In to National Movement)
$intro_label = get_post_meta( $post->ID, '_jkjaac_intro_label', true );
$intro_title1 = get_post_meta( $post->ID, '_jkjaac_intro_title_line1', true );
$intro_title2 = get_post_meta( $post->ID, '_jkjaac_intro_title_line2', true );
$intro_body = get_post_meta( $post->ID, '_jkjaac_intro_body', true );

// Origins Phase Settings
$origins_label = get_post_meta( $post->ID, '_jkjaac_origins_label', true );
$origins_count = get_post_meta( $post->ID, '_jkjaac_origins_count', true );
$hide_origins = get_post_meta( $post->ID, '_jkjaac_hide_origins', true );

// 2024 Stats Band
$stats_2024_label = get_post_meta( $post->ID, '_jkjaac_stats_2024_label', true );
$stats_2024_title1 = get_post_meta( $post->ID, '_jkjaac_stats_2024_title_line1', true );
$stats_2024_title2 = get_post_meta( $post->ID, '_jkjaac_stats_2024_title_line2', true );
$stats_2024_desc = get_post_meta( $post->ID, '_jkjaac_stats_2024_description', true );
$stats_2024_count = get_post_meta( $post->ID, '_jkjaac_stats_2024_count', true );
$hide_stats_2024 = get_post_meta( $post->ID, '_jkjaac_hide_stats_2024', true );

// Uprising Phase Settings
$uprising_count = get_post_meta( $post->ID, '_jkjaac_uprising_count', true );
$hide_uprising = get_post_meta( $post->ID, '_jkjaac_hide_uprising', true );

// 2025 Impact Section
$impact_2025_label = get_post_meta( $post->ID, '_jkjaac_impact_2025_label', true );
$impact_2025_title1 = get_post_meta( $post->ID, '_jkjaac_impact_2025_title_line1', true );
$impact_2025_title2 = get_post_meta( $post->ID, '_jkjaac_impact_2025_title_line2', true );
$impact_2025_desc = get_post_meta( $post->ID, '_jkjaac_impact_2025_description', true );
$impact_2025_count = get_post_meta( $post->ID, '_jkjaac_impact_2025_count', true );
$hide_impact_2025 = get_post_meta( $post->ID, '_jkjaac_hide_impact_2025', true );

// Lockdown Phase Settings
$lockdown_count = get_post_meta( $post->ID, '_jkjaac_lockdown_count', true );
$hide_lockdown = get_post_meta( $post->ID, '_jkjaac_hide_lockdown', true );

// Anatomy Section
$anatomy_label = get_post_meta( $post->ID, '_jkjaac_anatomy_label', true );
$anatomy_title1 = get_post_meta( $post->ID, '_jkjaac_anatomy_title_line1', true );
$anatomy_title2 = get_post_meta( $post->ID, '_jkjaac_anatomy_title_line2', true );
$anatomy_desc = get_post_meta( $post->ID, '_jkjaac_anatomy_description', true );
$anatomy_count = get_post_meta( $post->ID, '_jkjaac_anatomy_count', true );
$hide_anatomy = get_post_meta( $post->ID, '_jkjaac_hide_anatomy', true );
?>

<div class="jkjaac-meta-box">
    <div class="jkjaac-meta-body">
        <!-- Override Toggle -->
        <div class="jkjaac-toggle-row">
            <input type="checkbox" name="jkjaac_struggles_override" id="jkjaac_struggles_override" value="1" <?php checked( $struggles_override, '1' ); ?> />
            <label for="jkjaac_struggles_override">
                Override default struggles content for this page
                <small>Enable custom struggles content below. Leave unchecked to use defaults.</small>
            </label>
        </div>
        
        <!-- Intro Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Introduction Section</h3>
                <span>FROM SIT-IN TO NATIONAL MOVEMENT</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_intro_label">Section Label</label>
                <input type="text" name="jkjaac_intro_label" id="jkjaac_intro_label" 
                       value="<?php echo esc_attr( $intro_label ); ?>" placeholder="Complete Protest Record" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_intro_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_intro_title_line1" id="jkjaac_intro_title_line1" 
                           value="<?php echo esc_attr( $intro_title1 ); ?>" placeholder="From Sit-In to" />
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_intro_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_intro_title_line2" id="jkjaac_intro_title_line2" 
                           value="<?php echo esc_attr( $intro_title2 ); ?>" placeholder="National Movement" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_intro_body">Body Text</label>
                <textarea name="jkjaac_intro_body" id="jkjaac_intro_body" rows="4"><?php echo esc_textarea( $intro_body ); ?></textarea>
            </div>
        </div>
        
        <!-- Origins Phase (2022-2023) -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Origins Phase (2022-2023)</h3>
                <span>FOUNDATION TIMELINE</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_origins_label">Phase Label (Optional)</label>
                <input type="text" name="jkjaac_origins_label" id="jkjaac_origins_label" 
                       value="<?php echo esc_attr( $origins_label ); ?>" placeholder="" />
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_origins_count">Number of Events to Display</label>
                <select name="jkjaac_origins_count" id="jkjaac_origins_count">
                    <option value="" <?php selected( $origins_count, '' ); ?>>Show All</option>
                    <option value="3" <?php selected( $origins_count, '3' ); ?>>Show 3 Events</option>
                    <option value="4" <?php selected( $origins_count, '4' ); ?>>Show 4 Events</option>
                    <option value="5" <?php selected( $origins_count, '5' ); ?>>Show 5 Events</option>
                </select>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hide_origins" id="jkjaac_hide_origins" value="1" <?php checked( $hide_origins, '1' ); ?> />
                <label for="jkjaac_hide_origins">Hide Origins Section</label>
            </div>
        </div>
        
        <!-- 2024 Stats Band -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>2024 Protest Stats Band</h3>
                <span>COMPLETE PROTEST STATS</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_stats_2024_label">Section Label</label>
                <input type="text" name="jkjaac_stats_2024_label" id="jkjaac_stats_2024_label" 
                       value="<?php echo esc_attr( $stats_2024_label ); ?>" placeholder="Complete Protest Stats" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_stats_2024_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_stats_2024_title_line1" id="jkjaac_stats_2024_title_line1" 
                           value="<?php echo esc_attr( $stats_2024_title1 ); ?>" placeholder="The 2024" />
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_stats_2024_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_stats_2024_title_line2" id="jkjaac_stats_2024_title_line2" 
                           value="<?php echo esc_attr( $stats_2024_title2 ); ?>" placeholder="Azad Kashmir Protests" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_stats_2024_description">Description</label>
                <textarea name="jkjaac_stats_2024_description" id="jkjaac_stats_2024_description" rows="3"><?php echo esc_textarea( $stats_2024_desc ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_stats_2024_count">Number of Stats to Display</label>
                <select name="jkjaac_stats_2024_count" id="jkjaac_stats_2024_count">
                    <option value="" <?php selected( $stats_2024_count, '' ); ?>>Show All</option>
                    <option value="4" <?php selected( $stats_2024_count, '4' ); ?>>Show 4 Stats</option>
                    <option value="6" <?php selected( $stats_2024_count, '6' ); ?>>Show 6 Stats</option>
                </select>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hide_stats_2024" id="jkjaac_hide_stats_2024" value="1" <?php checked( $hide_stats_2024, '1' ); ?> />
                <label for="jkjaac_hide_stats_2024">Hide 2024 Stats Section</label>
            </div>
        </div>
        
        <!-- Uprising Phase (2024) -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Uprising Phase (2024)</h3>
                <span>MAY 2024 TIMELINE</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_uprising_count">Number of Events to Display</label>
                <select name="jkjaac_uprising_count" id="jkjaac_uprising_count">
                    <option value="" <?php selected( $uprising_count, '' ); ?>>Show All</option>
                    <option value="3" <?php selected( $uprising_count, '3' ); ?>>Show 3 Events</option>
                    <option value="4" <?php selected( $uprising_count, '4' ); ?>>Show 4 Events</option>
                </select>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hide_uprising" id="jkjaac_hide_uprising" value="1" <?php checked( $hide_uprising, '1' ); ?> />
                <label for="jkjaac_hide_uprising">Hide Uprising Section</label>
            </div>
        </div>
        
        <!-- 2025 Impact Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>2025 Impact Section</h3>
                <span>INFORMATIVE & DIRECT</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_impact_2025_label">Section Label</label>
                <input type="text" name="jkjaac_impact_2025_label" id="jkjaac_impact_2025_label" 
                       value="<?php echo esc_attr( $impact_2025_label ); ?>" placeholder="Informative & Direct" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_impact_2025_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_impact_2025_title_line1" id="jkjaac_impact_2025_title_line1" 
                           value="<?php echo esc_attr( $impact_2025_title1 ); ?>" placeholder="The 2025 Azad Kashmir Protests —" />
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_impact_2025_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_impact_2025_title_line2" id="jkjaac_impact_2025_title_line2" 
                           value="<?php echo esc_attr( $impact_2025_title2 ); ?>" placeholder="A Nation in Lockdown" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_impact_2025_description">Description</label>
                <textarea name="jkjaac_impact_2025_description" id="jkjaac_impact_2025_description" rows="3"><?php echo esc_textarea( $impact_2025_desc ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_impact_2025_count">Number of Impact Cards</label>
                <select name="jkjaac_impact_2025_count" id="jkjaac_impact_2025_count">
                    <option value="" <?php selected( $impact_2025_count, '' ); ?>>Show All</option>
                    <option value="4" <?php selected( $impact_2025_count, '4' ); ?>>Show 4 Cards</option>
                    <option value="6" <?php selected( $impact_2025_count, '6' ); ?>>Show 6 Cards</option>
                </select>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hide_impact_2025" id="jkjaac_hide_impact_2025" value="1" <?php checked( $hide_impact_2025, '1' ); ?> />
                <label for="jkjaac_hide_impact_2025">Hide Impact Section</label>
            </div>
        </div>
        
        <!-- Lockdown Phase (2025) -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Lockdown Phase (2025)</h3>
                <span>SEPTEMBER-OCTOBER 2025 TIMELINE</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_lockdown_count">Number of Events to Display</label>
                <select name="jkjaac_lockdown_count" id="jkjaac_lockdown_count">
                    <option value="" <?php selected( $lockdown_count, '' ); ?>>Show All</option>
                    <option value="4" <?php selected( $lockdown_count, '4' ); ?>>Show 4 Events</option>
                    <option value="5" <?php selected( $lockdown_count, '5' ); ?>>Show 5 Events</option>
                </select>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hide_lockdown" id="jkjaac_hide_lockdown" value="1" <?php checked( $hide_lockdown, '1' ); ?> />
                <label for="jkjaac_hide_lockdown">Hide Lockdown Section</label>
            </div>
        </div>
        
        <!-- Anatomy Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Anatomy Section</h3>
                <span>THE MOVEMENT THAT WOULDN'T BE SILENCED</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_anatomy_label">Section Label</label>
                <input type="text" name="jkjaac_anatomy_label" id="jkjaac_anatomy_label" 
                       value="<?php echo esc_attr( $anatomy_label ); ?>" placeholder="DISRUPTION PROOF: THE MOVEMENT THAT WOULDN'T BE SILENCED" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_anatomy_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_anatomy_title_line1" id="jkjaac_anatomy_title_line1" 
                           value="<?php echo esc_attr( $anatomy_title1 ); ?>" placeholder="The Anatomy of the" />
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_anatomy_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_anatomy_title_line2" id="jkjaac_anatomy_title_line2" 
                           value="<?php echo esc_attr( $anatomy_title2 ); ?>" placeholder="JKJAAC Uprising" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_anatomy_description">Description</label>
                <textarea name="jkjaac_anatomy_description" id="jkjaac_anatomy_description" rows="3"><?php echo esc_textarea( $anatomy_desc ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_anatomy_count">Number of Features</label>
                <select name="jkjaac_anatomy_count" id="jkjaac_anatomy_count">
                    <option value="" <?php selected( $anatomy_count, '' ); ?>>Show All</option>
                    <option value="4" <?php selected( $anatomy_count, '4' ); ?>>Show 4 Features</option>
                    <option value="6" <?php selected( $anatomy_count, '6' ); ?>>Show 6 Features</option>
                </select>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hide_anatomy" id="jkjaac_hide_anatomy" value="1" <?php checked( $hide_anatomy, '1' ); ?> />
                <label for="jkjaac_hide_anatomy">Hide Anatomy Section</label>
            </div>
        </div>
        
        <!-- Note about adding items -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Adding Content Items</h3>
                <span>INSTRUCTIONS</span>
            </div>
            <div style="color: #f6f6ff; padding: 10px; background: rgba(212, 175, 55, 0.05); border-radius: 6px;">
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;"></i>
                <strong>Protest Events:</strong> Add/edit timeline events in <strong>Dashboard → Protest Events</strong>. Assign Phase and Outcome taxonomies.</p>
                
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;"></i>
                <strong>Protest Stats:</strong> Add/edit stats in <strong>Dashboard → Protest Stats</strong>. Assign Stat Group taxonomy (2024 Stats or 2025 Impact).</p>
                
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;"></i>
                <strong>Movement Features:</strong> Add/edit anatomy cards in <strong>Dashboard → Movement Features</strong>.</p>
            </div>
        </div>
    </div>
</div>