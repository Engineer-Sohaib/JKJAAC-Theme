<?php
/**
 * Pull Quote Tab Content - Using Unified Classes
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="jkjaac-meta-box">
    <div class="jkjaac-meta-body">
        <!-- Override Toggle -->
        <div class="jkjaac-toggle-row">
            <input type="checkbox" name="jkjaac_pull_quote_override" id="jkjaac_pull_quote_override" value="1" <?php checked( $pq_override, '1' ); ?> />
            <label for="jkjaac_pull_quote_override">
                Override default pull quote for this page
                <small>Enable custom pull quote content below. Leave unchecked to use Customizer defaults.</small>
            </label>
        </div>
        
        <!-- Quote Content Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Quote Content</h3>
                <span>TESTIMONIAL & CITATION</span>
            </div>
            
            <!-- Quote Text -->
            <div class="jkjaac-field">
                <label for="jkjaac_pull_quote_text">Quote Text</label>
                <textarea name="jkjaac_pull_quote_text" id="jkjaac_pull_quote_text" rows="4" placeholder="Enter the quote text..."><?php echo esc_textarea( $quote_text ); ?></textarea>
                <small>The main testimonial or statement quote.</small>
            </div>
            
            <!-- Citation -->
            <div class="jkjaac-field">
                <label for="jkjaac_pull_quote_cite">Citation</label>
                <input type="text" name="jkjaac_pull_quote_cite" id="jkjaac_pull_quote_cite" value="<?php echo esc_attr( $cite ); ?>" placeholder="— JKJAAC Core Committee Statement, November 2025" />
                <small>The source or attribution of the quote.</small>
            </div>
        </div>
        
        <!-- Buttons Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Button Settings</h3>
                <span>CALL TO ACTION BUTTONS</span>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_pull_quote_btn_primary_text">Primary Button Text</label>
                    <input type="text" name="jkjaac_pull_quote_btn_primary_text" id="jkjaac_pull_quote_btn_primary_text" value="<?php echo esc_attr( $pq_btn_primary_text ); ?>" placeholder="Full Struggle History" />
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_pull_quote_btn_primary_link">Primary Button Link (Page Slug)</label>
                    <input type="text" name="jkjaac_pull_quote_btn_primary_link" id="jkjaac_pull_quote_btn_primary_link" value="<?php echo esc_attr( $pq_btn_primary_link ); ?>" placeholder="struggles" />
                </div>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_pull_quote_btn_secondary_text">Secondary Button Text</label>
                    <input type="text" name="jkjaac_pull_quote_btn_secondary_text" id="jkjaac_pull_quote_btn_secondary_text" value="<?php echo esc_attr( $pq_btn_secondary_text ); ?>" placeholder="Latest Updates" />
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_pull_quote_btn_secondary_link">Secondary Button Link (Page Slug)</label>
                    <input type="text" name="jkjaac_pull_quote_btn_secondary_link" id="jkjaac_pull_quote_btn_secondary_link" value="<?php echo esc_attr( $pq_btn_secondary_link ); ?>" placeholder="blogs" />
                </div>
            </div>
        </div>
        
        <!-- Options -->
        <div class="jkjaac-checkbox-group pulse-glow-style">
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_pull_quote_show_buttons" id="jkjaac_pull_quote_show_buttons" value="1" <?php checked( $show_buttons, '1' ); ?> />
                <label for="jkjaac_pull_quote_show_buttons">Show Buttons</label>
            </div>
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_pull_quote_hide_section" id="jkjaac_pull_quote_hide_section" value="1" <?php checked( $hide_section, '1' ); ?> />
                <label for="jkjaac_pull_quote_hide_section">Hide Entire Pull Quote Section on this page</label>
            </div>
        </div>
    </div>
</div>