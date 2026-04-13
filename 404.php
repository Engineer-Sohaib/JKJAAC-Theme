<?php
/**
 * 404 Not Found template.
 */
get_header();
?>

    <section class="hero">
      <div class="hero-bg"></div>
      <div class="hero-grid"></div>
      <div class="hero-glow"></div>
      <svg
        class="hero-mountains"
        viewBox="0 0 1440 180"
        preserveAspectRatio="none"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M0,180 L0,120 L90,85 L170,105 L270,50 L365,90 L460,35 L548,72 L635,15 L715,60 L808,8 L890,52 L985,14 L1075,58 L1165,22 L1265,65 L1355,38 L1440,70 L1440,180Z" />
        <path d="M0,180 L0,152 L140,135 L300,148 L460,126 L610,145 L760,122 L900,138 L1040,125 L1180,140 L1320,128 L1440,142 L1440,180Z" />
      </svg>
      <div class="hero-content">
        <p class="hero-eyebrow">404</p>
        <h1 class="hero-title">Page Not<span class="acc"> Found</span></h1>
        <p class="hero-sub">
          The page you're looking for doesn't exist or has been moved.
          Return to the homepage and continue exploring our movement.
        </p>
        <div class="hero-btns">
          <a class="btn-p" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to Home</a>
          <a class="btn-g" href="<?php echo esc_url( jkjaac_page_url( 'contact' ) ); ?>">Contact Us</a>
        </div>
      </div>
    </section>

<?php get_footer(); ?>
