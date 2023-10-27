<?php
    session_start();
    include_once "confi.php";
    $outgoing_id = $_SESSION['id_us'];
    $searchTerm = mysqli_real_escape_string($conexion, $_POST['searchTerm']);
    $output = "";
    $sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE NOT id_us = {$outgoing_id} AND (nom1 LIKE '%{$searchTerm}%' OR ape1 LIKE '%{$searchTerm}%') ");
    if(mysqli_num_rows($sql) > 0){
        include "data.php";
    }else{
        $output .= "usuario no encontrado";
    }
echo $output;
?>