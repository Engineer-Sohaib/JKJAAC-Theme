<?php
/**
 * Template Name: 38-Point Charter Page
 * Full 38-point charter with filterable demand list and progress bars.
 */
get_header();
?>

    <?php get_template_part('template-parts/hero'); ?>

    <div class="breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a><span class="bc-sep">›</span>
      <span class="cur">38-Point Charter</span>
    </div>

    <?php echo do_shortcode('[dynamic_ticker]'); ?>

    <?php get_template_part('template-parts/charter-progress'); ?>
    
    <section class="team-section">
      <div class="team-inner">
        <?php get_template_part('template-parts/charter-header'); ?>
        <?php echo do_shortcode('[charter_demands]'); ?>
      </div>
    </section>
    
<?php get_template_part('template-parts/pull-quote'); ?>

<?php get_footer(); ?>