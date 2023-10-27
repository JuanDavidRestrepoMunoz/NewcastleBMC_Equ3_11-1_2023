<?php
include 'conexion.php';
//Sesión iniciada.
session_start();
if(isset($_SESSION['id_us'])){
    $logout_id = mysqli_real_escape_string($conexion, $_SESSION['id_us']);
    if(isset($logout_id)){
        $status = "Desconectado ahora";
        $sql = mysqli_query($conexion, "UPDATE usuario SET status = '{$status}' WHERE id_us = {$logout_id }");
        if($sql){

            session_unset();
            session_destroy();
            header("location: ../login.php");
        }
    }else{
            header("location: ../login.php");
    }

}else{
    header("location: ../login.php");
}
//Sesión eliminada.
session_destroy();
//Redirigimos fuera del dashboard.
header("location: index.php");
?>