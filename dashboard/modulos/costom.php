<?php
include "../../conexion.php";

$mensaje = '';
$costeo_total = 0;

if (isset($_POST['calcularPresupuesto'])) {
    $proyecto_id = $_POST['proyecto']; // Obtén el ID del proyecto seleccionado
    $materiales = $_POST['material'];
    $factores = $_POST['factor'];

    if (!empty($materiales) && is_array($materiales) && count($materiales) === count($factores)) {
        for ($i = 0; $i < count($materiales); $i++) {
            $id_material = $materiales[$i];
            $factor = floatval($factores[$i]);

            $query = "SELECT costo FROM materiales WHERE id_material = ?";
            $stmt = mysqli_prepare($conexion, $query);
            mysqli_stmt_bind_param($stmt, "i", $id_material);

            if (mysqli_stmt_execute($stmt)) {
                $resultado = mysqli_stmt_get_result($stmt);
                $fila = mysqli_fetch_assoc($resultado);

                if ($fila) {
                    $costoMaterial = $fila['costo'];
                    $costeo_total += $costoMaterial * $factor;
                }
            }

            mysqli_stmt_close($stmt);
        }

        // Actualiza el valor de costeo en la tabla proyecto
        $queryUpdate = "UPDATE proyecto SET costeo = ? WHERE id_proyecto = ?";
        $stmtUpdate = mysqli_prepare($conexion, $queryUpdate);
        mysqli_stmt_bind_param($stmtUpdate, "di", $costeo_total, $proyecto_id);

        if (mysqli_stmt_execute($stmtUpdate)) {
            $mensaje = "El presupuesto total es: $" . $costeo_total . " y se ha guardado en la base de datos para el proyecto seleccionado.";
        } else {
            $mensaje = "Error al guardar el costeo en la base de datos.";
        }

        mysqli_stmt_close($stmtUpdate);
    } else {
        $mensaje = "La selección de materiales no es válida.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Costeo</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            text-align: left;
        }
        label {
            font-weight: bold;
        }
        select, input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #9b1b9c;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        p {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Costeo</h1>

        <form action="./template.php?mod=costear" method="post">
            <label for="proyecto">Selecciona un proyecto:</label>
            <select name="proyecto" id="proyecto">
                <!-- Genera opciones para seleccionar proyectos -->
                <?php
                
                    $usuario_id = $_SESSION['id_us']; 

                    $queryProyectos = "SELECT id_proyecto, nom FROM proyecto WHERE id_us = ?";
                    $stmtProyectos = mysqli_prepare($conexion, $queryProyectos);
                    mysqli_stmt_bind_param($stmtProyectos, "i", $usuario_id);
                    mysqli_stmt_execute($stmtProyectos);
                    $resultadoProyectos = mysqli_stmt_get_result($stmtProyectos);

                    if ($resultadoProyectos) {
                        while ($filaProyecto = mysqli_fetch_assoc($resultadoProyectos)) {
                            echo '<option value="' . $filaProyecto['id_proyecto'] . '">' . $filaProyecto['nom'] . '</option>';
                        }
                    } else {
                        echo 'Error en la consulta SQL: ' . mysqli_error($conexion);
                    }
              
                ?>
            </select>
            <div id="materialInputs">
                <div class="material-input">
                    <label for="material">Selecciona un material:</label>
                    <select name="material[]" id="material">
                        <!-- Genera opciones para seleccionar materiales -->
                        <?php
                        $queryMateriales = "SELECT id_material, nombre FROM materiales";
                        $resultadoMateriales = mysqli_query($conexion, $queryMateriales);

                        while ($filaMaterial = mysqli_fetch_assoc($resultadoMateriales)) {
                            echo '<option value="' . $filaMaterial['id_material'] . '">' . $filaMaterial['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                    <label for="factor">Cantidad que necesita:</label>
                    <input type="number" name="factor[]" value="1">
                </div>
            </div>
            <button type="button" onclick="agregarMaterial()">Agregar Material</button>

            <button type="submit" name="calcularPresupuesto">Calcular Presupuesto</button>
        </form>

        <!-- Resultado del costeo -->
        <?php
        if (!empty($mensaje)) {
            echo "<p>$mensaje</p>";
        }
        ?>
    </div>
    <script>
        function agregarMaterial() {
            const materialInputs = document.querySelector('#materialInputs');
            const materialInputClone = document.querySelector('.material-input').cloneNode(true);
            materialInputs.appendChild(materialInputClone);
        }
    </script>
</body>
</html>
