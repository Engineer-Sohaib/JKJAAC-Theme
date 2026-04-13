<?php
/**
 * Template Part: Leadership Grid Card
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$role_title = get_the_excerpt();
$delay_class = isset( $counter ) && $counter > 0 ? ' sr-d' . $counter : '';
?>

<div class="team-card sr<?php echo esc_attr( $delay_class ); ?>">
    <?php if ( has_post_thumbnail() ) : ?>
        <?php the_post_thumbnail( 'medium', array( 
            'class' => 'team-img', 
            'alt' => esc_attr( get_the_title() ),
            'onerror' => "this.style.background='var(--g700)';this.style.minHeight='320px';"
        ) ); ?>
    <?php else : ?>
        <img class="team-img" 
             src="<?php echo esc_url( get_template_directory_uri() . '/images/placeholder-profile.jpg' ); ?>" 
             alt="<?php echo esc_attr( get_the_title() ); ?>"
             onerror="this.style.background='var(--g700)';this.style.minHeight='320px';" />
    <?php endif; ?>
    
    <div class="team-body">
        <?php if ( ! empty( $role_title ) ) : ?>
            <div class="team-role"><?php echo esc_html( $role_title ); ?></div>
        <?php endif; ?>
        <div class="team-name"><?php the_title(); ?></div>
    </div>
</div>