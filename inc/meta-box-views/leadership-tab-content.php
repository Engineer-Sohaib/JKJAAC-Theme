<?php
/**
 * Leadership Tab Content - Leadership Page Settings
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add nonce field
wp_nonce_field( 'jkjaac_leadership_meta_box', 'jkjaac_leadership_meta_box_nonce' );

// Get saved values
$leadership_override = get_post_meta( $post->ID, '_jkjaac_leadership_override', true );
$leadership_hide_sacrifice = get_post_meta( $post->ID, '_jkjaac_leadership_hide_sacrifice', true );
$leadership_hide_structure = get_post_meta( $post->ID, '_jkjaac_leadership_hide_structure', true );

// Sacrifice Section
$sacrifice_label = get_post_meta( $post->ID, '_jkjaac_sacrifice_label', true );
$sacrifice_title_line1 = get_post_meta( $post->ID, '_jkjaac_sacrifice_title_line1', true );
$sacrifice_title_line2 = get_post_meta( $post->ID, '_jkjaac_sacrifice_title_line2', true );
$sacrifice_description = get_post_meta( $post->ID, '_jkjaac_sacrifice_description', true );

// Persecution Cards (4)
$persecution_cards = get_post_meta( $post->ID, '_jkjaac_persecution_cards', true );
if ( ! is_array( $persecution_cards ) || empty( $persecution_cards ) ) {
    $persecution_cards = array(
        1 => array(
            'icon' => 'ri-user-forbid-line',
            'title' => 'May 8–9, 2024 — Mass Arrests',
            'description' => 'Around 70 JKJAAC activists arrested overnight across Muzaffarabad and Mirpur divisions, including Shaukat Nawaz Mir and multiple core committee members. The crackdown severely backfired, triggering the most intense protests in AJK\'s recent history and ultimately forcing the ₨23 billion relief package.'
        ),
        2 => array(
            'icon' => 'ri-discuss-line',
            'title' => 'September 2025 — Communications Blackout',
            'description' => 'Pakistan\'s Ministry of Interior ordered mobile and internet services suspended across major parts of AJK on September 28–29, 2025, specifically to prevent JKJAAC from coordinating the announced lockdown. Despite the blackout, hundreds of thousands mobilized — a testament to the leadership\'s organizational capacity.'
        ),
        3 => array(
            'icon' => 'ri-file-close-line',
            'title' => '192 FIRs Filed — Later Largely Withdrawn',
            'description' => '192 First Information Reports (FIRs) were filed against JKJAAC activists across the 2024 and 2025 protests. The October 2025 agreement included withdrawal of 177 of these FIRs, a major victory for the movement\'s legal standing and a recognition of the illegitimacy of the prosecutions.'
        ),
        4 => array(
            'icon' => 'ri-file-paper-2-line',
            'title' => 'International Appeal — October 2025',
            'description' => 'Sardar Umar Nazir Kashmiri issued a formal international appeal on October 2, 2025 invoking the UN Charter, UDHR, and ICCPR — marking JKJAAC\'s first formal engagement with international human rights frameworks and gaining coverage from diaspora media worldwide.'
        )
    );
}

// Structure Section
$structure_label = get_post_meta( $post->ID, '_jkjaac_structure_label', true );
$structure_title_line1 = get_post_meta( $post->ID, '_jkjaac_structure_title_line1', true );
$structure_title_line2 = get_post_meta( $post->ID, '_jkjaac_structure_title_line2', true );
$structure_description = get_post_meta( $post->ID, '_jkjaac_structure_description', true );

// Structure Cards (3)
$structure_cards = get_post_meta( $post->ID, '_jkjaac_structure_cards', true );
if ( ! is_array( $structure_cards ) || empty( $structure_cards ) ) {
    $structure_cards = array(
        1 => array(
            'icon' => 'ri-shake-hands-line',
            'title' => 'Collective Decision-Making',
            'description' => "No single leader can unilaterally decide JKJAAC's positions. All major actions require collective committee agreement — preventing individual co-optation by government."
        ),
        2 => array(
            'icon' => 'ri-earth-line',
            'title' => 'Diaspora Network',
            'description' => "Nearly half of AJK's population lives overseas — primarily in the UK. JKJAAC's diaspora network, particularly in Birmingham and London, provides crucial advocacy and financial support."
        ),
        3 => array(
            'icon' => 'ri-smartphone-line',
            'title' => 'Social Media Strategy',
            'description' => "Social media has been central to JKJAAC's organizing — allowing its message to reach every corner of AJK without distortion, even when traditional media aligned with government narratives."
        )
    );
}

// Stats Cards (4)
$stats_cards = get_post_meta( $post->ID, '_jkjaac_stats_cards', true );
if ( ! is_array( $stats_cards ) || empty( $stats_cards ) ) {
    $stats_cards = array(
        1 => array( 'number' => '10', 'label' => 'Districts Represented' ),
        2 => array( 'number' => '4+', 'label' => 'Sector Constituencies' ),
        3 => array( 'number' => '0', 'label' => 'Political Party Ties' ),
        4 => array( 'number' => '3', 'label' => 'Negotiation Rounds' )
    );
}

// Available icons
$available_icons = array(
    'ri-user-forbid-line' => 'User Forbid',
    'ri-discuss-line' => 'Discussion',
    'ri-file-close-line' => 'File Close',
    'ri-file-paper-2-line' => 'Document',
    'ri-shake-hands-line' => 'Handshake',
    'ri-earth-line' => 'Earth/Global',
    'ri-smartphone-line' => 'Smartphone',
    'ri-group-line' => 'Group/People',
    'ri-user-community-line' => 'Community',
    'ri-flag-line' => 'Flag',
    'ri-megaphone-line' => 'Megaphone',
    'ri-scales-line' => 'Justice/Scales',
    'ri-hand-heart-line' => 'Hand Heart',
    'ri-shield-line' => 'Shield',
    'ri-star-line' => 'Star',
    'ri-award-line' => 'Award',
    'ri-calendar-event-line' => 'Calendar Event',
    'ri-map-pin-line' => 'Location',
    'ri-building-4-line' => 'Building',
    'ri-home-line' => 'Home',
    'ri-mail-line' => 'Mail',
    'ri-phone-line' => 'Phone',
    'ri-chat-1-line' => 'Chat',
    'ri-information-line' => 'Information'
);
?>

<div class="jkjaac-meta-box">
    <div class="jkjaac-meta-body">
        <!-- Override Toggle -->
        <div class="jkjaac-toggle-row">
            <input type="checkbox" name="jkjaac_leadership_override" id="jkjaac_leadership_override" value="1" <?php checked( $leadership_override, '1' ); ?> />
            <label for="jkjaac_leadership_override">
                Override default leadership content for this page
                <small>Enable custom leadership content below. Leave unchecked to use defaults.</small>
            </label>
        </div>
        
        <!-- Sacrifice Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Sacrifice Section</h3>
                <span>LEADERS WHO SACRIFICED</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_sacrifice_label">Section Label</label>
                <input type="text" name="jkjaac_sacrifice_label" id="jkjaac_sacrifice_label" 
                       value="<?php echo esc_attr( $sacrifice_label ); ?>" 
                       placeholder="Government Recognition" />
                <small>Small label above the title</small>
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_sacrifice_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_sacrifice_title_line1" id="jkjaac_sacrifice_title_line1" 
                           value="<?php echo esc_attr( $sacrifice_title_line1 ); ?>" 
                           placeholder="Leaders Who" />
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_sacrifice_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_sacrifice_title_line2" id="jkjaac_sacrifice_title_line2" 
                           value="<?php echo esc_attr( $sacrifice_title_line2 ); ?>" 
                           placeholder="Sacrificed" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_sacrifice_description">Description</label>
                <textarea name="jkjaac_sacrifice_description" id="jkjaac_sacrifice_description" rows="4"><?php echo esc_textarea( $sacrifice_description ); ?></textarea>
            </div>
            
            <div class="jkjaac-checkbox-item" style="margin-top: 15px;">
                <input type="checkbox" name="jkjaac_leadership_hide_sacrifice" id="jkjaac_leadership_hide_sacrifice" value="1" <?php checked( $leadership_hide_sacrifice, '1' ); ?> />
                <label for="jkjaac_leadership_hide_sacrifice">Hide Sacrifice Section on this page</label>
            </div>
        </div>
        
        <!-- Persecution Cards Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Persecution Stories</h3>
                <span>4 EVENT CARDS</span>
            </div>
            
            <p class="jkjaac-hint">Customize the 4 persecution event cards.</p>
            
            <?php for ( $i = 1; $i <= 4; $i++ ) : 
                $card = isset( $persecution_cards[ $i ] ) ? $persecution_cards[ $i ] : array( 'icon' => '', 'title' => '', 'description' => '' );
            ?>
                <div class="jkjaac-category-item" style="background: rgba(212, 175, 55, 0.05); border: 1px solid rgba(212, 175, 55, 0.15); border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                    <h4 style="margin: 0 0 15px; color: #d4af37; font-size: 14px; font-weight: 600;">
                        <i class="ri-alert-line" style="margin-right: 6px;"></i>
                        Persecution Event <?php echo $i; ?>
                    </h4>
                    
                    <div class="jkjaac-field">
                        <label for="persecution_icon_<?php echo $i; ?>">Icon</label>
                        <select name="jkjaac_persecution_cards[<?php echo $i; ?>][icon]" id="persecution_icon_<?php echo $i; ?>" style="width: 100%;">
                            <option value="">— Select Icon —</option>
                            <?php foreach ( $available_icons as $value => $label ) : ?>
                                <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $card['icon'], $value ); ?>>
                                    <?php echo esc_html( $label ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="jkjaac-field">
                        <label for="persecution_title_<?php echo $i; ?>">Title</label>
                        <input type="text" name="jkjaac_persecution_cards[<?php echo $i; ?>][title]" 
                               id="persecution_title_<?php echo $i; ?>"
                               value="<?php echo esc_attr( $card['title'] ); ?>" 
                               style="width: 100%;" />
                    </div>
                    
                    <div class="jkjaac-field">
                        <label for="persecution_desc_<?php echo $i; ?>">Description</label>
                        <textarea name="jkjaac_persecution_cards[<?php echo $i; ?>][description]" 
                                  id="persecution_desc_<?php echo $i; ?>"
                                  rows="4" style="width: 100%;"><?php echo esc_textarea( $card['description'] ); ?></textarea>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        
        <!-- Structure Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Organizational Structure</h3>
                <span>COLLECTIVE LEADERSHIP</span>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_structure_label">Section Label</label>
                <input type="text" name="jkjaac_structure_label" id="jkjaac_structure_label" 
                       value="<?php echo esc_attr( $structure_label ); ?>" 
                       placeholder="Organizational Structure" />
            </div>
            
            <div class="jkjaac-row-2">
                <div class="jkjaac-field">
                    <label for="jkjaac_structure_title_line1">Title - Line 1</label>
                    <input type="text" name="jkjaac_structure_title_line1" id="jkjaac_structure_title_line1" 
                           value="<?php echo esc_attr( $structure_title_line1 ); ?>" 
                           placeholder="A Movement Built on" />
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_structure_title_line2">Title - Line 2 (Emphasized)</label>
                    <input type="text" name="jkjaac_structure_title_line2" id="jkjaac_structure_title_line2" 
                           value="<?php echo esc_attr( $structure_title_line2 ); ?>" 
                           placeholder="Collective Leadership" />
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_structure_description">Description</label>
                <textarea name="jkjaac_structure_description" id="jkjaac_structure_description" rows="5"><?php echo esc_textarea( $structure_description ); ?></textarea>
            </div>
            
            <div class="jkjaac-checkbox-item" style="margin-top: 15px;">
                <input type="checkbox" name="jkjaac_leadership_hide_structure" id="jkjaac_leadership_hide_structure" value="1" <?php checked( $leadership_hide_structure, '1' ); ?> />
                <label for="jkjaac_leadership_hide_structure">Hide Structure Section on this page</label>
            </div>
        </div>
        
        <!-- Structure Cards Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Structure Cards</h3>
                <span>3 FEATURE CARDS</span>
            </div>
            
            <p class="jkjaac-hint">Customize the 3 structure cards (Collective Decision-Making, Diaspora Network, Social Media Strategy).</p>
            
            <?php for ( $i = 1; $i <= 3; $i++ ) : 
                $card = isset( $structure_cards[ $i ] ) ? $structure_cards[ $i ] : array( 'icon' => '', 'title' => '', 'description' => '' );
            ?>
                <div class="jkjaac-category-item" style="background: rgba(212, 175, 55, 0.05); border: 1px solid rgba(212, 175, 55, 0.15); border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                    <h4 style="margin: 0 0 15px; color: #d4af37; font-size: 14px; font-weight: 600;">
                        <i class="ri-layout-grid-line" style="margin-right: 6px;"></i>
                        Structure Card <?php echo $i; ?>
                    </h4>
                    
                    <div class="jkjaac-field">
                        <label for="structure_icon_<?php echo $i; ?>">Icon</label>
                        <select name="jkjaac_structure_cards[<?php echo $i; ?>][icon]" id="structure_icon_<?php echo $i; ?>" style="width: 100%;">
                            <option value="">— Select Icon —</option>
                            <?php foreach ( $available_icons as $value => $label ) : ?>
                                <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $card['icon'], $value ); ?>>
                                    <?php echo esc_html( $label ); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="jkjaac-field">
                        <label for="structure_title_<?php echo $i; ?>">Title</label>
                        <input type="text" name="jkjaac_structure_cards[<?php echo $i; ?>][title]" 
                               id="structure_title_<?php echo $i; ?>"
                               value="<?php echo esc_attr( $card['title'] ); ?>" 
                               style="width: 100%;" />
                    </div>
                    
                    <div class="jkjaac-field">
                        <label for="structure_desc_<?php echo $i; ?>">Description</label>
                        <textarea name="jkjaac_structure_cards[<?php echo $i; ?>][description]" 
                                  id="structure_desc_<?php echo $i; ?>"
                                  rows="3" style="width: 100%;"><?php echo esc_textarea( $card['description'] ); ?></textarea>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
        
        <!-- Stats Cards Section -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Statistics Cards</h3>
                <span>4 STAT CARDS AT BOTTOM</span>
            </div>
            
            <p class="jkjaac-hint">Customize the 4 statistics cards.</p>
            
            <table class="jkjaac-demands-table">
                <thead>
                    <tr>
                        <th style="width: 30%;">Number/Value</th>
                        <th style="width: 70%;">Label</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ( $i = 1; $i <= 4; $i++ ) : 
                        $stat = isset( $stats_cards[ $i ] ) ? $stats_cards[ $i ] : array( 'number' => '', 'label' => '' );
                    ?>
                        <tr>
                            <td>
                                <input type="text" name="jkjaac_stats_cards[<?php echo $i; ?>][number]" 
                                       value="<?php echo esc_attr( $stat['number'] ); ?>" 
                                       placeholder="10" style="width: 100%;" />
                            </td>
                            <td>
                                <input type="text" name="jkjaac_stats_cards[<?php echo $i; ?>][label]" 
                                       value="<?php echo esc_attr( $stat['label'] ); ?>" 
                                       placeholder="Districts Represented" style="width: 100%;" />
                            </td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .jkjaac-category-item {
        transition: border-color 0.2s ease;
    }
    
    .jkjaac-category-item:hover {
        border-color: rgba(212, 175, 55, 0.3);
    }
    
    .jkjaac-category-item h4 i {
        color: #d4af37;
    }
</style>