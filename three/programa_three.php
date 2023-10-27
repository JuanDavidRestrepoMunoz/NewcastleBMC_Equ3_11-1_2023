<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="title">Programa del ThreeJS</title>
    <script type="importmap">
        {
          "imports": {
            "three": "https://unpkg.com/three@0.156.1/build/three.module.js",
            "three/addons/": "https://unpkg.com/three@0.156.1/examples/jsm/"
          }
        }
      </script>
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="./style/style2.css">
      <style>
        .file-select {
          
          border-radius: 5px;
          position: relative;
          display: inline-block;
        }

        .file-select::before {
          width: 10vw;
          background-color: rgba(0, 0, 0, 0);
          display: flex;
          justify-content: left;
          align-items: center;
          border-radius: 5px;
          content: 'Seleccionar textura';
          position: absolute;
          left: 0;
          right: 0;
          top: 0;
          bottom: 0;
        }

        .file-select:hover{
          background-color: rgb(204, 201, 206);
        }

        .file-select:active{
          background-color: rgb(182, 181, 184);
        }

        .file-select input[type="file"] {
          border-radius: 5px;
          opacity: 0;
          width: 200px;
          height: 32px;
          display: inline-block;
        }
      </style>
</head>
<body>
  <div class="sidebar">
    <ul class="nav-links">
      <li id="liO">
        <div class="iocn-link">
          <button class="show">
            <i class='bx bx-shape-square'></i>
            <span class="link_name">Objetos</span>
          </button>
          <i class='bx bx-plus arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><button class="link_name">Objetos</button></li>
          <li><button id="addCube" class="button"><img class="inside" src="img/cube-solid-24.png"><span>CUBO</span></button></li>
          <li><button id="addCylind" class="button"><img class="inside" src="img/cylinder-solid-24.png"><span>CILINDRO</span></button></li>
          <li><button id="addCone" class="button"><img class="inside" src="img/cone.png"><span>CONO</span></button></li>
          <li><button id="addPiram" class="button"><img class="inside" src="img/pyramid.png"><span>PIRAMIDE</span></button></li>
          <li><button id="addSphere" class="button"><img class="inside" src="img/sphere.png"><span>ESFERA</span></button></li>
          <li><button id="addCapsule" class="button"><img class="inside" src="img/capsule.png"><span>CAPSULA</span></button></li>
          <li><button id="addDode" class="button"><img class="inside" src="img/dodecahedron.png"><span>DODECAEDRO</span></button></li>
          <li><button id="addIco" class="button"><img class="inside" src="img/icosaedron.png"><span>ICOSAEDRO</span></button></li>
          <li><button id="addRing" class="button"><img class="inside" src="img/ring.png"><span>ANILLO</span></button></li>
          <li><button id="addTube" class="button"><img class="inside" src="img/marshmallow_983480.png"><span>TUBO</span></button></li>
          <li><button id="addHeart" class="button"><img class="inside" src="img/heart-solid-24.png"><span>CORAZÓN</span></button></li>
          <li><div class="file-select"><input type="file" id="textureInput"></div></li>
        </ul>
      </li>
      <li id="liC">
        <div class="iocn-link">
          <button class="showC">
            <i class='bx bxs-palette'></i>
            <span class="link_name">Colores</span>
          </button>
          <i class='bx bx-plus arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><button class="link_name">Colores</button></li>
          <li><button id="rojo" class="button" style="background-color: red; border-radius: 100%; width:60px;"><span>Rojo</span></button></li>
          <li><button id="amarillo" class="button" style="background-color: yellow; border-radius: 100%; width:60px;"><span>Amarillo</span></button></li>
          <li><button id="coral" class="button" style="background-color: coral; border-radius: 100%; width:60px;"><span>Coral</span></button></li>
          <li><button id="naranja" class="button" style="background-color: orange; border-radius: 100%; width:60px;"><span>Naranja</span></button></li>
          <li><button id="verdeC" class="button" style="background-color: limegreen; border-radius: 100%; width:60px;"><span>Verde claro</span></button></li>
          <li><button id="verdeO" class="button" style="background-color: green; border-radius: 100%; width:60px;"><span>Verde oscuro</span></button></li>
          <li><button id="azulC" class="button" style="background-color: deepskyblue; border-radius: 100%; width:60px;"><span>Azúl claro</span></button></li>
          <li><button id="azulO" class="button" style="background-color: dodgerblue; border-radius: 100%; width:60px;"><span>Azúl oscuro</span></button></li>
          <li><button id="indigo" class="button" style="background-color: indigo; border-radius: 100%; width:60px;"><span>Morado</span></button></li>
          <li><button id="purpura" class="button" style="background-color: purple; border-radius: 100%; width:60px;"><span>Purpura</span></button></li>
          <li><button id="violeta" class="button" style="background-color: mediumpurple; border-radius: 100%; width:60px;"><span>Violeta</span></button></li>
          <li><button id="marron" class="button" style="background-color: saddlebrown; border-radius: 100%; width:60px;"><span>Marrón</span></button></li>
          <li><button id="blanco" class="button" style="background-color: snow; border-radius: 100%; width:60px;"><span>Blanco</span></button></li>
          <li><button id="gris" class="button" style="background-color: grey; border-radius: 100%; width:60px;"><span>Gris</span></button></li>
          <li><button id="negro" class="button" style="background-color: black; border-radius: 100%; width:60px;"><span style="color: snow;">Negro</span></button></li>
        </ul>
      </li>
      <li id="liM">
        <div class="iocn-link">
          <button class="showM">
            <i class='bx bxs-component'></i>
            <span class="link_name">Materiales</span>
          </button>
          <i class='bx bx-plus arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><button class="link_name">Materiales</button></li>
          <li><button id="madera_balso" class="button"><span style="display:flex;"><img src="texturas/madera_balso.jpg" height="50" width="50"><strong>Madera de Balso</strong></span></button></li>
          <li><button id="madera_mdf" class="button"><span style="display:flex;"><img src="texturas/madera_mdf.jpg" height="50" width="50"><strong>Madera MDF</strong></span></button></li>
          <li><button id="madera_triplex" class="button"><span style="display:flex;"><img src="texturas/madera_triplex.jpg" height="50" width="50"><strong>Madera Triplex</strong></span></button></li>
          <li><button id="carton_paja" class="button"><span style="display:flex;"><img src="texturas/carton_paja.jpg" height="50" width="50"><strong>Cartón Paja</strong></span></button></li>
          <li><button id="carton_industrial" class="button"><span style="display:flex;"><img src="texturas/carton_industrial.jpg" height="50" width="50"><strong>Cartón Industrial</strong></span></button></li>
          <li><button id="carton_durex" class="button"><span style="display:flex;"><img src="texturas/carton_durex.jpg" height="50" width="50"><strong>Cartón Durex</strong></span></button></li>
          <li><button id="carton_duplex" class="button"><span style="display:flex;"><img src="texturas/carton_duplex.jpg" height="50" width="50"><strong>Cartón Duplex</strong></span></button></li>
          <li><button id="carton_canson" class="button"><span style="display:flex;"><img src="texturas/carton_canson.jpg" height="50" width="50"><strong>Cartón Canson</strong></span></button></li>
          <li><button id="papel_opalina" class="button"><span style="display:flex;"><img src="texturas/papel_opalina.jpg" height="50" width="50"><strong>Papel Opalina</strong></span></button></li>
          <li><button id="papel_arana" class="button"><span style="display:flex;"><img src="texturas/papel_arana.png" height="50" width="50"><strong>Papel Araña</strong></span></button></li>
          <li><button id="papel_nube" class="button"><span style="display:flex;"><img src="texturas/papel_nube.jpg" height="50" width="50"><strong>Papel Nube</strong></span></button></li>
        </ul>
      </li>
      <li class="finish">
        <button class="button" id="fin">
          <span class="link_name">Terminé</span>
        </button>
      </li>
      <li class="finish">
        <button class="button" id="save">
          <span class="link_name">Guardar</span>
        </button>
      </li>
    </ul>
  </div>
  <input type="checkbox" id="btn_modal">
  <div class="container_modal">
    <div class="container" id="container">
      <div class="modal">
        <header class="head_modal">
          <h1>Tu maqueta:</h1>
        </header>
        <div class="contenido">
          <div class="maqueta" id="maqueta" style="background-color: snow;">
          </div>
          <div class="desc" id="desc">
            <header>
              <h2>Materiales:</h2>
            </header>
            <div class="materiales">
              <p>Materiales</p>
              <p>Precio aproximado: </p>
            </div>
          </div>
        </div>
        <div class="contenido" style="padding: 5px;">
          <button class="button" id="cancelar" style="padding: 5px;">
            <span class="link_name">Cerrar</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <script type="module" src="./index.js"></script>
  <script>
    let arrow = document.querySelectorAll('.arrow');
    let button = document.querySelectorAll('.show');
    let buttonC = document.querySelectorAll('.showC');
    let buttonM = document.querySelectorAll('.showM');
    for (var i = 0; i<arrow.length; i++){
      arrow[i].addEventListener('click', (e)=>{
        let arrowParent = e.target.parentElement.parentElement;
        arrowParent.classList.toggle("showMenu");
      });
    }

    for (var i = 0; i<button.length; i++){
      button[i].addEventListener('click', ()=>{
        let arrowParent = document.getElementById('liO');
        arrowParent.classList.toggle("showMenu");
      });
    }

    for (var i = 0; i<button.length; i++){
      buttonC[i].addEventListener('click', ()=>{
        let arrowParent = document.getElementById('liC');
        arrowParent.classList.toggle("showMenu");
      });
    }

    for (var i = 0; i<button.length; i++){
      buttonM[i].addEventListener('click', ()=>{
        let arrowParent = document.getElementById('liM');
        arrowParent.classList.toggle("showMenu");
      });
    }
  </script>
  <script>
    var checkbox = document.getElementById('btn_modal');
    var activarBoton = document.getElementById('fin');
    var desactivarBoton = document.getElementById('cancelar');
    
    activarBoton.addEventListener('click', function() {
        checkbox.checked = true;
    });
  
    desactivarBoton.addEventListener('click', function() {
        checkbox.checked = false;
    });

    const save = document.getElementById('save');
    save.addEventListener('click', ()=>{
      console.log('Guardando');
    })
  </script>
</body>
</html>