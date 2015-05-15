<?php
echo "as";
require_once '../src/DbConnect.php';
namespace User;

final class AUsuarioController
{
    private $userService;

 

    public function getAll()
    { 
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

    public function get()
    {
      
    }

    public function update()
    {
       
    }
}

?>