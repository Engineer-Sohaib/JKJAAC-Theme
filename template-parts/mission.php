<?php
/**
 * Dynamic Mission Section Template Part
 * 
 * Displays only on Home and About pages
 * 
 * @package JKJAAC
 */

// Only display on home page or about page
if ( ! is_front_page() && ! is_home() && ! is_page( 'about' ) && ! is_page( 'about-us' ) ) {
    return;
}

$mission = jkjaac_get_mission_data();

if ( $mission['hide_section'] ) {
    return;
}

// Define fallback image URL
$fallback_image = get_template_directory_uri() . '/images/post-default-placeholder.png';
?>

<section class="mission">
    <div class="mission-inner">
        <div class="sr">
            <?php if ( ! empty( $mission['label'] ) ) : ?>
                <p class="s-label"><?php echo esc_html( $mission['label'] ); ?></p>
            <?php endif; ?>
            
            <?php if ( ! empty( $mission['title'] ) || ! empty( $mission['title_accent'] ) ) : ?>
                <h2 class="s-title">
                    <?php echo esc_html( $mission['title'] ); ?>
                    <?php if ( ! empty( $mission['title_accent'] ) ) : ?>
                        <em><?php echo esc_html( $mission['title_accent'] ); ?></em>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>
            
            <?php if ( ! empty( $mission['description'] ) ) : ?>
                <div class="s-body">
                    <?php echo wp_kses_post( wpautop( $mission['description'] ) ); ?>
                </div>
            <?php endif; ?>
            
            <?php if ( ! empty( $mission['demands'] ) && is_array( $mission['demands'] ) ) : ?>
                <div class="decl-list new-p pg-index-5">
                    <?php foreach ( $mission['demands'] as $index => $demand ) : ?>
                        <?php if ( ! empty( $demand['text'] ) ) : ?>
                            <div class="decl-item">
                                <div class="decl-n"><?php echo esc_html( $demand['number'] ?: ( $index + 1 ) ); ?></div>
                                <div class="decl-t"><?php echo esc_html( $demand['text'] ); ?></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="mission-visual sr sr-d2">
            <?php 
            $image_url = '';
            if ( ! empty( $mission['image_id'] ) ) {
                $image_url = wp_get_attachment_image_url( $mission['image_id'], 'large' );
            } elseif ( ! empty( $mission['image_url'] ) ) {
                $image_url = $mission['image_url'];
            }
            
            // Use fallback if no image URL is set
            $final_image_url = ! empty( $image_url ) ? $image_url : $fallback_image;
            ?>
            <div class="mission-img-wrap">
                <img 
                    alt="<?php echo esc_attr( $mission['image_alt'] ?: $mission['caption_title'] ?: 'Mission Image' ); ?>"
                    onerror="this.onerror=null;this.src='<?php echo esc_js( $fallback_image ); ?>';"
                    src="<?php echo esc_url( $final_image_url ); ?>" />
                <div class="mission-img-overlay"></div>
                <?php if ( ! empty( $mission['caption_title'] ) || ! empty( $mission['caption_text'] ) ) : ?>
                    <div class="mission-img-caption">
                        <?php if ( ! empty( $mission['caption_title'] ) ) : ?>
                            <h3><?php echo esc_html( $mission['caption_title'] ); ?></h3>
                        <?php endif; ?>
                        <?php if ( ! empty( $mission['caption_text'] ) ) : ?>
                            <p><?php echo esc_html( $mission['caption_text'] ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php if ( ! empty( $mission['quote_text'] ) ) : ?>
                <div class="mission-quote">
                    <blockquote>
                        "<?php echo esc_html( $mission['quote_text'] ); ?>"
                    </blockquote>
                    <?php if ( ! empty( $mission['quote_cite'] ) ) : ?>
                        <cite><?php echo esc_html( $mission['quote_cite'] ); ?></cite>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>