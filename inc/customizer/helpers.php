<?php
/**
 * Customizer Helper Functions
 *
 * @package JKJAAC
 * @subpackage Customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ============================================================================
   COLOR HELPER FUNCTIONS
   ============================================================================ */

/**
 * Convert hex color to RGB array
 *
 * @param string $hex Hex color code.
 * @return array RGB values.
 */
function jkjaac_hex_to_rgb( $hex ) {
    $hex = str_replace( '#', '', $hex );

    if ( strlen( $hex ) == 3 ) {
        $r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
        $g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
        $b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
    } else {
        $r = hexdec( substr( $hex, 0, 2 ) );
        $g = hexdec( substr( $hex, 2, 2 ) );
        $b = hexdec( substr( $hex, 4, 2 ) );
    }

    return array( $r, $g, $b );
}

/**
 * Adjust color brightness
 *
 * @param string $hex   Hex color code.
 * @param int    $steps Steps to adjust (-255 to 255).
 * @return string Adjusted hex color.
 */
function jkjaac_adjust_brightness( $hex, $steps ) {
    $steps = max( -255, min( 255, $steps ) );

    $rgb = jkjaac_hex_to_rgb( $hex );
    $r   = max( 0, min( 255, $rgb[0] + $steps ) );
    $g   = max( 0, min( 255, $rgb[1] + $steps ) );
    $b   = max( 0, min( 255, $rgb[2] + $steps ) );

    return '#' . str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT ) .
                 str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT ) .
                 str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );
}

/**
 * Get contrast color (black or white) based on background
 *
 * @param string $hex Hex color code.
 * @return string Contrast color (#000000 or #ffffff).
 */
function jkjaac_get_contrast_color( $hex ) {
    $rgb = jkjaac_hex_to_rgb( $hex );
    $luminance = ( 0.299 * $rgb[0] + 0.587 * $rgb[1] + 0.114 * $rgb[2] ) / 255;
    return $luminance > 0.5 ? '#000000' : '#ffffff';
}

/* ============================================================================
   MENU HELPER FUNCTIONS
   ============================================================================ */

/**
 * Get array of menus for select dropdown
 *
 * @return array Menu choices (ID => Name).
 */
function jkjaac_get_menu_choices() {
    $menus = wp_get_nav_menus();
    $choices = array( '' => __( '— Manual Links —', 'jkjaac' ) );
    
    foreach ( $menus as $menu ) {
        $choices[ $menu->term_id ] = $menu->name;
    }
    
    return $choices;
}

/**
 * Check if there are any menus created
 *
 * @return bool True if menus exist.
 */
function jkjaac_has_menus() {
    $menus = wp_get_nav_menus();
    return ! empty( $menus );
}

/* ============================================================================
   SOCIAL LINKS HELPER FUNCTIONS
   ============================================================================ */

/**
 * Get social platforms configuration
 *
 * @param string $context 'footer' or 'contact'.
 * @return array Social platforms config.
 */
function jkjaac_get_social_platforms( $context = 'footer' ) {
    $platforms = array(
        'footer' => array(
            'facebook'  => array( 'label' => 'Facebook', 'icon' => 'ri-facebook-line' ),
            'twitter'   => array( 'label' => 'Twitter/X', 'icon' => 'ri-twitter-x-line' ),
            'youtube'   => array( 'label' => 'YouTube', 'icon' => 'ri-youtube-line' ),
            'instagram' => array( 'label' => 'Instagram', 'icon' => 'ri-instagram-line' ),
            'tiktok'    => array( 'label' => 'TikTok', 'icon' => 'ri-tiktok-line' ),
            'linkedin'  => array( 'label' => 'LinkedIn', 'icon' => 'ri-linkedin-line' ),
            'whatsapp'  => array( 'label' => 'WhatsApp Channel', 'icon' => 'ri-whatsapp-line' ),
            'telegram'  => array( 'label' => 'Telegram', 'icon' => 'ri-telegram-line' ),
        ),
        'contact' => array(
            'facebook'  => array( 'label' => 'Facebook', 'icon' => 'ri-facebook-fill' ),
            'twitter'   => array( 'label' => 'Twitter/X', 'icon' => 'ri-twitter-x-line' ),
            'youtube'   => array( 'label' => 'YouTube', 'icon' => 'ri-youtube-line' ),
            'instagram' => array( 'label' => 'Instagram', 'icon' => 'ri-instagram-line' ),
            'tiktok'    => array( 'label' => 'TikTok', 'icon' => 'ri-tiktok-line' ),
            'linkedin'  => array( 'label' => 'LinkedIn', 'icon' => 'ri-linkedin-fill' ),
        ),
    );
    
    return isset( $platforms[ $context ] ) ? $platforms[ $context ] : $platforms['footer'];
}

/* ============================================================================
   PAGE URL HELPER
   ============================================================================ */

/**
 * Get page URL by slug
 *
 * @param string $slug Page slug.
 * @return string Page URL.
 */
function jkjaac_page_url( $slug ) {
    $page = get_page_by_path( $slug );
    if ( $page ) {
        return get_permalink( $page->ID );
    }
    return home_url( '/' . $slug . '/' );
}

/* ============================================================================
   CUSTOMIZER DEFAULTS HELPER
   ============================================================================ */

/**
 * Check if theme mods need to be initialized
 *
 * @param string $option_name Option name to check.
 * @return bool True if defaults need to be set.
 */
function jkjaac_needs_defaults( $option_name ) {
    return get_option( $option_name ) ? false : true;
}

/**
 * Mark defaults as set
 *
 * @param string $option_name Option name.
 */
function jkjaac_mark_defaults_set( $option_name ) {
    update_option( $option_name, true );
}

