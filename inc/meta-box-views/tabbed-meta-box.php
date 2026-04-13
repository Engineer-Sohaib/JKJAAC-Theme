<?php
/**
 * Tabbed Meta Box UI Template
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get current page info
global $post;
$page_slug = '';
$page_id = 0;
$page_title = '';
$page_template = '';

if ( isset( $post ) ) {
    $page_slug = $post->post_name;
    $page_id = $post->ID;
    $page_title = $post->post_title;
    $page_template = get_page_template_slug( $post->ID );
}

// Get front page ID
$front_page_id = get_option( 'page_on_front' );
$is_home_page = ( $front_page_id == $page_id );

// Check if About page
$is_about_page = (
    $page_slug === 'about' || 
    $page_slug === 'about-us' || 
    $page_slug === 'aboutus' ||
    stripos( $page_title, 'about' ) !== false ||
    $page_template === 'page-about.php' ||
    $page_template === 'template-about.php'
);

// Check if Leadership page
$is_leadership_page = (
    $page_slug === 'leadership' || 
    $page_slug === 'leaders' || 
    $page_slug === 'our-leadership' ||
    $page_slug === 'core-committee' ||
    stripos( $page_title, 'leadership' ) !== false ||
    stripos( $page_title, 'leaders' ) !== false ||
    stripos( $page_title, 'committee' ) !== false ||
    $page_template === 'page-leadership.php' ||
    $page_template === 'template-leadership.php' ||
    get_post_meta( $page_id, '_wp_page_template', true ) === 'page-leadership.php'
);

// Check if Charter page
$is_charter_page = (
    $page_slug === '38-point-charter' || 
    $page_slug === 'charter' || 
    $page_slug === 'demands' ||
    stripos( $page_title, 'charter' ) !== false ||
    stripos( $page_title, '38-point' ) !== false ||
    $page_template === 'page-38-point-charter.php'
);

// Check if Contact page
$is_contact_page = (
    $page_slug === 'contact' || 
    $page_slug === 'contact-us' ||
    stripos( $page_title, 'contact' ) !== false ||
    $page_template === 'page-contact.php'
);

// Check if Events page
$is_events_page = (
    $page_slug === 'events' || 
    $page_slug === 'event' ||
    stripos( $page_title, 'event' ) !== false ||
    $page_template === 'page-events.php'
);
// Check if Negotiations page
$is_negotiations_page = (
    $page_slug === 'negotiations' || 
    stripos( $page_title, 'negotiation' ) !== false ||
    $page_template === 'page-negotiations.php'
);
// Add this with the other page detection checks (around line 80-120)
$is_struggles_page = (
    $page_slug === 'struggles' || 
    stripos( $page_title, 'struggle' ) !== false ||
    $page_template === 'page-struggles.php'
);
// Add this with the other page detection checks
$is_gallery_page = (
    $page_slug === 'gallery' || 
    stripos( $page_title, 'gallery' ) !== false ||
    $page_template === 'page-gallery.php'
);
?>

<style>
    /* Tab Navigation */
    .jkjaac-tabs {
        background: #0d0d14;
        border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        margin: 0;
        display: flex;
        gap: 4px;
        flex-wrap: wrap;
    }
    
    .jkjaac-tab-btn {
        background: transparent;
        border: none;
        padding: 12px 15px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #f6f6ff;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        border-bottom: 2px solid transparent;
        margin-bottom: -1px;
    }
    
    .jkjaac-tab-btn:hover {
        color: #d4af37;
        background: rgba(212, 175, 55, 0.05);
    }
    
    .jkjaac-tab-btn.active {
        color: #d4af37;
        border-bottom-color: #d4af37;
    }
    
    /* Tab Content */
    .jkjaac-tab-content {
        display: none;
        padding: 0;
    }
    
    .jkjaac-tab-content.active {
        display: block;
    }
</style>

<div class="jkjaac-tabs-container">
    <!-- Tab Navigation -->
    <div class="jkjaac-tabs">
        <button type="button" class="jkjaac-tab-btn active" data-tab="hero-tab">
            <i class="ri-layout-row-line" style="margin-right: 4px;"></i>
            Hero
        </button>
        
        <!-- About Tab - Only show on About page -->
        <?php if ( $is_about_page ) : ?>
        <button type="button" class="jkjaac-tab-btn" data-tab="about-tab">
            <i class="ri-information-line" style="margin-right: 4px;"></i>
            About
        </button>
        <?php endif; ?>
        
        <!-- Mission Tab - Only show on Home and About pages -->
        <?php if ( $is_home_page || $is_about_page ) : ?>
        <button type="button" class="jkjaac-tab-btn" data-tab="mission-tab">
            <i class="ri-flag-line" style="margin-right: 4px;"></i>
            Mission
        </button>
        <?php endif; ?>
        
        <!-- Team Header Tab - Only show on Home, About, and Leadership pages -->
        <?php if ( $is_home_page || $is_about_page || $is_leadership_page ) : ?>
        <button type="button" class="jkjaac-tab-btn" data-tab="team-tab">
            <i class="ri-group-line" style="margin-right: 4px;"></i>
            Team Header
        </button>
        <?php endif; ?>

        <!-- Leadership Tab - Only show on Leadership page -->
        <?php if ( $is_leadership_page ) : ?>
        <button type="button" class="jkjaac-tab-btn" data-tab="leadership-tab">
            <i class="ri-user-star-line" style="margin-right: 4px;"></i>
            Leadership
        </button>
        <?php endif; ?>
        <!-- Negotiations Tab - Only show on Negotiations page -->
<?php if ( $is_negotiations_page ) : ?>
<button type="button" class="jkjaac-tab-btn" data-tab="negotiations-tab">
    <i class="ri-handshake-line" style="margin-right: 4px;"></i>
    Negotiations
</button>
<?php endif; ?>
<!-- Struggles Tab - Only show on Struggles page -->
<?php if ( $is_struggles_page ) : ?>
<button type="button" class="jkjaac-tab-btn" data-tab="struggles-tab">
    <i class="ri-flag-line" style="margin-right: 4px;"></i>
    Struggles
</button>
<?php endif; ?>
<!-- Gallery Tab - Only show on Gallery page -->
<?php if ( $is_gallery_page ) : ?>
<button type="button" class="jkjaac-tab-btn" data-tab="gallery-tab">
    <i class="ri-image-line" style="margin-right: 4px;"></i>
    Gallery
</button>
<?php endif; ?>
        
        <!-- Events Tab - Only show on Events page -->
        <?php if ( $is_events_page ) : ?>
        <button type="button" class="jkjaac-tab-btn" data-tab="events-tab">
            <i class="ri-calendar-event-line" style="margin-right: 4px;"></i>
            Events
        </button>
        <?php endif; ?>
        
        <!-- Pull Quote Tab - Show on all pages -->
        <button type="button" class="jkjaac-tab-btn" data-tab="pullquote-tab">
            <i class="ri-double-quotes-l" style="margin-right: 4px;"></i>
            Pull Quote
        </button>
        
        <!-- CTA Tab - Show on all pages -->
        <button type="button" class="jkjaac-tab-btn" data-tab="cta-tab">
            <i class="ri-megaphone-line" style="margin-right: 4px;"></i>
            CTA
        </button>
        
        <!-- Charter Header Tab - Only show on Charter page -->
        <?php if ( $is_charter_page ) : ?>
        <button type="button" class="jkjaac-tab-btn" data-tab="charter-header-tab">
            <i class="ri-file-text-line" style="margin-right: 4px;"></i>
            Charter Header
        </button>
        <?php endif; ?>
        
        <!-- Charter Progress Tab - Only show on Charter page -->
        <?php if ( $is_charter_page ) : ?>
        <button type="button" class="jkjaac-tab-btn" data-tab="charter-progress-tab">
            <i class="ri-pie-chart-line" style="margin-right: 4px;"></i>
            Progress Tracker
        </button>
        <?php endif; ?>
        
        <!-- Map Tab - Only show on Contact page -->
        <?php if ( $is_contact_page ) : ?>
        <button type="button" class="jkjaac-tab-btn" data-tab="map-tab">
            <i class="ri-map-pin-line" style="margin-right: 4px;"></i>
            Map Settings
        </button>
        <?php endif; ?>
    </div>
    
    <!-- Hero Tab Content -->
    <div id="hero-tab" class="jkjaac-tab-content active">
        <?php include get_template_directory() . '/inc/meta-box-views/hero-tab-content.php'; ?>
    </div>
    
    <!-- About Tab Content - Only show on About page -->
    <?php if ( $is_about_page ) : ?>
    <div id="about-tab" class="jkjaac-tab-content">
        <?php include get_template_directory() . '/inc/meta-box-views/about-tab-content.php'; ?>
    </div>
    <?php endif; ?>
    
    <!-- Mission Tab Content - Only show on Home and About pages -->
    <?php if ( $is_home_page || $is_about_page ) : ?>
    <div id="mission-tab" class="jkjaac-tab-content">
        <?php include get_template_directory() . '/inc/meta-box-views/mission-tab-content.php'; ?>
    </div>
    <?php endif; ?>

    <!-- Team Header Tab Content - Only show on Home, About, and Leadership pages -->
    <?php if ( $is_home_page || $is_about_page || $is_leadership_page ) : ?>
    <div id="team-tab" class="jkjaac-tab-content">
        <?php include get_template_directory() . '/inc/meta-box-views/team-header-tab-content.php'; ?>
    </div>
    <?php endif; ?>

    <!-- Leadership Tab Content - Only show on Leadership page -->
<?php if ( $is_leadership_page ) : ?>
<div id="leadership-tab" class="jkjaac-tab-content">
    <?php include get_template_directory() . '/inc/meta-box-views/leadership-tab-content.php'; ?>
</div>
<?php endif; ?>

<!-- Negotiations Tab Content -->
<?php if ( $is_negotiations_page ) : ?>
<div id="negotiations-tab" class="jkjaac-tab-content">
    <?php include get_template_directory() . '/inc/meta-box-views/negotiations-tab-content.php'; ?>
</div>
<?php endif; ?>
<!-- Struggles Tab Content -->
<?php if ( $is_struggles_page ) : ?>
<div id="struggles-tab" class="jkjaac-tab-content">
    <?php include get_template_directory() . '/inc/meta-box-views/struggles-tab-content.php'; ?>
</div>
<?php endif; ?>
<!-- Gallery Tab Content -->
<?php if ( $is_gallery_page ) : ?>
<div id="gallery-tab" class="jkjaac-tab-content">
    <?php include get_template_directory() . '/inc/meta-box-views/gallery-tab-content.php'; ?>
</div>
<?php endif; ?>
    <!-- Events Tab Content - Only show on Events page -->
    <?php if ( $is_events_page ) : ?>
    <div id="events-tab" class="jkjaac-tab-content">
        <?php include get_template_directory() . '/inc/meta-box-views/events-tab-content.php'; ?>
    </div>
    <?php endif; ?>
    
    <!-- Pull Quote Tab Content -->
    <div id="pullquote-tab" class="jkjaac-tab-content">
        <?php include get_template_directory() . '/inc/meta-box-views/pullquote-tab-content.php'; ?>
    </div>
    
    <!-- CTA Tab Content -->
    <div id="cta-tab" class="jkjaac-tab-content">
        <?php include get_template_directory() . '/inc/meta-box-views/cta-tab-content.php'; ?>
    </div>
    
    <!-- Charter Header Tab Content -->
    <?php if ( $is_charter_page ) : ?>
    <div id="charter-header-tab" class="jkjaac-tab-content">
        <?php include get_template_directory() . '/inc/meta-box-views/charter-header-tab-content.php'; ?>
    </div>
    <?php endif; ?>
    
    <!-- Charter Progress Tab Content -->
    <?php if ( $is_charter_page ) : ?>
    <div id="charter-progress-tab" class="jkjaac-tab-content">
        <?php include get_template_directory() . '/inc/meta-box-views/charter-progress-tab-content.php'; ?>
    </div>
    <?php endif; ?>
    
    <!-- Map Tab Content -->
    <?php if ( $is_contact_page ) : ?>
    <div id="map-tab" class="jkjaac-tab-content">
        <?php include get_template_directory() . '/inc/meta-box-views/map-tab-content.php'; ?>
    </div>
    <?php endif; ?>
    
</div>

<script>
jQuery(document).ready(function($) {
    // Tab switching functionality
    $('.jkjaac-tab-btn').on('click', function() {
        var tabId = $(this).data('tab');
        
        // Update active button
        $('.jkjaac-tab-btn').removeClass('active');
        $(this).addClass('active');
        
        // Update active content
        $('.jkjaac-tab-content').removeClass('active');
        $('#' + tabId).addClass('active');
    });
});
</script>