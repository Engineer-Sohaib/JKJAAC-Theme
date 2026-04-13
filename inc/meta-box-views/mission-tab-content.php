<?php
/**
 * Mission Tab Content - Using Unified Classes
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
            <input type="checkbox" name="jkjaac_mission_override" id="jkjaac_mission_override" value="1" <?php checked( $mission_override, '1' ); ?> />
            <label for="jkjaac_mission_override">
                Override default mission section for this page
                <small>Enable custom mission content below. Leave unchecked to use Customizer defaults.</small>
            </label>
        </div>
        
        <!-- Content Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Mission Content</h3>
                <span>LABEL, TITLE & DESCRIPTION</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_mission_label">Section Label</label>
                <input type="text" name="jkjaac_mission_label" id="jkjaac_mission_label" value="<?php echo esc_attr( $mission_label ); ?>" placeholder="Our Mission" />
                <small>The small label above the title</small>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_mission_title">Title - Part 1 (Plain Text)</label>
                    <input type="text" name="jkjaac_mission_title" id="jkjaac_mission_title" value="<?php echo esc_attr( $mission_title ); ?>" placeholder="Fighting for" />
                    <small>Regular text before the emphasized word</small>
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_mission_title_accent">Title - Part 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_mission_title_accent" id="jkjaac_mission_title_accent" value="<?php echo esc_attr( $mission_title_accent ); ?>" placeholder="Economic Justice and Rights" />
                    <small>This text will be gold and italic</small>
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_mission_description">Description Text</label>
                <textarea name="jkjaac_mission_description" id="jkjaac_mission_description" rows="6" placeholder="Enter description..."><?php echo esc_textarea( $mission_description ); ?></textarea>
                <small>The main description that appears below the title</small>
            </div>
        </div>
        
        <!-- Demands Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Key Demands</h3>
                <span>LIST OF DEMANDS (UP TO 5)</span>
            </div>
            
            <p class="jkjaac-hint">Add up to 5 key demands that appear in the numbered list.</p>
            
            <table class="jkjaac-demands-table">
                <thead>
                    <tr>
                        <th style="width: 15%;">Number</th>
                        <th style="width: 85%;">Demand Text</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if ( ! is_array( $mission_demands ) || empty( $mission_demands ) ) {
                        $mission_demands = array_fill( 0, 5, array( 'number' => '', 'text' => '' ) );
                    }
                    for ( $i = 0; $i < 5; $i++ ) : 
                    ?>
                        <tr>
                            <td>
                                <input type="text" name="jkjaac_mission_demands[<?php echo $i; ?>][number]" value="<?php echo esc_attr( isset( $mission_demands[ $i ]['number'] ) ? $mission_demands[ $i ]['number'] : ( $i + 1 ) ); ?>" placeholder="<?php echo $i + 1; ?>" />
                            </td>
                            <td>
                                <input type="text" name="jkjaac_mission_demands[<?php echo $i; ?>][text]" value="<?php echo esc_attr( isset( $mission_demands[ $i ]['text'] ) ? $mission_demands[ $i ]['text'] : '' ); ?>" placeholder="Enter demand text here..." />
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Image Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Image & Caption</h3>
                <span>VISUAL ELEMENT</span>
            </div>
            
            <div class="jkjaac-field">
                <label>Featured Image</label>
                <div class="jkjaac-image-preview" style="margin-bottom: 10px; min-height: 50px;">
                    <?php 
                    $preview_url = '';
                    if ( $mission_image_id ) {
                        $preview_url = wp_get_attachment_image_url( $mission_image_id, 'medium' );
                    } elseif ( $mission_image_url ) {
                        $preview_url = $mission_image_url;
                    }
                    if ( $preview_url ) : 
                    ?>
                        <img src="<?php echo esc_url( $preview_url ); ?>" style="max-width: 100%; max-height: 150px; border-radius: 4px;" />
                    <?php endif; ?>
                </div>
                <input type="hidden" name="jkjaac_mission_image_id" id="jkjaac_mission_image_id" value="<?php echo esc_attr( $mission_image_id ); ?>" />
                <input type="hidden" name="jkjaac_mission_image_url" id="jkjaac_mission_image_url" value="<?php echo esc_url( $mission_image_url ); ?>" />
                <button type="button" class="button jkjaac-upload-image-btn" data-target="mission">Select Image</button>
                <button type="button" class="button jkjaac-remove-image-btn" style="display: <?php echo ( $mission_image_id || $mission_image_url ) ? 'inline-flex' : 'none'; ?>;">Remove Image</button>
                <small>Choose an image for the mission section</small>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_mission_image_alt">Image Alt Text</label>
                <input type="text" name="jkjaac_mission_image_alt" id="jkjaac_mission_image_alt" value="<?php echo esc_attr( $mission_image_alt ); ?>" placeholder="Descriptive text for accessibility" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_mission_caption_title">Caption Title</label>
                    <input type="text" name="jkjaac_mission_caption_title" id="jkjaac_mission_caption_title" value="<?php echo esc_attr( $mission_caption_title ); ?>" placeholder="The Movement Lives" />
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_mission_caption_text">Caption Text</label>
                    <input type="text" name="jkjaac_mission_caption_text" id="jkjaac_mission_caption_text" value="<?php echo esc_attr( $mission_caption_text ); ?>" placeholder="A grassroots civil-society coalition..." />
                </div>
            </div>
        </div>
        
        <!-- Quote Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Pull Quote</h3>
                <span>TESTIMONIAL / STATEMENT</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_mission_quote_text">Quote Text</label>
                <textarea name="jkjaac_mission_quote_text" id="jkjaac_mission_quote_text" rows="3" placeholder="Enter quote text..."><?php echo esc_textarea( $mission_quote_text ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_mission_quote_cite">Quote Citation</label>
                <input type="text" name="jkjaac_mission_quote_cite" id="jkjaac_mission_quote_cite" value="<?php echo esc_attr( $mission_quote_cite ); ?>" placeholder="— JKJAAC Core Committee" />
            </div>
        </div>
        
        <!-- Hide Option -->
        <div class="jkjaac-checkbox-group pulse-glow-style">
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_mission_hide_section" id="jkjaac_mission_hide_section" value="1" <?php checked( $mission_hide_section, '1' ); ?> />
                <label for="jkjaac_mission_hide_section">Hide Entire Mission Section on this page</label>
            </div>
        </div>
    </div>
</div>

<style>
/* Additional styles for image upload */
.jkjaac-upload-image-btn,
.jkjaac-remove-image-btn {
    margin-right: 8px !important;
    margin-top: 8px !important;
}
.jkjaac-image-preview img {
    border: 1px solid rgba(212, 175, 55, 0.3);
    background: #1a1a1a;
    padding: 4px;
}
</style>

<script>
(function($) {
    'use strict';
    
    // Wait for DOM to be ready
    $(document).ready(function() {
        
        // Handle image upload button click - using event delegation for dynamic elements
        $(document).on('click', '.jkjaac-upload-image-btn', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var field = button.closest('.jkjaac-field');
            var imageIdField = field.find('#jkjaac_mission_image_id');
            var imageUrlField = field.find('#jkjaac_mission_image_url');
            var previewDiv = field.find('.jkjaac-image-preview');
            var removeBtn = field.find('.jkjaac-remove-image-btn');
            
            // Check if media library is available
            if (typeof wp === 'undefined' || typeof wp.media === 'undefined') {
                console.error('WordPress media library not loaded');
                return;
            }
            
            // Create media uploader frame
            var frame = wp.media({
                title: 'Select or Upload Image for Mission Section',
                button: {
                    text: 'Use this image'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });
            
            // When image is selected in the media frame
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                
                // Update hidden fields
                if (imageIdField.length) {
                    imageIdField.val(attachment.id);
                }
                if (imageUrlField.length) {
                    imageUrlField.val(attachment.url);
                }
                
                // Update preview
                previewDiv.html('<img src="' + attachment.url + '" style="max-width: 100%; max-height: 150px; border-radius: 4px;" />');
                
                // Show remove button
                removeBtn.show();
                
                // Trigger change event to ensure save
                imageIdField.trigger('change');
            });
            
            // Open the media frame
            frame.open();
        });
        
        // Handle remove image button click
        $(document).on('click', '.jkjaac-remove-image-btn', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var field = button.closest('.jkjaac-field');
            var imageIdField = field.find('#jkjaac_mission_image_id');
            var imageUrlField = field.find('#jkjaac_mission_image_url');
            var previewDiv = field.find('.jkjaac-image-preview');
            
            // Clear hidden fields
            if (imageIdField.length) {
                imageIdField.val('');
            }
            if (imageUrlField.length) {
                imageUrlField.val('');
            }
            
            // Clear preview
            previewDiv.html('');
            
            // Hide remove button
            button.hide();
            
            // Trigger change event
            if (imageIdField.length) {
                imageIdField.trigger('change');
            }
        });
        
        // Re-initialize when switching tabs (for tabbed interface)
        $(document).on('click', '.jkjaac-tab-btn[data-tab="mission-tab"]', function() {
            // Small delay to ensure tab content is visible
            setTimeout(function() {
                // No re-initialization needed as event delegation handles it
                console.log('Mission tab activated');
            }, 100);
        });
        
    });
    
})(jQuery);
</script>