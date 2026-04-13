<?php
/**
 * Team Header Tab Content - Using Unified Classes
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get saved values
$team_override = get_post_meta( $post->ID, '_jkjaac_team_override', true );
$team_label = get_post_meta( $post->ID, '_jkjaac_team_label', true );
$team_title_line1 = get_post_meta( $post->ID, '_jkjaac_team_title_line1', true );
$team_title_line2 = get_post_meta( $post->ID, '_jkjaac_team_title_line2', true );
$team_description = get_post_meta( $post->ID, '_jkjaac_team_description', true );
$team_hide_section = get_post_meta( $post->ID, '_jkjaac_team_hide_section', true );
$team_leader_count = get_post_meta( $post->ID, '_jkjaac_team_leader_count', true );
?>

<div class="jkjaac-meta-box">
    <div class="jkjaac-meta-body">
        <!-- Override Toggle -->
        <div class="jkjaac-toggle-row">
            <input type="checkbox" name="jkjaac_team_override" id="jkjaac_team_override" value="1" <?php checked( $team_override, '1' ); ?> />
            <label for="jkjaac_team_override">
                Override default team header for this page
                <small>Enable custom team section header content below. Leave unchecked to use Customizer defaults.</small>
            </label>
        </div>
        
        <!-- Team Section Header -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Team Section Header</h3>
                <span>LABEL, TITLE & DESCRIPTION</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_team_label">Section Label</label>
                <input type="text" name="jkjaac_team_label" id="jkjaac_team_label" value="<?php echo esc_attr( $team_label ); ?>" placeholder="Core Committee" />
                <small>Small label above the title (e.g., "Core Committee")</small>
            </div>
            
            <!-- Title Lines -->
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_team_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_team_title_line1" id="jkjaac_team_title_line1" value="<?php echo esc_attr( $team_title_line1 ); ?>" placeholder="Leadership" />
                    <small>Regular text before line break</small>
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_team_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_team_title_line2" id="jkjaac_team_title_line2" value="<?php echo esc_attr( $team_title_line2 ); ?>" placeholder="Profiles" />
                    <small>Italic/emphasized text</small>
                </div>
            </div>
            
            <!-- Description -->
            <div class="jkjaac-field">
                <label for="jkjaac_team_description">Description</label>
                <textarea name="jkjaac_team_description" id="jkjaac_team_description" rows="4" placeholder="JKJAAC is deliberately structured as a collective leadership — not a one-man movement. Core committee members represent diverse geographic, professional, and social constituencies across all districts of AJK. Each has risked personal freedom and safety for the movement."><?php echo esc_textarea( $team_description ); ?></textarea>
                <small>The main description text below the title</small>
            </div>
        </div>
        
        <!-- Display Settings -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Display Settings</h3>
                <span>VISIBILITY & COUNT</span>
            </div>
            
            <!-- Leader Count -->
            <div class="jkjaac-field">
                <label for="jkjaac_team_leader_count">Number of Leaders to Display</label>
                <select name="jkjaac_team_leader_count" id="jkjaac_team_leader_count">
                    <option value="" <?php selected( $team_leader_count, '' ); ?>>Show All Leaders</option>
                    <option value="3" <?php selected( $team_leader_count, '3' ); ?>>Show 3 Leaders</option>
                    <option value="4" <?php selected( $team_leader_count, '4' ); ?>>Show 4 Leaders</option>
                    <option value="6" <?php selected( $team_leader_count, '6' ); ?>>Show 6 Leaders</option>
                </select>
                <small>Control how many leadership profiles appear on this page</small>
            </div>
        </div>
        
        <!-- Hide Option -->
        <div class="jkjaac-checkbox-group pulse-glow-style">
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_team_hide_section" id="jkjaac_team_hide_section" value="1" <?php checked( $team_hide_section, '1' ); ?> />
                <label for="jkjaac_team_hide_section">Hide Entire Team Section on this page</label>
            </div>
        </div>
    </div>
</div>