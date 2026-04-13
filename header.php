<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    
    <?php
    // Use WordPress core site icon if set, otherwise fallback
    if ( has_site_icon() ) {
        wp_site_icon();
    } else {
    ?>
    <link
      href="https://jkjaac.co/wp-content/uploads/2026/03/cropped-JKJAAC-Logo-192x192.png"
      rel="icon"
      sizes="32x32" />
    <link
      href="https://kfmovement.com/wp-content/uploads/2025/02/cropped-Rounded-192x192.png"
      rel="icon"
      sizes="192x192" />
    <link
      href="https://kfmovement.com/wp-content/uploads/2025/02/cropped-Rounded-180x180.png"
      rel="apple-touch-icon" />
    <?php } ?>
    
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <nav class="nav" id="nav">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
        <img
          src="<?php echo esc_url( get_theme_mod( 'jkjaac_header_logo', 'https://jkjaac.co/wp-content/uploads/2026/03/cropped-JKJAAC-Logo.png' ) ); ?>"
          alt="<?php echo esc_attr( get_theme_mod( 'jkjaac_header_logo_alt', 'JKJAAC LOGO' ) ); ?>" />
      </a>
      
      <div class="nav-default">
        <?php
        $menu_id = get_theme_mod( 'jkjaac_primary_menu_id', '' );
        
        if ( ! empty( $menu_id ) && is_nav_menu( $menu_id ) ) :
            // Use WordPress menu with custom walker
            wp_nav_menu( array(
                'menu'            => $menu_id,
                'container'       => false,
                'menu_class'      => 'nav-links',
                'fallback_cb'     => false,
                'walker'          => new JKJAAC_Nav_Walker(),
                'depth'           => 3,
            ) );
            
            // Add mobile CTA item if enabled
            if ( get_theme_mod( 'jkjaac_mobile_cta_show', true ) ) :
                $cta_url = jkjaac_get_cta_url();
                $cta_text = get_theme_mod( 'jkjaac_mobile_cta_text', 'Contact Us' );
            ?>
            <script>
            (function() {
                // Add mobile CTA item to the end of nav-links
                document.addEventListener('DOMContentLoaded', function() {
                    var navLinks = document.querySelector('.nav-links');
                    if (navLinks) {
                        var mobileCtaItem = document.createElement('li');
                        mobileCtaItem.className = 'nav-mobile-donate-item';
                        mobileCtaItem.innerHTML = '<a href="<?php echo esc_url( $cta_url ); ?>"><?php echo esc_html( $cta_text ); ?> <i class="ri-arrow-right-long-line"></i></a>';
                        navLinks.appendChild(mobileCtaItem);
                    }
                });
            })();
            </script>
            <?php endif;
            
        else :
            // Fallback to hardcoded menu
        ?>
        <ul class="nav-links">
          <li>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo ( is_front_page() ? ' class="active"' : '' ); ?>>Home</a>
          </li>
          <li class="has-dropdown">
            <a href="#0"<?php echo ( is_page( array( 'about', 'leadership' ) ) ? ' class="active"' : '' ); ?>>
              About
              <span class="nav-arrow">
                <i class="ri-arrow-down-s-line"></i>
              </span>
            </a>
            <ul class="dropdown">
              <li><a href="<?php echo esc_url( jkjaac_page_url( 'about' ) ); ?>"<?php echo ( is_page( 'about' ) ? ' class="active"' : '' ); ?>>About JKJAAC</a></li>
              <li><a href="<?php echo esc_url( jkjaac_page_url( 'leadership' ) ); ?>"<?php echo ( is_page( 'leadership' ) ? ' class="active"' : '' ); ?>>Leadership</a></li>
            </ul>
          </li>
          <li><a href="<?php echo esc_url( jkjaac_page_url( 'struggles' ) ); ?>"<?php echo ( is_page( 'struggles' ) ? ' class="active"' : '' ); ?>>Struggles</a></li>
          <li>
            <a href="<?php echo esc_url( jkjaac_page_url( '38-point-charter' ) ); ?>"<?php echo ( is_page( '38-point-charter' ) ? ' class="active"' : '' ); ?>>38-Point Charter</a>
          </li>
          <li>
            <a href="<?php echo esc_url( jkjaac_page_url( 'negotiations' ) ); ?>"<?php echo ( is_page( 'negotiations' ) ? ' class="active"' : '' ); ?>>Negotiations</a>
          </li>
          <li class="has-dropdown">
            <a href="#0"<?php echo ( is_page( array( 'blogs', 'gallery', 'events', 'faqs' ) ) ? ' class="active"' : '' ); ?>>
              Media
              <span class="nav-arrow"><i class="ri-arrow-down-s-line"></i></span>
            </a>
            <ul class="dropdown">
              <li><a href="<?php echo esc_url( jkjaac_page_url( 'blogs' ) ); ?>"<?php echo ( is_page( 'blogs' ) ? ' class="active"' : '' ); ?>>Blogs</a></li>
              <li><a href="<?php echo esc_url( jkjaac_page_url( 'gallery' ) ); ?>"<?php echo ( is_page( 'gallery' ) ? ' class="active"' : '' ); ?>>Gallery</a></li>
              <li><a href="<?php echo esc_url( jkjaac_page_url( 'events' ) ); ?>"<?php echo ( is_page( 'events' ) ? ' class="active"' : '' ); ?>>Events</a></li>
              <li><a href="<?php echo esc_url( jkjaac_page_url( 'faqs' ) ); ?>"<?php echo ( is_page( 'faqs' ) ? ' class="active"' : '' ); ?>>Faqs</a></li>
            </ul>
          </li>
          <li class="nav-mobile-donate-item">
            <a href="<?php echo esc_url( jkjaac_page_url( 'contact' ) ); ?>">
              Contact Us <i class="ri-arrow-right-long-line"></i>
            </a>
          </li>
        </ul>
        <?php endif; ?>
      </div>
      
      <div class="right-menu">
        <?php if ( get_theme_mod( 'jkjaac_header_cta_show', true ) ) : 
            $cta_url = jkjaac_get_cta_url();
            $cta_text = get_theme_mod( 'jkjaac_header_cta_text', 'contact us' );
            $cta_target = get_theme_mod( 'jkjaac_header_cta_target', false ) ? ' target="_blank" rel="noopener"' : '';
        ?>
        <a class="nav-cta" href="<?php echo esc_url( $cta_url ); ?>"<?php echo $cta_target; ?>>
          <?php echo esc_html( $cta_text ); ?>
          <?php if ( get_theme_mod( 'jkjaac_header_cta_arrow', true ) ) : ?>
          <span class="nav-cta-arrow">
            <i class="ri-arrow-right-long-line"></i>
          </span>
          <?php endif; ?>
        </a>
        <?php endif; ?>
        
        <div class="nav-hamburger" id="navToggle">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </nav>