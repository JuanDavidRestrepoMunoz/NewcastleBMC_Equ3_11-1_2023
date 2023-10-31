<?php

    session_start();
    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    
    include("./conexion.php");
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Accede a los datos enviados por Three.js
        $objetos = json_decode(file_get_contents("php://input"), true);
        echo "<script>alert('hola');</script>";
        // Define la ruta y el nombre del archivo donde guardar los datos
        $archivo = "archivos/{$_SESSION['obj']}"; // Reemplaza con la ruta y nombre deseado
    
        // Convierte el arreglo de objetos en formato JSON
        $objetos_json = json_encode($objetos);
    
        // Guarda los datos JSON en el archivo
        if (file_put_contents($archivo, $objetos_json)) {
            $respuesta = array(
                "mensaje" => "Datos guardados en el archivo con éxito"
            );
        } else {
            $respuesta = array(
                "mensaje" => "Error al guardar los datos en el archivo"
            );
        }
    
        echo json_encode($respuesta);
    } else{
        echo "<script>alert('adios');</script>";
    }
?>