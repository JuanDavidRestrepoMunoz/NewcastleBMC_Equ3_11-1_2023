<?php
include "../../conexion.php";

// Preparar la consulta
$stmt = $conexion->prepare("SELECT id_material, nombre, id_tipo, textura, color, largo, ancho, costo FROM materiales WHERE id_material = ?");
$stmt->bind_param("s", $tu_valor_de_condicion);

    // Consulta para obtener los datos del material
    $query = "SELECT * FROM materiales WHERE id_material = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_actualizar);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id_us, $id_material, $nombre, $id_tipo, $textura, $color, $largo, $ancho, $costo);

// Debes proporcionar 8 variables para enlazar los resultados
$stmt->bind_result($id_material, $nombre, $id_tipo, $textura, $color, $largo, $ancho, $costo);


if ($stmt->execute()) {
    while ($stmt->fetch()) {
        // Accede a los valores de las columnas utilizando las variables de enlace
        // Por ejemplo:
        echo "ID Material: $id_material, Nombre: $nombre, Tipo: $id_tipo, Textura: $textura, Color: $color, Largo: $largo, Ancho: $ancho, Costo: $costo";
    }
} else {
    // Manejar cualquier error en la ejecución de la consulta
    echo "Error en la consulta: " . $stmt->error;
}

$stmt->close(); // Cierra la consulta preparada al final del proceso


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
    } else {
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
        <form action="./template.php?mod=editar&id_material=<?php echo $id_actualizar; ?>" method="post" enctype="multipart/form-data">
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
                <label for="nombre">Nombre del Material:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
            </div>
            <div class="mb-3">
                <label for="nueva_textura">Textura:</label>
                <label for="textura">Textura:</label>
                <input type="file" class="form-control" id="textura" name="imagen">
            </div>
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" class="form-control" id="color" name="color" value="<?php echo $color; ?>">
            </div>
            <div class="form-group">
                <label for="largo">Largo:</label>
                <input type="text" class="form-control" id="largo" name="largos" value="<?php echo $largo; ?>">
                <span id="largo-alert" style="color: red; display: none;">El largo debe ser un número válido.</span>
            </div>
            <div class="form-group">
                <label for="nuevo_ancho">Ancho:</label>
                <input type="text" class="form-control" id="nuevo_ancho" name="anchos" value="<?php echo $ancho; ?>">
                <span id="ancho-alert" style="color: red; display: none;">El ancho debe ser un número válido.</span>
            </div>
            <div class="form-group">
                <label for="costo">Costo:</label>
                <input type="text" class="form-control" id="costo" name="premate" value="<?php echo $costo; ?>">
                <span id="costo-alert" style="color: red; display: none;">El costo debe ser un número entero.</span>
            </div>
            <button type="submit" class="btn btn-primary" name="btn_mac">Actualizar Material</button>
        </form>
    </div>
</center>   
</body>
</html>
