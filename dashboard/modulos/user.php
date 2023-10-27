<?php 
include("../../conexion.php");

if (isset($_SESSION['corr'])) {
    if (isset($_POST['btn_eliminar'])) {
        // Código para mostrar la confirmación de eliminación
        echo '<script>
            var confirmar = confirm("¿Estás seguro de que deseas eliminar tu perfil?");
            if (confirmar) {
                // Si el usuario confirma la eliminación, redirige al mismo script para eliminar el perfil
                window.location = "tu_pagina_actual.php?confirmar_eliminar=1";
            }
        </script>';
    }

    if (isset($_GET['confirmar_eliminar']) && $_GET['confirmar_eliminar'] == 1) {
        // Código para eliminar el perfil si el usuario confirma
        $correo = $_SESSION['corr']; // Usamos la sesión para obtener el valor de 'corr'
        $eliminar = mysqli_query($conexion, "DELETE FROM usuario WHERE `usuario`.`correo` = '$correo';");
        echo "<script>alert('Usuario Eliminado');</script>";
        echo "<script>window.location='../../index.php';</script>";
    }

    if (isset($_POST['btn_actualizar_usuario'])) {
        $correo = $_SESSION['corr']; 
        $a = $_POST['apo'];
        $n1 = $_POST['nom1'];
        $a1 = $_POST['ape1'];
        $desc = $_POST['descripcion'];

        if (!empty($_FILES['img']['name'])) {
            $nombre_imagen = $_FILES['img']['name'];
            $temp_name = $_FILES['img']['tmp_name'];
            $image_path = "ruta_de_carga_de_imagen/" . $image_name;

            if (move_uploaded_file($temp_name, $image_path)) {
                // La imagen se ha cargado exitosamente, ahora puedes actualizar la base de datos con la nueva ruta de la imagen
                $modificar = mysqli_query($conexion, "UPDATE `usuario` SET `apod` = '$a', `nom1` = '$n1', `ape1` = '$a1', `descr` = '$desc', `img` = '$image_path' WHERE `usuario`.`correo` = '$correo';") or die ("Error en el registro: " . mysqli_error($conexion));

                if ($modificar) {
                    // Actualizar las variables de sesión con los datos actualizados
                    $_SESSION['apo'] = $a;
                    $_SESSION['n'] = $n1;
                    $_SESSION['a'] = $a1;
                    $_SESSION['desc'] = $desc;
                    $_SESSION['img'] = $image_path;
                }
            } else {
                echo "Error al cargar la imagen.";
            }
        } else {
            // No se ha subido una nueva imagen, solo actualiza los otros campos
            $modificar = mysqli_query($conexion, "UPDATE `usuario` SET `apod` = '$a', `nom1` = '$n1', `ape1` = '$a1', `descr` = '$desc' WHERE `usuario`.`correo` = '$correo';") or die ("Error en el registro: " . mysqli_error($conexion));

            if ($modificar) {
                // Actualizar las variables de sesión con los datos actualizados
                $_SESSION['apo'] = $a;
                $_SESSION['n'] = $n1;
                $_SESSION['a'] = $a1;
                $_SESSION['desc'] = $desc;
                
                echo "<script>alert('Cambio exitoso');</script>";
            }
        }
    }
}
?>

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

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Gestión de usuario</h4>
                    </div>
                    <div class="card-body">
                        <form action="../documentation/template.php?mod=user" method="post">
                            <div class="row">
                                <div class="col-md-12 pl-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" class="form-control" placeholder="Email" name="correo" value="<?php echo $_SESSION['corr']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pl-1">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Apodo</label>
                                        <input type="text" class="form-control" placeholder="Apodo" name="apo" value="<?php echo $_SESSION['apo']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" placeholder="Nombre" name="nom1" value="<?php echo $_SESSION['n']; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-1">
                                    <div class="form-group">
                                        <label>Apellido</label>
                                        <input type="text" class="form-control" placeholder="Apellido" name="ape1" value="<?php echo $_SESSION['a']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Acerca de mi</label>
                                        <textarea rows="4" cols="80" class="form-control" placeholder="Aquí una descripción" name="descripcion"><?php echo $_SESSION['desc']?></textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" style="margin: 5px" class="btn btn-primary pull-right" name="btn_actualizar_usuario" value="actualizar">Actualizar perfil</button> <button type="button" style="margin: 5px" class="btn btn-primary pull-right" onclick="confirmarEliminacion()">Eliminar perfil</button>

                            

                            <script>
                                function confirmarEliminacion() {
                                    var confirmar = confirm("¿Estás seguro de que deseas eliminar tu perfil?");
                                    if (confirmar) {
                                        // Si el usuario confirma la eliminación, redirige al mismo script para eliminar el perfil
                                        window.location = "./template.php?mod=user&confirmar_eliminar=1";
                                    }
                                }
                            </script>

                          
                            <div class="clearfix"></div>                                                                     <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-image">
                        <img src="https://imagenes.expreso.ec/files/image_700_402/uploads/2021/11/26/61a07058c7108.png" alt="..."/>
                    </div>
                    
                    <div class="card-body">
                        <div class="author">
                        <img class="avatar border-gray" src="../../chatnewcastle/php/images/<?php echo $_SESSION['img']?>" alt="..."/>
                          <h4 class="title"><?php echo $_SESSION['n'], " ", $_SESSION['a']; ?><br />
                             <small><?php echo $_SESSION['apo']?></small>
                          </h4>
                            <p class="description">
                                <?php echo $_SESSION['desc']?>
                            </p>
                        </div>
                        <p class="description text-center">

                        </p>
                        <!-- <center>
                            <button id="btn_foto" style="margin: 5px" class="btn ">
                                <span><strong>Cambiar foto de peril</strong></span>
                            </button>
                        </center> -->
                    </div>
                    <hr>
                    <div class="button-container mr-auto ml-auto">
                        <button href="#" class="btn btn-simple btn-link btn-icon">
                            <i class="fa fa-facebook-square"></i>
                        </button>
                        <button href="#" class="btn btn-simple btn-link btn-icon">
                            <i class="fa fa-twitter"></i>
                        </button>
                        <button href="#" class="btn btn-simple btn-link btn-icon">
                            <i class="fa fa-google-plus-square"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="cuentas">

</div>

<input type="checkbox" id="btn_modal">
<div class="container_modal">
    <div class="container" id="container">
        <header>
            <h3>Cambiar foto de perfil</h3>
        </header>
        <form action="../documentation/template.php?mod=inicio" method="post">
            <div class="field image">
                <label>Seleccionar imagen</label>
                <input id="inputFile" type="file" name="image" required>
            </div>
        </form>
        <img src="" id="imagenSeleccionada" style="heigth: 150px; width: 150px;">
        <div class="contenido">
            <button id="cancelar">
                <span><strong>Cancelar</strong></span>
            </button>
            <button id="btn_crear">
                <span><strong>Cambiar</strong></span>
            </button>
        </div>
    </div>
</div>

<script>
    var checkbox = document.getElementById('btn_modal');
    var activarBoton = document.getElementById('btn_foto');
    var desactivarBoton = document.getElementById('cancelar');
    
    activarBoton.addEventListener('click', function() {
        checkbox.checked = true;
    });
  
    desactivarBoton.addEventListener('click', function() {
        checkbox.checked = false;
        imagenSeleccionada.src = '';
    });

    const three = document.getElementById('btn_crear');

    three.addEventListener('click', function(){
        imagenSeleccionada.src = '';
    })

    var inputFile = document.getElementById('inputFile');
    inputFile.addEventListener('change', function() {
      var file = inputFile.files[0];
      if (file) {
        var imageUrl = URL.createObjectURL(file);
        var imagenSeleccionada = document.getElementById('imagenSeleccionada');
        imagenSeleccionada.src = '';
        imagenSeleccionada.src = imageUrl;
      }
    });
</script>