<!-- -------------------------------------------------- CSS -------------------------------------------------- -->

<style>
    .container_modal {
        display: none;
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0; left: 0;
        background-color: rgba(144, 148, 150, 0.8);
    }

    #btn_modal:checked ~ .container_modal{
        display: flex;
    }

    .container{
        background-color: rgb(188, 176, 194);
        position: fixed;
        width: 60vw;
        margin: 100px 300px;
        padding: 10px 15px;
        border-radius: 8px;
        z-index: 100;
    }

    .container .contenido{
        display: flex;
        align-items: center;
        justify-content: space-around;
        padding: 8px;
    }

    #btn_modal{
        display: none;
    }

</style>

<!-- --------------------------------------------------- HTML ------------------------------------------------- -->


<div class="cajaInicio">

    <div class="botonInicio">
        <button id="nuevoProyecto">
            <span><strong>Crear nuevo proyecto</strong></span>
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
                        $dato = '%' . $dato . '%';
                        mysqli_stmt_bind_param($stmt, "s", $dato);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                    
                        if ($result && mysqli_num_rows($result) === 0) {
                            echo "No tienes ningún proyecto creado";
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Procesa los resultados aquí
                            }
                        }
                    } else {
                        echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
                    }
                    
                    // Cierra la declaración preparada
                    mysqli_stmt_close($stmt);


                   // ... (Código anterior)

                    while ($fila = mysqli_fetch_assoc($result)) {
                        // Mostrar resultados en la tabla
                    
                ?>
                    <tr>
                    <td><?php echo $fila['id_proyecto'] ?> </td>
                    <td><?php echo $fila['nom'] ?> </td>
                    <td><?php echo $fila['id_us']  ?> </td>
                    <td><?php echo $fila['costo']  ?> </td>
                    <td>
                    <form action="./template.php?mod=editar&id_material=<?php echo $fila['id_material']; ?>" method="post">
                        <input type="hidden" name="id_actualizar" value="<?php echo $fila['id_material']; ?>">
                        <button type="submit" name="btn_modificar_material" style="background-color: transparent; border: 0px;">
                            <img src="../../img/editar-imagen.png" width="40px" height="40px">
                        </button>
                    </form>
                    </td>
                    <td>
                    <form action="./template.php?mod=gestion" method="post">
                     <input type="text" name="nom_eliminar" value="<?php echo $fila['id_material']; ?>" hidden>
                        <button type="submit" name="btn_eliminar" style="background-color: transparent; border: 0px;">
                            <img src="../../img/papelera-de-reciclaje.png" width="40px" height="40px">
                        </button>
                    </form>
                    </td>
                    </tr>
                <?php
                    }
                    mysqli_close($conexion);
                ?>
            </tbody>
        </table>
    </div>

</div>


<input type="checkbox" id="btn_modal">
<div class="container_modal">
    <div class="container" id="container">
        <header>
            <h3>Crear Nuevo Proyecto</h3>
        </header>
        <form action="../documentation/template.php?mod=inicio" method="post">
            <input type="text" class="form-control" placeholder="Nombre del proyecto">
        </form>
        <div class="contenido">
            <button id="cancelar">
                <span><strong>Cancelar</strong></span>
            </button>
            <button id="btn_crear">
                <span><strong>Crear</strong></span>
            </button>
        </div>
    </div>
</div>

<!-- ----------------------------------------------- JavaScript ----------------------------------------------------- -->

<script>
    var checkbox = document.getElementById('btn_modal');
    var activarBoton = document.getElementById('nuevoProyecto');
    var desactivarBoton = document.getElementById('cancelar');
    
    activarBoton.addEventListener('click', function() {
        checkbox.checked = true;
    });
  
    desactivarBoton.addEventListener('click', function() {
        checkbox.checked = false;
    });

    const three = document.getElementById('btn_crear');

    three.addEventListener('click', function(){
        window.location.href = '../../three/index.php';
    })
</script>