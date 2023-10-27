<?php
include "conexion.php";
if (isset($_POST['btn_ing'])){
    $correo = $_POST ['correo'];
    $con = $_POST ['contra'];
    $n1 = $_POST ['nom1'];
    $n2 = $_POST ['nom2'];
    $a1 = $_POST ['ape1'];
    $a2 = $_POST ['ape2'];
    $a = $_POST ['apo'];
    $encript = md5($con);
    $consulta = mysqli_query($conexion, "SELECT apod FROM usuario WHERE apod = '$a'");
    $consultaemail = mysqli_query($conexion, "SELECT correo FROM usuario WHERE correo = '$correo'");

    $resultado = mysqli_num_rows($consulta);
    $resultadoemail = mysqli_num_rows($consultaemail);

    if($resultado>0) {
        echo "<script>alert('Ese usuario ya existe')</script>";
        echo "<script>window.history.back();</script>";
    }
    elseif($resultadoemail>0) {
        echo "<script>alert('Ese correo ya está en uso')</script>";
        echo "<script>window.history.back();</script>";
    }
    else{
        $registrar = mysqli_query($conexion,"INSERT INTO `usuario` (`apod` ,`nom1`, `nom2`, `ape1`, `ape2`, `correo`, `cont`, `descr`, `img`, `status`) VALUES ('$a' ,'$n1', '$n2', '$a1', '$a2', '$correo', '$encript', '', 'face-0.jpg', 'Conectado Ahora');") or die ($conexion);
        echo "<script>alert('Registro exitoso');</script>";
        echo "<script>window.location='index.php';</script>";  
    }
    
}
?>