<?php
/**
 * Charter Header Customizer Settings
 *
 * @package JKJAAC
 * @subpackage Customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JKJAAC_Charter_Customizer
 */
class JKJAAC_Charter_Customizer extends JKJAAC_Customizer_Base {

    /**
     * Panel ID - Charter doesn't have a panel, just a section
     *
     * @var string
     */
    protected $panel_id = '';

    /**
     * Section ID
     *
     * @var string
     */
    protected $section_id = 'jkjaac_charter_section';

    /**
     * Constructor - Override since no panel
     *
     * @param WP_Customize_Manager $wp_customize Customizer instance.
     */
    public function __construct( $wp_customize ) {
        $this->wp_customize = $wp_customize;
        $this->register_section();
        $this->register_settings();
    }

    /**
     * Register section
     */
    protected function register_section() {
        $this->wp_customize->add_section( $this->section_id, array(
            'title'       => __( 'Charter Header', 'jkjaac' ),
            'description' => __( 'Customize the 38-point charter header section', 'jkjaac' ),
            'priority'    => 135,
        ) );
    }

    /**
     * Register settings
     */
    protected function register_settings() {
        $section = $this->section_id;

        $this->add_text_setting( 'jkjaac_charter_label', __( 'Section Label', 'jkjaac' ), $section, 'Full Charter' );
        $this->add_text_setting( 'jkjaac_charter_title_line1', __( 'Title - Line 1', 'jkjaac' ), $section, 'All' );
        $this->add_text_setting( 'jkjaac_charter_title_line2', __( 'Title - Line 2 (Emphasized)', 'jkjaac' ), $section, '38 Demands' );
        $this->add_textarea_setting( 'jkjaac_charter_description', __( 'Description Text', 'jkjaac' ), $section, 'JKJAAC is deliberately structured as a collective leadership — not a one-man movement. Core committee members represent diverse geographic, professional, and social constituencies across all districts of AJK. Each has risked personal freedom and safety for the movement.' );
    }
}

/**
 * Initialize Charter Customizer
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function jkjaac_charter_customizer_init( $wp_customize ) {
    new JKJAAC_Charter_Customizer( $wp_customize );
}