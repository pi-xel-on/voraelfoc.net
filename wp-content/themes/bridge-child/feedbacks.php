<?php
/*
Template Name: Feedbacks

*/
global $wp_query;
global $qode_options_proya;
$urlTheme=get_template_directory_uri();//("template_directory");



define('_DB_NAME_', 'headwaycrmdes'); //desarrollo
//define('_DB_NAME_', 'headwaycrm');
define('_DB_SERVER_', 'localhost');
//define('_DB_USER_', 'Josep10');
//define('_DB_PASSWD_', 'Josep100');
define('_DB_USER_', 'myheadway');
define('_DB_PASSWD_', 'Qwerty10');


$dsn = 'mysql:dbname='._DB_NAME_.';host='._DB_SERVER_;
$user = _DB_USER_;
$password = _DB_PASSWD_;
										
try {
	$pdopg = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}

//echo "<pre>";print_r($_GET); echo ">/pre>";
$sql="SELECT * FROM  bClose_enquestas_preguntas WHERE id_enquesta=:id_enquesta";
//$sth = $pdopg->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
//print_r($arrayDades);
//die();
$sth = $pdopg->prepare($sql);
$data = array(
  ':id_enquesta' =>$_GET["idEncuesta"]     
);
//echo "<pre>";print_r($data); echo ">/pre>";
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




//echo "<pre>";print_r($_GET); echo ">/pre>";
$sql="SELECT id,nombre,apellidos FROM  personas WHERE id=:id_persona";
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

?>
<!DOCTYPE html>
<html >
<head>

  <meta charset="UTF-8">
  <title>BClose - Feedbacks -</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="<?=$urlTheme?>/feedbacks/css/style.css">

  
  <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
</head>

<body><form>
<div class="modal-wrap">
	<div id="logo" style="text-align:center; margin:15px;"><a href="https://bclose.net"><img src="http://www.bclose.net/wp-content/uploads/2018/10/bclose-Logo_White.png" width="250"></a></div>
  <div class="modal-header"><span class="is-active"></span><span></span></div>
  <div id="error">No has seleccionado una respuesta</div>
  <div class="modal-bodies">
    <div class="modal-body modal-body-step-1 is-showing">
      <div class="title">Step 1</div>
      <div class="description">Bienvenido <?=$arrayUsu["nombre"]?>.</div>
      


        <div class="text-center">
        Responde esta pequeña encuesta <br>
para saber como esta el estado de tu Trabajo<br><br>
          <div class="button">Empezar</div>
        </div>
    
    </div>
    <?php
	$contP=2;
//echo "<pre>";print_r($arrayPreguntas); print_r($arrayUsu); echo ">/pre>";
	foreach($arrayPreguntas as $clave => $valor){
		//print_r($valor);
		//echo utf8_encode($valor->pregunta)."<br>";
		?>
         <div class="modal-body modal-body-step-<?=$contP?>">
          <div class="title">Step <?=$contP?></div>
          <div class="description"><?=utf8_encode($valor->pregunta)?></div>
          
          	<?php if ($valor->respuesta_1!=""){?>
            <label>
              <input type="radio" name="radio<?=$contP?>" value="<?=$valor->pr_valor_1?>"/><?=utf8_encode($valor->respuesta_1)?>
            </label>
            <?php }
				if ($valor->respuesta_2!=""){?>            
            <label>
              <input type="radio" name="radio<?=$contP?>" id="radio2"  value="<?=$valor->pr_valor_2?>"/><?=utf8_encode($valor->respuesta_2)?>
            </label> 
            <?php }
				if ($valor->respuesta_3!=""){?>            
            <label>
              <input type="radio" name="radio<?=$contP?>" id="radio3" value="<?=$valor->pr_valor_3?>"/><?=utf8_encode($valor->respuesta_3)?>
            </label>
            <?php }
				if ($valor->respuesta_4!=""){?> 
            <label>
              <input type="radio" name="radio<?=$contP?>" id="radio4" value="<?=$valor->pr_valor_4?>"/><?=utf8_encode($valor->respuesta_4)?>
            </label>
            <?php }
			?> 
            <div class="text-center fade-in">
              <div class="button">Next</div>
            </div>
         
        </div>
        
        <?php
		$contP++;
	}
	
	?>
    
    <!--<div class="modal-body modal-body-step-2">
      <div class="title">Step 2</div>
      <div class="description">Would you rather</div>
      <form>
        <label>
          <input type="radio" name="radio"/>live one life that lasts 1,000 years?
        </label>
        <label>
          <input type="radio" name="radio" id="radio2"/>live 10 lives that last 100 years each?
        </label>
        <div class="text-center fade-in">
          <div class="button">Next</div>
        </div>
      </form>
    </div>
    -->
    <div class="modal-body modal-body-step-<?=$contP?>">
      <div class="title">Step <?=$contP?></div>
      <div class="description">Enquesta finalizada solo falta enviar los resultados. ;) </div>
      <div class="text-center">
        <div class="button">Enviar!</div>
      </div>
    </div>
  </div>
</div>
<div class="text-center">
  <div class="rerun-button"><a href="http://bclose.net">Ir a BClose.net</a></div>
</div>
 </form>
<script>
var id=<?=$_GET["id"] ?>;
var idEncuesta=<?=$_GET["idEncuesta"] ?>;
var idUsuario=<?=$_GET["idUsu"] ?>;
var intervalError=0;
var arrResult = [];
var arrResposta = [];
var stepNumber=0;
var numSteps=<?=$contP?>;
var urlTheme="<?=$urlTheme?>";
var contTmp=numSteps-2;
while (contTmp!=0){
	jQuery(".modal-header").append("<span></span>");
	contTmp--;
}
		
</script>

    <script src="<?=$urlTheme?>/feedbacks/js/index.js"></script>


<footer>
<img src="http://www.bclose.net/wp-content/uploads/2018/10/bclose-Logo_White.png" width="150"><br>
<sub style="color: white;  font-size: 14px;">bClose &copy;<?=date("Y")?> </sub>

</footer>
</body>
</html>
