<?php
/**
 * Header Customizer Settings
 *
 * @package JKJAAC
 * @subpackage Customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class JKJAAC_Header_Customizer
 */
class JKJAAC_Header_Customizer extends JKJAAC_Customizer_Base {

    /**
     * Panel ID
     *
     * @var string
     */
    protected $panel_id = 'jkjaac_header_panel';

    /**
     * Panel title
     *
     * @var string
     */
    protected $panel_title = 'Header Settings';

    /**
     * Panel description
     *
     * @var string
     */
    protected $panel_description = 'Customize the header, navigation, logo, and more.';

    /**
     * Panel priority
     *
     * @var int
     */
    protected $panel_priority = 130;

    /**
     * Register sections
     */
    protected function register_sections() {
        $this->add_section( 'jkjaac_header_logo_section', __( 'Logo Settings', 'jkjaac' ), __( 'Customize the header logo and favicon', 'jkjaac' ), 10 );
        $this->add_section( 'jkjaac_navigation_section', __( 'Navigation Settings', 'jkjaac' ), __( 'Configure the main navigation menu', 'jkjaac' ), 20 );
        $this->add_section( 'jkjaac_header_cta_section', __( 'Header CTA Button', 'jkjaac' ), __( 'Customize the Call-to-Action button in the header', 'jkjaac' ), 30 );
        $this->add_section( 'jkjaac_header_style_section', __( 'Header Styling', 'jkjaac' ), __( 'Customize header appearance and behavior', 'jkjaac' ), 40 );
        $this->add_section( 'jkjaac_mobile_menu_section', __( 'Mobile Menu Settings', 'jkjaac' ), __( 'Customize the mobile/hamburger menu', 'jkjaac' ), 50 );
    }

    /**
     * Register settings
     */
    protected function register_settings() {
        $this->register_logo_settings();
        $this->register_navigation_settings();
        $this->register_cta_settings();
        $this->register_style_settings();
        $this->register_mobile_settings();
    }

    /**
     * Register logo settings
     */
    private function register_logo_settings() {
        $section = 'jkjaac_header_logo_section';

        $this->add_image_setting(
            'jkjaac_header_logo',
            __( 'Header Logo', 'jkjaac' ),
            $section,
            'https://jkjaac.co/wp-content/uploads/2026/03/cropped-JKJAAC-Logo.png',
            __( 'Recommended size: 200x60px', 'jkjaac' )
        );

        $this->add_text_setting(
            'jkjaac_header_logo_alt',
            __( 'Logo Alt Text', 'jkjaac' ),
            $section,
            'JKJAAC LOGO'
        );

        $this->add_image_setting(
            'jkjaac_header_logo_sticky',
            __( 'Sticky Header Logo (Optional)', 'jkjaac' ),
            $section,
            '',
            __( 'Logo for sticky/fixed header. Leave empty to use main logo.', 'jkjaac' )
        );

        $this->add_note(
            'jkjaac_favicon_note',
            __( 'Site Icon (Favicon)', 'jkjaac' ),
            $section,
            __( 'Set your site icon in WordPress → Settings → General → Site Icon.', 'jkjaac' )
        );
    }

    /**
     * Register navigation settings
     */
    private function register_navigation_settings() {
        $section = 'jkjaac_navigation_section';
        $menu_choices = jkjaac_get_menu_choices();

        $this->add_select_setting(
            'jkjaac_primary_menu_id',
            __( 'Primary Navigation Menu', 'jkjaac' ),
            $section,
            $menu_choices,
            '',
            __( 'Select a menu to display in the header. Create menus in Appearance → Menus.', 'jkjaac' )
        );

        if ( ! jkjaac_has_menus() ) {
            $this->add_note(
                'jkjaac_menu_create_note',
                __( 'No Menus Found', 'jkjaac' ),
                $section,
                sprintf(
                    __( 'Go to %s to create your first menu.', 'jkjaac' ),
                    '<a href="' . admin_url( 'nav-menus.php' ) . '">' . __( 'Appearance → Menus', 'jkjaac' ) . '</a>'
                )
            );
        }

        $this->add_checkbox_setting(
            'jkjaac_nav_enable_dropdown',
            __( 'Enable Dropdown Menus', 'jkjaac' ),
            $section,
            true,
            __( 'Show dropdown arrows and sub-menus', 'jkjaac' )
        );

        $this->add_number_setting(
            'jkjaac_mobile_menu_breakpoint',
            __( 'Mobile Menu Breakpoint (px)', 'jkjaac' ),
            $section,
            991,
            array( 'min' => 480, 'max' => 1200, 'step' => 1 ),
            __( 'Screen width at which mobile menu appears', 'jkjaac' )
        );
    }

    /**
     * Register CTA settings
     */
    private function register_cta_settings() {
        $section = 'jkjaac_header_cta_section';

        $this->add_checkbox_setting(
            'jkjaac_header_cta_show',
            __( 'Show CTA Button', 'jkjaac' ),
            $section,
            true
        );

        $this->add_text_setting(
            'jkjaac_header_cta_text',
            __( 'Button Text', 'jkjaac' ),
            $section,
            'contact us'
        );

        $this->add_url_setting(
            'jkjaac_header_cta_url',
            __( 'Button URL', 'jkjaac' ),
            $section,
            '',
            __( 'Leave empty to use Contact page', 'jkjaac' )
        );

        $this->add_checkbox_setting(
            'jkjaac_header_cta_target',
            __( 'Open in new tab', 'jkjaac' ),
            $section,
            false
        );

        $this->add_checkbox_setting(
            'jkjaac_header_cta_arrow',
            __( 'Show Arrow Icon', 'jkjaac' ),
            $section,
            true
        );
    }

    /**
     * Register style settings
     */
    private function register_style_settings() {
        $section = 'jkjaac_header_style_section';

        $this->add_checkbox_setting(
            'jkjaac_header_sticky',
            __( 'Enable Sticky Header', 'jkjaac' ),
            $section,
            true
        );

        $this->add_checkbox_setting(
            'jkjaac_header_transparent',
            __( 'Transparent Header (Homepage only)', 'jkjaac' ),
            $section,
            false,
            __( 'Make header background transparent on homepage', 'jkjaac' )
        );

        $this->add_color_setting(
            'jkjaac_header_bg_color',
            __( 'Header Background Color', 'jkjaac' ),
            $section,
            '#0a0a0a'
        );

        $this->add_color_setting(
            'jkjaac_header_text_color',
            __( 'Menu Text Color', 'jkjaac' ),
            $section,
            '#ffffff'
        );

        $this->add_color_setting(
            'jkjaac_header_text_hover_color',
            __( 'Menu Text Hover Color', 'jkjaac' ),
            $section,
            '#d4af37'
        );

        $this->add_color_setting(
            'jkjaac_header_cta_bg_color',
            __( 'CTA Button Background', 'jkjaac' ),
            $section,
            '#d4af37'
        );

        $this->add_color_setting(
            'jkjaac_header_cta_text_color',
            __( 'CTA Button Text Color', 'jkjaac' ),
            $section,
            '#0a0a0a'
        );

        $this->add_number_setting(
            'jkjaac_header_padding',
            __( 'Header Padding (px)', 'jkjaac' ),
            $section,
            20,
            array( 'min' => 0, 'max' => 50, 'step' => 5 ),
            __( 'Vertical padding of the header', 'jkjaac' )
        );
    }

    /**
     * Register mobile settings
     */
    private function register_mobile_settings() {
        $section = 'jkjaac_mobile_menu_section';

        $this->add_color_setting(
            'jkjaac_mobile_menu_bg',
            __( 'Mobile Menu Background', 'jkjaac' ),
            $section,
            '#0a0a0a'
        );

        $this->add_color_setting(
            'jkjaac_mobile_menu_text_color',
            __( 'Mobile Menu Text Color', 'jkjaac' ),
            $section,
            '#ffffff'
        );

        $this->add_color_setting(
            'jkjaac_hamburger_color',
            __( 'Hamburger Icon Color', 'jkjaac' ),
            $section,
            '#ffffff'
        );

        $this->add_checkbox_setting(
            'jkjaac_mobile_cta_show',
            __( 'Show CTA Button in Mobile Menu', 'jkjaac' ),
            $section,
            true
        );

        $this->add_text_setting(
            'jkjaac_mobile_cta_text',
            __( 'Mobile CTA Button Text', 'jkjaac' ),
            $section,
            'Contact Us'
        );
    }
}

/**
 * Initialize Header Customizer
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function jkjaac_header_customizer_init( $wp_customize ) {
    new JKJAAC_Header_Customizer( $wp_customize );
}

/* ============================================================================
   HEADER CUSTOMIZER CSS OUTPUT
   ============================================================================ */

/**
 * Output header customizer styles
 */
function jkjaac_header_customizer_css() {
    $header_bg         = get_theme_mod( 'jkjaac_header_bg_color', '#0a0a0a' );
    $header_text       = get_theme_mod( 'jkjaac_header_text_color', '#ffffff' );
    $header_text_hover = get_theme_mod( 'jkjaac_header_text_hover_color', '#d4af37' );
    $cta_bg            = get_theme_mod( 'jkjaac_header_cta_bg_color', '#d4af37' );
    $cta_text          = get_theme_mod( 'jkjaac_header_cta_text_color', '#0a0a0a' );
    $header_padding    = get_theme_mod( 'jkjaac_header_padding', '20' );
    $mobile_menu_bg    = get_theme_mod( 'jkjaac_mobile_menu_bg', '#0a0a0a' );
    $mobile_text       = get_theme_mod( 'jkjaac_mobile_menu_text_color', '#ffffff' );
    $hamburger_color   = get_theme_mod( 'jkjaac_hamburger_color', '#ffffff' );
    $mobile_breakpoint = get_theme_mod( 'jkjaac_mobile_menu_breakpoint', '991' );
    
    ?>
    <style id="jkjaac-header-customizer-styles">
        :root {
            --header-bg: <?php echo esc_html( $header_bg ); ?>;
            --header-text: <?php echo esc_html( $header_text ); ?>;
            --header-text-hover: <?php echo esc_html( $header_text_hover ); ?>;
            --header-cta-bg: <?php echo esc_html( $cta_bg ); ?>;
            --header-cta-text: <?php echo esc_html( $cta_text ); ?>;
            --mobile-menu-bg: <?php echo esc_html( $mobile_menu_bg ); ?>;
            --mobile-menu-text: <?php echo esc_html( $mobile_text ); ?>;
            --hamburger-color: <?php echo esc_html( $hamburger_color ); ?>;
            --mobile-breakpoint: <?php echo esc_html( $mobile_breakpoint ); ?>px;
        }
        
        .nav {
            background-color: var(--header-bg);
            padding-top: <?php echo esc_html( $header_padding ); ?>px;
            padding-bottom: <?php echo esc_html( $header_padding ); ?>px;
        }
        
        <?php if ( get_theme_mod( 'jkjaac_header_transparent', false ) && is_front_page() ) : ?>
        .home .nav:not(.nav-scrolled) {
            background-color: transparent;
        }
        <?php endif; ?>
        
        <?php if ( get_theme_mod( 'jkjaac_header_sticky', true ) ) : ?>
        .nav {
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        <?php endif; ?>
        
        .nav-links > li > a {
            color: var(--header-text);
        }
        
        .nav-links > li > a:hover,
        .nav-links > li > a.active {
            color: var(--header-text-hover);
        }
        
        .dropdown {
            background-color: var(--header-bg);
        }
        
        .dropdown a {
            color: var(--header-text);
        }
        
        .dropdown a:hover,
        .dropdown a.active {
            color: var(--header-text-hover);
        }
        
        .nav-cta {
            background-color: var(--header-cta-bg);
            color: var(--header-cta-text) !important;
        }
        
        .nav-cta:hover {
            opacity: 0.9;
        }
        
        .nav-cta-arrow i {
            color: var(--header-cta-text);
        }
        
        .nav-hamburger span {
            background-color: var(--hamburger-color);
        }
        
        @media (max-width: <?php echo esc_html( $mobile_breakpoint ); ?>px) {
            .nav-default {
                background-color: var(--mobile-menu-bg);
            }
            
            .nav-links > li > a {
                color: var(--mobile-menu-text);
            }
            
            .nav-links > li > a:hover,
            .nav-links > li > a.active {
                color: var(--header-text-hover);
            }
            
            .dropdown {
                background-color: rgba(255, 255, 255, 0.05);
            }
        }
    </style>
    <?php
}
add_action( 'wp_head', 'jkjaac_header_customizer_css', 99 );

/* ============================================================================
   HEADER HELPER FUNCTIONS
   ============================================================================ */

/**
 * Get CTA button URL
 *
 * @return string CTA URL.
 */
function jkjaac_get_cta_url() {
    $cta_url = get_theme_mod( 'jkjaac_header_cta_url', '' );
    
    if ( empty( $cta_url ) ) {
        $cta_url = jkjaac_page_url( 'contact' );
    }
    
    return $cta_url;
}

/**
 * Custom Navigation Walker for dropdown menus
 */
class JKJAAC_Nav_Walker extends Walker_Nav_Menu {
    
    public function start_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat( $t, $depth );
        
        $classes = array( 'dropdown' );
        $class_names = implode( ' ', $classes );
        
        $output .= "{$n}{$indent}<ul class=\"{$class_names}\">{$n}";
    }
    
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        if ( in_array( 'menu-item-has-children', $classes ) && get_theme_mod( 'jkjaac_nav_enable_dropdown', true ) ) {
            $classes[] = 'has-dropdown';
        }
        
        if ( in_array( 'current-menu-item', $classes ) || in_array( 'current-page-ancestor', $classes ) ) {
            $classes[] = 'active';
        }
        
        $args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );
        
        $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names . '>';
        
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        if ( '_blank' === $item->target && empty( $item->xfn ) ) {
            $atts['rel'] = 'noopener noreferrer';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href']         = ! empty( $item->url ) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';
        
        if ( $item->current ) {
            $atts['class'] = 'active';
        }
        
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
        
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
                $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        
        $item_output  = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        
        if ( in_array( 'menu-item-has-children', $classes ) && get_theme_mod( 'jkjaac_nav_enable_dropdown', true ) ) {
            $item_output .= '<span class="nav-arrow"><i class="ri-arrow-down-s-line"></i></span>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}