<?php
/**
 * Template Name: Leadership Page
 * Full leadership directory with team cards and portfolio sections.
 */
get_header();
?>

    <?php get_template_part( 'template-parts/hero' ); ?>

    <div class="breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="bc-sep">›</span>
      <a href="<?php echo esc_url( jkjaac_page_url( 'about' ) ); ?>">About</a><span class="bc-sep">›</span>
      <span class="cur">Leadership</span>
    </div>

    <?php echo do_shortcode('[dynamic_ticker]'); ?>

    <?php echo do_shortcode( '[leadership_grid]' ); ?>

    <?php get_template_part( 'template-parts/leadership-sacrifice' ); ?>
    
    <?php get_template_part( 'template-parts/leadership-structure' ); ?>
   
    <?php get_template_part( 'template-parts/pull-quote' ); ?>
    
<?php get_footer(); ?>