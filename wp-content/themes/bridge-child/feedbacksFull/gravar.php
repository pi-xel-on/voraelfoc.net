<?php

if($_GET["bCloseExt"]==1){
	//die("bCloseExt");

	define('_DB_NAME_', 'bcloseextern');
	define('_DB_SERVER_', 'localhost');
	define('_DB_USER_', 'mybclose');
	define('_DB_PASSWD_', 'd7SpwMn2');
	$urlAdmin="https://bclose.net/";
	$url_bclose="bclose.net";

}else{
//define('_DB_NAME_', 'headwaycrmdes'); //desarrollo
	if(isset($_GET["futuretrack"])){

		define('_DB_NAME_', 'futuretrackcrm');
		define('_DB_SERVER_', '134.0.9.144');
		//define('_DB_USER_', 'Josep10');
		//define('_DB_PASSWD_', 'Josep100');
		define('_DB_USER_', 'zetaheadway');
		define('_DB_PASSWD_', 'Dahehaj3#');
		$urlAdmin="https://futuretrack.es/";
		$url_bclose="futuretrack.es";
	}else{
		define('_DB_NAME_', 'headwaycrm');
		define('_DB_SERVER_', 'localhost');
		//define('_DB_USER_', 'Josep10');
		//define('_DB_PASSWD_', 'Josep100');
		define('_DB_USER_', 'myheadway');
		define('_DB_PASSWD_', 'Qwerty10');
		$urlAdmin="https://headway.es/";
		$url_bclose="headway.es";
	}
}

//die($_GET["bCloseExt"]);


$dsn = 'mysql:dbname='._DB_NAME_.';host='._DB_SERVER_;
$user = _DB_USER_;
$password = _DB_PASSWD_;
										
try {
	$pdopg = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}
/*
$valorPinta["sino_yes"]='<img src="https://bclose.net/iconos/verde.png">';
$valorPinta["sino_no"]='<div style="background:#C00; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">&nbsp;</div>';

$valorPinta["noexisto"]='<div style="background:#ccc; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">&nbsp;</div>';


$valorPinta["estrella_1"]='<div style="background:#093; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">1</div>';
$valorPinta["estrella_2"]='<div style="background:#093; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">2</div>';
$valorPinta["estrella_3"]='<div style="background:#093; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">3</div>';
$valorPinta["estrella_4"]='<div style="background:#093; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">4</div>';
$valorPinta["estrella_5"]='<div style="background:#093; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">5</div>';

$valorPinta["pregunta_0"]='<div style="background:#093; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">&nbsp;</div>';
$valorPinta["pregunta_1"]='<div style="background:#ff3; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">&nbsp;</div>';
$valorPinta["pregunta_2"]='<div style="background:#f90; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">&nbsp;</div>';
$valorPinta["pregunta_3"]='<div style="background:#c00; border-radius:50%; width:28px; height:28px;  float:left; margin:5px;">&nbsp;</div>';
*/
$valorPinta["sino_yes"]='<img src="https://bclose.net/iconos/verde.png">';
$valorPinta["sino_no"]='<img src="https://bclose.net/iconos/rojo.png">';

$valorPinta["noexisto"]='<img src="https://bclose.net/iconos/blanco.png">';


$valorPinta["estrella_1"]='<img src="https://bclose.net/iconos/estrella_rojo.png">';
$valorPinta["estrella_2"]='<img src="https://bclose.net/iconos/estrella_naranja.png">';
$valorPinta["estrella_3"]='<img src="https://bclose.net/iconos/estrella_amarillo.png">';
$valorPinta["estrella_4"]='<img src="https://bclose.net/iconos/estrella_verde.png">';
$valorPinta["estrella_5"]='<img src="https://bclose.net/iconos/estrella_verde.png">';

$valorPinta["pregunta_0"]='<img src="https://bclose.net/iconos/verde.png">';
$valorPinta["pregunta_1"]='<img src="https://bclose.net/iconos/amarillo.png">';
$valorPinta["pregunta_2"]='<img src="https://bclose.net/iconos/naranja.png">';
$valorPinta["pregunta_3"]='<img src="https://bclose.net/iconos/rojo.png">';
echo "GETGETGET";
print_r($_GET);
//die("FINAL");
//echo "<pre>";print_r($_GET); echo ">/pre>";
//$sql="INSERT INTO bClose_enquestas_respuestas (id_enquesta_persona,id_enquesta,respuestas,valores,is_done) VALUES (".$_GET["idUsuario"].",".$_GET["encuestaID"].",'".$_GET["respuestas"]."','".$_GET["resultados"]."',1)";
$created_date = date("Y-m-d H:i:s");
$sql="UPDATE bClose_enquestas_respuestas SET 
respuestas='".$_GET["respuestas"]."',
valores='".$_GET["resultados"]."',
is_done=1,
fecha_llenado='".$created_date."'
WHERE id=".$_GET["id"];

echo $sql;
//$sth = $pdopg->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
//print_r($arrayDades);
//die();
$sth = $pdopg->prepare($sql);
//echo "<pre>";print_r($data); echo ">/pre>";
$sth->execute();


/*detectar si hemos de comunicar alguna cosa al encargado */ 
$sql="SELECT * FROM bClose_enquestas_respuestas WHERE  id=".$_GET["id"];
echo $sql;
$sth = $pdopg->prepare($sql);
$sth->execute();
$arrayEnquesta = $sth->fetchAll();
echo "<br />id--:";
echo count($arrayEnquesta);
$alertaGreu=0;
$alertaMitja=0;
$alertaMitja2=0;
$alertaLleu=0;
$idJob="";
$idEnquesta="";
$respuestasPrint="";
//IDIOMA
$idiomaUsu=$_GET["idioma"]; //5 es  6 en


$nomContactoFinal=$_GET["nomContacto"];
echo "NOM CONTACTO=".$nomContactoFinal."\n";


foreach ($arrayEnquesta as $row){
	$idUsu2=$row['id_enquesta_persona'];
	$respuestas2 =json_decode($row['valores']);
	$idEnquesta=$row['id_enquesta'];
	$is_candidato=$row['is_candidato'];
	$idJob=$row["id_job"];
	$respuestas=array_reverse($respuestas2);
	echo "\n*****************************\n";
	echo "RESPUESTAS\n";
	print_r($respuestas);	
	echo "\n*****************************\n";
	foreach($respuestas as $valor){						
		$valorA=explode("@@",$valor);
		//echo print_r($valorA)."<br>";
		//$resultatsJefe.= count($valorA);
		$cont= count($valorA); 
		if($cont>1){
			$respuestasPrint.=$valorPinta[$valorA[0].'_'.$valorA[1]];
			echo "VALORES: ".$valorA[0].'_'.$valorA[1]."\n";
			$pos = strpos($valorA[0], "estrella");
			if ($pos === false) {
				$pos = strpos($valorA[0], "pregunta");
				if ($pos === false) { //SINO
				
					echo "tipo sino  \n".$valorA[1]."\n";
					if ($valorA[1]=="no"){
						$alertaGreu++;
					}else{
						$alertaLleu++;
					}
				}else{ //PREGUNTA
					echo "tipo pregunta \n";
					if ($valorA[1]==3){
						$alertaGreu++;
					}elseif($valorA[1]==2){
						$alertaMitja++;
					}elseif($valorA[1]==1){
						$alertaMitja2++;
					}else{
						$alertaLleu++;
					}
				}
			}else { //ESTRELLA
				echo "tipo estrella \n";
				if ($valorA[1]<2){
					$alertaGreu++;
				}elseif($valorA[1]<3){
					$alertaMitja++;
				}elseif($valorA[1]<4){
					$alertaMitja2++;
				}else{
					$alertaLleu++;
				}
			}
		}else{
			$resultats.='Text';
			echo "tipo texte \n";
		}
		//echo "alerta greu: ".$alertaGreu."\n";
		//echo "alerta mitjana:".$alertaMitja."\n";
	}
	
	echo "alerta greu: ".$alertaGreu."\n";
	echo "alerta mitjana:".$alertaMitja."\n";
	echo "alerta mitjana 2:".$alertaMitja2."\n";
	echo "alerta lleu :".$alertaLleu."\n";

	echo "RESPUESTA PRINT:". $respuestasPrint;
	//$respuestasPrint=$valorPinta["sino_yes"];
	$idCandidato="";
	
	//$url_bclose="localhost";
	
		
	if($is_candidato==1){

		if($idJob==69){
			$linkUsuario="http://".$url_bclose."/gestio/bClose/candidato-ext?id=".$idUsu2;
		}else{
			$linkUsuario="http://".$url_bclose."/gestio/bClose/candidato-edit?id=".$idUsu2;
		}
		
		$nomAlerta=$_GET["nomUsu"];
		
		$sql="SELECT * FROM bClose_enquestas_respuestas WHERE is_candidato=1 AND id_enquesta=".$idEnquesta." AND id_job=".$idJob;//idJob idEncuesta

		$sql="SELECT * FROM bClose_enquestas_respuestas WHERE id=".$_GET["id"];
		echo $sql;
		$sth = $pdopg->prepare($sql);
		$sth->execute();
		$arrayCandidato = $sth->fetchAll();
		foreach ($arrayCandidato as $row){
			$idCandidato=$row["id_enquesta_persona"];
			$id_pare=$row["id"];
			
		}
		//$nomAlerta=$_GET["nomUsu"];
		//$linkUsuario="http://".$url_bclose."/gestio/bClose/candidato-edit?id=".$idCandidato;
	}else{
		$sql="SELECT * FROM bClose_enquestas_respuestas WHERE is_candidato=1 AND id_enquesta=".$idEnquesta." AND id_job=".$idJob;//idJob idEncuesta
		$sql="SELECT * FROM bClose_enquestas_respuestas WHERE id=".$_GET["id"];
		echo $sql;
		$sth = $pdopg->prepare($sql);
		$sth->execute();
		$arrayCandidato = $sth->fetchAll();
		foreach ($arrayCandidato as $row){
			$idCandidato=$row["pare"];
			$id_pare=$row["pare"];

			
		}

		$sql="SELECT * FROM bClose_enquestas_respuestas WHERE id=".$idCandidato;
		echo $sql;
		$sth = $pdopg->prepare($sql);
		$sth->execute();
		$arrayCandidato = $sth->fetchAll();
		foreach ($arrayCandidato as $row){
			$idCandidato=$row["id_enquesta_persona"];			
			
		}
		
		$nomAlerta=$_GET["nomContacto"];

		if($idJob==69){
			$linkUsuario="http://".$url_bclose."/gestio/bClose/candidato-ext?id=".$idCandidato;
		}else{
			$linkUsuario="http://".$url_bclose."/gestio/bClose/candidato-edit?id=".$idCandidato;
		}
	}


	/**********************************************************************
	*IDIOMA ENVIOS QUAN ES EXTERIOR
	***********************************************************************/
	if($_GET["bCloseExt"]==1){
		$controlador=$_GET["mailRRHH"]; //canvi de criteri el controlador sera tb el RRHH
	}else{
		$controlador=$_GET["mailAdmin"]; 		
		
	}
	$idioma_candidato=$idiomaUsu;
	$idioma_manager=$idiomaUsu;
	$idioma_rrhh=$idiomaUsu;
	$idioma_headway=$idiomaUsu;
	$send_admin_empresa=false;
	if($idJob==69){
		$sql="SELECT * FROM bClose_candidatos WHERE id=".$idCandidato;
		echo "CANDIDATOS SQL:".$sql."\n";
		$sth = $pdopg->prepare($sql);
		$sth->execute();
		$arrayCandidatoIdioma = $sth->fetchAll();
		foreach ($arrayCandidatoIdioma as $rowIdioma){
			$idioma_candidato=$rowIdioma["idioma"];
			$idioma_manager=$rowIdioma["idioma_manager"];
			$idioma_rrhh=$rowIdioma["idioma_rrhh"];
			if($_GET["bCloseExt"]==1){	
				$idioma_headway=$rowIdioma["idioma_rrhh"];			
			}else{
				$idioma_headway=$rowIdioma["idioma_headway"];			
			}
			$id_manager=$rowIdioma["id_manager"];
		}
		if($nomContactoFinal==""){
			$sql="SELECT * FROM personas WHERE id=".$id_manager;
			echo "Manager SQL:".$sql."\n";
			$sth = $pdopg->prepare($sql);
			$sth->execute();
			$arrayManager = $sth->fetchAll();
			foreach ($arrayManager as $rowManager){
				$nomContactoFinal=$rowManager["nombre"]." ".$rowManager["apellidos"];
			}
			$_GET["nomContacto"]=$nomContactoFinal;

			echo "\nNOM CONTACTO=".$nomContactoFinal."\n";
		}
	}else{		
		if($_GET["bCloseExt"]==1){	
			echo "\nIDIOMA ENVIOS QUAN ES EXTERIOR\n";	
			$idioma_candidato=$idiomaUsu;
			$idioma_manager=$idiomaUsu;
			$idioma_rrhh=$idiomaUsu;
			$idioma_headway=$idiomaUsu;
		}else{ //busco idiomes
			$sql="SELECT * FROM candidatos_jobs_fases WHERE id_candidato=".$idCandidato." AND id_job=".$idJob. "AND id_fase='Colocado'";
			echo "CANDIDATOS SQL:".$sql."\n";
			$sth = $pdopg->prepare($sql);
			$sth->execute();
			$arrayCandidatoIdioma = $sth->fetchAll();
			foreach ($arrayCandidatoIdioma as $rowIdioma){
				$idioma_candidato=$rowIdioma["bclose_idioma"];
				$idioma_manager=$rowIdioma["idioma_manager"];
				$idioma_rrhh=$rowIdioma["idioma_rrhh"];
				$idioma_headway=$rowIdioma["idioma_headway"];	
				$id_empresa=$rowIdioma["id_empresa"];			
			}
			$sql="SELECT p.nombre, p.apellidos,p.email from empresas e
			inner join admin_usuarios p on p.id=e.id_usuario
			where e.id=".$id_empresa;			
			$sth = $pdopg->prepare($sql);
			$sth->execute();
			$arrayAdminEmpresa = $sth->fetchAll();
			foreach ($arrayAdminEmpresa as $rowAdminEmpresa){
				$email_admin_empresa=$rowAdminEmpresa["email"];				
			}
			if($controlador!=$email_admin_empresa){
				$send_admin_empresa=true;
			}

		}
	
}

	echo "idioma_candidato :".$idioma_candidato."\n";
	echo "idioma_manager SQL:".$idioma_manager."\n";
	echo "idioma_rrhh SQL:".$idioma_rrhh."\n";
	echo "idioma_headway SQL:".$idioma_headway."\n";
	/*********************************************************************
	* ENVIAR RESULTADOS HEADWAY
	*********************************************************************/

	//$controlador=$_GET["mailAdmin"]; //canvi de criteri el controlador sera tb el RRHH
	
	
	$mailRRHH=$_GET["mailRRHH"];

	$colorEnquesta="verde";
	if($is_candidato==1){
		$nomAlerta=$_GET["nomUsu"];
	}else{
		$nomAlerta=$_GET["nomContacto"];		
	}

	if ($alertaGreu>0){
		if($_GET["bCloseExt"]==1){

		}else{
			if ($idioma_headway==5){ //es
				$textInsert="Alerta Roja en respuestas - RRHH";
				
				sendMail('<p>Alerta grave en las respuestas de '.$nomAlerta.'</p><table cellpadding="0" cellmargin="0" border="0" height="44" width="178" style="border-collapse: collapse; border:5px solid #c62228"><tr><td bgcolor="#c62228" valign="middle" align="center" width="174"><div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;"><a href="'.$linkUsuario.'" style=" text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;">Ver las respuestas</a></div></td></tr></table>',"#a00d0d", $respuestasPrint,"Alerta roja en las respuestas de ".$nomAlerta,$controlador);

				if($send_admin_empresa==true){	/*ENVIO MAIL AL CONTROLADRO DE EMPRESA DE HEADWAY SI ES NECESSARI*/		
					sendMail('<p>Alerta grave en las respuestas de '.$nomAlerta.'</p><table cellpadding="0" cellmargin="0" border="0" height="44" width="178" style="border-collapse: collapse; border:5px solid #c62228"><tr><td bgcolor="#c62228" valign="middle" align="center" width="174"><div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;"><a href="'.$linkUsuario.'" style=" text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;">Ver las respuestas</a></div></td></tr></table>',"#a00d0d", $respuestasPrint,"Alerta roja en las respuestas de ".$nomAlerta,$email_admin_empresa);
				}
			}else{
				$textInsert="Red alert in the answers - HR";
				sendMail('<p>Alert! Please, revise the answers of  '.$nomAlerta.'</p><table cellpadding="0" border="0" width="278" style="border-collapse:collapse;border:5px solid #c62228"><tbody><tr><td bgcolor="#c62228" valign="middle" align="center" width="274"><a href="'.$linkUsuario.'" style="color:white; text-decoration:none;  "><span style=" text-align:center; font-size:20px; background-color: white; width:200px;  padding:5px;  color: white; text-decoration:none; text-decoration:none;  background: #c62228; /* Green */">See the answers</span></a> </td></tr></tbody></table>',"#a00d0d", $respuestasPrint,"Red alert in the responses of ". $nomAlerta,$controlador);

				if($send_admin_empresa==true){/*ENVIO MAIL AL CONTROLADRO DE EMPRESA DE HEADWAY SI ES NECESSARI*/		
					sendMail('<p>Alert! Please, revise the answers of  '.$nomAlerta.'</p><table cellpadding="0" border="0" height="34" width="278" style="border-collapse:collapse;border:5px solid #c62228"><tbody><tr><td bgcolor="#c62228" valign="middle" align="center" width="274"><a href="'.$linkUsuario.'" style="color:white; text-decoration:none;  "><span style=" text-align:center; font-size:20px; background-color: white; width:200px;  padding:5px;  color: white; text-decoration:none; text-decoration:none;  background: #c62228; /* Green */">See the answers</span></a> </td></tr></tbody></table>',"#a00d0d", $respuestasPrint,"Red alert in the responses of ". $nomAlerta,$email_admin_empresa);
				}

			}
			if($_GET["bCloseExt"]==1){
				insert_email("'".$id_pare."'",0,19,$textInsert,$controlador,$idioma_headway,$pdopg);
			
			}else{/*ENVIO MAIL AL CONTROLADRO DE EMPRESA DE HEADWAY SI ES NECESSARI*/		
				insert_email("'".$idJob."@".$id_pare."'",0,19,$textInsert,$controlador,$idioma_headway,$pdopg);
				if($send_admin_empresa==true){
					insert_email("'".$idJob."@".$id_pare."'",0,19,$textInsert,$email_admin_empresa,$idioma_headway,$pdopg);
				}
			}
		}
		$colorEnquesta="rojo";	
	}elseif( $alertaMitja>0){//=$alertaMitja2){
		if($_GET["bCloseExt"]==1){

		}else{
			if ($idioma_headway==5){ //es
				$textInsert="Orange alert in the answers - HR";
				sendMail('<p>Alerta media en las respuestas de '.$nomAlerta.'</p><table cellpadding="0" cellmargin="0" border="0" height="44" width="178" style="border-collapse: collapse; border:5px solid #c62228"><tr><td bgcolor="#c62228" valign="middle" align="center" width="174"><div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;"><a href="'.$linkUsuario.'" style=" text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;">Ver las respuestas</a></div></td></tr></table>',"#ffa219", $respuestasPrint,"Alerta Naranja en las respuestas de ".$nomAlerta,$controlador);

				if($send_admin_empresa==true){/*ENVIO MAIL AL CONTROLADRO DE EMPRESA DE HEADWAY SI ES NECESSARI*/		
					sendMail('<p>Alerta media en las respuestas de '.$nomAlerta.'</p><table cellpadding="0" cellmargin="0" border="0" height="44" width="178" style="border-collapse: collapse; border:5px solid #c62228"><tr><td bgcolor="#c62228" valign="middle" align="center" width="174"><div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;"><a href="'.$linkUsuario.'" style=" text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;">Ver las respuestas</a></div></td></tr></table>',"#ffa219", $respuestasPrint,"Alerta Naranja en las respuestas de ".$nomAlerta,$email_admin_empresa);


				}
			}else{
				$textInsert="Orange alert in the answers - HR";
				sendMail('<p>Alert! Please, revise the answers of  '.$nomAlerta.'</p><table cellpadding="0" cellmargin="0" border="0" height="44" width="178" style="border-collapse: collapse; border:5px solid #c62228"><tr><td bgcolor="#c62228" valign="middle" align="center" width="174"><div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;"><a href="'.$linkUsuario.'" style=" text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;">See the answers</a></div></td></tr></table>',"#ffa219", $respuestasPrint,"Orange alert on the responses of ". $nomAlerta,$controlador);

				if($send_admin_empresa==true){/*ENVIO MAIL AL CONTROLADRO DE EMPRESA DE HEADWAY SI ES NECESSARI*/		
					sendMail('<p>Alert! Please, revise the answers of  '.$nomAlerta.'</p><table cellpadding="0" cellmargin="0" border="0" height="44" width="178" style="border-collapse: collapse; border:5px solid #c62228"><tr><td bgcolor="#c62228" valign="middle" align="center" width="174"><div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;"><a href="'.$linkUsuario.'" style=" text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;">See the answers</a></div></td></tr></table>',"#ffa219", $respuestasPrint,"Orange alert on the responses of ". $nomAlerta,$email_admin_empresa);

				}

			}

			if($_GET["bCloseExt"]==1){
				insert_email("'".$id_pare."'",0,19,$textInsert,$controlador,$idioma_headway,$pdopg);
			
			}else{
				insert_email("'".$idJob."@".$id_pare."'",0,19,$textInsert,$controlador,$idioma_headway,$pdopg);
				if($send_admin_empresa==true){/*ENVIO MAIL AL CONTROLADRO DE EMPRESA DE HEADWAY SI ES NECESSARI*/		
					insert_email("'".$idJob."@".$id_pare."'",0,19,$textInsert,$email_admin_empresa,$idioma_headway,$pdopg);
				}
			}
		}
		$colorEnquesta="naranja";
	}elseif( $alertaMitja2>2){
		//sendMail('<p>Alerta media en las respuestas de '.$nomAlerta.'</p><a href="'.$linkUsuario.'" style="color:white; text-decoration:none;  "><div style=" text-align:center; font-size:20px; background-color: white; width:200px; height:35px; padding:5px;  color: white; text-decoration:none;  text-decoration:none; background: #c62228; /* Green */">Ver las respuestas</div></a>',"#ffeb3b", $respuestasPrint,"Alerta Amarilla BClose",$controlador);

		$colorEnquesta="amarillo";
	}


	/*********************************************************************
	* ACTUALITZO COLOR DE LA ENQUESTA
	*********************************************************************/
	$sql="UPDATE bClose_enquestas_respuestas SET 
	color='".$colorEnquesta."'
	WHERE id=".$_GET["id"];
	$sth = $pdopg->prepare($sql);
	$sth->execute();
	
	/*********************************************************************
	* COMPROVAR SI LOS DOS HAN ENVIADO LA ENCUESTA SI ES ASI NOTIFICAR-LO
	*********************************************************************/

	if($_GET["bCloseExt"]==1 OR $idJob==69){

		$sql="SELECT * FROM bClose_enquestas_respuestas WHERE respuestas!='' AND id_enquesta=".$idEnquesta." AND id_job=".$idJob." AND (id=".$id_pare." or pare=".$id_pare.")";//idJob idEncuesta
	}else{
		$sql="SELECT * FROM bClose_enquestas_respuestas WHERE respuestas!='' AND id_enquesta=".$idEnquesta." AND id_job=".$idJob. "";//idJob idEncuesta
	}
	echo $sql."\n";
	$sth = $pdopg->prepare($sql);
	$sth->execute();
	$arrayCandidatos = $sth->fetchAll();
	$cont= count($arrayCandidatos); 
	$colorEnvio="verde";
	foreach ($arrayCandidatos as $rowC){
		if($colorEnvio!=$rowC["color"]){
			if($colorEnvio=="amarillo"){
				if($rowC["color"]!="verde") $colorEnvio=$rowC["color"];
			}
			if($rowC["color"]=="rojo" ) $colorEnvio=$rowC["color"];
			if($colorEnvio=="verde" ) $colorEnvio=$rowC["color"];
		}
		//$idCandidato=$rowC["color"];			
	}
	
	$colorDos="#361E46";
	switch ($colorEnvio){
		case "verde":
			$colorDos="#361E46";
			break;
		case "amarillo":
			$colorDos="#361E46";
			break;
		case "rojo":
			$colorDos="#a00d0d";
			break;
		case "naranja":
			$colorDos="#ffa219";
			break;
	}
	echo "CONT=".$cont."\n";
	if($cont>1 )	{
		echo"<h1>LOS DOS CANDIDATOS YA HAN CONSTESTADO EL CUESTIONARIO</h1>";
		if($is_candidato==1){
			$linkUsuario="http://".$url_bclose."/gestio/bClose/candidato-edit?hola=hola&id=".$idUsu2;
		}else{
		
			$sql="SELECT * FROM bClose_enquestas_respuestas WHERE id=".$_GET["id"];
			echo $sql;
			$sth = $pdopg->prepare($sql);
			$sth->execute();
			$arrayCandidato = $sth->fetchAll();
			foreach ($arrayCandidato as $row){
				$idCandidato=$row["pare"];
				
			}

			$sql="SELECT * FROM bClose_enquestas_respuestas WHERE id=".$idCandidato;
			echo $sql;
			$sth = $pdopg->prepare($sql);
			$sth->execute();
			$arrayCandidato = $sth->fetchAll();
			foreach ($arrayCandidato as $row){
				$idCandidato=$row["id_enquesta_persona"];
				
			}
			
			if($idJob==69){
				$linkUsuario="http://".$url_bclose."/gestio/bClose/candidato-ext?hola2=hola2&id=".$idCandidato;
			}else{
				$linkUsuario="http://".$url_bclose."/gestio/bClose/candidato-edit?id=".$idCandidato;
			}
		}
		$respuestasPrint="";
		echo "\nlinkUsuario=".$linkUsuario."\n";

		//$nombre_solo_candidato=explode(" ",trim($_GET["nomUsu"]));
		//$nombre_solo_manager=explode(" ",trim($_GET["nomContacto"]));

		$nombre_solo_candidato=$_GET["nomUsu"];
		$nombre_solo_manager=$_GET["nomContacto"];

		/************************************************************
		*
		*  ENVIO DE QUE LOS DOS HAN CONTESTADO ELIMINADO
		*
		**************************************************************/
		if($_GET["bCloseExt"]==1){ //Para bclose externo no envio este email
		}else{
			if ($idioma_headway==5){ //es
				$textInsert="Ambos han contestado - RRHH";
				sendMail('<p>'.$nombre_solo_candidato.' y '.$nombre_solo_manager. ' ya han constestado el cuestionario</p><table cellpadding="0" cellmargin="0" border="0" height="44" width="178" style="border-collapse: collapse; border:5px solid #c62228"><tr><td bgcolor="#c62228" valign="middle" align="center" width="174"><div style="font-size: 18px; color: #ffffff; line-height: 1; margin: 0; padding: 0; mso-table-lspace:0; mso-table-rspace:0;"><a href="'.$linkUsuario.'" style=" text-decoration: none; color: #ffffff; border: 0; font-family: Arial, arial, sans-serif; mso-table-lspace:0; mso-table-rspace:0;">Ver las respuestas</a></div></td></tr></table>',$colorDos, $respuestasPrint, $nombre_solo_candidato." y ".$nombre_solo_manager. " han contestado",$controlador);
				//ENVIO MAIL AL CONTROLADRO DE EMPRESA DE HEADWAY SI ES NECESSARI
				if($send_admin_empresa==true){		
					sendMail('<p>'.$nombre_solo_candidato.' y '.$nombre_solo_manager. ' ya han constestado el cuestionario</p><table cellpadding="0" border="0"  width="278" style="border-collapse:collapse;border:5px solid #c62228"><tbody><tr><td bgcolor="#c62228" valign="middle" align="center" width="274"><a href="'.$linkUsuario.'" style=" text-decoration:none;  color:#fff;"><span style=" text-align:center; font-size:20px; background-color: white; width:300px; ; padding:5px;  color: white; text-decoration:none;  text-decoration:none; background: #c62228; ">Ver las respuestas</span></a></td></tr></tbody></table>',$colorDos, $respuestasPrint, $nombre_solo_candidato." y ".$nombre_solo_manager. " han contestado",$email_admin_empresa);
				}
			}else{
				$textInsert="Both have answered - HR";
				sendMail('<p>'.$nombre_solo_candidato.' and '.$nombre_solo_manager. ' have already answered the questionnaire</p><table cellpadding="0" border="0"  width="278" style="border-collapse:collapse;border:5px solid #c62228"><tbody><tr><td bgcolor="#c62228" valign="middle" align="center" width="274"><a href="'.$linkUsuario.'" style=" text-decoration:none;  color:#fff;"><span style=" text-align:center; font-size:20px; background-color: white; width:200px; padding:5px;  color: white; text-decoration:none;  text-decoration:none; background: #c62228;">See the answers</span></a></td></tr></tbody></table>',$colorDos, $respuestasPrint, $nombre_solo_candidato." and ".$nombre_solo_manager. "  have answered",$controlador);
				if($send_admin_empresa==true){//ENVIO MAIL AL CONTROLADRO DE EMPRESA DE HEADWAY SI ES NECESSARI				
					sendMail('<p>'.$nombre_solo_candidato.' and '.$nombre_solo_manager. ' have already answered the questionnaire</p><table cellpadding="0" border="0" width="278" style="border-collapse:collapse;border:5px solid #c62228"><tbody><tr><td bgcolor="#c62228" valign="middle" align="center" width="274"><a href="'.$linkUsuario.'" style=" text-decoration:none;  color:#fff;"><span style=" text-align:center; font-size:20px; background-color: white; width:300px;  padding:5px;  color: white; text-decoration:none;  text-decoration:none; background: #c62228;">See the answers</span></a></td></tr></tbody></table>',$colorDos, $respuestasPrint, $nombre_solo_candidato." and ".$nombre_solo_manager. " have answered",$email_admin_empresa);

				}

			}
		}//Para bclose externo no envio este email
		

		//**********************************************************************
		
		//LOG INTERNO

		//**********************************************************************
	
		if($_GET["bCloseExt"]==1){
			//insert_email("'".$id_pare."'",0,20,$textInsert,$controlador,$idioma_headway,$pdopg);
		
		}else{
			insert_email("'".$idJob."@".$id_pare."'",0,20,$textInsert,$controlador,$idioma_headway,$pdopg);
			if($send_admin_empresa==true){/*ENVIO MAIL AL CONTROLADRO DE EMPRESA DE HEADWAY SI ES NECESSARI*/	
				insert_email("'".$idJob."@".$id_pare."'",0,20,$textInsert,$email_admin_empresa,$idioma_headway,$pdopg);

			}

		}


		//**********************************************************************
		
		//MAIL RRHH

		//**********************************************************************

		//$idEnquesta.$idiomaUsu;
		$sql="SELECT * FROM bClose_templ_emails WHERE id_reenvio IS NULL AND  id_enquesta=".$idEnquesta." AND idioma=".$idioma_rrhh;//idJob idEncuesta
		echo $sql;
		$sth = $pdopg->prepare($sql);
		$sth->execute();
		$arrayCandidato = $sth->fetchAll();
		foreach ($arrayCandidato as $row){
			$body=$row[$colorEnvio];//."<br>".$colorEnvio."--".$idiomaUsu;


			$nombre_solo_hola=explode(" ",trim($_GET["nomRRHH"]));			
			$nombre_solo=$_GET["nomRRHH"];

			//$body=str_replace("#rrhh#",utf8_decode($nombre_solo), $body);
			$body=str_replace("#rrhh#",utf8_decode($nombre_solo_hola[0]), $body);
			$subject=str_replace("#rrhh#",utf8_decode($nombre_solo), utf8_encode($row["descripcion"]));
			
			
			//$nombre_solo=explode(" ",trim($_GET["nomUsu"]));
			$nombre_solo=$_GET["nomUsu"];
			$body=str_replace("#nom_usu#",utf8_decode($nombre_solo), $body);
			$subject=str_replace("#nom_usu#",utf8_decode($nombre_solo), utf8_encode($subject));



			//$nombre_solo=explode(" ",trim($_GET["nomContacto"]));
			//$nombre_solo=$_GET["nomContacto"];	//nom_manager		
			$body=str_replace("#nom_manager#",utf8_decode($nomContactoFinal), $body);
			//$subject=str_replace("#nom_manager#",$nombre_solo[0], utf8_encode($subject));

		}
		if ($idioma_rrhh==5){ //es
			$subject_pos="Feedback positivo";
			$subject_neg="Feedback a revisar";
		}else{
			$subject_pos="Positive feedback";
			$subject_neg="Feedback revision request";
		}
		switch ($colorEnvio){
			case "verde":
				$entradeta_subject=$subject_pos;
				break;
			case "amarillo":
				$entradeta_subject=$subject_pos;
				break;
			case "rojo":
				$entradeta_subject=$subject_neg;
				break;
			case "naranja":
				$entradeta_subject=$subject_neg;
				break;
		}

		$subject=$entradeta_subject.": ".utf8_decode($subject);


		$body=utf8_encode($body);
		$linkUsuario="http://".$url_bclose."/gestio/bClose/respuestas-edit?id=".$id_pare;
		if($_GET["bCloseExt"]==1){
			if ($idioma_rrhh==5){ //es
				$textInsert="Resumen - RRHH";
				$body= $body.'
					<table cellpadding="0" border="0" height="44" width="278" style="border-collapse:collapse;border:5px solid #c62228">
					  
					  <tbody><tr>
					    <td bgcolor="#c62228" valign="middle" align="center" width="274">
					      <div style="font-size:18px;color:#ffffff;line-height:1;margin:0;padding:0">
					        <a href="'.$linkUsuario.'" style="text-decoration:none;color:#ffffff;border:0;font-family:Arial,arial,sans-serif" border="0" target="_blank">Ver resultados Onboarding</a>
					      </div>
					    </td>
					  </tr>
					</tbody></table>

				';
			}else{
				$textInsert="Summary - HR";
				$body= $body.'
						<table cellpadding="0" border="0" height="44" width="278" style="border-collapse:collapse;border:5px solid #c62228">
					  
					  <tbody><tr>
					    <td bgcolor="#c62228" valign="middle" align="center" width="274">
					      <div style="font-size:18px;color:#ffffff;line-height:1;margin:0;padding:0">
					        <a href="'.$linkUsuario.'" style="text-decoration:none;color:#ffffff;border:0;font-family:Arial,arial,sans-serif" border="0" target="_blank">See the Onboarding results</a>
					      </div>
					    </td>
					  </tr>
					</tbody></table>

				';

			}
		}
		sendMail($body,$colorDos, '', $subject,$mailRRHH);
		if($_GET["bCloseExt"]==1){
			insert_email("'".$id_pare."'",0,20,$textInsert,$mailRRHH,$idioma_rrhh,$pdopg);
		}else{
			insert_email("'".$idJob."@".$id_pare."'",0,20,$textInsert,$mailRRHH,$idioma_rrhh,$pdopg);

		}
	}
	
}
/**************************************************************
	* MAILUSU
**************************************************************/

if($is_candidato==1){
	/*MAIL USU CANDIDAT*/
	$nombre_solo_hola=explode(" ",trim($_GET["nomUsu"]));
	$nombre_solo=$_GET["nomUsu"];

	switch ($idioma_candidato){
		case 5:

			$textInsert="Gracias - Nuevo Empleado";
			sendMail('<p style="text-align:left;">¡Hola '.($nombre_solo_hola[0]).'!</p>
			<p style="text-align:left;">
			Gracias por el tiempo que nos has dedicado. Agradecemos tus respuestas, ya que el objetivo de BClose es asegurar que tu onboarding en '.$_GET["empresa"].' como '.$_GET["posicion"].' se está haciendo de manera correcta.
			</p>
			<p style="text-align:left;"> 
			¡No dudes en contactar con nosotros, si crees que podemos ayudarte en este proceso! <br>
			Te invitamos a que nos sigas en <a href="https://www.linkedin.com/company/bclose-monitoring-onboarding/">LinkedIn</a> o <a href="https://www.bclose.net/">visites nuestra web</a>. Para ver el video de nuestra presentación, por favor, haz clic en el siguiente <a href="https://vimeo.com/315721370">enlace</a>.
			</p>
			<p style="text-align:left;">
			              Gracias por confiar en nosotros.
			 </p>

			<p style="text-align:left;">
			¡Un saludo!<br>
			El equipo de BClose
			</p>
			',"#361E46", "", "¡Gracias por compartirlo con nosotros!",$_GET["mailUsu"]);
			break;
		case 6:
			$textInsert="Thank you - New Employee";
		sendMail('<p style="text-align:left;">Hi '.($nombre_solo_hola[0]).'!</p>
		<p style="text-align:left;">
		Thank you for taking the time to share your thoughts. We truly value your answers provided as the goal of BClose is to ensure your onboarding at  '.$_GET["empresa"].' as '.$_GET["posicion"].' is properly done.  
		</p>
		<p style="text-align:left;"> 
		Please do not hesitate to contact us if you have any questions. <br>
		You can read more about us on our  <a href="https://www.bclose.net/">company page</a> and follow us on social media on <a href="https://www.linkedin.com/company/bclose-monitoring-onboarding/">LinkedIn</a>. Click this  <a href="https://vimeo.com/315721370">link </a>to watch our video.
		</p>
		<p style="text-align:left;">
		             Kind regards,
		 </p>

		<p style="text-align:left;">

		BClose team

		</p>
		',"#361E46", "", "Thank you for sharing!",$_GET["mailUsu"]);
			break;
	}
	if($_GET["bCloseExt"]==1){
		insert_email("'".$id_pare."'",0,21,$textInsert,$_GET["mailUsu"],$idioma_candidato,$pdopg);
	}else{
		insert_email("'".$idJob."@".$id_pare."'",0,21,$textInsert,$_GET["mailUsu"],$idioma_candidato,$pdopg);
	}

	//ENvio RRHH de la encuesta 
	/*
	$sql="SELECT * FROM bClose_templ_emails WHERE  id_enquesta=".$idEnquesta. " AND idioma=".$idiomaUsu. " AND id_reenvio IS NULL";//idJob idEncuesta
	$sth = $pdopg->prepare($sql);
	$sth->execute();
	$arrayTemplateRRHH = $sth->fetchAll();
	foreach ($arrayTemplateRRHH as $rowTemplate){

		$textMail=$rowTemplate[$colorEnquesta];
		$textMail=str_replace("#rrhh#",$nomRRHH,$textMail);
		$textMail=str_replace("#nom_usu#",$_GET["nomUsu"],$textMail);
		sendMail('
		'.
		$textMail
		.'
		',"#361E46", "", "Thank you for sharing!*",$mailRRHH);
	}			

	*/
}else{
	/*MAIL USU CONTACTO*/
	$nombre_solo_hola=explode(" ",trim($_GET["nomContacto"]));
	$nombre_solo=$_GET["nomContacto"];

	switch ($idioma_manager){
		case 5:
			$textInsert="Gracias- Hiring Manager";
			sendMail('<p style="text-align:left;">¡Hola '.utf8_decode($nombre_solo_hola[0]).'!</p>
			<p style="text-align:left;">
			Gracias por el tiempo que nos has dedicado. Agradecemos tus respuestas, ya que el objetivo de BClose es asegurar que el proceso de onboarding de  '.$_GET["nomUsu"].' en '.$_GET["empresa"].' se está haciendo de manera adecuada.
			</p>
			<p style="text-align:left;"> 
			¡No dudes en contactar con nosotros, si crees que podemos ayudarte en este proceso! 
			Te invitamos a que nos sigas en <a href="https://www.linkedin.com/company/bclose-monitoring-onboarding/">LinkedIn</a> o <a href="https://www.bclose.net/">visites nuestra web</a>. Para ver el video de nuestra presentación, por favor, haz clic en el siguiente <a href="https://vimeo.com/315721370">enlace</a>.
			</p>
			<p style="text-align:left;">
			              Gracias por confiar en nosotros.
			 </p>

			<p style="text-align:left;">
			¡Un saludo!<br>
			El equipo de BClose
			</p>
			',"#361E46", "", "¡Gracias por compartirlo con nosotros!",$_GET["mailUsu"]);
			break;
		case 6:
			$textInsert="Thank you - Hiring Manager";
		sendMail('<p style="text-align:left;">Hi '.utf8_decode($nombre_solo_hola[0]).'!</p>
		<p style="text-align:left;">
		Thank you for taking the time to share your thoughts. We truly value your answers provided as the goal of BClose is to ensure the onboarding of   '.$_GET["nomUsu"].' at '.$_GET["empresa"].' is properly done.    
		</p>
		<p style="text-align:left;"> 
		Please do not hesitate to contact us if you have any questions.<br>
		You can read more about us on our <a href="https://www.bclose.net/">company page</a> and follow us on social media on <a href="https://www.linkedin.com/company/bclose-monitoring-onboarding/">LinkedIn</a>. Click this  <a href="https://vimeo.com/315721370">link </a> to watch our video.
		</p>
		<p style="text-align:left;">
		             Kind regards,
		 </p>

		<p style="text-align:left;">

		BClose team

		</p>
		',"#361E46", "", "Thank you for sharing!",$_GET["mailUsu"]);
			break;
	}

		if($_GET["bCloseExt"]==1){
			insert_email("'".$id_pare."'",0,21,$textInsert,$_GET["mailUsu"],$idioma_manager,$pdopg);
		
		}else{
			insert_email("'".$idJob."@".$id_pare."'",0,21,$textInsert,$_GET["mailUsu"],$idioma_manager,$pdopg);
		}
}



function insert_email($id_enquesta_respuestas,$is_extern,$id_tipo_envio,$tipo_envio,$email,$idioma,$pdopg){
	$sql="INSERT INTO bClose_emails (id_enquesta_respuestas,is_extern,id_tipo_envio,tipo_envio,email,idioma) VALUES (".$id_enquesta_respuestas.",".$is_extern.",".$id_tipo_envio.",'".$tipo_envio."','".$email."','".$idioma."')";
					
	echo "INSERT EMAIL: ".$sql."<br>";
	$sth = $pdopg->prepare($sql);
	$sth->execute();
}



function sendMail($body,$color, $respuestasPrint, $titulo,$para){
	//$para = 'zeta123@gmail.com';
	//$titulo = 'Enviando email desde PHP';
 //$body=htmlentities($body);
	//$para="zeta123@gmail.com";
	$mensaje = '<html>
    <head>
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no">
        <style>
           a[href^=tel] {
             color: inherit;
             text-decoration:inherit;
           }    
          table em {
    		font-style: normal;
			}
        </style>            
    </head>        
    <body style="background-color:#FBFBFB; font-family:Tahoma,HelveticaNeue,Arial,sans-serif; font-size:12px;" bgcolor="#FBFBFB">
        
        <table width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#FBFBFB">
            <tr>
                <td  align="center">
                    
                    
                    <table width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px">
                        <tr>
                            <td>
                                <table width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#34404C" style="border-radius:6px 6px 0px 0px;background-color:'.$color.';color:#ededed">
                                    <tr>
                                        <td align="right" style="font-family:Tahoma,HelveticaNeue,sans-serif; text-align:right; padding-top:5px; padding-right:10px; width:640px; ">
                                           
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" height="110" style=" width:640px;">
                                            
                                            <a href="http://www.bclose.net/"><img label="Headway Logo" src="https://www.bclose.net/iconos/bclose-Logo_White.png" border="0" align="top" style="display:inline;outline-style:none;text-decoration:none;width:150px;margin:15px;" width="150px"></a>
                                        </td>
                                    </tr>
                                    <tr  bgcolor="#FFFEFE" style="background-color:#FFFEFE" >
                                        <td align="center"    bgcolor="#FFFEFE" style="background-color:#FFFEFE" >
                                        <img src="https://www.headway.es/gestio/_TA/bclose/bclose-header.jpg" style="width:100%;">
                                          
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:20px; font-family:Tahoma,HelveticaNeue,sans-serif; font-size:12px; background-color:#FFFEFE;" bgcolor="#FFFEFE">
                                '. $body.'<br> '.$respuestasPrint.'
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <!--[if gte mso 9]>
<v:image xmlns:v="urn:schemas-microsoft-com:vml" id="theImage" style=\'behavior: url(#default#VML); display:inline-block;position:absolute; height:120px; width:640px;top:0;left:0;border:0;z-index:1;\' src="https://bclose.net/iconos/footer.png"/>
<v:shape xmlns:v="urn:schemas-microsoft-com:vml" id="theText" style=\'behavior: url(#default#VML); display:inline-block;position:absolute; height:302px; width:640px;top:-5;left:-10;border:0;z-index:2;\'>
<div>
<![endif]-->
                                <table width="640" cellpadding="0" cellspacing="0" border="0"  style="border-radius:0px 0px 6px 6px; color:#fff; background: url(https://bclose.net/iconos/footer.png);">
                                    <tr>
                                        <td align="left" style=" font-size:12px; font-family:Tahoma,HelveticaNeue,sans-serif; text-align:left; padding-top:20px; padding-bottom:20px;  padding-left:20px; color:#fff; ">
                                            <p>
                                                <a href="http://www.bclose.net/" style="color:4#B0B0B0">www.bclose.net</a><br>
                                                Barcelona: +34&nbsp;93&nbsp;<font>238</font> 54 <font>86</font><br>
                                                Madrid: +34&nbsp;91&nbsp;<font>781</font> 70 <font>44</font>
                                            </p>
                                             <p>   <a style="color:#ffffff; text-decoration:none;" href="https://www.linkedin.com/company/bclose-monitoring-onboarding"><img src="http://www.headway.es/gestio/img/lnkdn_ico.gif" border="0" align="absmiddle" /></a></p>
                                        </td>
                                        <td align="right" style=" font-size:12px; font-family:Tahoma,HelveticaNeue,sans-serif; text-align:right; padding-top:20px; padding-bottom:20px;  padding-right:20px; color:#fff 	; ">
                                            <div style="text-align:right;">
                                                <p>Rambla de Catalunya, 86, 4º1ª<br>
                                                    E-08008 Barcelona</p> 
                                                <p>C/ Velázquez, 94 1ª Planta<br>
                                                    E-28006 Madrid</p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                    </table>
                    <!--[if gte mso 9]>
</div>
</v:shape>
<![endif]-->
                    
                </td>
                
            </tr>
        </table>
            
    </body>
</html>';
	$cabeceras = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$cabeceras .= 'From: BClose - Monitoring Onboarding <info@bclose.net>';
	$enviado = mail($para, $titulo, $mensaje, $cabeceras);
 
	if ($enviado){
	  echo '	Email enviado correctamente'. $para.'	';
	}else {
	  echo 'Error en el envío del email'. $para.'';
	}
	
	//$enviado = mail("zeta123@gmail.com","BCLOSE: ". $titulo, $mensaje, $cabeceras);

	}



?>