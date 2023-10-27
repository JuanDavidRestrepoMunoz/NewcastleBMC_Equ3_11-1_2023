<?php
include "../../conexion.php";
if (isset($_POST['btn_mat'])){
    $tmate = $_POST ['tmate'];
    $nomat = $_POST ['nomat'];
    $mate = $_POST ['mate'];
    $text = $_POST ['text'];
    $med1 = $_POST ['largo'];
    $med2 = $_POST ['ancho'];
    $premat = $_POST ['premat'];
    $registrar = mysqli_query($conexion,"INSERT INTO `materiales` (`id_material`, `nombre`, `id_tipo`, `textura`, `color`, `largo`, `ancho`, `costo`) VALUES ('', '$nomat', '$tmate', '$text', '$mate',  '$med1',  '$med2', '$premat');") or die ($conexion);
    echo "<script>alert('Registro exitoso');</script>";
    echo "<script>window.location='template.php?mod=materiales';</script>";
}
?>