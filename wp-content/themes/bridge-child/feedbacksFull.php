<style type="text/css">
//*	.fs-anterior{display: none !important;}*/
</style>
<?php
/*
Template Name: Feedbacks FullScreen

*/
global $wp_query;
global $qode_options_proya;
$urlTheme=get_template_directory_uri();//("template_directory");



$bCloseExt=0;
//define('_DB_NAME_', 'headwaycrmdes'); //desarrollo
if(isset($_GET["bCloseExt"])){
	//die("bCloseExt");
	$bCloseExt=1;
	define('_DB_NAME_', 'bcloseextern');
	define('_DB_SERVER_', 'localhost');
	define('_DB_USER_', 'mybclose');
	define('_DB_PASSWD_', 'd7SpwMn2');

}else{
	if(isset($_GET["futuretrack"])){

		define('_DB_NAME_', 'futuretrackcrm');
		define('_DB_SERVER_', '134.0.9.144');
		//define('_DB_USER_', 'Josep10');
		//define('_DB_PASSWD_', 'Josep100');
		define('_DB_USER_', 'zetaheadway');
		define('_DB_PASSWD_', 'Dahehaj3#');

		$bCloseExt=0;
	}else{
		$bCloseExt=0;
		define('_DB_NAME_', 'headwaycrm');
		define('_DB_SERVER_', 'localhost');
		//define('_DB_USER_', 'Josep10');
		//define('_DB_PASSWD_', 'Josep100');
		define('_DB_USER_', 'myheadway');
		define('_DB_PASSWD_', 'Qwerty10');
	}
}


$dsn = 'mysql:dbname='._DB_NAME_.';host='._DB_SERVER_;
$user = _DB_USER_;
$password = _DB_PASSWD_;
										
try {
	$pdopg = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}


$sql="SELECT * FROM  bClose_config WHERE tipo=:idioma";
$sth = $pdopg->prepare($sql);
$dataIdioma = array(
  ':idioma' =>'idioma'     
);
$arrayUsu= array();
$sth->execute($dataIdioma);
$arrayIdiomes= array();
try{
	while($row=$sth->fetch(PDO::FETCH_OBJ)) {
	/*its getting data in line.And its an object*/
        //echo $row->pregunta."<br>";
		$arrayIdiomes[]=$row;
    }
}catch(PDOException  $e ){
	echo "Error: ".$e;
}
//echo "<pre>";print_r($arrayIdiomes); echo ">/pre>";
//die();

//echo "<pre>";print_r($_GET); echo ">/pre>";






$sql="SELECT id,nombre,apellidos,is_candidato FROM  personas WHERE id=:id_persona";
//$sth = $pdopg->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
//print_r($arrayDades);
//die();
$sth = $pdopg->prepare($sql);
$data = array(
  ':id_persona' =>$_GET["idUsu"]     
);
//echo "<pre>";print_r($data); echo ">/pre>";
$arrayUsu= array();
$sth->execute($data);
try{
	while($row=$sth->fetch(PDO::FETCH_OBJ)) {
	/*its getting data in line.And its an object*/
        //echo $row->pregunta."<br>";
		$arrayUsu[]=$row;
    }
}catch(PDOException  $e ){
	echo "Error: ".$e;
}


$sql="SELECT * FROM bClose_enquestas_respuestas WHERE  id=:idid";
//echo $sql;
$sth = $pdopg->prepare($sql);
$data = array(
  ':idid' =>$_GET["id"]     
);
$sth->execute($data);
$arrayEn= array();
try{
	while($row=$sth->fetch(PDO::FETCH_OBJ)) {
	/*its getting data in line.And its an object*/
        //echo $row->pregunta."<br>";
		$arrayEn[]=$row;	
    }
}catch(PDOException  $e ){
	echo "Error: ".$e;
}
if($arrayEn[0]->respuestas!=""){
	?>
	<script type="text/javascript">
		location.href="https://www.bclose.net/cuestionario-ya-contestado-con-anterioridad-questionnaire-already-answered-before/";
	</script>
	<?php
	
}


//echo "<h1>".count($arrayUsu)."</h1>";
if(isset($_GET["bCloseExt"])){
	//$arrayUsu[0]->is_candidato=$arrayEn[0]->is_candidato;
}




/*************************************************
COMPROVAR SI ES UN USUARI FORA DE HEADWAY
*************************************************/
if(count($arrayUsu)==0){
	$sql="SELECT id,nombre,apellidos,1 as is_candidato FROM  bClose_candidatos WHERE id=:id_persona";
	$sth = $pdopg->prepare($sql);
	$data = array(
	  ':id_persona' =>$_GET["idUsu"]     
	);
	//echo "<pre>";print_r($data); echo ">/pre>";
	$arrayUsu= array();
	$sth->execute($data);
	try{
		while($row=$sth->fetch(PDO::FETCH_OBJ)) {
		/*its getting data in line.And its an object*/
	        //echo $row->pregunta."<br>";
			$arrayUsu[]=$row;
	    }
	}catch(PDOException  $e ){
		//echo "Error: ".$e;
	}
}

//echo count($arrayUsu);

//echo $arrayUsu["is_candidato"];
//echo "<pre>";print_r($arrayUsu); echo "</pre>";
//echo $arrayUsu[0]->is_candidato;
$sql="SELECT * FROM  bClose_enquestas_preguntas WHERE id_enquesta=:id_enquesta AND is_candidato=". $arrayUsu[0]->is_candidato. " ORDER BY orden ASC";
//echo $sql;
//$sth = $pdopg->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
//print_r($arrayDades);
//die();





$sth = $pdopg->prepare($sql);
$data = array(
  ':id_enquesta' =>$_GET["idEncuesta"]     
);
//echo "<pre>";print_r($data); echo "</pre>";
$arrayPreguntas= array();
$sth->execute($data);
try{
	while($row=$sth->fetch(PDO::FETCH_OBJ)) {
	/*its getting data in line.And its an object*/
        //echo $row->pregunta."<br>";
		$arrayPreguntas[]=$row;
    }
}catch(PDOException  $e ){
	echo "Error: ".$e;
}

//comparacions de parametres per substituir
$trans = array("#nombre_candidato#" => utf8_decode($_GET["nomUsu"]));
 


?>
<!DOCTYPE html>
<html >
<head>

  
  <title>BClose - Feedbacks -</title>
  <meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<meta name="description" content="Fullscreen Form Interface: A distraction-free form concept with fancy animations" />
		<meta name="keywords" content="fullscreen form, css animations, distraction-free, web design" />
		<meta name="author" content="Codrops" />
		<link rel="stylesheet" type="text/css" href="<?=$urlTheme?>/feedbacksFull/css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="<?=$urlTheme?>/feedbacksFull/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="<?=$urlTheme?>/feedbacksFull/css/component.css" />
		<link rel="stylesheet" type="text/css" href="<?=$urlTheme?>/feedbacksFull/css/cs-select.css" />
		<link rel="stylesheet" type="text/css" href="<?=$urlTheme?>/feedbacksFull/css/cs-skin-boxes.css" />
		<script src="<?=$urlTheme?>/feedbacksFull/js/modernizr.custom.js"></script>
  
 		<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
        <!--
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
-->
</head>

<body>
<style>
#language li.selecionado {
    background: #ffffff91;
}
#language li {
/*  float: left;*/
      list-style: none;
    text-align: center;
    background-color: #5c3874ad;
    margin-right: 15px;
    line-height: 30px;
    padding: 10px;
    border: 1px solid white;
    border-radius: 8px;
    cursor: pointer;
}
#language li .selecionado{

}

ul#language{/*
    list-style:none;
    position:relative;
    left:50%;*/
    display: flex;
  justify-content: center;
  margin: 0;
 /* position: fixed;  */
    text-align: center;
    width: 100%;
    top: 10px;
    z-index: 12;
    
}


</style>



<div class="container">
<?php
//echo "<pre>";print_r($arrayPreguntas); print_r($arrayUsu); echo ">/pre>";

//die();


?>
			<div class="fs-form-wrap" id="fs-form-wrap">
				<div class="fs-title" id="titulo">
					<h1><img src="https://www.bclose.net/wp-content/uploads/2018/10/bclose-Logo_White.png" style="width: 180px"></h1>
					<!--<div class="codrops-top">
						<a class="codrops-rfgicon codrops-icon-prev" href="http://tympanus.net/Development/NotificationStyles/"><span>Previous Demo</span></a>
						<a class="codrops-icon codrops-icon-drop" href="http://tympanus.net/codrops/?p=19520"><span>Back to the Codrops Article</span></a>
						<a class="codrops-icon codrops-icon-info" href="#"><span>This is a demo for a fullscreen form</span></a>
					</div><br /><b>Notice</b>:  Undefined variable: cadbusqueda_1 in <b>/var/www/dev.iqac.csic.es/qci/estades.php</b> on line <b>264</b><br />br /><b>Notice</b>:  Undefined variable: cadbusqueda_1 in <b>/var/www/dev.iqac.csic.es/qci/seminaris.php</b> on line <b>274</b><br /> data-q_id="#clients"
				-->
					<div style="    position: relative;    top: -85px;">
						<ul id="language">
						<?php
						$idiomaDefecto=5; //castellano
						foreach ($arrayIdiomes as $key => $value) {
							echo "<li id='lang-".$value->id."' class='langs' onclick='selectLang(".$value->id.");'>".$value->nombre."</li>";
							if($value->frequencia==1){
								$idiomaDefecto=$value->id;
							}
							# code...
						}
						?>
						</ul>
					</div>
				</div>
                <style>
                .fs-form-full .fs-fields > li label[data-info]::after{ display: none; }
			   .selector_input_label{ 
				min-height: 30px !important;
				color: rgb(255, 255, 255) !important;
				background-color: rgba(255, 255, 255, 0.1)  ;
				box-shadow: rgba(255, 255, 255, 0.6) 0px 0px 0px 1px inset !important;
				cursor: pointer !important;
				opacity: 1 !important;
				height: auto !important;
				border-radius: 4px !important;								   
				font-size: 20px;
				line-height: 40px;
				padding:5px;
				margin:5px;
				padding-top:inherit !important;
			   }
			   .fs-fields > li label.fs-field-label {
				    font-size: 0.7em;
				}
				.fs-fields > li .fs-radio-custom span {
				float: left;
				position: relative;
				margin-right: 0;
				padding: 5px;
				max-width: 200px;
				width: 15%;
				text-align: center;
				font-weight: 700;
				font-size: 50%;
				font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
			}
			.fs-fields input {
				height: 40px !important;
				z-index: 999;
			}

			.place_txt::-webkit-input-placeholder {
			    color: #ababab !important;
			}

			.place_txt::-webkit-input-placeholder {
			    color: #ababab !important;
			}

			.place_txt:-moz-placeholder { /* Firefox 18- */
			    color: #ababab !important;
			}

			.place_txt::-moz-placeholder {  /* Firefox 19+ */
			    color: #ababab !important;
			}

			.place_txt:-ms-input-placeholder {
			    color: #ababab !important;
			}
			.transparent_text { color:rgba(0,0,0,0) !important; }
			</style>
                   
				<form id="myform" class="fs-form fs-form-full" autocomplete="off">
                
					<ol class="fs-fields">
						<?php
						$contP=2;
						foreach($arrayPreguntas as $clave => $valor){
							/*********OBTING EL IDIOMes PREGUNTA*****/
							$sql="SELECT * FROM  bClose_enquestas_preguntas_idioma WHERE id_pregunta=:id_pregunta ";
							$sthPI = $pdopg->prepare($sql);
							$data = array(
							  ':id_pregunta' =>$valor->id    
							);
							$arrayPreguntasIdioma= array();
							$sthPI->execute($data);
							try{
								while($rowIdioma=$sthPI->fetch(PDO::FETCH_OBJ)) {
									$arrayPreguntasIdioma[][$rowIdioma->idioma]=$rowIdioma;
							    }
							}catch(PDOException  $e ){
								echo "Error: ".$e;
							}
							//echo "<pre>";print_r($arrayPreguntasIdioma[0][6]); echo ">/pre>";
							/***************************************/
							?>
                             <li data-input-trigger>
                                
                                <label class="fs-field-label fs-anim-upper" for="q<?=$contP?>" data-info="This will help us know what kind of service you need">
                                <span class="lang lang-<?=$idiomaDefecto?>"><?php   echo utf8_encode(strtr($valor->pregunta,$trans));?></span>
                                <?php
                                foreach ($arrayIdiomes as $key => $value) {
                                	# code...
									if($value->frequencia!=1){
										
										?>
										 <span class="lang lang-<?=$value->id?>"><?php   echo utf8_encode(strtr($arrayPreguntasIdioma[0][$value->id]->pregunta,$trans));?></span>
										<?php
									}
                                }
                                ?>
                               
                            	</label>
                                <div class="fs-radio-group fs-radio-custom clearfix fs-anim-lower">
                                
								
                                
                                	<?php
									switch ($valor->tipo){
										case 0: //questionario normal
											 if ($valor->respuesta_1!=""){?>
                                           
                                              <input id="res_<?=$contP."-1"?>" class="selector_input" type="radio" name="radio<?=$contP?>" value="<?=$valor->pr_valor_1?>" data-tipo="pregunta" required/><label for="res_<?=$contP."-1"?>" class="selector_input_label label_res_<?=$contP."-1"?>" >
                                              	<font class="lang lang-<?=$idiomaDefecto?>"><?=utf8_encode($valor->respuesta_1)?></font>
                                              	 	<?php
					                                foreach ($arrayIdiomes as $key => $value) {
					                                	# code...
														if($value->frequencia!=1){
															
															?>
															 <font class="lang lang-<?=$value->id?>"><?php   echo utf8_encode(strtr($arrayPreguntasIdioma[0][$value->id]->respuesta_1,$trans));?></font>
															<?php
														}
					                                }
					                                ?>
                                              </label>
                                            
                                            <?php }
                                                if ($valor->respuesta_2!=""){?>            
                                           
                                              <input  id="res_<?=$contP."-2"?>" class="selector_input"  type="radio" name="radio<?=$contP?>" id="radio2"  value="<?=$valor->pr_valor_2?>" data-tipo="pregunta"/><label for="res_<?=$contP."-2"?>"  class="selector_input_label label_res_<?=$contP."-2"?>" >
                                              	<font class="lang lang-<?=$idiomaDefecto?>"><?=utf8_encode($valor->respuesta_2)?></font>
                                              	 	<?php
					                                foreach ($arrayIdiomes as $key => $value) {
					                                	# code...
														if($value->frequencia!=1){
															
															?>
															 <font class="lang lang-<?=$value->id?>"><?php   echo utf8_encode(strtr($arrayPreguntasIdioma[0][$value->id]->respuesta_2,$trans));?></font>
															<?php
														}
					                                }
					                                ?>

                                              		

                                              	</label>
                                            
                                            <?php }
                                                if ($valor->respuesta_3!=""){?>            
                                           
                                              <input  id="res_<?=$contP."-3"?>" class="selector_input"  type="radio" name="radio<?=$contP?>" id="radio3" value="<?=$valor->pr_valor_3?>" data-tipo="pregunta"/><label for="res_<?=$contP."-3"?>"class="selector_input_label label_res_<?=$contP."-3"?>" >
                                              	<font class="lang lang-<?=$idiomaDefecto?>"><?=utf8_encode($valor->respuesta_3)?></font>
                                              	 	<?php
					                                foreach ($arrayIdiomes as $key => $value) {
					                                	# code...
														if($value->frequencia!=1){
															
															?>
															 <font class="lang lang-<?=$value->id?>"><?php   echo utf8_encode(strtr($arrayPreguntasIdioma[0][$value->id]->respuesta_3,$trans));?></font>
															<?php
														}
					                                }
					                                ?>



                                              </label>
                                           
                                            <?php }
                                                if ($valor->respuesta_4!=""){?> 
                                            
                                              <input  id="res_<?=$contP."-4"?>" class="selector_input"  type="radio" name="radio<?=$contP?>" id="radio4" value="<?=$valor->pr_valor_4?>"  data-tipo="pregunta"/><label for="res_<?=$contP."-4"?>" class="selector_input_label label_res_<?=$contP."-4"?>" >
                                              	<font class="lang lang-<?=$idiomaDefecto?>"><?=utf8_encode($valor->respuesta_4)?></font>
                                              	 	<?php
					                                foreach ($arrayIdiomes as $key => $value) {
					                                	# code...
														if($value->frequencia!=1){
															
															?>
															 <font class="lang lang-<?=$value->id?>"><?php   echo utf8_encode(strtr($arrayPreguntasIdioma[0][$value->id]->respuesta_4,$trans));?></font>
															<?php
														}
					                                }
					                                ?>



                                              </label>
                                           
                                            <?php
												}
											  if ($valor->texto_libre==1){?> 
                                            	<div id="res_<?=$contP."-libre"?>_modal" class="modal" style="position:absolute;display:none; z-index:1111; width: 100%;">
                                                <div class="tapa" style=" z-index:98;    height: 15000px;    width: 15000px;    background: rgba(255,255,255,0.6);    top: -5000px;    position: absolute;    left: -5000px;)">

                                                 
                                                </div>
                                                <div style="z-index:1112; position:absolute;  background: #550463;">
                                                 <textarea style="font-size: 18px; color: black; background-color: #fff5f5d1;     border: 2px solid #9C27B0;" class="fs-anim-lower place_txt" id="res_<?=$contP."-libre-text"?>" name="res_<?=$contP."-1"?>" placeholder="Describe here" ></textarea>
                                                  <button  style="font-size: 18px;    width: 100%;    height: 62px;    padding: 0px;    background: #691977fa;    color: white;" type="button" class="btn_close" onclick="textLliure('res_<?=$contP."-libre"?>');" style >Close</button>
                                                </div>
                                                </div>

                                               <input  id="res_<?=$contP."-libre"?>" class="selector_input"  type="radio" name="radio<?=$contP?>" id="radiolibre" value=""  data-tipo="pregunta"/><label for="res_<?=$contP."-libre"?>" class="selector_input_label label_res_<?=$contP."-libre"?>" >                                              	
												<font class="lang lang-<?=$idiomaDefecto?>"><?=utf8_encode($valor->pregunta_libre)?></font>
                                              	 	<?php
					                                foreach ($arrayIdiomes as $key => $value) {
					                                	# code...
														if($value->frequencia!=1){
															
															?>
															 <font class="lang lang-<?=$value->id?>">
															 <?php   echo utf8_encode(strtr($arrayPreguntasIdioma[0][$value->id]->pregunta_libre,$trans));?></font>
															<?php
														}
					                                }

					                                ?>


                                               </label>
                                           
                                            <?php
											  }
											break;
										case 1: //estrellas
											//echo $valor->pr_estrella;
											?>
                                            <!--<img src="https://www.bclose.net/iconos/img/PNG/icono_<?=$valor->pr_estrella?>.png">-->
                                            <span><input id="res_<?=$contP."-1"?>" name="res_<?=$contP."-1"?>" type="radio" value="1" data-tipo="estrella" required/><label for="res_<?=$contP."-1"?>" class="transparent_text radio-estrella_<?=$valor->pr_estrella?> label_res_<?=$contP."-1"?> estrellita" >1</label></span>
		                                    <span><input id="res_<?=$contP."-2"?>" name="res_<?=$contP."-2"?>" type="radio" value="2" data-tipo="estrella"/><label for="res_<?=$contP."-2"?>" class="transparent_text radio-estrella_<?=$valor->pr_estrella?> label_res_<?=$contP."-2"?> estrellita" >2</label></span>
                                            <span><input id="res_<?=$contP."-3"?>" name="res_<?=$contP."-3"?>" type="radio" value="3" data-tipo="estrella"/><label for="res_<?=$contP."-3"?>" class="transparent_text radio-estrella_<?=$valor->pr_estrella?> label_res_<?=$contP."-3"?> estrellita" >3</label></span>
		                                    <span><input id="res_<?=$contP."-4"?>" name="res_<?=$contP."-4"?>" type="radio" value="4" data-tipo="estrella"/><label for="res_<?=$contP."-4"?>" class="transparent_text radio-estrella_<?=$valor->pr_estrella?> label_res_<?=$contP."-4"?> estrellita">4</label></span>
		                                    <span><input id="res_<?=$contP."-5"?>" name="res_<?=$contP."-5"?>" type="radio" value="5" data-tipo="estrella"/><label for="res_<?=$contP."-5"?>" class="transparent_text radio-estrella_<?=$valor->pr_estrella?> label_res_<?=$contP."-5"?> estrellita" >5</label></span>                                        
                                            
                                            
                                            
                                            <?php
											break;
										case 2: //texte lliure
											?>
											<textarea class="fs-anim-lower" id="res_<?=$contP."-1"?>" name="res_<?=$contP."-1"?>" placeholder="Describe here" required></textarea>
                                            <?php
											break;
										case 3:// si/no
											//echo $valor->pr_sino;
											?>
                                            <span><input id="res_<?=$contP."-1"?>" name="label_res_<?=$contP."-1"?>" type="radio" value="yes"  data-tipo="sino" required/><label for="res_<?=$contP."-1"?>" class="radio-sino_<?=$valor->pr_sino?>_yes  label_res_<?=$contP."-1"?> sino"   data-tipo="pregunta" >Yes</label></span>
		                                    <span><input id="res_<?=$contP."-2"?>" name="res_<?=$contP."-2"?>" type="radio" value="no"  data-tipo="sino"/><label for="res_<?=$contP."-2"?>" class="radio-sino_<?=$valor->pr_sino?>_no  label_res_<?=$contP."-2"?> sino"  data-tipo="pregunta" >No</label></span>
                                            <?php
											break;
									}
									?>
                                    <!--<span><input id="q3b" name="q3" type="radio" value="conversion"/><label for="q3b" class="radio-conversion">Sell things</label></span>
                                    <span><input id="q3c" name="q3" type="radio" value="social"/><label for="q3c" class="radio-social">Become famous</label></span>
                                    <span><input id="q3a" name="q3" type="radio" value="mobile"/><label for="q3a" class="radio-mobile">Mobile market</label></span>-->
                                    
                                </div>
                            </li>
                            <?php
							
							$contP++;
						} //FINAL DEL FRO
						?>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <!--
                        <li data-input-trigger>
                        	
							<label class="fs-field-label fs-anim-upper" for="q3" data-info="This will help us know what kind of service you need">What's your priority for your new website?</label>
							<div class="fs-radio-group fs-radio-custom clearfix fs-anim-lower">
								<span><input id="q3d" name="q3" type="radio" value="yes"/><label for="q3d" class="radio-yes">Mobile market</label></span>
								<span><input id="q3e" name="q3" type="radio" value="no"/><label for="q3e" class="radio-no">Mobile market</label></span>
							</div>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q1">What's your name?</label>
							<input class="fs-anim-lower" id="q1" name="q1" type="text" placeholder="Dean Moriarty" required/>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q2" data-info="We won't send you spam, we promise...">What's your email address?</label>
							<input class="fs-anim-lower" id="q2" name="q2" type="email" placeholder="dean@road.us" required/>
						</li>
						<li data-input-trigger>
							<label class="fs-field-label fs-anim-upper" data-info="We'll make sure to use it all over">Choose a color for your website.</label>
							<select class="cs-select cs-skin-boxes fs-anim-lower">
								<option value="" disabled selected>Pick a color</option>
								<option value="#588c75" data-class="color-588c75">#588c75</option>
								<option value="#b0c47f" data-class="color-b0c47f">#b0c47f</option>
								<option value="#f3e395" data-class="color-f3e395">#f3e395</option>
								<option value="#f3ae73" data-class="color-f3ae73">#f3ae73</option>
								<option value="#da645a" data-class="color-da645a">#da645a</option>
								<option value="#79a38f" data-class="color-79a38f">#79a38f</option>
								<option value="#c1d099" data-class="color-c1d099">#c1d099</option>
								<option value="#f5eaaa" data-class="color-f5eaaa">#f5eaaa</option>
								<option value="#f5be8f" data-class="color-f5be8f">#f5be8f</option>
								<option value="#e1837b" data-class="color-e1837b">#e1837b</option>
								<option value="#9bbaab" data-class="color-9bbaab">#9bbaab</option>
								<option value="#d1dcb2" data-class="color-d1dcb2">#d1dcb2</option>
								<option value="#f9eec0" data-class="color-f9eec0">#f9eec0</option>
								<option value="#f7cda9" data-class="color-f7cda9">#f7cda9</option>
								<option value="#e8a19b" data-class="color-e8a19b">#e8a19b</option>
								<option value="#bdd1c8" data-class="color-bdd1c8">#bdd1c8</option>
								<option value="#e1e7cd" data-class="color-e1e7cd">#e1e7cd</option>
								<option value="#faf4d4" data-class="color-faf4d4">#faf4d4</option>
								<option value="#fbdfc9" data-class="color-fbdfc9">#fbdfc9</option>
								<option value="#f1c1bd" data-class="color-f1c1bd">#f1c1bd</option>
							</select>
						</li>
                       
						<li>
							<label class="fs-field-label fs-anim-upper" for="q4">Describe how you imagine your new website</label>
							<textarea class="fs-anim-lower" id="q4" name="q4" placeholder="Describe here"></textarea>
						</li>
						<li>
							<label class="fs-field-label fs-anim-upper" for="q5">What's your budget?</label>
							<input class="fs-mark fs-anim-lower" id="q5" name="q5" type="number" placeholder="1000" step="100" min="100"/>
						</li> -->
					</ol><!-- /fs-fields -->
					<style type="text/css">
						.fs-submit p a{
							text-align: center;
							color: white;
						
						}
						.fs-submit p {
							color: white;
							margin: 0px;
						}

					</style>
					<div style="margin-top: -7%;" class="fs-submit">
						<p style="text-align: center;"><img src="https://www.bclose.net/wp-content/uploads/2018/10/bclose-Logo_White.png" style="width: 300px;"></p>
                    	<h1 style="text-align: center; color: white; font-size: 25px;">
                    		Monitoring Onboarding
                    	</h1>
						<p class="lang lang-5" style="text-align: center;  text-transform: inherit; color: white;  padding: 5px; font-size: 15px;margin-bottom: 10px;">
						Gracias por completar nuestro cuestionario.
						</p>
						<p class="lang lang-6"  style="text-align: center;  text-transform: inherit; color: white;  padding: 5px; font-size: 15px;margin-bottom: 10px;">
						Thank you for completing our questionnaire!
						</p>
						<style>
							#legal2 a{ color: white; }
							#legal2 a:hover{ color:#ccc; }
						</style>
						<div style="font-size: 10px; color: white; padding: 5px;" id="legal2">
						<p style="float: left;"><input type="checkbox" name="legal"  id="legal"value="1" aria-invalid="false"></span></span></span> <span class="legal-txt">
							
							<div class="lang lang-5">
							<a href="https://www.bclose.net/cookies-policy/" target="_blank">He leído y acepto la política de privacidad</a>.</span><p><br></p>
<p><strong>Responsable:</strong> HEADWAY EXECUTIVE, S.L. (<a href="https://www.bclose.net/privacy-policy/" target="_blank">+info</a>)</p>
<p><strong>Finalidades:</strong> Gestión de las peticiones realizadas a través del Sitio Web y, en su caso, del envío de las comunicaciones comerciales (<a href="https://headway.es/politica-de-privacidad/" target="_blank">+info</a>)</p>
<p><strong>Legitimación:</strong> Consentimiento del interesado (<a href="https://www.bclose.net/privacy-policy/" target="_blank">+info</a>)</p>
<p><strong>Destinatarios:</strong> No se cederán datos a terceros, salvo obligación legal (<a href="https://www.bclose.net/privacy-policy/" target="_blank">+info</a>)</p>
<p><strong>Derechos:</strong> Acceder, rectificar, suprimir y oponerse, así como otros derechos, tal y como se explica en la “Información Adicional” (<a href="https://www.bclose.net/privacy-policy/" target="_blank">+info</a>)</p>
<p><strong>Información Adicional:</strong> Puede consultar información adicional y detallada sobre protección de datos en la <a href="https://www.bclose.net/privacy-policy/" target="_blank">Política de Privacidad</a>.
</p>
							</div>


							<div class="lang lang-6">
							<a href="https://www.bclose.net/cookies-policy/" target="_blank">I accept the Privacy and Cookies Policy.</a>.</span><p><br></p>
<p><strong>Data controller:</strong> HEADWAY EXECUTIVE, S.L. (<a href="https://www.bclose.net/privacy-policy/" target="_blank">+info</a>)</p>
<p><strong>Purpose:</strong> To manage requests for the information and, where applicable, to keep users informed of news that may be of interest to them. (<a href="https://headway.es/politica-de-privacidad/" target="_blank">+info</a>)</p>
<p><strong>Legitimation:</strong> Consent of the interested party (<a href="https://www.bclose.net/privacy-policy/" target="_blank">+info</a>)</p>
<p><strong>Recipients:</strong> Related entities (<a href="https://www.bclose.net/privacy-policy/" target="_blank">+info</a>)</p>
<p><strong>Rights:</strong> To access, rectify and have data deleted, as well as other rights as it is explained in the additional information  (<a href="https://www.bclose.net/privacy-policy/" target="_blank">+info</a>)</p>
<p><strong>Additional Information:</strong> You can access the additional information about data protection in  <a href="https://www.bclose.net/privacy-policy/" target="_blank">Privacy Policy.</a>.
</p>
							</div>
							<div style="clear: both;"></div>
<!--
	Thank you for completing our questionnaire.

 

I accept the Privacy and Cookies Policy.

 

Data controller: HEADWAY EXECUTIVE, S.L. (+info)

Purpose: To manage requests for the information and, where applicable, to keep users informed of news that may be of interest to them.

Legitimation: Consent of the interested party (+info)

Recipients: Related entities (+info)

Rights: To access, rectify and have data deleted, as well as other rights as it is explained in the additional information (+info)

Additional Information: You can access the additional information about data protection in Privacy Policy.
	-->

						</div>
						<p  style="text-align: center;">
						<button class="fs-submit fs-enviar" type="button" id="click_submit" style="    background: rgba(193,19,19,0.5);   color: white;  border-color: white;    border-radius: 15px;    float: inherit;
    text-align: center;    width: 100% !important; padding-top: 10px;     border-width: 1px;" >Enviar cuestionario</button></p>
					</div>
				</form><!-- /fs-form -->
			</div><!-- /fs-form-wrap -->

		

		</div><!-- /container -->
        
        
        <script src="<?=$urlTheme?>/feedbacksFull/js/classie.js"></script>
		<script src="<?=$urlTheme?>/feedbacksFull/js/selectFx.js"></script>
		<script src="<?=$urlTheme?>/feedbacksFull/js/fullscreenForm.js"></script>
		<script>
			(function() {
				var formWrap = document.getElementById( 'fs-form-wrap' );

				[].slice.call( document.querySelectorAll( 'select.cs-select' ) ).forEach( function(el) {	
					new SelectFx( el, {
						stickyPlaceholder: false,
						onChange: function(val){
							document.querySelector('span.cs-placeholder').style.backgroundColor = val;
						}
					});
				} );

				new FForm( formWrap, {
					onReview : function() {
						classie.add( document.body, 'overview' ); // for demo purposes only
					}
				} );
			})();
		</script>
        
<script>
<?php
if(isset($_GET["futuretrack"])){
	?>
	var dominis="&futuretrack";
	<?php
}else{
	?>
	var dominis="";
	<?php
}
?>
var bCloseExt=<?=$bCloseExt?>;

var id=<?=$_GET["id"] ?>;
var idBD=<?=$_GET["id"] ?>;
var idEncuesta=<?=$_GET["idEncuesta"] ?>;
var idUsuario=<?=$_GET["idUsu"] ?>;
var intervalError=0;
var arrResult = [];
var arrResposta = [];
var arrResult2 = [];
var stepNumber=0;
var numSteps=<?=$contP?>;
var urlTheme="<?=$urlTheme?>";
var contTmp=numSteps-2;

var posicion="<?=$_GET["posicion"] ?>";
var nomContacto="<?=$_GET["nomContacto"] ?>";
var nomUsu="<?=$_GET["nomUsu"] ?>";
var empresa="<?=$_GET["empresa"] ?>";
var mailUsu="<?=$_GET["mailUsu"] ?>";
var mailAdmin="<?=$_GET["mailAdmin"] ?>";
var mailRRHH="<?=$_GET["mailRRHH"] ?>";
var nomRRHH="<?=$_GET["nomRRHH"] ?>";

var saltaParada=false;
var idiomaCuetionario=<?=$_GET["idioma"] ?>;
//alert(idiomaCuetionario);
//alert(<?=$idiomaDefecto?>);

$(".lang").hide();
$(".lang-<?=$idiomaDefecto?>").show();
//selectLang(<?=$idiomaDefecto?>);
selectLang(idiomaCuetionario);


function selectLang(idioma){
	$( ".langs" ).removeClass("selecionado");

	$( "#lang-"+idioma ).addClass("selecionado");
	$(".lang").hide();
	$(".lang-"+idioma).show();
	//canvis de idoma//
	switch(idioma){
		case 5: //ES
			idiomaCuetionario=idioma;
			$(".fs-anterior").html("Anterior");
			$(".fs-continue").html("Siguiente");
			$(".fs-gracias").html("Gracias por completar nuestro cuestionario.");
			$(".fs-enviar").html("Enviar");
			$(".btn_close").html("Cerrar");
			$(".place_txt").attr("placeholder", "¿Quieres proporcionarnos más detalles?");
			
			break;
		case 6: //EN
			idiomaCuetionario=idioma;
			$(".fs-continue").html("Next");
			$(".fs-anterior").html("Previous");
			$(".fs-gracias").html("Thank you for completing our questionnaire.");
			$(".fs-enviar").html("Send");
			$(".btn_close").html("Close");
			$(".place_txt").attr("placeholder", "Would you like to share more datails us?");
			break;
	}
}



$(".estrellita").css("opacity","0.5");
$(".sino").css("opacity","0.5");

while (contTmp!=0){
	jQuery(".modal-header").append("<span></span>");
	contTmp--;
}

$(".estrellita").mouseover(function(){
	var id=jQuery(this).attr("for");
	jQuery(".label_"+id).css("opacity", '1');
	var res = id.split("-");	
	estrellitasMenos(res[0],res[1],1);
});

$(".estrellita").mouseout(function(){
	var id=jQuery(this).attr("for");
	jQuery(".label_"+id).css("opacity", '0.5');	
	var res = id.split("-");
	estrellitasMenos(res[0],res[1],"0.5");
	
	var res = id.split("-");	
	if ( arrResposta.indexOf(res[0]) === -1) {
		
	}else{		
		var id2=arrResult[arrResposta.indexOf(res[0])];		
		jQuery(".label_"+id2).css("opacity", '1');

		var res = id2.split("-");
		estrellitasMenos(res[0],res[1],1);
	}
	
});


$(".sino").mouseover(function(){
	var id=jQuery(this).attr("for");
	jQuery(".label_"+id).css("opacity", '1');
	
});

$(".sino").mouseout(function(){
	var id=jQuery(this).attr("for");
	jQuery(".label_"+id).css("opacity", '0.5');	
	
	
	var res = id.split("-");	
	if ( arrResposta.indexOf(res[0]) === -1) {
		
	}else{		
		var id2=arrResult[arrResposta.indexOf(res[0])];		
		jQuery(".label_"+id2).css("opacity", '1');
		
	}
	
});

function estrellitasMenos(pregunta,id,value){
	while(id!=-1){
		jQuery(".label_"+pregunta+"-"+id).css("opacity", value);
		id--;
	}
}

function textEditSave(inputText){
	id=inputText.id;
	console.log(id);
	var res = id.split("-");	
		var res = id.split("-");	
	if ( arrResposta.indexOf(res[0]) === -1) {
		arrResposta.push(res[0]);
		arrResult.push(inputText.value);
	}else{
		//deselecciona els anteriors
		//var id2=arrResult[arrResposta.indexOf(res[0])];
		//jQuery(".label_"+id2).css("opacity", '0.5');		
		arrResult[arrResposta.indexOf(res[0])]=inputText.value;
	}	
	
	console.log("array_respostes: "+arrResposta + " -- resultats: "+ arrResult);
}

function inputOver(id){
	console.log("over: "+id);
	switch(jQuery("#"+id).attr("data-tipo")){
		case "estrella":
			//jQuery(".fs-fields .fs-radio-custom .label_"+id+"::after").css("opacity", '1');	
			break;
		case "pregunta": 
			jQuery(".label_"+id).css("background-color", 'rgba(255, 255, 255, 0.6)');
			break;
	}
	
}
function inputOut(id){
	switch(jQuery("#"+id).attr("data-tipo")){
		case "estrella":
			//jQuery(".fs-fields .fs-radio-custom .label_"+id+"::after").css("opacity", '1');	
			break;
		case "pregunta": 
			console.log("over: "+id);
			jQuery(".label_"+id).css("background-color", 'rgba(255, 255, 255, 0.1)');
			
			var res = id.split("-");	
			if ( arrResposta.indexOf(res[0]) === -1) {
				
			}else{		
				var id2=arrResult[arrResposta.indexOf(res[0])];
				
				jQuery(".label_"+id2).css("background-color", 'rgba(255, 255, 255, 0.6)');
			}
			break;
	}
}




function textLliure(id){
 	jQuery("#"+id+"_modal").css("display","none");
	jQuery(".label_"+id).css("background-color", 'rgba(255, 255, 255, 0.6)');
 	//alert("Resultat:"+jQuery("#"+id+"-text").val()+"----anterior:"+jQuery("#"+id).val()+"----anterior 2:"+jQuery(".label_"+id).html());
	if(jQuery("#"+id+"-text").val()==""){
		jQuery("#"+id).val(jQuery(".label_"+id+ "font").html());
		//jQuery(".label_"+id).html(jQuery("#"+id+"-text").val());
	}else{
		jQuery("#"+id).val(jQuery("#"+id+"-text").val());
		jQuery(".label_"+id).html(jQuery("#"+id+"-text").val());
	}
	saltaParada=true;	
	$("#".id).attr('checked','checked');
	//$("#res_7-4")
	$("label[for='"+id+"']").click();
	var res = id.split("-");
	var valor=jQuery("#"+id).attr("value");
	console.log("click: "+id+"--slpit"+res);
	var tipo =jQuery("#"+id).attr("data-tipo");
	arrResposta.push(res[0]);
	arrResult.push(tipo+"@@"+"*!"+valor);	
 	jQuery("#"+id+"_modal").css("display","none");

	//-text
}
function inputClick(id){
	var res = id.split("-");
	var valor=jQuery("#"+id).attr("value");
	console.log("click: "+id+"--slpit"+res);
	var tipo =jQuery("#"+id).attr("data-tipo");
	switch(tipo){
		case "sino":
			//FALTE BUSCAR SI AQUESTA RESPOSTA JA EXISTEIX I CANVIAR-LAS
			if ( arrResposta.indexOf(res[0]) === -1) {
				arrResposta.push(res[0]);
				arrResult.push(tipo+"@@"+valor);
				arrResult2.push(id);
			}else{
				//deselecciona els anteriors
				var id2=arrResult[arrResposta.indexOf(res[0])];
				if ($('div.mydivclass').length) {
					jQuery(".label_"+id2).css("opacity", '0.5');
				}else{
					
				}
				arrResult[arrResposta.indexOf(res[0])]=tipo+"@@"+valor;	
				arrResult2[arrResposta.indexOf(res[0])]=id;				
				
			}			
			jQuery(".label_"+id).css("opacity", '1');	
			break;
		case "estrella":
			//FALTE BUSCAR SI AQUESTA RESPOSTA JA EXISTEIX I CANVIAR-LAS
			if ( arrResposta.indexOf(res[0]) === -1) {
				arrResposta.push(res[0]);
				arrResult.push(tipo+"@@"+valor);
				arrResult2.push(id);
			}else{
				
				//deselecciona els anteriors
				/*
				var id2=arrResult[arrResposta.indexOf(res[0])];
				jQuery(".label_"+id2).css("opacity", '0.5');						
				*/	
				//LABEL_RES_3-3
				//var id2=arrResult2[arrResposta.indexOf(res[0])];
				//jQuery(".label_"+id2).css("opacity", '0.5');						
				
				arrResult[arrResposta.indexOf(res[0])]=tipo+"@@"+valor;
				arrResult2[arrResposta.indexOf(res[0])]=id;
						
				//jQuery(".label_"+id2).css("opacity", '0.5');
				var id2=arrResult2[arrResposta.indexOf(res[0])];
				var res = id2.split("-");
				estrellitasMenos(res[0],res[1],"0.5");
				jQuery(".label_"+id).css("opacity", '1');
				var res2 = id.split("-");
				estrellitasMenos(res2[0],res2[1],1);
			}
			break;
		case "pregunta":
			//FALTE BUSCAR SI AQUESTA RESPOSTA JA EXISTEIX I CANVIAR-LAS
			if(res[1]=="libre"){
				 jQuery("#"+id+"_modal").css("display","block");
				 if(saltaParada==false){
					 removeEventListeners(document, getEventListeners(document));
				 }else{					 
					 saltaParada=false;
				 }
			}else{
				if ( arrResposta.indexOf(res[0]) === -1) {
					arrResposta.push(res[1]);
					arrResult.push(tipo+"@@"+valor);
					arrResult2.push(id);
				}else{
					//deselecciona els anteriors
					var id2=arrResult2[arrResposta.indexOf(res[0])];
					jQuery(".label_"+id2).css("background-color", 'rgba(255, 255, 255, 0.1)');		
					arrResult[arrResposta.indexOf(res[0])]=tipo+"@@"+valor;
					arrResult2[arrResposta.indexOf(res[0])]=id;			
				}			
			}
			jQuery(".label_"+id).css("background-color", 'rgba(255, 255, 255, 0.6)');
			break;
	}
	
	
	
	console.log("array_respostes: "+arrResposta + " -- resultats: "+ arrResult);
	console.log("data-tipo: "+jQuery("#"+id).attr("data-tipo"));
	//if($(this).attr("data-tipo") )
	
	
	
}
Object.prototype.push = function( key, value ){
   this[ key ] = value;
   return this;
}	

$(document).ajaxError(
    function (event, jqXHR, ajaxSettings, thrownError) {
        alert('[event:' + event + '], [jqXHR:' + jqXHR + '], [ajaxSettings:' + ajaxSettings + '], [thrownError:' + thrownError + '])');
    });


var bloc=false;
/*GRAVO DADES A LA BBDD DE BCLOSE*/
$( "#click_submit" ).click(function( event ) {
	if(bloc==false){
		if( $('#legal').prop('checked') ) {
			$( "#click_submit" ).css("background", "rgba(76, 175, 80, 0.44)"); 
			bloc=true;
		    console.log('Handler for .submit() called.');	
			arrResposta.reverse();
			arrResult.reverse();
			console.log(arrResposta);
			console.log(arrResult);
			console.log("encuestaID="+idEncuesta+" idUsuario="+idUsuario);
		   ajaxTest();
		}else{
			jQuery("#legal2").css("border","3px orangered dashed");
		}
	}
  	/**/
});

function ajaxTest() {
  var xhttp = new XMLHttpRequest();
  var params="?bCloseExt="+bCloseExt+dominis+"&id="+idBD+"&encuestaID="+ idEncuesta+"&posicion="+ posicion+"&nomUsu="+ nomUsu+"&empresa="+ empresa+"&nomContacto="+ nomContacto+ "&idioma="+idiomaCuetionario+"&idUsuario="+ idUsuario+"&mailUsu="+mailUsu+"&mailRRHH="+mailRRHH+"&nomRRHH="+nomRRHH+"&mailAdmin="+mailAdmin +"&respuestas="+ JSON.stringify(arrResposta) +"&resultados="+ JSON.stringify(arrResult) ;
  console.log(params);
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        location.href="https://www.bclose.net";
    }
  };
  xhttp.open("POST", urlTheme+"/feedbacksFull/gravar.php"+params, true);
  xhttp.send();
 
}

/***********************************************************************/


/*CANCELA TOTS ELS EVENTS PROPERS*/
function removeEventListeners(element, listenerMap) {
    Object.keys(listenerMap).forEach(function (name) {
        var listeners = listenerMap[name];
        listeners.forEach(function (object) {
            element.removeEventListener(name, object.listener);
        });
    });
}

jQuery( ".fs-anterior" ).click(function() {
  //alert( "Handler" );
  arrResposta.pop();
  arrResult.pop();
});

</script>
<!--
    <script src="<?=$urlTheme?>/feedbacks/js/index.js"></script>


<footer>
<img src="http://www.bclose.net/wp-content/uploads/2018/10/bclose-Logo_White.png" width="150"><br>
<sub style="color: white;  font-size: 14px;">bClose &copy;<?=date("Y")?> </sub>

</footer>
-->
</body>
</html>
