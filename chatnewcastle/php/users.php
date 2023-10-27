<?php
session_start();
include_once "confi.php";
$outgoing_id = $_SESSION['id_us'];
$sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE NOT id_us = {$outgoing_id}");
$output = "";

if (mysqli_num_rows($sql) == 0) {
    $output .= "Usuarios no encontrados";
} elseif (mysqli_num_rows($sql) > 0) {
    include "data.php";
}

echo $output;
?>




