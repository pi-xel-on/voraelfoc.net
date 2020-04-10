<?php

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

print_r($_POST);

//echo "<pre>";print_r($_GET); echo ">/pre>";
$sql="INSERT INTO bClose_enquestas_respuestas (id_enquesta_persona,id_enquesta,respuestas,valores,is_done) VALUES (".$_POST["idUsuario"].",".$_POST["encuestaID"].",'".$_POST["respuestas"]."','".$_POST["resultados"]."',1)";

$sql="UPDATE bClose_enquestas_respuestas SET 
respuestas='".$_POST["respuestas"]."',
valores='".$_POST["resultados"]."',
is_done=1
WHERE id=".$_POST["id"];

echo $sql;
//$sth = $pdopg->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
//print_r($arrayDades);
//die();
$sth = $pdopg->prepare($sql);
//echo "<pre>";print_r($data); echo ">/pre>";
$sth->execute();

?>