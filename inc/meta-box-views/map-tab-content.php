<?php
/**
 * Map Tab Content - Contact Page Map Settings
 * 
 * @package JKJAAC
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get saved values
$map_override = get_post_meta( $post->ID, '_jkjaac_map_override', true );
$map_locations = get_post_meta( $post->ID, '_jkjaac_map_locations', true );
$map_center_lat = get_post_meta( $post->ID, '_jkjaac_map_center_lat', true );
$map_center_lng = get_post_meta( $post->ID, '_jkjaac_map_center_lng', true );
$map_zoom = get_post_meta( $post->ID, '_jkjaac_map_zoom', true );
$map_tile_url = get_post_meta( $post->ID, '_jkjaac_map_tile_url', true );
$map_hide_section = get_post_meta( $post->ID, '_jkjaac_map_hide_section', true );

// Set defaults if empty
if ( empty( $map_center_lat ) ) $map_center_lat = '33.5';
if ( empty( $map_center_lng ) ) $map_center_lng = '73.7';
if ( empty( $map_zoom ) ) $map_zoom = '8';
if ( empty( $map_tile_url ) ) $map_tile_url = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

// Default locations
if ( ! is_array( $map_locations ) || empty( $map_locations ) ) {
    $map_locations = array(
        array(
            'address' => 'Muzaffarabad City Center, AJK',
            'description' => 'All three divisions represented: Muzaffarabad, Poonch & Mirpur.',
            'lat' => '34.37',
            'lng' => '73.47',
            'icon' => 'default'
        ),
        array(
            'address' => 'Rawalakot, AJK - Pearl Valley',
            'description' => 'Origin of the 2022 electricity bill protests.',
            'lat' => '33.8578',
            'lng' => '73.7594',
            'icon' => 'default'
        ),
        array(
            'address' => 'Mirpur, AJK - New City',
            'description' => 'Mangla Dam region — heart of the electricity sovereignty issue.',
            'lat' => '33.148',
            'lng' => '73.748',
            'icon' => 'default'
        )
    );
}

// Available marker icons
$marker_icons = array(
    'default' => 'Default (Blue)',
    'gold' => 'Gold (JKJAAC Theme)',
    'red' => 'Red',
    'green' => 'Green',
    'purple' => 'Purple'
);

// Tile providers
$tile_providers = array(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png' => 'OpenStreetMap (Standard)',
    'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png' => 'CartoDB Light',
    'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png' => 'CartoDB Dark',
    'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}' => 'Satellite (ArcGIS)',
    'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png' => 'OpenTopoMap (Terrain)'
);

// Enqueue Leaflet CSS for preview
wp_enqueue_style( 'leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css', array(), '1.9.4' );
wp_enqueue_script( 'leaflet', 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', array(), '1.9.4', true );
?>

<div class="jkjaac-meta-box">
    <div class="jkjaac-meta-body">
        <!-- Override Toggle -->
        <div class="jkjaac-toggle-row">
            <input type="checkbox" name="jkjaac_map_override" id="jkjaac_map_override" value="1" <?php checked( $map_override, '1' ); ?> />
            <label for="jkjaac_map_override">
                Override default map settings for this page
                <small>Enable custom map content below. Leave unchecked to use defaults.</small>
            </label>
        </div>
        
        <!-- Map Settings -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Map Configuration</h3>
                <span>CENTER, ZOOM & TILE PROVIDER</span>
            </div>
            
            <div class="jkjaac-row-3">
                <div class="jkjaac-field">
                    <label for="jkjaac_map_center_lat">Center Latitude</label>
                    <input type="number" step="0.0001" name="jkjaac_map_center_lat" id="jkjaac_map_center_lat" 
                           value="<?php echo esc_attr( $map_center_lat ); ?>" placeholder="33.5" />
                    <small>Default: 33.5 (AJK center)</small>
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_map_center_lng">Center Longitude</label>
                    <input type="number" step="0.0001" name="jkjaac_map_center_lng" id="jkjaac_map_center_lng" 
                           value="<?php echo esc_attr( $map_center_lng ); ?>" placeholder="73.7" />
                    <small>Default: 73.7</small>
                </div>
                
                <div class="jkjaac-field">
                    <label for="jkjaac_map_zoom">Zoom Level</label>
                    <select name="jkjaac_map_zoom" id="jkjaac_map_zoom">
                        <?php for ( $i = 5; $i <= 12; $i++ ) : ?>
                            <option value="<?php echo $i; ?>" <?php selected( $map_zoom, $i ); ?>>
                                <?php echo $i; ?> <?php echo $i == 8 ? '(Recommended)' : ''; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    <small>Higher = more zoomed in</small>
                </div>
            </div>
            
            <div class="jkjaac-field">
                <label for="jkjaac_map_tile_url">Map Tile Provider</label>
                <select name="jkjaac_map_tile_url" id="jkjaac_map_tile_url">
                    <?php foreach ( $tile_providers as $url => $name ) : ?>
                        <option value="<?php echo esc_attr( $url ); ?>" <?php selected( $map_tile_url, $url ); ?>>
                            <?php echo esc_html( $name ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small>Choose the map style</small>
            </div>
        </div>
        
        <!-- Map Locations -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Map Locations</h3>
                <span>MARKERS & POPUPS</span>
            </div>
            
            <p class="jkjaac-hint">Add up to 10 location markers. Leave address empty to hide a marker.</p>
            
            <div class="jkjaac-map-locations-container">
                <?php for ( $i = 0; $i < 10; $i++ ) : 
                    $location = isset( $map_locations[ $i ] ) ? $map_locations[ $i ] : array( 'address' => '', 'description' => '', 'lat' => '', 'lng' => '', 'icon' => 'default' );
                    $has_content = ! empty( $location['address'] );
                ?>
                    <div class="jkjaac-map-location-item <?php echo ! $has_content && $i >= 3 ? 'hidden-location' : ''; ?>" style="<?php echo $i >= 3 && ! $has_content ? 'display: none;' : ''; ?>">
                        <div class="jkjaac-location-header">
                            <h4><i class="ri-map-pin-2-line"></i> Location <?php echo $i + 1; ?></h4>
                            <button type="button" class="jkjaac-toggle-location-btn"><i class="ri-arrow-down-s-line"></i></button>
                        </div>
                        
                        <div class="jkjaac-location-fields">
                            <div class="jkjaac-field">
                                <label>Address / Title</label>
                                <input type="text" 
                                       name="jkjaac_map_locations[<?php echo $i; ?>][address]" 
                                       value="<?php echo esc_attr( $location['address'] ); ?>" 
                                       placeholder="Muzaffarabad City Center, AJK" />
                            </div>
                            
                            <div class="jkjaac-field">
                                <label>Description</label>
                                <textarea name="jkjaac_map_locations[<?php echo $i; ?>][description]" 
                                          rows="2" 
                                          placeholder="Brief description for popup..."><?php echo esc_textarea( $location['description'] ); ?></textarea>
                            </div>
                            
                            <div class="jkjaac-row-2">
                                <div class="jkjaac-field">
                                    <label>Latitude</label>
                                    <input type="number" step="0.0001" 
                                           name="jkjaac_map_locations[<?php echo $i; ?>][lat]" 
                                           value="<?php echo esc_attr( $location['lat'] ); ?>" 
                                           placeholder="34.37" />
                                </div>
                                
                                <div class="jkjaac-field">
                                    <label>Longitude</label>
                                    <input type="number" step="0.0001" 
                                           name="jkjaac_map_locations[<?php echo $i; ?>][lng]" 
                                           value="<?php echo esc_attr( $location['lng'] ); ?>" 
                                           placeholder="73.47" />
                                </div>
                            </div>
                            
                            <div class="jkjaac-field">
                                <label>Marker Icon</label>
                                <select name="jkjaac_map_locations[<?php echo $i; ?>][icon]">
                                    <?php foreach ( $marker_icons as $value => $label ) : ?>
                                        <option value="<?php echo esc_attr( $value ); ?>" <?php selected( isset( $location['icon'] ) ? $location['icon'] : 'default', $value ); ?>>
                                            <?php echo esc_html( $label ); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            
            <button type="button" class="button jkjaac-add-location-btn" style="margin-top: 15px;">
                <i class="ri-add-line"></i> Add Another Location
            </button>
        </div>
        
        <!-- Map Preview -->
        <div class="jkjaac-section">
            <div class="jkjaac-section-header">
                <h3>Map Preview</h3>
                <span>LIVE PREVIEW</span>
            </div>
            
            <div id="map-preview" style="width: 100%; height: 300px; border-radius: 8px; margin-bottom: 15px;"></div>
            <button type="button" class="button jkjaac-refresh-map-btn">Refresh Preview</button>
            <small style="display: block; margin-top: 8px;">Click refresh to update the preview with current settings.</small>
        </div>
        
        <!-- Hide Option -->
        <div class="jkjaac-checkbox-group pulse-glow-style">
            <div class="jkjaac-checkbox-item">
                <input type="checkbox" name="jkjaac_map_hide_section" id="jkjaac_map_hide_section" value="1" <?php checked( $map_hide_section, '1' ); ?> />
                <label for="jkjaac_map_hide_section">Hide Map Section on this page</label>
            </div>
        </div>
    </div>
</div>

<style>
    /* Map Locations Styling */
    .jkjaac-map-location-item {
        background: rgba(212, 175, 55, 0.05);
        border: 1px solid rgba(212, 175, 55, 0.15);
        border-radius: 8px;
        margin-bottom: 15px;
        overflow: hidden;
    }
    
    .jkjaac-location-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        background: rgba(212, 175, 55, 0.08);
        cursor: pointer;
    }
    
    .jkjaac-location-header h4 {
        margin: 0;
        color: #d4af37;
        font-size: 14px;
        font-weight: 600;
    }
    
    .jkjaac-toggle-location-btn {
        background: transparent;
        border: none;
        color: #d4af37;
        cursor: pointer;
        font-size: 12px;
        transition: transform 0.3s ease;
    }
    
    .jkjaac-map-location-item.collapsed .jkjaac-toggle-location-btn {
        transform: rotate(-90deg);
    }
    
    .jkjaac-map-location-item.collapsed .jkjaac-location-fields {
        display: none;
    }
    
    .jkjaac-location-fields {
        padding: 15px;
    }
    
    .jkjaac-row-3 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
    }
    
    .hidden-location {
        display: none;
    }
</style>

<script>
jQuery(document).ready(function($) {
    // Toggle location items
    $('.jkjaac-location-header').on('click', function() {
        $(this).closest('.jkjaac-map-location-item').toggleClass('collapsed');
    });
    
    // Add new location
    $('.jkjaac-add-location-btn').on('click', function() {
        var $items = $('.jkjaac-map-location-item');
        var visibleCount = $items.filter(':visible').length;
        
        if (visibleCount < 10) {
            $items.eq(visibleCount).show();
            $items.eq(visibleCount).removeClass('hidden-location');
        } else {
        }
    });
    
    // Map preview functionality
    var mapPreview = null;
    
    function initMapPreview() {
        if (mapPreview) {
            mapPreview.remove();
        }
        
        var lat = parseFloat($('#jkjaac_map_center_lat').val()) || 33.5;
        var lng = parseFloat($('#jkjaac_map_center_lng').val()) || 73.7;
        var zoom = parseInt($('#jkjaac_map_zoom').val()) || 8;
        var tileUrl = $('#jkjaac_map_tile_url').val() || 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        
        mapPreview = L.map('map-preview').setView([lat, lng], zoom);
        
        L.tileLayer(tileUrl, {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapPreview);
        
        // Icon colors
        var iconColors = {
            'default': '#3388ff',
            'gold': '#d4af37',
            'red': '#e74c3c',
            'green': '#27ae60',
            'purple': '#9b59b6'
        };
        
        function createIcon(color) {
            return L.divIcon({
                className: 'custom-marker',
                html: '<div style="background-color: ' + color + '; width: 30px; height: 30px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 2px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>',
                iconSize: [30, 30],
                iconAnchor: [15, 30],
                popupAnchor: [0, -30]
            });
        }
        
        // Add markers from form data
        $('.jkjaac-map-location-item:visible').each(function() {
            var $item = $(this);
            var address = $item.find('input[name*="[address]"]').val();
            var description = $item.find('textarea[name*="[description]"]').val();
            var lat = parseFloat($item.find('input[name*="[lat]"]').val());
            var lng = parseFloat($item.find('input[name*="[lng]"]').val());
            var icon = $item.find('select[name*="[icon]"]').val();
            
            if (address && !isNaN(lat) && !isNaN(lng)) {
                var color = iconColors[icon] || iconColors.default;
                var marker = L.marker([lat, lng], {
                    icon: createIcon(color)
                }).addTo(mapPreview);
                
                marker.bindPopup('<b>' + address + '</b><br>' + description);
            }
        });
    }
    
    // Refresh preview
    $('.jkjaac-refresh-map-btn').on('click', function() {
        initMapPreview();
    });
    
    // Initialize preview on page load if map tab is visible
    if ($('#map-tab').hasClass('active')) {
        setTimeout(initMapPreview, 100);
    }
    
    // Initialize when map tab is clicked
    $('.jkjaac-tab-btn[data-tab="map-tab"]').on('click', function() {
        setTimeout(initMapPreview, 100);
    });
});
</script>