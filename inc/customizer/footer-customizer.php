<?php
/**
 * Footer Customizer Settings
 *
 * @package JKJAAC
 * @subpackage Customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JKJAAC_Footer_Customizer
 */
class JKJAAC_Footer_Customizer extends JKJAAC_Customizer_Base {

    /**
     * Panel ID
     *
     * @var string
     */
    protected $panel_id = 'jkjaac_footer_panel';

    /**
     * Panel title
     *
     * @var string
     */
    protected $panel_title = 'Footer Settings';

    /**
     * Panel description
     *
     * @var string
     */
    protected $panel_description = 'Customize the footer content, branding, social links, and more.';

    /**
     * Panel priority
     *
     * @var int
     */
    protected $panel_priority = 150;

    /**
     * Register sections
     */
    protected function register_sections() {
        $this->add_section( 'jkjaac_footer_brand_section', __( 'Brand & Description', 'jkjaac' ), __( 'Footer logo and brand description', 'jkjaac' ), 10 );
        $this->add_section( 'jkjaac_footer_social_section', __( 'Footer Social Links', 'jkjaac' ), __( 'Social media links displayed in the footer. Leave empty to hide.', 'jkjaac' ), 20 );
        $this->add_section( 'jkjaac_footer_pages_section', __( 'Column 1 - Pages', 'jkjaac' ), __( 'Manage the "Pages" column - select a menu or add manual links', 'jkjaac' ), 30 );
        $this->add_section( 'jkjaac_footer_more_section', __( 'Column 2 - More', 'jkjaac' ), __( 'Manage the "More" column - select a menu or add manual links', 'jkjaac' ), 40 );
        $this->add_section( 'jkjaac_footer_connect_section', __( 'Column 3 - Connect', 'jkjaac' ), __( 'Manage the "Connect" column - select a menu or add manual links', 'jkjaac' ), 50 );
        $this->add_section( 'jkjaac_footer_newsletter_section', __( 'Newsletter Column', 'jkjaac' ), __( 'Customize the newsletter signup section', 'jkjaac' ), 60 );
        $this->add_section( 'jkjaac_footer_bottom_section', __( 'Bottom Bar', 'jkjaac' ), __( 'Customize the footer bottom bar content', 'jkjaac' ), 70 );
    }

    /**
     * Register settings
     */
    protected function register_settings() {
        $this->register_brand_settings();
        $this->register_social_settings();
        $this->register_column_settings( 1, 'jkjaac_footer_pages_section', 'Pages' );
        $this->register_column_settings( 2, 'jkjaac_footer_more_section', 'More' );
        $this->register_column_settings( 3, 'jkjaac_footer_connect_section', 'Connect' );
        $this->register_newsletter_settings();
        $this->register_bottom_bar_settings();
    }

    /**
     * Register brand settings
     */
    private function register_brand_settings() {
        $section = 'jkjaac_footer_brand_section';

        $this->add_image_setting(
            'jkjaac_footer_logo',
            __( 'Footer Logo', 'jkjaac' ),
            $section,
            'https://jkjaac.co/wp-content/uploads/2026/03/cropped-JKJAAC-Logo.png',
            __( 'Recommended size: 200x60px', 'jkjaac' )
        );

        $this->add_text_setting(
            'jkjaac_footer_logo_alt',
            __( 'Logo Alt Text', 'jkjaac' ),
            $section,
            'JKJAAC LOGO'
        );

        $this->add_textarea_setting(
            'jkjaac_footer_description',
            __( 'Footer Description', 'jkjaac' ),
            $section,
            'Jammu Kashmir Joint Awami Action Committee — a grassroots civil society coalition fighting for economic justice, resource rights, and democratic accountability in Azad Jammu & Kashmir since 2022.'
        );
    }

    /**
     * Register social settings
     */
    private function register_social_settings() {
        $section = 'jkjaac_footer_social_section';
        $platforms = jkjaac_get_social_platforms( 'footer' );

        foreach ( $platforms as $key => $data ) {
            $this->add_url_setting(
                "jkjaac_footer_social_{$key}",
                sprintf( __( '%s URL', 'jkjaac' ), $data['label'] ),
                $section,
                '',
                __( 'Full URL including https://', 'jkjaac' )
            );
        }
    }

    /**
     * Register column settings
     *
     * @param int    $column      Column number (1, 2, or 3).
     * @param string $section     Section ID.
     * @param string $default_title Default column title.
     */
    private function register_column_settings( $column, $section, $default_title ) {
        $menu_choices = jkjaac_get_menu_choices();

        // Column Title
        $this->add_text_setting(
            "jkjaac_footer_col{$column}_title",
            __( 'Column Title', 'jkjaac' ),
            $section,
            $default_title
        );

        // Menu Selection
        $this->add_select_setting(
            "jkjaac_footer_col{$column}_menu",
            __( 'Select a Menu (Recommended)', 'jkjaac' ),
            $section,
            $menu_choices,
            '',
            __( 'Choose a WordPress menu to display. Overrides manual links below.', 'jkjaac' )
        );

        if ( ! jkjaac_has_menus() ) {
            $this->add_note(
                'jkjaac_footer_menu_note',
                __( 'No Menus Found', 'jkjaac' ),
                $section,
                sprintf(
                    __( 'Go to %s to create a menu for your footer.', 'jkjaac' ),
                    '<a href="' . admin_url( 'nav-menus.php' ) . '">' . __( 'Appearance → Menus', 'jkjaac' ) . '</a>'
                )
            );
        }

        // Divider
        $this->add_note(
            "jkjaac_footer_col{$column}_divider",
            __( '━━━━━━━━━━ MANUAL LINKS ━━━━━━━━━━', 'jkjaac' ),
            $section,
            __( 'Use these fields if you prefer manual links instead of a menu.', 'jkjaac' )
        );

        // Number of links
        $this->add_number_setting(
            "jkjaac_footer_col{$column}_count",
            __( 'Number of Manual Links', 'jkjaac' ),
            $section,
            4,
            array( 'min' => 0, 'max' => 10, 'step' => 1 ),
            __( 'Save and refresh to see new fields', 'jkjaac' )
        );

        $count = get_theme_mod( "jkjaac_footer_col{$column}_count", 4 );

        for ( $i = 1; $i <= $count; $i++ ) {
            $this->add_text_setting(
                "jkjaac_footer_col{$column}_link_{$i}_text",
                sprintf( __( 'Link %d - Text', 'jkjaac' ), $i ),
                $section
            );

            $this->add_url_setting(
                "jkjaac_footer_col{$column}_link_{$i}_url",
                sprintf( __( 'Link %d - URL', 'jkjaac' ), $i ),
                $section
            );
        }
    }

    /**
     * Register newsletter settings
     */
    private function register_newsletter_settings() {
        $section = 'jkjaac_footer_newsletter_section';

        $this->add_checkbox_setting(
            'jkjaac_footer_newsletter_show',
            __( 'Show Newsletter Section', 'jkjaac' ),
            $section,
            true
        );

        $this->add_text_setting(
            'jkjaac_footer_newsletter_title',
            __( 'Newsletter Title', 'jkjaac' ),
            $section,
            'Stay Connected'
        );

        $this->add_textarea_setting(
            'jkjaac_footer_newsletter_desc',
            __( 'Newsletter Description', 'jkjaac' ),
            $section,
            "Stay updated on JKJAAC's campaigns and victories. No spam, ever."
        );

        $this->add_text_setting(
            'jkjaac_footer_newsletter_placeholder',
            __( 'Input Placeholder', 'jkjaac' ),
            $section,
            'Your email address'
        );

        $this->add_text_setting(
            'jkjaac_footer_newsletter_success',
            __( 'Success Message', 'jkjaac' ),
            $section,
            '✓ Subscribed! Thank you.'
        );

        $this->add_text_setting(
            'jkjaac_footer_newsletter_error',
            __( 'Error Message', 'jkjaac' ),
            $section,
            'Please enter a valid email address.'
        );

        $this->add_text_setting(
            'jkjaac_footer_newsletter_duplicate',
            __( 'Already Subscribed Message', 'jkjaac' ),
            $section,
            "You're already subscribed!"
        );
    }

    /**
     * Register bottom bar settings
     */
    private function register_bottom_bar_settings() {
        $section = 'jkjaac_footer_bottom_section';

        $this->add_textarea_setting(
            'jkjaac_footer_copyright',
            __( 'Copyright Text', 'jkjaac' ),
            $section,
            '© 2025–2026 JKJAAC — Jammu Kashmir Joint Awami Action Committee'
        );

        $this->add_text_setting(
            'jkjaac_footer_location',
            __( 'Location Tagline', 'jkjaac' ),
            $section,
            'Azad Jammu & Kashmir'
        );

        $this->add_checkbox_setting(
            'jkjaac_back_to_top_show',
            __( 'Show Back to Top Button', 'jkjaac' ),
            $section,
            true
        );
    }
}

/**
 * Initialize Footer Customizer
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function jkjaac_footer_customizer_init( $wp_customize ) {
    new JKJAAC_Footer_Customizer( $wp_customize );
}

/* ============================================================================
   FOOTER HELPER FUNCTIONS
   ============================================================================ */

/**
 * Get footer social links array
 *
 * @return array Social links.
 */
function jkjaac_get_footer_social_links() {
    $platforms = array_keys( jkjaac_get_social_platforms( 'footer' ) );
    $platform_data = jkjaac_get_social_platforms( 'footer' );
    $links = array();
    
    foreach ( $platforms as $platform ) {
        $url = get_theme_mod( "jkjaac_footer_social_{$platform}", '' );
        if ( ! empty( $url ) ) {
            $links[] = array(
                'url'   => $url,
                'icon'  => $platform_data[ $platform ]['icon'],
                'label' => $platform_data[ $platform ]['label'],
            );
        }
    }
    
    return $links;
}

/**
 * Get footer column links
 *
 * @param int $column Column number (1, 2, or 3).
 * @return array Links array.
 */
function jkjaac_get_footer_column_links( $column ) {
    $menu_id = get_theme_mod( "jkjaac_footer_col{$column}_menu", '' );
    
    // If a menu is selected and exists, use it
    if ( ! empty( $menu_id ) && is_nav_menu( $menu_id ) ) {
        $menu_items = wp_get_nav_menu_items( $menu_id );
        $links = array();
        
        if ( $menu_items ) {
            foreach ( $menu_items as $item ) {
                $links[] = array(
                    'text' => $item->title,
                    'url'  => $item->url,
                );
            }
        }
        
        return $links;
    }
    
    // Fallback to manual links
    $count = get_theme_mod( "jkjaac_footer_col{$column}_count", 4 );
    $links = array();
    
    for ( $i = 1; $i <= $count; $i++ ) {
        $text = get_theme_mod( "jkjaac_footer_col{$column}_link_{$i}_text", '' );
        $url = get_theme_mod( "jkjaac_footer_col{$column}_link_{$i}_url", '' );
        
        if ( ! empty( $text ) && ! empty( $url ) ) {
            $links[] = array(
                'text' => $text,
                'url'  => $url,
            );
        }
    }
    
    return $links;
}

/**
 * Check if a footer column has any links
 *
 * @param int $column Column number.
 * @return bool True if has links.
 */
function jkjaac_footer_column_has_links( $column ) {
    $links = jkjaac_get_footer_column_links( $column );
    return ! empty( $links );
}