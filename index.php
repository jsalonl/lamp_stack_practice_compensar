<?php
require_once 'controller/Network.php';
require_once 'controller/File.php';
require_once 'config/Database.php';
$database = new Database();
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

  $data = array(
    "user" => $_POST['user'],
    "password" => $_POST['password'],
    "student" => $_POST['student'],
    "ip" => $ip,
  ); 

  $result = $database->crearDB($_POST['user'], $_POST['password']);
  if($result['error']){
    require_once 'view/home.view.php';
    exit;
  }
  
  $db = $database->conectarDB();
  $result = $db->prepare("INSERT INTO servidores (id, student, user_sql, password_sql, ip_host) 
  VALUES (NULL, :student, :user_sql, :password_sql, :ip_host);");
  $result->bindParam(':student', $_POST['student']);
  $result->bindParam(':user_sql', $_POST['user']);
  $result->bindParam(':password_sql', $_POST['password']);
  $result->bindParam(':ip_host', $ip);
  $result->execute();

  $result = $file->createFile($data);
  require_once 'view/complete.view.php';
}

?>