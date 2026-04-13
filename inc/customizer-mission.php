<?php
/**
 * Mission Section Customizer Settings
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function jkjaac_mission_customizer_settings( $wp_customize ) {
    
    $wp_customize->add_section( 'jkjaac_mission_section', array(
        'title'       => __( 'Mission Section', 'jkjaac' ),
        'description' => __( 'Customize the mission section content (displays on Home and About pages)', 'jkjaac' ),
        'priority'    => 125,
    ) );
    
    // Label
    $wp_customize->add_setting( 'jkjaac_mission_label', array(
        'default'           => 'Our Mission',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jkjaac_mission_label', array(
        'label'    => __( 'Section Label', 'jkjaac' ),
        'section'  => 'jkjaac_mission_section',
        'type'     => 'text',
    ) );
    
    // Title
    $wp_customize->add_setting( 'jkjaac_mission_title', array(
        'default'           => 'Fighting for',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jkjaac_mission_title', array(
        'label'    => __( 'Title - Part 1', 'jkjaac' ),
        'section'  => 'jkjaac_mission_section',
        'type'     => 'text',
    ) );
    
    // Title Accent
    $wp_customize->add_setting( 'jkjaac_mission_title_accent', array(
        'default'           => 'Economic Justice and Rights',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jkjaac_mission_title_accent', array(
        'label'    => __( 'Title - Part 2 (Emphasized)', 'jkjaac' ),
        'section'  => 'jkjaac_mission_section',
        'type'     => 'text',
    ) );
    
    // Description
    $wp_customize->add_setting( 'jkjaac_mission_description', array(
        'default'           => 'We are dedicated to challenging the political status quo, demanding economic justice, and ensuring the end of systemic exploitation and administrative neglect for the people of Azad Jammu & Kashmir — through peaceful, constitutional, and persistent civil action.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jkjaac_mission_description', array(
        'label'    => __( 'Description Text', 'jkjaac' ),
        'section'  => 'jkjaac_mission_section',
        'type'     => 'textarea',
    ) );
    
    // Image URL
    $wp_customize->add_setting( 'jkjaac_mission_image_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jkjaac_mission_image_url', array(
        'label'    => __( 'Image URL', 'jkjaac' ),
        'section'  => 'jkjaac_mission_section',
        'type'     => 'url',
    ) );
    
    // Quote Text
    $wp_customize->add_setting( 'jkjaac_mission_quote_text', array(
        'default'           => 'We are dedicated to challenging the political status quo, demanding economic justice, and ensuring the end of systemic exploitation and administrative neglect for the people of Azad Jammu & Kashmir — through peaceful, constitutional, and persistent civil action.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jkjaac_mission_quote_text', array(
        'label'    => __( 'Quote Text', 'jkjaac' ),
        'section'  => 'jkjaac_mission_section',
        'type'     => 'textarea',
    ) );
    
    // Quote Citation
    $wp_customize->add_setting( 'jkjaac_mission_quote_cite', array(
        'default'           => '— JKJAAC Core Committee',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    $wp_customize->add_control( 'jkjaac_mission_quote_cite', array(
        'label'    => __( 'Quote Citation', 'jkjaac' ),
        'section'  => 'jkjaac_mission_section',
        'type'     => 'text',
    ) );
}
add_action( 'customize_register', 'jkjaac_mission_customizer_settings' );