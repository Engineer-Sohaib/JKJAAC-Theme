<?php
/**
 * Dynamic Pull Quote Section Template Part
 * 
 * @package JKJAAC
 */

$pull_quote = jkjaac_get_pull_quote_data();

if ( $pull_quote['hide_section'] ) {
    return;
}
?>

<div class="pull">
    <div class="sr in">
        <blockquote>
            <?php echo esc_html( $pull_quote['quote_text'] ); ?>
        </blockquote>
        <?php if ( ! empty( $pull_quote['cite'] ) ) : ?>
            <cite><?php echo esc_html( $pull_quote['cite'] ); ?></cite>
        <?php endif; ?>
    </div>
    
    <?php if ( $pull_quote['show_buttons'] && ( ! empty( $pull_quote['btn_primary_text'] ) || ! empty( $pull_quote['btn_secondary_text'] ) ) ) : ?>
    <div class="hero-btns">
        <?php if ( ! empty( $pull_quote['btn_primary_text'] ) && ! empty( $pull_quote['btn_primary_link'] ) ) : ?>
            <a href="<?php echo esc_url( jkjaac_page_url( $pull_quote['btn_primary_link'] ) ); ?>" class="btn-p">
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                </svg>
                <?php echo esc_html( $pull_quote['btn_primary_text'] ); ?>
            </a>
        <?php endif; ?>
        
        <?php if ( ! empty( $pull_quote['btn_secondary_text'] ) && ! empty( $pull_quote['btn_secondary_link'] ) ) : ?>
            <a href="<?php echo esc_url( jkjaac_page_url( $pull_quote['btn_secondary_link'] ) ); ?>" class="btn-g">
                <?php echo esc_html( $pull_quote['btn_secondary_text'] ); ?>
            </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>