<?php
//die("hola");



//define('_DB_NAME_', 'headwaycrmdes'); //desarrollo
if(isset($_GET["bCloseExt"])){
	//die("bCloseExt");

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
		$urlAdmin="https://futuretrack.es/";
		$url_bclose="futuretrack.es";
	}else{
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

//print_r($_GET);

//echo "<pre>";print_r($_GET); echo ">/pre>";
//$sql="INSERT INTO bClose_enquestas_respuestas (id_enquesta_persona,id_enquesta,respuestas,valores,is_done) VALUES (".$_GET["idUsuario"].",".$_GET["encuestaID"].",'".$_GET["respuestas"]."','".$_GET["resultados"]."',1)";
$created_date = date("Y-m-d H:i:s");
$sql="UPDATE bClose_confirmacio_mail SET 
validat=1
WHERE id=".$_GET["id"];

//echo $sql;
//$sth = $pdopg->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
//print_r($arrayDades);
//die();
$sth = $pdopg->prepare($sql);
//echo "<pre>";print_r($data); echo ">/pre>";
$sth->execute();



?>
<script>
	location.href="https://www.bclose.net/gracias-por-confirmar-el-correo-electronico-thank-you-for-confirming-the-email/";
</script>