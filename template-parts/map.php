<?php
/**
 * Dynamic Map Template Part
 * 
 * @package JKJAAC
 */

$map = jkjaac_get_map_data();

if ( $map['hide_section'] ) {
    return;
}

// Prepare marker icon colors
$icon_colors = array(
    'default' => '#3388ff',
    'gold' => '#d4af37',
    'red' => '#e74c3c',
    'green' => '#27ae60',
    'purple' => '#9b59b6'
);
?>

<section class="p-0">
    <div class="map-frame">
        <div class="map-frame-inner">
            <div id="dynamic-map"></div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the map
    var map = L.map('dynamic-map').setView([
        <?php echo esc_js( $map['center_lat'] ); ?>, 
        <?php echo esc_js( $map['center_lng'] ); ?>
    ], <?php echo intval( $map['zoom'] ); ?>);
    
    // Add the tile layer
    L.tileLayer('<?php echo esc_js( $map['tile_url'] ); ?>', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);
    
    // Marker icon colors
    var iconColors = <?php echo json_encode( $icon_colors ); ?>;
    
    // Function to create custom icon
    function createIcon(color) {
        return L.divIcon({
            className: 'custom-marker',
            html: '<div style="background-color: ' + color + '; width: 30px; height: 30px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); border: 2px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>',
            iconSize: [30, 30],
            iconAnchor: [15, 30],
            popupAnchor: [0, -30]
        });
    }
    
    // Add markers
    var locations = <?php echo json_encode( $map['locations'] ); ?>;
    
    locations.forEach(function(location) {
        if (location.address && location.lat && location.lng) {
            var color = iconColors[location.icon] || iconColors.default;
            var marker = L.marker([parseFloat(location.lat), parseFloat(location.lng)], {
                icon: createIcon(color)
            }).addTo(map);
            
            marker.bindPopup('<b>' + location.address + '</b><br>' + location.description);
        }
    });
});
</script>

<style>
#dynamic-map {
    width: 100%;
    height: 100%;
    min-height: 500px;
}
.map-frame {
    width: 100%;
    position: relative;
}
.map-frame-inner {
    width: 100%;
    height: 100%;
}
@media (max-width: 768px) {
    .map-frame-inner,
    #dynamic-map {
        height: 400px;
    }
}
</style>