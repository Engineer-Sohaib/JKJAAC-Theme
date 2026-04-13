<?php
/**
 * Template Part: Leadership Structure Section
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

// Get saved values with fallbacks
$hide_structure = get_post_meta( $post->ID, '_jkjaac_leadership_hide_structure', true );
if ( $hide_structure ) {
    return;
}

$structure_label = get_post_meta( $post->ID, '_jkjaac_structure_label', true );
$structure_title_line1 = get_post_meta( $post->ID, '_jkjaac_structure_title_line1', true );
$structure_title_line2 = get_post_meta( $post->ID, '_jkjaac_structure_title_line2', true );
$structure_description = get_post_meta( $post->ID, '_jkjaac_structure_description', true );

$structure_cards = get_post_meta( $post->ID, '_jkjaac_structure_cards', true );
$stats_cards = get_post_meta( $post->ID, '_jkjaac_stats_cards', true );

// Fallbacks
if ( empty( $structure_label ) ) $structure_label = 'Organizational Structure';
if ( empty( $structure_title_line1 ) ) $structure_title_line1 = 'A Movement Built on';
if ( empty( $structure_title_line2 ) ) $structure_title_line2 = 'Collective Leadership';
if ( empty( $structure_description ) ) $structure_description = 'We are not a traditional organization with a single leader at the top. Instead, we are a dynamic network built on the principles of collective leadership. Our structure is decentralized and participatory, distributing power and decision-making across the group. By valuing every voice and fostering shared responsibility, we ensure that our direction is shaped by the collective wisdom of our members, not a single hierarchy. This approach makes us more agile, resilient, and deeply aligned with our mission.';

if ( ! is_array( $structure_cards ) || empty( $structure_cards ) ) {
    $structure_cards = array(
        1 => array(
            'icon' => 'ri-shake-hands-line',
            'title' => 'Collective Decision-Making',
            'description' => "No single leader can unilaterally decide JKJAAC's positions. All major actions require collective committee agreement — preventing individual co-optation by government."
        ),
        2 => array(
            'icon' => 'ri-earth-line',
            'title' => 'Diaspora Network',
            'description' => "Nearly half of AJK's population lives overseas — primarily in the UK. JKJAAC's diaspora network, particularly in Birmingham and London, provides crucial advocacy and financial support."
        ),
        3 => array(
            'icon' => 'ri-smartphone-line',
            'title' => 'Social Media Strategy',
            'description' => "Social media has been central to JKJAAC's organizing — allowing its message to reach every corner of AJK without distortion, even when traditional media aligned with government narratives."
        )
    );
}

if ( ! is_array( $stats_cards ) || empty( $stats_cards ) ) {
    $stats_cards = array(
        1 => array( 'number' => '10', 'label' => 'Districts Represented' ),
        2 => array( 'number' => '4+', 'label' => 'Sector Constituencies' ),
        3 => array( 'number' => '0', 'label' => 'Political Party Ties' ),
        4 => array( 'number' => '3', 'label' => 'Negotiation Rounds' )
    );
}
?>

<section id="contact" class="about-section">
    <div class="about-inner">
        <div class="sr in">
            <?php if ( ! empty( $structure_label ) ) : ?>
                <p class="s-label"><?php echo esc_html( $structure_label ); ?></p>
            <?php endif; ?>
            
            <h2 class="s-title">
                <?php echo esc_html( $structure_title_line1 ); ?>
                <br /><em><?php echo esc_html( $structure_title_line2 ); ?></em>
            </h2>
            
            <?php if ( ! empty( $structure_description ) ) : ?>
                <p class="s-desc"><?php echo wp_kses_post( $structure_description ); ?></p>
            <?php endif; ?>
        </div>
        
        <div class="sr sr-d1 pg-press_media-50 in">
            <?php foreach ( $structure_cards as $index => $card ) : ?>
                <?php if ( ! empty( $card['title'] ) ) : ?>
                    <?php 
                    $base = 51 + ( $index - 1 ) * 4;
                    $wrapper_class = "pg-press_media-" . $base;
                    $icon_class = "pg-press_media-" . ( $base + 1 );
                    $title_class = "pg-press_media-" . ( $base + 2 );
                    $desc_class = "pg-press_media-" . ( $base + 3 );
                    ?>
                    <div class="<?php echo esc_attr( $wrapper_class ); ?>">
                        <div class="<?php echo esc_attr( $icon_class ); ?>">
                            <i class="<?php echo esc_attr( $card['icon'] ); ?>"></i>
                        </div>
                        <div class="<?php echo esc_attr( $title_class ); ?>">
                            <?php echo esc_html( $card['title'] ); ?>
                        </div>
                        <p class="<?php echo esc_attr( $desc_class ); ?>">
                            <?php echo wp_kses_post( $card['description'] ); ?>
                        </p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="pop-cards sr sr-d1 in fr-4">
        <?php foreach ( $stats_cards as $index => $stat ) : ?>
            <?php if ( ! empty( $stat['label'] ) ) : ?>
                <div class="pop-card">
                    <div class="pop-card-num"><?php echo esc_html( $stat['number'] ); ?></div>
                    <span class="pop-card-lbl"><?php echo esc_html( $stat['label'] ); ?></span>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>