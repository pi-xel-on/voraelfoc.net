<?php
/**
 * Plugin Name: 01 Pixelon para https://voraelfoc.net/
 * Plugin URI: http://pixel-on.com
 * Description: Este plugin actualiza datos https://voraelfoc.net/
 * Version: 1.0.0
 * Author: Zetakiller
 * Author URI: http://pixel-on.com
 * Requires at least: 4.0n
 * Tested up to: 4.3
 *
 * Text Domain: pixelon
 * Domain Path: /languages/
 */

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');

add_action( 'admin_menu', 'oaf_create_admin_menu');

add_shortcode( 'grava_audios','pixelon_grava_audio' );
add_shortcode( 'veure_historia','pixelon_veure_historia' );
add_shortcode( 'veure_block_histories','pixelon_veure_block_histories' );

add_shortcode( 'veure_home_histories','pixelon_veure_home_histories' );
add_shortcode( 'veure_histories','pixelon_veure_histories' );

 
function oaf_create_admin_menu() {
 
 add_menu_page ( 'PIXELON', 'PIXELON', 'manage_options', 'iesf_create_admin_menu_plugin', 'oaf_create_admin_menu_function', 'dashicons-admin-tools',0 );

 add_submenu_page ( 'iesf_create_admin_menu_plugin', 'Client Database', 'Crear Sitemap', 'manage_options', 'iesf_client_database', 'iesf_database_options_function' );
 
 
}
 
function oaf_create_admin_menu_function() {
 
}

function iesf_database_options_function(){
	echo "GENERO XML SITEMAP";
	?>
	<iframe src="https://voraelfoc.net/wp-content/plugins/pixelon/sitemap_generate.php" style="display: none;"></iframe>
	URL SiteMap: <a href="https://voraelfoc.net/wp-content/plugins/pixelon/sitemap.xml" target="_blank">https://voraelfoc.net/wp-content/plugins/pixelon/sitemap.xml</a>
	<?php

	//include "Sitemap.php";
	//$sitemap = new Sitemap("https://voraelfoc.net");
	//$sitemap->setFilename("varaelfoc_sitemap");
	//$sitemap->createSitemapIndex("https://voraelfoc.net/", "Today");

}



function pixelon_veure_histories($atts = array()){
	
	global $wp_query;
	//echo "<pre>";	print_r($atts);	echo "</pre>";
	if(isset($atts["color_seccio"])){
		$color_seccio=$atts["color_seccio"];
	}else{
		$color_seccio="#000";
	}

	$urlTheme=get_template_directory_uri();//("template_directory");
	$urlPlugin= plugin_dir_url( __FILE__ );//("template_directory");
	

	//conectamos con el servidor
	$link = @mysqli_connect(DB_HOST,DB_USER, DB_PASSWORD,DB_NAME);
	// comprobamos que hemos estabecido conexión en el servidor
	if (! $link){
		echo "<h2 align='center'>ERROR: Imposible establecer conección con el servidor</h2>";
		exit;
	}
	$where=$atts["filtre"];
	//echo $where;
  	$sql="SELECT * FROM histories WHERE ".$where." ";
	include("inacavades_histories.php");	
	echo do_shortcode("[vc_empty_space]");
		?>

	<div class="sharethis-inline-share-buttons"></div>
	<?php
	echo "</div>";

}


function pixelon_veure_home_histories($atts = array()){
	

	global $wp_query;
	//echo "<pre>";	print_r($atts);	echo "</pre>";
	if(isset($atts["color_seccio"])){
		$color_seccio=$atts["color_seccio"];
	}else{
		$color_seccio="#000";
	}

	$urlTheme=get_template_directory_uri();//("template_directory");
	$urlPlugin= plugin_dir_url( __FILE__ );//("template_directory");
	

	//conectamos con el servidor
	$link = @mysqli_connect(DB_HOST,DB_USER, DB_PASSWORD,DB_NAME);
	// comprobamos que hemos estabecido conexión en el servidor
	if (! $link){
		echo "<h2 align='center'>ERROR: Imposible establecer conección con el servidor</h2>";
		exit;
	}
	include("home_histories.php");

	echo "</div>";
}



function pixelon_veure_block_histories($atts = array()){
	
	global $wp_query;
	//echo "<pre>";	print_r($atts);	echo "</pre>";
	if(isset($atts["color_seccio"])){
		$color_seccio=$atts["color_seccio"];
	}else{
		$color_seccio="#000";
	}
	$urlTheme=get_template_directory_uri();//("template_directory");
	$urlPlugin= plugin_dir_url( __FILE__ );//("template_directory");
	include("grid_historiess.php");
	
	echo "</div>";
}


function pixelon_grava_audio($atts = array()){
	?>
	<audio id="player_tmp" style="display: none;" controls></audio>

	<script type="text/javascript">
		
		function permisosMicro(){
			 var player = document.getElementById('player');

			  var handleSuccess = function(stream) {
			    if (window.URL) {
			     // player.src = window.URL.createObjectURL(stream);
			    } else {
			    //  player.src = stream;
			    }
			  };

			  navigator.mediaDevices.getUserMedia({ audio: true, video: false })
			      .then(handleSuccess)
			      .catch(function(err) {
					  /* handle the error */
					  alert(err);
					});
			 
		}

	</script>
	<?php
	
	global $wp_query;
	//echo "<pre>";	print_r($atts);	echo "</pre>";
	if(isset($atts["color_seccio"])){
		$color_seccio=$atts["color_seccio"];
	}else{
		$color_seccio="#000";
	}
	$urlTheme=get_template_directory_uri();//("template_directory");
	$urlPlugin= plugin_dir_url( __FILE__ );//("template_directory");
	include("audio.php");
	
	//echo "</div>";
}



function pixelon_veure_historia($atts = array()){
	?>
	<audio id="player_tmp" style="display: none;" controls></audio>
	<script type="text/javascript">
		
		function permisosMicro(){
			 var player = document.getElementById('player');

			  var handleSuccess = function(stream) {
			    if (window.URL) {
			     // player.src = window.URL.createObjectURL(stream);
			    } else {
			    //  player.src = stream;
			    }
			  };

			  navigator.mediaDevices.getUserMedia({ audio: true, video: false })
			      .then(handleSuccess)
			      .catch(function(err) {
					  /* handle the error */
					  alert(err);
					});

			 
		}

	</script>
	<?php
	global $wp_query;
	include "WP-ROOT-PATH/wp-config.php";
	$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Test the connection:
	if (mysqli_connect_errno()){
	    // Connection Error
	    exit("Couldn't connect to the database: ".mysqli_connect_error());
	}

	include("play_historia.php");
	include("audio_update.php");
	


	//print_r($wp_query);
	//echo $_GET["idHistoria"];

	//include("audio.php");
	
	echo "</div>";
}

function getName($user_id){
	if (!$user = get_userdata($user_id))
    return "&nbsp;";
	return $user->data->display_name;	
}
function joinwavs($wavs){
    $fields = join('/',array( 'H8ChunkID', 'VChunkSize', 'H8Format',
                              'H8Subchunk1ID', 'VSubchunk1Size',
                              'vAudioFormat', 'vNumChannels', 'VSampleRate',
                              'VByteRate', 'vBlockAlign', 'vBitsPerSample' ));
    $data = '';
    foreach($wavs as $wav){
        $fp     = fopen($wav,'rb');
        $header = fread($fp,36);
        $info   = unpack($fields,$header);
        // read optional extra stuff
        if($info['Subchunk1Size'] > 16){
            $header .= fread($fp,($info['Subchunk1Size']-16));
        }
        // read SubChunk2ID
        $header .= fread($fp,4);
        // read Subchunk2Size
        $size  = unpack('vsize',fread($fp, 4));
        $size  = $size['size'];
        // read data
        $data .= fread($fp,$size);
    }
    return $header.pack('V',strlen($data)).$data;
}


?>

