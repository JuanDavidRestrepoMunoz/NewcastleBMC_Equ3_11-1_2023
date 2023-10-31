<?php
include "../../conexion.php";
if (isset($_POST['btn_mat'])){
    $tmate = $_POST['tmate'];
    $nomat = $_POST['nomat'];
    $mate = $_POST['mate'];
    $text = $_POST['text'];
    $med1 = $_POST['largo'];
    $med2 = $_POST['ancho'];
    $premat = $_POST['premat'];

    $registrar = mysqli_query($conexion, "INSERT INTO `materiales` (`id_material`, `nombre`, `id_tipo`, `textura`, `color`, `largo`, `ancho`, `costo`) VALUES ('', '$nomat', '$tmate', '$text', '$mate', '$med1', '$med2', '$premat')");

    if (!$registrar) {
        die('Error en la consulta: ' . mysqli_error($conexion));
    }

    echo "<script>alert('Registro exitoso');</script>";
    echo "<script>window.location='template.php?mod=materiales';</script>";
}
?>

<center>
<h1>Creación materiales</h1>
<div class="row login">
            <div class="col-md-12">
                <form action="../documentation/template.php?mod=materiales" method="post" onsubmit="return validarPrecio();">
                    <div class="mb-3">
                        <label for="exampleFormControlSelect1">Tipo de Material*</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="tmate" placeholder="seleccione su tipo de material">
                            <option>Selecciona</option>
                            <option value="6">Cartón</option>
                            <option value="5">Madera</option>
                            <option value="8">Papel</option>
                            <option value="7">Cinta</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nombre del material*</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nomat" placeholder="Escriba el nombre de su material" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Color de material*</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mate" placeholder="Escriba el color de su material" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Textura*</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="text" placeholder="Registre su Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Precio del material*</label>
                        <input type="text" class="form-control" name="premat" placeholder="Escriba el Precio de su material" required>
                        <span id="premat-alert" style="color: red; display: none;">El precio debe ser un número entero.</span>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Medida del material (cm)*</label>
                        <input type="text" class="form-control" name="largo" placeholder="Escriba el largo de su material" required>
                        <span id="largo-alert" style="color: red; display: none;">El largo debe ser un número válido.</span>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInput" class="form-label">Medida del material (cm)*</label>
                        <input type="text" class="form-control" name="ancho" placeholder="Escriba el ancho de su material" required>
                        <span id="ancho-alert" style="color: red; display: none;">El ancho debe ser un número válido.</span>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" name="btn_mat">Ingresar</button>
                    <br><br>
                </form>
                <a href="template.php?mod=gestion" class="btn btn-primary" name="btn_mab">Buscar</a> <a href="template.php?mod=costear" class="btn btn-primary" name="btn_mab">Costear</a>
            </div>
        </div>
        <script>
            function validarPrecio() {
                const prematInput = document.querySelector('input[name="premat"]');
                const premat = prematInput.value;
                const prematValido = /^\d+$/.test(premat); // Verifica si es un número entero

                const prematAlert = document.getElementById("premat-alert");

                if (!prematValido) {
                    prematAlert.style.display = "block"; // Muestra la alerta si no es válido
                    return false; // Retorna false para evitar el registro
                }

                // Validación de la medida de largo
                const largoInput = document.querySelector('input[name="largo"]');
                const largo = largoInput.value;
                const largoValido = /^\d+(\.\d+)?$/.test(largo); // Verifica si es un número o decimal

                const largoAlert = document.getElementById("largo-alert");

                if (!largoValido) {
                    largoAlert.style.display = "block"; // Muestra la alerta si no es válido
                    return false; // Retorna false para evitar el registro
                }

                // Validación de la medida de ancho
                const anchoInput = document.querySelector('input[name="ancho"]');
                const ancho = anchoInput.value;
                const anchoValido = /^\d+(\.\d+)?$/.test(ancho); // Verifica si es un número o decimal

                const anchoAlert = document.getElementById("ancho-alert");

                if (!anchoValido) {
                    anchoAlert.style.display = "block"; // Muestra la alerta si no es válido
                    return false; // Retorna false para evitar el registro
                }

                // Si todas las validaciones pasan, puedes permitir el registro
                prematAlert.style.display = "none";
                largoAlert.style.display = "none";
                anchoAlert.style.display = "none";
                return true;
            }

            document.querySelector("form").onsubmit = validarPrecio;
        </script>

</center>