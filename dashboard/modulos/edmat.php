<?php
include "../../conexion.php";

if (isset($_GET['id_material'])) {
    $id_actualizar = $_GET['id_material'];

    // Consulta para obtener los datos del material
    $query = "SELECT * FROM materiales WHERE id_material = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_actualizar);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_material, $id_us, $nombre, $id_tipo, $textura, $color, $largo, $ancho, $costo);

    if (mysqli_stmt_fetch($stmt)) {
        // Los datos del material han sido obtenidos de la base de datos
    } else {
        // Maneja el caso en el que el material no existe.
    }

    // Cierra la consulta
    mysqli_stmt_close($stmt);
}


include "../../conexion.php";
ob_start(); // Inicia el almacenamiento en búfer

if (isset($_POST['btn_mac'])) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Ruta donde se guardará la imagen temporalmente
        $temp_path = $_FILES['imagen']['tmp_name'];
    
        // Lee el contenido de la imagen
        $imagen_contenido = file_get_contents($temp_path);
    
        if ($imagen_contenido !== false) {
            // Convierte el contenido de la imagen a base64
            $imagen_base64 = base64_encode($imagen_contenido);
            
            // Recoge los datos del formulario
            $id_tipo = @$_POST['id_tipo'];
            $nombre = @$_POST['nombre'];
            $color = @$_POST['color'];
            $textura = $imagen_base64;
            $largo = @$_POST['largos'];
            $ancho = @$_POST['anchos'];
            $costo = @$_POST['premate'];

            // Realiza la actualización en la base de datos usando una consulta preparada
            $query = "UPDATE materiales SET nombre = ?, id_tipo = ?, textura = ?, color = ?, largo = ?, ancho = ?, costo = ? WHERE id_material = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "sssssssi", $nombre, $id_tipo, $textura, $color, $largo, $ancho, $costo, $id_actualizar);


        }
    }


    if (mysqli_stmt_execute($stmt)) {
        echo "El material ha sido actualizado con éxito";
        echo '<script>window.location.href="./template.php?mod=gestion";</script>';
        exit();
    } else {
        echo "Error al actualizar el material: " . mysqli_error($conexion);
    }
}

ob_end_flush(); // Envía la salida almacenada en búfer al navegador




?>

<!DOCTYPE html>
<html>
<head>
    <!-- ... (Código HTML, encabezado, estilos, etc.) ... -->
</head>
<body>
<center>
    <div class="container">
        <h1>Editar Material</h1>
        <form action="./template.php?mod=editar&id_material=<?php echo $id_actualizar; ?>" method="post">
        <input type="hidden" name="id_material" value="<?php echo $id_actualizar; ?>">
        <div class="mb-3">
            <label for="exampleFormControlSelect1">Tipo de Material</label>
            <select class="form-control" id="exampleFormControlSelect1" name="id_tipo">
                <option value="6" <?php if ($id_tipo == "6") echo "selected"; ?>>Carton</option>
                <option value="5" <?php if ($id_tipo == "5") echo "selected"; ?>>Madera</option>
                <option value="8" <?php if ($id_tipo == "8") echo "selected"; ?>>Papel</option>
                <option value="7" <?php if ($id_tipo == "7") echo "selected"; ?>>Cinta</option>
            </select>
        </div>
            <div class="mb-3">
                <label for="nuevo_nombre">Nombre del Material:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
            </div>
            <div class="mb-3">
                <label for="nueva_textura">Textura:</label>
                <input type="file" class="form-control" id="textura" name="imagen" value="<?php echo $textura; ?>">
            </div>
            <div class="form-group">
                <label for="nuevo_color">Color:</label>
                <input type="text" class="form-control" id="color" name="color" value="<?php echo $color; ?>">
            </div>
            <div class="form-group">
                <label for="nuevo_largo">Largo:</label>
                <input type="text" class="form-control" id="largo" name="largos" value="<?php echo $largo; ?>">
            </div>
            <div class="form-group">
                <label for="nuevo_ancho">Ancho:</label>
                <input type="text" class="form-control" id="nuevo_ancho" name="anchos" value="<?php echo $ancho; ?>">
            </div>
            <div class="form-group">
                <label for="nuevo_costo">Costo:</label>
                <input type="text" class="form-control" id="nuevo_costo" name="premate" value="<?php echo $costo; ?>">
                <span id="costo-alert" style="color: red; display: none;">El costo debe ser un número entero.</span>
            </div>
            <button type="submit" class="btn btn-primary" name="btn_mac">Actualizar Material</button>
        </form>
    </div>

    <script>
        function validarCosto() {
            const costoInput = document.getElementById("nuevo_costo");
            const costo = costoInput.value;
            const costoValido = /^\d+$/.test(costo); // Verifica si es un número entero

            const costoAlert = document.getElementById("costo-alert");

            if (costoValido) {
                costoAlert.style.display = "none"; // Oculta la alerta si es válido
                return true; // Retorna true para permitir la actualización
            } else {
                costoAlert.style.display = "block"; // Muestra la alerta si no es válido
                return false; // Retorna false para evitar la actualización
            }
        }

        document.querySelector("form").onsubmit = validarCosto;
    </script>


</center>   
</body>
</html>


