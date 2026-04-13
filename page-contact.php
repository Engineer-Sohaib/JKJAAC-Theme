<?php
/**
 * Template Name: Contact Page
 * Template for the Contact Us page — includes Google Maps and contact form.
 */
get_header();
?>

    <?php get_template_part( 'template-parts/hero' ); ?>

    <div class="breadcrumb">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span class="bc-sep">›</span>
      <span class="cur">Contact Us</span>
    </div>

   <?php echo do_shortcode('[dynamic_ticker]'); ?>

    <section class="contact-section">
      <div class="contact-inner">
        <div class="contact-left sr">
          <p class="s-label"><?php echo esc_html( get_theme_mod( 'jkjaac_contact_label', 'Reach Out' ) ); ?></p>
          <h2 class="s-title">
            <?php echo esc_html( get_theme_mod( 'jkjaac_contact_title_line1', 'Questions or' ) ); ?><br />
            <em><?php echo esc_html( get_theme_mod( 'jkjaac_contact_title_line2', 'Suggestions?' ) ); ?></em>
          </h2>
          <p class="contact-desc">
            <?php echo wp_kses_post( get_theme_mod( 'jkjaac_contact_description', 'Whether you have a question about our mission, want to volunteer, or are looking to support the Kashmir cause — we are here to listen. Every message matters to us.' ) ); ?>
          </p>
          
          <div class="detail-list">
            <?php 
            // WhatsApp
            $whatsapp_number = get_theme_mod( 'jkjaac_whatsapp_number', '+923558153397' );
            $whatsapp_display = get_theme_mod( 'jkjaac_whatsapp_display', '+92 355 8153397' );
            if ( $whatsapp_number ) : 
            ?>
            <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $whatsapp_number ) ); ?>" target="_blank" class="detail-row">
              <div class="dr-icon"><i class="ri-chat-1-line"></i></div>
              <div class="dr-body">
                <div class="dr-label">WhatsApp</div>
                <div class="dr-val"><?php echo esc_html( $whatsapp_display ); ?></div>
              </div>
              <div class="dr-chevron">›</div>
            </a>
            <?php endif; ?>
            
            <?php 
            // Phone
            $phone_number = get_theme_mod( 'jkjaac_phone_number', '+923558153397' );
            $phone_display = get_theme_mod( 'jkjaac_phone_display', '+92 355 8153397' );
            if ( $phone_number ) : 
            ?>
            <a href="tel:<?php echo esc_attr( $phone_number ); ?>" class="detail-row">
              <div class="dr-icon"><i class="ri-phone-line"></i></div>
              <div class="dr-body">
                <div class="dr-label">Call Us</div>
                <div class="dr-val"><?php echo esc_html( $phone_display ); ?></div>
              </div>
              <div class="dr-chevron">›</div>
            </a>
            <?php endif; ?>
            
            <?php 
            // Email
            $contact_email = get_theme_mod( 'jkjaac_contact_email', 'info@jkjaac.com' );
            if ( $contact_email ) : 
            ?>
            <a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="detail-row">
              <div class="dr-icon"><i class="ri-mail-line"></i></div>
              <div class="dr-body">
                <div class="dr-label">Email</div>
                <div class="dr-val"><?php echo esc_html( $contact_email ); ?></div>
              </div>
              <div class="dr-chevron">›</div>
            </a>
            <?php endif; ?>
            
            <?php 
            // Work Hours
            $work_hours = get_theme_mod( 'jkjaac_work_hours', 'Everyday — 08:00 AM to 07:00 PM' );
            if ( $work_hours ) : 
            ?>
            <div class="detail-row">
              <div class="dr-icon"><i class="ri-time-line"></i></div>
              <div class="dr-body">
                <div class="dr-label">Work Hours</div>
                <div class="dr-val"><?php echo esc_html( $work_hours ); ?></div>
              </div>
              <div class="dr-chevron pg-contact-2">›</div>
            </div>
            <?php endif; ?>
            
            <?php 
            // Dynamic Locations
            $locations_count = get_theme_mod( 'jkjaac_locations_count', 4 );
            for ( $i = 1; $i <= $locations_count; $i++ ) :
                $title = get_theme_mod( "jkjaac_location_{$i}_title", '' );
                $subtitle = get_theme_mod( "jkjaac_location_{$i}_subtitle", '' );
                $desc = get_theme_mod( "jkjaac_location_{$i}_desc", '' );
                
                if ( $title || $subtitle || $desc ) :
            ?>
            <div class="detail-row">
              <div class="dr-icon"><i class="ri-map-pin-line"></i></div>
              <div class="dr-body">
                <?php if ( $title ) : ?>
                <div class="pg-leadership-28"><?php echo esc_html( $title ); ?></div>
                <?php endif; ?>
                <?php if ( $subtitle ) : ?>
                <div class="dr-label"><?php echo esc_html( $subtitle ); ?></div>
                <?php endif; ?>
                <?php if ( $desc ) : ?>
                <div class="dr-val"><?php echo wp_kses_post( $desc ); ?></div>
                <?php endif; ?>
              </div>
              <div class="dr-chevron pg-contact-1">›</div>
            </div>
            <?php 
                endif;
            endfor; 
            ?>
          </div>
          
          <p class="pg-contact-10"><?php echo esc_html( get_theme_mod( 'jkjaac_follow_us_label', 'Follow Us' ) ); ?></p>
          
          <div class="social-row">
            <?php 
            $social_platforms = array(
                'facebook'  => array( 'icon' => 'ri-facebook-fill', 'label' => 'Facebook' ),
                'twitter'   => array( 'icon' => 'ri-twitter-x-line', 'label' => 'Twitter' ),
                'youtube'   => array( 'icon' => 'ri-youtube-line', 'label' => 'YouTube' ),
                'instagram' => array( 'icon' => 'ri-instagram-line', 'label' => 'Instagram' ),
                'tiktok'    => array( 'icon' => 'ri-tiktok-line', 'label' => 'TikTok' ),
                'linkedin'  => array( 'icon' => 'ri-linkedin-fill', 'label' => 'LinkedIn' ),
            );
            
            // Always show WhatsApp if number exists
            if ( $whatsapp_number ) : ?>
            <a href="https://wa.me/<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $whatsapp_number ) ); ?>" target="_blank" class="social-btn" title="WhatsApp"><i class="ri-whatsapp-line"></i></a>
            <?php endif;
            
            foreach ( $social_platforms as $key => $data ) :
                $url = get_theme_mod( "jkjaac_social_{$key}", '' );
                if ( $url ) :
            ?>
            <a href="<?php echo esc_url( $url ); ?>" target="_blank" class="social-btn" title="<?php echo esc_attr( $data['label'] ); ?>"><i class="<?php echo esc_attr( $data['icon'] ); ?>"></i></a>
            <?php 
                endif;
            endforeach; 
            ?>
          </div>
        </div>

        <div class="contact-right sr sr-d2">
          <div class="form-header">
            <p class="s-label"><?php echo esc_html( get_theme_mod( 'jkjaac_form_label', 'Send a Message' ) ); ?></p>
            <h2 class="s-title pg-contact-11">
              <?php echo esc_html( get_theme_mod( 'jkjaac_form_title_line1', 'Fill the Form' ) ); ?><br />
              <em><?php echo esc_html( get_theme_mod( 'jkjaac_form_title_line2', 'Below' ) ); ?></em>
            </h2>
          </div>

          <div id="formWrap">
            <span class="subject-pill-label">Subject</span>
            <div class="subject-pills">
              <?php 
              $subject_pills = get_theme_mod( 'jkjaac_subject_pills', "Press\nMedia Archive\nLegal Support\nSolidarity\nDiaspora UK\nGeneral" );
              $pills_array = explode( "\n", $subject_pills );
              $pills_array = array_map( 'trim', $pills_array );
              $pills_array = array_filter( $pills_array );
              
              $first = true;
              foreach ( $pills_array as $pill ) : 
              ?>
              <button class="subject-pill<?php echo $first ? ' active' : ''; ?>" type="button" data-value="<?php echo esc_attr( $pill ); ?>"><?php echo esc_html( $pill ); ?></button>
              <?php $first = false; endforeach; ?>
              
              <?php if ( empty( $pills_array ) ) : ?>
              <button class="subject-pill active" type="button">General</button>
              <?php endif; ?>
            </div>

            <form class="contact-form" id="contactForm" novalidate>
              <input type="hidden" name="action" value="jkjaac_contact">
              <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'jkjaac_nonce' ); ?>">
              <input type="hidden" name="subject" id="contactSubject" value="<?php echo esc_attr( $pills_array[0] ?? 'General' ); ?>">
              
              <div class="form-row">
                <div class="field">
                  <label for="fname">First Name</label>
                  <input type="text" id="fname" name="fname" placeholder="Your first name" autocomplete="given-name" />
                </div>
                <div class="field">
                  <label for="lname">Last Name</label>
                  <input type="text" id="lname" name="lname" placeholder="Your last name" autocomplete="family-name" />
                </div>
              </div>
              <div class="form-row full">
                <div class="field">
                  <label for="email">Email Address</label>
                  <input type="email" id="email" name="email" placeholder="your@email.com" autocomplete="email" />
                </div>
              </div>
              <div class="form-row full">
                <div class="field">
                  <label for="phone">Phone Number <span class="pg-contact-12">(optional)</span></label>
                  <input type="tel" id="phone" name="phone" placeholder="+92 ..." autocomplete="tel" />
                </div>
              </div>
              <div class="form-row full">
                <div class="field">
                  <label for="message">Your Message</label>
                  <textarea id="message" name="message" placeholder="Write your message here…"></textarea>
                </div>
              </div>
              <div class="form-submit">
                <p class="submit-note"><?php echo wp_kses_post( get_theme_mod( 'jkjaac_submit_note', 'We respond within <strong>24 hours</strong> on working days.' ) ); ?></p>
                <button type="submit" class="btn-submit">
                  Send Message
                  <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                    <path d="M1 7h12M8 2l5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </div>
            </form>
          </div>
          
          <div class="form-success" id="formSuccess">
            <div class="success-icon">✓</div>
            <div class="success-title"><?php echo esc_html( get_theme_mod( 'jkjaac_success_title', 'Message Sent!' ) ); ?></div>
            <p class="success-sub"><?php echo esc_html( get_theme_mod( 'jkjaac_success_subtitle', "Thank you for reaching out. We'll get back to you within 24 hours." ) ); ?></p>
          </div>
        </div>
      </div>
    </section>
    
    <?php get_template_part( 'template-parts/map' ); ?>

     <?php 
      if ( shortcode_exists( 'faq_list' ) ) {
          echo do_shortcode( '[faq_list]' );
      }
    ?>

<?php get_footer(); ?>