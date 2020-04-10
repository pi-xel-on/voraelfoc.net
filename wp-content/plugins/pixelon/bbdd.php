<?php
//print_r($_POST);

$basedatos = "grupferr_vorafoc";
	
//conectamos con el servidor
$link = @mysqli_connect("localhost", "grupferr_vorafoc", "94u!0Aradp9S",$basedatos);
// comprobamos que hemos estabecido conexión en el servidor
if (! $link){
	echo "<h2 align='center'>ERROR: Imposible establecer conección con el servidor</h2>";
	exit;
}
switch ($_POST["fase"]) {
	case "1": //plantejaments
		# code...

		$titol=str_replace("'", "´", $_POST["titol"]);
		$sql="INSERT INTO  histories  (usu_intro,audio_intro,titol,ima) VALUES (".trim($_POST["user_id"]).",'".trim($_POST["audio"])."','".trim($titol)."','".trim($_POST["ima"])."')"; 
		$resultNumInfo = mysqli_query($link,$sql); 
		$last_id = mysqli_insert_id($link);
		echo $last_id;
		//echo mysqli_error($link);
		/*wp_usermeta 
		user_id
		meta_key ---histories_noves  ----  histories_update
		meta_value*/
		$sql2="UPDATE wp_usermeta   SET meta_value = meta_value + 1   WHERE user_id = ".trim($_POST["user_id"]). " AND meta_key='histories_noves'";
		mysqli_query($link,$sql2); 

		break;
	case "2": //nus
		$sql="UPDATE histories SET usu_nus=".trim($_POST["user_id"]).", audio_nus='".trim($_POST["audio"])."' WHERE id=".$_GET["id"];
		mysqli_query($link,$sql);

		$sql2="UPDATE wp_usermeta   SET meta_value = meta_value + 1   WHERE user_id = ".trim($_POST["user_id"]). " AND meta_key='histories_update'";
		mysqli_query($link,$sql2); 
		break;
	case "3": //finalitaza

		$text_resum=str_replace("'", "´", $_GET["text_resum"]);
		$sql="UPDATE histories SET usu_final=".trim($_POST["user_id"]).", audio_final='".trim($_POST["audio"])."', musica_fons='".trim($_GET["musica_fons"])."', text_resum='".trim($_GET["text_resum"])."' WHERE id=".$_GET["id"];
		mysqli_query($link,$sql);

		$sql2="UPDATE wp_usermeta   SET meta_value = meta_value + 1   WHERE user_id = ".trim($_POST["user_id"]). " AND meta_key='histories_update'";
		mysqli_query($link,$sql2);

		
		
		break;
	default:
		# code...
		break;
}            
//echo $sql;



?>