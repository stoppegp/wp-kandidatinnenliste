<?php
/*
Plugin Name: Kandidat*liste
Plugin URI: http://sproesser.name/kandidatinnenliste
Description: Eine Kandidat*liste für Landeslisten, Direktkandidat* und rudimentäre Infos zu den Personen
Version: 0.1
Author: Sebastian Sproesser
Author URI: http://sproesser.name/
Min WP Version: 1.5
Max WP Version: 3.5.1
*/

include('wk.php');

global $kandidatinnenliste_db_version;
$kandidatinnenliste_db_version = "0.2";

function kandidatinnenliste_install () {
   	global $wpdb;
	global $kandidatinnenliste_db_version;

   	$table_name = $wpdb->prefix . "kandidatinnenliste";

	$sql = "CREATE TABLE $table_name (
  		id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
  		name TINYTEXT NOT NULL,
  		wahlkreis MEDIUMINT(9) DEFAULT 0,
  		listenplatz MEDIUMINT(0) DEFAULT 0,
  		anzeigen BOOL DEFAULT 1,
  		papierkorb BOOL DEFAULT 0,
  		geschlecht CHAR(1) DEFAULT '*',
  		beruf TINYTEXT,
  		url TINYTEXT,
  		bild TINYTEXT,
  		bildlizenz TINYTEXT,
  		beschreibung text NOT NULL,
  		UNIQUE KEY id (id)
	);";

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql);

   	add_option("kandidatinnenliste_db_version", $kandidatinnenliste_db_version);
   	add_option("kandidatinnenliste_bundesland", '--');
   	add_option("kandidatinnenliste_listenplaetze", '30');
   	add_option("kandidatinnenliste_mapwidth", '100%');
   	add_option("kandidatinnenliste_mapheight", '800px');
   	add_option("kandidatinnenliste_sidebarwidth", '200px');
   	add_option("kandidatinnenliste_aufruecken", '0');
   	add_option("kandidatinnenliste_zoomoffset", '0');
}

function kandidatinnenliste_install_data() {
	global $wpdb;

  	$table_name = $wpdb->prefix . "kandidatinnenliste";

  	if (!get_option("kandidatinnenliste_db_version")) {

   		$rows_affected = $wpdb->insert( $table_name, array(
	   		'name' => 'Kandidat 1',
   			'wahlkreis' => 267,
   			'listenplatz' => 1,
   			'geschlecht' => 'm',
   			'beruf' => 'Freier Journalist',
   			'url' => '',
   			'bild' => '',
   			'bildlizenz' => '',
   			'beschreibung' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam' ) );
   	}

}

function kandidatinnenliste_min_wk($bl) {
	switch($bl) {
		case 'BW':
			return 258;
		case 'BY':
			return 213;
		case 'BE':
			return 75;
		case 'BB':
			return 56;
		case 'HB':
			return 54;
		case 'HH':
			return 18;
		case 'HE':
			return 167;
		case 'MV':
			return 12;
		case 'NI':
			return 24;
		case 'NW':
			return 87;
		case 'RP':
			return 198;
		case 'SL':
			return 296;
		case 'SN':
			return 151;
		case 'ST':
			return 66;
		case 'SH':
			return 1;
		case 'TH':
			return 189;
		default:
			return 1;
	}
}

function kandidatinnenliste_max_wk($bl) {
	switch($bl) {
		case 'BW':
			return 295;
		case 'BY':
			return 257;
		case 'BE':
			return 86;
		case 'BB':
			return 65;
		case 'HB':
			return 55;
		case 'HH':
			return 23;
		case 'HE':
			return 188;
		case 'MV':
			return 17;
		case 'NI':
			return 53;
		case 'NW':
			return 150;
		case 'RP':
			return 212;
		case 'SL':
			return 299;
		case 'SN':
			return 166;
		case 'ST':
			return 74;
		case 'SH':
			return 11;
		case 'TH':
			return 197;
		default:
			return 299;
	}
}


if ( is_admin() ) {

	function kandidatinnenliste_optionen() {
?>

<div>
	<h2>Kandidatinnenliste Einstellungen</h2>

	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>

		<table width="510">
			<tr valign="top">
				<th width="406" scope="row">Wahlkreise auf ein Bundesland beschr&auml;nken</th>
				<td width="92">
					<select name="kandidatinnenliste_bundesland" size="1" id="kandidatinnenliste_bundesland">
						<option value="--" <?php if (get_option('kandidatinnenliste_bundesland') === "--") { echo 'selected="selected"'; }?> >nein</option>
						<option value="BW" <?php if (get_option('kandidatinnenliste_bundesland') === "BW") { echo 'selected="selected"'; }?> >Baden-W&uuml;rttemberg</option>
						<option value="BY" <?php if (get_option('kandidatinnenliste_bundesland') === "BY") { echo 'selected="selected"'; }?> >Bayern</option>
						<option value="BE" <?php if (get_option('kandidatinnenliste_bundesland') === "BE") { echo 'selected="selected"'; }?> >Berlin</option>
						<option value="BB" <?php if (get_option('kandidatinnenliste_bundesland') === "BB") { echo 'selected="selected"'; }?> >Brandenburg</option>
						<option value="HB" <?php if (get_option('kandidatinnenliste_bundesland') === "HB") { echo 'selected="selected"'; }?> >Bremen</option>
						<option value="HH" <?php if (get_option('kandidatinnenliste_bundesland') === "HH") { echo 'selected="selected"'; }?> >Hamburg</option>
						<option value="HE" <?php if (get_option('kandidatinnenliste_bundesland') === "HE") { echo 'selected="selected"'; }?> >Hessen</option>
						<option value="MV" <?php if (get_option('kandidatinnenliste_bundesland') === "MV") { echo 'selected="selected"'; }?> >Mecklenburg-Vorpommern</option>
						<option value="NI" <?php if (get_option('kandidatinnenliste_bundesland') === "NI") { echo 'selected="selected"'; }?> >Niedersachsen</option>
						<option value="NW" <?php if (get_option('kandidatinnenliste_bundesland') === "NW") { echo 'selected="selected"'; }?> >Nordrhein-Westfalen</option>
						<option value="RP" <?php if (get_option('kandidatinnenliste_bundesland') === "RP") { echo 'selected="selected"'; }?> >Rheinland-Pfalz</option>
						<option value="SL" <?php if (get_option('kandidatinnenliste_bundesland') === "SL") { echo 'selected="selected"'; }?> >Saarland</option>
						<option value="SN" <?php if (get_option('kandidatinnenliste_bundesland') === "SN") { echo 'selected="selected"'; }?> >Sachsen</option>
						<option value="ST" <?php if (get_option('kandidatinnenliste_bundesland') === "ST") { echo 'selected="selected"'; }?> >Sachsen-Anhalt</option>
						<option value="SH" <?php if (get_option('kandidatinnenliste_bundesland') === "SH") { echo 'selected="selected"'; }?> >Schleswig-Holstein</option>
						<option value="TH" <?php if (get_option('kandidatinnenliste_bundesland') === "TH") { echo 'selected="selected"'; }?> >Th&uuml;ringen</option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row">Anzahl der Listenpl&auml;tze:</th>
				<td><input type="text" name="kandidatinnenliste_listenplaetze" value="<?php echo get_option('kandidatinnenliste_listenplaetze'); ?>" size="3"></td>
			</tr>
			<tr>
				<th scope="row">Breite der Karte:</th>
				<td><input type="text" name="kandidatinnenliste_mapwidth" value="<?php echo get_option('kandidatinnenliste_mapwidth'); ?>" size="6"></td>
			</tr>
			<tr>
				<th scope="row">H&ouml;he der Karte:</th>
				<td><input type="text" name="kandidatinnenliste_mapheight" value="<?php echo get_option('kandidatinnenliste_mapheight'); ?>" size="6"></td>
			</tr>
			<tr>
				<th scope="row">Breite der Sidebars:</th>
				<td><input type="text" name="kandidatinnenliste_sidebarwidth" value="<?php echo get_option('kandidatinnenliste_sidebarwidth'); ?>" size="6"></td>
			</tr>
<!--
			<tr>
				<th scope="row">Listenkandidaten r&uuml;cken auf:</th>
				<td><input type="checkbox" name="kandidatinnenliste_aufruecken" value="1" <?php if (get_option('kandidatinnenliste_aufruecken')) { echo 'checked="checked"'; } ?> /></td>
			</tr>
-->
			<tr>
				<th scope="row">Kartenansicht wird um so viele Schritte rausgezoomt (negativ: reingezoomt):</th>
				<td><input type="text" name="kandidatinnenliste_zoomoffset" value="<?php echo get_option('kandidatinnenliste_zoomoffset'); ?>" size="6"></td>
			</tr>
		</table>

		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="kandidatinnenliste_bundesland,kandidatinnenliste_listenplaetze,kandidatinnenliste_mapwidth,kandidatinnenliste_mapheight,kandidatinnenliste_sidebarwidth,kandidatinnenliste_aufruecken,kandidatinnenliste_zoomoffset" />

		<p>
		<input type="submit" value="<?php _e('Save Changes') ?>" />
		</p>

	</form>
</div>

<?php
	}

	/*************************** LOAD THE BASE CLASS *******************************
	 *******************************************************************************
	 * The WP_List_Table class isn't automatically available to plugins, so we need
	 * to check if it's available and load it if necessary.
	 */
	if(!class_exists('WP_List_Table')){
	    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
	}

	class Kandidatinnenliste_Table extends WP_List_Table {
	    /**
    	 * Constructor, we override the parent to pass our own arguments
     	 * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
     	 */
     	function __construct() {
         	parent::__construct( array(
        	'singular'=> 'kandidatin', //Singular label
        	'plural' => 'kandidatinnen', //plural label, also this well be one of the table css class
        	'ajax'  => false //We won't support Ajax for this table
        	) );
     	}

    	function column_default($item, $column_name){
	        switch($column_name){
            	case 'id':
            	case 'name':
            	case 'listenplatz':
            	case 'wahlkreis':
            	case 'beschreibung':
            	case 'anzeigen':
	                return $item->{$column_name};
            	default:
	                return print_r($item,true); //Show the whole array for troubleshooting purposes
        	}
    	}

    	function column_name($item){
        
        	//Build row actions
        	$actions = array(
	            'edit'      => sprintf('<a href="?page=%s&action=%s&kandidatin=%s">'.__('Edit').'</a>',$_REQUEST['page'],'edit',$item->{'id'}),
        	);

        	if (!$item->{'papierkorb'}) {
        		$actions['trash'] = sprintf('<a href="?page=%s&action=%s&kandidatin=%s">'.__('Trash').'</a>',$_REQUEST['page'],'trash',$item->{'id'});
        	} else {
            	$actions['untrash'] = sprintf('<a href="?page=%s&action=%s&kandidatin=%s">'.__('Restore').'</a>',$_REQUEST['page'],'untrash',$item->{'id'});
            	$actions['delete'] = sprintf('<a href="?page=%s&action=%s&kandidatin=%s">'.__('Delete').'</a>',$_REQUEST['page'],'delete',$item->{'id'});
        	}

//<strong><a class="row-title" href="http://piratenbw.sproesser.name/wp-admin/post.php?post=12&amp;action=edit" title="“Blubber” bearbeiten">Blubber</a> - <span class="post-state">Entwurf</span></strong>

	        
        	//Return the title contents
        	return sprintf('<strong><a class="row-title" href="?page=%s&action=%s&kandidatin=%s">%s</a>%s</strong>%s',
        		$_REQUEST['page'],
        		'edit',
        		$item->{'id'},
	            $item->{'name'},
	            (!$item->{'anzeigen'} ? ' - <span class="post-state">Entwurf</span>' : ''),
            	$this->row_actions($actions)
        	);
    	}

    	function column_cb($item){
        	return sprintf(
	            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            	/*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")
            	/*$2%s*/ $item->{'id'}                //The value of the checkbox should be the record's id
        	);
    	}

    	function column_anzeigen($item){
    		if ($item->{'anzeigen'} > 0) {
    			return 'Ja';
    		} else {
    			return 'Nein';
    		}
    	}
    
    	function column_wahlkreis($item) {
    		if ($item->{'wahlkreis'} > 0) {
    			return $item->{'wahlkreis'};
    		} else {
    			return '-';
    		}
    	}

    	function column_listenplatz($item) {
    		if ($item->{'listenplatz'} > 0) {
    			return $item->{'listenplatz'};
    		} else {
    			return '-';
    		}
    	}

    	function get_columns(){
	        $columns = array(
            	'cb'        => '<input type="checkbox" />', //Render a checkbox instead of text
            	'id'     => 'ID',
            	'name'    => 'Name',
            	'listenplatz'  => 'Listenplatz',
            	'wahlkreis'  => 'Wahlkreis'
        	);
        	return $columns;
    	}

    	function get_sortable_columns() {
	        $sortable_columns = array(
            	'id'     => array('id',true),     //true means it's already sorted
            	'name'    => array('name',false),
            	'listenplatz'  => array('listenplatz',false),
            	'wahlkreis'    => array('wahlkreis',false)
        	);
        	return $sortable_columns;
    	}

    	function get_bulk_actions() {
	        $actions = array(
            	'delete_bulk'    => 'L&ouml;schen'
        	);
        	return $actions;
    	}

	    function process_bulk_action() {
        
    	    //Detect when a bulk action is being triggered...
        	if( 'delete_bulk'===$this->current_action() ) {
	            wp_die('Items deleted (or they would be if we had implemented it)!');
        	}
    	}

    	function prepare_items() {
        	global $wpdb; //This is used only if making any database queries

        	$per_page = 5;
        
    	    $columns = $this->get_columns();
        	$hidden = array();
        	$sortable = $this->get_sortable_columns();
        
        	$this->_column_headers = array($columns, $hidden, $sortable);
        
        	$this->process_bulk_action();

			$table_name = $wpdb->prefix . "kandidatinnenliste";

			/* -- Preparing your query -- */
        	$query = "SELECT * FROM $table_name";


        	switch ($_GET['status']) {
	        	case 'trash':
	        		$query .= ' WHERE papierkorb = TRUE';
	        		break;
        		case 'published':
        			$query .= ' WHERE papierkorb = FALSE AND anzeigen = TRUE';
        			break;
        		case 'draft':
        			$query .= ' WHERE papierkorb = FALSE AND anzeigen = FALSE';
        			break;
        		default:
        			$query .= ' WHERE papierkorb = FALSE';
        			break;
        	}

			/* -- Ordering parameters -- */

	    	//Parameters that are going to be used to order the result
		    $orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'ASC';
		    $order = !empty($_GET["order"]) ? mysql_real_escape_string($_GET["order"]) : '';
	    	if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }

			/* -- Pagination parameters -- */
        	//Number of elements in your table?
        	$total_items = $wpdb->query($query); //return the total number of affected rows

	        $current_page = $this->get_pagenum();

        	//Page Number
        	if(empty($current_page) || !is_numeric($current_page) || $current_page<=0 ) {
        		$current_page=1;
        	}

	    	if(!empty($current_page) && !empty($per_page)){
			    $offset=($current_page-1)*$per_page;
    			$query.=' LIMIT '.(int)$offset.','.(int)$per_page;
	    	}

			/* -- Register the pagination -- */
			$this->set_pagination_args( array(
				"total_items" => $total_items,
				"total_pages" => ceil($total_items/$per_page),
				"per_page" => $per_page,
			) );
			//The pagination links are automatically built according to those parameters

			/* -- Fetch the items -- */
			$this->items = $wpdb->get_results($query);
	    }

 	}

	function admin_header() {
		$page = ( isset($_GET['page'] ) ) ? esc_attr( $_GET['page'] ) : false;
		if( 'Kandidatinnenliste_Kandidatinnen' != $page )
	   	return;

	    echo '<style type="text/css">';
	    echo '.wp-list-table .column-id { width: 5%; }';
		echo '.wp-list-table .column-name { width: 75%; }';
	    echo '.wp-list-table .column-listenplatz { width: 10%;}';
	    echo '.wp-list-table .column-wahlkreis { width: 10%; }';
	    echo '</style>';
  	}

	add_action( 'admin_head', 'admin_header' );

	function kandidatinnenliste_besetztewahlkreise() {
		global $wpdb;
		$table_name = $wpdb->prefix . "kandidatinnenliste";
		$usedwahlkreise_tmp = $wpdb->get_results("SELECT wahlkreis FROM $table_name ORDER BY wahlkreis ASC", ARRAY_N);
		$usedwahlkreise = array();
		foreach ($usedwahlkreise_tmp as $wk)  {
			$usedwahlkreise[$wk[0]] = 1;
		}

		return $usedwahlkreise;
	}

	function kandidatinnenliste_freiewahlkreise() {
		global $wpdb;
		$table_name = $wpdb->prefix . "kandidatinnenliste";
		$usedwahlkreise_tmp = $wpdb->get_results("SELECT wahlkreis FROM $table_name ORDER BY wahlkreis ASC", ARRAY_N);
		$usedwahlkreise = array();
		foreach ($usedwahlkreise_tmp as $wk)  {
			array_push($usedwahlkreise, $wk[0]);
		}

		$minwk = kandidatinnenliste_min_wk(get_option('kandidatinnenliste_bundesland'));
		$maxwk = kandidatinnenliste_max_wk(get_option('kandidatinnenliste_bundesland'));
		$wahlkreise = range($minwk,$maxwk);

		return array_diff($wahlkreise, $usedwahlkreise_tmp);
	}

	function kandidatinnenliste_besetztelistenplaetze() {
		global $wpdb;
		$table_name = $wpdb->prefix . "kandidatinnenliste";
		$usedlistenplaetze_tmp = $wpdb->get_results("SELECT listenplatz FROM $table_name ORDER BY listenplatz ASC", ARRAY_N);
		$usedlistenplaetze = array();

		foreach($usedlistenplaetze_tmp as $lp) {
			$usedlistenplaetze[$lp[0]] = 1;
		}

		return $usedlistenplaetze;
	}

	function kandidatinnenliste_freielistenplaetze() {
		global $wpdb;
		$table_name = $wpdb->prefix . "kandidatinnenliste";
		$usedlistenplaetze_tmp = $wpdb->get_results("SELECT listenplatz FROM $table_name ORDER BY listenplatz ASC", ARRAY_N);
		$usedlistenplaetze = array();

		foreach($usedlistenplaetze_tmp as $lp) {
			array_push($usedlistenplaetze, $lp[0]);
		}
		$maxlp = end($usedlistenplaetze);
		reset($usedlistenplaetze);

		$lps = range(1,get_option("kandidatinnenliste_listenplaetze"));
		return array_diff($lps, $usedlistenplaetze);
	}

	function kandidatinnenliste_kandidatinnen() {

   		global $wpdb;
		global $kandidatinnenliste_db_version;

	   	$table_name = $wpdb->prefix . "kandidatinnenliste";

		if ($_GET['action'] === 'trash') {
			if (is_numeric($_GET['kandidatin']) && $_GET['kandidatin'] >= 0) {
   				$query = "UPDATE $table_name SET papierkorb = 1 WHERE id = %d";
   				$wpdb->query($wpdb->prepare($query, $_GET['kandidatin']));
   				//Infobox
			}
		} else if ($_GET['action'] === 'untrash') {
			if (is_numeric($_GET['kandidatin']) && $_GET['kandidatin'] >= 0) {
   				$query = "UPDATE $table_name SET papierkorb = 0 WHERE id = %d";
   				$wpdb->query($wpdb->prepare($query, $_GET['kandidatin']));
   				//Infobox
			}
		} else if ($_GET['action'] === 'delete') {
			if (is_numeric($_GET['kandidatin']) && $_GET['kandidatin'] >= 0) {
   				$query = "DELETE FROM $table_name WHERE id = %d AND papierkorb = 1";
   				$wpdb->query($wpdb->prepare($query, $_GET['kandidatin']));
   				//Infobox
			}
		} else if ($_GET['action'] === 'delete_bulk') {

		}

		if ($_GET['action'] === 'edit') {
			if ($_POST['posted']) {
				// Write to database
				if (is_numeric($_POST['kandidatin']) && $_POST['kandidatin'] >= 0) {
					$wpdb->update(
						$table_name,
						array(
							'name' => $_POST['name'],
							'wahlkreis' => $_POST['wahlkreis'],
							'listenplatz' => $_POST['listenplatz'],
							'geschlecht' => $_POST['geschlecht'],
							'beruf' => $_POST['beruf'],
							'url' => $_POST['url'],
							'bild' => $_POST['upload_image'],
							'bildlizenz' => $_POST['bildlizenz'],
							'beschreibung' => $_POST['beschreibung'],
							'anzeigen' => $_POST['anzeigen']
							),
						array('id' => $_POST['kandidatin']),
						array(
							'%s',
							'%d',
							'%d',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%d'
							),
						array('%d')
						);
				} else {
					$wpdb->insert(
						$table_name,
						array(
							'name' => $_POST['name'],
							'wahlkreis' => $_POST['wahlkreis'],
							'listenplatz' => $_POST['listenplatz'],
							'geschlecht' => $_POST['geschlecht'],
							'beruf' => $_POST['beruf'],
							'url' => $_POST['url'],
							'bild' => $_POST['upload_image'],
							'bildlizenz' => $_POST['bildlizenz'],
							'beschreibung' => $_POST['beschreibung'],
							'anzeigen' => $_POST['anzeigen']
							),
						array(
							'%s',
							'%d',
							'%d',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%s',
							'%d'
							)
						);
					$_POST['kandidatin'] = $wpdb->insert_id;
				}
			}
			add_action('admin_init', 'editor_admin_init');
			add_action('admin_head', 'editor_admin_head');
 
			function editor_admin_init() {
				wp_enqueue_script('word-count');
				wp_enqueue_script('post');
				wp_enqueue_script('editor');
				wp_enqueue_script('media-upload');
			}

			function editor_admin_head() {
				wp_tiny_mce();
			}

			$kandidatin;

			if (is_numeric($_POST['kandidatin']) && $_POST['kandidatin'] >= 0) {
				$query = 'SELECT * FROM ' . $table_name . ' WHERE id = %d';
				$kandidatin = $wpdb->get_row($wpdb->prepare($query, $_POST['kandidatin']));
			} else if (is_numeric($_GET['kandidatin']) && $_GET['kandidatin'] >= 0) {
				$query = 'SELECT * FROM ' . $table_name . ' WHERE id = %d';
				$kandidatin = $wpdb->get_row($wpdb->prepare($query, $_GET['kandidatin']));
			}
			if ($kandidatin) {
				echo '<h2>Kandidat';
				if ($kandidatin->{'geschlecht'} === 'w') {
					echo 'in';
				} else if ($kandidatin->{'geschlecht'} === 'm') {
					echo '';
				} else {
					echo 'eichh&ouml;rnchen';
				}
				echo ' bearbeiten</h2>';
			} else {
				echo '<h2>Neue* Kandidat*in anlegen</h2>';
			}
?>
				<style type="text/css">
	    			.editfield { float: left; padding: 3px;}
	    			.beschreibung {width: 100%;}
	    			.clearfix:before, .clearfix:after { content: ""; display: table; }
					.clearfix:after { clear: both; }
					.clearfix { *zoom: 1; }
	    		</style>

	    		<script language="JavaScript">
					jQuery(document).ready(function() {
						jQuery('#upload_image_button').click(function() {
							formfield = jQuery('#upload_image').attr('name');
							tb_show('', 'media-upload.php?type=image&TB_iframe=true');
							return false;
						});

						window.send_to_editor = function(html) {
							imgurl = jQuery('img',html).attr('src');
							jQuery('#upload_image').val(imgurl);
							tb_remove();
						}
					});
				</script>

	<form method="post">
		<input type="hidden" name="posted" value="1">
		<input type="hidden" name="kandidatin" value="<? if ($_POST['kandidatin']) { echo $_POST['kandidatin']; } else if ($_GET['kandidatin']) {echo $_GET['kandidatin']; } else {echo ''; } ?>">
	    <div id="poststuff">
	    	<div id="post-body" class="metabox-holder columns-2">
	    		<div id="post-body-content">
					<div class="editfield">
						<h3>Name</h3>
						<input type="text" name="name" value="<?php echo $kandidatin->{'name'}; ?>" size="100">
					</div>
					<div class="editfield">
						<h3>Geschlecht</h3>
						<select name="geschlecht" size="1">
							<option value="w" <?php if ($kandidatin && $kandidatin->{'geschlecht'} === 'w') {echo 'selected="selected"'; } ?>>weiblich</option>
							<option value="m" <?php if ($kandidatin && $kandidatin->{'geschlecht'} === 'm') {echo 'selected="selected"'; } ?>>m&auml;nnlich</option>
							<option value="*" <?php if ($kandidatin && $kandidatin->{'geschlecht'} !== 'w' && $kandidatin->{'geschlecht'} !== 'm') {echo 'selected="selected"'; } ?>>Eichh&ouml;rnchen</option>
						</select>
					</div>
					<div class="clearfix"></div>
					<div class="editfield">
						<h3>Beruf</h3>
						<input type="text" name="beruf" value="<?php echo ($kandidatin ? $kandidatin->{'beruf'} : '') ?>" size="100"><br />
					</div>
					<div class="clearfix"></div>
					<div class="editfield">
						<h3>Homepage</h3>
						<input type="text" name="url" value="<?php echo ($kandidatin ? $kandidatin->{'url'} : '') ?>" size="100"><br />
					</div>
					<div class="editfield">
						<h3>Wahlkreis</h3>
						<select name="wahlkreis" size="1">
								<option value="0">---</option>
							<?php
								$wahlkreise = range(kandidatinnenliste_min_wk(get_option("kandidatinnenliste_bundesland")), kandidatinnenliste_max_wk(get_option("kandidatinnenliste_bundesland")));
								$wks = kandidatinnenliste_besetztewahlkreise();
								foreach ($wahlkreise as $wk) {
							?>
								<option value="<?php echo $wk; ?>" <?php if ($kandidatin && $kandidatin->{'wahlkreis'} == $wk) {echo 'selected="selected"';} ?>><?php echo $wk . ' ('.kandidatinnenliste_wahlkreisname($wk).')'; if ($wks[$wk]) { echo ' *'; } ?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="editfield">
						<h3>Listenplatz</h3>
						<select name="listenplatz" size="1">
								<option value="0">---</option>
							<?php
								$listenplaetze = range(1,get_option("kandidatinnenliste_listenplaetze"));
								$lps = kandidatinnenliste_besetztelistenplaetze();
								foreach ($listenplaetze as $lp) {
							?>
								<option value="<?php echo $lp; ?>" <?php if ($kandidatin && $kandidatin->{'listenplatz'} == $lp) {echo 'selected="selected"';} ?>><?php echo $lp; if ($lps[$lp]) { echo ' *'; } ?></option>
							<?php
								}
							?>
						</select>
					</div>
					<div class="clearfix"></div>
					<div class="editfield">
						<h3>Bild</h3>

						<input id="upload_image" type="text" size="36" name="upload_image" value="<?php echo ($kandidatin ? $kandidatin->{'bild'} : ''); ?>" />
						<input id="upload_image_button" type="button" value="Bild hochladen" />

					</div>
					<div class="editfield">
						<h3>Bildlizenz</h3>
						<input type="text" name="bildlizenz" value="<?php echo htmlspecialchars($kandidatin ? $kandidatin->{'bildlizenz'} : '') ?>" size="50"><br />
					</div>
					<div class="clearfix"></div>
					<div class="editfield beschreibung">
  						<h3>Beschreibung</h3>
						<?php the_editor(($kandidatin ? $kandidatin->{'beschreibung'} : ''), "beschreibung", "", true); ?>
					</div>
				</div>
				<div id="postbox-container-1" class="postbox-container">
					<div id="side-sortables" class="meta-box-sortables ui-sortable">
						<div id="submitdiv" class="postbox">
							<h3 class="hndle">Veröffentlichen</h3>
							<div class="inside">
								<div class="submitbox" id="submitpost">
									<div id="minor-publishing">
										<div class="misc-pub-section"><label for="post_status">Status:</label>
											<select name="anzeigen" size="1">
												<option value="1" <?php if ($kandidatin && $kandidatin->{'anzeigen'}) {echo 'selected="selected"'; } ?>>Ver&ouml;ffentlicht</option>
												<option value="0" <?php if ($kandidatin && !$kandidatin->{'anzeigen'}) {echo 'selected="selected"'; } ?>>Entwurf</option>
											</select>
										</div>
									</div>
									<div id="major-publishing-actions">
										<?php
										if ($kandidatin && !$kandidatin->{papierkorb}) {
										?>
										<div id="delete-action">
											<a class="submitdelete deletion" href="<?php printf('?page=%s&action=%s&kandidatin=%s"',$_REQUEST['page'],'trash',$kandidatin->{'id'}) ?>"><?php echo __('Move to Trash'); ?> </a>
										</div>
										<?php
										} else if ($kandidatin) {
										?>
										<div id="delete-action">
											<a class="submitdelete deletion" href="<?php printf('?page=%s&action=%s&kandidatin=%s"',$_REQUEST['page'],'untrash',$kandidatin->{'id'}) ?>"><?php echo __('Restore'); ?></a>
										</div>
										<?php
										}
										?>
										<div id="publishing-action">
											<span class="spinner" style="display: none;"></span>
											<input name="original_publish" type="hidden" id="original_publish" value="Aktualisieren">
											<input name="save" type="submit" class="button button-primary button-large" id="publish" value="Aktualisieren">
										</div>
										<div class="clear"></div>
									</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php
		} else {
			echo '<div class="wrap">';
			echo '<h2>Kandidatinnenliste ';
			printf('<a href="?page=%s&action=%s" class="add-new-h2">'.__('Neue Person').'</a>',$_REQUEST['page'],'edit');
			echo '</h2>';

			//Prepare Table of elements
			$wp_kandidatinnen_table = new Kandidatinnenliste_Table();
			$wp_kandidatinnen_table->prepare_items();

			$count_nottrash = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE papierkorb = 0");
			$count_published = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE papierkorb = 0 AND anzeigen = 1");
			$count_draft = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE papierkorb = 0 AND anzeigen = 0");
			$count_trash = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE papierkorb = 1");

?>
		<ul class="subsubsub">
			<li class="all"><a href="<?php printf('?page=%s', $_REQUEST['page']); ?>" <?php if($_GET['status'] !== 'published' && $_GET['status'] !== 'draft' && $_GET['status'] !== 'trashed') { echo 'class="current"'; } ?>>Alle <span class="count">(<?php echo($count_nottrash); ?>)</span></a> |</li>
<?php
			if ($count_published) {
?>
				<li class="publish"><a href="<?php printf('?page=%s&status=%s', $_REQUEST['page'], 'published'); ?>" <?php if ($_GET['status'] === 'published') {echo 'class="current"'; } ?>><?php _e('Published') ?> <span class="count">(<?php echo($count_published); ?>)</span></a> |</li>
<?php
			}
			if ($count_draft) {
?>
				<li class="draft"><a href="<?php printf('?page=%s&status=%s', $_REQUEST['page'], 'draft'); ?>" <?php if ($_GET['status'] === 'draft') {echo 'class="current"'; } ?>><?php _e('Draft') ?> <span class="count">(<?php echo($count_draft); ?>)</span></a> |</li>
<?php				
			}
?>			
			<li class="trash"><a href="<?php printf('?page=%s&status=%s', $_REQUEST['page'], 'trash'); ?>" <?php if ($_GET['status'] === 'trash') {echo 'class="current"'; } ?>><?php _e('Trash') ?> <span class="count">(<?php echo($count_trash); ?>)</span></a></li>
		</ul>

        <form id="kandidatinnen-filter" method="get">
            <!-- For plugins, we also need to ensure that the form posts back to our current page -->
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
            <!-- Now we can render the completed list table -->
            <?php $wp_kandidatinnen_table->display(); ?>
        </form>
    </div>
<?php

		}
	}

	function kandidatinnenliste_admin_actions() {  
		add_options_page("kandidatinnenliste", "Kandidat*liste", 'manage_options', "Kandidatinnenliste_Optionen", "kandidatinnenliste_optionen");
		add_menu_page("kandidatinnenliste", "Kandidat*liste", 'edit_posts', 'Kandidatinnenliste_Kandidatinnen', 'kandidatinnenliste_kandidatinnen', '', 50 );
	}


	add_action('admin_menu', 'kandidatinnenliste_admin_actions');  

	function wp_gear_manager_admin_scripts() {
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('jquery');
	}

	function wp_gear_manager_admin_styles() {
		wp_enqueue_style('thickbox');
	}

	add_action('admin_print_scripts', 'wp_gear_manager_admin_scripts');
	add_action('admin_print_styles', 'wp_gear_manager_admin_styles');

}

function kandidatinnenliste_add_stylesheets() {
 
    // registers your stylesheet
    wp_register_style( 'kandidatinnenlisteLeafletStyle', plugins_url() . '/kandidatinnenliste/css/leaflet.css' );
    wp_register_style( 'kandidatinnenlisteMainStyle', plugins_url() . '/kandidatinnenliste/css/wk-karte.css' );
    wp_register_style( 'kandidatinnenlisteUILightnessStyle', plugins_url() . '/kandidatinnenliste/css/ui-lightness/jquery-ui-1.10.0.custom.min.css' );

    wp_register_style( 'kandidatinnenlisteLeafletIEStyle', plugins_url() . '/kandidatinnenliste/css/leaflet.ie.css');

	wp_register_style('kandidatinnenlisteOptions', plugins_url() . '/kandidatinnenliste/kandidatinnenliste-stylesheet.php');

    // loads your stylesheet
    wp_enqueue_style( 'kandidatinnenlisteLeafletStyle' );
    wp_enqueue_style( 'kandidatinnenlisteMainStyle' );
    wp_enqueue_style( 'kandidatinnenlisteUILightnessStyle' );

    $GLOBALS['wp_styles']->add_data( 'kandidatinnenlisteLeafletIEStyle', 'conditional', 'lte IE 8' );
    wp_enqueue_style( 'kandidatinnenlisteLeafletIEStyle' );

	wp_enqueue_style( 'kandidatinnenlisteOptions');

}

function kandidatinnenliste_add_javascript() {
   
	wp_enqueue_script('kandidatinnenlistejQuery', plugins_url() . '/kandidatinnenliste/js/jquery-1.9.1.min.js');
	wp_enqueue_script('kandidatinnenlistejQueryUI', plugins_url() . '/kandidatinnenliste/js/jquery-ui-1.10.0.custom.min.js', array('kandidatinnenlistejQuery'));
	wp_enqueue_script('kandidatinnenlistejQueryscrollTo', plugins_url() . '/kandidatinnenliste/js/jquery.scrollTo-1.4.3.1-min.js', array('kandidatinnenlistejQuery'));

	wp_enqueue_script('kandidatinnenlisteLeaflet', plugins_url() . '/kandidatinnenliste/js/leaflet.js', array('kandidatinnenlistejQuery'));

	wp_enqueue_script('kandidatinnenTableSorter', plugins_url() . '/kandidatinnenliste/js/jquery.tablesorter.min.js', array('kandidatinnenlistejQuery'));


	wp_enqueue_script('kandidatinnenlisteWahlkreisform', plugins_url() . '/kandidatinnenliste/js/wahlkreis-form.js', array('kandidatinnenlisteLeaflet'));
	wp_enqueue_script('kandidatinnenlisteWahlkreisinfos', plugins_url() . '/kandidatinnenliste/js/wahlkreis-infos.js');
	wp_enqueue_script('kandidatinnenlisteWahlkreismain', plugins_url() . '/kandidatinnenliste/js/wk-karte.js', array('kandidatinnenlisteWahlkreisinfos', 'kandidatinnenlisteWahlkreisform'));
   
}


function wp_kandidatinnenliste_karte_head(){
  global $posts;
  $pattern = get_shortcode_regex(); 
  preg_match('/'.$pattern.'/s', $posts[0]->post_content, $matches); 
  if (is_array($matches)) { 
        //shortcode is being used 

		// Only add javascript and stylesheet if we are NOT on the admin screen
		if (!is_admin()) {
			add_action( 'wp_enqueue_scripts', 'kandidatinnenliste_add_stylesheets' );
			add_action("wp_enqueue_scripts", "kandidatinnenliste_add_javascript");
		}
  }
}

add_action('template_redirect','wp_kandidatinnenliste_karte_head');

function kandidatinnenliste_karte() {

   	global $wpdb;
   	$table_name = $wpdb->prefix . "kandidatinnenliste";

   	$query = "SELECT * FROM $table_name WHERE anzeigen = 1 AND papierkorb = 0";
   	$kandidaten = $wpdb->get_results($query);

	if ($kandidaten) {

		echo '	        <ul id="kandidatinnen">';
		foreach ($kandidaten as $kandidat) {
?>
            <li>
                <div class="name"><?php echo $kandidat->{'name'}; ?></div>
                <div class="geschlecht"><?php echo $kandidat->{'geschlecht'}; ?></div>
                <div class="beruf"><?php echo $kandidat->{'beruf'}; ?></div>
                <div class="url"><?php echo $kandidat->{'url'}; ?></div>
                <div class="bild"><?php echo $kandidat->{'bild'}; ?></div>
                <div class="bildlizenz"><?php echo $kandidat->{'bildlizenz'}; ?></div>
                <div class="wahlkreis"><?php echo $kandidat->{'wahlkreis'}; ?></div>
                <div class="listenplatz"><?php echo $kandidat->{'listenplatz'}; ?></div>
                <div class="beschreibung"><?php echo $kandidat->{'beschreibung'}; ?></div>
            </li>
<?php			
		}
		echo '	        </ul>';
	}
?>
	    <div id="map_parent">
            <div id="map"></div>
        </div>
        <div class="cleaner"></div>
        <script type="text/javascript">
        	var liste_aufruecken = <?php echo (get_option("kandidatinnenliste_aufruecken") ? 1 : 0); ?>;
        	var zoom_offset = <?php  echo (is_numeric(get_option("kandidatinnenliste_zoomoffset")) ? get_option("kandidatinnenliste_zoomoffset") : 0); ?>;
            $(document).ready(function() {
                // Handler for .ready() called.
                GetKandidatinnen();
                InitMap();
                ZoomMap();
                ResizeWindows();
                KandidatinZeigen();
                ZeigeLandesliste();
            });
        </script>
<?php
}

function kandidatinnenliste_tabelle() {
   	global $wpdb;
   	$table_name = $wpdb->prefix . "kandidatinnenliste";

   	$query = "SELECT * FROM $table_name WHERE anzeigen = 1 AND papierkorb = 0 ORDER BY listenplatz ASC, wahlkreis ASC";
   	$kandidatinnen = $wpdb->get_results($query);

	if ($kandidatinnen) {
?>
		<h3>Unsere Kandidatinnen und Kandidaten</h3>
		<table id="kandidatinnen-table" class="tablesorter">
			<thead> 
				<tr> 
    				<th>Landeslistenplatz</th> 
					<th>Name</th> 
					<th>Bild</th> 
					<th>Wahlkreis</th> 
					<th>Homepage</th> 
				</tr>
			</thead>
			<tbody>
<?php
		foreach ($kandidatinnen as $kandidatin) {
?>
			<tr>
				<td><?php echo ($kandidatin->{'listenplatz'} > 0 ? $kandidatin->{'listenplatz'} : '-'); ?></td>
				<td><?php echo $kandidatin->{'name'}; ?></td>
				<td><?php if ($kandidatin->{'bild'}) { ?>
					<a href="<?php echo $kandidatin->{'bild'}; ?>" target="_blank">Bild</a><?php if ($kandidatin->{'bildlizenz'}) { echo ' (Lizenz: ' . $kandidatin->{'bildlizenz'} . ')'; } ?></td>
					<?php } else { ?>
					derzeit kein Bild verf&uuml;gbar
					<?php } ?>
				<td><?php echo ($kandidatin->{'wahlkreis'} > 0 ? $kandidatin->{'wahlkreis'} : '-'); ?></td>
				<td><?php if ($kandidatin->{'homepage'}) { ?>
					<a href="<?php echo $kandidatin->{'homepage'}; ?>" target="_blank">Link zur Homepage</a></td>
					<?php } else { ?>
					-
					<?php } ?>
			</tr>
<?php
		}
?>
			</tbody>
		</table>
		<script type="text/javascript">
			$(document).ready(function() { 
        		$("#kandidatinnen-table").tablesorter( {sortList: [[0,0]]} ); 
    		}); 
    	</script>
<?php
	}
}

function kandidatinnenliste_init() {
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain( 'kandidatinnenliste', false, $plugin_dir . '/languages');
}
add_action('plugins_loaded', 'kandidatinnenliste_init');

add_shortcode('kandidatinnenliste_karte', 'kandidatinnenliste_karte');
add_shortcode('kandidatinnenliste_tabelle', 'kandidatinnenliste_tabelle');

register_activation_hook(__FILE__,'kandidatinnenliste_install');
register_activation_hook(__FILE__,'kandidatinnenliste_install_data');

?>
