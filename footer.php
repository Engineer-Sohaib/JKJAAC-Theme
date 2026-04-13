<?php
/**
 * Footer template
 *
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php if ( get_theme_mod( 'jkjaac_back_to_top_show', true ) ) : ?>
<div class="back-to-top"><i class="ri-arrow-up-s-line"></i></div>
<?php endif; ?>

    <footer>
      <div class="footer-grid">
        <div class="footer-brand">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="f-logo">
            <img
              src="<?php echo esc_url( get_theme_mod( 'jkjaac_footer_logo', 'https://jkjaac.co/wp-content/uploads/2026/03/cropped-JKJAAC-Logo.png' ) ); ?>"
              alt="<?php echo esc_attr( get_theme_mod( 'jkjaac_footer_logo_alt', 'JKJAAC LOGO' ) ); ?>" />
          </a>
          <p>
            <?php echo wp_kses_post( get_theme_mod( 'jkjaac_footer_description', 'Jammu Kashmir Joint Awami Action Committee — a grassroots civil society coalition fighting for economic justice, resource rights, and democratic accountability in Azad Jammu & Kashmir since 2022.' ) ); ?>
          </p>
          <div class="social-row">
            <?php 
            $social_links = jkjaac_get_footer_social_links();
            if ( ! empty( $social_links ) ) :
                foreach ( $social_links as $link ) : ?>
                  <a href="<?php echo esc_url( $link['url'] ); ?>" class="social-btn" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $link['label'] ); ?>">
                    <i class="<?php echo esc_attr( $link['icon'] ); ?>"></i>
                  </a>
                <?php endforeach;
            else : ?>
              <!-- Default social links if none set in customizer -->
              <a href="#0" class="social-btn"><i class="ri-facebook-line"></i></a>
              <a href="#0" class="social-btn"><i class="ri-twitter-x-line"></i></a>
              <a href="#0" class="social-btn"><i class="ri-youtube-line"></i></a>
              <a href="#0" class="social-btn"><i class="ri-instagram-line"></i></a>
            <?php endif; ?>
          </div>
        </div>
        
        <?php
        // Column 1 - Pages
        if ( jkjaac_footer_column_has_links( 1 ) ) :
            $col1_links = jkjaac_get_footer_column_links( 1 );
            $col1_title = get_theme_mod( 'jkjaac_footer_col1_title', 'Pages' );
        ?>
        <div class="f-col">
          <h4><?php echo esc_html( $col1_title ); ?></h4>
          <ul>
            <?php foreach ( $col1_links as $link ) : ?>
            <li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['text'] ); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
        
        <?php
        // Column 2 - More
        if ( jkjaac_footer_column_has_links( 2 ) ) :
            $col2_links = jkjaac_get_footer_column_links( 2 );
            $col2_title = get_theme_mod( 'jkjaac_footer_col2_title', 'More' );
        ?>
        <div class="f-col">
          <h4><?php echo esc_html( $col2_title ); ?></h4>
          <ul>
            <?php foreach ( $col2_links as $link ) : ?>
            <li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['text'] ); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
        
        <?php
        // Column 3 - Connect
        if ( jkjaac_footer_column_has_links( 3 ) ) :
            $col3_links = jkjaac_get_footer_column_links( 3 );
            $col3_title = get_theme_mod( 'jkjaac_footer_col3_title', 'Connect' );
        ?>
        <div class="f-col">
          <h4><?php echo esc_html( $col3_title ); ?></h4>
          <ul>
            <?php foreach ( $col3_links as $link ) : ?>
            <li><a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['text'] ); ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>
        
        <?php if ( get_theme_mod( 'jkjaac_footer_newsletter_show', true ) ) : ?>
        <div class="f-col f-newsletter">
          <h4><?php echo esc_html( get_theme_mod( 'jkjaac_footer_newsletter_title', 'Stay Connected' ) ); ?></h4>
          <p class="newsletter-desc">
            <?php echo esc_html( get_theme_mod( 'jkjaac_footer_newsletter_desc', "Stay updated on JKJAAC's campaigns and victories. No spam, ever." ) ); ?>
          </p>
          <form class="newsletter-form" id="footer-newsletter-form">
            <div class="newsletter-field">
              <input
                aria-label="<?php esc_attr_e( 'Email address', 'jkjaac' ); ?>"
                placeholder="<?php echo esc_attr( get_theme_mod( 'jkjaac_footer_newsletter_placeholder', 'Your email address' ) ); ?>"
                required
                type="email"
                name="newsletter_email" />
              <button aria-label="<?php esc_attr_e( 'Subscribe', 'jkjaac' ); ?>" type="submit">
                <i class="ri-send-plane-fill"></i>
              </button>
            </div>
            <p aria-live="polite" class="newsletter-msg"></p>
          </form>
        </div>
        <?php endif; ?>
      </div>
      <div class="footer-bottom">
        <p><?php echo wp_kses_post( get_theme_mod( 'jkjaac_footer_copyright', '© 2025–2026 JKJAAC — Jammu Kashmir Joint Awami Action Committee' ) ); ?></p>
        <p class="pg-index-18"><?php echo esc_html( get_theme_mod( 'jkjaac_footer_location', 'Azad Jammu & Kashmir' ) ); ?></p>
      </div>
    </footer>

    <?php wp_footer(); ?>
    
    <script>
    (function() {
      // Footer Newsletter AJAX Handler
      const form = document.getElementById('footer-newsletter-form');
      if (form) {
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          
          const emailInput = this.querySelector('input[name="newsletter_email"]');
          const msgEl = this.querySelector('.newsletter-msg');
          const submitBtn = this.querySelector('button[type="submit"]');
          const email = emailInput.value.trim();
          
          // Reset message
          msgEl.textContent = '';
          msgEl.classList.remove('success', 'error');
          
          // Validation
          if (!email) {
            msgEl.textContent = '<?php echo esc_js( get_theme_mod( 'jkjaac_footer_newsletter_error', 'Please enter a valid email address.' ) ); ?>';
            msgEl.classList.add('error');
            return;
          }
          
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (!emailRegex.test(email)) {
            msgEl.textContent = '<?php echo esc_js( get_theme_mod( 'jkjaac_footer_newsletter_error', 'Please enter a valid email address.' ) ); ?>';
            msgEl.classList.add('error');
            return;
          }
          
          // Disable button
          submitBtn.disabled = true;
          msgEl.textContent = 'Subscribing...';
          
          // Prepare form data
          const formData = new FormData();
          formData.append('action', 'jkjaac_newsletter');
          formData.append('email', email);
          formData.append('nonce', jkjaacData.nonce);
          
          // Send AJAX request
          fetch(jkjaacData.ajaxUrl, {
            method: 'POST',
            body: formData
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              let successMsg = '<?php echo esc_js( get_theme_mod( 'jkjaac_footer_newsletter_success', '✓ Subscribed! Thank you.' ) ); ?>';
              msgEl.textContent = data.data.message || successMsg;
              msgEl.classList.add('success');
              emailInput.value = '';
            } else {
              let errorMsg;
              if (data.data.message === 'duplicate') {
                errorMsg = '<?php echo esc_js( get_theme_mod( 'jkjaac_footer_newsletter_duplicate', "You're already subscribed!" ) ); ?>';
              } else {
                errorMsg = data.data.message || '<?php echo esc_js( get_theme_mod( 'jkjaac_footer_newsletter_error', 'Please enter a valid email address.' ) ); ?>';
              }
              msgEl.textContent = errorMsg;
              msgEl.classList.add('error');
            }
          })
          .catch(error => {
            console.error('Newsletter error:', error);
            msgEl.textContent = 'An error occurred. Please try again.';
            msgEl.classList.add('error');
          })
          .finally(() => {
            submitBtn.disabled = false;
          });
        });
      }
    })();
    </script>
  </body>
</html>