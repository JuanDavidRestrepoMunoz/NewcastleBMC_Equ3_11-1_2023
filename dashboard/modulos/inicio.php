<?php
include "../../conexion.php";

if (isset($_POST['btn_crear'])) {
    $nom = $_POST['nom_proyecto'];
    $id_us = $_SESSION['id_us'];
    $time = time();
    $nombre_aleatorio = uniqid($_SESSION['apo']) . '_' . $nom . '.json';
    $directorio_destino = './../../three/archivos/';
    $json_data = json_encode("");
    $archivo_destino = $directorio_destino . $nombre_aleatorio;
    if (file_put_contents($archivo_destino, $json_data)) {
        $registrar = mysqli_query($conexion, "INSERT INTO `proyecto` (`id_proyecto`, `nom`, `id_us`, `costeo`, `obj`) VALUES ('', '$nom', '$id_us', '0', '$nombre_aleatorio')") or die (mysqli_error($conexion));
        if($registrar){
            echo "<script>window.location='../../three/index.php';</script>";
        };
    } else {
        echo "Error al crear el archivo JSON.";
    }

}

if (isset($_POST['btn_eliminar'])) {
    // Código para mostrar la confirmación de eliminación
    $confirmarEliminar = '<script>
        var confirmar = confirm("¿Estás seguro de que deseas eliminar este proyecto?");
        if (confirmar) {
            // Si el usuario confirma la eliminación, redirige al mismo script para eliminar el proyecto
            window.location = "./template.php?mod=inicio&confirmar_eliminar=1&id_proyecto=' . $_POST['nom_eliminar'] . '";
        }
    </script>';

    echo $confirmarEliminar;
}

if (isset($_GET['confirmar_eliminar']) && $_GET['confirmar_eliminar'] == 1) {
    // Código para eliminar el proyecto si el usuario confirma
    $id_eliminar = @$_GET['id_proyecto'];

    // Evita la inyección SQL utilizando una consulta preparada
    $query = "DELETE FROM proyecto WHERE id_proyecto = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "i", $id_eliminar);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('El proyecto ha sido eliminado con éxito');</script>";
    } else {
        echo "<script>alert('Error al eliminar el proyecto');</script>";
    }
    mysqli_stmt_close($stmt);
    echo "<script>window.location='./template.php?mod=inicio';</script>";
}


if (isset($_GET['id_proyecto'])) {
    if (isset($_POST['btn_abrir'])){
        $_SESSION['id_proyecto'] = $_GET['id_proyecto'];
        echo "<script>window.location='../../three/index.php';</script>";
    }
}
?>

<!-- -------------------------------------------------- CSS -------------------------------------------------- -->

<style>

    .container_modal{
        width: 25vw;
        opacity: 0;
        margin: 15px;
        padding: 15px;
    }

    .container_modal form{
        display: flex;
    }

    #btn_modal:checked ~ .container_modal{
        transition: .5s ease;
        opacity: 1;
    }

    #btn_modal{
        display: none;
    }

</style>

<!-- --------------------------------------------------- HTML ------------------------------------------------- -->


<div class="cajaInicio">

    <div class="botonInicio" id="botonCrear">
        <button id="nuevoProyecto">
            <span><strong>Crear nuevo</strong></span>
        </button>
    </div>

    <div class="proyectos">
        <table class="table" style="width: 80%">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID Proyecto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">ID Usuario</th>
                    <th scope="col">Costo</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    include("../../conexion.php");
                    
                    $dato = @$_SESSION['id_us'];
                    
                    $query = "SELECT * FROM proyecto WHERE id_us LIKE ?";
                    $stmt = mysqli_prepare($conexion, $query);
                    
                    if ($stmt) {
                        mysqli_stmt_bind_param($stmt, "s", $dato);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                    
                        if ($result && mysqli_num_rows($result) === 0) {
                            echo "No tienes ningún proyecto creado";
                        } else {
                            while ($fila = mysqli_fetch_assoc($result)) {
                                // Procesa los resultados aquí
                                $_SESSION["nom_pro"] = $fila["nom"];
                                ?>
                                    <tr>
                                    <td><?php echo $fila['id_proyecto'] ?></td>
                                    <td><?php echo $fila['nom'] ?></td>
                                    <td><?php echo $fila['id_us']  ?> </td>
                                    <td><?php echo $fila['costeo']  ?> </td>
                                    <td>
                                    <form action="./template.php?mod=inicio&id_proyecto=<?php echo $fila['id_proyecto']; ?>" method="post">
                                        <input type="hidden" name="id_actualizar" value="<?php echo $fila['id_proyecto']; ?>">
                                        <button type="submit" id="btn_abrir" name="btn_abrir" style="background-color: transparent; border: 0px;">
                                            <img src="../../img/carpeta.png" width="40px" height="40px">
                                        </button>
                                        <br>
                                        <label for="id_actualizar">Abrir</label>
                                    </form>
                                    </td>
                                    <td>
                                    <form action="./template.php?mod=inicio" method="post">
                                    <input type="text" name="nom_eliminar" value="<?php echo $fila['id_proyecto']; ?>" hidden>
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
                    } else {
                        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
                    }
                    // Cierra la declaración preparada
                    mysqli_stmt_close($stmt);
                ?>
            </tbody>
        </table>
    </div>

</div>


<input type="checkbox" id="btn_modal">
<div class="container_modal" id="contenedor">
    <form action="./template.php?mod=inicio" method="post">
        <input type="text" class="form-control" name="nom_proyecto" id="nom_proyecto" placeholder="Nombre del proyecto" required>
        <button id="btn_crear" name="btn_crear">
            <span><strong>Crear</strong></span>
        </button>
    </form>
</div>

<!-- ----------------------------------------------- JavaScript ----------------------------------------------------- -->

<script>
    const checkbox = document.getElementById('btn_modal');
    const activarBoton = document.getElementById('nuevoProyecto');

    activarBoton.addEventListener('click', function() {
        checkbox.checked = true;
    });
</script>