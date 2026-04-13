<?php
/**
 * About Tab Content - Using Unified Classes
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
            <input type="checkbox" name="jkjaac_about_override" id="jkjaac_about_override" value="1" <?php checked( $about_override, '1' ); ?> />
            <label for="jkjaac_about_override">
                Override default About section for this page
                <small>Enable custom about content below. Leave unchecked to use Customizer defaults.</small>
            </label>
        </div>
        
        <!-- Header Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Section Header</h3>
                <span>LABEL & TITLE</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_about_label">Section Label (s-label)</label>
                <input type="text" name="jkjaac_about_label" id="jkjaac_about_label" value="<?php echo esc_attr( $about_label ); ?>" placeholder="Introduction" />
                <small>The small label above the main title</small>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_about_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_about_title_line1" id="jkjaac_about_title_line1" value="<?php echo esc_attr( $about_title_line1 ); ?>" placeholder="Who We Are" />
                    <small>Regular text before line break</small>
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_about_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_about_title_line2" id="jkjaac_about_title_line2" value="<?php echo esc_attr( $about_title_line2 ); ?>" placeholder="Our Declaration" />
                    <small>This text will be gold/emphasized</small>
                </div>
            </div>
        </div>
        
        <!-- Description / Intro Text -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Introduction Text</h3>
                <span>SHORT DESCRIPTION</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_about_description">Description Text</label>
                <textarea name="jkjaac_about_description" id="jkjaac_about_description" rows="3" placeholder="Enter a short description..."><?php echo esc_textarea( $about_description ); ?></textarea>
                <small>Optional short description that appears above the main content</small>
            </div>
        </div>
        
        <!-- Main Content Paragraphs -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Main Content Paragraphs</h3>
                <span>BODY TEXT</span>
            </div>
            
            <p class="jkjaac-hint">Add up to 3 paragraphs for the main content section.</p>
            
            <?php
            if ( ! is_array( $about_paragraphs ) || empty( $about_paragraphs ) ) {
                $about_paragraphs = array_fill( 0, 3, '' );
            }
            ?>
            
            <?php for ( $i = 0; $i < 3; $i++ ) : ?>
                <div class="jkjaac-field" style="margin-bottom: 20px;">
                    <label for="jkjaac_about_paragraphs_<?php echo $i; ?>">Paragraph <?php echo $i + 1; ?></label>
                    <textarea name="jkjaac_about_paragraphs[<?php echo $i; ?>]" id="jkjaac_about_paragraphs_<?php echo $i; ?>" rows="4" placeholder="Enter paragraph text..."><?php echo esc_textarea( isset( $about_paragraphs[ $i ] ) ? $about_paragraphs[ $i ] : '' ); ?></textarea>
                </div>
            <?php endfor; ?>
        </div>
        
        <!-- Left Quote -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Inline Quote (Left Side)</h3>
                <span>TESTIMONIAL</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_about_quote_text">Quote Text</label>
                <textarea name="jkjaac_about_quote_text" id="jkjaac_about_quote_text" rows="3" placeholder="Enter quote text..."><?php echo esc_textarea( $about_quote_text ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_about_quote_cite">Quote Citation</label>
                <input type="text" name="jkjaac_about_quote_cite" id="jkjaac_about_quote_cite" value="<?php echo esc_attr( $about_quote_cite ); ?>" placeholder="— Source" />
            </div>
        </div>
        
        <!-- Image Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Image & Caption</h3>
                <span>VISUAL ELEMENT</span>
            </div>
            
            <div class="jkjaac-field">
                <label>Featured Image</label>
                <div class="jkjaac-image-preview">
                    <?php 
                    $preview_url = '';
                    if ( $about_image_id ) {
                        $preview_url = wp_get_attachment_image_url( $about_image_id, 'medium' );
                    } elseif ( $about_image_url ) {
                        $preview_url = $about_image_url;
                    }
                    if ( $preview_url ) : 
                    ?>
                        <img src="<?php echo esc_url( $preview_url ); ?>" />
                    <?php endif; ?>
                </div>
                <input type="hidden" name="jkjaac_about_image_id" id="jkjaac_about_image_id" value="<?php echo esc_attr( $about_image_id ); ?>" />
                <button type="button" class="button jkjaac-upload-image-btn">Select Image</button>
                <button type="button" class="button jkjaac-remove-image-btn" style="display: <?php echo ( $about_image_id || $about_image_url ) ? 'inline-block' : 'none'; ?>;">Remove Image</button>
                <small>Choose an image for the about section</small>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_about_image_url">Or Image URL</label>
                <input type="text" name="jkjaac_about_image_url" id="jkjaac_about_image_url" value="<?php echo esc_url( $about_image_url ); ?>" placeholder="https://example.com/image.jpg" />
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_about_image_alt">Image Alt Text</label>
                <input type="text" name="jkjaac_about_image_alt" id="jkjaac_about_image_alt" value="<?php echo esc_attr( $about_image_alt ); ?>" placeholder="Descriptive text" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_about_caption_title">Caption Title</label>
                    <input type="text" name="jkjaac_about_caption_title" id="jkjaac_about_caption_title" value="<?php echo esc_attr( $about_caption_title ); ?>" placeholder="The Movement Lives" />
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_about_caption_text">Caption Text</label>
                    <input type="text" name="jkjaac_about_caption_text" id="jkjaac_about_caption_text" value="<?php echo esc_attr( $about_caption_text ); ?>" placeholder="Caption description" />
                </div>
            </div>
        </div>
        
        <!-- Right Quote -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Quote (Right Side)</h3>
                <span>ADDITIONAL TESTIMONIAL</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_about_quote2_text">Quote Text</label>
                <textarea name="jkjaac_about_quote2_text" id="jkjaac_about_quote2_text" rows="3" placeholder="Enter quote text..."><?php echo esc_textarea( $about_quote2_text ); ?></textarea>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_about_quote2_cite">Quote Citation</label>
                <input type="text" name="jkjaac_about_quote2_cite" id="jkjaac_about_quote2_cite" value="<?php echo esc_attr( $about_quote2_cite ); ?>" placeholder="— Source" />
            </div>
        </div>
        
        <!-- Hide Option -->
        <div class="jkjaac-checkbox-group pulse-glow-style">
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_about_hide_section" id="jkjaac_about_hide_section" value="1" <?php checked( $about_hide_section, '1' ); ?> />
                <label for="jkjaac_about_hide_section">Hide Entire About Section on this page</label>
            </div>
        </div>
    </div>
</div>