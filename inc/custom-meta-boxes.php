<?php
/**
 * Custom Meta Boxes for JKJAAC Theme
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ============================================================================
   SINGLE META BOX WITH TABS FOR HERO, TEAM, PULL QUOTE, CTA, MISSION, ABOUT, CHARTER, AND MAP
   ============================================================================ */

function jkjaac_add_tabbed_meta_box() {
    $screens = array( 'page' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'jkjaac_tabbed_meta',
            __( 'JKJAAC Page Settings', 'jkjaac' ),
            'jkjaac_tabbed_meta_box_callback',
            $screen,
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'jkjaac_add_tabbed_meta_box' );

function jkjaac_tabbed_meta_box_callback( $post ) {
    // Nonces for all sections
    wp_nonce_field( 'jkjaac_hero_meta_box', 'jkjaac_hero_meta_box_nonce' );
    wp_nonce_field( 'jkjaac_team_meta_box', 'jkjaac_team_meta_box_nonce' );
    wp_nonce_field( 'jkjaac_pull_quote_meta_box', 'jkjaac_pull_quote_meta_box_nonce' );
    wp_nonce_field( 'jkjaac_cta_meta_box', 'jkjaac_cta_meta_box_nonce' );
    wp_nonce_field( 'jkjaac_mission_meta_box', 'jkjaac_mission_meta_box_nonce' );
    wp_nonce_field( 'jkjaac_about_meta_box', 'jkjaac_about_meta_box_nonce' );
    wp_nonce_field( 'jkjaac_charter_header_meta_box', 'jkjaac_charter_header_meta_box_nonce' );
    wp_nonce_field( 'jkjaac_charter_progress_meta_box', 'jkjaac_charter_progress_meta_box_nonce' );
    wp_nonce_field( 'jkjaac_map_meta_box', 'jkjaac_map_meta_box_nonce' );
    wp_nonce_field( 'jkjaac_leadership_meta_box', 'jkjaac_leadership_meta_box_nonce' );
    
    // Hero Data
    $override = get_post_meta( $post->ID, '_jkjaac_hero_override', true );
    $eyebrow = get_post_meta( $post->ID, '_jkjaac_hero_eyebrow', true );
    $title_line1 = get_post_meta( $post->ID, '_jkjaac_hero_title_line1', true );
    $title_line2 = get_post_meta( $post->ID, '_jkjaac_hero_title_line2', true );
    $subtitle = get_post_meta( $post->ID, '_jkjaac_hero_subtitle', true );
    $btn_primary_text = get_post_meta( $post->ID, '_jkjaac_hero_btn_primary_text', true );
    $btn_primary_link = get_post_meta( $post->ID, '_jkjaac_hero_btn_primary_link', true );
    $btn_secondary_text = get_post_meta( $post->ID, '_jkjaac_hero_btn_secondary_text', true );
    $btn_secondary_link = get_post_meta( $post->ID, '_jkjaac_hero_btn_secondary_link', true );
    $vert_left = get_post_meta( $post->ID, '_jkjaac_hero_vert_left', true );
    $vert_right = get_post_meta( $post->ID, '_jkjaac_hero_vert_right', true );
    $scroll_cue = get_post_meta( $post->ID, '_jkjaac_hero_scroll_cue', true );
    
    $glyph_1 = get_post_meta( $post->ID, '_jkjaac_hero_glyph_1', true );
    $glyph_2 = get_post_meta( $post->ID, '_jkjaac_hero_glyph_2', true );
    $glyph_3 = get_post_meta( $post->ID, '_jkjaac_hero_glyph_3', true );
    $glyph_4 = get_post_meta( $post->ID, '_jkjaac_hero_glyph_4', true );
    
    $stat_1_num = get_post_meta( $post->ID, '_jkjaac_hero_stat_1_num', true );
    $stat_1_label = get_post_meta( $post->ID, '_jkjaac_hero_stat_1_label', true );
    $stat_2_num = get_post_meta( $post->ID, '_jkjaac_hero_stat_2_num', true );
    $stat_2_label = get_post_meta( $post->ID, '_jkjaac_hero_stat_2_label', true );
    $stat_3_num = get_post_meta( $post->ID, '_jkjaac_hero_stat_3_num', true );
    $stat_3_label = get_post_meta( $post->ID, '_jkjaac_hero_stat_3_label', true );
    $stat_4_num = get_post_meta( $post->ID, '_jkjaac_hero_stat_4_num', true );
    $stat_4_label = get_post_meta( $post->ID, '_jkjaac_hero_stat_4_label', true );
    
    $hide_strip = get_post_meta( $post->ID, '_jkjaac_hero_hide_strip', true );
    $hide_buttons = get_post_meta( $post->ID, '_jkjaac_hero_hide_buttons', true );
    $hide_glyphs = get_post_meta( $post->ID, '_jkjaac_hero_hide_glyphs', true );
    $hero_style = get_post_meta( $post->ID, '_jkjaac_hero_style', true );
    
    // Team Header Data
    $team_override = get_post_meta( $post->ID, '_jkjaac_team_override', true );
    $team_label = get_post_meta( $post->ID, '_jkjaac_team_label', true );
    $team_title_line1 = get_post_meta( $post->ID, '_jkjaac_team_title_line1', true );
    $team_title_line2 = get_post_meta( $post->ID, '_jkjaac_team_title_line2', true );
    $team_description = get_post_meta( $post->ID, '_jkjaac_team_description', true );
    $team_hide_section = get_post_meta( $post->ID, '_jkjaac_team_hide_section', true );
    $team_leader_count = get_post_meta( $post->ID, '_jkjaac_team_leader_count', true );
    
    // Pull Quote Data
    $pq_override = get_post_meta( $post->ID, '_jkjaac_pull_quote_override', true );
    $quote_text = get_post_meta( $post->ID, '_jkjaac_pull_quote_text', true );
    $cite = get_post_meta( $post->ID, '_jkjaac_pull_quote_cite', true );
    $show_buttons = get_post_meta( $post->ID, '_jkjaac_pull_quote_show_buttons', true );
    $pq_btn_primary_text = get_post_meta( $post->ID, '_jkjaac_pull_quote_btn_primary_text', true );
    $pq_btn_primary_link = get_post_meta( $post->ID, '_jkjaac_pull_quote_btn_primary_link', true );
    $pq_btn_secondary_text = get_post_meta( $post->ID, '_jkjaac_pull_quote_btn_secondary_text', true );
    $pq_btn_secondary_link = get_post_meta( $post->ID, '_jkjaac_pull_quote_btn_secondary_link', true );
    $hide_section = get_post_meta( $post->ID, '_jkjaac_pull_quote_hide_section', true );
    
    // CTA Data
    $cta_override = get_post_meta( $post->ID, '_jkjaac_cta_override', true );
    $heading = get_post_meta( $post->ID, '_jkjaac_cta_heading', true );
    $heading_accent = get_post_meta( $post->ID, '_jkjaac_cta_heading_accent', true );
    $description = get_post_meta( $post->ID, '_jkjaac_cta_description', true );
    $button1_text = get_post_meta( $post->ID, '_jkjaac_cta_button1_text', true );
    $button1_url = get_post_meta( $post->ID, '_jkjaac_cta_button1_url', true );
    $button1_type = get_post_meta( $post->ID, '_jkjaac_cta_button1_type', true );
    $button2_text = get_post_meta( $post->ID, '_jkjaac_cta_button2_text', true );
    $button2_url = get_post_meta( $post->ID, '_jkjaac_cta_button2_url', true );
    $button2_type = get_post_meta( $post->ID, '_jkjaac_cta_button2_type', true );
    $button3_text = get_post_meta( $post->ID, '_jkjaac_cta_button3_text', true );
    $button3_url = get_post_meta( $post->ID, '_jkjaac_cta_button3_url', true );
    $button3_type = get_post_meta( $post->ID, '_jkjaac_cta_button3_type', true );
    $cta_hide_section = get_post_meta( $post->ID, '_jkjaac_cta_hide_section', true );
    
    // Mission Data
    $mission_override = get_post_meta( $post->ID, '_jkjaac_mission_override', true );
    $mission_label = get_post_meta( $post->ID, '_jkjaac_mission_label', true );
    $mission_title = get_post_meta( $post->ID, '_jkjaac_mission_title', true );
    $mission_title_accent = get_post_meta( $post->ID, '_jkjaac_mission_title_accent', true );
    $mission_description = get_post_meta( $post->ID, '_jkjaac_mission_description', true );
    $mission_demands = get_post_meta( $post->ID, '_jkjaac_mission_demands', true );
    $mission_image_id = get_post_meta( $post->ID, '_jkjaac_mission_image_id', true );
    $mission_image_url = get_post_meta( $post->ID, '_jkjaac_mission_image_url', true );
    $mission_image_alt = get_post_meta( $post->ID, '_jkjaac_mission_image_alt', true );
    $mission_caption_title = get_post_meta( $post->ID, '_jkjaac_mission_caption_title', true );
    $mission_caption_text = get_post_meta( $post->ID, '_jkjaac_mission_caption_text', true );
    $mission_quote_text = get_post_meta( $post->ID, '_jkjaac_mission_quote_text', true );
    $mission_quote_cite = get_post_meta( $post->ID, '_jkjaac_mission_quote_cite', true );
    $mission_hide_section = get_post_meta( $post->ID, '_jkjaac_mission_hide_section', true );
    
    // About Data
    $about_override = get_post_meta( $post->ID, '_jkjaac_about_override', true );
    $about_label = get_post_meta( $post->ID, '_jkjaac_about_label', true );
    $about_title_line1 = get_post_meta( $post->ID, '_jkjaac_about_title_line1', true );
    $about_title_line2 = get_post_meta( $post->ID, '_jkjaac_about_title_line2', true );
    $about_description = get_post_meta( $post->ID, '_jkjaac_about_description', true );
    $about_paragraphs = get_post_meta( $post->ID, '_jkjaac_about_paragraphs', true );
    $about_quote_text = get_post_meta( $post->ID, '_jkjaac_about_quote_text', true );
    $about_quote_cite = get_post_meta( $post->ID, '_jkjaac_about_quote_cite', true );
    $about_image_id = get_post_meta( $post->ID, '_jkjaac_about_image_id', true );
    $about_image_url = get_post_meta( $post->ID, '_jkjaac_about_image_url', true );
    $about_image_alt = get_post_meta( $post->ID, '_jkjaac_about_image_alt', true );
    $about_caption_title = get_post_meta( $post->ID, '_jkjaac_about_caption_title', true );
    $about_caption_text = get_post_meta( $post->ID, '_jkjaac_about_caption_text', true );
    $about_quote2_text = get_post_meta( $post->ID, '_jkjaac_about_quote2_text', true );
    $about_quote2_cite = get_post_meta( $post->ID, '_jkjaac_about_quote2_cite', true );
    $about_hide_section = get_post_meta( $post->ID, '_jkjaac_about_hide_section', true );
    
    // Charter Header Data
    $charter_override = get_post_meta( $post->ID, '_jkjaac_charter_header_override', true );
    $charter_label = get_post_meta( $post->ID, '_jkjaac_charter_header_label', true );
    $charter_title_line1 = get_post_meta( $post->ID, '_jkjaac_charter_header_title_line1', true );
    $charter_title_line2 = get_post_meta( $post->ID, '_jkjaac_charter_header_title_line2', true );
    $charter_description = get_post_meta( $post->ID, '_jkjaac_charter_header_description', true );

    // Charter Progress Data
    $progress_override = get_post_meta($post->ID, '_jkjaac_charter_progress_override', true);
    $progress_label = get_post_meta($post->ID, '_jkjaac_charter_progress_label', true);
    $progress_title_line1 = get_post_meta($post->ID, '_jkjaac_charter_progress_title_line1', true);
    $progress_title_line2 = get_post_meta($post->ID, '_jkjaac_charter_progress_title_line2', true);
    $progress_section_label = get_post_meta($post->ID, '_jkjaac_charter_progress_section_label', true);
    $progress_bars = get_post_meta($post->ID, '_jkjaac_charter_progress_bars', true);
    $progress_counters = get_post_meta($post->ID, '_jkjaac_charter_progress_counters', true);
    $progress_quote_primary = get_post_meta($post->ID, '_jkjaac_charter_progress_quote_primary', true);
    $progress_quote_secondary = get_post_meta($post->ID, '_jkjaac_charter_progress_quote_secondary', true);
    $progress_hide_section = get_post_meta($post->ID, '_jkjaac_charter_progress_hide_section', true);
    
    // Map Data
    $map_override = get_post_meta( $post->ID, '_jkjaac_map_override', true );
    $map_locations = get_post_meta( $post->ID, '_jkjaac_map_locations', true );
    $map_center_lat = get_post_meta( $post->ID, '_jkjaac_map_center_lat', true );
    $map_center_lng = get_post_meta( $post->ID, '_jkjaac_map_center_lng', true );
    $map_zoom = get_post_meta( $post->ID, '_jkjaac_map_zoom', true );
    $map_tile_url = get_post_meta( $post->ID, '_jkjaac_map_tile_url', true );
    $map_hide_section = get_post_meta( $post->ID, '_jkjaac_map_hide_section', true );
    
    include get_template_directory() . '/inc/meta-box-views/tabbed-meta-box.php';
}

/* ============================================================================
   SAVE HERO META BOX
   ============================================================================ */

function jkjaac_save_hero_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_hero_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_hero_meta_box_nonce'], 'jkjaac_hero_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_fields = array(
        'eyebrow', 'title_line1', 'title_line2', 'subtitle',
        'btn_primary_text', 'btn_primary_link', 'btn_secondary_text', 'btn_secondary_link',
        'vert_left', 'vert_right', 'scroll_cue',
        'glyph_1', 'glyph_2', 'glyph_3', 'glyph_4',
        'stat_1_num', 'stat_1_label', 'stat_2_num', 'stat_2_label',
        'stat_3_num', 'stat_3_label', 'stat_4_num', 'stat_4_label',
    );
    
    foreach ( $text_fields as $field ) {
        $key = 'jkjaac_hero_' . $field;
        $meta_key = '_jkjaac_hero_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            $value = ( $field === 'subtitle' ) ? sanitize_textarea_field( $_POST[ $key ] ) : sanitize_text_field( $_POST[ $key ] );
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
    
    $checkbox_fields = array(
        'override' => 'jkjaac_hero_override',
        'hide_strip' => 'jkjaac_hero_hide_strip',
        'hide_buttons' => 'jkjaac_hero_hide_buttons',
        'hide_glyphs' => 'jkjaac_hero_hide_glyphs',
    );
    
    foreach ( $checkbox_fields as $field => $key ) {
        $meta_key = '_jkjaac_hero_' . $field;
        update_post_meta( $post_id, $meta_key, ( isset( $_POST[ $key ] ) && $_POST[ $key ] === '1' ) ? '1' : '' );
    }
    
    if ( isset( $_POST['jkjaac_hero_style'] ) ) {
        update_post_meta( $post_id, '_jkjaac_hero_style', sanitize_text_field( $_POST['jkjaac_hero_style'] ) );
    }
}
add_action( 'save_post', 'jkjaac_save_hero_meta_box' );

/* ============================================================================
   SAVE TEAM META BOX
   ============================================================================ */

function jkjaac_save_team_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_team_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_team_meta_box_nonce'], 'jkjaac_team_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_fields = array(
        'label', 'title_line1', 'title_line2', 'description', 'leader_count'
    );
    
    foreach ( $text_fields as $field ) {
        $key = 'jkjaac_team_' . $field;
        $meta_key = '_jkjaac_team_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            $value = ( $field === 'description' ) ? sanitize_textarea_field( $_POST[ $key ] ) : sanitize_text_field( $_POST[ $key ] );
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
    
    $checkbox_fields = array(
        'override' => 'jkjaac_team_override',
        'hide_section' => 'jkjaac_team_hide_section',
    );
    
    foreach ( $checkbox_fields as $field => $key ) {
        $meta_key = '_jkjaac_team_' . $field;
        update_post_meta( $post_id, $meta_key, ( isset( $_POST[ $key ] ) && $_POST[ $key ] === '1' ) ? '1' : '' );
    }
}
add_action( 'save_post', 'jkjaac_save_team_meta_box' );

/* ============================================================================
   SAVE PULL QUOTE META BOX
   ============================================================================ */

function jkjaac_save_pull_quote_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_pull_quote_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_pull_quote_meta_box_nonce'], 'jkjaac_pull_quote_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_fields = array(
        'quote_text', 'cite', 'btn_primary_text', 'btn_primary_link',
        'btn_secondary_text', 'btn_secondary_link',
    );
    
    foreach ( $text_fields as $field ) {
        $key = 'jkjaac_pull_quote_' . $field;
        $meta_key = '_jkjaac_pull_quote_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            $value = ( $field === 'quote_text' ) ? sanitize_textarea_field( $_POST[ $key ] ) : sanitize_text_field( $_POST[ $key ] );
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
    
    $checkbox_fields = array(
        'override' => 'jkjaac_pull_quote_override',
        'show_buttons' => 'jkjaac_pull_quote_show_buttons',
        'hide_section' => 'jkjaac_pull_quote_hide_section',
    );
    
    foreach ( $checkbox_fields as $field => $key ) {
        $meta_key = '_jkjaac_pull_quote_' . $field;
        update_post_meta( $post_id, $meta_key, ( isset( $_POST[ $key ] ) && $_POST[ $key ] === '1' ) ? '1' : '' );
    }
}
add_action( 'save_post', 'jkjaac_save_pull_quote_meta_box' );

/* ============================================================================
   SAVE CTA META BOX
   ============================================================================ */

function jkjaac_save_cta_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_cta_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_cta_meta_box_nonce'], 'jkjaac_cta_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_fields = array(
        'heading', 'heading_accent', 'description',
        'button1_text', 'button1_url', 'button1_type',
        'button2_text', 'button2_url', 'button2_type',
        'button3_text', 'button3_url', 'button3_type',
    );
    
    foreach ( $text_fields as $field ) {
        $key = 'jkjaac_cta_' . $field;
        $meta_key = '_jkjaac_cta_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            $value = ( $field === 'description' ) ? sanitize_textarea_field( $_POST[ $key ] ) : sanitize_text_field( $_POST[ $key ] );
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
    
    $checkbox_fields = array(
        'override' => 'jkjaac_cta_override',
        'hide_section' => 'jkjaac_cta_hide_section',
    );
    
    foreach ( $checkbox_fields as $field => $key ) {
        $meta_key = '_jkjaac_cta_' . $field;
        update_post_meta( $post_id, $meta_key, ( isset( $_POST[ $key ] ) && $_POST[ $key ] === '1' ) ? '1' : '' );
    }
}
add_action( 'save_post', 'jkjaac_save_cta_meta_box' );

/* ============================================================================
   SAVE MISSION META BOX
   ============================================================================ */

function jkjaac_save_mission_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_mission_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_mission_meta_box_nonce'], 'jkjaac_mission_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_fields = array(
        'label', 'title', 'title_accent', 'description',
        'image_url', 'image_alt', 'caption_title', 'caption_text',
        'quote_text', 'quote_cite'
    );
    
    foreach ( $text_fields as $field ) {
        $key = 'jkjaac_mission_' . $field;
        $meta_key = '_jkjaac_mission_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            $value = ( $field === 'description' || $field === 'quote_text' ) ? sanitize_textarea_field( $_POST[ $key ] ) : sanitize_text_field( $_POST[ $key ] );
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
    
    if ( isset( $_POST['jkjaac_mission_image_id'] ) ) {
        update_post_meta( $post_id, '_jkjaac_mission_image_id', intval( $_POST['jkjaac_mission_image_id'] ) );
    }
    
    if ( isset( $_POST['jkjaac_mission_demands'] ) && is_array( $_POST['jkjaac_mission_demands'] ) ) {
        $demands = array();
        foreach ( $_POST['jkjaac_mission_demands'] as $demand ) {
            $demands[] = array(
                'number' => sanitize_text_field( $demand['number'] ),
                'text'   => sanitize_text_field( $demand['text'] )
            );
        }
        update_post_meta( $post_id, '_jkjaac_mission_demands', $demands );
    }
    
    $checkbox_fields = array(
        'override' => 'jkjaac_mission_override',
        'hide_section' => 'jkjaac_mission_hide_section',
    );
    
    foreach ( $checkbox_fields as $field => $key ) {
        $meta_key = '_jkjaac_mission_' . $field;
        update_post_meta( $post_id, $meta_key, ( isset( $_POST[ $key ] ) && $_POST[ $key ] === '1' ) ? '1' : '' );
    }
}
add_action( 'save_post', 'jkjaac_save_mission_meta_box' );

/* ============================================================================
   SAVE ABOUT META BOX
   ============================================================================ */

function jkjaac_save_about_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_about_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_about_meta_box_nonce'], 'jkjaac_about_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Text fields
    $text_fields = array(
        'label', 'title_line1', 'title_line2', 'description',
        'image_url', 'image_alt', 'caption_title', 'caption_text',
        'quote_text', 'quote_cite', 'quote2_text', 'quote2_cite'
    );
    
    foreach ( $text_fields as $field ) {
        $key = 'jkjaac_about_' . $field;
        $meta_key = '_jkjaac_about_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            $value = ( $field === 'description' || $field === 'quote_text' || $field === 'quote2_text' ) ? sanitize_textarea_field( $_POST[ $key ] ) : sanitize_text_field( $_POST[ $key ] );
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
    
    // Paragraphs (array)
    if ( isset( $_POST['jkjaac_about_paragraphs'] ) && is_array( $_POST['jkjaac_about_paragraphs'] ) ) {
        $paragraphs = array();
        foreach ( $_POST['jkjaac_about_paragraphs'] as $paragraph ) {
            $paragraphs[] = sanitize_textarea_field( $paragraph );
        }
        update_post_meta( $post_id, '_jkjaac_about_paragraphs', $paragraphs );
    }
    
    // Image ID
    if ( isset( $_POST['jkjaac_about_image_id'] ) ) {
        update_post_meta( $post_id, '_jkjaac_about_image_id', intval( $_POST['jkjaac_about_image_id'] ) );
    }
    
    // Checkbox fields
    $checkbox_fields = array(
        'override' => 'jkjaac_about_override',
        'hide_section' => 'jkjaac_about_hide_section',
    );
    
    foreach ( $checkbox_fields as $field => $key ) {
        $meta_key = '_jkjaac_about_' . $field;
        update_post_meta( $post_id, $meta_key, ( isset( $_POST[ $key ] ) && $_POST[ $key ] === '1' ) ? '1' : '' );
    }
}
add_action( 'save_post', 'jkjaac_save_about_meta_box' );

/* ============================================================================
   SAVE CHARTER HEADER META BOX
   ============================================================================ */

function jkjaac_save_charter_header_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_charter_header_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_charter_header_meta_box_nonce'], 'jkjaac_charter_header_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $text_fields = array(
        'label', 'title_line1', 'title_line2', 'description'
    );
    
    foreach ( $text_fields as $field ) {
        $key = 'jkjaac_charter_header_' . $field;
        $meta_key = '_jkjaac_charter_header_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            $value = ( $field === 'description' ) ? sanitize_textarea_field( $_POST[ $key ] ) : sanitize_text_field( $_POST[ $key ] );
            update_post_meta( $post_id, $meta_key, $value );
        }
    }
    
    $checkbox_fields = array(
        'override' => 'jkjaac_charter_header_override',
    );
    
    foreach ( $checkbox_fields as $field => $key ) {
        $meta_key = '_jkjaac_charter_header_' . $field;
        update_post_meta( $post_id, $meta_key, ( isset( $_POST[ $key ] ) && $_POST[ $key ] === '1' ) ? '1' : '' );
    }
}
add_action( 'save_post', 'jkjaac_save_charter_header_meta_box' );

/* ============================================================================
   SAVE MAP META BOX
   ============================================================================ */

function jkjaac_save_map_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_map_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_map_meta_box_nonce'], 'jkjaac_map_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Text fields
    $text_fields = array( 'center_lat', 'center_lng', 'zoom', 'tile_url' );
    foreach ( $text_fields as $field ) {
        $key = 'jkjaac_map_' . $field;
        $meta_key = '_jkjaac_map_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
    
    // Locations array
    if ( isset( $_POST['jkjaac_map_locations'] ) && is_array( $_POST['jkjaac_map_locations'] ) ) {
        $locations = array();
        foreach ( $_POST['jkjaac_map_locations'] as $location ) {
            if ( ! empty( $location['address'] ) ) {
                $locations[] = array(
                    'address'     => sanitize_text_field( $location['address'] ),
                    'description' => sanitize_textarea_field( $location['description'] ),
                    'lat'         => sanitize_text_field( $location['lat'] ),
                    'lng'         => sanitize_text_field( $location['lng'] ),
                    'icon'        => sanitize_text_field( $location['icon'] )
                );
            }
        }
        update_post_meta( $post_id, '_jkjaac_map_locations', $locations );
    }
    
    // Checkbox fields
    $checkbox_fields = array(
        'override' => 'jkjaac_map_override',
        'hide_section' => 'jkjaac_map_hide_section',
    );
    
    foreach ( $checkbox_fields as $field => $key ) {
        $meta_key = '_jkjaac_map_' . $field;
        update_post_meta( $post_id, $meta_key, ( isset( $_POST[ $key ] ) && $_POST[ $key ] === '1' ) ? '1' : '' );
    }
}
add_action( 'save_post', 'jkjaac_save_map_meta_box' );

/* ============================================================================
   HELPER FUNCTIONS
   ============================================================================ */

function jkjaac_get_hero_data() {
    global $post;
    
    $defaults = array(
        'eyebrow'           => get_theme_mod( 'jkjaac_hero_eyebrow', 'جموں کشمیر جوائنٹ عوامی ایکشن کمیٹی' ),
        'title_line1'       => get_theme_mod( 'jkjaac_hero_title_line1', 'Voice of' ),
        'title_line2'       => get_theme_mod( 'jkjaac_hero_title_line2', 'the People.' ),
        'subtitle'          => get_theme_mod( 'jkjaac_hero_subtitle', '' ),
        'btn_primary_text'  => get_theme_mod( 'jkjaac_hero_btn_primary_text', 'Our 38-Point Charter' ),
        'btn_primary_link'  => get_theme_mod( 'jkjaac_hero_btn_primary_link', '38-point-charter' ),
        'btn_secondary_text'=> get_theme_mod( 'jkjaac_hero_btn_secondary_text', 'Our Movement' ),
        'btn_secondary_link'=> get_theme_mod( 'jkjaac_hero_btn_secondary_link', 'struggles' ),
        'vert_left'         => get_theme_mod( 'jkjaac_hero_vert_left', 'Jammu Kashmir JAAC · Est. 2022–2023 · Civil Society Movement' ),
        'vert_right'        => get_theme_mod( 'jkjaac_hero_vert_right', 'Economic Justice · Resource Rights · Accountability · Unity' ),
        'scroll_cue'        => get_theme_mod( 'jkjaac_hero_scroll_cue', 'Explore' ),
        'glyph_1'           => get_theme_mod( 'jkjaac_hero_glyph_1', 'آزادی' ),
        'glyph_2'           => get_theme_mod( 'jkjaac_hero_glyph_2', 'عدل' ),
        'glyph_3'           => get_theme_mod( 'jkjaac_hero_glyph_3', 'اتحاد' ),
        'glyph_4'           => get_theme_mod( 'jkjaac_hero_glyph_4', 'امن' ),
        'stat_1_num'        => get_theme_mod( 'jkjaac_hero_stat_1_num', '38' ),
        'stat_1_label'      => get_theme_mod( 'jkjaac_hero_stat_1_label', 'Point Charter' ),
        'stat_2_num'        => get_theme_mod( 'jkjaac_hero_stat_2_num', '10+' ),
        'stat_2_label'      => get_theme_mod( 'jkjaac_hero_stat_2_label', 'Districts Mobilized' ),
        'stat_3_num'        => get_theme_mod( 'jkjaac_hero_stat_3_num', '₨23B' ),
        'stat_3_label'      => get_theme_mod( 'jkjaac_hero_stat_3_label', 'Relief Won 2024' ),
        'stat_4_num'        => get_theme_mod( 'jkjaac_hero_stat_4_num', '31/37' ),
        'stat_4_label'      => get_theme_mod( 'jkjaac_hero_stat_4_label', 'Points Fulfilled' ),
        'show_strip'        => get_theme_mod( 'jkjaac_hero_show_strip', true ),
        'show_buttons'      => get_theme_mod( 'jkjaac_hero_show_buttons', true ),
        'show_glyphs'       => get_theme_mod( 'jkjaac_hero_show_glyphs', true ),
        'style'             => get_theme_mod( 'jkjaac_hero_style', 'full' ),
    );
    
    if ( is_singular( 'page' ) && isset( $post ) ) {
        $override = get_post_meta( $post->ID, '_jkjaac_hero_override', true );
        
        if ( $override ) {
            $text_fields = array(
                'eyebrow', 'title_line1', 'title_line2', 'subtitle',
                'btn_primary_text', 'btn_primary_link', 'btn_secondary_text', 'btn_secondary_link',
                'vert_left', 'vert_right', 'scroll_cue',
                'glyph_1', 'glyph_2', 'glyph_3', 'glyph_4',
                'stat_1_num', 'stat_1_label', 'stat_2_num', 'stat_2_label',
                'stat_3_num', 'stat_3_label', 'stat_4_num', 'stat_4_label',
            );
            
            foreach ( $text_fields as $field ) {
                $value = get_post_meta( $post->ID, '_jkjaac_hero_' . $field, true );
                if ( $value !== '' && $value !== null ) {
                    $defaults[ $field ] = $value;
                }
            }
            
            if ( get_post_meta( $post->ID, '_jkjaac_hero_hide_strip', true ) ) $defaults['show_strip'] = false;
            if ( get_post_meta( $post->ID, '_jkjaac_hero_hide_buttons', true ) ) $defaults['show_buttons'] = false;
            if ( get_post_meta( $post->ID, '_jkjaac_hero_hide_glyphs', true ) ) $defaults['show_glyphs'] = false;
            
            $page_style = get_post_meta( $post->ID, '_jkjaac_hero_style', true );
            if ( ! empty( $page_style ) ) $defaults['style'] = $page_style;
        }
    }
    
    if ( empty( $defaults['title_line1'] ) && empty( $defaults['title_line2'] ) && is_page() && isset( $post ) ) {
        $defaults['title_line1'] = get_the_title( $post );
        $defaults['title_line2'] = '';
        $defaults['style'] = 'simple';
    }
    
    return $defaults;
}

function jkjaac_get_team_data() {
    global $post;
    
    $defaults = array(
        'label'         => get_theme_mod( 'jkjaac_leadership_label', 'Core Committee' ),
        'title_line1'   => get_theme_mod( 'jkjaac_leadership_title_line1', 'Leadership' ),
        'title_line2'   => get_theme_mod( 'jkjaac_leadership_title_line2', 'Profiles' ),
        'description'   => get_theme_mod( 'jkjaac_leadership_description', 'JKJAAC is deliberately structured as a collective leadership — not a one-man movement. Core committee members represent diverse geographic, professional, and social constituencies across all districts of AJK. Each has risked personal freedom and safety for the movement.' ),
        'leader_count'  => '',
        'hide_section'  => false,
    );
    
    if ( is_singular( 'page' ) && isset( $post ) ) {
        $page_slug = $post->post_name;
        $page_title = $post->post_title;
        $page_template = get_page_template_slug( $post->ID );
        $page_id = $post->ID;
        
        $is_home_page = ( get_option( 'page_on_front' ) == $page_id );
        $is_about_page = ( $page_slug === 'about' || $page_slug === 'about-us' );
        $is_leadership_page = (
            $page_slug === 'leadership' || 
            $page_slug === 'leaders' || 
            $page_slug === 'our-leadership' ||
            $page_slug === 'core-committee' ||
            stripos( $page_title, 'leadership' ) !== false ||
            stripos( $page_title, 'leaders' ) !== false ||
            stripos( $page_title, 'committee' ) !== false ||
            $page_template === 'page-leadership.php' ||
            $page_template === 'template-leadership.php' ||
            get_post_meta( $page_id, '_wp_page_template', true ) === 'page-leadership.php'
        );
        
        // Check if section should be hidden via meta
        $hide_section_meta = get_post_meta( $post->ID, '_jkjaac_team_hide_section', true );
        
        if ( $hide_section_meta ) {
            $defaults['hide_section'] = true;
            return $defaults;
        }
        
        // IMPORTANT: Only show on Home, About, or Leadership pages
        if ( ! $is_home_page && ! $is_about_page && ! $is_leadership_page ) {
            $defaults['hide_section'] = true;
            return $defaults;
        }
        
        // Check for page overrides
        $override = get_post_meta( $post->ID, '_jkjaac_team_override', true );
        
        if ( $override ) {
            $text_fields = array( 'label', 'title_line1', 'title_line2', 'description', 'leader_count' );
            
            foreach ( $text_fields as $field ) {
                $value = get_post_meta( $post->ID, '_jkjaac_team_' . $field, true );
                if ( $value !== '' && $value !== null ) {
                    $defaults[ $field ] = $value;
                }
            }
        }
    }
    
    return $defaults;
}

function jkjaac_get_pull_quote_data() {
    global $post;
    
    $defaults = array(
        'quote_text'        => get_theme_mod( 'jkjaac_pull_quote_text', '"This agreement was signed in the blood of our martyrs and the tears of our people. We will not allow it to be buried in bureaucratic delays. The people of AJK are watching — and they have shown they will not accept broken promises."' ),
        'cite'              => get_theme_mod( 'jkjaac_pull_quote_cite', 'JKJAAC Core Committee Statement, November 2025' ),
        'show_buttons'      => get_theme_mod( 'jkjaac_pull_quote_show_buttons', true ),
        'btn_primary_text'  => get_theme_mod( 'jkjaac_pull_quote_btn_primary_text', 'Full Struggle History' ),
        'btn_primary_link'  => get_theme_mod( 'jkjaac_pull_quote_btn_primary_link', 'struggles' ),
        'btn_secondary_text'=> get_theme_mod( 'jkjaac_pull_quote_btn_secondary_text', 'Latest Updates' ),
        'btn_secondary_link'=> get_theme_mod( 'jkjaac_pull_quote_btn_secondary_link', 'blogs' ),
        'hide_section'      => false,
    );
    
    if ( is_singular( 'page' ) && isset( $post ) ) {
        if ( get_post_meta( $post->ID, '_jkjaac_pull_quote_hide_section', true ) ) {
            $defaults['hide_section'] = true;
            return $defaults;
        }
        
        if ( get_post_meta( $post->ID, '_jkjaac_pull_quote_override', true ) ) {
            $text_fields = array(
                'quote_text', 'cite', 'btn_primary_text', 'btn_primary_link',
                'btn_secondary_text', 'btn_secondary_link'
            );
            
            foreach ( $text_fields as $field ) {
                $value = get_post_meta( $post->ID, '_jkjaac_pull_quote_' . $field, true );
                if ( $value !== '' && $value !== null ) {
                    $defaults[ $field ] = $value;
                }
            }
            
            $show_buttons = get_post_meta( $post->ID, '_jkjaac_pull_quote_show_buttons', true );
            if ( $show_buttons !== '' ) {
                $defaults['show_buttons'] = (bool) $show_buttons;
            }
        }
    }
    
    return $defaults;
}

function jkjaac_get_cta_data() {
    global $post;
    
    $defaults = array(
        'heading'           => get_theme_mod( 'jkjaac_cta_heading', 'Join the' ),
        'heading_accent'    => get_theme_mod( 'jkjaac_cta_heading_accent', 'Movement' ),
        'description'       => get_theme_mod( 'jkjaac_cta_description', 'Whether you join as a member, donate to our cause, or simply spread the word — every act of solidarity matters. The people of Kashmir need the world to listen.' ),
        'button1_text'      => get_theme_mod( 'jkjaac_cta_button1_text', 'Our 38-Point Charter' ),
        'button1_url'       => get_theme_mod( 'jkjaac_cta_button1_url', '38-point-charter' ),
        'button1_type'      => get_theme_mod( 'jkjaac_cta_button1_type', 'btn-p' ),
        'button2_text'      => get_theme_mod( 'jkjaac_cta_button2_text', 'Our Struggles' ),
        'button2_url'       => get_theme_mod( 'jkjaac_cta_button2_url', 'struggles' ),
        'button2_type'      => get_theme_mod( 'jkjaac_cta_button2_type', 'btn-g' ),
        'button3_text'      => get_theme_mod( 'jkjaac_cta_button3_text', 'Contact Us' ),
        'button3_url'       => get_theme_mod( 'jkjaac_cta_button3_url', 'contact' ),
        'button3_type'      => get_theme_mod( 'jkjaac_cta_button3_type', 'btn-g' ),
        'hide_section'      => false,
    );
    
    if ( is_singular( 'page' ) && isset( $post ) ) {
        if ( get_post_meta( $post->ID, '_jkjaac_cta_hide_section', true ) ) {
            $defaults['hide_section'] = true;
            return $defaults;
        }
        
        if ( get_post_meta( $post->ID, '_jkjaac_cta_override', true ) ) {
            $text_fields = array(
                'heading', 'heading_accent', 'description',
                'button1_text', 'button1_url', 'button1_type',
                'button2_text', 'button2_url', 'button2_type',
                'button3_text', 'button3_url', 'button3_type',
            );
            
            foreach ( $text_fields as $field ) {
                $value = get_post_meta( $post->ID, '_jkjaac_cta_' . $field, true );
                if ( $value !== '' && $value !== null ) {
                    $defaults[ $field ] = $value;
                }
            }
        }
    }
    
    return $defaults;
}

function jkjaac_get_mission_data() {
    global $post;
    
    $default_demands = array(
        array( 'number' => '1', 'text' => 'AJK generates Pakistan\'s hydroelectric power yet pays the highest electricity bills. We demand tariffs based on actual local production costs from Mangla Dam — not inflated national rates that drain the people.' ),
        array( 'number' => '2', 'text' => 'We demand abolition of all perks and privileges for ministers, bureaucrats, and judges. The cabinet must be capped at 20 members. Resources belong to the people, not the entrenched elite.' ),
        array( 'number' => '3', 'text' => 'From restoring student unions to demanding full resource royalties, JKJAAC fights to ensure the people of Azad Kashmir enjoy their rightful constitutional, democratic, and human rights as citizens, not subjects.' ),
        array( 'number' => '4', 'text' => 'All human rights violations must end. Freedom of speech and movement must be restored immediately.' ),
        array( 'number' => '5', 'text' => 'The UN should facilitate free, fair elections for a representative Council — and a plebiscite for final status.' ),
    );
    
    $defaults = array(
        'label'              => get_theme_mod( 'jkjaac_mission_label', 'Our Mission' ),
        'title'              => get_theme_mod( 'jkjaac_mission_title', 'Fighting for' ),
        'title_accent'       => get_theme_mod( 'jkjaac_mission_title_accent', 'Economic Justice and Rights' ),
        'description'        => get_theme_mod( 'jkjaac_mission_description', 'We are dedicated to challenging the political status quo, demanding economic justice, and ensuring the end of systemic exploitation and administrative neglect for the people of Azad Jammu & Kashmir — through peaceful, constitutional, and persistent civil action.' ),
        'demands'            => $default_demands,
        'image_id'           => get_theme_mod( 'jkjaac_mission_image_id', '' ),
        'image_url'          => get_theme_mod( 'jkjaac_mission_image_url', '' ),
        'image_alt'          => get_theme_mod( 'jkjaac_mission_image_alt', 'JKJAAC Movement' ),
        'caption_title'      => get_theme_mod( 'jkjaac_mission_caption_title', 'The Movement Lives' ),
        'caption_text'       => get_theme_mod( 'jkjaac_mission_caption_text', 'A grassroots civil-society coalition uniting AJK\'s people' ),
        'quote_text'         => get_theme_mod( 'jkjaac_mission_quote_text', 'We are dedicated to challenging the political status quo, demanding economic justice, and ensuring the end of systemic exploitation and administrative neglect for the people of Azad Jammu & Kashmir — through peaceful, constitutional, and persistent civil action.' ),
        'quote_cite'         => get_theme_mod( 'jkjaac_mission_quote_cite', '— JKJAAC Core Committee' ),
        'hide_section'       => false,
    );
    
    if ( is_singular( 'page' ) && isset( $post ) ) {
        $page_slug = $post->post_name;
        $is_home_page = ( get_option( 'page_on_front' ) == $post->ID );
        $is_about_page = ( $page_slug === 'about' || $page_slug === 'about-us' );
        
        if ( $is_home_page || $is_about_page ) {
            if ( get_post_meta( $post->ID, '_jkjaac_mission_hide_section', true ) ) {
                $defaults['hide_section'] = true;
                return $defaults;
            }
            
            if ( get_post_meta( $post->ID, '_jkjaac_mission_override', true ) ) {
                $text_fields = array(
                    'label', 'title', 'title_accent', 'description',
                    'image_url', 'image_alt', 'caption_title', 'caption_text',
                    'quote_text', 'quote_cite'
                );
                
                foreach ( $text_fields as $field ) {
                    $value = get_post_meta( $post->ID, '_jkjaac_mission_' . $field, true );
                    if ( $value !== '' && $value !== null ) {
                        $defaults[ $field ] = $value;
                    }
                }
                
                $image_id = get_post_meta( $post->ID, '_jkjaac_mission_image_id', true );
                if ( $image_id ) {
                    $defaults['image_id'] = $image_id;
                }
                
                $demands = get_post_meta( $post->ID, '_jkjaac_mission_demands', true );
                if ( is_array( $demands ) && ! empty( $demands ) ) {
                    $defaults['demands'] = $demands;
                }
            }
        } else {
            $defaults['hide_section'] = true;
        }
    }
    
    return $defaults;
}

function jkjaac_get_about_data() {
    global $post;
    
    $default_paragraphs = array(
        'The Jammu Kashmir Joint Awami Action Committee (JKJAAC) is a grassroots civil-society coalition based in Azad Jammu and Kashmir (AJK). Emerging from local trader-led mobilisations between 2022 and 2023, it formalised as a cross-regional body in September 2023. The organisation brings together traders, transporters, lawyers, and civic groups to press for core economic and governance reforms, including lower wheat and flour prices, fair electricity tariffs, and reduced privileges for political and bureaucratic elites.',
        
        'The JKJAAC became the leading organiser of the large-scale unrest that gripped AJK in 2024 and resurfaced with renewed mass actions in 2025, ultimately winning a landmark government agreement. The movement\'s extraordinary reach was underscored in October 2025, when even AJK Police personnel adopted JKJAAC slogans during their own separate strike for better pay.',
        
        'The coalition is deliberately non-partisan, drawing legitimacy from its membership across all districts of AJK and the depth of public support it commands across ideological divides. Its remarkable success is attributed partly to the region\'s high literacy rate—far exceeding Pakistan\'s national average—and to social media, which allowed the JAAC\'s message to reach every corner of AJK without distortion from traditional media gatekeepers.'
    );
    
    $defaults = array(
        'label'              => get_theme_mod( 'jkjaac_about_label', 'Introduction' ),
        'title_line1'        => get_theme_mod( 'jkjaac_about_title_line1', 'Who We Are' ),
        'title_line2'        => get_theme_mod( 'jkjaac_about_title_line2', 'Our Declaration' ),
        'description'        => get_theme_mod( 'jkjaac_about_description', '' ),
        'paragraphs'         => $default_paragraphs,
        'quote_text'         => get_theme_mod( 'jkjaac_about_quote_text', '"The JKJAAC\'s rise to prominence stems from its ability to unite fragmented, localised grievances over economic hardship into a coordinated, statewide political force — fundamentally challenging the political status quo."' ),
        'quote_cite'         => get_theme_mod( 'jkjaac_about_quote_cite', '— Kashmiriat Analysis, 2025' ),
        'image_id'           => get_theme_mod( 'jkjaac_about_image_id', '' ),
        'image_url'          => get_theme_mod( 'jkjaac_about_image_url', '' ),
        'image_alt'          => get_theme_mod( 'jkjaac_about_image_alt', 'JKJAAC Movement Banner' ),
        'caption_title'      => get_theme_mod( 'jkjaac_about_caption_title', 'The Movement Lives' ),
        'caption_text'       => get_theme_mod( 'jkjaac_about_caption_text', 'A grassroots civil-society coalition uniting AJK\'s people' ),
        'quote2_text'        => get_theme_mod( 'jkjaac_about_quote2_text', '"AJK is fundamentally different because it is not a regular part of Pakistan; it is a disputed area whose future has yet to be decided. AJK is particularly rich in resources, far exceeding its requirements."' ),
        'quote2_cite'        => get_theme_mod( 'jkjaac_about_quote2_cite', '— Amjad Ali Advocate, JAAC Senior Leader' ),
        'hide_section'       => false,
    );
    
    if ( is_singular( 'page' ) && isset( $post ) ) {
        $page_slug = $post->post_name;
        $is_about_page = ( $page_slug === 'about' || $page_slug === 'about-us' );
        
        if ( $is_about_page ) {
            if ( get_post_meta( $post->ID, '_jkjaac_about_hide_section', true ) ) {
                $defaults['hide_section'] = true;
                return $defaults;
            }
            
            if ( get_post_meta( $post->ID, '_jkjaac_about_override', true ) ) {
                $text_fields = array(
                    'label', 'title_line1', 'title_line2', 'description',
                    'image_url', 'image_alt', 'caption_title', 'caption_text',
                    'quote_text', 'quote_cite', 'quote2_text', 'quote2_cite'
                );
                
                foreach ( $text_fields as $field ) {
                    $value = get_post_meta( $post->ID, '_jkjaac_about_' . $field, true );
                    if ( $value !== '' && $value !== null ) {
                        $defaults[ $field ] = $value;
                    }
                }
                
                $image_id = get_post_meta( $post->ID, '_jkjaac_about_image_id', true );
                if ( $image_id ) {
                    $defaults['image_id'] = $image_id;
                }
                
                $paragraphs = get_post_meta( $post->ID, '_jkjaac_about_paragraphs', true );
                if ( is_array( $paragraphs ) && ! empty( $paragraphs ) ) {
                    $defaults['paragraphs'] = $paragraphs;
                }
            }
        } else {
            $defaults['hide_section'] = true;
        }
    }
    
    return $defaults;
}

function jkjaac_get_charter_header_data() {
    global $post;
    
    $defaults = array(
        'label'       => get_theme_mod( 'jkjaac_charter_label', 'Full Charter' ),
        'title_line1' => get_theme_mod( 'jkjaac_charter_title_line1', 'All' ),
        'title_line2' => get_theme_mod( 'jkjaac_charter_title_line2', '38 Demands' ),
        'description' => get_theme_mod( 'jkjaac_charter_description', 'JKJAAC is deliberately structured as a collective leadership — not a one-man movement. Core committee members represent diverse geographic, professional, and social constituencies across all districts of AJK. Each has risked personal freedom and safety for the movement.' ),
    );
    
    if ( is_singular( 'page' ) && isset( $post ) ) {
        $override = get_post_meta( $post->ID, '_jkjaac_charter_header_override', true );
        
        if ( $override ) {
            $fields = array( 'label', 'title_line1', 'title_line2', 'description' );
            foreach ( $fields as $field ) {
                $value = get_post_meta( $post->ID, '_jkjaac_charter_header_' . $field, true );
                if ( $value !== '' && $value !== null ) {
                    $defaults[ $field ] = $value;
                }
            }
        }
    }
    
    return $defaults;
}

function jkjaac_get_charter_progress_data() {
    global $post;
    
    $defaults = array(
        'label' => 'Implementation Status — March 2026',
        'title_line1' => 'Charter',
        'title_line2' => 'Progress Tracker',
        'section_label' => 'Overall Implementation Progress',
        
        'bars' => array(
            array(
                'label' => 'Points Fully Implemented',
                'width' => '80.5',
                'value' => '31/37',
                'warning' => false
            ),
            array(
                'label' => 'FIRs Withdrawn',
                'width' => '91.4',
                'value' => '177/192',
                'warning' => false
            ),
            array(
                'label' => 'Compensation Paid',
                'width' => '72',
                'value' => '₨ 120M+ disbursed',
                'warning' => true
            ),
            array(
                'label' => 'Cabinet Size Reduction',
                'width' => '100',
                'value' => 'Implemented',
                'warning' => false
            ),
        ),
        
        'counters' => array(
            'success' => array('number' => '31', 'label' => 'Fulfilled'),
            'warning' => array('number' => '3', 'label' => 'Partial'),
            'danger' => array('number' => '3', 'label' => 'Pending'),
        ),
        
        'quote_primary' => array(
            'text' => 'The government has not fully implemented even a single point agreed upon within 90 days. Health cards have not been restored, nor have martyrs received compensation, while internet restrictions remain.',
            'cite' => '— Shaukat Nawaz Mir, January 2026 (JKJAAC position)'
        ),
        'quote_secondary' => array(
            'text' => 'Ninety-eight percent of the Action Committee\'s demands have been fulfilled.',
            'cite' => '— Shaukat Javed Mir, PM Spokesperson (Government position)',
            'success' => true
        ),
        
        'hide_section' => false,
    );
    
    if (is_singular('page') && isset($post)) {
        $override = get_post_meta($post->ID, '_jkjaac_charter_progress_override', true);
        
        if ($override) {
            $fields = array('label', 'title_line1', 'title_line2', 'section_label');
            foreach ($fields as $field) {
                $value = get_post_meta($post->ID, '_jkjaac_charter_progress_' . $field, true);
                if ($value !== '' && $value !== null) {
                    $defaults[$field] = $value;
                }
            }
            
            $bars = get_post_meta($post->ID, '_jkjaac_charter_progress_bars', true);
            if (is_array($bars) && !empty($bars)) {
                $defaults['bars'] = $bars;
            }
            
            $counters = get_post_meta($post->ID, '_jkjaac_charter_progress_counters', true);
            if (is_array($counters) && !empty($counters)) {
                $defaults['counters'] = $counters;
            }
            
            $quote_primary = get_post_meta($post->ID, '_jkjaac_charter_progress_quote_primary', true);
            if (is_array($quote_primary)) {
                $defaults['quote_primary'] = $quote_primary;
            }
            
            $quote_secondary = get_post_meta($post->ID, '_jkjaac_charter_progress_quote_secondary', true);
            if (is_array($quote_secondary)) {
                $defaults['quote_secondary'] = $quote_secondary;
            }
            
            $hide = get_post_meta($post->ID, '_jkjaac_charter_progress_hide_section', true);
            $defaults['hide_section'] = ($hide === '1');
        }
    }
    
    return $defaults;
}

/* ============================================================================
   MAP DATA FUNCTION
   ============================================================================ */

function jkjaac_get_map_data() {
    global $post;
    
    $defaults = array(
        'center_lat' => '33.5',
        'center_lng' => '73.7',
        'zoom' => '8',
        'tile_url' => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        'locations' => array(
            array(
                'address' => 'Muzaffarabad City Center, AJK',
                'description' => 'All three divisions represented: Muzaffarabad, Poonch & Mirpur.',
                'lat' => '34.37',
                'lng' => '73.47',
                'icon' => 'default'
            ),
            array(
                'address' => 'Rawalakot, AJK - Pearl Valley',
                'description' => 'Origin of the 2022 electricity bill protests.',
                'lat' => '33.8578',
                'lng' => '73.7594',
                'icon' => 'default'
            ),
            array(
                'address' => 'Mirpur, AJK - New City',
                'description' => 'Mangla Dam region — heart of the electricity sovereignty issue.',
                'lat' => '33.148',
                'lng' => '73.748',
                'icon' => 'default'
            )
        ),
        'hide_section' => false,
    );
    
    if ( is_singular( 'page' ) && isset( $post ) ) {
        if ( get_post_meta( $post->ID, '_jkjaac_map_hide_section', true ) ) {
            $defaults['hide_section'] = true;
            return $defaults;
        }
        
        if ( get_post_meta( $post->ID, '_jkjaac_map_override', true ) ) {
            $fields = array( 'center_lat', 'center_lng', 'zoom', 'tile_url' );
            foreach ( $fields as $field ) {
                $value = get_post_meta( $post->ID, '_jkjaac_map_' . $field, true );
                if ( $value !== '' && $value !== null ) {
                    $defaults[ $field ] = $value;
                }
            }
            
            $locations = get_post_meta( $post->ID, '_jkjaac_map_locations', true );
            if ( is_array( $locations ) && ! empty( $locations ) ) {
                $defaults['locations'] = $locations;
            }
        }
    }
    
    return $defaults;
}

/* ============================================================================
   SAVE CHARTER PROGRESS META BOX
   ============================================================================ */

function jkjaac_save_charter_progress_meta_box($post_id) {
    if (!isset($_POST['jkjaac_charter_progress_meta_box_nonce'])) return;
    if (!wp_verify_nonce($_POST['jkjaac_charter_progress_meta_box_nonce'], 'jkjaac_charter_progress_meta_box')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $text_fields = array('label', 'title_line1', 'title_line2', 'section_label');
    foreach ($text_fields as $field) {
        $key = 'jkjaac_charter_progress_' . $field;
        if (isset($_POST[$key])) {
            update_post_meta($post_id, '_jkjaac_charter_progress_' . $field, sanitize_text_field($_POST[$key]));
        }
    }
    
    if (isset($_POST['jkjaac_charter_progress_bars']) && is_array($_POST['jkjaac_charter_progress_bars'])) {
        $bars = array();
        foreach ($_POST['jkjaac_charter_progress_bars'] as $bar) {
            if (!empty($bar['label'])) {
                $bars[] = array(
                    'label' => sanitize_text_field($bar['label']),
                    'width' => floatval($bar['width']),
                    'value' => sanitize_text_field($bar['value']),
                    'warning' => isset($bar['warning']) && $bar['warning'] === '1'
                );
            }
        }
        update_post_meta($post_id, '_jkjaac_charter_progress_bars', $bars);
    }
    
    if (isset($_POST['jkjaac_charter_progress_counters']) && is_array($_POST['jkjaac_charter_progress_counters'])) {
        $counters = array(
            'success' => array(
                'number' => sanitize_text_field($_POST['jkjaac_charter_progress_counters']['success']['number']),
                'label' => sanitize_text_field($_POST['jkjaac_charter_progress_counters']['success']['label'])
            ),
            'warning' => array(
                'number' => sanitize_text_field($_POST['jkjaac_charter_progress_counters']['warning']['number']),
                'label' => sanitize_text_field($_POST['jkjaac_charter_progress_counters']['warning']['label'])
            ),
            'danger' => array(
                'number' => sanitize_text_field($_POST['jkjaac_charter_progress_counters']['danger']['number']),
                'label' => sanitize_text_field($_POST['jkjaac_charter_progress_counters']['danger']['label'])
            )
        );
        update_post_meta($post_id, '_jkjaac_charter_progress_counters', $counters);
    }
    
    if (isset($_POST['jkjaac_charter_progress_quote_primary'])) {
        $quote = array(
            'text' => sanitize_textarea_field($_POST['jkjaac_charter_progress_quote_primary']['text']),
            'cite' => sanitize_text_field($_POST['jkjaac_charter_progress_quote_primary']['cite'])
        );
        update_post_meta($post_id, '_jkjaac_charter_progress_quote_primary', $quote);
    }
    
    if (isset($_POST['jkjaac_charter_progress_quote_secondary'])) {
        $quote = array(
            'text' => sanitize_textarea_field($_POST['jkjaac_charter_progress_quote_secondary']['text']),
            'cite' => sanitize_text_field($_POST['jkjaac_charter_progress_quote_secondary']['cite']),
            'success' => isset($_POST['jkjaac_charter_progress_quote_secondary']['success']) && $_POST['jkjaac_charter_progress_quote_secondary']['success'] === '1'
        );
        update_post_meta($post_id, '_jkjaac_charter_progress_quote_secondary', $quote);
    }
    
    update_post_meta($post_id, '_jkjaac_charter_progress_override', 
        (isset($_POST['jkjaac_charter_progress_override']) && $_POST['jkjaac_charter_progress_override'] === '1') ? '1' : '');
    
    update_post_meta($post_id, '_jkjaac_charter_progress_hide_section', 
        (isset($_POST['jkjaac_charter_progress_hide_section']) && $_POST['jkjaac_charter_progress_hide_section'] === '1') ? '1' : '');
}
add_action('save_post', 'jkjaac_save_charter_progress_meta_box');

/**
 * Get Events Page Data
 */
function jkjaac_get_events_data() {
    global $post;
    
    $defaults = array(
        // Upcoming Events
        'upcoming_label'       => 'Upcoming Events',
        'upcoming_title_line1' => 'Key Mobilizations',
        'upcoming_title_line2' => 'Ahead',
        'upcoming_description' => 'Mark these important dates. The Jammu Kashmir Joint Action Committee calls upon all members, activists, and supporters to participate in these upcoming programs.',
        'upcoming_count'       => '3',
        
        // Past Events
        'past_label'           => 'Past Events',
        'past_title_line1'     => 'A History of',
        'past_title_line2'     => 'United Struggle',
        'past_description'     => 'The Jammu Kashmir Joint Action Committee has a long and consistent history of leading the political movement through mass mobilization and advocacy.',
        'past_count'           => '4',
        
        // Event Categories
        'categories' => array(
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
        ),
        
        'override' => false,
        'hide_section' => false,
    );
    
    if ( is_singular( 'page' ) && isset( $post ) ) {
        $page_template = get_page_template_slug( $post->ID );
        $is_events_page = ( $page_template === 'page-events.php' );
        
        if ( $is_events_page ) {
            $override = get_post_meta( $post->ID, '_jkjaac_events_override', true );
            
            if ( $override ) {
                // Upcoming fields
                $upcoming_fields = array( 'label', 'title_line1', 'title_line2', 'description', 'count' );
                foreach ( $upcoming_fields as $field ) {
                    $value = get_post_meta( $post->ID, '_jkjaac_upcoming_' . $field, true );
                    if ( $value !== '' && $value !== null ) {
                        $defaults[ 'upcoming_' . $field ] = $value;
                    }
                }
                
                // Past fields
                $past_fields = array( 'label', 'title_line1', 'title_line2', 'description', 'count' );
                foreach ( $past_fields as $field ) {
                    $value = get_post_meta( $post->ID, '_jkjaac_past_' . $field, true );
                    if ( $value !== '' && $value !== null ) {
                        $defaults[ 'past_' . $field ] = $value;
                    }
                }
                
                // Categories
                $categories = get_post_meta( $post->ID, '_jkjaac_event_categories', true );
                if ( is_array( $categories ) && ! empty( $categories ) ) {
                    $defaults['categories'] = $categories;
                }
            }
        }
    }
    
    return $defaults;
}

/* ============================================================================
   SAVE LEADERSHIP META BOX
   ============================================================================ */

function jkjaac_save_leadership_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_leadership_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_leadership_meta_box_nonce'], 'jkjaac_leadership_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Override checkbox
    update_post_meta( $post_id, '_jkjaac_leadership_override', 
        ( isset( $_POST['jkjaac_leadership_override'] ) && $_POST['jkjaac_leadership_override'] === '1' ) ? '1' : '' );
    
    // Hide checkboxes
    update_post_meta( $post_id, '_jkjaac_leadership_hide_sacrifice', 
        ( isset( $_POST['jkjaac_leadership_hide_sacrifice'] ) && $_POST['jkjaac_leadership_hide_sacrifice'] === '1' ) ? '1' : '' );
    
    update_post_meta( $post_id, '_jkjaac_leadership_hide_structure', 
        ( isset( $_POST['jkjaac_leadership_hide_structure'] ) && $_POST['jkjaac_leadership_hide_structure'] === '1' ) ? '1' : '' );

    // Sacrifice section text fields
    $sacrifice_fields = array( 'label', 'title_line1', 'title_line2', 'description' );
    foreach ( $sacrifice_fields as $field ) {
        $key = 'jkjaac_sacrifice_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }

    // Persecution cards
    if ( isset( $_POST['jkjaac_persecution_cards'] ) && is_array( $_POST['jkjaac_persecution_cards'] ) ) {
        $cards = array();
        foreach ( $_POST['jkjaac_persecution_cards'] as $index => $card ) {
            $cards[ $index ] = array(
                'icon'        => sanitize_text_field( $card['icon'] ),
                'title'       => sanitize_text_field( $card['title'] ),
                'description' => sanitize_textarea_field( $card['description'] )
            );
        }
        update_post_meta( $post_id, '_jkjaac_persecution_cards', $cards );
    }

    // Structure section text fields
    $structure_fields = array( 'label', 'title_line1', 'title_line2', 'description' );
    foreach ( $structure_fields as $field ) {
        $key = 'jkjaac_structure_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }

    // Structure cards
    if ( isset( $_POST['jkjaac_structure_cards'] ) && is_array( $_POST['jkjaac_structure_cards'] ) ) {
        $cards = array();
        foreach ( $_POST['jkjaac_structure_cards'] as $index => $card ) {
            $cards[ $index ] = array(
                'icon'        => sanitize_text_field( $card['icon'] ),
                'title'       => sanitize_text_field( $card['title'] ),
                'description' => sanitize_textarea_field( $card['description'] )
            );
        }
        update_post_meta( $post_id, '_jkjaac_structure_cards', $cards );
    }

    // Stats cards
    if ( isset( $_POST['jkjaac_stats_cards'] ) && is_array( $_POST['jkjaac_stats_cards'] ) ) {
        $cards = array();
        foreach ( $_POST['jkjaac_stats_cards'] as $index => $stat ) {
            $cards[ $index ] = array(
                'number' => sanitize_text_field( $stat['number'] ),
                'label'  => sanitize_text_field( $stat['label'] )
            );
        }
        update_post_meta( $post_id, '_jkjaac_stats_cards', $cards );
    }
}
add_action( 'save_post', 'jkjaac_save_leadership_meta_box' );

/* ============================================================================
   SAVE NEGOTIATIONS META BOX
   ============================================================================ */

function jkjaac_save_negotiations_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_negotiations_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_negotiations_meta_box_nonce'], 'jkjaac_negotiations_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Override checkbox
    update_post_meta( $post_id, '_jkjaac_negotiations_override', 
        ( isset( $_POST['jkjaac_negotiations_override'] ) && $_POST['jkjaac_negotiations_override'] === '1' ) ? '1' : '' );
    
    // Preamble fields
    $preamble_fields = array( 'label', 'title_line1', 'title_line2', 'description' );
    foreach ( $preamble_fields as $field ) {
        $key = 'jkjaac_preamble_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }
    
    // Preamble paragraphs
    if ( isset( $_POST['jkjaac_preamble_paragraphs'] ) && is_array( $_POST['jkjaac_preamble_paragraphs'] ) ) {
        $paragraphs = array_map( 'sanitize_textarea_field', $_POST['jkjaac_preamble_paragraphs'] );
        update_post_meta( $post_id, '_jkjaac_preamble_paragraphs', $paragraphs );
    }
    
    // Accord fields
    $accord_fields = array( 'label', 'title_line1', 'title_line2', 'description', 'count' );
    foreach ( $accord_fields as $field ) {
        $key = 'jkjaac_accord_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }
    
    // Tracker fields
    $tracker_fields = array( 'label', 'title_line1', 'title_line2', 'quote', 'cite' );
    foreach ( $tracker_fields as $field ) {
        $key = 'jkjaac_tracker_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }
    
    // Hide checkboxes
    update_post_meta( $post_id, '_jkjaac_hide_accord_section', 
        ( isset( $_POST['jkjaac_hide_accord_section'] ) && $_POST['jkjaac_hide_accord_section'] === '1' ) ? '1' : '' );
    update_post_meta( $post_id, '_jkjaac_hide_tracker_section', 
        ( isset( $_POST['jkjaac_hide_tracker_section'] ) && $_POST['jkjaac_hide_tracker_section'] === '1' ) ? '1' : '' );
    
    // Progress bars
    if ( isset( $_POST['jkjaac_progress_bars'] ) && is_array( $_POST['jkjaac_progress_bars'] ) ) {
        $bars = array();
        foreach ( $_POST['jkjaac_progress_bars'] as $bar ) {
            if ( ! empty( $bar['label'] ) ) {
                $bars[] = array(
                    'label'   => sanitize_text_field( $bar['label'] ),
                    'width'   => floatval( $bar['width'] ),
                    'value'   => sanitize_text_field( $bar['value'] ),
                    'warning' => isset( $bar['warning'] ) && $bar['warning'] === '1'
                );
            }
        }
        update_post_meta( $post_id, '_jkjaac_progress_bars', $bars );
    }
    // Add these after the preamble fields save section in jkjaac_save_negotiations_meta_box()

// History fields
$history_fields = array( 'label', 'title_line1', 'title_line2', 'description', 'count' );
foreach ( $history_fields as $field ) {
    $key = 'jkjaac_history_' . $field;
    if ( isset( $_POST[ $key ] ) ) {
        update_post_meta( $post_id, '_' . $key, sanitize_textarea_field( $_POST[ $key ] ) );
    }
}

// Hide history checkbox
update_post_meta( $post_id, '_jkjaac_hide_history_section', 
    ( isset( $_POST['jkjaac_hide_history_section'] ) && $_POST['jkjaac_hide_history_section'] === '1' ) ? '1' : '' );
}
add_action( 'save_post', 'jkjaac_save_negotiations_meta_box' );

/* ============================================================================
   SAVE STRUGGLES META BOX
   ============================================================================ */

function jkjaac_save_struggles_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_struggles_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_struggles_meta_box_nonce'], 'jkjaac_struggles_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Override checkbox
    update_post_meta( $post_id, '_jkjaac_struggles_override', 
        ( isset( $_POST['jkjaac_struggles_override'] ) && $_POST['jkjaac_struggles_override'] === '1' ) ? '1' : '' );
    
    // Intro fields
    $intro_fields = array( 'label', 'title_line1', 'title_line2', 'body' );
    foreach ( $intro_fields as $field ) {
        $key = 'jkjaac_intro_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }
    
    // Origins fields
    $origins_fields = array( 'label', 'count' );
    foreach ( $origins_fields as $field ) {
        $key = 'jkjaac_origins_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
    update_post_meta( $post_id, '_jkjaac_hide_origins', 
        ( isset( $_POST['jkjaac_hide_origins'] ) && $_POST['jkjaac_hide_origins'] === '1' ) ? '1' : '' );
    
    // 2024 Stats fields
    $stats_2024_fields = array( 'label', 'title_line1', 'title_line2', 'description', 'count' );
    foreach ( $stats_2024_fields as $field ) {
        $key = 'jkjaac_stats_2024_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }
    update_post_meta( $post_id, '_jkjaac_hide_stats_2024', 
        ( isset( $_POST['jkjaac_hide_stats_2024'] ) && $_POST['jkjaac_hide_stats_2024'] === '1' ) ? '1' : '' );
    
    // Uprising fields
    if ( isset( $_POST['jkjaac_uprising_count'] ) ) {
        update_post_meta( $post_id, '_jkjaac_uprising_count', sanitize_text_field( $_POST['jkjaac_uprising_count'] ) );
    }
    update_post_meta( $post_id, '_jkjaac_hide_uprising', 
        ( isset( $_POST['jkjaac_hide_uprising'] ) && $_POST['jkjaac_hide_uprising'] === '1' ) ? '1' : '' );
    
    // 2025 Impact fields
    $impact_2025_fields = array( 'label', 'title_line1', 'title_line2', 'description', 'count' );
    foreach ( $impact_2025_fields as $field ) {
        $key = 'jkjaac_impact_2025_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }
    update_post_meta( $post_id, '_jkjaac_hide_impact_2025', 
        ( isset( $_POST['jkjaac_hide_impact_2025'] ) && $_POST['jkjaac_hide_impact_2025'] === '1' ) ? '1' : '' );
    
    // Lockdown fields
    if ( isset( $_POST['jkjaac_lockdown_count'] ) ) {
        update_post_meta( $post_id, '_jkjaac_lockdown_count', sanitize_text_field( $_POST['jkjaac_lockdown_count'] ) );
    }
    update_post_meta( $post_id, '_jkjaac_hide_lockdown', 
        ( isset( $_POST['jkjaac_hide_lockdown'] ) && $_POST['jkjaac_hide_lockdown'] === '1' ) ? '1' : '' );
    
    // Anatomy fields
    $anatomy_fields = array( 'label', 'title_line1', 'title_line2', 'description', 'count' );
    foreach ( $anatomy_fields as $field ) {
        $key = 'jkjaac_anatomy_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_textarea_field( $_POST[ $key ] ) );
        }
    }
    update_post_meta( $post_id, '_jkjaac_hide_anatomy', 
        ( isset( $_POST['jkjaac_hide_anatomy'] ) && $_POST['jkjaac_hide_anatomy'] === '1' ) ? '1' : '' );
}
add_action( 'save_post', 'jkjaac_save_struggles_meta_box' );



/* ============================================================================
   SAVE GALLERY META BOX
   ============================================================================ */

function jkjaac_save_gallery_meta_box( $post_id ) {
    if ( ! isset( $_POST['jkjaac_gallery_meta_box_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['jkjaac_gallery_meta_box_nonce'], 'jkjaac_gallery_meta_box' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Override checkbox
    update_post_meta( $post_id, '_jkjaac_gallery_override', 
        ( isset( $_POST['jkjaac_gallery_override'] ) && $_POST['jkjaac_gallery_override'] === '1' ) ? '1' : '' );
    
    // Gallery settings
    $fields = array( 'default_cols', 'count', 'orderby', 'order' );
    foreach ( $fields as $field ) {
        $key = 'jkjaac_gallery_' . $field;
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, '_' . $key, sanitize_text_field( $_POST[ $key ] ) );
        }
    }
    
    // Checkbox settings
    $checkbox_fields = array( 'show_filter_bar', 'show_column_controls', 'show_photo_count' );
    foreach ( $checkbox_fields as $field ) {
        $key = 'jkjaac_' . $field;
        update_post_meta( $post_id, '_' . $key, 
            ( isset( $_POST[ $key ] ) && $_POST[ $key ] === '1' ) ? '1' : '' );
    }
    
    // Categories
    if ( isset( $_POST['jkjaac_gallery_categories'] ) && is_array( $_POST['jkjaac_gallery_categories'] ) ) {
        $categories = array_map( 'sanitize_text_field', $_POST['jkjaac_gallery_categories'] );
        update_post_meta( $post_id, '_jkjaac_gallery_categories', $categories );
    } else {
        update_post_meta( $post_id, '_jkjaac_gallery_categories', array() );
    }
}
add_action( 'save_post', 'jkjaac_save_gallery_meta_box' );