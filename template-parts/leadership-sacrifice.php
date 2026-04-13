<?php
/**
 * Template Part: Leadership Sacrifice Section
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

// Get saved values with fallbacks
$hide_sacrifice = get_post_meta( $post->ID, '_jkjaac_leadership_hide_sacrifice', true );
if ( $hide_sacrifice ) {
    return;
}

$sacrifice_label = get_post_meta( $post->ID, '_jkjaac_sacrifice_label', true );
$sacrifice_title_line1 = get_post_meta( $post->ID, '_jkjaac_sacrifice_title_line1', true );
$sacrifice_title_line2 = get_post_meta( $post->ID, '_jkjaac_sacrifice_title_line2', true );
$sacrifice_description = get_post_meta( $post->ID, '_jkjaac_sacrifice_description', true );

$persecution_cards = get_post_meta( $post->ID, '_jkjaac_persecution_cards', true );

// Fallbacks
if ( empty( $sacrifice_label ) ) $sacrifice_label = 'Government Recognition';
if ( empty( $sacrifice_title_line1 ) ) $sacrifice_title_line1 = 'Leaders Who';
if ( empty( $sacrifice_title_line2 ) ) $sacrifice_title_line2 = 'Sacrificed';
if ( empty( $sacrifice_description ) ) $sacrifice_description = 'JKJAAC leadership has faced repeated arrests, legal persecution, and personal threats. In May 2024, around 70 activists were arrested overnight including Shaukat Nawaz Mir. This only inflamed public anger and proved counterproductive for the government.';

if ( ! is_array( $persecution_cards ) || empty( $persecution_cards ) ) {
    $persecution_cards = array(
        1 => array(
            'icon' => 'ri-user-forbid-line',
            'title' => 'May 8–9, 2024 — Mass Arrests',
            'description' => 'Around 70 JKJAAC activists arrested overnight across Muzaffarabad and Mirpur divisions, including Shaukat Nawaz Mir and multiple core committee members. The crackdown severely backfired, triggering the most intense protests in AJK\'s recent history and ultimately forcing the ₨23 billion relief package.'
        ),
        2 => array(
            'icon' => 'ri-discuss-line',
            'title' => 'September 2025 — Communications Blackout',
            'description' => 'Pakistan\'s Ministry of Interior ordered mobile and internet services suspended across major parts of AJK on September 28–29, 2025, specifically to prevent JKJAAC from coordinating the announced lockdown. Despite the blackout, hundreds of thousands mobilized — a testament to the leadership\'s organizational capacity.'
        ),
        3 => array(
            'icon' => 'ri-file-close-line',
            'title' => '192 FIRs Filed — Later Largely Withdrawn',
            'description' => '192 First Information Reports (FIRs) were filed against JKJAAC activists across the 2024 and 2025 protests. The October 2025 agreement included withdrawal of 177 of these FIRs, a major victory for the movement\'s legal standing and a recognition of the illegitimacy of the prosecutions.'
        ),
        4 => array(
            'icon' => 'ri-file-paper-2-line',
            'title' => 'International Appeal — October 2025',
            'description' => 'Sardar Umar Nazir Kashmiri issued a formal international appeal on October 2, 2025 invoking the UN Charter, UDHR, and ICCPR — marking JKJAAC\'s first formal engagement with international human rights frameworks and gaining coverage from diaspora media worldwide.'
        )
    );
}
?>

<section class="process">
    <div class="about-inner">
        <div class="sr">
            <?php if ( ! empty( $sacrifice_label ) ) : ?>
                <p class="s-label"><?php echo esc_html( $sacrifice_label ); ?></p>
            <?php endif; ?>
            
            <h2 class="s-title">
                <?php echo esc_html( $sacrifice_title_line1 ); ?> 
                <br /><em><?php echo esc_html( $sacrifice_title_line2 ); ?></em>
            </h2>
            
            <?php if ( ! empty( $sacrifice_description ) ) : ?>
                <div class="prose sr pg-leadership-20">
                    <p><?php echo wp_kses_post( $sacrifice_description ); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="sr sr-d1 pg-leadership-21 mt-1">
        <?php foreach ( $persecution_cards as $index => $card ) : ?>
            <?php if ( ! empty( $card['title'] ) ) : ?>
                <?php 
                $base = 22 + ( $index - 1 ) * 4;
                $icon_class = "pg-leadership-" . ( $base + 1 );
                $title_class = "pg-leadership-" . ( $base + 2 );
                $desc_class = "pg-leadership-" . ( $base + 3 );
                $wrapper_class = "pg-leadership-" . $base;
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
</section>