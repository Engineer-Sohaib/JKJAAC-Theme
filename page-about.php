<?php
/**
 * Template Name: About Page
 * Template for the About JKJAAC page.
 */
get_header();
?>

<?php get_template_part( 'template-parts/hero' ); ?>

<div class="breadcrumb">
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="bc-sep">›</span>
  <span class="cur">About Us</span>
</div>

<?php echo do_shortcode('[dynamic_ticker]'); ?>

<?php get_template_part( 'template-parts/about-section' ); ?>

<?php if( function_exists('get_field') ): ?>
    <section class="about-section bg-new">
      <div class="about-inner">
        <div class="sr">
          <?php 
          // Get section label
          $section_label = get_field('timeline_section_label');
          if( !empty($section_label) ):
          ?>
            <p class="s-label"><?php echo esc_html($section_label); ?></p>
          <?php else: ?>
            <p class="s-label">Formation &amp; Early Activities</p>
          <?php endif; ?>
          
          <h2 class="s-title">
            <?php 
            $title_part1 = get_field('timeline_main_title_part1');
            $title_part2 = get_field('timeline_main_title_part2');
            
            if( !empty($title_part1) ):
              echo esc_html($title_part1); 
            else:
              echo '2022–2023:';
            endif;
            
            echo ' <br /><em>';
            
            if( !empty($title_part2) ):
              echo esc_html($title_part2);
            else:
              echo 'The Seeds Are Sown';
            endif;
            
            echo '</em>';
            ?>
          </h2>
          
          <div class="prose">
            <?php 
            // Check if paragraphs exist
            if( have_rows('timeline_paragraphs') ):
                // Display paragraphs from repeater
                while( have_rows('timeline_paragraphs') ) : the_row();
                    $paragraph = get_sub_field('paragraph_text');
                    if( !empty($paragraph) ):
                        echo '<p>' . nl2br(esc_html($paragraph)) . '</p>';
                    endif;
                endwhile;
            endif;
            ?>
          </div>
        </div>
        
        <div class="sr sr-d2">
          <div class="timeline-container reveal visible">
            <?php 
            $timeline_title = get_field('timeline_section_title');
            if( !empty($timeline_title) ):
            ?>
              <div><?php echo esc_html($timeline_title); ?></div>
            <?php else: ?>
              <div>Movement Timeline</div>
            <?php endif; ?>
            
            <div class="timeline">
              <?php 
              // Check if timeline events exist
              if( have_rows('timeline_events') ):
                  while( have_rows('timeline_events') ) : the_row();
                      $year = get_sub_field('event_year');
                      $title = get_sub_field('event_title');
                      $description = get_sub_field('event_description');
                      
                      if( !empty($year) && !empty($title) ):
              ?>
                      <div class="tl-item">
                        <div class="tl-dot"></div>
                        <div class="tl-year"><?php echo esc_html($year); ?></div>
                        <div class="tl-title"><?php echo esc_html($title); ?></div>
                        <div class="tl-desc"><?php echo esc_html($description); ?></div>
                      </div>
              <?php 
                      endif;
                  endwhile;
              ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php else: ?>
<?php endif; ?>


<?php echo do_shortcode( '[leadership_grid count="3"]' ); ?>
<?php get_template_part( 'template-parts/pull-quote' ); ?>

<?php get_footer(); ?>