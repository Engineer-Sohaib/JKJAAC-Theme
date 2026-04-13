<?php
/**
 * Template Part: Leadership Section Header
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get team data (handles page overrides automatically)
$team_data = function_exists( 'jkjaac_get_team_data' ) ? jkjaac_get_team_data() : array();

// Check if section should be hidden
if ( isset( $team_data['hide_section'] ) && $team_data['hide_section'] ) {
    return;
}

$label = isset( $team_data['label'] ) && ! empty( $team_data['label'] ) ? $team_data['label'] : 'Core Committee';
$title1 = isset( $team_data['title_line1'] ) && ! empty( $team_data['title_line1'] ) ? $team_data['title_line1'] : 'Leadership';
$title2 = isset( $team_data['title_line2'] ) && ! empty( $team_data['title_line2'] ) ? $team_data['title_line2'] : 'Profiles';
$description = isset( $team_data['description'] ) ? $team_data['description'] : '';

// $desc_class is passed from the calling template
$desc_class = isset( $desc_class ) ? $desc_class : 'prose';
?>

<div class="sr">
    <?php if ( ! empty( $label ) ) : ?>
        <p class="s-label"><?php echo esc_html( $label ); ?></p>
    <?php endif; ?>
    
    <h2 class="s-title">
        <?php echo esc_html( $title1 ); ?> 
        <?php if ( ! empty( $title2 ) ) : ?>
            <br /><em><?php echo esc_html( $title2 ); ?></em>
        <?php endif; ?>
    </h2>
    
    <?php if ( ! empty( $description ) ) : ?>
        <div class="<?php echo esc_attr( $desc_class ); ?>">
            <p><?php echo wp_kses_post( $description ); ?></p>
        </div>
    <?php endif; ?>
</div>