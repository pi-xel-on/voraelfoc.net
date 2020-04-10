<?php
//print_r($_POST);

include_once('../../../wp-config.php');
include_once('../../../wp-load.php');
include_once('../../../wp-includes/wp-db.php');


$basedatos = "grupferr_vorafoc";
	
//conectamos con el servidor

	//conectamos con el servidor
$link = @mysqli_connect(DB_HOST,DB_USER, DB_PASSWORD,DB_NAME);
//$link = @mysqli_connect("localhost", "grupferr_vorafoc", "94u!0Aradp9S",$basedatos);
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


		/*ENVIOS DE MAIL*/
		//obting la historia
		$sql="SELECT * FROM histories WHERE id=".$_GET["id"];
		$resultats=mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($resultats);
		//dades usu_intro
		$user = get_userdata($row["usu_intro"]);    
		$nomUsu=$user->data->display_name;
		$mailUsu=$user->data->user_email;
		$arrayMails["usu_intro"]["mail"]=$mailUsu;
		$arrayMails["usu_intro"]["nom"]=$nomUsu;



		//dades usu_uns
		$user = get_userdata($row["usu_nus"]);    
		$nomUsu=$user->data->display_name;
		$mailUsu=$user->data->user_email;
		$arrayMails["usu_nus"]["mail"]=$mailUsu;
		$arrayMails["usu_nus"]["nom"]=$nomUsu;

		//dades usu_final
		$user = get_userdata($row["usu_final"]);    
		$nomUsu=$user->data->display_name;
		$mailUsu=$user->data->user_email;
		$arrayMails["usu_final"]["mail"]=$mailUsu;
		$arrayMails["usu_final"]["nom"]=$nomUsu;
		foreach ($arrayMails as $key => $value) {
			print_r($value);
			$to = $value["mail"];
			$subject = 'Històres vora el foc - '.$row["titol"];		
			$body = '<div style="max-width: 560px; padding: 20px; background: #ffffff; border-radius: 5px; margin: 40px auto; font-family: Open Sans,Helvetica,Arial; font-size: 15px; color: #666;"><img style="width: 100%;" src="https://voraelfoc.net/wp-content/uploads/2020/04/logo-voraelfoc-black-1.png" />
				<div style="color: #444444; font-weight: normal;">
				<div style="text-align: center; font-weight: 600; font-size: 26px; padding: 10px 0; border-bottom: solid 3px #eeeeee;"><br />Històries vora el foc</div>
				<div style="clear: both;"> </div>
				</div>
				<div style="padding: 0 30px 30px 30px; border-bottom: 3px solid #eeeeee;">
				<div style="padding: 30px 0; font-size: 24px; text-align: center; line-height: 40px;">Hola '.$value["nom"].'!!!<br />Una història on participaves ha finalitzat!</div>
				<div style="padding: 10px 0 50px 0; text-align: center;"><a style="background: #F2C95F; color: #fff; padding: 12px 30px; text-decoration: none; border-radius: 3px; letter-spacing: 0.3px;" href="https://voraelfoc.net/historia/?idHistoria='.$_GET["id"].'">Veure la història</a></div>
				<div style="padding: 20px;"><a style="color: #3ba1da; text-decoration: none;" href="mailto:rrhh@pixel-on.com">Si tens alguna consulta rrhh@pixel-on.com</a></div>
				</div>
				<div style="color: #999; padding: 20px 30px;">
				<div>Gràcies!</div>
				<div><a style="color: #3ba1da; text-decoration: none;" href="htps://voraelfoc.net">voraelfoc.net</a></div>
				</div>
				</div>';
			$headers = array('Content-Type: text/html; charset=UTF-8');
		 
			wp_mail( $to, $subject, $body, $headers );
			# code...
		}
		//print_r($arrayMails);
		/*
		$to = 'rrhh@pixel-on.com';
		$subject = 'Històres vora el foc - '.$row["titol"];		
		$body = '<div style="max-width: 560px; padding: 20px; background: #ffffff; border-radius: 5px; margin: 40px auto; font-family: Open Sans,Helvetica,Arial; font-size: 15px; color: #666;"><img style="width: 100%;" src="https://voraelfoc.net/wp-content/uploads/2020/04/logo-voraelfoc-black-1.png" />
			<div style="color: #444444; font-weight: normal;">
			<div style="text-align: center; font-weight: 600; font-size: 26px; padding: 10px 0; border-bottom: solid 3px #eeeeee;"><br />Històries vora el foc</div>
			<div style="clear: both;"> </div>
			</div>
			<div style="padding: 0 30px 30px 30px; border-bottom: 3px solid #eeeeee;">
			<div style="padding: 30px 0; font-size: 24px; text-align: center; line-height: 40px;">Hola '.$nomUsu.'!!!<br />Una història on participaves ha finalitzat!</div>
			<div style="padding: 10px 0 50px 0; text-align: center;"><a style="background: #F2C95F; color: #fff; padding: 12px 30px; text-decoration: none; border-radius: 3px; letter-spacing: 0.3px;" href="https://voraelfoc.net/historia/?idHistoria='.$_GET["id"].'">Veure la història</a></div>
			<div style="padding: 20px;"><a style="color: #3ba1da; text-decoration: none;" href="mailto:rrhh@pixel-on.com">Si tens alguna consulta rrhh@pixel-on.com</a></div>
			</div>
			<div style="color: #999; padding: 20px 30px;">
			<div>Gràcies!</div>
			<div><a style="color: #3ba1da; text-decoration: none;" href="htps://voraelfoc.net">voraelfoc.net</a></div>
			</div>
			</div>';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		 
		wp_mail( $to, $subject, $body, $headers );


		*/

		break;
	default:
		# code...
		break;
}            
//echo $sql;



?>