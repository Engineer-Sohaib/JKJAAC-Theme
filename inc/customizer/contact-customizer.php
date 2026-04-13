<?php
/**
 * Contact Page Customizer Settings
 *
 * @package JKJAAC
 * @subpackage Customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JKJAAC_Contact_Customizer
 */
class JKJAAC_Contact_Customizer extends JKJAAC_Customizer_Base {

    /**
     * Panel ID
     *
     * @var string
     */
    protected $panel_id = 'jkjaac_contact_panel';

    /**
     * Panel title
     *
     * @var string
     */
    protected $panel_title = 'Contact Page Settings';

    /**
     * Panel description
     *
     * @var string
     */
    protected $panel_description = 'Customize the contact page content';

    /**
     * Panel priority
     *
     * @var int
     */
    protected $panel_priority = 140;

    /**
     * Register sections
     */
    protected function register_sections() {
        $this->add_section( 'jkjaac_contact_info_section', __( 'Contact Information', 'jkjaac' ), __( 'Edit contact details and locations', 'jkjaac' ), 10 );
        $this->add_section( 'jkjaac_social_links_section', __( 'Social Media Links', 'jkjaac' ), __( 'Add your social media profile URLs. Leave empty to hide.', 'jkjaac' ), 20 );
        $this->add_section( 'jkjaac_locations_section', __( 'Office Locations', 'jkjaac' ), __( 'Manage location entries displayed on the contact page', 'jkjaac' ), 30 );
        $this->add_section( 'jkjaac_form_section', __( 'Contact Form Settings', 'jkjaac' ), __( 'Customize the contact form', 'jkjaac' ), 40 );
    }

    /**
     * Register settings
     */
    protected function register_settings() {
        $this->register_contact_info_settings();
        $this->register_social_settings();
        $this->register_locations_settings();
        $this->register_form_settings();
    }

    /**
     * Register contact info settings
     */
    private function register_contact_info_settings() {
        $section = 'jkjaac_contact_info_section';

        $this->add_text_setting( 'jkjaac_contact_label', __( 'Section Label', 'jkjaac' ), $section, 'Reach Out' );
        $this->add_text_setting( 'jkjaac_contact_title_line1', __( 'Title - Line 1', 'jkjaac' ), $section, 'Questions or' );
        $this->add_text_setting( 'jkjaac_contact_title_line2', __( 'Title - Line 2 (Emphasized)', 'jkjaac' ), $section, 'Suggestions?' );
        $this->add_textarea_setting( 'jkjaac_contact_description', __( 'Description Text', 'jkjaac' ), $section, 'Whether you have a question about our mission, want to volunteer, or are looking to support the Kashmir cause — we are here to listen. Every message matters to us.' );
        
        $this->add_text_setting( 'jkjaac_whatsapp_number', __( 'WhatsApp Number (with country code)', 'jkjaac' ), $section, '+923558153397', __( 'Format: +923001234567', 'jkjaac' ) );
        $this->add_text_setting( 'jkjaac_whatsapp_display', __( 'WhatsApp Display Number', 'jkjaac' ), $section, '+92 355 8153397' );
        $this->add_text_setting( 'jkjaac_phone_number', __( 'Phone Number (for tel: link)', 'jkjaac' ), $section, '+923558153397' );
        $this->add_text_setting( 'jkjaac_phone_display', __( 'Phone Display Number', 'jkjaac' ), $section, '+92 355 8153397' );
        
        $this->add_email_setting( 'jkjaac_contact_email', __( 'Email Address', 'jkjaac' ), $section, 'info@jkjaac.com' );
        $this->add_text_setting( 'jkjaac_work_hours', __( 'Work Hours', 'jkjaac' ), $section, 'Everyday — 08:00 AM to 07:00 PM' );
        $this->add_text_setting( 'jkjaac_follow_us_label', __( 'Follow Us Label', 'jkjaac' ), $section, 'Follow Us' );
    }

    /**
     * Register social settings
     */
    private function register_social_settings() {
        $section = 'jkjaac_social_links_section';
        $platforms = jkjaac_get_social_platforms( 'contact' );

        foreach ( $platforms as $key => $data ) {
            $this->add_url_setting(
                "jkjaac_social_{$key}",
                sprintf( __( '%s URL', 'jkjaac' ), $data['label'] ),
                $section,
                '',
                __( 'Full URL including https://', 'jkjaac' )
            );
        }
    }

    /**
     * Register locations settings
     */
    private function register_locations_settings() {
        $section = 'jkjaac_locations_section';

        $this->add_number_setting(
            'jkjaac_locations_count',
            __( 'Number of Locations', 'jkjaac' ),
            $section,
            4,
            array( 'min' => 0, 'max' => 10, 'step' => 1 ),
            __( 'Save and refresh the page to see new fields', 'jkjaac' )
        );

        $locations_count = get_theme_mod( 'jkjaac_locations_count', 4 );

        for ( $i = 1; $i <= $locations_count; $i++ ) {
            $this->add_text_setting(
                "jkjaac_location_{$i}_title",
                sprintf( __( 'Location %d - Title (Bold)', 'jkjaac' ), $i ),
                $section
            );
            
            $this->add_text_setting(
                "jkjaac_location_{$i}_subtitle",
                sprintf( __( 'Location %d - Subtitle', 'jkjaac' ), $i ),
                $section
            );
            
            $this->add_textarea_setting(
                "jkjaac_location_{$i}_desc",
                sprintf( __( 'Location %d - Description', 'jkjaac' ), $i ),
                $section
            );
        }
    }

    /**
     * Register form settings
     */
    private function register_form_settings() {
        $section = 'jkjaac_form_section';

        $this->add_text_setting( 'jkjaac_form_label', __( 'Form Section Label', 'jkjaac' ), $section, 'Send a Message' );
        $this->add_text_setting( 'jkjaac_form_title_line1', __( 'Form Title - Line 1', 'jkjaac' ), $section, 'Fill the Form' );
        $this->add_text_setting( 'jkjaac_form_title_line2', __( 'Form Title - Line 2 (Emphasized)', 'jkjaac' ), $section, 'Below' );
        $this->add_textarea_setting( 'jkjaac_submit_note', __( 'Submit Button Note', 'jkjaac' ), $section, 'We respond within <strong>24 hours</strong> on working days.' );
        $this->add_text_setting( 'jkjaac_success_title', __( 'Success Message Title', 'jkjaac' ), $section, 'Message Sent!' );
        $this->add_textarea_setting( 'jkjaac_success_subtitle', __( 'Success Message Text', 'jkjaac' ), $section, "Thank you for reaching out. We'll get back to you within 24 hours." );
        
        $this->add_email_setting(
            'jkjaac_form_recipient_email',
            __( 'Form Submission Recipient Email', 'jkjaac' ),
            $section,
            get_option( 'admin_email' ),
            __( 'Where contact form messages will be sent', 'jkjaac' )
        );
        
        $this->add_textarea_setting(
            'jkjaac_subject_pills',
            __( 'Subject Options', 'jkjaac' ),
            $section,
            "Press\nMedia Archive\nLegal Support\nSolidarity\nDiaspora UK\nGeneral",
            __( 'Enter one subject per line', 'jkjaac' )
        );
    }
}

/**
 * Initialize Contact Customizer
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function jkjaac_contact_customizer_init( $wp_customize ) {
    new JKJAAC_Contact_Customizer( $wp_customize );
}