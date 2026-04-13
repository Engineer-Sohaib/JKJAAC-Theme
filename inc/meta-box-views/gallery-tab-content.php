<?php
/**
 * Gallery Tab Content - Gallery Page Settings
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wp_nonce_field( 'jkjaac_gallery_meta_box', 'jkjaac_gallery_meta_box_nonce' );

// Get saved values
$gallery_override = get_post_meta( $post->ID, '_jkjaac_gallery_override', true );

// Gallery Settings
$gallery_default_cols = get_post_meta( $post->ID, '_jkjaac_gallery_default_cols', true );
$gallery_count = get_post_meta( $post->ID, '_jkjaac_gallery_count', true );
$gallery_orderby = get_post_meta( $post->ID, '_jkjaac_gallery_orderby', true );
$gallery_order = get_post_meta( $post->ID, '_jkjaac_gallery_order', true );

// Filter Settings
$show_filter_bar = get_post_meta( $post->ID, '_jkjaac_show_filter_bar', true );
$show_column_controls = get_post_meta( $post->ID, '_jkjaac_show_column_controls', true );
$show_photo_count = get_post_meta( $post->ID, '_jkjaac_show_photo_count', true );

// Categories to display
$display_categories = get_post_meta( $post->ID, '_jkjaac_gallery_categories', true );
if ( ! is_array( $display_categories ) ) {
    $display_categories = array();
}

// Get all gallery categories for selection
$all_categories = get_terms( array(
    'taxonomy'   => 'gallery_category',
    'hide_empty' => false,
) );
?>

<div class="jkjaac-meta-box">
    <div class="jkjaac-meta-body">
        <!-- Override Toggle -->
        <div class="jkjaac-toggle-row">
            <input type="checkbox" name="jkjaac_gallery_override" id="jkjaac_gallery_override" value="1" <?php checked( $gallery_override, '1' ); ?> />
            <label for="jkjaac_gallery_override">
                Override default gallery settings for this page
                <small>Enable custom gallery settings below. Leave unchecked to use defaults.</small>
            </label>
        </div>
        
        <!-- Display Settings -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Display Settings</h3>
                <span>GALLERY CONFIGURATION</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_gallery_default_cols">Default Columns</label>
                <select name="jkjaac_gallery_default_cols" id="jkjaac_gallery_default_cols">
                    <option value="2" <?php selected( $gallery_default_cols, '2' ); ?>>2 Columns</option>
                    <option value="3" <?php selected( $gallery_default_cols, '3' ); ?>>3 Columns</option>
                    <option value="4" <?php selected( $gallery_default_cols, '4' ); ?>>4 Columns (Recommended)</option>
                    <option value="5" <?php selected( $gallery_default_cols, '5' ); ?>>5 Columns</option>
                </select>
                <small>Initial column layout when page loads</small>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_gallery_count">Number of Photos to Display</label>
                <select name="jkjaac_gallery_count" id="jkjaac_gallery_count">
                    <option value="" <?php selected( $gallery_count, '' ); ?>>Show All Photos</option>
                    <option value="12" <?php selected( $gallery_count, '12' ); ?>>Show 12 Photos</option>
                    <option value="20" <?php selected( $gallery_count, '20' ); ?>>Show 20 Photos</option>
                    <option value="30" <?php selected( $gallery_count, '30' ); ?>>Show 30 Photos</option>
                    <option value="50" <?php selected( $gallery_count, '50' ); ?>>Show 50 Photos</option>
                </select>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_gallery_orderby">Order By</label>
                    <select name="jkjaac_gallery_orderby" id="jkjaac_gallery_orderby">
                        <option value="meta_value menu_order" <?php selected( $gallery_orderby, 'meta_value menu_order' ); ?>>Featured First</option>
                        <option value="menu_order" <?php selected( $gallery_orderby, 'menu_order' ); ?>>Menu Order</option>
                        <option value="date" <?php selected( $gallery_orderby, 'date' ); ?>>Date Added</option>
                        <option value="title" <?php selected( $gallery_orderby, 'title' ); ?>>Title</option>
                    </select>
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_gallery_order">Order Direction</label>
                    <select name="jkjaac_gallery_order" id="jkjaac_gallery_order">
                        <option value="DESC" <?php selected( $gallery_order, 'DESC' ); ?>>Descending (Newest/First)</option>
                        <option value="ASC" <?php selected( $gallery_order, 'ASC' ); ?>>Ascending (Oldest/Last)</option>
                    </select>
                </div>
            </div>
        </div>
        
        <!-- Filter Bar Settings -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Filter Bar Settings</h3>
                <span>CONTROLS VISIBILITY</span>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_show_filter_bar" id="jkjaac_show_filter_bar" value="1" <?php checked( $show_filter_bar, '1' ); ?> />
                <label for="jkjaac_show_filter_bar">Show Filter Pills</label>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_show_column_controls" id="jkjaac_show_column_controls" value="1" <?php checked( $show_column_controls, '1' ); ?> />
                <label for="jkjaac_show_column_controls">Show Column Switcher Buttons</label>
            </div>
            
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_show_photo_count" id="jkjaac_show_photo_count" value="1" <?php checked( $show_photo_count, '1' ); ?> />
                <label for="jkjaac_show_photo_count">Show Photo Count</label>
            </div>
        </div>
        
        <!-- Categories Selection -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Categories to Display</h3>
                <span>FILTER OPTIONS</span>
            </div>
            
            <p class="jkjaac-hint">Select which categories appear in the filter bar. Leave all unchecked to show all categories.</p>
            
            <div class="jkjaac-category-checklist" style="max-height: 250px; overflow-y: auto; padding: 10px; background: rgba(0,0,0,0.2); border-radius: 6px;">
                <?php foreach ( $all_categories as $category ) : ?>
                    <div class="jkjaac-checkbox-item" style="margin-bottom: 8px;">
                        <input type="checkbox" 
                               name="jkjaac_gallery_categories[]" 
                               id="cat_<?php echo esc_attr( $category->slug ); ?>" 
                               value="<?php echo esc_attr( $category->slug ); ?>"
                               <?php checked( in_array( $category->slug, $display_categories ) ); ?> />
                        <label for="cat_<?php echo esc_attr( $category->slug ); ?>">
                            <?php echo esc_html( $category->name ); ?>
                            <small style="color: #86757b;">(<?php echo $category->count; ?> photos)</small>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <small>If none selected, all categories with photos will be shown.</small>
        </div>
        
        <!-- Note about adding items -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Adding Gallery Items</h3>
                <span>INSTRUCTIONS</span>
            </div>
            <div style="color: #f6f6ff; padding: 10px; background: rgba(212, 175, 55, 0.05); border-radius: 6px;">
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;"></i>
                <strong>Add Photos:</strong> Go to <strong>Dashboard → Gallery → Add New</strong>.</p>
                
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;"></i>
                <strong>Required:</strong> Set a featured image and title for each photo.</p>
                
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;"></i>
                <strong>Categories:</strong> Assign categories to enable filtering. Categories are auto-created on theme activation.</p>
                
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;"></i>
                <strong>Featured Photos:</strong> Check "Feature this photo" to show it at the top of the gallery.</p>
            </div>
        </div>
    </div>
</div>