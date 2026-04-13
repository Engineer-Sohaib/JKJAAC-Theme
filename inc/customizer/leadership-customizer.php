<?php
/**
 * Leadership Page Customizer Settings
 *
 * @package JKJAAC
 * @subpackage Customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JKJAAC_Leadership_Customizer
 */
class JKJAAC_Leadership_Customizer extends JKJAAC_Customizer_Base {

    /**
     * Panel ID
     *
     * @var string
     */
    protected $panel_id = 'jkjaac_leadership_panel';

    /**
     * Panel title
     *
     * @var string
     */
    protected $panel_title = 'Leadership Page Settings';

    /**
     * Panel description
     *
     * @var string
     */
    protected $panel_description = 'Customize the leadership page content';

    /**
     * Panel priority
     *
     * @var int
     */
    protected $panel_priority = 145;

    /**
     * Register sections
     */
    protected function register_sections() {
        $this->add_section( 
            'jkjaac_leadership_sacrifice_section', 
            __( 'Sacrifice Section', 'jkjaac' ), 
            __( 'Leaders Who Sacrificed content', 'jkjaac' ), 
            10 
        );
        
        $this->add_section( 
            'jkjaac_leadership_structure_section', 
            __( 'Organizational Structure', 'jkjaac' ), 
            __( 'Collective leadership content', 'jkjaac' ), 
            20 
        );
        
        $this->add_section( 
            'jkjaac_leadership_stats_section', 
            __( 'Statistics Cards', 'jkjaac' ), 
            __( '4 stat cards at bottom', 'jkjaac' ), 
            30 
        );
        
        $this->add_section( 
            'jkjaac_leadership_persecution_section', 
            __( 'Persecution Stories', 'jkjaac' ), 
            __( '4 persecution event cards', 'jkjaac' ), 
            15 
        );
    }

    /**
     * Register settings
     */
    protected function register_settings() {
        $this->register_sacrifice_settings();
        $this->register_persecution_settings();
        $this->register_structure_settings();
        $this->register_stats_settings();
    }

    /**
     * Register sacrifice header settings
     */
    private function register_sacrifice_settings() {
        $section = 'jkjaac_leadership_sacrifice_section';

        $this->add_text_setting( 
            'jkjaac_sacrifice_label', 
            __( 'Section Label', 'jkjaac' ), 
            $section, 
            'Government Recognition' 
        );
        
        $this->add_text_setting( 
            'jkjaac_sacrifice_title_line1', 
            __( 'Title - Line 1', 'jkjaac' ), 
            $section, 
            'Leaders Who' 
        );
        
        $this->add_text_setting( 
            'jkjaac_sacrifice_title_line2', 
            __( 'Title - Line 2 (Emphasized)', 'jkjaac' ), 
            $section, 
            'Sacrificed' 
        );
        
        $this->add_textarea_setting( 
            'jkjaac_sacrifice_description', 
            __( 'Description Text', 'jkjaac' ), 
            $section, 
            'JKJAAC leadership has faced repeated arrests, legal persecution, and personal threats. In May 2024, around 70 activists were arrested overnight including Shaukat Nawaz Mir. This only inflamed public anger and proved counterproductive for the government.' 
        );
    }

    /**
     * Register persecution stories settings (4 cards)
     */
    private function register_persecution_settings() {
        $section = 'jkjaac_leadership_persecution_section';

        for ( $i = 1; $i <= 4; $i++ ) {
            $this->add_text_setting(
                "jkjaac_persecution_{$i}_icon",
                sprintf( __( 'Card %d - Icon (Remixicon)', 'jkjaac' ), $i ),
                $section,
                $this->get_default_icon( $i )
            );
            
            $this->add_text_setting(
                "jkjaac_persecution_{$i}_title",
                sprintf( __( 'Card %d - Title', 'jkjaac' ), $i ),
                $section,
                $this->get_default_title( $i )
            );
            
            $this->add_textarea_setting(
                "jkjaac_persecution_{$i}_description",
                sprintf( __( 'Card %d - Description', 'jkjaac' ), $i ),
                $section,
                $this->get_default_description( $i )
            );
        }
    }

    /**
     * Register structure settings
     */
    private function register_structure_settings() {
        $section = 'jkjaac_leadership_structure_section';

        $this->add_text_setting( 
            'jkjaac_structure_label', 
            __( 'Section Label', 'jkjaac' ), 
            $section, 
            'Organizational Structure' 
        );
        
        $this->add_text_setting( 
            'jkjaac_structure_title_line1', 
            __( 'Title - Line 1', 'jkjaac' ), 
            $section, 
            'A Movement Built on' 
        );
        
        $this->add_text_setting( 
            'jkjaac_structure_title_line2', 
            __( 'Title - Line 2 (Emphasized)', 'jkjaac' ), 
            $section, 
            'Collective Leadership' 
        );
        
        $this->add_textarea_setting( 
            'jkjaac_structure_description', 
            __( 'Description Text', 'jkjaac' ), 
            $section, 
            'We are not a traditional organization with a single leader at the top. Instead, we are a dynamic network built on the principles of collective leadership. Our structure is decentralized and participatory, distributing power and decision-making across the group. By valuing every voice and fostering shared responsibility, we ensure that our direction is shaped by the collective wisdom of our members, not a single hierarchy. This approach makes us more agile, resilient, and deeply aligned with our mission.' 
        );

        // 3 structure cards
        $structure_cards = array(
            1 => array(
                'icon' => 'ri-shake-hands-line',
                'title' => 'Collective Decision-Making',
                'desc' => "No single leader can unilaterally decide JKJAAC's positions. All major actions require collective committee agreement — preventing individual co-optation by government."
            ),
            2 => array(
                'icon' => 'ri-earth-line',
                'title' => 'Diaspora Network',
                'desc' => "Nearly half of AJK's population lives overseas — primarily in the UK. JKJAAC's diaspora network, particularly in Birmingham and London, provides crucial advocacy and financial support."
            ),
            3 => array(
                'icon' => 'ri-smartphone-line',
                'title' => 'Social Media Strategy',
                'desc' => "Social media has been central to JKJAAC's organizing — allowing its message to reach every corner of AJK without distortion, even when traditional media aligned with government narratives."
            )
        );

        foreach ( $structure_cards as $i => $card ) {
            $this->add_text_setting(
                "jkjaac_structure_card_{$i}_icon",
                sprintf( __( 'Card %d - Icon', 'jkjaac' ), $i ),
                $section,
                $card['icon']
            );
            
            $this->add_text_setting(
                "jkjaac_structure_card_{$i}_title",
                sprintf( __( 'Card %d - Title', 'jkjaac' ), $i ),
                $section,
                $card['title']
            );
            
            $this->add_textarea_setting(
                "jkjaac_structure_card_{$i}_desc",
                sprintf( __( 'Card %d - Description', 'jkjaac' ), $i ),
                $section,
                $card['desc']
            );
        }
    }

    /**
     * Register stats settings
     */
    private function register_stats_settings() {
        $section = 'jkjaac_leadership_stats_section';

        $stats = array(
            1 => array( 'num' => '10', 'label' => 'Districts Represented' ),
            2 => array( 'num' => '4+', 'label' => 'Sector Constituencies' ),
            3 => array( 'num' => '0', 'label' => 'Political Party Ties' ),
            4 => array( 'num' => '3', 'label' => 'Negotiation Rounds' )
        );

        foreach ( $stats as $i => $stat ) {
            $this->add_text_setting(
                "jkjaac_stat_{$i}_number",
                sprintf( __( 'Stat %d - Number', 'jkjaac' ), $i ),
                $section,
                $stat['num']
            );
            
            $this->add_text_setting(
                "jkjaac_stat_{$i}_label",
                sprintf( __( 'Stat %d - Label', 'jkjaac' ), $i ),
                $section,
                $stat['label']
            );
        }
    }

    /**
     * Get default icon for persecution card
     */
    private function get_default_icon( $index ) {
        $icons = array(
            1 => 'ri-user-forbid-line',
            2 => 'ri-discuss-line',
            3 => 'ri-file-close-line',
            4 => 'ri-file-paper-2-line'
        );
        return isset( $icons[ $index ] ) ? $icons[ $index ] : 'ri-information-line';
    }

    /**
     * Get default title for persecution card
     */
    private function get_default_title( $index ) {
        $titles = array(
            1 => 'May 8–9, 2024 — Mass Arrests',
            2 => 'September 2025 — Communications Blackout',
            3 => '192 FIRs Filed — Later Largely Withdrawn',
            4 => 'International Appeal — October 2025'
        );
        return isset( $titles[ $index ] ) ? $titles[ $index ] : '';
    }

    /**
     * Get default description for persecution card
     */
    private function get_default_description( $index ) {
        $descriptions = array(
            1 => 'Around 70 JKJAAC activists arrested overnight across Muzaffarabad and Mirpur divisions, including Shaukat Nawaz Mir and multiple core committee members. The crackdown severely backfired, triggering the most intense protests in AJK\'s recent history and ultimately forcing the ₨23 billion relief package.',
            2 => 'Pakistan\'s Ministry of Interior ordered mobile and internet services suspended across major parts of AJK on September 28–29, 2025, specifically to prevent JKJAAC from coordinating the announced lockdown. Despite the blackout, hundreds of thousands mobilized — a testament to the leadership\'s organizational capacity.',
            3 => '192 First Information Reports (FIRs) were filed against JKJAAC activists across the 2024 and 2025 protests. The October 2025 agreement included withdrawal of 177 of these FIRs, a major victory for the movement\'s legal standing and a recognition of the illegitimacy of the prosecutions.',
            4 => 'Sardar Umar Nazir Kashmiri issued a formal international appeal on October 2, 2025 invoking the UN Charter, UDHR, and ICCPR — marking JKJAAC\'s first formal engagement with international human rights frameworks and gaining coverage from diaspora media worldwide.'
        );
        return isset( $descriptions[ $index ] ) ? $descriptions[ $index ] : '';
    }
}

/**
 * Initialize Leadership Customizer
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function jkjaac_leadership_customizer_init( $wp_customize ) {
    new JKJAAC_Leadership_Customizer( $wp_customize );
}