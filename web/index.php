<?php


require '../vendor/slim/slim/slim/Slim.php';
require_once '../src/DbConnect.php';

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim(array(
    'debug' => true,
     'mode' => 'development'));

$app->get('/hello/:name', function ($name) {
    echo "Hello, " . $name;
});

$app->get('/usuarios', 'getUsuarios');
$app->get('/reto/:grupo/:curso', 'getRetoActivo');
$app->get('/respuestas/:idreto', 'getRespuestas');


function getUsuarios() {
	$sql = "select * FROM retos.RETO";

  try {
    $dbc = new DbConnect();
    $db = $dbc->getConnection();
    $stmt = $db->query($sql);
    $users = $stmt->fetchAll(PDO::FETCH_OBJ);
    $db = null;
    echo json_encode($users);
  }
  catch(PDOException $e) {
    echo json_encode($e->getMessage());
  }

}

function getRetoActivo($grupo, $curso) {
	$sql = "select idreto,nombre, pregunta,tipo_contenido_pregunta
			from retos.reto
			where grupo = ? and idcurso = ?
			group by idreto
			order by fecha_creacion DESC limit 1;";

	  try {
	    $dbc = new DbConnect();
	    $db = $dbc->getConnection();
	    $db->query("set names'utf8'");
	    $stmt = $db->prepare($sql);
	    $stmt->bindParam(1, $grupo);
	    $stmt->bindParam(2, $curso);
	    $stmt->execute();
	    $rows = $stmt->fetchAll();
	    $db = null;
	    echo json_encode($rows);
	  }
	  catch(PDOException $e) {
	    echo json_encode($e->getMessage());
	  }
}



function getRespuestas($idreto) {
	$sql = "select idrespuesta,nombre, tipo, es_correcta
			from retos.respuesta
			where idreto = ? ;";

	  try {
	    $dbc = new DbConnect();
	    $db = $dbc->getConnection();
	    $db->query("set names'utf8'");
	    $stmt = $db->prepare($sql);
	    $stmt->bindParam(1, $idreto);
	    $stmt->execute();
	    $rows = $stmt->fetchAll();
	    $db = null;
	    echo json_encode($rows);
	  }
	  catch(PDOException $e) {
	    echo json_encode($e->getMessage());
	  }
}

$app->run();
