<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include("./conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Accede a los datos enviados por Three.js
    $objetos = json_decode(file_get_contents("php://input"), true);

    echo "<script>alert('hola');</script>";

    // Verifica si ya existe una fila con el mismo id_proyecto
    $id_proyecto = $_SESSION['id_proyecto'];
    $sql_select = "SELECT id_proyecto FROM proyectos WHERE id_proyecto = ?";

    if ($stmt_select = $conexion->prepare($sql_select)) {
        $stmt_select->bind_param("i", $id_proyecto);
        $stmt_select->execute();
        $stmt_select->store_result();

        if ($stmt_select->num_rows > 0) {
            // Ya existe una fila con el mismo id_proyecto, realiza una actualización
            $sql_update = "UPDATE proyectos SET datos = ? WHERE id_proyecto = ?";
            if ($stmt_update = $conexion->prepare($sql_update)) {
                $stmt_update->bind_param("si", $objetos, $id_proyecto);
                $stmt_update->execute();
                $respuesta = array(
                    "mensaje" => "Datos actualizados con éxito"
                );
                $stmt_update->close();
            }
        }
        // Cierra la consulta SELECT
        $stmt_select->close();
    }
} else{
    echo "<script>alert('adios');</script>";
}
?>
