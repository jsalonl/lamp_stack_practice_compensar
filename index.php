<?php
require_once 'controller/Network.php';
require_once 'controller/File.php';
$newtwork = new Network();
$file = new File();

$result = null;

$ip = $newtwork->getIp();

if($file->verifyFileExists('datos.json')['error']){
    $result = $file->verifyFileExists('datos.json');
    require_once 'view/complete.view.php';
    exit;
}

if(!$_POST){
    require_once 'view/home.view.php';
    exit;
}else{
  
  require_once 'config/Database.php';
  $database = new Database();
  $result = $database->crearDB($_POST['user'], $_POST['password']);
  if($result['error']){
    require_once 'view/home.view.php';
    exit;
  }
  $data = array(
      "user" => $_POST['user'],
      "password" => $_POST['password'],
      "student" => $_POST['student'],
      "ip" => $ip,
  );  
  $result = $file->createFile($data);
  require_once 'view/complete.view.php';
}

?>