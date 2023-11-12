<?php
  session_start(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>THREE JS</title>
    <script type="importmap">
      {
        "imports": {
          "three": "https://unpkg.com/three@0.156.1/build/three.module.js",
          "three/addons/": "https://unpkg.com/three@0.156.1/examples/jsm/"
        }
      }
    </script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body { margin: 0; }
    </style>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" type="image/png" href="./img/icono.png">
</head>

<body>
  <div class="container">
    <header class="header">
      <div class="perfil">
        <button id="atras"><img src="../chatnewcastle/php/images/<?php echo $_SESSION['img']?>" alt="perfil"></button>
        <label style="text-align: center;" for="atras"><?php echo $_SESSION['apo'] ?></label>
      </div>
      <div class="navbar">
        <button id="objetos">Formas</button>
        <button id="colores">Color</button>
        <button id="materiales">Materiales</button>
      </div>
      <div class="atras">
        <button id="atras"><img src="../img/icono.png" id="atras" alt="NCBMC" style="width: 60px; height: 30px;"></button>
      </div>
    </header>
    <iframe id="THREE" src="./programa_three.php" frameborder="0" scrolling="no"></iframe>
  </div>
  <script>
    const objetos = document.getElementById('objetos');
    const colores = document.getElementById('colores');
    const materiales = document.getElementById('materiales');

    var iframe = document.getElementById('THREE');
    iframe.addEventListener('load', function() {
      var contenidoIframe = iframe.contentWindow.document;
      var elementoDentroIframe = contenidoIframe.getElementById('liO');
      var elementoDentroIframeC = contenidoIframe.getElementById('liC');
      var elementoDentroIframeM = contenidoIframe.getElementById('liM');
    
      objetos.addEventListener('click', () => {
        elementoDentroIframe.classList.toggle("showMenu");
      });
      colores.addEventListener('click', () => {
        elementoDentroIframeC.classList.toggle("showMenu");
      });
      materiales.addEventListener('click', () => {
        elementoDentroIframeM.classList.toggle("showMenu");
      });
    });

    const perfil = document.getElementById('atras');
    perfil.addEventListener('click', () => {
      window.location='../dashboard/documentation/template.php';
    });
  </script>
</body>
</html>