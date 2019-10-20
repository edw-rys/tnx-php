<?php
// System functions
function to_object($array){
    return json_decode(json_encode($array));
}

function saveImage($_name){
    if(!isset($_FILES[$_name])){
        return [
            "status"    =>"error",
            "code"      =>400,
            "message"   =>"Archivo no válido"
        ];
    }
    if($_FILES[$_name]['size']>2*1000*1000){
        return  [
            "status"    =>"error",
            "code"      =>400,
            "message"   =>"Tamaño de archivo permitido: max 2mb"
        ];
    }
    if(!validateExt($_FILES[$_name]['name'])){
        return  [
            "status"    =>"error",
            "code"      =>400,
            "message"   =>"Formato de archivo no es válido"
        ];
    }
    if(!file_exists(ROUTEFILES)){
        return  [
            "status"    =>"error",
            "code"      =>400,
            "message"   =>"Directorio de archivos no existe!"
        ];
    }
    opendir(ROUTEFILES);
    $parts = explode(".",$_FILES[$_name]['name']);
    // con el final del explode que sería la extensión de la imagen
    $origen=  $_FILES[$_name]['tmp_name'];
    $destino= ROUTEFILES. generateRandomString(7). '.'.end($parts);//ends obtiene el último valor del arreglo
    move_uploaded_file($origen, $destino);
    // $_FILES[$_name]['type']; tipo de archivo
    return [
        "status"    =>"success",
        "code"      =>200,
        "url"       =>$destino
    ];
}
//generar nombre random
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
} 
// validar extención del archivo
function validateExt( $nombre){
    $patron = "%\.(gif|jpe?g|png|svg)$%i"; 
    return preg_match($patron, $nombre) ;
}

function printObj($object=null){
    echo "<pre>";
    var_dump($object);
    echo "</pre>";
}