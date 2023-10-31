<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTC-8">
    <link rel="icon" type="image/png" href="img/icono.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/estilos.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="form">
        <div class="container-fluid inicio">
            <center>
                <div class="container-fluid cuadro">
                        <div class="row">
                            <div class="col">
                                <a href="index.php">
                                    <img src="img/prueba.png" class="img">
                                </a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="container-fluid contenedor">
                    <form action="index.php" method="post">
                    <?php
                        //Incluimos la conexión.
                            include ("conexion.php");
                            //Verificamos acción del boton.
                            if(isset($_POST['in'])){
                                // Recuperamos datos de inicio
                                $cor = $_POST['correo'];
                                $pass = $_POST['contra'];
                                // Encriptar.
                                $encript = md5($pass);
                                // Realizar consulta a base de datos.
                                $consulta = mysqli_query($conexion, "SELECT * FROM usuario WHERE correo = '$cor' AND cont = '$encript'") or die($conexion);
                                // Verificar resultado.
                                $resultado = mysqli_num_rows($consulta);
                                // Verifica que es 1.
                                if ($resultado == 1) {
                                    while ($fila = mysqli_fetch_array($consulta)) {
                                        $_SESSION['n'] = $fila['nom1'];
                                        $_SESSION['a'] = $fila['ape1'];
                                        $_SESSION['corr'] = $fila['correo'];
                                        $_SESSION['desc'] = $fila['descr'];
                                        $_SESSION['apo'] = $fila['apod'];
                                        $_SESSION['id_us'] = $fila['id_us'];
                                        $_SESSION['img'] = $fila['img'];

                                        echo "<script>window.location='chatnewcastle/users.php';</script>";
                                        header("location:dashboard/documentation/template.php");
                                        $status = "Conectado ahora";
                                        $sql2 = mysqli_query($conexion, "UPDATE usuario SET status = '{$status}' WHERE id_us = {$fila['id_us']}");
                                    }
                                } else {
                                    // Avisa que el usuario y/o contraseña no coinciden.
                                    echo "Usuario y/o contraseña no coinciden";
                                    // Muestra el mensaje de error en el span.
                                    echo "<script>document.getElementById('error_message').textContent = 'Usuario y/o contraseña no coinciden';</script>";
                                }
                            }                            
                    ?>
                        <div class="row">
                            <div class="col">
                                <label class="title" for="exampleInputEmail1">Correo Electrónico</label>
                                <input type="email" class="form-control for" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo Electrónico" name="correo" required
                                <?php
                                    // Si se ha enviado un correo en el formulario, se muestra aquí para mantenerlo.
                                    if (isset($_POST['correo'])) {
                                        echo 'value="' . $_POST['correo'] . '"';
                                    }
                                ?>>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="title" for="exampleInputPassword1">Contraseña</label>
                                <input type="password" class="form-control for" id="contra" placeholder="Contraseña" name="contra" required>
                                <span id="error_message" style="color: red;"></span>
                                <div class="toggle"></div>
                            </div>
                        </div>
                        <a class="title" href="registro.php">No tengo cuenta</a>
                        <br><br>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="btn tre" name="in">Iniciar Sesión</button>
                            </div>
                        </div>
                    </form>
                    <br>
                    <div class="container-fluid cont">
                        <div class="row">
                            <div class="col">
                                <section class="button">
                                    <div id="social-media-icons" class="d-flex justify-content-between align-items-center">
                                        <a href="https://www.facebook.com/profile.php?id=100092662942856&mibextid=ZbWKwL" role="button" class="fa fa-facebook rounded-circle"></a>
                                        <a href="https://twitter.com/NewcastleBMC" role="button" class="fa fa-twitter rounded-circle"></a>
                                        <a href="https://www.instagram.com/newcastlebmc/" role="button" class="fa fa-instagram rounded-circle"></a>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>