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


function getUsuarios() {
	$sql = "select * FROM retos.USUARIO";

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

$app->run();
