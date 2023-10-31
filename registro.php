<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="icon" type="image/png" href="img/icono.png">
    <meta charset="UTC-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/estilos.css">
    <title>Registro New Castle BMC</title>
</head>
<body>
    <form action="codigo_registrar.php" method="post">
        <?php
        include("conexion.php");
        include("codigo_registrar.php");
        ?>
        <div class="container-fluid rectangulos">
            <div class="container-fluid cuadro">
                <center>
                    <div class="row">
                        <div class="header">
                            <a href="index.php">
                                <img src="img/prueba.png" class="img">
                            </a>
                        </div>
                    </div>
                </center>
            </div>
            <br>
              <div class="container-fluid">
                  <div class="row login">
                      <div class="col-6">
                          <label class="title">Primer nombre*</label>
                          <input type="text" class="form-control for" placeholder="Primer nombre" name="nom1" required>
                      </div>
                      <div class="col-6">
                          <label class="title">Segundo nombre</label>
                          <input type="text" class="form-control for" placeholder="Segundo nombre" name="nom2">
                      </div>
                      <div class="col-6">
                          <label class="title">Primer apellido*</label>
                          <input type="text" class="form-control for" placeholder="Primer apellido" name="ape1" required>
                      </div>
                      <div class="col-6">
                          <label class="title">Segundo apellido</label>
                          <input type="text" class="form-control for" placeholder="Segundo apellido" name="ape2">
                      </div>
                      <br><br><br><br>
                      <div class="col-12">
                        <label class="title" for="exampleInputEmail1">Correo Electrónico*</label>
                        <input type="email" class="form-control for" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo Electrónico" name="correo" required>
                      </div>
                      <br><br><br><br>
                      <div class="col-12">
                          <label class="title">Apodo*</label>
                          <input type="text" class="form-control for" placeholder="Apodo" name="apo" required>
                      </div>
                      <br><br><br><br>
                      <div class="col-12">
                        <label class="title">Contraseña*</label>
                        <input type="password" class="form-control for" placeholder="Contraseña" name="contra" minlength="8" required>
                        <span class="error-message">La contraseña debe tener al menos 8 caracteres.</span>
                    </div>
                  </div>
              </div>
            <br>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <a class="title" href="index.php">Ya tengo cuenta</a>
                    </div>
                    <div class="col-12">
                        <center>
                            <button type="submit" class="btn tre" name="btn_ing">Registrar</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="dashboard/assets/js/plugins/bootstrap-notify.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>