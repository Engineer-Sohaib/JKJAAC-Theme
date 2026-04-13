<?php
/**
 * Dynamic Hero Section Template Part
 * 
 * @package JKJAAC
 */

$hero = jkjaac_get_hero_data();
$is_simple = ( $hero['style'] === 'simple' );

// Auto-fallback to page title if both title lines are empty
if ( empty( $hero['title_line1'] ) && empty( $hero['title_line2'] ) && is_page() ) {
    $hero['title_line1'] = get_the_title();
    $hero['style'] = 'simple';
    $is_simple = true;
}
?>

<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid"></div>
    
    <?php if ( ! $is_simple ) : ?>
        <div class="hero-orb"></div>
        
        <?php if ( $hero['show_glyphs'] ) : ?>
        <div aria-hidden="true" class="hero-glyphs">
            <?php if ( ! empty( $hero['glyph_1'] ) ) : ?>
                <div class="glyph pg-index-1"><?php echo esc_html( $hero['glyph_1'] ); ?></div>
            <?php endif; ?>
            <?php if ( ! empty( $hero['glyph_2'] ) ) : ?>
                <div class="glyph pg-index-2"><?php echo esc_html( $hero['glyph_2'] ); ?></div>
            <?php endif; ?>
            <?php if ( ! empty( $hero['glyph_3'] ) ) : ?>
                <div class="glyph pg-index-3"><?php echo esc_html( $hero['glyph_3'] ); ?></div>
            <?php endif; ?>
            <?php if ( ! empty( $hero['glyph_4'] ) ) : ?>
                <div class="glyph pg-index-4"><?php echo esc_html( $hero['glyph_4'] ); ?></div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <?php if ( ! empty( $hero['vert_left'] ) ) : ?>
        <div aria-hidden="true" class="hero-vert"><?php echo esc_html( $hero['vert_left'] ); ?></div>
        <?php endif; ?>
        
        <?php if ( ! empty( $hero['vert_right'] ) ) : ?>
        <div aria-hidden="true" class="hero-vert-r"><?php echo esc_html( $hero['vert_right'] ); ?></div>
        <?php endif; ?>
    <?php else : ?>
        <div class="hero-glow"></div>
    <?php endif; ?>
    
    <svg class="hero-mountains" preserveAspectRatio="none" viewBox="0 0 1440 220" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,220 L0,145 L85,104 L165,122 L265,58 L358,100 L455,40 L542,80 L630,16 L712,64 L804,12 L886,55 L980,18 L1070,62 L1160,26 L1260,68 L1354,42 L1440,74 L1440,220Z"></path>
        <path d="M0,220 L0,175 L135,160 L290,172 L450,152 L605,168 L755,148 L890,162 L1030,150 L1168,164 L1308,154 L1440,164 L1440,220Z"></path>
    </svg>
    
    <div class="hero-content">
        <?php if ( ! empty( $hero['eyebrow'] ) ) : ?>
            <p class="hero-eyebrow"><?php echo esc_html( $hero['eyebrow'] ); ?></p>
        <?php endif; ?>
        
        <h1 class="hero-title">
            <?php if ( ! empty( $hero['title_line1'] ) ) : ?>
                <?php echo esc_html( $hero['title_line1'] ); ?>
            <?php endif; ?>
            <?php if ( ! empty( $hero['title_line2'] ) ) : ?>
                <?php if ( ! empty( $hero['title_line1'] ) ) echo '<br />'; ?>
                <span class="line2"><?php echo esc_html( $hero['title_line2'] ); ?></span>
            <?php endif; ?>
        </h1>
        
        <?php if ( ! empty( $hero['subtitle'] ) ) : ?>
            <p class="hero-sub"><?php echo wp_kses_post( $hero['subtitle'] ); ?></p>
        <?php endif; ?>
        
        <?php if ( $hero['show_buttons'] && ( ! empty( $hero['btn_primary_text'] ) || ! empty( $hero['btn_secondary_text'] ) ) ) : ?>
        <div class="hero-btns">
            <?php if ( ! empty( $hero['btn_primary_text'] ) && ! empty( $hero['btn_primary_link'] ) ) : ?>
                <a class="btn-p" href="<?php echo esc_url( jkjaac_page_url( $hero['btn_primary_link'] ) ); ?>">
                    <svg fill="none" height="14" viewBox="0 0 14 14" width="14">
                        <path d="M7 1v12M1 7h12" stroke="currentColor" stroke-linecap="round" stroke-width="1.5"></path>
                    </svg>
                    <?php echo esc_html( $hero['btn_primary_text'] ); ?>
                </a>
            <?php endif; ?>
            
            <?php if ( ! empty( $hero['btn_secondary_text'] ) && ! empty( $hero['btn_secondary_link'] ) ) : ?>
                <a class="btn-g" href="<?php echo esc_url( jkjaac_page_url( $hero['btn_secondary_link'] ) ); ?>">
                    <?php echo esc_html( $hero['btn_secondary_text'] ); ?>
                </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <?php if ( ! $is_simple && $hero['show_strip'] ) : ?>
        <div class="hero-strip">
            <?php if ( ! empty( $hero['stat_1_num'] ) || ! empty( $hero['stat_1_label'] ) ) : ?>
            <div class="hs">
                <div class="hs-n"><?php echo esc_html( $hero['stat_1_num'] ); ?></div>
                <div class="hs-l"><?php echo esc_html( $hero['stat_1_label'] ); ?></div>
            </div>
            <?php endif; ?>
            
            <?php if ( ! empty( $hero['stat_2_num'] ) || ! empty( $hero['stat_2_label'] ) ) : ?>
            <div class="hs">
                <div class="hs-n"><?php echo esc_html( $hero['stat_2_num'] ); ?></div>
                <div class="hs-l"><?php echo esc_html( $hero['stat_2_label'] ); ?></div>
            </div>
            <?php endif; ?>
            
            <?php if ( ! empty( $hero['stat_3_num'] ) || ! empty( $hero['stat_3_label'] ) ) : ?>
            <div class="hs">
                <div class="hs-n"><?php echo esc_html( $hero['stat_3_num'] ); ?></div>
                <div class="hs-l"><?php echo esc_html( $hero['stat_3_label'] ); ?></div>
            </div>
            <?php endif; ?>
            
            <?php if ( ! empty( $hero['stat_4_num'] ) || ! empty( $hero['stat_4_label'] ) ) : ?>
            <div class="hs">
                <div class="hs-n"><?php echo esc_html( $hero['stat_4_num'] ); ?></div>
                <div class="hs-l"><?php echo esc_html( $hero['stat_4_label'] ); ?></div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
    
    <?php if ( ! empty( $hero['scroll_cue'] ) ) : ?>
    <div class="scroll-cue"><?php echo esc_html( $hero['scroll_cue'] ); ?></div>
    <?php endif; ?>
</section>