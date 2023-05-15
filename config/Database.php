<?php

class Database{

    private $host = '127.0.0.1';
    private $db_name = 'practica';
    private $charset = 'utf8mb4';
    private $response = array();

    public function conectarDB(){
        $host = 'ucompensar-serversql.mysql.database.azure.com';
        $db_name = 'compensar';
        $user = 'laboratorio';
        $password = 'CompensarTeleco2023.';
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=$this->charset", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            $response['error'] = true;
            $response['message'] = "Problemas al crear la conexión con la base de datos.";
            $response['details'] = $e->getMessage();
            return $response;
        }
    }

    public function crearDB($user, $password){
        try {
            $pdo = new PDO("mysql:host=$this->host", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("CREATE DATABASE `$this->db_name` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
            $response['error'] = false;
            $response['message'] = "Base de datos `$this->db_name` creada correctamente.";
            $response['details'] = "";
            return $response;
        } catch (PDOException $e) {
            $response['error'] = true;
            $response['message'] = "Problemas al crear la conexión con la base de datos.";
            $response['details'] = $e->getMessage();
            return $response;
        }
    }

}