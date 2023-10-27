<?php
//Iniciacimos sesión
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>New Castle BMC</title>
</head>
<body>
    <head>
        <h1>Bienvenido <?php echo $_SESSION['n'], " ", $_SESSION['a']; ?></h1>
        <a href="salir.php">Cerrar Sesión</a>
    </head>
</body>
</html>