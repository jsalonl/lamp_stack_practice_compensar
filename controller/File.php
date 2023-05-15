<?php

class File{

    private $response = array();

    public function createFile($data){
        
        $json = json_encode($data);

        $file = 'datos.json';

        if (file_exists($file)) {
            $response['error'] = true;
            $response['message'] = "El archivo ya existe";
            $response['details'] = "Significa que ya realizo la configuración necesaria y los datos han sido enviados";
        } else {
            if (file_put_contents($file, $json)) {
                $response['error'] = false;
                $response['message'] = "El archivo fue creado";
                $response['details'] = "";
            } else {
                $response['error'] = true;
                $response['message'] = "El archivo no fue creado";
                $response['details'] = "";
            }
        }
        return $response;
    }

    public function verifyFileExists($name){
        $file = $name;
        if (file_exists($file)) {
            $response['error'] = true;
            $response['message'] = "El archivo ya existe";
            $response['details'] = "Significa que ya realizo la configuración necesaria y los datos han sido enviados";
        } else {
            $response['error'] = false;
            $response['message'] = "El archivo no existe";
            $response['details'] = "";
        }
        return $response;
    }

}