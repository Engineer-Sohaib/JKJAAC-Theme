<?php
/**
 * CTA Tab Content - Using Unified Classes
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
            <input type="checkbox" name="jkjaac_cta_override" id="jkjaac_cta_override" value="1" <?php checked( $cta_override, '1' ); ?> />
            <label for="jkjaac_cta_override">
                Override default CTA for this page
                <small>Enable custom CTA content below. Leave unchecked to use Customizer defaults.</small>
            </label>
        </div>
        
        <!-- Heading Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Heading & Description</h3>
                <span>MAIN MESSAGE</span>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label>Heading Part 1 (Plain Text)</label>
                    <input type="text" name="jkjaac_cta_heading" id="jkjaac_cta_heading" value="<?php echo esc_attr($heading); ?>" placeholder="Join the" />
                    <small>Regular text before the emphasized word</small>
                </div>
                
                <div class="jkjaac-field">
                    <label>Heading Part 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_cta_heading_accent" id="jkjaac_cta_heading_accent" value="<?php echo esc_attr($heading_accent); ?>" placeholder="Movement" />
                    <small>This text will be gold and italic</small>
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label>Description / Message</label>
                <textarea name="jkjaac_cta_description" id="jkjaac_cta_description" placeholder="Whether you join as a member, donate to our cause, or simply spread the word — every act of solidarity matters."><?php echo esc_textarea($description); ?></textarea>
                <small>The main message that appears below the heading</small>
            </div>
        </div>
        
        <!-- Buttons Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Action Buttons</h3>
                <span>CALL TO ACTION</span>
            </div>
            
            <p class="jkjaac-hint">Add up to 3 buttons. Leave text empty to hide a button.</p>
            
            <table class="jkjaac-buttons-table">
                <thead>
                    <tr>
                        <th style="width: 35%;">Button Text</th>
                        <th style="width: 35%;">URL (Page Slug)</th>
                        <th style="width: 30%;">Button Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" name="jkjaac_cta_button1_text" id="jkjaac_cta_button1_text" value="<?php echo esc_attr($button1_text); ?>" placeholder="Our 38-Point Charter" />
                        </td>
                        <td>
                            <input type="text" name="jkjaac_cta_button1_url" id="jkjaac_cta_button1_url" value="<?php echo esc_url($button1_url); ?>" placeholder="38-point-charter" />
                        </td>
                        <td>
                            <select name="jkjaac_cta_button1_type" id="jkjaac_cta_button1_type">
                                <option value="btn-p" <?php selected($button1_type, 'btn-p'); ?>>Primary (Gold)</option>
                                <option value="btn-g" <?php selected($button1_type, 'btn-g'); ?>>Secondary (Ghost)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="jkjaac_cta_button2_text" id="jkjaac_cta_button2_text" value="<?php echo esc_attr($button2_text); ?>" placeholder="Our Struggles" />
                        </td>
                        <td>
                            <input type="text" name="jkjaac_cta_button2_url" id="jkjaac_cta_button2_url" value="<?php echo esc_url($button2_url); ?>" placeholder="struggles" />
                        </td>
                        <td>
                            <select name="jkjaac_cta_button2_type" id="jkjaac_cta_button2_type">
                                <option value="btn-p" <?php selected($button2_type, 'btn-p'); ?>>Primary (Gold)</option>
                                <option value="btn-g" <?php selected($button2_type, 'btn-g'); ?>>Secondary (Ghost)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="jkjaac_cta_button3_text" id="jkjaac_cta_button3_text" value="<?php echo esc_attr($button3_text); ?>" placeholder="Contact Us" />
                        </td>
                        <td>
                            <input type="text" name="jkjaac_cta_button3_url" id="jkjaac_cta_button3_url" value="<?php echo esc_url($button3_url); ?>" placeholder="contact" />
                        </td>
                        <td>
                            <select name="jkjaac_cta_button3_type" id="jkjaac_cta_button3_type">
                                <option value="btn-p" <?php selected($button3_type, 'btn-p'); ?>>Primary (Gold)</option>
                                <option value="btn-g" <?php selected($button3_type, 'btn-g'); ?>>Secondary (Ghost)</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Hide Option -->
        <div class="jkjaac-checkbox-group pulse-glow-style">
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_cta_hide_section" id="jkjaac_cta_hide_section" value="1" <?php checked( $cta_hide_section, '1' ); ?> />
                <label for="jkjaac_cta_hide_section">Hide Entire CTA Section on this page</label>
            </div>
        </div>
    </div>
</div>