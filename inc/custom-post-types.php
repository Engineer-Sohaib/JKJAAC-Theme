<?php
/**
 * Custom Post Types for JKJAAC Theme
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ============================================================================
   TICKER ITEM CUSTOM POST TYPE
   ============================================================================ */

function jkjaac_register_ticker_cpt() {
    $labels = array(
        'name'               => 'Ticker Items',
        'singular_name'      => 'Ticker Item',
        'menu_name'          => 'News Ticker',
        'add_new'            => 'Add New Item',
        'add_new_item'       => 'Add New Ticker Item',
        'edit_item'          => 'Edit Ticker Item',
        'new_item'           => 'New Ticker Item',
        'view_item'          => 'View Ticker Item',
        'search_items'       => 'Search Ticker Items',
        'not_found'          => 'No ticker items found',
        'not_found_in_trash' => 'No ticker items found in Trash',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'rewrite'            => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-megaphone',
        'supports'           => array( 'title' ),
    );

    register_post_type( 'ticker_item', $args );
}
add_action( 'init', 'jkjaac_register_ticker_cpt' );

function jkjaac_ticker_add_order_support() {
    add_post_type_support( 'ticker_item', 'page-attributes' );
}
add_action( 'admin_init', 'jkjaac_ticker_add_order_support' );

/* ============================================================================
   TICKER SHORTCODE
   ============================================================================ */

function jkjaac_dynamic_ticker_shortcode( $atts ) {
    $args = array(
        'post_type'      => 'ticker_item',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    );

    $query = new WP_Query( $args );
    
    ob_start();
    
    if ( $query->have_posts() ) : ?>
        <div aria-hidden="true" class="ticker-wrap">
            <div class="ticker-track">
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="ticker-item"><?php the_title(); ?></div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php else : ?>
        <div aria-hidden="true" class="ticker-wrap">
            <div class="ticker-track">
                <div class="ticker-item">Add items in Dashboard > News Ticker</div>
            </div>
        </div>
    <?php endif;
    
    wp_reset_postdata();
    
    return ob_get_clean();
}
add_shortcode( 'dynamic_ticker', 'jkjaac_dynamic_ticker_shortcode' );

/* ============================================================================
   LEADERSHIP CUSTOM POST TYPE
   ============================================================================ */

function jkjaac_register_leadership_cpt() {
    $labels = array(
        'name'                  => 'Leadership',
        'singular_name'         => 'Leader',
        'menu_name'             => 'Leadership',
        'add_new'               => 'Add New Leader',
        'add_new_item'          => 'Add New Leader Profile',
        'edit_item'             => 'Edit Leader Profile',
        'new_item'              => 'New Leader',
        'view_item'             => 'View Leader',
        'search_items'          => 'Search Leadership',
        'not_found'             => 'No leaders found',
        'not_found_in_trash'    => 'No leaders found in Trash',
        'all_items'             => 'All Leadership',
        'featured_image'        => 'Profile Photo',
        'set_featured_image'    => 'Set profile photo',
        'remove_featured_image' => 'Remove profile photo',
        'use_featured_image'    => 'Use as profile photo',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'leader' ), // CHANGED: from 'leadership' to 'leader'
        'capability_type'    => 'post',
        'has_archive'        => false, // CHANGED: disable archive or change to 'leaders'
        'hierarchical'       => false,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'leadership', $args );
}
add_action( 'init', 'jkjaac_register_leadership_cpt' );

/* ============================================================================
   LEADERSHIP SECTION SETTINGS (Customizer)
   ============================================================================ */

function jkjaac_leadership_customizer_settings( $wp_customize ) {
    
    $wp_customize->add_section( 'jkjaac_leadership_section', array(
        'title'       => __( 'Leadership Section', 'jkjaac' ),
        'description' => __( 'Customize the leadership section header content', 'jkjaac' ),
        'priority'    => 130,
    ) );
    
    $wp_customize->add_setting( 'jkjaac_leadership_label', array(
        'default'           => 'Core Committee',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'jkjaac_leadership_label', array(
        'label'    => __( 'Section Label', 'jkjaac' ),
        'section'  => 'jkjaac_leadership_section',
        'type'     => 'text',
    ) );
    
    $wp_customize->add_setting( 'jkjaac_leadership_title_line1', array(
        'default'           => 'Leadership',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'jkjaac_leadership_title_line1', array(
        'label'    => __( 'Title - Line 1', 'jkjaac' ),
        'section'  => 'jkjaac_leadership_section',
        'type'     => 'text',
    ) );
    
    $wp_customize->add_setting( 'jkjaac_leadership_title_line2', array(
        'default'           => 'Profiles',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'jkjaac_leadership_title_line2', array(
        'label'    => __( 'Title - Line 2 (Emphasized)', 'jkjaac' ),
        'section'  => 'jkjaac_leadership_section',
        'type'     => 'text',
    ) );
    
    $wp_customize->add_setting( 'jkjaac_leadership_description', array(
        'default'           => 'JKJAAC is deliberately structured as a collective leadership — not a one-man movement. Core committee members represent diverse geographic, professional, and social constituencies across all districts of AJK. Each has risked personal freedom and safety for the movement.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'jkjaac_leadership_description', array(
        'label'    => __( 'Description Text', 'jkjaac' ),
        'section'  => 'jkjaac_leadership_section',
        'type'     => 'textarea',
    ) );
    
}
add_action( 'customize_register', 'jkjaac_leadership_customizer_settings' );

/* ============================================================================
   LEADERSHIP SHORTCODES
   ============================================================================ */

function jkjaac_leadership_grid_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'count'    => '',
        'orderby'  => 'menu_order',
        'order'    => 'ASC',
        'exclude'  => '',
        'include'  => '',
    ), $atts, 'leadership_grid' );

    // If count not specified in shortcode, check page settings
    if ( empty( $atts['count'] ) ) {
        $team_data = function_exists( 'jkjaac_get_team_data' ) ? jkjaac_get_team_data() : array();
        $page_count = isset( $team_data['leader_count'] ) ? $team_data['leader_count'] : '';
        $atts['count'] = ! empty( $page_count ) ? intval( $page_count ) : -1;
    }

    $args = array(
        'post_type'      => 'leadership',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
    );

    if ( ! empty( $atts['include'] ) ) {
        $args['post__in'] = array_map( 'intval', explode( ',', $atts['include'] ) );
        $args['orderby'] = 'post__in';
        unset( $args['posts_per_page'] );
    }
    
    if ( ! empty( $atts['exclude'] ) ) {
        $args['post__not_in'] = array_map( 'intval', explode( ',', $atts['exclude'] ) );
    }

    $leaders = new WP_Query( $args );
    
    if ( ! $leaders->have_posts() ) {
        return '<p class="no-leaders-found">No leadership profiles found.</p>';
    }

    // Check if section should be hidden - but only for non-leadership pages
    // On leadership page, we always want to show the grid
    $team_data = function_exists( 'jkjaac_get_team_data' ) ? jkjaac_get_team_data() : array();
    if ( isset( $team_data['hide_section'] ) && $team_data['hide_section'] ) {
        // Only return empty if we're NOT on a leadership page
        // This allows the shortcode to work on leadership page
        global $post;
        if ( $post ) {
            $page_template = get_page_template_slug( $post->ID );
            $is_leadership_page = ( $page_template === 'page-leadership.php' );
            if ( ! $is_leadership_page ) {
                return '';
            }
        }
    }

    ob_start();
    ?>
    <section class="team">
        <div class="team-inner">
            <?php 
            $desc_class = 'prose';
            get_template_part( 'template-parts/leadership-header' ); 
            ?>
            <div class="team-grid">
                <?php 
                $counter = 0;
                while ( $leaders->have_posts() ) : $leaders->the_post(); 
                    get_template_part( 'template-parts/leadership-card' );
                    $counter++;
                endwhile; 
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'leadership_grid', 'jkjaac_leadership_grid_shortcode' );

function jkjaac_leadership_detailed_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'count'    => -1,
        'orderby'  => 'menu_order',
        'order'    => 'ASC',
        'exclude'  => '',
        'include'  => '',
    ), $atts, 'leadership_detailed' );

    $args = array(
        'post_type'      => 'leadership',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
    );

    if ( ! empty( $atts['include'] ) ) {
        $args['post__in'] = array_map( 'intval', explode( ',', $atts['include'] ) );
        $args['orderby'] = 'post__in';
        unset( $args['posts_per_page'] );
    }
    
    if ( ! empty( $atts['exclude'] ) ) {
        $args['post__not_in'] = array_map( 'intval', explode( ',', $atts['exclude'] ) );
    }

    $leaders = new WP_Query( $args );
    
    if ( ! $leaders->have_posts() ) {
        return '<p class="no-leaders-found">No leadership profiles found.</p>';
    }

    // Check if section should be hidden
    $team_data = function_exists( 'jkjaac_get_team_data' ) ? jkjaac_get_team_data() : array();
    if ( isset( $team_data['hide_section'] ) && $team_data['hide_section'] ) {
        return '';
    }

    ob_start();
    ?>
    <section class="about-section">
        <div class="about-inner">
            <?php 
            $desc_class = 's-desc';
            get_template_part( 'template-parts/leadership-header' ); 
            ?>
        </div>

        <div class="s-inner mt-1">
            <div class="sr pg-leadership-1">
                <?php 
                $counter = 1;
                while ( $leaders->have_posts() ) : $leaders->the_post(); 
                    get_template_part( 'template-parts/leadership-detailed-card' );
                    $counter++;
                endwhile; 
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'leadership_detailed', 'jkjaac_leadership_detailed_shortcode' );


/* ============================================================================
   PROCESS STEPS CUSTOM POST TYPE
   ============================================================================ */

/**
 * Register Process Steps Custom Post Type
 */
function jkjaac_register_process_steps_cpt() {
    $labels = array(
        'name'                  => 'Process Steps',
        'singular_name'         => 'Process Step',
        'menu_name'             => 'Process Steps',
        'add_new'               => 'Add New Step',
        'add_new_item'          => 'Add New Process Step',
        'edit_item'             => 'Edit Process Step',
        'new_item'              => 'New Step',
        'view_item'             => 'View Step',
        'search_items'          => 'Search Steps',
        'not_found'             => 'No steps found',
        'not_found_in_trash'    => 'No steps found in Trash',
        'all_items'             => 'All Steps',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'process-step' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 22,
        'menu_icon'          => 'dashicons-editor-ol',
        'supports'           => array( 'title', 'editor', 'page-attributes' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'process_step', $args );
}
add_action( 'init', 'jkjaac_register_process_steps_cpt' );

/* ============================================================================
   PROCESS STEPS ICON META BOX
   ============================================================================ */

/**
 * Add Icon Meta Box
 */
function jkjaac_process_step_icon_meta_box() {
    add_meta_box(
        'process_step_icon',
        'Step Icon',
        'jkjaac_process_step_icon_callback',
        'process_step',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_process_step_icon_meta_box' );

/**
 * Icon Meta Box Callback
 */
function jkjaac_process_step_icon_callback( $post ) {
    // Add nonce for security
    wp_nonce_field( 'process_step_icon', 'process_step_icon_nonce' );
    
    // Include the meta box template
    include get_template_directory() . '/inc/meta-box-views/meta-icon-box.php';
}

/**
 * Save Icon Meta Box
 */
function jkjaac_save_process_step_icon( $post_id ) {
    // Security checks
    if ( ! isset( $_POST['process_step_icon_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['process_step_icon_nonce'], 'process_step_icon' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Save icon
    if ( isset( $_POST['process_step_icon'] ) ) {
        update_post_meta( $post_id, '_process_step_icon', sanitize_text_field( $_POST['process_step_icon'] ) );
    }
}
add_action( 'save_post', 'jkjaac_save_process_step_icon' );

/* ============================================================================
   PROCESS STEPS SHORTCODE
   ============================================================================ */

/**
 * Shortcode: [process_steps]
 * 
 * Parameters:
 * - count: Number of steps to display (default: -1 for all)
 * - orderby: Order by field (default: 'menu_order')
 * - order: Sort order ASC or DESC (default: 'ASC')
 */
function jkjaac_process_steps_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'count'   => -1,
        'orderby' => 'menu_order',
        'order'   => 'ASC',
    ), $atts, 'process_steps' );

    $args = array(
        'post_type'      => 'process_step',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
    );

    $steps = new WP_Query( $args );
    
    if ( ! $steps->have_posts() ) {
        return '<p class="no-steps-found">No process steps found.</p>';
    }

    // Default icon mapping based on step position
    $default_icons = array(
        1 => 'ri-search-line',
        2 => 'ri-megaphone-line',
        3 => 'ri-user-community-line',
        4 => 'ri-star-line',
    );

    ob_start();
    ?>
    <div class="process-steps">
        <?php 
        $counter = 1;
        while ( $steps->have_posts() ) : $steps->the_post(); 
            
            // Format step number with leading zero
            $step_num = sprintf( '%02d', $counter );
            
            // Get custom icon or use default based on position
            $step_icon = get_post_meta( get_the_ID(), '_process_step_icon', true );
            if ( empty( $step_icon ) && isset( $default_icons[ $counter ] ) ) {
                $step_icon = $default_icons[ $counter ];
            }
            
            // Animation delay class (sr-d1, sr-d2, etc.)
            $delay_class = $counter > 1 ? ' sr-d' . ( $counter - 1 ) : '';
        ?>
            <div class="step sr<?php echo esc_attr( $delay_class ); ?>">
                <div class="step-num">Step <?php echo esc_html( $step_num ); ?></div>
                <div class="step-icon"><i class="<?php echo esc_attr( $step_icon ); ?>"></i></div>
                <div class="step-title"><?php the_title(); ?></div>
                <div class="step-desc">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php 
        $counter++;
        endwhile; 
        wp_reset_postdata();
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'process_steps', 'jkjaac_process_steps_shortcode' );

/* ============================================================================
   CHARTER DEMANDS CUSTOM POST TYPE (38-Point Charter)
   ============================================================================ */

/**
 * Register Charter Demands Custom Post Type
 */
function jkjaac_register_charter_demands_cpt() {
    $labels = array(
        'name'                  => 'Charter Demands',
        'singular_name'         => 'Demand',
        'menu_name'            => '38-Point Charter',
        'add_new'              => 'Add New Demand',
        'add_new_item'         => 'Add New Demand',
        'edit_item'            => 'Edit Demand',
        'new_item'             => 'New Demand',
        'view_item'            => 'View Demand',
        'search_items'         => 'Search Demands',
        'not_found'            => 'No demands found',
        'not_found_in_trash'   => 'No demands found in trash',
        'all_items'            => 'All Demands',
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'charter-demand'),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 23,
        'menu_icon'           => 'dashicons-media-document',
        'supports'            => array('title', 'editor', 'page-attributes'),
        'show_in_rest'        => true,
    );
    
    register_post_type('charter_demand', $args);
}
add_action('init', 'jkjaac_register_charter_demands_cpt');

/**
 * Register Demand Category Taxonomy
 */
function jkjaac_register_demand_category_taxonomy() {
    $labels = array(
        'name'              => 'Demand Categories',
        'singular_name'     => 'Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'parent_item'       => 'Parent Category',
        'parent_item_colon' => 'Parent Category:',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Categories',
    );
    
    $args = array(
        'hierarchical'      => true,  // Already true - this is correct for dropdown
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'demand-category'),
        'show_in_rest'      => true,
    );
    
    register_taxonomy('demand_category', array('charter_demand'), $args);
}
add_action('init', 'jkjaac_register_demand_category_taxonomy');

/**
 * Register Demand Status Taxonomy (Hierarchical - shows as dropdown)
 */
function jkjaac_register_demand_status_taxonomy() {
    $labels = array(
        'name'              => 'Demand Status',
        'singular_name'     => 'Status',
        'search_items'      => 'Search Statuses',
        'all_items'         => 'All Statuses',
        'parent_item'       => 'Parent Status',
        'parent_item_colon' => 'Parent Status:',
        'edit_item'         => 'Edit Status',
        'update_item'       => 'Update Status',
        'add_new_item'      => 'Add New Status',
        'new_item_name'     => 'New Status Name',
        'menu_name'         => 'Statuses',
    );
    
    $args = array(
        'hierarchical'      => true,  // Changed from false to true for dropdown
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'demand-status'),
        'show_in_rest'      => true,
    );
    
    register_taxonomy('demand_status', array('charter_demand'), $args);
}
add_action('init', 'jkjaac_register_demand_status_taxonomy');

/**
 * Add Demand Number Meta Box
 */
function jkjaac_add_demand_number_metabox() {
    add_meta_box(
        'demand_number',
        'Demand Number',
        'jkjaac_render_demand_number_metabox',
        'charter_demand',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'jkjaac_add_demand_number_metabox');

function jkjaac_render_demand_number_metabox($post) {
    wp_nonce_field('demand_number_nonce', 'demand_number_nonce');
    $demand_number = get_post_meta($post->ID, '_demand_number', true);
    ?>
    <p>
        <label for="demand_number"><strong>Demand Number:</strong></label>
        <input type="text" id="demand_number" name="demand_number" 
               value="<?php echo esc_attr($demand_number); ?>" 
               placeholder="01" style="width:100%; margin-top:5px;" />
    </p>
    <p class="description">Enter the demand number (e.g., 01, 02, 03)</p>
    <?php
}

function jkjaac_save_demand_number_metabox($post_id) {
    if (!isset($_POST['demand_number_nonce']) || 
        !wp_verify_nonce($_POST['demand_number_nonce'], 'demand_number_nonce')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['demand_number'])) {
        update_post_meta($post_id, '_demand_number', sanitize_text_field($_POST['demand_number']));
    }
}
add_action('save_post', 'jkjaac_save_demand_number_metabox');

/**
 * Add Order Column to Admin List
 */
function jkjaac_add_demand_order_column($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key === 'title') {
            $new_columns['demand_number'] = '#';
        }
        $new_columns[$key] = $value;
    }
    return $new_columns;
}
add_filter('manage_charter_demand_posts_columns', 'jkjaac_add_demand_order_column');

function jkjaac_display_demand_order_column($column, $post_id) {
    if ($column === 'demand_number') {
        $demand_number = get_post_meta($post_id, '_demand_number', true);
        echo $demand_number ? esc_html($demand_number) : '—';
    }
}
add_action('manage_charter_demand_posts_custom_column', 'jkjaac_display_demand_order_column', 10, 2);

/**
 * Make Order Column Sortable
 */
function jkjaac_make_demand_order_sortable($columns) {
    $columns['demand_number'] = 'demand_number';
    return $columns;
}
add_filter('manage_edit-charter_demand_sortable_columns', 'jkjaac_make_demand_order_sortable');

function jkjaac_orderby_demand_number($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    
    if ($query->get('orderby') === 'demand_number') {
        $query->set('meta_key', '_demand_number');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'jkjaac_orderby_demand_number');

/**
 * Create Default Terms on Theme Activation
 */
function jkjaac_create_default_demand_terms() {
    // Create categories
    $categories = array(
        'structural' => 'Structural & Political',
        'economic'   => 'Economic Relief',
        'social'     => 'Social Rights'
    );
    
    foreach ($categories as $slug => $name) {
        if (!term_exists($slug, 'demand_category')) {
            wp_insert_term($name, 'demand_category', array('slug' => $slug));
        }
    }
    
    // Create statuses
    $statuses = array(
        'done'    => 'Implemented',
        'partial' => 'Partial Progress',
        'pending' => 'Pending'
    );
    
    foreach ($statuses as $slug => $name) {
        if (!term_exists($slug, 'demand_status')) {
            wp_insert_term($name, 'demand_status', array('slug' => $slug));
        }
    }
}

// Run on theme activation
add_action('after_switch_theme', 'jkjaac_create_default_demand_terms');

// Also run on admin init to ensure terms exist
function jkjaac_ensure_demand_terms_exist() {
    jkjaac_create_default_demand_terms();
}
add_action('admin_init', 'jkjaac_ensure_demand_terms_exist');

/**
 * Charter Demands Shortcode
 * Usage: [charter_demands]
 */
function jkjaac_charter_demands_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count'    => -1,
        'orderby'  => 'meta_value',
        'order'    => 'ASC',
    ), $atts, 'charter_demands');
    
    // Get all demands ordered by demand number
    $demands_query = new WP_Query(array(
        'post_type'      => 'charter_demand',
        'posts_per_page' => intval($atts['count']),
        'orderby'        => 'meta_value',
        'meta_key'       => '_demand_number',
        'order'          => sanitize_text_field($atts['order']),
        'post_status'    => 'publish',
    ));
    
    if (!$demands_query->have_posts()) {
        return '<p class="no-demands-found">No demands found. Please add demands in the WordPress admin.</p>';
    }
    
    // Group demands by category for section headers
    $grouped_demands = array();
    $category_order = array('structural', 'economic', 'social');
    
    while ($demands_query->have_posts()) {
        $demands_query->the_post();
        $categories = wp_get_post_terms(get_the_ID(), 'demand_category');
        $category_slug = !empty($categories) ? $categories[0]->slug : 'uncategorized';
        
        if (!isset($grouped_demands[$category_slug])) {
            $grouped_demands[$category_slug] = array();
        }
        
        $status_terms = wp_get_post_terms(get_the_ID(), 'demand_status');
        $status = !empty($status_terms) ? $status_terms[0] : null;
        
        $grouped_demands[$category_slug][] = array(
            'id'      => get_the_ID(),
            'title'   => get_the_title(),
            'content' => get_the_content(),
            'number'  => get_post_meta(get_the_ID(), '_demand_number', true),
            'status'  => $status,
            'categories' => $categories
        );
    }
    wp_reset_postdata();
    
    // Sort groups by category order
    $sorted_demands = array();
    foreach ($category_order as $cat_slug) {
        if (isset($grouped_demands[$cat_slug])) {
            $sorted_demands[$cat_slug] = $grouped_demands[$cat_slug];
        }
    }
    
    // Category headers
    $category_headers = array(
        'structural' => 'A — Core Structural & Political Demands',
        'economic'   => 'B — Economic & Resource Rights',
        'social'     => 'C — Social Rights & Human Development'
    );
    
    // Get categories for filter buttons
    $filter_categories = get_terms(array(
        'taxonomy'   => 'demand_category',
        'hide_empty' => true
    ));
    
    // Get statuses for filter buttons
    $statuses = get_terms(array(
        'taxonomy'   => 'demand_status',
        'hide_empty' => true
    ));
    
    ob_start();
    ?>
    <div class="demand-filter">
        <button class="filter-btn active" data-filter="all">
            All 38 Demands
        </button>
        <?php foreach ($filter_categories as $category) : 
            $filter_label = '';
            switch ($category->slug) {
                case 'structural':
                    $filter_label = 'Structural & Political';
                    break;
                case 'economic':
                    $filter_label = 'Economic Relief';
                    break;
                case 'social':
                    $filter_label = 'Social Rights';
                    break;
                default:
                    $filter_label = $category->name;
            }
        ?>
            <button class="filter-btn" data-filter="<?php echo esc_attr($category->slug); ?>">
                <?php echo esc_html($filter_label); ?>
            </button>
        <?php endforeach; ?>
        
        <?php foreach ($statuses as $status) : 
            $status_label = '';
            switch ($status->slug) {
                case 'done':
                    $status_label = '✓ Implemented';
                    break;
                case 'pending':
                    $status_label = 'Pending';
                    break;
                case 'partial':
                    $status_label = 'Partial Progress';
                    break;
                default:
                    $status_label = $status->name;
            }
        ?>
            <button class="filter-btn" data-filter="status-<?php echo esc_attr($status->slug); ?>">
                <?php echo esc_html($status_label); ?>
            </button>
        <?php endforeach; ?>
    </div>
    
    <div id="demands-container">
        <?php foreach ($sorted_demands as $category_slug => $demands) : ?>
            <?php if (isset($category_headers[$category_slug])) : ?>
                <div class="reveal visible">
                    <div><?php echo esc_html($category_headers[$category_slug]); ?></div>
                </div>
            <?php endif; ?>
            
            <?php foreach ($demands as $demand) : 
                $status = $demand['status'];
                $status_class = $status ? 'status-' . $status->slug : '';
                $status_text = $status ? $status->name : '';
                
                // Format status text
                if ($status) {
                    switch ($status->slug) {
                        case 'done':
                            $status_text = '✓ ' . $status_text;
                            break;
                        case 'partial':
                            $status_text = 'Partial Progress';
                            break;
                        case 'pending':
                            $status_text = 'Pending Implementation';
                            break;
                    }
                }
                
                $cat_slugs = array_map(function($cat) { return $cat->slug; }, $demand['categories']);
                $cat_classes = implode(' ', $cat_slugs);
                $status_data = $status ? 'status-' . $status->slug : '';
            ?>
                <div class="demand-item visible" 
                     data-cat="<?php echo esc_attr($cat_classes); ?>" 
                     data-status="<?php echo esc_attr($status_data); ?>">
                    <div class="demand-number">
                        <?php echo esc_html($demand['number'] ?: '—'); ?>
                    </div>
                    <div class="demand-content">
                        <h4><?php echo esc_html($demand['title']); ?></h4>
                        <div class="demand-description">
                            <?php echo wp_kses_post($demand['content']); ?>
                        </div>
                        <?php if ($status) : ?>
                            <span class="demand-status <?php echo esc_attr($status_class); ?>">
                                <?php echo esc_html($status_text); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
        
        <div class="reveal">
            <div class="hero-btns sr">
                <p class="bs-lbl">
                    The full charter contains 38 demands across additional
                    categories including environmental rights, judicial reform, and
                    diaspora representation.
                </p>
                <a class="btn-g" href="<?php echo esc_url(home_url('/negotiations')); ?>">
                    See Implementation Status in Full
                </a>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('charter_demands', 'jkjaac_charter_demands_shortcode');


/* ============================================================================
   FAQ CUSTOM POST TYPE
   ============================================================================ */

/**
 * Register FAQ Custom Post Type
 */
function jkjaac_register_faq_cpt() {
    $labels = array(
        'name'                  => 'FAQ Items',
        'singular_name'         => 'FAQ Item',
        'menu_name'             => 'FAQs',
        'add_new'               => 'Add New FAQ',
        'add_new_item'          => 'Add New FAQ Item',
        'edit_item'             => 'Edit FAQ Item',
        'new_item'              => 'New FAQ',
        'view_item'             => 'View FAQ',
        'search_items'          => 'Search FAQs',
        'not_found'             => 'No FAQs found',
        'not_found_in_trash'    => 'No FAQs found in Trash',
        'all_items'             => 'All FAQs',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'faq' ),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 24,
        'menu_icon'           => 'dashicons-editor-help',
        'supports'            => array( 'title', 'editor', 'page-attributes' ),
        'show_in_rest'        => true,
    );

    register_post_type( 'faq', $args );
}
add_action( 'init', 'jkjaac_register_faq_cpt' );

/* ============================================================================
   FAQ SETTINGS (Customizer)
   ============================================================================ */

function jkjaac_faq_customizer_settings( $wp_customize ) {
    
    $wp_customize->add_section( 'jkjaac_faq_section', array(
        'title'       => __( 'FAQ Section', 'jkjaac' ),
        'description' => __( 'Customize the FAQ section header content', 'jkjaac' ),
        'priority'    => 131,
    ) );
    
    $wp_customize->add_setting( 'jkjaac_faq_label', array(
        'default'           => 'FAQ',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'jkjaac_faq_label', array(
        'label'    => __( 'Section Label', 'jkjaac' ),
        'section'  => 'jkjaac_faq_section',
        'type'     => 'text',
    ) );
    
    $wp_customize->add_setting( 'jkjaac_faq_title_line1', array(
        'default'           => 'Common',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'jkjaac_faq_title_line1', array(
        'label'    => __( 'Title - Line 1', 'jkjaac' ),
        'section'  => 'jkjaac_faq_section',
        'type'     => 'text',
    ) );
    
    $wp_customize->add_setting( 'jkjaac_faq_title_line2', array(
        'default'           => 'Queries',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'jkjaac_faq_title_line2', array(
        'label'    => __( 'Title - Line 2 (Emphasized)', 'jkjaac' ),
        'section'  => 'jkjaac_faq_section',
        'type'     => 'text',
    ) );
    
    $wp_customize->add_setting( 'jkjaac_faq_description', array(
        'default'           => 'At KFM, we believe in transparency and community engagement. Below are answers to frequently asked questions about our mission and how you can get involved.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ) );
    
    $wp_customize->add_control( 'jkjaac_faq_description', array(
        'label'    => __( 'Description Text', 'jkjaac' ),
        'section'  => 'jkjaac_faq_section',
        'type'     => 'textarea',
    ) );
    
}
add_action( 'customize_register', 'jkjaac_faq_customizer_settings' );

/* ============================================================================
   FAQ OPEN BY DEFAULT META BOX
   ============================================================================ */

/**
 * Add "Open by Default" Meta Box
 */
function jkjaac_faq_open_default_meta_box() {
    add_meta_box(
        'faq_open_default',
        'Display Options',
        'jkjaac_faq_open_default_callback',
        'faq',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_faq_open_default_meta_box' );

/**
 * Meta Box Callback
 */
function jkjaac_faq_open_default_callback( $post ) {
    wp_nonce_field( 'faq_open_default', 'faq_open_default_nonce' );
    
    $open_default = get_post_meta( $post->ID, '_faq_open_default', true );
    ?>
    <p>
        <label for="faq_open_default">
            <input type="checkbox" id="faq_open_default" name="faq_open_default" value="1" <?php checked( $open_default, '1' ); ?> />
            <strong>Open by default</strong>
        </label>
    </p>
    <p class="description">Check this box if this FAQ item should be expanded when the page loads.</p>
    <?php
}

/**
 * Save Meta Box
 */
function jkjaac_save_faq_open_default( $post_id ) {
    if ( ! isset( $_POST['faq_open_default_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['faq_open_default_nonce'], 'faq_open_default' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $open_default = isset( $_POST['faq_open_default'] ) ? '1' : '0';
    update_post_meta( $post_id, '_faq_open_default', $open_default );
}
add_action( 'save_post', 'jkjaac_save_faq_open_default' );

/* ============================================================================
   FAQ SHORTCODE
   ============================================================================ */

/**
 * Shortcode: [faq_list]
 */

function jkjaac_faq_list_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'count'      => -1,
        'orderby'    => 'menu_order',
        'order'      => 'ASC',
        'open_first' => 'false',
    ), $atts, 'faq_list' );

    $args = array(
        'post_type'      => 'faq',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
    );

    $faqs = new WP_Query( $args );
    
    if ( ! $faqs->have_posts() ) {
        return '<p class="no-faqs-found">No FAQ items found.</p>';
    }

    // Count total FAQs
    $total_faqs = $faqs->found_posts;
    
    // Get customizer settings
    $faq_label       = get_theme_mod( 'jkjaac_faq_label', 'FAQ' );
    $faq_title_line1 = get_theme_mod( 'jkjaac_faq_title_line1', 'Common' );
    $faq_title_line2 = get_theme_mod( 'jkjaac_faq_title_line2', 'Queries' );
    $faq_description = get_theme_mod( 'jkjaac_faq_description', 'At KFM, we believe in transparency and community engagement. Below are answers to frequently asked questions about our mission and how you can get involved.' );

    ob_start();
    ?>
    <section class="faq-section">
        <div class="faq-inner">
            <div class="faq-left sr">
                <p class="s-label"><?php echo esc_html( $faq_label ); ?></p>
                <h2 class="s-title"><?php echo esc_html( $faq_title_line1 ); ?><br /><em><?php echo esc_html( $faq_title_line2 ); ?></em></h2>
                <p><?php echo wp_kses_post( $faq_description ); ?></p>
                <div class="faq-badge">
                    <span class="dot"></span><?php echo esc_html( $total_faqs ); ?> Questions Answered
                </div>
            </div>
            <div class="faq-list sr sr-d1">
                <?php 
                $counter = 0;
                while ( $faqs->have_posts() ) : $faqs->the_post();
                    
                    // Check if this item should be open by default
                    $open_default = get_post_meta( get_the_ID(), '_faq_open_default', true );
                    
                    // Also open first item if open_first parameter is true
                    $is_open = false;
                    if ( $counter === 0 && $atts['open_first'] === 'true' ) {
                        $is_open = true;
                    } elseif ( $open_default === '1' ) {
                        $is_open = true;
                    }
                    
                    $open_class    = $is_open ? ' open' : '';
                    $aria_expanded = $is_open ? 'true' : 'false';
                    $icon_text     = $is_open ? '−' : '+';
                ?>
                    <div class="faq-item">
                        <button class="faq-q<?php echo esc_attr( $open_class ); ?>" type="button" aria-expanded="<?php echo esc_attr( $aria_expanded ); ?>">
                            <span class="faq-q-text"><?php the_title(); ?></span>
                            <span class="faq-icon"><?php echo esc_html( $icon_text ); ?></span>
                        </button>
                        <div class="faq-a<?php echo esc_attr( $open_class ); ?>">
                            <div class="faq-a-inner">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                <?php 
                $counter++;
                endwhile; 
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode( 'faq_list', 'jkjaac_faq_list_shortcode' );


/* ============================================================================
   EVENTS CUSTOM POST TYPE
   ============================================================================ */

/**
 * Register Events Custom Post Type
 */
function jkjaac_register_events_cpt() {
    $labels = array(
        'name'                  => 'Events',
        'singular_name'         => 'Event',
        'menu_name'             => 'Events',
        'add_new'               => 'Add New Event',
        'add_new_item'          => 'Add New Event',
        'edit_item'             => 'Edit Event',
        'new_item'              => 'New Event',
        'view_item'             => 'View Event',
        'search_items'          => 'Search Events',
        'not_found'             => 'No events found',
        'not_found_in_trash'    => 'No events found in Trash',
        'all_items'             => 'All Events',
        'featured_image'        => 'Event Image',
        'set_featured_image'    => 'Set event image',
        'remove_featured_image' => 'Remove event image',
        'use_featured_image'    => 'Use as event image',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'event' ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-calendar-alt',
        'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'show_in_rest'        => true,
    );

    register_post_type( 'event', $args );
}
add_action( 'init', 'jkjaac_register_events_cpt' );

/**
 * Register Event Type Taxonomy (Upcoming/Past)
 */
function jkjaac_register_event_type_taxonomy() {
    $labels = array(
        'name'              => 'Event Types',
        'singular_name'     => 'Event Type',
        'search_items'      => 'Search Event Types',
        'all_items'         => 'All Event Types',
        'parent_item'       => 'Parent Event Type',
        'parent_item_colon' => 'Parent Event Type:',
        'edit_item'         => 'Edit Event Type',
        'update_item'       => 'Update Event Type',
        'add_new_item'      => 'Add New Event Type',
        'new_item_name'     => 'New Event Type Name',
        'menu_name'         => 'Event Types',
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'event-type' ),
        'show_in_rest'      => true,
    );
    
    register_taxonomy( 'event_type', array( 'event' ), $args );
}
add_action( 'init', 'jkjaac_register_event_type_taxonomy' );

/**
 * Create Default Event Type Terms
 */
function jkjaac_create_default_event_terms() {
    $event_types = array(
        'upcoming' => 'Upcoming Event',
        'past'     => 'Past Event'
    );
    
    foreach ( $event_types as $slug => $name ) {
        if ( ! term_exists( $slug, 'event_type' ) ) {
            wp_insert_term( $name, 'event_type', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'after_switch_theme', 'jkjaac_create_default_event_terms' );
add_action( 'admin_init', 'jkjaac_create_default_event_terms' );

/* ============================================================================
   EVENT META BOXES
   ============================================================================ */

/**
 * Add Event Date Meta Box
 */
function jkjaac_add_event_date_metabox() {
    add_meta_box(
        'event_date',
        'Event Date',
        'jkjaac_render_event_date_metabox',
        'event',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_add_event_date_metabox' );

function jkjaac_render_event_date_metabox( $post ) {
    wp_nonce_field( 'event_date_nonce', 'event_date_nonce' );
    
    $event_day = get_post_meta( $post->ID, '_event_day', true );
    $event_month = get_post_meta( $post->ID, '_event_month', true );
    $event_year = get_post_meta( $post->ID, '_event_year', true );
    $event_location = get_post_meta( $post->ID, '_event_location', true );
    $event_subtitle = get_post_meta( $post->ID, '_event_subtitle', true );
    ?>
    <p>
        <label for="event_day"><strong>Day:</strong></label>
        <input type="number" id="event_day" name="event_day" 
               value="<?php echo esc_attr( $event_day ); ?>" 
               placeholder="11" min="1" max="31" style="width:100%; margin-top:5px;" />
    </p>
    <p>
        <label for="event_month"><strong>Month:</strong></label>
        <input type="text" id="event_month" name="event_month" 
               value="<?php echo esc_attr( $event_month ); ?>" 
               placeholder="February" style="width:100%; margin-top:5px;" />
    </p>
    <p>
        <label for="event_year"><strong>Year (Optional):</strong></label>
        <input type="number" id="event_year" name="event_year" 
               value="<?php echo esc_attr( $event_year ); ?>" 
               placeholder="2026" min="2020" max="2030" style="width:100%; margin-top:5px;" />
    </p>
    <p>
        <label for="event_location"><strong>Location:</strong></label>
        <input type="text" id="event_location" name="event_location" 
               value="<?php echo esc_attr( $event_location ); ?>" 
               placeholder="Multiple Cities" style="width:100%; margin-top:5px;" />
    </p>
    <p>
        <label for="event_subtitle"><strong>Subtitle (Short Description):</strong></label>
        <input type="text" id="event_subtitle" name="event_subtitle" 
               value="<?php echo esc_attr( $event_subtitle ); ?>" 
               placeholder="Annual Commemoration" style="width:100%; margin-top:5px;" />
    </p>
    <?php
}

function jkjaac_save_event_date_metabox( $post_id ) {
    if ( ! isset( $_POST['event_date_nonce'] ) || 
         ! wp_verify_nonce( $_POST['event_date_nonce'], 'event_date_nonce' ) ) {
        return;
    }
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    $fields = array( 'event_day', 'event_month', 'event_year', 'event_location', 'event_subtitle' );
    
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post', 'jkjaac_save_event_date_metabox' );

/**
 * Add Event Button Meta Box
 */
function jkjaac_add_event_button_metabox() {
    add_meta_box(
        'event_button',
        'Registration Button',
        'jkjaac_render_event_button_metabox',
        'event',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_add_event_button_metabox' );

function jkjaac_render_event_button_metabox( $post ) {
    wp_nonce_field( 'event_button_nonce', 'event_button_nonce' );
    
    $button_text = get_post_meta( $post->ID, '_event_button_text', true );
    $button_url = get_post_meta( $post->ID, '_event_button_url', true );
    $show_button = get_post_meta( $post->ID, '_event_show_button', true );
    ?>
    <p>
        <label for="event_button_text"><strong>Button Text:</strong></label>
        <input type="text" id="event_button_text" name="event_button_text" 
               value="<?php echo esc_attr( $button_text ); ?>" 
               placeholder="Register Interest" style="width:100%; margin-top:5px;" />
    </p>
    <p>
        <label for="event_button_url"><strong>Button URL:</strong></label>
        <input type="text" id="event_button_url" name="event_button_url" 
               value="<?php echo esc_url( $button_url ); ?>" 
               placeholder="contact" style="width:100%; margin-top:5px;" />
        <small>Enter page slug or full URL</small>
    </p>
    <p>
        <label>
            <input type="checkbox" name="event_show_button" value="1" <?php checked( $show_button, '1' ); ?> />
            <strong>Show Registration Button</strong>
        </label>
    </p>
    <?php
}

function jkjaac_save_event_button_metabox( $post_id ) {
    if ( ! isset( $_POST['event_button_nonce'] ) || 
         ! wp_verify_nonce( $_POST['event_button_nonce'], 'event_button_nonce' ) ) {
        return;
    }
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    if ( isset( $_POST['event_button_text'] ) ) {
        update_post_meta( $post_id, '_event_button_text', sanitize_text_field( $_POST['event_button_text'] ) );
    }
    
    if ( isset( $_POST['event_button_url'] ) ) {
        update_post_meta( $post_id, '_event_button_url', esc_url_raw( $_POST['event_button_url'] ) );
    }
    
    update_post_meta( $post_id, '_event_show_button', isset( $_POST['event_show_button'] ) ? '1' : '' );
}
add_action( 'save_post', 'jkjaac_save_event_button_metabox' );

/**
 * Add Admin Columns for Events
 */
function jkjaac_add_event_admin_columns( $columns ) {
    $new_columns = array();
    
    foreach ( $columns as $key => $value ) {
        if ( $key === 'title' ) {
            $new_columns[ $key ] = $value;
            $new_columns['event_date'] = 'Date';
            $new_columns['event_location'] = 'Location';
        } elseif ( $key === 'taxonomy-event_type' ) {
            $new_columns[ $key ] = $value;
        } else {
            $new_columns[ $key ] = $value;
        }
    }
    
    return $new_columns;
}
add_filter( 'manage_event_posts_columns', 'jkjaac_add_event_admin_columns' );

function jkjaac_display_event_admin_columns( $column, $post_id ) {
    if ( $column === 'event_date' ) {
        $day = get_post_meta( $post_id, '_event_day', true );
        $month = get_post_meta( $post_id, '_event_month', true );
        $year = get_post_meta( $post_id, '_event_year', true );
        
        if ( $day && $month ) {
            echo esc_html( $day . ' ' . $month );
            if ( $year ) {
                echo ' ' . esc_html( $year );
            }
        } else {
            echo '—';
        }
    }
    
    if ( $column === 'event_location' ) {
        $location = get_post_meta( $post_id, '_event_location', true );
        echo $location ? esc_html( $location ) : '—';
    }
}
add_action( 'manage_event_posts_custom_column', 'jkjaac_display_event_admin_columns', 10, 2 );

/* ============================================================================
   EVENTS SHORTCODES
   ============================================================================ */

/**
 * Shortcode: [upcoming_events]
 * Displays upcoming events in the featured date-block layout
 */
function jkjaac_upcoming_events_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'count'   => 3,
        'orderby' => 'menu_order',
        'order'   => 'ASC',
    ), $atts, 'upcoming_events' );
    
    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
        'tax_query'      => array(
            array(
                'taxonomy' => 'event_type',
                'field'    => 'slug',
                'terms'    => 'upcoming',
            ),
        ),
    );
    
    $events = new WP_Query( $args );
    
    if ( ! $events->have_posts() ) {
        return '<p class="no-events-found">No upcoming events found.</p>';
    }
    
    ob_start();
    ?>
    <div class="sr sr-d1 pg-events-2">
        <?php 
        $counter = 0;
        while ( $events->have_posts() ) : $events->the_post();
            $event_day = get_post_meta( get_the_ID(), '_event_day', true );
            $event_month = get_post_meta( get_the_ID(), '_event_month', true );
            $event_location = get_post_meta( get_the_ID(), '_event_location', true );
            $event_subtitle = get_post_meta( get_the_ID(), '_event_subtitle', true );
            $button_text = get_post_meta( get_the_ID(), '_event_button_text', true );
            $button_url = get_post_meta( get_the_ID(), '_event_button_url', true );
            $show_button = get_post_meta( get_the_ID(), '_event_show_button', true );
            
            // Alternate classes for styling
            $container_class = ( $counter % 2 == 0 ) ? 'pg-events-11' : 'pg-events-19';
            $date_container_class = ( $counter % 2 == 0 ) ? 'pg-events-12' : 'pg-events-20';
            $day_class = ( $counter % 2 == 0 ) ? 'pg-events-13' : 'pg-events-21';
            $month_class = ( $counter % 2 == 0 ) ? 'pg-events-14' : 'pg-events-22';
            $subtitle_class = ( $counter % 2 == 0 ) ? 'pg-events-15' : 'pg-events-23';
            $title_class = ( $counter % 2 == 0 ) ? 'pg-events-16' : 'pg-events-24';
            $desc_class = ( $counter % 2 == 0 ) ? 'pg-events-17' : 'pg-events-25';
            $btn_class = ( $counter % 2 == 0 ) ? 'pg-events-18' : 'pg-events-26';
        ?>
            <div class="<?php echo esc_attr( $container_class ); ?>">
                <div class="<?php echo esc_attr( $date_container_class ); ?>">
                    <div class="<?php echo esc_attr( $day_class ); ?>"><?php echo esc_html( $event_day ); ?></div>
                    <div class="<?php echo esc_attr( $month_class ); ?>"><?php echo esc_html( $event_month ); ?></div>
                </div>
                <div>
                    <?php if ( ! empty( $event_subtitle ) ) : ?>
                        <div class="<?php echo esc_attr( $subtitle_class ); ?>">
                            <?php echo esc_html( $event_subtitle ); ?>
                            <?php if ( ! empty( $event_location ) ) : ?>
                                · <?php echo esc_html( $event_location ); ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="<?php echo esc_attr( $title_class ); ?>"><?php the_title(); ?></div>
                    <div class="<?php echo esc_attr( $desc_class ); ?>">
                        <?php echo wp_kses_post( get_the_excerpt() ); ?>
                    </div>
                    <?php if ( $show_button && ! empty( $button_text ) ) : 
                        $btn_url = ! empty( $button_url ) ? jkjaac_page_url( $button_url ) : '#';
                    ?>
                        <a href="<?php echo esc_url( $btn_url ); ?>" class="btn-primary <?php echo esc_attr( $btn_class ); ?>">
                            <?php echo esc_html( $button_text ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php 
        $counter++;
        endwhile; 
        wp_reset_postdata();
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'upcoming_events', 'jkjaac_upcoming_events_shortcode' );

/**
 * Shortcode: [past_events]
 * Displays past events in grid layout
 */
function jkjaac_past_events_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'count'   => 4,
        'orderby' => 'menu_order',
        'order'   => 'DESC',
    ), $atts, 'past_events' );
    
    $args = array(
        'post_type'      => 'event',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
        'tax_query'      => array(
            array(
                'taxonomy' => 'event_type',
                'field'    => 'slug',
                'terms'    => 'past',
            ),
        ),
    );
    
    $events = new WP_Query( $args );
    
    if ( ! $events->have_posts() ) {
        return '<p class="no-events-found">No past events found.</p>';
    }
    
    ob_start();
    ?>
    <div class="sr sr-d1 pg-events-27">
        <?php 
        $counter = 0;
        while ( $events->have_posts() ) : $events->the_post();
            $event_subtitle = get_post_meta( get_the_ID(), '_event_subtitle', true );
            
            // Alternate classes for styling (4 different styles for past events)
            $class_suffix = ( $counter % 4 ) + 1;
            $container_class = 'pg-events-' . ( 28 + ( $class_suffix - 1 ) * 4 );
            $icon_class = 'pg-events-' . ( 29 + ( $class_suffix - 1 ) * 4 );
            $title_class = 'pg-events-' . ( 30 + ( $class_suffix - 1 ) * 4 );
            $desc_class = 'pg-events-' . ( 31 + ( $class_suffix - 1 ) * 4 );
            
            // Default icons for past events
            $icons = array(
                'ri-building-4-line',
                'ri-map-2-line',
                'ri-earth-line',
                'ri-group-line'
            );
            $icon = $icons[ $counter % 4 ];
        ?>
            <div class="<?php echo esc_attr( $container_class ); ?>">
                <div class="<?php echo esc_attr( $icon_class ); ?>">
                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                </div>
                <div class="<?php echo esc_attr( $title_class ); ?>">
                    <?php the_title(); ?>
                    <?php if ( ! empty( $event_subtitle ) ) : ?>
                        <span style="display: block; font-size: 0.9rem; opacity: 0.7; margin-top: 4px;">
                            <?php echo esc_html( $event_subtitle ); ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="<?php echo esc_attr( $desc_class ); ?>">
                    <?php echo wp_kses_post( get_the_excerpt() ); ?>
                </div>
            </div>
        <?php 
        $counter++;
        endwhile; 
        wp_reset_postdata();
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'past_events', 'jkjaac_past_events_shortcode' );



/* ============================================================================
   NEGOTIATION ACCORD POINTS CUSTOM POST TYPE
   ============================================================================ */

/**
 * Register Negotiation Accord Points Custom Post Type
 * For "Key Points of the Historic Accord" section
 */
function jkjaac_register_accord_point_cpt() {
    $labels = array(
        'name'                  => 'Accord Points',
        'singular_name'         => 'Accord Point',
        'menu_name'             => 'Accord Points',
        'add_new'               => 'Add New Point',
        'add_new_item'          => 'Add New Accord Point',
        'edit_item'             => 'Edit Accord Point',
        'new_item'              => 'New Point',
        'view_item'             => 'View Point',
        'search_items'          => 'Search Points',
        'not_found'             => 'No accord points found',
        'not_found_in_trash'    => 'No points found in Trash',
        'all_items'             => 'All Accord Points',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'accord-point' ),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 26,
        'menu_icon'           => 'dashicons-yes-alt',
        'supports'            => array( 'title', 'editor', 'page-attributes' ),
        'show_in_rest'        => true,
    );

    register_post_type( 'accord_point', $args );
}
add_action( 'init', 'jkjaac_register_accord_point_cpt' );

/**
 * Add Point Number Meta Box for Accord Points
 */
function jkjaac_add_accord_point_number_metabox() {
    add_meta_box(
        'accord_point_number',
        'Point Number',
        'jkjaac_render_accord_point_number_metabox',
        'accord_point',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_add_accord_point_number_metabox' );

function jkjaac_render_accord_point_number_metabox( $post ) {
    wp_nonce_field( 'accord_point_number_nonce', 'accord_point_number_nonce' );
    $point_number = get_post_meta( $post->ID, '_accord_point_number', true );
    ?>
    <p>
        <label for="accord_point_number"><strong>Point Number:</strong></label>
        <input type="text" id="accord_point_number" name="accord_point_number" 
               value="<?php echo esc_attr( $point_number ); ?>" 
               placeholder="01" style="width:100%; margin-top:5px;" />
    </p>
    <p class="description">Enter the point number (e.g., 01, 02, 03)</p>
    <?php
}

function jkjaac_save_accord_point_number_metabox( $post_id ) {
    if ( ! isset( $_POST['accord_point_number_nonce'] ) || 
         ! wp_verify_nonce( $_POST['accord_point_number_nonce'], 'accord_point_number_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    
    if ( isset( $_POST['accord_point_number'] ) ) {
        update_post_meta( $post_id, '_accord_point_number', sanitize_text_field( $_POST['accord_point_number'] ) );
    }
}
add_action( 'save_post', 'jkjaac_save_accord_point_number_metabox' );

/**
 * Shortcode: [accord_points]
 * Displays the Key Points of the Historic Accord
 */
function jkjaac_accord_points_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'count'   => -1,
        'orderby' => 'meta_value',
        'order'   => 'ASC',
    ), $atts, 'accord_points' );

    $args = array(
        'post_type'      => 'accord_point',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => 'meta_value',
        'meta_key'       => '_accord_point_number',
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
    );

    $points = new WP_Query( $args );
    
    if ( ! $points->have_posts() ) {
        return '<p class="no-points-found">No accord points found.</p>';
    }

    ob_start();
    ?>
    <div class="grid-view">
        <?php while ( $points->have_posts() ) : $points->the_post(); 
            $point_number = get_post_meta( get_the_ID(), '_accord_point_number', true );
            // Format with leading zero if needed
            if ( $point_number && strlen( $point_number ) === 1 ) {
                $point_number = '0' . $point_number;
            }
        ?>
            <div class="demand-item">
                <div class="demand-number"><?php echo esc_html( $point_number ?: '—' ); ?></div>
                <div class="demand-content">
                    <h4><?php the_title(); ?></h4>
                    <div class="demand-description">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'accord_points', 'jkjaac_accord_points_shortcode' );

/* ============================================================================
   IMPLEMENTATION TRACKER ITEMS CUSTOM POST TYPE
   ============================================================================ */

/**
 * Register Implementation Tracker Items CPT
 */
function jkjaac_register_impl_tracker_cpt() {
    $labels = array(
        'name'                  => 'Tracker Items',
        'singular_name'         => 'Tracker Item',
        'menu_name'             => 'Impl. Tracker',
        'add_new'               => 'Add New Item',
        'add_new_item'          => 'Add New Tracker Item',
        'edit_item'             => 'Edit Tracker Item',
        'new_item'              => 'New Item',
        'view_item'             => 'View Item',
        'search_items'          => 'Search Items',
        'not_found'             => 'No tracker items found',
        'not_found_in_trash'    => 'No items found in Trash',
        'all_items'             => 'All Tracker Items',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'impl-tracker' ),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 27,
        'menu_icon'           => 'dashicons-chart-line',
        'supports'            => array( 'title', 'page-attributes' ),
        'show_in_rest'        => true,
    );

    register_post_type( 'impl_tracker', $args );
}
add_action( 'init', 'jkjaac_register_impl_tracker_cpt' );

/**
 * Register Tracker Status Taxonomy
 */
function jkjaac_register_tracker_status_taxonomy() {
    $labels = array(
        'name'              => 'Statuses',
        'singular_name'     => 'Status',
        'search_items'      => 'Search Statuses',
        'all_items'         => 'All Statuses',
        'edit_item'         => 'Edit Status',
        'update_item'       => 'Update Status',
        'add_new_item'      => 'Add New Status',
        'new_item_name'     => 'New Status Name',
        'menu_name'         => 'Statuses',
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'tracker-status' ),
        'show_in_rest'      => true,
    );
    
    register_taxonomy( 'tracker_status', array( 'impl_tracker' ), $args );
}
add_action( 'init', 'jkjaac_register_tracker_status_taxonomy' );

/**
 * Create default tracker status terms
 */
function jkjaac_create_default_tracker_terms() {
    $statuses = array(
        'implemented' => '✓ Implemented',
        'partial'     => '⚠️ Partial',
        'pending'     => '⏳ Pending',
        'disputed'    => '⚠️ Disputed',
    );
    
    foreach ( $statuses as $slug => $name ) {
        if ( ! term_exists( $slug, 'tracker_status' ) ) {
            wp_insert_term( $name, 'tracker_status', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'after_switch_theme', 'jkjaac_create_default_tracker_terms' );
add_action( 'admin_init', 'jkjaac_create_default_tracker_terms' );

/**
 * Add Tracker Item Description Meta Box
 */
function jkjaac_add_tracker_description_metabox() {
    add_meta_box(
        'tracker_description',
        'Item Description',
        'jkjaac_render_tracker_description_metabox',
        'impl_tracker',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_add_tracker_description_metabox' );

function jkjaac_render_tracker_description_metabox( $post ) {
    wp_nonce_field( 'tracker_description_nonce', 'tracker_description_nonce' );
    $description = get_post_meta( $post->ID, '_tracker_description', true );
    ?>
    <p>
        <label for="tracker_description"><strong>Description / Details:</strong></label>
        <textarea id="tracker_description" name="tracker_description" 
                  rows="3" style="width:100%; margin-top:5px;"><?php echo esc_textarea( $description ); ?></textarea>
    </p>
    <p class="description">Brief description shown in the tracker list</p>
    <?php
}

function jkjaac_save_tracker_description_metabox( $post_id ) {
    if ( ! isset( $_POST['tracker_description_nonce'] ) || 
         ! wp_verify_nonce( $_POST['tracker_description_nonce'], 'tracker_description_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    
    if ( isset( $_POST['tracker_description'] ) ) {
        update_post_meta( $post_id, '_tracker_description', sanitize_textarea_field( $_POST['tracker_description'] ) );
    }
}
add_action( 'save_post', 'jkjaac_save_tracker_description_metabox' );

/**
 * Shortcode: [implementation_tracker]
 */
function jkjaac_implementation_tracker_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'orderby' => 'menu_order',
        'order'   => 'ASC',
    ), $atts, 'implementation_tracker' );

    // Get all tracker items
    $args = array(
        'post_type'      => 'impl_tracker',
        'posts_per_page' => -1,
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
    );

    $items = new WP_Query( $args );
    
    if ( ! $items->have_posts() ) {
        return '<p class="no-items-found">No tracker items found.</p>';
    }

    // Separate items by status
    $implemented = array();
    $disputed_pending = array();
    
    while ( $items->have_posts() ) {
        $items->the_post();
        $status_terms = wp_get_post_terms( get_the_ID(), 'tracker_status' );
        $status_slug = ! empty( $status_terms ) ? $status_terms[0]->slug : '';
        $description = get_post_meta( get_the_ID(), '_tracker_description', true );
        
        $item_data = array(
            'title'       => get_the_title(),
            'description' => $description,
            'status_slug' => $status_slug,
            'status_name' => ! empty( $status_terms ) ? $status_terms[0]->name : '',
        );
        
        if ( $status_slug === 'implemented' ) {
            $implemented[] = $item_data;
        } else {
            $disputed_pending[] = $item_data;
        }
    }
    wp_reset_postdata();

    // Get quote from page meta or use default
    global $post;
    $tracker_quote = get_post_meta( $post->ID, '_jkjaac_tracker_quote', true );
    $tracker_cite = get_post_meta( $post->ID, '_jkjaac_tracker_cite', true );
    
    if ( empty( $tracker_quote ) ) {
        $tracker_quote = "Under the current circumstances, further negotiations with the federal or Azad government are not possible, because government actions are giving rise to doubts and suspicions rather than restoring confidence.";
    }
    if ( empty( $tracker_cite ) ) {
        $tracker_cite = "— Shaukat Nawaz Mir, January 2026";
    }

    ob_start();
    ?>
    <div class="impl-grid">
        <!-- Implemented Column -->
        <div class="content reveal">
            <h3><i class="ri-checkbox-line"></i> Confirmed Implemented</h3>
            <?php foreach ( $implemented as $item ) : ?>
                <div class="impl-item">
                    <span class="check"><i class="ri-checkbox-line"></i></span>
                    <p>
                        <strong><?php echo esc_html( $item['title'] ); ?></strong>
                        <?php if ( ! empty( $item['description'] ) ) : ?>
                            — <?php echo esc_html( $item['description'] ); ?>
                        <?php endif; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Disputed/Pending Column -->
        <div class="content reveal">
            <h3><i class="ri-timer-line"></i> Disputed or Pending</h3>
            <?php foreach ( $disputed_pending as $item ) : 
                $icon_class = 'ri-error-warning-line';
                $span_class = 'check';
                if ( $item['status_slug'] === 'pending' ) {
                    $icon_class = 'ri-timer-line';
                    $span_class = 'danger';
                } elseif ( $item['status_slug'] === 'disputed' ) {
                    $icon_class = 'ri-error-warning-line';
                    $span_class = 'warning';
                } elseif ( $item['status_slug'] === 'partial' ) {
                    $icon_class = 'ri-timer-line';
                    $span_class = 'warning';
                }
            ?>
                <div class="impl-item">
                    <span class="<?php echo esc_attr( $span_class ); ?>"><i class="<?php echo esc_attr( $icon_class ); ?>"></i></span>
                    <p>
                        <strong><?php echo esc_html( $item['title'] ); ?></strong>
                        <?php if ( ! empty( $item['description'] ) ) : ?>
                            — <?php echo esc_html( $item['description'] ); ?>
                        <?php endif; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Quote -->
        <div class="short-info">
            <blockquote class="short-info-block">
                "<?php echo esc_html( $tracker_quote ); ?>"
            </blockquote>
            <cite><?php echo esc_html( $tracker_cite ); ?></cite>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'implementation_tracker', 'jkjaac_implementation_tracker_shortcode' );

/* ============================================================================
   NEGOTIATION ROUNDS CUSTOM POST TYPE
   ============================================================================ */

/**
 * Register Negotiation Rounds Custom Post Type
 * For "Three Rounds of Talks" history section
 */
function jkjaac_register_negotiation_round_cpt() {
    $labels = array(
        'name'                  => 'Negotiation Rounds',
        'singular_name'         => 'Negotiation Round',
        'menu_name'             => 'Negotiation Rounds',
        'add_new'               => 'Add New Round',
        'add_new_item'          => 'Add New Negotiation Round',
        'edit_item'             => 'Edit Round',
        'new_item'              => 'New Round',
        'view_item'             => 'View Round',
        'search_items'          => 'Search Rounds',
        'not_found'             => 'No rounds found',
        'not_found_in_trash'    => 'No rounds found in Trash',
        'all_items'             => 'All Rounds',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'negotiation-round' ),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 28,
        'menu_icon'           => 'dashicons-schedule',
        'supports'            => array( 'title', 'editor', 'page-attributes' ),
        'show_in_rest'        => true,
    );

    register_post_type( 'negotiation_round', $args );
}
add_action( 'init', 'jkjaac_register_negotiation_round_cpt' );

/**
 * Register Round Outcome Taxonomy
 */
function jkjaac_register_round_outcome_taxonomy() {
    $labels = array(
        'name'              => 'Outcomes',
        'singular_name'     => 'Outcome',
        'search_items'      => 'Search Outcomes',
        'all_items'         => 'All Outcomes',
        'edit_item'         => 'Edit Outcome',
        'update_item'       => 'Update Outcome',
        'add_new_item'      => 'Add New Outcome',
        'new_item_name'     => 'New Outcome Name',
        'menu_name'         => 'Outcomes',
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'round-outcome' ),
        'show_in_rest'      => true,
    );
    
    register_taxonomy( 'round_outcome', array( 'negotiation_round' ), $args );
}
add_action( 'init', 'jkjaac_register_round_outcome_taxonomy' );

/**
 * Create default outcome terms
 */
function jkjaac_create_default_outcome_terms() {
    $outcomes = array(
        'failed'   => 'Failed',
        'partial'  => 'Partial',
        'success'  => 'Success',
    );
    
    foreach ( $outcomes as $slug => $name ) {
        if ( ! term_exists( $slug, 'round_outcome' ) ) {
            wp_insert_term( $name, 'round_outcome', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'after_switch_theme', 'jkjaac_create_default_outcome_terms' );
add_action( 'admin_init', 'jkjaac_create_default_outcome_terms' );

/**
 * Add Round Meta Boxes
 */
function jkjaac_add_round_metaboxes() {
    add_meta_box(
        'round_details',
        'Round Details',
        'jkjaac_render_round_details_metabox',
        'negotiation_round',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_add_round_metaboxes' );

function jkjaac_render_round_details_metabox( $post ) {
    wp_nonce_field( 'round_details_nonce', 'round_details_nonce' );
    
    $round_date = get_post_meta( $post->ID, '_round_date', true );
    $round_location = get_post_meta( $post->ID, '_round_location', true );
    $round_subtitle = get_post_meta( $post->ID, '_round_subtitle', true );
    $outcome_text = get_post_meta( $post->ID, '_round_outcome_text', true );
    
    ?>
    <style>
        .round-meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        .round-meta-field {
            margin-bottom: 15px;
        }
        .round-meta-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #e0e0e8;
        }
        .round-meta-field input,
        .round-meta-field textarea {
            width: 100%;
            padding: 8px 10px;
            background: #2a2222;
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 6px;
            color: #fff;
        }
        .round-meta-field small {
            display: block;
            margin-top: 4px;
            color: #86757b;
        }
    </style>
    
    <div class="round-meta-grid">
        <div class="round-meta-field">
            <label for="round_date">Date / Period</label>
            <input type="text" id="round_date" name="round_date" 
                   value="<?php echo esc_attr( $round_date ); ?>" 
                   placeholder="November 2023" />
            <small>e.g., "November 2023" or "December 2024 (Kohala)"</small>
        </div>
        
        <div class="round-meta-field">
            <label for="round_location">Location (Optional)</label>
            <input type="text" id="round_location" name="round_location" 
                   value="<?php echo esc_attr( $round_location ); ?>" 
                   placeholder="Muzaffarabad" />
        </div>
    </div>
    
    <div class="round-meta-field">
        <label for="round_subtitle">Subtitle / Agreement Name</label>
        <input type="text" id="round_subtitle" name="round_subtitle" 
               value="<?php echo esc_attr( $round_subtitle ); ?>" 
               placeholder="AJK Government Assurances" />
        <small>The secondary title shown below the date</small>
    </div>
    
    <div class="round-meta-field">
        <label for="round_outcome_text">Outcome Text</label>
        <input type="text" id="round_outcome_text" name="round_outcome_text" 
               value="<?php echo esc_attr( $outcome_text ); ?>" 
               placeholder="Failed — No implementation" />
        <small>The outcome message displayed at the bottom of the card</small>
    </div>
    
    <div class="round-meta-field">
        <label>Body Content</label>
        <p class="description" style="margin-bottom: 8px;">Use the main WordPress editor below to enter the detailed description of this negotiation round.</p>
    </div>
    <?php
}

function jkjaac_save_round_details_metabox( $post_id ) {
    if ( ! isset( $_POST['round_details_nonce'] ) || 
         ! wp_verify_nonce( $_POST['round_details_nonce'], 'round_details_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    
    $fields = array( 'round_date', 'round_location', 'round_subtitle', 'round_outcome_text' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
}
add_action( 'save_post', 'jkjaac_save_round_details_metabox' );

/**
 * Add Order Column to Admin List
 */
function jkjaac_add_round_order_column( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
        if ( $key === 'title' ) {
            $new_columns['round_date'] = 'Date';
        }
        $new_columns[ $key ] = $value;
    }
    return $new_columns;
}
add_filter( 'manage_negotiation_round_posts_columns', 'jkjaac_add_round_order_column' );

function jkjaac_display_round_order_column( $column, $post_id ) {
    if ( $column === 'round_date' ) {
        $date = get_post_meta( $post_id, '_round_date', true );
        echo $date ? esc_html( $date ) : '—';
    }
}
add_action( 'manage_negotiation_round_posts_custom_column', 'jkjaac_display_round_order_column', 10, 2 );

/**
 * Shortcode: [negotiation_rounds]
 * Displays the Three Rounds of Talks history section
 */
function jkjaac_negotiation_rounds_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'count'      => 3,
        'orderby'    => 'menu_order',
        'order'      => 'ASC',
        'show_label' => 'true',
        'label'      => '',
        'title1'     => '',
        'title2'     => '',
        'desc'       => '',
    ), $atts, 'negotiation_rounds' );

    // Get page meta for header if not passed in shortcode
    global $post;
    if ( empty( $atts['label'] ) && $post ) {
        $atts['label'] = get_post_meta( $post->ID, '_jkjaac_history_label', true );
    }
    if ( empty( $atts['title1'] ) && $post ) {
        $atts['title1'] = get_post_meta( $post->ID, '_jkjaac_history_title_line1', true );
    }
    if ( empty( $atts['title2'] ) && $post ) {
        $atts['title2'] = get_post_meta( $post->ID, '_jkjaac_history_title_line2', true );
    }
    if ( empty( $atts['desc'] ) && $post ) {
        $atts['desc'] = get_post_meta( $post->ID, '_jkjaac_history_description', true );
    }
    
    // Defaults if still empty
    if ( empty( $atts['label'] ) ) $atts['label'] = 'Negotiation History';
    if ( empty( $atts['title1'] ) ) $atts['title1'] = 'Three Rounds';
    if ( empty( $atts['title2'] ) ) $atts['title2'] = 'of Talks';
    if ( empty( $atts['desc'] ) ) {
        $atts['desc'] = 'The path to the October 2025 agreement was paved with failed negotiations, broken promises, and government bad faith. Understanding this history is essential to understanding why JKJAAC continues to press for full implementation.';
    }

    $args = array(
        'post_type'      => 'negotiation_round',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
    );

    $rounds = new WP_Query( $args );
    
    if ( ! $rounds->have_posts() ) {
        return '<p class="no-rounds-found">No negotiation rounds found.</p>';
    }

    // Get hide setting
    $hide_history = $post ? get_post_meta( $post->ID, '_jkjaac_hide_history_section', true ) : false;
    if ( $hide_history && $atts['show_label'] === 'true' ) {
        // If hidden and we're showing the full section (not just cards), return empty
        return '';
    }

    ob_start();
    
    // Only show header if show_label is true
    if ( $atts['show_label'] === 'true' ) :
    ?>
    <section class="process">
      <div class="s-inner">
        <div class="sr">
          <p class="s-label"><?php echo esc_html( $atts['label'] ); ?></p>
          <h2 class="s-title"><?php echo esc_html( $atts['title1'] ); ?><br /><em><?php echo esc_html( $atts['title2'] ); ?></em></h2>
          <p class="s-desc"><?php echo wp_kses_post( $atts['desc'] ); ?></p>
        </div>
        <div class="legacy-grid">
    <?php else : ?>
        <div class="legacy-grid">
    <?php endif; ?>
    
    <?php 
    while ( $rounds->have_posts() ) : $rounds->the_post();
        $round_date = get_post_meta( get_the_ID(), '_round_date', true );
        $round_subtitle = get_post_meta( get_the_ID(), '_round_subtitle', true );
        $outcome_text = get_post_meta( get_the_ID(), '_round_outcome_text', true );
        
        // Get outcome taxonomy
        $outcome_terms = wp_get_post_terms( get_the_ID(), 'round_outcome' );
        $outcome_slug = ! empty( $outcome_terms ) ? $outcome_terms[0]->slug : '';
        
        // Determine outcome class
        $outcome_class = '';
        if ( $outcome_slug === 'failed' ) {
            $outcome_class = '';
        } elseif ( $outcome_slug === 'partial' ) {
            $outcome_class = 'warning';
        } elseif ( $outcome_slug === 'success' ) {
            $outcome_class = 'success';
        }
    ?>
        <div class="legacy-card sr in">
            <div class="pg-leadership-28"><?php echo esc_html( $round_date ); ?></div>
            <div class="lg-title"><?php echo esc_html( $round_subtitle ); ?></div>
            <div class="lg-body">
                <?php the_content(); ?>
            </div>
            <div class="protest-outcome <?php echo esc_attr( $outcome_class ); ?>">
                Outcome: <?php echo esc_html( $outcome_text ); ?>
            </div>
        </div>
    <?php endwhile; wp_reset_postdata(); ?>
    
        </div>
    <?php if ( $atts['show_label'] === 'true' ) : ?>
      </div>
    </section>
    <?php endif; ?>
    
    <?php
    return ob_get_clean();
}
add_shortcode( 'negotiation_rounds', 'jkjaac_negotiation_rounds_shortcode' );


/* ============================================================================
   PROTEST EVENTS CUSTOM POST TYPE (Timeline Items)
   ============================================================================ */

/**
 * Register Protest Events Custom Post Type
 */
function jkjaac_register_protest_event_cpt() {
    $labels = array(
        'name'                  => 'Protest Events',
        'singular_name'         => 'Protest Event',
        'menu_name'             => 'Protest Events',
        'add_new'               => 'Add New Event',
        'add_new_item'          => 'Add New Protest Event',
        'edit_item'             => 'Edit Event',
        'new_item'              => 'New Event',
        'view_item'             => 'View Event',
        'search_items'          => 'Search Events',
        'not_found'             => 'No events found',
        'not_found_in_trash'    => 'No events found in Trash',
        'all_items'             => 'All Events',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'protest-event' ),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 29,
        'menu_icon'           => 'dashicons-calendar',
        'supports'            => array( 'title', 'editor', 'page-attributes' ),
        'show_in_rest'        => true,
    );

    register_post_type( 'protest_event', $args );
}
add_action( 'init', 'jkjaac_register_protest_event_cpt' );

/**
 * Register Event Phase Taxonomy
 */
function jkjaac_register_protest_phase_taxonomy() {
    $labels = array(
        'name'              => 'Protest Phases',
        'singular_name'     => 'Phase',
        'search_items'      => 'Search Phases',
        'all_items'         => 'All Phases',
        'edit_item'         => 'Edit Phase',
        'update_item'       => 'Update Phase',
        'add_new_item'      => 'Add New Phase',
        'new_item_name'     => 'New Phase Name',
        'menu_name'         => 'Phases',
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'protest-phase' ),
        'show_in_rest'      => true,
    );
    
    register_taxonomy( 'protest_phase', array( 'protest_event' ), $args );
}
add_action( 'init', 'jkjaac_register_protest_phase_taxonomy' );

/**
 * Register Event Outcome Taxonomy
 */
function jkjaac_register_protest_outcome_taxonomy() {
    $labels = array(
        'name'              => 'Outcomes',
        'singular_name'     => 'Outcome',
        'search_items'      => 'Search Outcomes',
        'all_items'         => 'All Outcomes',
        'edit_item'         => 'Edit Outcome',
        'update_item'       => 'Update Outcome',
        'add_new_item'      => 'Add New Outcome',
        'new_item_name'     => 'New Outcome Name',
        'menu_name'         => 'Outcomes',
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'protest-outcome' ),
        'show_in_rest'      => true,
    );
    
    register_taxonomy( 'protest_outcome', array( 'protest_event' ), $args );
}
add_action( 'init', 'jkjaac_register_protest_outcome_taxonomy' );

/**
 * Create default taxonomy terms
 */
function jkjaac_create_default_protest_terms() {
    // Phases
    $phases = array(
        'origins'    => '2022-2023 Origins',
        'uprising'   => '2024 Uprising',
        'lockdown'   => '2025 Lockdown',
    );
    
    foreach ( $phases as $slug => $name ) {
        if ( ! term_exists( $slug, 'protest_phase' ) ) {
            wp_insert_term( $name, 'protest_phase', array( 'slug' => $slug ) );
        }
    }
    
    // Outcomes
    $outcomes = array(
        'victory'    => 'Victory',
        'crackdown'  => 'Crackdown',
        'formation'  => 'Formation',
        'catalyst'   => 'Catalyst',
        'blackout'   => 'Blackout',
        'martyrs'    => 'Martyrs',
        'agreement'  => 'Agreement',
        'charter'    => 'New Charter',
    );
    
    foreach ( $outcomes as $slug => $name ) {
        if ( ! term_exists( $slug, 'protest_outcome' ) ) {
            wp_insert_term( $name, 'protest_outcome', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'after_switch_theme', 'jkjaac_create_default_protest_terms' );
add_action( 'admin_init', 'jkjaac_create_default_protest_terms' );

/**
 * Add Protest Event Meta Boxes
 */
function jkjaac_add_protest_event_metaboxes() {
    add_meta_box(
        'protest_event_details',
        'Event Details',
        'jkjaac_render_protest_event_metabox',
        'protest_event',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_add_protest_event_metaboxes' );

function jkjaac_render_protest_event_metabox( $post ) {
    wp_nonce_field( 'protest_event_nonce', 'protest_event_nonce' );
    
    $event_year = get_post_meta( $post->ID, '_event_year', true );
    $event_month = get_post_meta( $post->ID, '_event_month', true );
    $event_badge = get_post_meta( $post->ID, '_event_badge', true );
    $event_title = get_post_meta( $post->ID, '_event_title', true );
    $event_paragraphs = get_post_meta( $post->ID, '_event_paragraphs', true );
    $event_outcome_text = get_post_meta( $post->ID, '_event_outcome_text', true );
    $is_victory = get_post_meta( $post->ID, '_event_is_victory', true );
    
    if ( ! is_array( $event_paragraphs ) ) {
        $event_paragraphs = array( '', '' );
    }
    ?>
    <style>
        .protest-meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }
        .protest-meta-field {
            margin-bottom: 15px;
        }
        .protest-meta-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #e0e0e8;
        }
        .protest-meta-field input,
        .protest-meta-field textarea,
        .protest-meta-field select {
            width: 100%;
            padding: 8px 10px;
            background: #2a2222;
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 6px;
            color: #fff;
        }
        .protest-meta-field small {
            display: block;
            margin-top: 4px;
            color: #86757b;
        }
        .victory-checkbox {
            margin-top: 15px;
        }
        .victory-checkbox label {
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
    
    <div class="protest-meta-grid">
        <div class="protest-meta-field">
            <label for="event_year">Year</label>
            <input type="text" id="event_year" name="event_year" 
                   value="<?php echo esc_attr( $event_year ); ?>" 
                   placeholder="2024" />
        </div>
        
        <div class="protest-meta-field">
            <label for="event_month">Month/Day</label>
            <input type="text" id="event_month" name="event_month" 
                   value="<?php echo esc_attr( $event_month ); ?>" 
                   placeholder="May 8" />
            <small>e.g., "May", "May 8", "Sep–Oct"</small>
        </div>
        
        <div class="protest-meta-field">
            <label for="event_badge">Badge Text</label>
            <input type="text" id="event_badge" name="event_badge" 
                   value="<?php echo esc_attr( $event_badge ); ?>" 
                   placeholder="Uprising" />
        </div>
    </div>
    
    <div class="protest-meta-field">
        <label for="event_title">Event Title (Large Text)</label>
        <input type="text" id="event_title" name="event_title" 
               value="<?php echo esc_attr( $event_title ); ?>" 
               placeholder="Six-Day Mass Uprising Begins — Long March Called" 
               style="font-size: 16px;" />
    </div>
    
    <div class="protest-meta-field">
        <label>Paragraph 1</label>
        <textarea name="event_paragraphs[0]" rows="4"><?php echo esc_textarea( isset( $event_paragraphs[0] ) ? $event_paragraphs[0] : '' ); ?></textarea>
    </div>
    
    <div class="protest-meta-field">
        <label>Paragraph 2 (Optional)</label>
        <textarea name="event_paragraphs[1]" rows="4"><?php echo esc_textarea( isset( $event_paragraphs[1] ) ? $event_paragraphs[1] : '' ); ?></textarea>
    </div>
    
    <div class="protest-meta-field">
        <label for="event_outcome_text">Outcome Text</label>
        <textarea id="event_outcome_text" name="event_outcome_text" rows="3"><?php echo esc_textarea( $event_outcome_text ); ?></textarea>
    </div>
    
    <div class="victory-checkbox">
        <label>
            <input type="checkbox" name="event_is_victory" value="1" <?php checked( $is_victory, '1' ); ?> />
            <strong>Victory Style</strong> (Gold accent on date badge)
        </label>
    </div>
    
    <p class="description" style="margin-top: 15px; color: #86757b;">
        <i class="ri-information-line"></i> 
        Select the appropriate Phase and Outcome from the taxonomies in the right sidebar.
    </p>
    <?php
}

function jkjaac_save_protest_event_metabox( $post_id ) {
    if ( ! isset( $_POST['protest_event_nonce'] ) || 
         ! wp_verify_nonce( $_POST['protest_event_nonce'], 'protest_event_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    
    $fields = array( 'event_year', 'event_month', 'event_badge', 'event_title', 'event_outcome_text' );
    foreach ( $fields as $field ) {
        if ( isset( $_POST[ $field ] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[ $field ] ) );
        }
    }
    
    if ( isset( $_POST['event_paragraphs'] ) && is_array( $_POST['event_paragraphs'] ) ) {
        $paragraphs = array_map( 'sanitize_textarea_field', $_POST['event_paragraphs'] );
        update_post_meta( $post_id, '_event_paragraphs', $paragraphs );
    }
    
    update_post_meta( $post_id, '_event_is_victory', 
        ( isset( $_POST['event_is_victory'] ) && $_POST['event_is_victory'] === '1' ) ? '1' : '' );
}
add_action( 'save_post', 'jkjaac_save_protest_event_metabox' );

/**
 * Add Order Column to Admin List
 */
function jkjaac_add_protest_event_columns( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
        if ( $key === 'title' ) {
            $new_columns['event_date'] = 'Date';
        }
        $new_columns[ $key ] = $value;
    }
    return $new_columns;
}
add_filter( 'manage_protest_event_posts_columns', 'jkjaac_add_protest_event_columns' );

function jkjaac_display_protest_event_columns( $column, $post_id ) {
    if ( $column === 'event_date' ) {
        $year = get_post_meta( $post_id, '_event_year', true );
        $month = get_post_meta( $post_id, '_event_month', true );
        echo $year ? esc_html( $year . ' ' . $month ) : '—';
    }
}
add_action( 'manage_protest_event_posts_custom_column', 'jkjaac_display_protest_event_columns', 10, 2 );

/* ============================================================================
   PROTEST STATS CUSTOM POST TYPE
   ============================================================================ */

/**
 * Register Protest Stats CPT
 */
function jkjaac_register_protest_stat_cpt() {
    $labels = array(
        'name'                  => 'Protest Stats',
        'singular_name'         => 'Stat',
        'menu_name'             => 'Protest Stats',
        'add_new'               => 'Add New Stat',
        'add_new_item'          => 'Add New Stat',
        'edit_item'             => 'Edit Stat',
        'new_item'              => 'New Stat',
        'view_item'             => 'View Stat',
        'search_items'          => 'Search Stats',
        'not_found'             => 'No stats found',
        'not_found_in_trash'    => 'No stats found in Trash',
        'all_items'             => 'All Stats',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'protest-stat' ),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 30,
        'menu_icon'           => 'dashicons-chart-bar',
        'supports'            => array( 'title', 'page-attributes' ),
        'show_in_rest'        => true,
    );

    register_post_type( 'protest_stat', $args );
}
add_action( 'init', 'jkjaac_register_protest_stat_cpt' );

/**
 * Register Stat Group Taxonomy
 */
function jkjaac_register_stat_group_taxonomy() {
    $labels = array(
        'name'              => 'Stat Groups',
        'singular_name'     => 'Group',
        'search_items'      => 'Search Groups',
        'all_items'         => 'All Groups',
        'edit_item'         => 'Edit Group',
        'update_item'       => 'Update Group',
        'add_new_item'      => 'Add New Group',
        'new_item_name'     => 'New Group Name',
        'menu_name'         => 'Groups',
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'stat-group' ),
        'show_in_rest'      => true,
    );
    
    register_taxonomy( 'stat_group', array( 'protest_stat' ), $args );
}
add_action( 'init', 'jkjaac_register_stat_group_taxonomy' );

/**
 * Create default stat groups
 */
function jkjaac_create_default_stat_groups() {
    $groups = array(
        '2024-stats'  => '2024 Protest Stats',
        '2025-impact' => '2025 Impact Cards',
    );
    
    foreach ( $groups as $slug => $name ) {
        if ( ! term_exists( $slug, 'stat_group' ) ) {
            wp_insert_term( $name, 'stat_group', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'after_switch_theme', 'jkjaac_create_default_stat_groups' );
add_action( 'admin_init', 'jkjaac_create_default_stat_groups' );

/**
 * Add Stat Meta Box
 */
function jkjaac_add_protest_stat_metabox() {
    add_meta_box(
        'protest_stat_details',
        'Stat Details',
        'jkjaac_render_protest_stat_metabox',
        'protest_stat',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_add_protest_stat_metabox' );

function jkjaac_render_protest_stat_metabox( $post ) {
    wp_nonce_field( 'protest_stat_nonce', 'protest_stat_nonce' );
    
    $stat_number = get_post_meta( $post->ID, '_stat_number', true );
    $stat_description = get_post_meta( $post->ID, '_stat_description', true );
    $card_style = get_post_meta( $post->ID, '_stat_card_style', true );
    ?>
    <div class="protest-meta-field">
        <label for="stat_number">Number / Value</label>
        <input type="text" id="stat_number" name="stat_number" 
               value="<?php echo esc_attr( $stat_number ); ?>" 
               placeholder="₨ 23B or 10" style="font-size: 18px;" />
    </div>
    
    <div class="protest-meta-field">
        <label for="stat_description">Description</label>
        <textarea id="stat_description" name="stat_description" rows="3"><?php echo esc_textarea( $stat_description ); ?></textarea>
        <small>Brief description shown below the number</small>
    </div>
    
    <div class="protest-meta-field">
        <label for="stat_card_style">Card Style</label>
        <select id="stat_card_style" name="stat_card_style">
            <option value="explore" <?php selected( $card_style, 'explore' ); ?>>Explore Link Style (Stats Band)</option>
            <option value="gov" <?php selected( $card_style, 'gov' ); ?>>Gov Card Style (Impact Cards)</option>
        </select>
    </div>
    
    <div class="protest-meta-field">
        <label>Title (Label)</label>
        <input type="text" value="<?php echo esc_attr( $post->post_title ); ?>" disabled style="background: #1a1a1a;" />
        <small>The post title is used as the stat label</small>
    </div>
    <?php
}

function jkjaac_save_protest_stat_metabox( $post_id ) {
    if ( ! isset( $_POST['protest_stat_nonce'] ) || 
         ! wp_verify_nonce( $_POST['protest_stat_nonce'], 'protest_stat_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    
    if ( isset( $_POST['stat_number'] ) ) {
        update_post_meta( $post_id, '_stat_number', sanitize_text_field( $_POST['stat_number'] ) );
    }
    if ( isset( $_POST['stat_description'] ) ) {
        update_post_meta( $post_id, '_stat_description', sanitize_textarea_field( $_POST['stat_description'] ) );
    }
    if ( isset( $_POST['stat_card_style'] ) ) {
        update_post_meta( $post_id, '_stat_card_style', sanitize_text_field( $_POST['stat_card_style'] ) );
    }
}
add_action( 'save_post', 'jkjaac_save_protest_stat_metabox' );

/* ============================================================================
   MOVEMENT FEATURES CUSTOM POST TYPE (Anatomy Cards)
   ============================================================================ */

/**
 * Register Movement Features CPT
 */
function jkjaac_register_movement_feature_cpt() {
    $labels = array(
        'name'                  => 'Movement Features',
        'singular_name'         => 'Feature',
        'menu_name'             => 'Movement Features',
        'add_new'               => 'Add New Feature',
        'add_new_item'          => 'Add New Feature',
        'edit_item'             => 'Edit Feature',
        'new_item'              => 'New Feature',
        'view_item'             => 'View Feature',
        'search_items'          => 'Search Features',
        'not_found'             => 'No features found',
        'not_found_in_trash'    => 'No features found in Trash',
        'all_items'             => 'All Features',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'movement-feature' ),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 31,
        'menu_icon'           => 'dashicons-grid-view',
        'supports'            => array( 'title', 'editor', 'page-attributes' ),
        'show_in_rest'        => true,
    );

    register_post_type( 'movement_feature', $args );
}
add_action( 'init', 'jkjaac_register_movement_feature_cpt' );

/**
 * Add Feature Icon Meta Box
 */
function jkjaac_add_feature_icon_metabox() {
    add_meta_box(
        'feature_icon',
        'Feature Icon',
        'jkjaac_render_feature_icon_metabox',
        'movement_feature',
        'side',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_add_feature_icon_metabox' );

function jkjaac_render_feature_icon_metabox( $post ) {
    wp_nonce_field( 'feature_icon_nonce', 'feature_icon_nonce' );
    $icon = get_post_meta( $post->ID, '_feature_icon', true );
    
    $available_icons = array(
        'ri-flashlight-line' => 'Flashlight',
        'ri-earth-line' => 'Earth/Global',
        'ri-police-badge-line' => 'Police Badge',
        'ri-scales-3-line' => 'Scales (Justice)',
        'ri-group-line' => 'Group/People',
        'ri-megaphone-line' => 'Megaphone',
        'ri-flag-line' => 'Flag',
        'ri-shield-line' => 'Shield',
        'ri-heart-line' => 'Heart',
        'ri-star-line' => 'Star',
        'ri-chat-1-line' => 'Chat',
        'ri-smartphone-line' => 'Smartphone',
        'ri-building-4-line' => 'Building',
        'ri-user-community-line' => 'Community',
        'ri-hand-heart-line' => 'Hand Heart',
    );
    ?>
    <p>
        <label for="feature_icon"><strong>Select Icon:</strong></label>
        <select name="feature_icon" id="feature_icon" style="width: 100%; margin-top: 8px;">
            <option value="">— Select Icon —</option>
            <?php foreach ( $available_icons as $value => $label ) : ?>
                <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $icon, $value ); ?>>
                    <?php echo esc_html( $label ); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p class="description">Icon displayed at the top of the feature card</p>
    
    <div style="margin-top: 15px; padding: 12px; background: rgba(212, 175, 55, 0.05); border-radius: 6px; text-align: center;">
        <p style="margin: 0 0 8px; color: #86757b; font-size: 12px;">Preview</p>
        <div style="font-size: 32px; color: #d4af37;">
            <i class="<?php echo ! empty( $icon ) ? esc_attr( $icon ) : 'ri-star-line'; ?>"></i>
        </div>
    </div>
    <?php
}

function jkjaac_save_feature_icon_metabox( $post_id ) {
    if ( ! isset( $_POST['feature_icon_nonce'] ) || 
         ! wp_verify_nonce( $_POST['feature_icon_nonce'], 'feature_icon_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    
    if ( isset( $_POST['feature_icon'] ) ) {
        update_post_meta( $post_id, '_feature_icon', sanitize_text_field( $_POST['feature_icon'] ) );
    }
}
add_action( 'save_post', 'jkjaac_save_feature_icon_metabox' );

/* ============================================================================
   SHORTCODES FOR STRUGGLES PAGE
   ============================================================================ */

/**
 * Shortcode: [protest_timeline]
 */
function jkjaac_protest_timeline_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'phase'     => '',
        'count'     => -1,
        'orderby'   => 'menu_order',
        'order'     => 'ASC',
        'container_class' => 'protest-content',
    ), $atts, 'protest_timeline' );

    $args = array(
        'post_type'      => 'protest_event',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
    );

    if ( ! empty( $atts['phase'] ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'protest_phase',
                'field'    => 'slug',
                'terms'    => explode( ',', $atts['phase'] ),
            ),
        );
    }

    $events = new WP_Query( $args );
    
    if ( ! $events->have_posts() ) {
        return '<p class="no-events-found">No protest events found.</p>';
    }

    $counter = 0;
    ob_start();
    ?>
    <div class="<?php echo esc_attr( $atts['container_class'] ); ?>">
        <?php while ( $events->have_posts() ) : $events->the_post(); 
            $event_year = get_post_meta( get_the_ID(), '_event_year', true );
            $event_month = get_post_meta( get_the_ID(), '_event_month', true );
            $event_badge = get_post_meta( get_the_ID(), '_event_badge', true );
            $event_title = get_post_meta( get_the_ID(), '_event_title', true );
            $event_paragraphs = get_post_meta( get_the_ID(), '_event_paragraphs', true );
            $event_outcome_text = get_post_meta( get_the_ID(), '_event_outcome_text', true );
            $is_victory = get_post_meta( get_the_ID(), '_event_is_victory', true );
            
            $delay_class = $counter > 0 ? ' sr-d' . ( $counter + 1 ) : '';
        ?>
            <div class="decl-list sr<?php echo esc_attr( $delay_class ); ?>">
                <div class="decl-item">
                    <div class="protest-date <?php echo $is_victory ? 'victory' : ''; ?>">
                        <div class="protest-year"><?php echo esc_html( $event_year ); ?></div>
                        <div class="protest-month"><?php echo esc_html( $event_month ); ?></div>
                        <div class="protest-badge"><?php echo esc_html( $event_badge ); ?></div>
                    </div>
                    <div class="content">
                        <div class="decl-n">
                            <?php echo esc_html( $event_title ); ?>
                        </div>
                        <?php if ( ! empty( $event_paragraphs[0] ) ) : ?>
                            <div class="decl-t">
                                <?php echo wp_kses_post( $event_paragraphs[0] ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $event_paragraphs[1] ) ) : ?>
                            <div class="decl-t">
                                <?php echo wp_kses_post( $event_paragraphs[1] ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( ! empty( $event_outcome_text ) ) : ?>
                            <div class="protest-outcome">
                                <?php echo wp_kses_post( $event_outcome_text ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php 
        $counter++;
        endwhile; 
        wp_reset_postdata();
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'protest_timeline', 'jkjaac_protest_timeline_shortcode' );

/**
 * Shortcode: [protest_stats]
 */
function jkjaac_protest_stats_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'group'    => '',
        'count'    => -1,
        'orderby'  => 'menu_order',
        'order'    => 'ASC',
        'layout'   => '',
    ), $atts, 'protest_stats' );

    $args = array(
        'post_type'      => 'protest_stat',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
    );

    if ( ! empty( $atts['group'] ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'stat_group',
                'field'    => 'slug',
                'terms'    => $atts['group'],
            ),
        );
    }

    $stats = new WP_Query( $args );
    
    if ( ! $stats->have_posts() ) {
        return '<p class="no-stats-found">No stats found.</p>';
    }

    ob_start();
    
    // Determine layout based on group or attribute
    $use_gov_layout = ( $atts['layout'] === 'gov' || $atts['group'] === '2025-impact' );
    
    if ( $use_gov_layout ) :
    ?>
        <div class="gov-grid fr">
            <?php 
            $counter = 0;
            while ( $stats->have_posts() ) : $stats->the_post();
                $stat_number = get_post_meta( get_the_ID(), '_stat_number', true );
                $stat_description = get_post_meta( get_the_ID(), '_stat_description', true );
                $delay_class = $counter > 0 ? ' sr-d' . $counter : '';
            ?>
                <div class="gov-card sr<?php echo esc_attr( $delay_class ); ?>">
                    <div class="gov-card-num"><?php echo esc_html( $stat_number ); ?></div>
                    <h3 class="gov-card-title"><?php the_title(); ?></h3>
                    <p class="gov-card-body"><?php echo wp_kses_post( $stat_description ); ?></p>
                </div>
            <?php 
            $counter++;
            endwhile; 
            ?>
        </div>
    <?php else : ?>
        <div class="explore-links sr sr-d1">
            <?php while ( $stats->have_posts() ) : $stats->the_post();
                $stat_number = get_post_meta( get_the_ID(), '_stat_number', true );
            ?>
                <div class="explore-link">
                    <div class="explore-link-tag"><?php echo esc_html( $stat_number ); ?></div>
                    <div class="explore-link-name"><?php the_title(); ?></div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;
    
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'protest_stats', 'jkjaac_protest_stats_shortcode' );

/**
 * Shortcode: [movement_features]
 */
function jkjaac_movement_features_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'count'    => 4,
        'orderby'  => 'menu_order',
        'order'    => 'ASC',
    ), $atts, 'movement_features' );

    $args = array(
        'post_type'      => 'movement_feature',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => sanitize_text_field( $atts['orderby'] ),
        'order'          => sanitize_text_field( $atts['order'] ),
        'post_status'    => 'publish',
    );

    $features = new WP_Query( $args );
    
    if ( ! $features->have_posts() ) {
        return '<p class="no-features-found">No features found.</p>';
    }

    ob_start();
    ?>
    <div class="sr sr-d1 pg-press_media-33 in str">
        <?php 
        $base = 34;
        while ( $features->have_posts() ) : $features->the_post();
            $icon = get_post_meta( get_the_ID(), '_feature_icon', true );
            if ( empty( $icon ) ) {
                $icon = 'ri-star-line';
            }
            
            $wrapper_class = 'pg-press_media-' . $base;
            $icon_class = 'pg-press_media-' . ( $base + 1 );
            $title_class = 'pg-press_media';
            $desc_class = 'pg-press_media-' . ( $base + 3 );
        ?>
            <div class="<?php echo esc_attr( $wrapper_class ); ?>">
                <div class="<?php echo esc_attr( $icon_class ); ?>">
                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
                </div>
                <div class="<?php echo esc_attr( $title_class ); ?>"><?php the_title(); ?></div>
                <p class="<?php echo esc_attr( $desc_class ); ?>">
                    <?php the_content(); ?>
                </p>
            </div>
        <?php 
        $base += 4;
        endwhile; 
        wp_reset_postdata();
        ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'movement_features', 'jkjaac_movement_features_shortcode' );



/* ============================================================================
   GALLERY ITEMS CUSTOM POST TYPE
   ============================================================================ */

/**
 * Register Gallery Items Custom Post Type
 */
function jkjaac_register_gallery_cpt() {
    $labels = array(
        'name'                  => 'Gallery Items',
        'singular_name'         => 'Gallery Item',
        'menu_name'             => 'Gallery',
        'add_new'               => 'Add New Photo',
        'add_new_item'          => 'Add New Gallery Item',
        'edit_item'             => 'Edit Gallery Item',
        'new_item'              => 'New Item',
        'view_item'             => 'View Item',
        'search_items'          => 'Search Gallery',
        'not_found'             => 'No gallery items found',
        'not_found_in_trash'    => 'No items found in Trash',
        'all_items'             => 'All Photos',
        'featured_image'        => 'Gallery Image',
        'set_featured_image'    => 'Set gallery image',
        'remove_featured_image' => 'Remove image',
        'use_featured_image'    => 'Use as gallery image',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array( 'slug' => 'gallery-item' ),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 32,
        'menu_icon'           => 'dashicons-format-gallery',
        'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
        'show_in_rest'        => true,
    );

    register_post_type( 'gallery_item', $args );
}
add_action( 'init', 'jkjaac_register_gallery_cpt' );

/**
 * Register Gallery Category Taxonomy
 */
function jkjaac_register_gallery_category_taxonomy() {
    $labels = array(
        'name'              => 'Categories',
        'singular_name'     => 'Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Categories',
    );
    
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'gallery-category' ),
        'show_in_rest'      => true,
    );
    
    register_taxonomy( 'gallery_category', array( 'gallery_item' ), $args );
}
add_action( 'init', 'jkjaac_register_gallery_category_taxonomy' );

/**
 * Create default gallery categories
 */
function jkjaac_create_default_gallery_categories() {
    $categories = array(
        'protest'   => 'Protest',
        'leaders'   => 'Leaders',
        'members'   => 'Members',
        'heritage'  => 'Heritage',
        'banners'   => 'Banners',
        'advocacy'  => 'Advocacy',
        'gallery'   => 'Gallery',
    );
    
    foreach ( $categories as $slug => $name ) {
        if ( ! term_exists( $slug, 'gallery_category' ) ) {
            wp_insert_term( $name, 'gallery_category', array( 'slug' => $slug ) );
        }
    }
}
add_action( 'after_switch_theme', 'jkjaac_create_default_gallery_categories' );
add_action( 'admin_init', 'jkjaac_create_default_gallery_categories' );

/**
 * Add Gallery Item Meta Boxes
 */
function jkjaac_add_gallery_item_metaboxes() {
    add_meta_box(
        'gallery_item_details',
        'Photo Details',
        'jkjaac_render_gallery_item_metabox',
        'gallery_item',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'jkjaac_add_gallery_item_metaboxes' );

function jkjaac_render_gallery_item_metabox( $post ) {
    wp_nonce_field( 'gallery_item_nonce', 'gallery_item_nonce' );
    
    $photo_location = get_post_meta( $post->ID, '_photo_location', true );
    $photo_description = get_post_meta( $post->ID, '_photo_description', true );
    $featured_photo = get_post_meta( $post->ID, '_featured_photo', true );
    ?>
    <style>
        .gallery-meta-field {
            margin-bottom: 20px;
        }
        .gallery-meta-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .gallery-meta-field input,
        .gallery-meta-field textarea,
        .gallery-meta-field select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid rgba(235, 185, 24, 0.61);
            border-radius: 6px;
        }
 
        .gallery-meta-field input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin: 0;
        }
        
        .gallery-meta-field small {
            display: block;
            margin-top: 6px;
        }
        .gallery-preview {
            margin-top: 15px;
            padding: 15px;
            background: rgba(212, 175, 55, 0.05);
            border-radiurgba(5, 5, 4, 0.05)
            text-align: center;
        }
        .gallery-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 6px;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }
        .gallery-preview p {
            margin: 10px 0 0;
        }
    </style>
    
    <div class="gallery-meta-field">
        <label for="photo_location">Location</label>
        <input type="text" id="photo_location" name="photo_location" 
               value="<?php echo esc_attr( $photo_location ); ?>" 
               placeholder="Azad Kashmir" />
        <small>Where was this photo taken? (e.g., "Muzaffarabad", "Azad Kashmir")</small>
    </div>
    
    <div class="gallery-meta-field">
        <label for="photo_description">Description</label>
        <textarea id="photo_description" name="photo_description" rows="3" 
                  placeholder="Brief description of this photo..."><?php echo esc_textarea( $photo_description ); ?></textarea>
        <small>Shown in the lightbox. Keep it concise.</small>
    </div>
    
    <div class="gallery-meta-field">
        <label>
            <input type="checkbox" name="featured_photo" value="1" <?php checked( $featured_photo, '1' ); ?> />
            <strong>Feature this photo</strong>
        </label>
        <small>Featured photos appear first in the gallery</small>
    </div>
    
    <div class="gallery-preview">
        <p><strong>Featured Image Preview</strong></p>
        <?php if ( has_post_thumbnail( $post->ID ) ) : ?>
            <?php echo get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'max-width:100%; height:auto;' ) ); ?>
            <p>Set/change the featured image in the right sidebar.</p>
        <?php else : ?>
            <p style="color: #d4af37;">⚠️ Please set a featured image for this gallery item.</p>
        <?php endif; ?>
    </div>
    
    <p class="description" style="margin-top: 15px; color: #86757b;">
        <i class="ri-information-line"></i> 
        The post title is used as the photo title. Select categories from the right sidebar.
    </p>
    <?php
}

function jkjaac_save_gallery_item_metabox( $post_id ) {
    if ( ! isset( $_POST['gallery_item_nonce'] ) || 
         ! wp_verify_nonce( $_POST['gallery_item_nonce'], 'gallery_item_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;
    
    if ( isset( $_POST['photo_location'] ) ) {
        update_post_meta( $post_id, '_photo_location', sanitize_text_field( $_POST['photo_location'] ) );
    }
    if ( isset( $_POST['photo_description'] ) ) {
        update_post_meta( $post_id, '_photo_description', sanitize_textarea_field( $_POST['photo_description'] ) );
    }
    update_post_meta( $post_id, '_featured_photo', 
        ( isset( $_POST['featured_photo'] ) && $_POST['featured_photo'] === '1' ) ? '1' : '' );
}
add_action( 'save_post', 'jkjaac_save_gallery_item_metabox' );

/**
 * Add Category Column to Admin List
 */
function jkjaac_add_gallery_admin_columns( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $value ) {
        if ( $key === 'title' ) {
            $new_columns['featured_image'] = 'Photo';
        }
        $new_columns[ $key ] = $value;
    }
    return $new_columns;
}
add_filter( 'manage_gallery_item_posts_columns', 'jkjaac_add_gallery_admin_columns' );

function jkjaac_display_gallery_admin_columns( $column, $post_id ) {
    if ( $column === 'featured_image' ) {
        if ( has_post_thumbnail( $post_id ) ) {
            echo get_the_post_thumbnail( $post_id, array( 60, 60 ), array( 'style' => 'border-radius:4px;' ) );
        } else {
            echo '<span style="color: #d4af37;">No image</span>';
        }
    }
}
add_action( 'manage_gallery_item_posts_custom_column', 'jkjaac_display_gallery_admin_columns', 10, 2 );

/* ============================================================================
   GALLERY SHORTCODE
   ============================================================================ */

/**
 * Shortcode: [jkjaac_gallery]
 * Displays the masonry gallery with filters
 */
function jkjaac_gallery_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'count'        => -1,
        'orderby'      => 'meta_value menu_order',
        'order'        => 'DESC',
        'default_cols' => 4,
    ), $atts, 'jkjaac_gallery' );

    // Get all gallery items
    $args = array(
        'post_type'      => 'gallery_item',
        'posts_per_page' => intval( $atts['count'] ),
        'orderby'        => array(
            'meta_value_num' => 'DESC',
            'menu_order'     => 'ASC',
        ),
        'meta_key'       => '_featured_photo',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    );

    $items = new WP_Query( $args );
    
    if ( ! $items->have_posts() ) {
        return '<div class="masonry-wrap reletive-pos">
      <div class="no-image">
        <p class="">No gallery items found.</p>
        <div style="color: #f6f6ff; padding: 10px; background: rgba(212, 175, 55, 0.05); border-radius: 6px;margin-top:1rem;">
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;padding-bottom:8px;"></i>
                <strong>Add Photos:</strong> Go to <strong>Dashboard → Gallery → Add New</strong>.</p>
                
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;padding-bottom:8px;"></i>
                <strong>Required:</strong> Set a featured image and title for each photo.</p>
                
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;padding-bottom:8px;"></i>
                <strong>Categories:</strong> Assign categories to enable filtering. Categories are auto-created on theme activation.</p>
                
                <p><i class="ri-information-line" style="color: #d4af37; margin-right: 8px;padding-bottom:8px;"></i>
                <strong>Featured Photos:</strong> Check "Feature this photo" to show it at the top of the gallery.</p>
            </div>
      </div>
    </div>';
    }

    // Get all categories that have items
    $used_categories = array();
    $all_items = array();
    $category_counts = array();
    
    while ( $items->have_posts() ) {
        $items->the_post();
        $categories = wp_get_post_terms( get_the_ID(), 'gallery_category' );
        
        $item_data = array(
            'id'          => get_the_ID(),
            'title'       => get_the_title(),
            'image_id'    => get_post_thumbnail_id( get_the_ID() ),
            'image_url'   => get_the_post_thumbnail_url( get_the_ID(), 'medium' ),
            'image_full'  => get_the_post_thumbnail_url( get_the_ID(), 'large' ),
            'location'    => get_post_meta( get_the_ID(), '_photo_location', true ),
            'description' => get_post_meta( get_the_ID(), '_photo_description', true ),
            'featured'    => get_post_meta( get_the_ID(), '_featured_photo', true ),
            'categories'  => $categories,
        );
        
        $all_items[] = $item_data;
        
        foreach ( $categories as $cat ) {
            $used_categories[ $cat->slug ] = $cat;
            if ( ! isset( $category_counts[ $cat->slug ] ) ) {
                $category_counts[ $cat->slug ] = 0;
            }
            $category_counts[ $cat->slug ]++;
        }
    }
    wp_reset_postdata();
    
    $total_count = count( $all_items );
    
    ob_start();
    ?>
    
    <div class="gallery-controls">
      <div class="filter-pills">
        <span class="filter-label">Filter</span>
        <button class="filter-pill active" data-filter="all">All (<?php echo $total_count; ?>)</button>
        <?php foreach ( $used_categories as $slug => $cat ) : ?>
            <button class="filter-pill" data-filter="<?php echo esc_attr( $slug ); ?>">
                <?php echo esc_html( $cat->name ); ?>
            </button>
        <?php endforeach; ?>
      </div>
      <div class="controls-right">
        <span class="gallery-count" id="galleryCount"><?php echo $total_count; ?> photos</span>
        <div class="col-btns">
          <button class="col-btn" data-cols="2" title="2 columns">
            <svg viewBox="0 0 12 12">
              <rect x="0" y="0" width="5" height="12" rx="1" />
              <rect x="7" y="0" width="5" height="12" rx="1" />
            </svg>
          </button>
          <button class="col-btn" data-cols="3" title="3 columns">
            <svg viewBox="0 0 12 12">
              <rect x="0" y="0" width="3" height="12" rx="1" />
              <rect x="4.5" y="0" width="3" height="12" rx="1" />
              <rect x="9" y="0" width="3" height="12" rx="1" />
            </svg>
          </button>
          <button class="col-btn <?php echo $atts['default_cols'] == 4 ? 'active' : ''; ?>" data-cols="4" title="4 columns">
            <svg viewBox="0 0 12 12">
              <rect x="0" y="0" width="2" height="12" rx="1" />
              <rect x="3.3" y="0" width="2" height="12" rx="1" />
              <rect x="6.6" y="0" width="2" height="12" rx="1" />
              <rect x="10" y="0" width="2" height="12" rx="1" />
            </svg>
          </button>
          <button class="col-btn" data-cols="5" title="5 columns">
            <svg viewBox="0 0 12 12">
              <rect x="0" y="0" width="1.6" height="12" rx="1" />
              <rect x="2.6" y="0" width="1.6" height="12" rx="1" />
              <rect x="5.2" y="0" width="1.6" height="12" rx="1" />
              <rect x="7.8" y="0" width="1.6" height="12" rx="1" />
              <rect x="10.4" y="0" width="1.6" height="12" rx="1" />
            </svg>
          </button>
        </div>
      </div>
    </div>
    
    <div class="masonry-wrap">
      <div class="masonry-grid" id="galleryGrid">
        <?php foreach ( $all_items as $item ) : 
            $cat_slugs = array_map( function( $cat ) { return $cat->slug; }, $item['categories'] );
            $cat_names = array_map( function( $cat ) { return $cat->name; }, $item['categories'] );
            $primary_cat = ! empty( $cat_names ) ? $cat_names[0] : 'Gallery';
            $cat_classes = implode( ' ', $cat_slugs );
            $cat_display = implode( ' · ', $cat_names );
            
            if ( empty( $item['image_url'] ) ) {
                continue;
            }
        ?>
            <div
              class="pin-card"
              data-cat="<?php echo esc_attr( $cat_classes ); ?>"
              data-title="<?php echo esc_attr( $item['title'] ); ?>"
              data-loc="<?php echo esc_attr( $item['location'] ); ?>"
              data-desc="<?php echo esc_attr( $item['description'] ); ?>"
              data-full="<?php echo esc_url( $item['image_full'] ?: $item['image_url'] ); ?>">
              <div class="pin-img-wrap">
                <img
                  src="<?php echo esc_url( $item['image_url'] ); ?>"
                  alt="<?php echo esc_attr( $item['title'] ); ?>"
                  loading="lazy"
                  onerror="this.closest('.pin-img-wrap').classList.add('img-err')" />
                <div class="pin-overlay">
                  <div class="pin-ov-cat"><?php echo esc_html( $cat_display ); ?></div>
                  <div class="pin-ov-title"><?php echo esc_html( $item['title'] ); ?></div>
                  <div class="pin-ov-loc"><?php echo esc_html( $item['location'] ); ?></div>
                </div>
                <div class="pin-tag"><?php echo esc_html( $primary_cat ); ?></div>
                <div class="pin-zoom"><i class="ri-global-line"></i></div>
              </div>
              <div class="pin-footer">
                <span class="pin-footer-title"><?php echo esc_html( $item['title'] ); ?></span>
                <span class="pin-footer-loc"><?php echo esc_html( $item['location'] ); ?></span>
              </div>
            </div>
        <?php endforeach; ?>
      </div>
      <div class="gallery-empty" id="galleryEmpty">
        <p>No photos match this filter.</p>
      </div>
    </div>

    <div class="lightbox" id="lightbox" role="dialog" aria-modal="true">
      <div class="lb-inner">
        <div class="lb-img-side" id="lbImgWrap"></div>
        <div class="lb-info-side">
          <div>
            <div class="lb-cat" id="lbCat"></div>
            <div class="lb-title" id="lbTitle"></div>
            <div class="lb-loc" id="lbLoc"></div>
            <div class="lb-desc" id="lbDesc"></div>
          </div>
          <div class="lb-controls">
            <div class="lb-counter" id="lbCounter"></div>
            <div class="lb-nav">
              <button class="lb-nav-btn" id="lbPrev">
                <i class="ri-arrow-left-line"></i> Prev
              </button>
              <button class="lb-nav-btn" id="lbNext">
                Next <i class="ri-arrow-right-line"></i>
              </button>
            </div>
          </div>
        </div>
        <button class="lb-close" id="lbClose" aria-label="Close">
          <i class="ri-close-line"></i>
        </button>
      </div>
    </div>
    
    <?php
    return ob_get_clean();
}
add_shortcode( 'jkjaac_gallery', 'jkjaac_gallery_shortcode' );