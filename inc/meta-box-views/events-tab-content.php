<?php
/**
 * Events Tab Content - Events Page Settings
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add nonce field
wp_nonce_field( 'jkjaac_events_meta_box', 'jkjaac_events_meta_box_nonce' );

// Get saved values
$events_override = get_post_meta( $post->ID, '_jkjaac_events_override', true );
$events_hide_section = get_post_meta( $post->ID, '_jkjaac_events_hide_section', true );

// Upcoming Events Header
$upcoming_label = get_post_meta( $post->ID, '_jkjaac_upcoming_label', true );
$upcoming_title_line1 = get_post_meta( $post->ID, '_jkjaac_upcoming_title_line1', true );
$upcoming_title_line2 = get_post_meta( $post->ID, '_jkjaac_upcoming_title_line2', true );
$upcoming_description = get_post_meta( $post->ID, '_jkjaac_upcoming_description', true );
$upcoming_count = get_post_meta( $post->ID, '_jkjaac_upcoming_count', true );

// Past Events Header
$past_label = get_post_meta( $post->ID, '_jkjaac_past_label', true );
$past_title_line1 = get_post_meta( $post->ID, '_jkjaac_past_title_line1', true );
$past_title_line2 = get_post_meta( $post->ID, '_jkjaac_past_title_line2', true );
$past_description = get_post_meta( $post->ID, '_jkjaac_past_description', true );
$past_count = get_post_meta( $post->ID, '_jkjaac_past_count', true );

// Event Categories (4 cards below ticker)
$event_categories = get_post_meta( $post->ID, '_jkjaac_event_categories', true );
if ( ! is_array( $event_categories ) || empty( $event_categories ) ) {
    $event_categories = array(
        array(
            'icon' => 'ri-calendar-event-line',
            'title' => 'General Council Meetings',
            'description' => 'The JKJAC convenes its General Council – bringing together representatives from member political parties, social organizations, and trade unions – to deliberate on the current political situation, approve action plans, and issue joint resolutions.'
        ),
        array(
            'icon' => 'ri-group-2-line',
            'title' => 'Bandhs & Protest Days',
            'description' => 'We call for peaceful shutdowns (bandhs) and observed days across Jammu and Kashmir to protest against policies that undermine our special status, challenge unilateral decisions, and demonstrate the collective will of the people.'
        ),
        array(
            'icon' => 'ri-candle-line',
            'title' => 'Solidarity Rallies & Marches',
            'description' => 'JKJAC organizes public rallies and marches in major cities and towns to mobilize citizens, express solidarity with political prisoners, and keep the flame of our legitimate rights burning in the public square.'
        ),
        array(
            'icon' => 'ri-presentation-line',
            'title' => 'Public Awareness Seminars',
            'description' => 'We regularly hold public lectures, seminars, and discussions featuring senior leaders, legal experts, and journalists to educate the community on critical issues, constitutional matters, and the importance of a united political stance.'
        )
    );
}

// Available icons for event categories
$available_icons = array(
    'ri-calendar-event-line' => 'Calendar Event',
    'ri-group-2-line' => 'Group',
    'ri-candle-line' => 'Candle',
    'ri-presentation-line' => 'Presentation',
    'ri-flag-line' => 'Flag',
    'ri-megaphone-line' => 'Megaphone',
    'ri-user-community-line' => 'Community',
    'ri-heart-line' => 'Heart',
    'ri-building-4-line' => 'Building',
    'ri-map-2-line' => 'Map',
    'ri-earth-line' => 'Earth/Global',
    'ri-group-line' => 'People',
    'ri-hand-heart-line' => 'Hand Heart',
    'ri-scales-line' => 'Justice',
    'ri-star-line' => 'Star',
    'ri-award-line' => 'Award',
    'ri-flashlight-line' => 'Flash/Energy'
);
?>

<div class="jkjaac-meta-box">
    <div class="jkjaac-meta-body">
        <!-- Override Toggle -->
        <div class="jkjaac-toggle-row">
            <input type="checkbox" name="jkjaac_events_override" id="jkjaac_events_override" value="1" <?php checked( $events_override, '1' ); ?> />
            <label for="jkjaac_events_override">
                Override default events settings for this page
                <small>Enable custom events content below. Leave unchecked to use defaults.</small>
            </label>
        </div>
        
        <!-- Event Categories Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Event Categories</h3>
                <span>4 CARDS BELOW TICKER</span>
            </div>
            
            <p class="jkjaac-hint">Customize the 4 event category cards that appear below the news ticker.</p>
            
            <?php for ( $i = 0; $i < 4; $i++ ) : 
                $cat = isset( $event_categories[ $i ] ) ? $event_categories[ $i ] : array( 'icon' => '', 'title' => '', 'description' => '' );
            ?>
                <div class="jkjaac-category-item" style="background: rgba(212, 175, 55, 0.05); border: 1px solid rgba(212, 175, 55, 0.15); border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                    <h4 style="margin: 0 0 15px; color: #d4af37; font-size: 14px; font-weight: 600;">
                        <i class="ri-layout-grid-line" style="margin-right: 6px;"></i>
                        Category <?php echo $i + 1; ?>
                    </h4>
                    
                    <div class="jkjaac-field">
                        <label for="event_cat_icon_<?php echo $i; ?>">Icon</label>
                        <select name="jkjaac_event_categories[<?php echo $i; ?>][icon]" id="event_cat_icon_<?php echo $i; ?>" style="width: 100%;">
                            <option value="">— Select Icon —</option>
                            <?php foreach ( $available_icons as $value => $label ) : ?>
                                <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $cat['icon'], $value ); ?>>
                                    <?php echo esc_html( $label ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <small>Icon displayed at the top of the card</small>
                    </div>
                    
                    <div class="jkjaac-field">
                        <label for="event_cat_title_<?php echo $i; ?>">Title</label>
                        <input type="text" name="jkjaac_event_categories[<?php echo $i; ?>][title]" 
                               id="event_cat_title_<?php echo $i; ?>"
                               value="<?php echo esc_attr( $cat['title'] ); ?>" 
                               placeholder="General Council Meetings" style="width: 100%;" />
                    </div>
                    
                    <div class="jkjaac-field">
                        <label for="event_cat_desc_<?php echo $i; ?>">Description</label>
                        <textarea name="jkjaac_event_categories[<?php echo $i; ?>][description]" 
                                  id="event_cat_desc_<?php echo $i; ?>"
                                  rows="3" style="width: 100%;"><?php echo esc_textarea( $cat['description'] ); ?></textarea>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        
        <!-- Upcoming Events Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Upcoming Events Section</h3>
                <span>HEADER & DISPLAY SETTINGS</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_upcoming_label">Section Label</label>
                <input type="text" name="jkjaac_upcoming_label" id="jkjaac_upcoming_label" 
                       value="<?php echo esc_attr( $upcoming_label ); ?>" 
                       placeholder="Upcoming Events" />
                <small>Small label above the title</small>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_upcoming_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_upcoming_title_line1" id="jkjaac_upcoming_title_line1" 
                           value="<?php echo esc_attr( $upcoming_title_line1 ); ?>" 
                           placeholder="Key Mobilizations" />
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_upcoming_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_upcoming_title_line2" id="jkjaac_upcoming_title_line2" 
                           value="<?php echo esc_attr( $upcoming_title_line2 ); ?>" 
                           placeholder="Ahead" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_upcoming_description">Description</label>
                <textarea name="jkjaac_upcoming_description" id="jkjaac_upcoming_description" 
                          rows="3"><?php echo esc_textarea( $upcoming_description ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_upcoming_count">Number of Events to Display</label>
                <select name="jkjaac_upcoming_count" id="jkjaac_upcoming_count">
                    <option value="" <?php selected( $upcoming_count, '' ); ?>>Show All</option>
                    <option value="3" <?php selected( $upcoming_count, '3' ); ?>>Show 3 Events</option>
                    <option value="4" <?php selected( $upcoming_count, '4' ); ?>>Show 4 Events</option>
                    <option value="6" <?php selected( $upcoming_count, '6' ); ?>>Show 6 Events</option>
                </select>
            </div>
        </div>
        
        <!-- Past Events Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Past Events Section</h3>
                <span>HEADER & DISPLAY SETTINGS</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_past_label">Section Label</label>
                <input type="text" name="jkjaac_past_label" id="jkjaac_past_label" 
                       value="<?php echo esc_attr( $past_label ); ?>" 
                       placeholder="Past Events" />
                <small>Small label above the title</small>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_past_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_past_title_line1" id="jkjaac_past_title_line1" 
                           value="<?php echo esc_attr( $past_title_line1 ); ?>" 
                           placeholder="A History of" />
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_past_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_past_title_line2" id="jkjaac_past_title_line2" 
                           value="<?php echo esc_attr( $past_title_line2 ); ?>" 
                           placeholder="United Struggle" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_past_description">Description</label>
                <textarea name="jkjaac_past_description" id="jkjaac_past_description" 
                          rows="3"><?php echo esc_textarea( $past_description ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_past_count">Number of Events to Display</label>
                <select name="jkjaac_past_count" id="jkjaac_past_count">
                    <option value="" <?php selected( $past_count, '' ); ?>>Show All</option>
                    <option value="4" <?php selected( $past_count, '4' ); ?>>Show 4 Events</option>
                    <option value="6" <?php selected( $past_count, '6' ); ?>>Show 6 Events</option>
                    <option value="8" <?php selected( $past_count, '8' ); ?>>Show 8 Events</option>
                </select>
            </div>
        </div>
        
        <!-- Hide Option -->
        <div class="jkjaac-checkbox-group pulse-glow-style">
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_events_hide_section" id="jkjaac_events_hide_section" value="1" <?php checked( $events_hide_section, '1' ); ?> />
                <label for="jkjaac_events_hide_section">Use default settings (ignore overrides)</label>
            </div>
        </div>
    </div>
</div>

<style>
    .jkjaac-category-item {
        transition: border-color 0.2s ease;
    }
    
    .jkjaac-category-item:hover {
        border-color: rgba(212, 175, 55, 0.3);
    }
    
    .jkjaac-category-item h4 i {
        color: #d4af37;
    }
</style>