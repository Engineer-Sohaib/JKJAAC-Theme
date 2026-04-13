<?php
/**
 * Template Name: Negotiations Page
 * Detailed record of JKJAAC's negotiations with AJK and federal government.
 */
get_header();

// Get page meta
$preamble_label = get_post_meta( get_the_ID(), '_jkjaac_preamble_label', true ) ?: 'Preamble';
$preamble_title1 = get_post_meta( get_the_ID(), '_jkjaac_preamble_title_line1', true ) ?: 'The 2025 Agreement:';
$preamble_title2 = get_post_meta( get_the_ID(), '_jkjaac_preamble_title_line2', true ) ?: "A People's Victory";
$preamble_desc = get_post_meta( get_the_ID(), '_jkjaac_preamble_description', true );
$preamble_paragraphs = get_post_meta( get_the_ID(), '_jkjaac_preamble_paragraphs', true );

$history_count = get_post_meta( get_the_ID(), '_jkjaac_history_count', true );
$hide_history = get_post_meta( get_the_ID(), '_jkjaac_hide_history_section', true );

$accord_label = get_post_meta( get_the_ID(), '_jkjaac_accord_label', true ) ?: 'The October 4, 2025 Agreement';
$accord_title1 = get_post_meta( get_the_ID(), '_jkjaac_accord_title_line1', true ) ?: 'Key Points of the';
$accord_title2 = get_post_meta( get_the_ID(), '_jkjaac_accord_title_line2', true ) ?: 'Historic Accord';
$accord_desc = get_post_meta( get_the_ID(), '_jkjaac_accord_description', true );
$accord_count = get_post_meta( get_the_ID(), '_jkjaac_accord_count', true );
$hide_accord = get_post_meta( get_the_ID(), '_jkjaac_hide_accord_section', true );

$tracker_label = get_post_meta( get_the_ID(), '_jkjaac_tracker_label', true ) ?: 'Current Status — March 2026';
$tracker_title1 = get_post_meta( get_the_ID(), '_jkjaac_tracker_title_line1', true ) ?: 'Implementation';
$tracker_title2 = get_post_meta( get_the_ID(), '_jkjaac_tracker_title_line2', true ) ?: 'Tracker';
$hide_tracker = get_post_meta( get_the_ID(), '_jkjaac_hide_tracker_section', true );

$progress_bars = get_post_meta( get_the_ID(), '_jkjaac_progress_bars', true );
if ( ! is_array( $progress_bars ) ) {
    $progress_bars = array();
}

// Default preamble paragraphs if not set
if ( ! is_array( $preamble_paragraphs ) ) {
    $preamble_paragraphs = array( '', '' );
}
?>

    <?php get_template_part( 'template-parts/hero' ); ?>

    <div class="breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="bc-sep">›</span>
      <span class="cur">Negotiations</span>
    </div>

    <?php echo do_shortcode('[dynamic_ticker]'); ?>

    <!-- Preamble Section -->
    <section class="about-section">
      <div class="about-inner">
        <div class="sr">
          <p class="s-label"><?php echo esc_html( $preamble_label ); ?></p>
          <h2 class="s-title">
            <?php echo esc_html( $preamble_title1 ); ?><br /><em><?php echo esc_html( $preamble_title2 ); ?></em>
          </h2>
          <?php if ( ! empty( $preamble_desc ) ) : ?>
            <p class="s-desc"><?php echo wp_kses_post( $preamble_desc ); ?></p>
          <?php endif; ?>
        </div>
        <div class="prose sr pg-kfm_charter-1">
          <?php foreach ( $preamble_paragraphs as $para ) : ?>
            <?php if ( ! empty( $para ) ) : ?>
              <p><?php echo wp_kses_post( $para ); ?></p>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- Negotiation History - Dynamic -->
    <?php if ( ! $hide_history ) : 
        $history_shortcode = '[negotiation_rounds show_label="true"';
        if ( ! empty( $history_count ) ) {
            $history_shortcode .= ' count="' . intval( $history_count ) . '"';
        }
        $history_shortcode .= ']';
        echo do_shortcode( $history_shortcode );
    endif; ?>

    <!-- Accord Points Section -->
    <?php if ( ! $hide_accord ) : ?>
    <section class="about-section">
      <div class="team-inner">
        <div class="sr in">
          <p class="s-label"><?php echo esc_html( $accord_label ); ?></p>
          <h2 class="s-title">
            <?php echo esc_html( $accord_title1 ); ?><br /><em><?php echo esc_html( $accord_title2 ); ?></em>
          </h2>
          <?php if ( ! empty( $accord_desc ) ) : ?>
            <div class="prose">
              <p><?php echo wp_kses_post( $accord_desc ); ?></p>
            </div>
          <?php endif; ?>
        </div>
        <?php 
        $shortcode = '[accord_points';
        if ( ! empty( $accord_count ) ) {
            $shortcode .= ' count="' . intval( $accord_count ) . '"';
        }
        $shortcode .= ']';
        echo do_shortcode( $shortcode ); 
        ?>
      </div>
    </section>
    <?php endif; ?>

    <!-- Implementation Tracker Section -->
    <?php if ( ! $hide_tracker ) : ?>
    <section class="process">
      <div class="s-inner">
        <div class="sr">
          <p class="s-label"><?php echo esc_html( $tracker_label ); ?></p>
          <h2 class="s-title"><?php echo esc_html( $tracker_title1 ); ?><br /><em><?php echo esc_html( $tracker_title2 ); ?></em></h2>
        </div>
        
        <?php echo do_shortcode('[implementation_tracker]'); ?>
        
        <?php if ( ! empty( $progress_bars ) ) : ?>
        <div class="bar-content neg">
          <p class="s-label pg-azad_kashmir-9">
            Agreement Implementation Progress — February 2026
          </p>
          <div class="bar-stats">
            <?php foreach ( $progress_bars as $bar ) : ?>
              <div class="bs-row<?php echo ! empty( $bar['warning'] ) ? ' warning' : ( strpos( $bar['label'], 'Confirmed' ) !== false ? ' success' : '' ); ?>">
                <div class="content">
                  <span class="bs-lbl"><?php echo esc_html( $bar['label'] ); ?></span>
                  <span class="bs-val"><?php echo esc_html( $bar['value'] ); ?></span>
                </div>
                <div class="bs-track">
                  <div class="bs-fill" data-width="<?php echo esc_attr( $bar['width'] ); ?>%" style="width: <?php echo esc_attr( $bar['width'] ); ?>%"></div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </section>
    <?php endif; ?>
    
<?php get_template_part('template-parts/pull-quote'); ?>

<?php get_footer(); ?>