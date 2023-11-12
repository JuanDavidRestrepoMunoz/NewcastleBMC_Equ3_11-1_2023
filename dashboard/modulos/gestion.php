<center>

<?php
include "../../conexion.php";

function obtenerNombreTipoMaterial($id_tipo) {
    $tipos = array(
        6 => "Cartón",
        5 => "Madera",
        7 => "Cinta",
        8 => "Papel"
        // Agrega más tipos según tus necesidades
    );
    
    return isset($tipos[$id_tipo]) ? $tipos[$id_tipo] : "Desconocido";
}


if (isset($_POST['btn_eliminar'])) {
    // Código para mostrar la confirmación de eliminación
    $confirmarEliminar = '<script>
        var confirmar = confirm("¿Estás seguro de que deseas eliminar este material?");
        if (confirmar) {

            window.location = "./template.php?mod=gestion&confirmar_eliminar=1&id_material=' . $_POST['nom_eliminar'] . '";
        }
    </script>';

    echo $confirmarEliminar;
}

if (isset($_GET['confirmar_eliminar']) && $_GET['confirmar_eliminar'] == 1) {
    // Código para eliminar el proyecto si el usuario confirma
    $id_eliminar = @$_GET['id_material'];

    // Evita la inyección SQL utilizando una consulta preparada
    $query = "DELETE FROM materiales WHERE id_material = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_eliminar);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('El Material ha sido eliminado con éxito');</script>";
    } else {
        echo "<script>alert('Error al eliminar el material');</script>";
    }
    mysqli_stmt_close($stmt);
    echo "<script>window.location='./template.php?mod=gestion';</script>";
}

if (isset($_POST["btn_modificar_material"])) {
    $id_material = $fila['id_material']; // Obtener el ID del material desde tu consulta o donde corresponda
    echo "<script>window.location = './template.php?mod=editar&id_material=" . $id_material . "';</script>";
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Materiales Registrados</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/estilo.css">
</head>
<style>
        /* Estilos personalizados para tu página */
        .container {
            max-width: 80%;
            margin: 0 auto;
        }

        .btn {
            /* Estilos para botones */
            background-color: #9b1b9c;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
</style>
<body>
    <div class="container">
        <h1>Materiales Registrados</h1>

        <form action="./template.php?mod=gestion" method="post" class="form-inline">
            <div class="container-fluid" style="30%">
                <input type="text" class="form-control" placeholder="Buscar Por Nombre" name="txtbuscar">
                <br><br>
                <button type="submit" class="btn btn-outline-primary" name="btnbuscar">Buscar</button>
            </div>
        </form>
        
        <br><br><br><br><br>
        
        <table class="table" style="width: 80%">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre material</th>
                    <th scope="col">Tipo material</th>
                    <th scope="col">Textura</th>
                    <th scope="col">Color</th>
                    <th scope="col">Medida (cm2)</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST["btnbuscar"])) {
                    $dato = @$_POST["txtbuscar"];
                    // Evita la inyección SQL utilizando una consulta preparada
                    $query = "SELECT * FROM materiales WHERE nombre LIKE ?";
                    $stmt = mysqli_prepare($conexion, $query);
                    $dato = '%' . $dato . '%';
                    mysqli_stmt_bind_param($stmt, "s", $dato);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);


                   // ... (Código anterior)

                    while ($fila = mysqli_fetch_assoc($result)) {
                        // Mostrar resultados en la tabla
                    
                    ?>
                    <tr>
                    <td><?php echo $fila['id_material'] ?> </td>
                    <td><?php echo $fila['nombre'] ?> </td>
                    <td><?php echo obtenerNombreTipoMaterial($fila['id_tipo']) ?> </td> 

                    <td><?php echo '<img src="data:' . $fila['textura'] . ';base64,' . $fila['textura'] . '" alt="Imagen Base64" height="50" width="50">'; ?></td>
                        <td><?php echo  $fila['color']  ?> </td>
                        <td><?php echo $fila['largo'] * $fila['ancho']; ?> </td>
                        <td><?php echo $fila['costo']  ?> </td>
                        <td>
                        <form action="./template.php?mod=editar&id_material=<?php echo $fila['id_material']; ?>" method="post">
                            <input type="hidden" name="id_actualizar" value="<?php echo $fila['id_material']; ?>">
                            <button type="submit" name="btn_modificar_material" style="background-color: transparent; border: 0px;">
                                <img src="../../img/editar-imagen.png" width="40px" height="40px">
                            </button>
                            <br>
                            <label for="id_actualizar">Modificar</label>
                        </form>
                        </td>
                        
                        <td>
                        <form action="./template.php?mod=gestion" method="post">
                         <input type="text" name="nom_eliminar" value="<?php echo $fila['id_material']; ?>" hidden>
                            <button type="submit" name="btn_eliminar" style="background-color: transparent; border: 0px;">
                                <img src="../../img/papelera-de-reciclaje.png" width="40px" height="40px">
                            </button>
                            <br>
                            <label for="id_actualizar">Eliminar</label>
                        </form>
                        </td>
                    </tr>
                    <?php
                    }
                }
                mysqli_close($conexion);

                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
