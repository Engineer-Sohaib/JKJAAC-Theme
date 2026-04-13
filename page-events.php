<?php
/**
 * Template Name: Events Page
 * Upcoming and past events with date-block layout.
 */
get_header();

// Get events page data
$events_data = function_exists( 'jkjaac_get_events_data' ) ? jkjaac_get_events_data() : array();
$categories = isset( $events_data['categories'] ) ? $events_data['categories'] : array();
?>

    <?php get_template_part( 'template-parts/hero' ); ?>

    <div class="breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="bc-sep">›</span>
      <span class="cur">Events</span>
    </div>

    <?php echo do_shortcode('[dynamic_ticker]'); ?>
    
    <div class="why-band">
      <?php foreach ( $categories as $index => $category ) : 
          $delay_class = $index > 0 ? ' sr-d' . $index : '';
          if ( ! empty( $category['title'] ) ) :
      ?>
        <div class="why-card sr<?php echo esc_attr( $delay_class ); ?>">
          <?php if ( ! empty( $category['icon'] ) ) : ?>
            <span class="why-icon"><i class="<?php echo esc_attr( $category['icon'] ); ?>"></i></span>
          <?php endif; ?>
          <div class="why-title"><?php echo esc_html( $category['title'] ); ?></div>
          <?php if ( ! empty( $category['description'] ) ) : ?>
            <div class="why-desc">
              <?php echo esc_html( $category['description'] ); ?>
            </div>
          <?php endif; ?>
        </div>
      <?php 
          endif;
      endforeach; 
      ?>
    </div>

    <section id="upcoming" class="main-section">
      <div class="main-inner pg-events-1">
        <div class="sr">
          <?php if ( ! empty( $events_data['upcoming_label'] ) ) : ?>
            <p class="s-label"><?php echo esc_html( $events_data['upcoming_label'] ); ?></p>
          <?php endif; ?>
          
          <h2 class="s-title">
            <?php echo esc_html( $events_data['upcoming_title_line1'] ); ?>
            <?php if ( ! empty( $events_data['upcoming_title_line2'] ) ) : ?>
              <br /><em><?php echo esc_html( $events_data['upcoming_title_line2'] ); ?></em>
            <?php endif; ?>
          </h2>
          
          <?php if ( ! empty( $events_data['upcoming_description'] ) ) : ?>
            <p class="s-desc">
              <?php echo esc_html( $events_data['upcoming_description'] ); ?>
            </p>
          <?php endif; ?>
        </div>
        
        <?php 
        $upcoming_count = ! empty( $events_data['upcoming_count'] ) ? $events_data['upcoming_count'] : 3;
        echo do_shortcode('[upcoming_events count="' . intval( $upcoming_count ) . '"]'); 
        ?>
      </div>
    </section>

    <section id="past" class="process">
      <div class="s-inner">
        <div class="sr">
          <?php if ( ! empty( $events_data['past_label'] ) ) : ?>
            <p class="s-label"><?php echo esc_html( $events_data['past_label'] ); ?></p>
          <?php endif; ?>
          
          <h2 class="s-title">
            <?php echo esc_html( $events_data['past_title_line1'] ); ?>
            <?php if ( ! empty( $events_data['past_title_line2'] ) ) : ?>
              <br /><em><?php echo esc_html( $events_data['past_title_line2'] ); ?></em>
            <?php endif; ?>
          </h2>
          
          <?php if ( ! empty( $events_data['past_description'] ) ) : ?>
            <p class="s-desc">
              <?php echo esc_html( $events_data['past_description'] ); ?>
            </p>
          <?php endif; ?>
        </div>
        
        <?php 
        $past_count = ! empty( $events_data['past_count'] ) ? $events_data['past_count'] : 4;
        echo do_shortcode('[past_events count="' . intval( $past_count ) . '"]'); 
        ?>
      </div>
    </section>

<?php get_template_part('template-parts/pull-quote'); ?>

<?php get_footer(); ?>