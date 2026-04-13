<?php
/**
 * JKJAAC Theme Functions
 *
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ============================================================================
   CORE FILES & DEPENDENCIES
   ============================================================================ */

require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/custom-meta-boxes.php';

// Customizer Files
require_once get_template_directory() . '/inc/customizer/helpers.php';
require_once get_template_directory() . '/inc/customizer/class-customizer-base.php';
require_once get_template_directory() . '/inc/customizer/charter-customizer.php';
require_once get_template_directory() . '/inc/customizer/header-customizer.php';
require_once get_template_directory() . '/inc/customizer/contact-customizer.php';
require_once get_template_directory() . '/inc/customizer/footer-customizer.php';


/* ============================================================================
   1. THEME SETUP & SUPPORT
   ============================================================================ */

function jkjaac_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'custom-logo' );

    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'jkjaac' ),
        'footer'  => __( 'Footer Navigation', 'jkjaac' ),
    ) );
}
add_action( 'after_setup_theme', 'jkjaac_theme_setup' );

/* ============================================================================
   2. FRONTEND ASSETS (CSS & JS)
   ============================================================================ */

function jkjaac_enqueue_assets() {
    $theme_uri = get_template_directory_uri();
    $version   = wp_get_theme()->get( 'Version' );

    wp_enqueue_style( 'jkjaac-google-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:wght@300;400;500&family=Josefin+Sans:wght@300;400;600&display=swap', array(), null );
    wp_enqueue_style( 'remixicon', 'https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css', array(), '4.6.0' );

    if ( is_page( 'contact' ) || is_page_template( 'page-contact.php' ) ) {
        wp_enqueue_style( 'leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4' );
        wp_enqueue_script( 'leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true );
    }

    wp_enqueue_style( 'jkjaac-bundle', $theme_uri . '/css/bundle.css', array( 'jkjaac-google-fonts', 'remixicon' ), $version );
    wp_enqueue_style( 'jkjaac-style', get_stylesheet_uri(), array( 'jkjaac-bundle' ), $version );
    wp_enqueue_script( 'jkjaac-bundle', $theme_uri . '/js/bundle.js', array(), $version, true );

    wp_localize_script( 'jkjaac-bundle', 'jkjaacData', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'jkjaac_nonce' ),
        'homeUrl' => home_url( '/' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'jkjaac_enqueue_assets' );

/* ============================================================================
   3. PERFORMANCE OPTIMIZATIONS
   ============================================================================ */

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/* ============================================================================
   4. AJAX HANDLERS
   ============================================================================ */

function jkjaac_handle_contact_form() {
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'jkjaac_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Security verification failed.' ) );
    }

    $fname   = sanitize_text_field( wp_unslash( $_POST['fname'] ?? '' ) );
    $lname   = sanitize_text_field( wp_unslash( $_POST['lname'] ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $phone   = sanitize_text_field( wp_unslash( $_POST['phone'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );
    $subject = sanitize_text_field( wp_unslash( $_POST['subject'] ?? 'General' ) );

    $errors = array();
    
    if ( empty( $fname ) ) $errors['fname'] = 'First name is required.';
    if ( empty( $lname ) ) $errors['lname'] = 'Last name is required.';
    if ( empty( $email ) ) $errors['email'] = 'Email address is required.';
    elseif ( ! is_email( $email ) ) $errors['email'] = 'Please enter a valid email address.';
    if ( empty( $message ) ) $errors['message'] = 'Message is required.';
    elseif ( strlen( $message ) < 10 ) $errors['message'] = 'Message must be at least 10 characters.';
    
    if ( ! empty( $phone ) ) {
        $phone_regex = '/^[\+]?[(]?[0-9]{1,4}[)]?[-\s\.]?[(]?[0-9]{1,4}[)]?[-\s\.]?[0-9]{3,4}[-\s\.]?[0-9]{3,4}$/';
        if ( ! preg_match( $phone_regex, $phone ) ) {
            $errors['phone'] = 'Please enter a valid phone number.';
        }
    }

    if ( ! empty( $errors ) ) {
        wp_send_json_error( array( 'message' => 'Please correct the errors below.', 'errors' => $errors ) );
    }

    $to = get_theme_mod( 'jkjaac_form_recipient_email', get_option( 'admin_email' ) );
    $site_name = get_bloginfo( 'name' );
    $subject_line = sprintf( '[%s Contact] %s — %s %s', $site_name, $subject, $fname, $lname );
    
    $body = "Name: {$fname} {$lname}\nEmail: {$email}\n";
    if ( ! empty( $phone ) ) $body .= "Phone: {$phone}\n";
    $body .= "Subject: {$subject}\nIP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $body .= "Time: " . current_time( 'Y-m-d H:i:s' ) . "\n\nMessage:\n{$message}\n\n";
    $body .= "---\nThis message was sent from the contact form on {$site_name}.";
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        "From: {$site_name} <{$to}>",
        "Reply-To: {$fname} {$lname} <{$email}>",
    );

    $sent = wp_mail( $to, $subject_line, $body, $headers );

    if ( $sent ) {
        wp_send_json_success( array( 'message' => 'Message sent successfully.' ) );
    } else {
        wp_send_json_error( array( 'message' => 'Failed to send message. Please try again or contact us directly.' ) );
    }
}
add_action( 'wp_ajax_jkjaac_contact', 'jkjaac_handle_contact_form' );
add_action( 'wp_ajax_nopriv_jkjaac_contact', 'jkjaac_handle_contact_form' );

function jkjaac_handle_newsletter() {
    check_ajax_referer( 'jkjaac_nonce', 'nonce' );

    $email = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Invalid email address.' ) );
    }

    $subscribers = get_option( 'jkjaac_newsletter_subscribers', array() );

    if ( in_array( $email, $subscribers, true ) ) {
        wp_send_json_error( array( 'message' => 'duplicate' ) );
    }

    $subscribers[] = $email;
    update_option( 'jkjaac_newsletter_subscribers', $subscribers );

    wp_mail( get_option( 'admin_email' ), '[JKJAAC] New Newsletter Subscriber', "New subscriber: {$email}" );

    wp_send_json_success( array( 'message' => '✓ Subscribed! Thank you.' ) );
}
add_action( 'wp_ajax_jkjaac_newsletter', 'jkjaac_handle_newsletter' );
add_action( 'wp_ajax_nopriv_jkjaac_newsletter', 'jkjaac_handle_newsletter' );

/* ============================================================================
   5. CUSTOMIZER INITIALIZATION
   ============================================================================ */

add_action( 'customize_register', 'jkjaac_charter_customizer_init' );
add_action( 'customize_register', 'jkjaac_header_customizer_init' );
add_action( 'customize_register', 'jkjaac_contact_customizer_init' );
add_action( 'customize_register', 'jkjaac_footer_customizer_init' );

/* ============================================================================
   6. ADMIN AREA ASSETS & CUSTOMIZATIONS
   ============================================================================ */

function jkjaac_admin_styles( $hook ) {
    $admin_pages = array( 'post.php', 'post-new.php' );
    if ( ! in_array( $hook, $admin_pages ) ) return;

    wp_enqueue_style( 'jkjaac-admin-fonts', 'https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=Josefin+Sans:wght@300;400;600&display=swap', array(), null );
    wp_enqueue_style( 'remixicon-admin', 'https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css', array(), '4.6.0' );

    $css_file_path = get_template_directory() . '/css/meta-box.css';
    $css_version = file_exists( $css_file_path ) ? filemtime( $css_file_path ) : '1.0.0';

    wp_enqueue_style( 'jkjaac-tabbed-meta-box', get_template_directory_uri() . '/css/meta-box.css', array( 'jkjaac-admin-fonts', 'remixicon-admin' ), $css_version );
}
add_action( 'admin_enqueue_scripts', 'jkjaac_admin_styles' );

function jkjaac_admin_scripts( $hook ) {
    global $post;
    $admin_pages = array( 'post.php', 'post-new.php' );
    if ( ! in_array( $hook, $admin_pages ) ) return;

    if ( isset( $post ) && $post->post_type === 'page' ) {
        // Enqueue media uploader
        wp_enqueue_media();
        
        // Enqueue media uploader script
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_style( 'thickbox' );
    }
}
add_action( 'admin_enqueue_scripts', 'jkjaac_admin_scripts' );

function jkjaac_remove_old_meta_boxes() {
    remove_meta_box( 'jkjaac_hero_meta', 'page', 'normal' );
    remove_meta_box( 'jkjaac_pull_quote_meta', 'page', 'normal' );
    remove_meta_box( 'jkjaac_cta_meta', 'page', 'normal' );
}
add_action( 'admin_menu', 'jkjaac_remove_old_meta_boxes', 999 );

/* ============================================================================
   7. DYNAMIC ADMIN COLOR SCHEME
   ============================================================================ */

function jkjaac_dynamic_admin_styles() {
    $screen = get_current_screen();
    if ( ! $screen || ! in_array( $screen->id, array( 'page', 'post' ) ) ) return;

    $current_user = wp_get_current_user();
    $admin_color = get_user_option( 'admin_color', $current_user->ID );

    $color_schemes = array(
        'fresh' => array( 'primary' => '#2271b1' ),
        'light' => array( 'primary' => '#04a4cc' ),
        'modern' => array( 'primary' => '#3858e9' ),
        'blue' => array( 'primary' => '#e14d43' ),
        'coffee' => array( 'primary' => '#c7a589' ),
        'ectoplasm' => array( 'primary' => '#a3b745' ),
        'midnight' => array( 'primary' => '#e14d43' ),
        'ocean' => array( 'primary' => '#9ebaa0' ),
        'sunrise' => array( 'primary' => '#dd823b' ),
    );

    $colors = isset( $color_schemes[ $admin_color ] ) ? $color_schemes[ $admin_color ] : $color_schemes['fresh'];
    $primary = $colors['primary'];
    $primary_rgb = jkjaac_hex_to_rgb( $primary );
    $rgb_string = implode( ', ', $primary_rgb );

    echo "<style id='jkjaac-dynamic-colors'>
        :root {
            --jkjaac-primary: {$primary};
            --jkjaac-primary-rgb: {$rgb_string};
        }
        .jkjaac-section-header h3,
        .jkjaac-hero-header h2,
        .jkjaac-accent-gold {
            color: var(--jkjaac-primary) !important;
        }
        .jkjaac-field input:focus,
        .jkjaac-field textarea:focus {
            border-color: var(--jkjaac-primary) !important;
            box-shadow: 0 0 0 2px rgba({$rgb_string}, 0.15) !important;
        }
        .jkjaac-tab-btn.active {
            color: var(--jkjaac-primary) !important;
            border-bottom-color: var(--jkjaac-primary) !important;
        }
    </style>";
}
add_action( 'admin_head', 'jkjaac_dynamic_admin_styles', 999 );

/**
 * Enqueue jQuery for blog page
 */
function jkjaac_enqueue_blog_scripts() {
    if ( is_page_template( 'page-blogs.php' ) ) {
        wp_enqueue_script( 'jquery' );
        
        // Pass nonce to JavaScript
        wp_localize_script( 'jquery', 'jkjaacBlogAjax', array(
            'ajaxUrl' => admin_url( 'admin-ajax.php' ),
            'nonce'   => wp_create_nonce( 'jkjaac_nonce' ),
            'paged'   => get_query_var( 'paged' ) ?: 1,
        ) );
    }
}
add_action( 'wp_enqueue_scripts', 'jkjaac_enqueue_blog_scripts' );

/* ============================================================================
   BLOG LOAD MORE AJAX HANDLER
   ============================================================================ */

function jkjaac_load_more_posts() {
    // Debug logging
    if ( WP_DEBUG ) {
        error_log( '[JKJAAC] load_more_posts called' );
        error_log( '[JKJAAC] POST data: ' . print_r( $_POST, true ) );
    }
    
    // Verify nonce
    $nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'jkjaac_nonce' ) ) {
        if ( WP_DEBUG ) {
            error_log( '[JKJAAC] Nonce verification failed' );
        }
        wp_send_json_error( array( 'message' => 'Security check failed.' ) );
    }
    
    $page = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1;
    
    if ( WP_DEBUG ) {
        error_log( '[JKJAAC] Loading page: ' . $page );
    }
    
    // First page has featured post, so offset calculation
    $offset = ( $page == 2 ) ? 1 : ( ( $page - 1 ) * 4 );
    
    $query = new WP_Query( array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 4,
        'offset'         => $offset,
    ) );
    
    if ( WP_DEBUG ) {
        error_log( '[JKJAAC] Found posts: ' . $query->found_posts );
    }
    
    ob_start();
    
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            ?>
            <a href="<?php the_permalink(); ?>" class="blog-card">
                <?php if ( has_post_thumbnail() ) : ?>
                    <img src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="<?php the_title_attribute(); ?>" class="blog-card-img" loading="lazy" />
                <?php else : ?>
                    <img src="https://jkjaac.co/wp-content/uploads/2026/03/what-is-jkjaac.png" alt="<?php the_title_attribute(); ?>" class="blog-card-img" loading="lazy" />
                <?php endif; ?>
                <span class="blog-tag">
                    <?php
                    $post_cats = get_the_category();
                    echo esc_html( ! empty( $post_cats ) ? $post_cats[0]->name : 'JKJAAC History' );
                    ?>
                </span>
                <h3 class="blog-card-title"><?php the_title(); ?></h3>
                <p class="blog-card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20, '...' ) ); ?></p>
                <div class="blog-meta">
                    <span><i class="ri-calendar-line"></i> <?php echo get_the_date( 'F j, Y' ); ?></span>
                </div>
                <span class="blog-read-more">Read More <i class="ri-arrow-right-line"></i></span>
            </a>
            <?php
        endwhile;
    endif;
    
    wp_reset_postdata();
    
    $html = ob_get_clean();
    
    if ( empty( $html ) ) {
        if ( WP_DEBUG ) {
            error_log( '[JKJAAC] No HTML generated' );
        }
        wp_send_json_success( array( 'html' => '', 'no_more' => true ) );
    } else {
        wp_send_json_success( array( 'html' => $html ) );
    }
}
add_action( 'wp_ajax_load_more_posts', 'jkjaac_load_more_posts' );
add_action( 'wp_ajax_nopriv_load_more_posts', 'jkjaac_load_more_posts' );

/* ============================================================================
   COMMENT AJAX HANDLER
   ============================================================================ */

function jkjaac_handle_comment() {
    // Verify nonce
    $nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'jkjaac_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Security verification failed.' ) );
    }
    
    // Rate limiting
    if ( ! jkjaac_rate_limit( 'comment', 10, 300 ) ) {
        wp_send_json_error( array( 'message' => 'Too many comments. Please wait a moment.' ) );
    }
    
    // Get and sanitize data
    $post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
    $name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
    $parent = isset( $_POST['parent_comment'] ) ? intval( $_POST['parent_comment'] ) : 0;
    
    // Validate
    $errors = array();
    
    if ( empty( $name ) ) {
        $errors['name'] = 'Name is required.';
    }
    if ( empty( $email ) || ! is_email( $email ) ) {
        $errors['email'] = 'Valid email is required.';
    }
    if ( empty( $message ) ) {
        $errors['message'] = 'Comment cannot be empty.';
    } elseif ( strlen( $message ) < 5 ) {
        $errors['message'] = 'Comment must be at least 5 characters.';
    } elseif ( strlen( $message ) > 2000 ) {
        $errors['message'] = 'Comment must be under 2000 characters.';
    }
    if ( $post_id === 0 || ! get_post( $post_id ) ) {
        $errors['post'] = 'Invalid post.';
    }
    
    if ( ! empty( $errors ) ) {
        wp_send_json_error( array( 'message' => 'Please correct the errors.', 'errors' => $errors ) );
    }
    
    // Prepare comment data
    $comment_data = array(
        'comment_post_ID'      => $post_id,
        'comment_author'       => $name,
        'comment_author_email' => $email,
        'comment_content'      => $message,
        'comment_parent'       => $parent,
        'comment_approved'     => 1, // Auto-approve (change to 0 for moderation)
        'user_id'              => 0,
    );
    
    // Insert comment
    $comment_id = wp_insert_comment( $comment_data );
    
    if ( $comment_id ) {
        wp_send_json_success( array( 'message' => 'Comment posted successfully!', 'comment_id' => $comment_id ) );
    } else {
        wp_send_json_error( array( 'message' => 'Failed to post comment. Please try again.' ) );
    }
}
add_action( 'wp_ajax_jkjaac_comment', 'jkjaac_handle_comment' );
add_action( 'wp_ajax_nopriv_jkjaac_comment', 'jkjaac_handle_comment' );

/* ============================================================================
   LOAD MORE COMMENTS AJAX HANDLER
   ============================================================================ */

function jkjaac_load_more_comments() {
    $nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'jkjaac_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed.' ) );
    }
    
    $post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
    $page = isset( $_POST['page'] ) ? intval( $_POST['page'] ) : 1;
    $per_page = 5;
    $offset = ( $page - 1 ) * $per_page;
    
    $comments = get_comments( array(
        'post_id' => $post_id,
        'status'  => 'approve',
        'number'  => $per_page,
        'offset'  => $offset,
        'order'   => 'DESC',
    ) );
    
    ob_start();
    
    foreach ( $comments as $comment ) {
        $comment_avatar = get_avatar_url( $comment->comment_author_email, array( 'size' => 36 ) );
        ?>
        <div class="bd-comment">
            <img src="<?php echo esc_url( $comment_avatar ); ?>" alt="<?php echo esc_attr( $comment->comment_author ); ?>" class="bd-comment-avatar" />
            <div>
                <div class="bd-comment-top">
                    <span class="bd-comment-name"><?php echo esc_html( $comment->comment_author ); ?></span>
                </div>
                <div class="bd-comment-text">
                    <?php echo esc_html( $comment->comment_content ); ?>
                </div>
                <div class="bd-comment-actions">
                    <span><?php echo esc_html( human_time_diff( strtotime( $comment->comment_date_gmt ), current_time( 'timestamp' ) ) . ' ago' ); ?></span>
                </div>
            </div>
        </div>
        <?php
    }
    
    $html = ob_get_clean();
    
    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_load_more_comments', 'jkjaac_load_more_comments' );
add_action( 'wp_ajax_nopriv_load_more_comments', 'jkjaac_load_more_comments' );


/* ============================================================================
   RATE LIMITING HELPER FUNCTION
   ============================================================================ */

/**
 * Shared rate-limiting helper using transients.
 *
 * Allows $limit requests per $window seconds from a given IP.
 *
 * @param  string $action  Unique action key (e.g. 'contact').
 * @param  int    $limit   Max requests allowed.
 * @param  int    $window  Time window in seconds.
 * @return bool            TRUE if the request is within the allowed limit.
 */
function jkjaac_rate_limit( $action, $limit = 5, $window = 300 ) {
    $ip  = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : 'unknown';
    $key = 'jkjaac_rl_' . $action . '_' . md5( $ip );
    $hits = (int) get_transient( $key );

    if ( $hits >= $limit ) {
        return false;
    }

    set_transient( $key, $hits + 1, $window );
    return true;
}

/**
 * Get image URL with automatic fallback
 *
 * @param int $attachment_id Attachment ID (optional)
 * @param string $size Image size
 * @return string Image URL
 */
function jkjaac_get_image_url($attachment_id = null, $size = 'large') {
    if ($attachment_id && wp_attachment_is_image($attachment_id)) {
        $image_url = wp_get_attachment_image_url($attachment_id, $size);
        if ($image_url) {
            return $image_url;
        }
    }
    return jkjaac_get_fallback_image_url($size);
}

/**
 * Get post thumbnail URL with fallback
 *
 * @param int $post_id Post ID
 * @param string $size Image size
 * @return string Image URL
 */
function jkjaac_get_post_thumbnail_url($post_id = null, $size = 'large') {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $thumbnail_url = get_the_post_thumbnail_url($post_id, $size);
    if ($thumbnail_url) {
        return $thumbnail_url;
    }
    
    return jkjaac_get_fallback_image_url($size);
}

/**
 * Display image with fallback
 *
 * @param int $attachment_id Attachment ID
 * @param string $size Image size
 * @param array $attr Additional attributes
 */
function jkjaac_the_image($attachment_id = null, $size = 'large', $attr = array()) {
    $url = jkjaac_get_image_url($attachment_id, $size);
    $default_attr = array(
        'src' => $url,
        'alt' => '',
        'onerror' => "this.onerror=null;this.src='" . esc_js(jkjaac_get_fallback_image_url($size)) . "';"
    );
    
    $attr = wp_parse_args($attr, $default_attr);
    
    echo '<img';
    foreach ($attr as $name => $value) {
        echo ' ' . esc_attr($name) . '="' . esc_attr($value) . '"';
    }
    echo ' />';
}