<?php
/**
 * Dynamic CTA Section Template Part
 * 
 * @package JKJAAC
 */

$cta = jkjaac_get_cta_data();

if ( $cta['hide_section'] ) {
    return;
}
?>

<section class="cta">
    <div class="cta-inner sr">
        <h2>
            <?php echo esc_html( $cta['heading'] ); ?>
            <?php if ( ! empty( $cta['heading_accent'] ) ) : ?>
                <em><?php echo esc_html( $cta['heading_accent'] ); ?></em>
            <?php endif; ?>
        </h2>
        
        <?php if ( ! empty( $cta['description'] ) ) : ?>
            <p><?php echo esc_html( $cta['description'] ); ?></p>
        <?php endif; ?>
        
        <div class="cta-btns">
            <?php if ( ! empty( $cta['button1_text'] ) && ! empty( $cta['button1_url'] ) ) : ?>
                <a class="<?php echo esc_attr( $cta['button1_type'] ); ?>" href="<?php echo esc_url( jkjaac_page_url( $cta['button1_url'] ) ); ?>">
                    <?php echo esc_html( $cta['button1_text'] ); ?>
                </a>
            <?php endif; ?>
            
            <?php if ( ! empty( $cta['button2_text'] ) && ! empty( $cta['button2_url'] ) ) : ?>
                <a class="<?php echo esc_attr( $cta['button2_type'] ); ?>" href="<?php echo esc_url( jkjaac_page_url( $cta['button2_url'] ) ); ?>">
                    <?php echo esc_html( $cta['button2_text'] ); ?>
                </a>
            <?php endif; ?>
            
            <?php if ( ! empty( $cta['button3_text'] ) && ! empty( $cta['button3_url'] ) ) : ?>
                <a class="<?php echo esc_attr( $cta['button3_type'] ); ?>" href="<?php echo esc_url( jkjaac_page_url( $cta['button3_url'] ) ); ?>">
                    <?php echo esc_html( $cta['button3_text'] ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>