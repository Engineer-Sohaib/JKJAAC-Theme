<?php
/**
 * front-page.php
 *
 * WordPress loads this template when "Front page displays" is set to
 * a static page OR the latest posts. It takes priority over index.php
 * for the site's actual front page in all configurations.
 */
get_header();

$frontpage_id = (int) get_option( 'page_on_front' );
?>

    <?php get_template_part( 'template-parts/hero' ); ?>

    <?php echo do_shortcode('[dynamic_ticker]'); ?>

    <?php get_template_part( 'template-parts/mission' ); ?>

    <section class="process">
      <div class="process-inner">
        <div class="sr pg-index-8">
            <?php if ( function_exists( 'get_field' ) ) : ?>
                <p class="s-label pg-index-9">
                    <?php echo get_field('process_sub_heading', $frontpage_id); ?>
                </p>
                <h2 class="s-title pg-index-10">
                    <?php echo get_field('process_heading_1', $frontpage_id); ?> 
                    <em><?php echo get_field('process_heading_2', $frontpage_id); ?></em>
                </h2>
            <?php endif; ?>
        </div>
      
        <?php echo do_shortcode( '[process_steps]' ); ?>
      </div>
    </section>

    <?php echo do_shortcode( '[leadership_grid count="3"]' ); ?>

    <section class="regions">
      <div class="regions-inner">
        <div class="sr pg-index-14">
          <?php if ( function_exists( 'get_field' ) ) : ?>
              <p class="s-label pg-index-15">
                <?php echo get_field('region_sub_heading', $frontpage_id); ?>
              </p>
              <h2 class="s-title pg-index-16">
                <?php echo get_field('region_heading', $frontpage_id); ?>
              </h2>
          <?php endif; ?>
        </div>
        
        <div class="regions-grid">
          <?php 
          if ( function_exists( 'have_rows' ) && have_rows( 'region_list', $frontpage_id ) ) : 
            $delay_counter = 0;
            while ( have_rows( 'region_list', $frontpage_id ) ) : the_row(); 
          ?>
            <a class="region-card sr <?php echo ( $delay_counter > 0 ) ? 'sr-d' . $delay_counter : ''; ?>" 
               href="<?php echo esc_url( get_sub_field( 'region_card_link' ) ); ?>">
              <div class="region-area"><?php the_sub_field( 'region_area' ); ?></div>
              <div class="region-name"><?php the_sub_field( 'region_name' ); ?></div>
              <div class="region-fact"><?php the_sub_field( 'region_fact' ); ?></div>
            </a>
          <?php 
            $delay_counter++;
            endwhile;
          else : 
            if ( current_user_can( 'administrator' ) && function_exists( 'get_field' ) ) {
              echo '<p style="grid-column:1/-1; text-align:center; padding:40px;">Add regions in ACF: Edit homepage → Region List repeater</p>';
            }
          endif; 
          ?>
        </div>
      </div>
    </section>

    <?php get_template_part( 'template-parts/cta' ); ?>
    <?php get_template_part( 'template-parts/pull-quote' ); ?>

<?php get_footer(); ?>