<?php
/**
 * Hero Tab Content - Using Unified Classes
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
            <input type="checkbox" name="jkjaac_hero_override" id="jkjaac_hero_override" value="1" <?php checked( $override, '1' ); ?> />
            <label for="jkjaac_hero_override">
                Override default hero content for this page
                <small>Enable custom hero fields — uses gold & crimson accents from JKJAAC theme.</small>
            </label>
        </div>
        
        <!-- Hero Style & Content -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Hero Style & Content</h3>
                <span>LAYOUT, EYEBROW, TITLE LINES</span>
            </div>
            
            <div class="jkjaac-field">
                <label>Hero Style</label>
                <select name="jkjaac_hero_style">
                    <option value="">Default (from Customizer)</option>
                    <option value="full" <?php selected( $hero_style, 'full' ); ?>>Full (with orb, glyphs, vertical text)</option>
                    <option value="simple" <?php selected( $hero_style, 'simple' ); ?>>Simple (minimal)</option>
                </select>
            </div>
            
            <div class="jkjaac-field">
                <label>Eyebrow Text (Urdu/English)</label>
                <input type="text" name="jkjaac_hero_eyebrow" value="<?php echo esc_attr( $eyebrow ); ?>" placeholder="جموں کشمیر جوائنٹ عوامی ایکشن کمیٹی" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label>Title Line 1</label>
                    <input type="text" name="jkjaac_hero_title_line1" value="<?php echo esc_attr( $title_line1 ); ?>" placeholder="Voice of" />
                </div>
                
                <div class="jkjaac-field">
                    <label>Title Line 2 (Accent)</label>
                    <input type="text" name="jkjaac_hero_title_line2" value="<?php echo esc_attr( $title_line2 ); ?>" placeholder="the People" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label>Subtitle / Description</label>
                <textarea name="jkjaac_hero_subtitle" placeholder="Enter description..."><?php echo esc_textarea( $subtitle ); ?></textarea>
            </div>
        </div>
        
        <!-- Urdu Glyphs -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Urdu Glyphs</h3>
                <span>DECORATIVE FLOATING TEXT</span>
            </div>
            <p class="jkjaac-hint">Background calligraphy — leave blank for defaults.</p>
            
            <div class="jkjaac-glyphs-grid">
                <div class="jkjaac-field">
                    <label>Glyph 1</label>
                    <input type="text" name="jkjaac_hero_glyph_1" value="<?php echo esc_attr( $glyph_1 ); ?>" placeholder="آزادی" />
                </div>
                <div class="jkjaac-field">
                    <label>Glyph 2</label>
                    <input type="text" name="jkjaac_hero_glyph_2" value="<?php echo esc_attr( $glyph_2 ); ?>" placeholder="عدل" />
                </div>
                <div class="jkjaac-field">
                    <label>Glyph 3</label>
                    <input type="text" name="jkjaac_hero_glyph_3" value="<?php echo esc_attr( $glyph_3 ); ?>" placeholder="اتحاد" />
                </div>
                <div class="jkjaac-field">
                    <label>Glyph 4</label>
                    <input type="text" name="jkjaac_hero_glyph_4" value="<?php echo esc_attr( $glyph_4 ); ?>" placeholder="امن" />
                </div>
            </div>
        </div>
        
        <!-- Statistics Strip -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Statistics Strip</h3>
                <span>HERO STATS</span>
            </div>
            
            <table class="jkjaac-stats-table">
                <tr>
                    <th>Value</th>
                    <th>LABEL</th>
                </tr>
                <tr>
                    <td><input type="text" name="jkjaac_hero_stat_1_num" value="<?php echo esc_attr( $stat_1_num ); ?>" placeholder="38" /></td>
                    <td><input type="text" name="jkjaac_hero_stat_1_label" value="<?php echo esc_attr( $stat_1_label ); ?>" placeholder="Point Charter" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="jkjaac_hero_stat_2_num" value="<?php echo esc_attr( $stat_2_num ); ?>" placeholder="10+" /></td>
                    <td><input type="text" name="jkjaac_hero_stat_2_label" value="<?php echo esc_attr( $stat_2_label ); ?>" placeholder="Districts Mobilized" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="jkjaac_hero_stat_3_num" value="<?php echo esc_attr( $stat_3_num ); ?>" placeholder="₨23B" /></td>
                    <td><input type="text" name="jkjaac_hero_stat_3_label" value="<?php echo esc_attr( $stat_3_label ); ?>" placeholder="Relief Won 2024" /></td>
                </tr>
                <tr>
                    <td><input type="text" name="jkjaac_hero_stat_4_num" value="<?php echo esc_attr( $stat_4_num ); ?>" placeholder="31/37" /></td>
                    <td><input type="text" name="jkjaac_hero_stat_4_label" value="<?php echo esc_attr( $stat_4_label ); ?>" placeholder="Points Fulfilled" /></td>
                </tr>
            </table>
        </div>
        
        <!-- Navigation & Buttons -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Navigation & Buttons</h3>
                <span>VERTICAL CUES, CTAs</span>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label>Left Vertical Text</label>
                    <input type="text" name="jkjaac_hero_vert_left" value="<?php echo esc_attr( $vert_left ); ?>" placeholder="Jammu Kashmir JAAC" />
                </div>
                <div class="jkjaac-field">
                    <label>Right Vertical Text</label>
                    <input type="text" name="jkjaac_hero_vert_right" value="<?php echo esc_attr( $vert_right ); ?>" placeholder="Economic Justice" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label>Scroll Cue Text</label>
                <input type="text" name="jkjaac_hero_scroll_cue" value="<?php echo esc_attr( $scroll_cue ); ?>" placeholder="Explore" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label>Primary Button Text</label>
                    <input type="text" name="jkjaac_hero_btn_primary_text" value="<?php echo esc_attr( $btn_primary_text ); ?>" placeholder="Our 38-Point Charter" />
                </div>
                <div class="jkjaac-field">
                    <label>Secondary Button Text</label>
                    <input type="text" name="jkjaac_hero_btn_secondary_text" value="<?php echo esc_attr( $btn_secondary_text ); ?>" placeholder="Our Movement" />
                </div>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label>Primary Button Link</label>
                    <input type="text" name="jkjaac_hero_btn_primary_link" value="<?php echo esc_attr( $btn_primary_link ); ?>" placeholder="/charter" />
                </div>
                <div class="jkjaac-field">
                    <label>Secondary Button Link</label>
                    <input type="text" name="jkjaac_hero_btn_secondary_link" value="<?php echo esc_attr( $btn_secondary_link ); ?>" placeholder="/struggles" />
                </div>
            </div>
        </div>
        
        <!-- Hide Options -->
        <div class="jkjaac-checkbox-group pulse-glow-style">
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hero_hide_glyphs" id="jkjaac_hero_hide_glyphs" value="1" <?php checked( $hide_glyphs, '1' ); ?> />
                <label for="jkjaac_hero_hide_glyphs">Hide Urdu Glyphs</label>
            </div>
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hero_hide_strip" id="jkjaac_hero_hide_strip" value="1" <?php checked( $hide_strip, '1' ); ?> />
                <label for="jkjaac_hero_hide_strip">Hide Statistics Strip</label>
            </div>
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_hero_hide_buttons" id="jkjaac_hero_hide_buttons" value="1" <?php checked( $hide_buttons, '1' ); ?> />
                <label for="jkjaac_hero_hide_buttons">Hide Hero Buttons</label>
            </div>
        </div>
    </div>
</div>