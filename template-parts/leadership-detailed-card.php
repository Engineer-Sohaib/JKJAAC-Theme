<?php
/**
 * Template Part: Leadership Detailed Card
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$role_title = get_the_excerpt();

// $counter is passed from the loop
$counter = isset( $counter ) ? $counter : 1;

// Alternate classes for different styling based on position
$wrapper_class = ( $counter % 2 == 0 ) ? 'pg-leadership-8' : 'pg-leadership-2';
$img_class = ( $counter % 2 == 0 ) ? 'pg-leadership-10' : 'pg-leadership-4';
$role_class = ( $counter % 2 == 0 ) ? 'pg-leadership-11' : 'pg-leadership-5';
$name_class = ( $counter % 2 == 0 ) ? 'pg-leadership-12' : 'pg-leadership-6';
$desc_class = ( $counter % 2 == 0 ) ? 'pg-leadership-13' : 'pg-leadership-7';
?>

<div class="<?php echo esc_attr( $wrapper_class ); ?>">
    <div class="pg-leadership-3">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'medium', array( 
                'class' => esc_attr( $img_class ), 
                'alt' => esc_attr( get_the_title() ) 
            ) ); ?>
        <?php else : ?>
            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/placeholder-profile.jpg' ); ?>" 
                 alt="<?php echo esc_attr( get_the_title() ); ?>" 
                 class="<?php echo esc_attr( $img_class ); ?>" />
        <?php endif; ?>
    </div>
    
    <?php if ( ! empty( $role_title ) ) : ?>
        <div class="<?php echo esc_attr( $role_class ); ?>">
            <?php echo esc_html( $role_title ); ?>
        </div>
    <?php endif; ?>
    
    <div class="<?php echo esc_attr( $name_class ); ?>"><?php the_title(); ?></div>
    
    <div class="<?php echo esc_attr( $desc_class ); ?>">
        <?php the_content(); ?>
    </div>
</div>