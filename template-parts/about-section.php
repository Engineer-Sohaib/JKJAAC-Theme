<?php
/**
 * Dynamic About Section Template Part
 * 
 * Displays only on About page
 * 
 * @package JKJAAC
 */

// Only display on about page
if ( ! is_page( 'about' ) && ! is_page( 'about-us' ) ) {
    return;
}

$about = jkjaac_get_about_data();

if ( $about['hide_section'] ) {
    return;
}

// Define fallback image URL
$fallback_image = get_template_directory_uri() . '/images/post-default-placeholder.png';
?>

<section class="about-section">
    <div class="about-inner">
        <!-- Left Column: Text Content -->
        <div class="sr">
            <!-- Section Label -->
            <?php if ( ! empty( $about['label'] ) ) : ?>
                <p class="s-label"><?php echo esc_html( $about['label'] ); ?></p>
            <?php endif; ?>
            
            <!-- Section Title -->
            <?php if ( ! empty( $about['title_line1'] ) || ! empty( $about['title_line2'] ) ) : ?>
                <h2 class="s-title">
                    <?php echo esc_html( $about['title_line1'] ); ?>
                    <?php if ( ! empty( $about['title_line2'] ) ) : ?>
                        <br /><em><?php echo esc_html( $about['title_line2'] ); ?></em>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>
            
            <!-- Optional Short Description -->
            <?php if ( ! empty( $about['description'] ) ) : ?>
                <div class="prose">
                    <p><?php echo wp_kses_post( $about['description'] ); ?></p>
                </div>
            <?php endif; ?>
            
            <!-- Main Content Paragraphs -->
            <?php if ( ! empty( $about['paragraphs'] ) && is_array( $about['paragraphs'] ) ) : ?>
                <div class="prose">
                    <?php foreach ( $about['paragraphs'] as $paragraph ) : ?>
                        <?php if ( ! empty( $paragraph ) ) : ?>
                            <p><?php echo wp_kses_post( $paragraph ); ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <!-- Inline Quote (appears within text column) -->
            <?php if ( ! empty( $about['quote_text'] ) ) : ?>
                <div class="short-info">
                    <blockquote class="short-info-block">
                        <?php echo wp_kses_post( $about['quote_text'] ); ?>
                    </blockquote>
                    <?php if ( ! empty( $about['quote_cite'] ) ) : ?>
                        <cite><?php echo esc_html( $about['quote_cite'] ); ?></cite>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Right Column: Visual Elements -->
        <div class="sr sr-d2">
            <!-- Image with Caption -->
            <?php 
            $image_url = '';
            if ( ! empty( $about['image_id'] ) ) {
                $image_url = wp_get_attachment_image_url( $about['image_id'], 'large' );
            } elseif ( ! empty( $about['image_url'] ) ) {
                $image_url = $about['image_url'];
            }
            
            // Use fallback if no image URL is set
            $final_image_url = ! empty( $image_url ) ? $image_url : $fallback_image;
            ?>
            <div class="vision-img">
                <img 
                    src="<?php echo esc_url( $final_image_url ); ?>" 
                    alt="<?php echo esc_attr( $about['image_alt'] ?: $about['caption_title'] ?: 'About JKJAAC' ); ?>"
                    onerror="this.onerror=null;this.src='<?php echo esc_js( $fallback_image ); ?>';" />
                <div class="vision-img-overlay"></div>
                
                <?php if ( ! empty( $about['caption_title'] ) || ! empty( $about['caption_text'] ) ) : ?>
                    <div class="vision-img-cap">
                        <?php if ( ! empty( $about['caption_title'] ) ) : ?>
                            <h4><?php echo esc_html( $about['caption_title'] ); ?></h4>
                        <?php endif; ?>
                        <?php if ( ! empty( $about['caption_text'] ) ) : ?>
                            <p><?php echo esc_html( $about['caption_text'] ); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Secondary Quote (appears below image) -->
            <?php if ( ! empty( $about['quote2_text'] ) ) : ?>
                <div class="short-info">
                    <blockquote class="short-info-block">
                        <?php echo wp_kses_post( $about['quote2_text'] ); ?>
                    </blockquote>
                    <?php if ( ! empty( $about['quote2_cite'] ) ) : ?>
                        <cite><?php echo esc_html( $about['quote2_cite'] ); ?></cite>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>