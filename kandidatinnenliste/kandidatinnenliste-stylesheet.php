<?php
// We'll be outputting CSS

require('../../../wp-blog-header.php');

header('Content-type: text/css');

?>

#map_parent {
	width: <?php echo get_option('kandidatinnenliste_mapwidth'); ?>;
}

#map {
    height: <?php echo get_option('kandidatinnenliste_mapheight'); ?>;
}

#kandidatinneninfo, #landesliste_parent, #landesliste {
	width:  <?php echo get_option('kandidatinnenliste_sidebarwidth'); ?>;
}

.leaflet-left .leaflet-control {
	left: <?php echo get_option('kandidatinnenliste_sidebarwidth') ?>;
	margin-left: 30px;
}