<?php
/**
 * Negotiations Tab Content - Negotiations Page Settings
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wp_nonce_field( 'jkjaac_negotiations_meta_box', 'jkjaac_negotiations_meta_box_nonce' );

// Get saved values
$negotiations_override = get_post_meta( $post->ID, '_jkjaac_negotiations_override', true );

// Preamble Section
$preamble_label = get_post_meta( $post->ID, '_jkjaac_preamble_label', true );
$preamble_title_line1 = get_post_meta( $post->ID, '_jkjaac_preamble_title_line1', true );
$preamble_title_line2 = get_post_meta( $post->ID, '_jkjaac_preamble_title_line2', true );
$preamble_description = get_post_meta( $post->ID, '_jkjaac_preamble_description', true );
$preamble_paragraphs = get_post_meta( $post->ID, '_jkjaac_preamble_paragraphs', true );

// History Section (NEW)
$history_label = get_post_meta( $post->ID, '_jkjaac_history_label', true );
$history_title_line1 = get_post_meta( $post->ID, '_jkjaac_history_title_line1', true );
$history_title_line2 = get_post_meta( $post->ID, '_jkjaac_history_title_line2', true );
$history_description = get_post_meta( $post->ID, '_jkjaac_history_description', true );
$history_count = get_post_meta( $post->ID, '_jkjaac_history_count', true );
$hide_history_section = get_post_meta( $post->ID, '_jkjaac_hide_history_section', true );

// Accord Section Header
$accord_label = get_post_meta( $post->ID, '_jkjaac_accord_label', true );
$accord_title_line1 = get_post_meta( $post->ID, '_jkjaac_accord_title_line1', true );
$accord_title_line2 = get_post_meta( $post->ID, '_jkjaac_accord_title_line2', true );
$accord_description = get_post_meta( $post->ID, '_jkjaac_accord_description', true );
$accord_count = get_post_meta( $post->ID, '_jkjaac_accord_count', true );
$hide_accord_section = get_post_meta( $post->ID, '_jkjaac_hide_accord_section', true );

// Tracker Section Header
$tracker_label = get_post_meta( $post->ID, '_jkjaac_tracker_label', true );
$tracker_title_line1 = get_post_meta( $post->ID, '_jkjaac_tracker_title_line1', true );
$tracker_title_line2 = get_post_meta( $post->ID, '_jkjaac_tracker_title_line2', true );
$tracker_quote = get_post_meta( $post->ID, '_jkjaac_tracker_quote', true );
$tracker_cite = get_post_meta( $post->ID, '_jkjaac_tracker_cite', true );
$hide_tracker_section = get_post_meta( $post->ID, '_jkjaac_hide_tracker_section', true );

// Progress Bars
$progress_bars = get_post_meta( $post->ID, '_jkjaac_progress_bars', true );
if ( ! is_array( $progress_bars ) || empty( $progress_bars ) ) {
    $progress_bars = array(
        array( 'label' => "Government's Claim", 'width' => '98', 'value' => '98% fulfilled', 'warning' => true ),
        array( 'label' => 'Confirmed Implemented', 'width' => '83.7', 'value' => '31/37 = 83.7%', 'warning' => false ),
        array( 'label' => "JKJAAC's Assessment", 'width' => '25', 'value' => 'Jan 2026 statement', 'warning' => false ),
    );
}
?>

<div class="jkjaac-meta-box">
    <div class="jkjaac-meta-body">
        <!-- Override Toggle -->
        <div class="jkjaac-toggle-row">
            <input type="checkbox" name="jkjaac_negotiations_override" id="jkjaac_negotiations_override" value="1" <?php checked( $negotiations_override, '1' ); ?> />
            <label for="jkjaac_negotiations_override">
                Override default negotiations content for this page
                <small>Enable custom negotiations content below. Leave unchecked to use defaults.</small>
            </label>
        </div>
        
        <!-- Preamble Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Preamble Section</h3>
                <span>INTRODUCTION</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_preamble_label">Section Label</label>
                <input type="text" name="jkjaac_preamble_label" id="jkjaac_preamble_label" 
                       value="<?php echo esc_attr( $preamble_label ); ?>" placeholder="Preamble" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_preamble_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_preamble_title_line1" id="jkjaac_preamble_title_line1" 
                           value="<?php echo esc_attr( $preamble_title_line1 ); ?>" placeholder="The 2025 Agreement:" />
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_preamble_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_preamble_title_line2" id="jkjaac_preamble_title_line2" 
                           value="<?php echo esc_attr( $preamble_title_line2 ); ?>" placeholder="A People's Victory" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_preamble_description">Short Description</label>
                <textarea name="jkjaac_preamble_description" id="jkjaac_preamble_description" rows="4"><?php echo esc_textarea( $preamble_description ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label>Paragraphs</label>
                <?php 
                if ( ! is_array( $preamble_paragraphs ) ) {
                    $preamble_paragraphs = array( '', '' );
                }
                for ( $i = 0; $i < 2; $i++ ) : 
                ?>
                    <textarea name="jkjaac_preamble_paragraphs[<?php echo $i; ?>]" 
                              rows="3" style="width:100%; margin-bottom:10px;"><?php echo esc_textarea( isset( $preamble_paragraphs[$i] ) ? $preamble_paragraphs[$i] : '' ); ?></textarea>
                <?php endfor; ?>
            </div>
        </div>
        
        <!-- History Section (NEW) -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Negotiation History Section</h3>
                <span>THREE ROUNDS OF TALKS</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_history_label">Section Label</label>
                <input type="text" name="jkjaac_history_label" id="jkjaac_history_label" 
                       value="<?php echo esc_attr( $history_label ); ?>" placeholder="Negotiation History" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_history_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_history_title_line1" id="jkjaac_history_title_line1" 
                           value="<?php echo esc_attr( $history_title_line1 ); ?>" placeholder="Three Rounds" />
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_history_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_history_title_line2" id="jkjaac_history_title_line2" 
                           value="<?php echo esc_attr( $history_title_line2 ); ?>" placeholder="of Talks" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_history_description">Description</label>
                <textarea name="jkjaac_history_description" id="jkjaac_history_description" rows="3"><?php echo esc_textarea( $history_description ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_history_count">Number of Rounds to Display</label>
                <select name="jkjaac_history_count" id="jkjaac_history_count">
                    <option value="" <?php selected( $history_count, '' ); ?>>Show All</option>
                    <option value="3" <?php selected( $history_count, '3' ); ?>>Show 3 Rounds</option>
                    <option value="4" <?php selected( $history_count, '4' ); ?>>Show 4 Rounds</option>
                    <option value="5" <?php selected( $history_count, '5' ); ?>>Show 5 Rounds</option>
                </select>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hide_history_section" id="jkjaac_hide_history_section" value="1" <?php checked( $hide_history_section, '1' ); ?> />
                <label for="jkjaac_hide_history_section">Hide History Section</label>
            </div>
        </div>
        
        <!-- Accord Section Header -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Accord Section Header</h3>
                <span>KEY POINTS OF HISTORIC ACCORD</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_accord_label">Section Label</label>
                <input type="text" name="jkjaac_accord_label" id="jkjaac_accord_label" 
                       value="<?php echo esc_attr( $accord_label ); ?>" placeholder="The October 4, 2025 Agreement" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_accord_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_accord_title_line1" id="jkjaac_accord_title_line1" 
                           value="<?php echo esc_attr( $accord_title_line1 ); ?>" placeholder="Key Points of the" />
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_accord_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_accord_title_line2" id="jkjaac_accord_title_line2" 
                           value="<?php echo esc_attr( $accord_title_line2 ); ?>" placeholder="Historic Accord" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_accord_description">Description</label>
                <textarea name="jkjaac_accord_description" id="jkjaac_accord_description" rows="3"><?php echo esc_textarea( $accord_description ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_accord_count">Number of Points to Display</label>
                <select name="jkjaac_accord_count" id="jkjaac_accord_count">
                    <option value="" <?php selected( $accord_count, '' ); ?>>Show All</option>
                    <option value="4" <?php selected( $accord_count, '4' ); ?>>Show 4 Points</option>
                    <option value="6" <?php selected( $accord_count, '6' ); ?>>Show 6 Points</option>
                    <option value="8" <?php selected( $accord_count, '8' ); ?>>Show 8 Points</option>
                </select>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hide_accord_section" id="jkjaac_hide_accord_section" value="1" <?php checked( $hide_accord_section, '1' ); ?> />
                <label for="jkjaac_hide_accord_section">Hide Accord Points Section</label>
            </div>
        </div>
        
        <!-- Tracker Section Header -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Implementation Tracker</h3>
                <span>CURRENT STATUS</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_tracker_label">Section Label</label>
                <input type="text" name="jkjaac_tracker_label" id="jkjaac_tracker_label" 
                       value="<?php echo esc_attr( $tracker_label ); ?>" placeholder="Current Status — March 2026" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_tracker_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_tracker_title_line1" id="jkjaac_tracker_title_line1" 
                           value="<?php echo esc_attr( $tracker_title_line1 ); ?>" placeholder="Implementation" />
                </div>
                <div class="jkjaac-field">
                    <label for="jkjaac_tracker_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_tracker_title_line2" id="jkjaac_tracker_title_line2" 
                           value="<?php echo esc_attr( $tracker_title_line2 ); ?>" placeholder="Tracker" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_tracker_quote">Quote Text</label>
                <textarea name="jkjaac_tracker_quote" id="jkjaac_tracker_quote" rows="3"><?php echo esc_textarea( $tracker_quote ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_tracker_cite">Quote Citation</label>
                <input type="text" name="jkjaac_tracker_cite" id="jkjaac_tracker_cite" 
                       value="<?php echo esc_attr( $tracker_cite ); ?>" placeholder="— Shaukat Nawaz Mir, January 2026" />
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hide_tracker_section" id="jkjaac_hide_tracker_section" value="1" <?php checked( $hide_tracker_section, '1' ); ?> />
                <label for="jkjaac_hide_tracker_section">Hide Tracker Section</label>
            </div>
        </div>
        
        <!-- Progress Bars -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Progress Bars</h3>
                <span>IMPLEMENTATION PROGRESS</span>
            </div>
            
            <p class="jkjaac-hint">Configure the progress bars shown at the bottom of the tracker section.</p>
            
            <table class="jkjaac-demands-table">
                <thead>
                    <tr>
                        <th>Label</th>
                        <th>Width (%)</th>
                        <th>Value Display</th>
                        <th>Warning Style</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ( $i = 0; $i < 3; $i++ ) : 
                        $bar = isset( $progress_bars[$i] ) ? $progress_bars[$i] : array( 'label' => '', 'width' => '', 'value' => '', 'warning' => false );
                    ?>
                        <tr>
                            <td>
                                <input type="text" name="jkjaac_progress_bars[<?php echo $i; ?>][label]" 
                                       value="<?php echo esc_attr( $bar['label'] ); ?>" style="width:100%;" />
                            </td>
                            <td>
                                <input type="number" step="0.1" min="0" max="100" 
                                       name="jkjaac_progress_bars[<?php echo $i; ?>][width]" 
                                       value="<?php echo esc_attr( $bar['width'] ); ?>" style="width:80px;" />
                            </td>
                            <td>
                                <input type="text" name="jkjaac_progress_bars[<?php echo $i; ?>][value]" 
                                       value="<?php echo esc_attr( $bar['value'] ); ?>" style="width:100%;" />
                            </td>
                            <td style="text-align:center;">
                                <input type="checkbox" name="jkjaac_progress_bars[<?php echo $i; ?>][warning]" 
                                       value="1" <?php checked( isset( $bar['warning'] ) && $bar['warning'], true ); ?> />
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Note about adding items -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Adding Content Items</h3>
                <span>INSTRUCTIONS</span>
            </div>
            <p style="color: #f6f6ff; padding: 10px; background: rgba(212, 175, 55, 0.05); border-radius: 6px;">
                <i class="ri-information-line" style="color: #d4af37; margin-right: 8px;"></i>
                <strong>Negotiation Rounds:</strong> Add/edit rounds in <strong>Dashboard → Negotiation Rounds</strong>. Assign an Outcome taxonomy term.<br>
                <strong>Accord Points:</strong> Add/edit points in <strong>Dashboard → Accord Points</strong>.<br>
                <strong>Tracker Items:</strong> Add/edit items in <strong>Dashboard → Impl. Tracker</strong>. Assign a Status taxonomy term.
            </p>
        </div>
    </div>
</div>