<?php
/**
 * Base Customizer Class
 *
 * @package JKJAAC
 * @subpackage Customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JKJAAC_Customizer_Base
 * Provides common methods for all customizer sections
 */
class JKJAAC_Customizer_Base {

    /**
     * Panel ID
     *
     * @var string
     */
    protected $panel_id;

    /**
     * Panel title
     *
     * @var string
     */
    protected $panel_title;

    /**
     * Panel description
     *
     * @var string
     */
    protected $panel_description;

    /**
     * Panel priority
     *
     * @var int
     */
    protected $panel_priority = 160;

    /**
     * WP_Customize_Manager instance
     *
     * @var WP_Customize_Manager
     */
    protected $wp_customize;

    /**
     * Constructor
     *
     * @param WP_Customize_Manager $wp_customize Customizer instance.
     */
    public function __construct( $wp_customize ) {
        $this->wp_customize = $wp_customize;
        $this->register_panel();
        $this->register_sections();
        $this->register_settings();
    }

    /**
     * Register panel
     */
    protected function register_panel() {
        if ( $this->panel_id && $this->panel_title ) {
            $this->wp_customize->add_panel( $this->panel_id, array(
                'title'       => $this->panel_title,
                'description' => $this->panel_description,
                'priority'    => $this->panel_priority,
            ) );
        }
    }

    /**
     * Register sections - to be overridden by child classes
     */
    protected function register_sections() {
        // Override in child class
    }

    /**
     * Register settings - to be overridden by child classes
     */
    protected function register_settings() {
        // Override in child class
    }

    /**
     * Add a section
     *
     * @param string $id      Section ID.
     * @param string $title   Section title.
     * @param string $desc    Section description.
     * @param int    $priority Section priority.
     */
    protected function add_section( $id, $title, $desc = '', $priority = 10 ) {
        $this->wp_customize->add_section( $id, array(
            'title'       => $title,
            'description' => $desc,
            'panel'       => $this->panel_id,
            'priority'    => $priority,
        ) );
    }

    /**
     * Add a text setting with control
     *
     * @param string $id      Setting ID.
     * @param string $label   Control label.
     * @param string $section Section ID.
     * @param string $default Default value.
     * @param string $desc    Description.
     */
    protected function add_text_setting( $id, $label, $section, $default = '', $desc = '' ) {
        $this->wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $this->wp_customize->add_control( $id, array(
            'label'       => $label,
            'description' => $desc,
            'section'     => $section,
            'type'        => 'text',
        ) );
    }

    /**
     * Add a textarea setting with control
     *
     * @param string $id      Setting ID.
     * @param string $label   Control label.
     * @param string $section Section ID.
     * @param string $default Default value.
     * @param string $desc    Description.
     */
    protected function add_textarea_setting( $id, $label, $section, $default = '', $desc = '' ) {
        $this->wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'refresh',
        ) );

        $this->wp_customize->add_control( $id, array(
            'label'       => $label,
            'description' => $desc,
            'section'     => $section,
            'type'        => 'textarea',
        ) );
    }

    /**
     * Add a checkbox setting with control
     *
     * @param string $id      Setting ID.
     * @param string $label   Control label.
     * @param string $section Section ID.
     * @param bool   $default Default value.
     * @param string $desc    Description.
     */
    protected function add_checkbox_setting( $id, $label, $section, $default = false, $desc = '' ) {
        $this->wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'wp_validate_boolean',
            'transport'         => 'refresh',
        ) );

        $this->wp_customize->add_control( $id, array(
            'label'       => $label,
            'description' => $desc,
            'section'     => $section,
            'type'        => 'checkbox',
        ) );
    }

    /**
     * Add a number setting with control
     *
     * @param string $id      Setting ID.
     * @param string $label   Control label.
     * @param string $section Section ID.
     * @param int    $default Default value.
     * @param array  $attrs   Input attributes (min, max, step).
     * @param string $desc    Description.
     */
    protected function add_number_setting( $id, $label, $section, $default = 0, $attrs = array(), $desc = '' ) {
        $this->wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ) );

        $this->wp_customize->add_control( $id, array(
            'label'       => $label,
            'description' => $desc,
            'section'     => $section,
            'type'        => 'number',
            'input_attrs' => $attrs,
        ) );
    }

    /**
     * Add a color setting with control
     *
     * @param string $id      Setting ID.
     * @param string $label   Control label.
     * @param string $section Section ID.
     * @param string $default Default value.
     * @param string $desc    Description.
     */
    protected function add_color_setting( $id, $label, $section, $default = '#ffffff', $desc = '' ) {
        $this->wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) );

        $this->wp_customize->add_control( new WP_Customize_Color_Control( 
            $this->wp_customize, 
            $id, 
            array(
                'label'       => $label,
                'description' => $desc,
                'section'     => $section,
            ) 
        ) );
    }

    /**
     * Add an image upload setting with control
     *
     * @param string $id      Setting ID.
     * @param string $label   Control label.
     * @param string $section Section ID.
     * @param string $default Default value.
     * @param string $desc    Description.
     */
    protected function add_image_setting( $id, $label, $section, $default = '', $desc = '' ) {
        $this->wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );

        $this->wp_customize->add_control( new WP_Customize_Image_Control( 
            $this->wp_customize, 
            $id, 
            array(
                'label'       => $label,
                'description' => $desc,
                'section'     => $section,
            ) 
        ) );
    }

    /**
     * Add a URL setting with control
     *
     * @param string $id      Setting ID.
     * @param string $label   Control label.
     * @param string $section Section ID.
     * @param string $default Default value.
     * @param string $desc    Description.
     */
    protected function add_url_setting( $id, $label, $section, $default = '', $desc = '' ) {
        $this->wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ) );

        $this->wp_customize->add_control( $id, array(
            'label'       => $label,
            'description' => $desc,
            'section'     => $section,
            'type'        => 'url',
        ) );
    }

    /**
     * Add an email setting with control
     *
     * @param string $id      Setting ID.
     * @param string $label   Control label.
     * @param string $section Section ID.
     * @param string $default Default value.
     * @param string $desc    Description.
     */
    protected function add_email_setting( $id, $label, $section, $default = '', $desc = '' ) {
        $this->wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'refresh',
        ) );

        $this->wp_customize->add_control( $id, array(
            'label'       => $label,
            'description' => $desc,
            'section'     => $section,
            'type'        => 'email',
        ) );
    }

    /**
     * Add a select setting with control
     *
     * @param string $id      Setting ID.
     * @param string $label   Control label.
     * @param string $section Section ID.
     * @param array  $choices Choices array.
     * @param string $default Default value.
     * @param string $desc    Description.
     */
    protected function add_select_setting( $id, $label, $section, $choices = array(), $default = '', $desc = '' ) {
        $this->wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );

        $this->wp_customize->add_control( $id, array(
            'label'       => $label,
            'description' => $desc,
            'section'     => $section,
            'type'        => 'select',
            'choices'     => $choices,
        ) );
    }

    /**
     * Add a hidden note control
     *
     * @param string $id      Control ID.
     * @param string $label   Control label.
     * @param string $section Section ID.
     * @param string $desc    Description.
     */
    protected function add_note( $id, $label, $section, $desc = '' ) {
        $this->wp_customize->add_setting( $id, array(
            'default'           => '',
            'sanitize_callback' => '__return_false',
        ) );

        $this->wp_customize->add_control( new WP_Customize_Control( 
            $this->wp_customize, 
            $id, 
            array(
                'label'       => $label,
                'description' => $desc,
                'section'     => $section,
                'type'        => 'hidden',
            ) 
        ) );
    }
}