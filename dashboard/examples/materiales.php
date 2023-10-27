<?php
include "conexion.php";
if (isset($_POST['btn_mat'])){
    $tmate = $_POST ['tmate'];
    $nomat = $_POST ['nomat'];
    $mate = $_POST ['mate'];
    $text = $_POST ['text'];
    $premat = $_POST ['premat'];
    $registrar = mysqli_query($conexion,"INSERT INTO `materiales` (`id_material`, `id_tipo`, `textura`, `color`, `Costo`) VALUES ('$tmate', '$nomat', '$text', '$mate', '$premat');") or die ($conexion);
    echo "<script>alert('Registro exitoso');</script>";
    echo "<script>window.location='template.php?mod=materiales';</script>";
}
?>

<center>
<div class="row login">
            <div class="col-md-12">
                <form action="./template.php?mod=materiales" method="post">
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1">Tipo de Material</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="tmate" placeholder="seleccione su tipo de material">
                            <option>Selecciona</option>
                            <option value="Ma">Madera</option>
                            <option valua="Pl">Plástico</option>
                            <option value="Fo">Fomi</option>
                            <option value="Pi">Piedra</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre del material</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nomat" placeholder="Escriba el nombre de su material">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Color de material</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mate" placeholder="Escriba el color de su material">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">textura</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tex" placeholder="Registre su Nombre">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Precio del material</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="Premat" placeholder="Escriba el Precio de su material">
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn_mat">Ingresar</button>
                    <br><br>
                </form>
            </div>
        </div>
</center>