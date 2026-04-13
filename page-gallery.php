<?php
/**
 * Template Name: Gallery Page
 * Masonry photo gallery with category filters, column switcher, and lightbox.
 */
get_header();

// Get page settings
$default_cols = get_post_meta( get_the_ID(), '_jkjaac_gallery_default_cols', true ) ?: 4;
$gallery_count = get_post_meta( get_the_ID(), '_jkjaac_gallery_count', true );
$orderby = get_post_meta( get_the_ID(), '_jkjaac_gallery_orderby', true ) ?: 'meta_value menu_order';
$order = get_post_meta( get_the_ID(), '_jkjaac_gallery_order', true ) ?: 'DESC';

// Build shortcode
$shortcode = '[jkjaac_gallery default_cols="' . intval( $default_cols ) . '"';
if ( ! empty( $gallery_count ) ) {
    $shortcode .= ' count="' . intval( $gallery_count ) . '"';
}
$shortcode .= ' orderby="' . esc_attr( $orderby ) . '"';
$shortcode .= ' order="' . esc_attr( $order ) . '"';
$shortcode .= ']';
?>

    <?php get_template_part( 'template-parts/hero' ); ?>

    <div class="breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="bc-sep">›</span>
      <span class="cur">Gallery</span>
    </div>

    <?php echo do_shortcode('[dynamic_ticker]'); ?>

    <?php echo do_shortcode( $shortcode ); ?>

<?php get_footer(); ?>