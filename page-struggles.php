<?php
/**
 * Template Name: Struggles Page
 * Major protest campaigns and civil resistance history.
 */
get_header();

// Get page meta with defaults
$intro_label = get_post_meta( get_the_ID(), '_jkjaac_intro_label', true ) ?: 'Complete Protest Record';
$intro_title1 = get_post_meta( get_the_ID(), '_jkjaac_intro_title_line1', true ) ?: 'From Sit-In to';
$intro_title2 = get_post_meta( get_the_ID(), '_jkjaac_intro_title_line2', true ) ?: 'National Movement';
$intro_body = get_post_meta( get_the_ID(), '_jkjaac_intro_body', true ) ?: 
    "What began in 2022 as localized protests in Rawalakot over wheat prices has grown into the most significant civil society uprising in Azad Kashmir's modern history — with two major national-level confrontations, 13 civilian lives lost, and a landmark government agreement extracted through sustained peaceful resistance.";

$hide_origins = get_post_meta( get_the_ID(), '_jkjaac_hide_origins', true );
$origins_count = get_post_meta( get_the_ID(), '_jkjaac_origins_count', true );

$hide_stats_2024 = get_post_meta( get_the_ID(), '_jkjaac_hide_stats_2024', true );
$stats_2024_label = get_post_meta( get_the_ID(), '_jkjaac_stats_2024_label', true ) ?: 'Complete Protest Stats';
$stats_2024_title1 = get_post_meta( get_the_ID(), '_jkjaac_stats_2024_title_line1', true ) ?: 'The 2024';
$stats_2024_title2 = get_post_meta( get_the_ID(), '_jkjaac_stats_2024_title_line2', true ) ?: 'Azad Kashmir Protests';
$stats_2024_desc = get_post_meta( get_the_ID(), '_jkjaac_stats_2024_description', true );
$stats_2024_count = get_post_meta( get_the_ID(), '_jkjaac_stats_2024_count', true );

$hide_uprising = get_post_meta( get_the_ID(), '_jkjaac_hide_uprising', true );
$uprising_count = get_post_meta( get_the_ID(), '_jkjaac_uprising_count', true );

$hide_impact_2025 = get_post_meta( get_the_ID(), '_jkjaac_hide_impact_2025', true );
$impact_2025_label = get_post_meta( get_the_ID(), '_jkjaac_impact_2025_label', true ) ?: 'Informative & Direct';
$impact_2025_title1 = get_post_meta( get_the_ID(), '_jkjaac_impact_2025_title_line1', true ) ?: 'The 2025 Azad Kashmir Protests —';
$impact_2025_title2 = get_post_meta( get_the_ID(), '_jkjaac_impact_2025_title_line2', true ) ?: 'A Nation in Lockdown';
$impact_2025_desc = get_post_meta( get_the_ID(), '_jkjaac_impact_2025_description', true );
$impact_2025_count = get_post_meta( get_the_ID(), '_jkjaac_impact_2025_count', true );

$hide_lockdown = get_post_meta( get_the_ID(), '_jkjaac_hide_lockdown', true );
$lockdown_count = get_post_meta( get_the_ID(), '_jkjaac_lockdown_count', true );

$hide_anatomy = get_post_meta( get_the_ID(), '_jkjaac_hide_anatomy', true );
$anatomy_label = get_post_meta( get_the_ID(), '_jkjaac_anatomy_label', true ) ?: "DISRUPTION PROOF: THE MOVEMENT THAT WOULDN'T BE SILENCED";
$anatomy_title1 = get_post_meta( get_the_ID(), '_jkjaac_anatomy_title_line1', true ) ?: 'The Anatomy of the';
$anatomy_title2 = get_post_meta( get_the_ID(), '_jkjaac_anatomy_title_line2', true ) ?: 'JKJAAC Uprising';
$anatomy_desc = get_post_meta( get_the_ID(), '_jkjaac_anatomy_description', true );
$anatomy_count = get_post_meta( get_the_ID(), '_jkjaac_anatomy_count', true );
?>

   <?php get_template_part( 'template-parts/hero' ); ?>

    <div class="breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="bc-sep">›</span>
      <span class="cur">Struggles</span>
    </div>

    <?php echo do_shortcode('[dynamic_ticker]'); ?>
    
    <!-- Intro Section -->
    <section id="population" class="section dark">
      <div class="s-inner">
        <div class="pop-layout">
          <div class="pop-text sr">
            <p class="s-label"><?php echo esc_html( $intro_label ); ?></p>
            <h2 class="s-title">
              <?php echo esc_html( $intro_title1 ); ?> <br /><em><?php echo esc_html( $intro_title2 ); ?></em>
            </h2>
            <p class="pop-body"><?php echo wp_kses_post( $intro_body ); ?></p>
          </div>
        </div>
        
        <!-- Origins Phase (2022-2023) -->
        <?php if ( ! $hide_origins ) : 
            $origins_shortcode = '[protest_timeline phase="origins" container_class="protest-content"';
            if ( ! empty( $origins_count ) ) {
                $origins_shortcode .= ' count="' . intval( $origins_count ) . '"';
            }
            $origins_shortcode .= ']';
            echo do_shortcode( $origins_shortcode );
        endif; ?>
      </div>
    </section>
    
    <!-- 2024 Stats Band -->
    <?php if ( ! $hide_stats_2024 ) : ?>
    <div class="explore-band">
      <div class="explore-inner">
        <div class="sr">
          <span class="s-label"><?php echo esc_html( $stats_2024_label ); ?></span>
          <h2><?php echo esc_html( $stats_2024_title1 ); ?> <em><?php echo esc_html( $stats_2024_title2 ); ?></em></h2>
          <?php if ( ! empty( $stats_2024_desc ) ) : ?>
            <p><?php echo wp_kses_post( $stats_2024_desc ); ?></p>
          <?php endif; ?>
        </div>
        <?php 
        $stats_shortcode = '[protest_stats group="2024-stats"';
        if ( ! empty( $stats_2024_count ) ) {
            $stats_shortcode .= ' count="' . intval( $stats_2024_count ) . '"';
        }
        $stats_shortcode .= ']';
        echo do_shortcode( $stats_shortcode );
        ?>
      </div>
      
      <!-- Uprising Phase (2024) -->
      <?php if ( ! $hide_uprising ) : 
          $uprising_shortcode = '[protest_timeline phase="uprising" container_class="protest-content mt-1 new"';
          if ( ! empty( $uprising_count ) ) {
              $uprising_shortcode .= ' count="' . intval( $uprising_count ) . '"';
          }
          $uprising_shortcode .= ']';
          echo do_shortcode( $uprising_shortcode );
      endif; ?>
    </div>
    <?php endif; ?>
    
    <!-- 2025 Impact Section -->
    <?php if ( ! $hide_impact_2025 ) : ?>
    <section class="section">
      <div class="s-inner">
        <div class="pg-azad_kashmir-19 sr">
          <p class="s-label"><?php echo esc_html( $impact_2025_label ); ?></p>
          <h2 class="s-title">
            <?php echo esc_html( $impact_2025_title1 ); ?> <br /><em><?php echo esc_html( $impact_2025_title2 ); ?></em>
          </h2>
          <?php if ( ! empty( $impact_2025_desc ) ) : ?>
            <p class="s-desc"><?php echo wp_kses_post( $impact_2025_desc ); ?></p>
          <?php endif; ?>
        </div>
        
        <?php 
        $impact_shortcode = '[protest_stats group="2025-impact" layout="gov"';
        if ( ! empty( $impact_2025_count ) ) {
            $impact_shortcode .= ' count="' . intval( $impact_2025_count ) . '"';
        }
        $impact_shortcode .= ']';
        echo do_shortcode( $impact_shortcode );
        ?>
        
        <!-- Lockdown Phase (2025) -->
        <?php if ( ! $hide_lockdown ) : 
            $lockdown_shortcode = '[protest_timeline phase="lockdown" container_class="protest-content mt-1"';
            if ( ! empty( $lockdown_count ) ) {
                $lockdown_shortcode .= ' count="' . intval( $lockdown_count ) . '"';
            }
            $lockdown_shortcode .= ']';
            echo do_shortcode( $lockdown_shortcode );
        endif; ?>
      </div>
    </section>
    <?php endif; ?>
    
    <!-- Anatomy Section -->
    <?php if ( ! $hide_anatomy ) : ?>
    <section id="history" class="section mid">
      <div class="s-inner">
        <div class="history-intro sr">
          <p class="s-label"><?php echo esc_html( $anatomy_label ); ?></p>
          <h2 class="s-title">
            <?php echo esc_html( $anatomy_title1 ); ?> <br /><em><?php echo esc_html( $anatomy_title2 ); ?></em>
          </h2>
          <?php if ( ! empty( $anatomy_desc ) ) : ?>
            <p class="s-desc"><?php echo wp_kses_post( $anatomy_desc ); ?></p>
          <?php endif; ?>
        </div>
        
        <?php 
        $features_shortcode = '[movement_features';
        if ( ! empty( $anatomy_count ) ) {
            $features_shortcode .= ' count="' . intval( $anatomy_count ) . '"';
        }
        $features_shortcode .= ']';
        echo do_shortcode( $features_shortcode );
        ?>
      </div>
    </section>
    <?php endif; ?>
    
<?php get_template_part('template-parts/pull-quote'); ?>

<?php get_footer(); ?>