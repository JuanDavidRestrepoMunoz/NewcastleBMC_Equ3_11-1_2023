import * as THREE from 'three';
import {OrbitControls} from './controls/OrbitControls.js';
import {TransformControls} from './controls/TransformControls.js';
import {DragControls} from './controls/DragControls.js';
import {STLLoader} from './node_modules/three/examples/jsm/loaders/STLLoader.js';
import {OBJLoader} from './node_modules/three/examples/jsm/loaders/OBJLoader.js';
import { GLTFLoader } from './node_modules/three/examples/jsm/loaders/GLTFLoader.js';
import { GLTFExporter } from './node_modules/three/examples/jsm/exporters/GLTFExporter.js';
import {STLExporter} from './node_modules/three/examples/jsm/exporters/STLExporter.js';
import {OBJExporter} from './node_modules/three/examples/jsm/exporters/OBJExporter.js';

// Constantes y variables globales

let scene, camera, renderer, grid, geometry, textura, material, controls, register = [], dControls, reader, DELETE_KEY = 46, BACKSPACE_KEY = 8, exporterG;
var mouse, raycaster, selectedObject = null, selectedFile = null, textureInput;

function init(){

    // Creación y ajuste de cámara y escenario
    scene = new THREE.Scene();
    
    camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 10;
    camera.rotation.z = 0;
    camera.position.y = 1;
    camera.rotation.y = 0;
    camera.position.x = 0;
    camera.rotation.x = 0;

    // Creación del renderizador
    
    renderer = new THREE.WebGLRenderer({alpha: true});
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    // Creación del control de órbita y control de transformación

    let orbit = new OrbitControls(camera, renderer.domElement);
    orbit.enabled = true;
    controls = new TransformControls(camera, renderer.domElement);

    // Variables para la localización con coordenadas

    raycaster = new THREE.Raycaster();
    mouse = new THREE.Vector2();

    // Creación de la cuadrícula

    grid = new THREE.GridHelper(100, 100);
    scene.add(grid);

    // Creación y ajuste de la luz

    let light = new THREE.DirectionalLight(0xffffff, 1, 100);
    light.position.set(-1, 2, 2);
    light.castShadow = true;
    scene.add(light);

    // Cargar texturas

    textureInput = document.getElementById('textureInput');

    textureInput.addEventListener('change', (event) => {
        selectedFile = event.target.files[0];

        if (selectedFile) {
            reader = new FileReader();
            reader.onload = (e) => {
                textura = e.target.result;
            };
            reader.readAsDataURL(selectedFile);
        }
    });
    
    // Botón para agregar cubos

    let addCube = document.getElementById('addCube')

    addCube.addEventListener('click', () => {

        geometry = new THREE.BoxGeometry(1, 1, 1);

        if(textura){
            material = new THREE.MeshBasicMaterial({ 
                transparent:true,
                map: new THREE.TextureLoader().load(textura) 
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
        });
        }

        let cube = new THREE.Mesh(geometry, material);
        
        cube.position.set(0, 1, 0);
    
        scene.add(cube);
        register.push(cube);
    });

    // Botón para agregar cilindros

    let addCylind = document.getElementById('addCylind')

    addCylind.addEventListener('click', ()=>{

        geometry = new THREE.CylinderGeometry( 1, 1, 2, 32 ); 
        
        if(textura){
            material = new THREE.MeshBasicMaterial({ 
                color: 0x808080,
                transparent:true,
                map: new THREE.TextureLoader().load(textura) 
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
        });
        }

        let cylinder = new THREE.Mesh( geometry, material );

        cylinder.position.set(0, 1, 0);
        
        scene.add( cylinder );
        register.push(cylinder);
    })

    // Botón para agregar conos

    let addCone = document.getElementById('addCone')

    addCone.addEventListener('click', ()=>{

        geometry = new THREE.ConeGeometry( 1, 2, 32 ); 

        if(textura){
            material = new THREE.MeshBasicMaterial({ 
                color: 0x808080,
                transparent:true,
                map: new THREE.TextureLoader().load(textura) 
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
        });
        }
        
        let cone = new THREE.Mesh(geometry, material );

        cone.position.set(0, 1, 0);
        
        scene.add( cone );
        register.push(cone);
    })

    // Botón para agregar piramides

    let addPiram = document.getElementById('addPiram')

    addPiram.addEventListener('click', ()=>{
        
        geometry = new THREE.ConeGeometry( 1, 1, 4 );

        if(textura){
            material = new THREE.MeshBasicMaterial({ 
                color: 0x808080,
                transparent:true,
                map: new THREE.TextureLoader().load(textura) 
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
        });
        }

        let pyramid = new THREE.Mesh(geometry, material);

        pyramid.position.set(0, 1, 0);

        scene.add(pyramid)
        register.push(pyramid);
    })

    // Botón para agregar esferas

    let addSphere = document.getElementById('addSphere')

    addSphere.addEventListener('click', ()=>{

        geometry = new THREE.SphereGeometry( 1, 32, 16 ); 

        if(textura){
            material = new THREE.MeshBasicMaterial({ 
                color: 0x808080,
                transparent:true,
                map: new THREE.TextureLoader().load(textura) 
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
        });
        }

        let sphere = new THREE.Mesh( geometry, material );

        sphere.position.set(0, 1, 0);
        
        scene.add( sphere );
        register.push(sphere);
    })

    // Botón para agregar capsulas

    let addCapsule = document.getElementById('addCapsule')

    addCapsule.addEventListener('click', ()=>{

        geometry = new THREE.CapsuleGeometry( 1, 1, 10, 20 );

                if(textura){
            material = new THREE.MeshBasicMaterial({ 
                color: 0x808080,
                transparent:true,
                map: new THREE.TextureLoader().load(textura) 
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
        });
        }

        let capsule = new THREE.Mesh( geometry, material );

        capsule.position.set(0, 1, 0);
        
        scene.add( capsule );
        register.push(capsule);
    })

    // Botón para agregar dodecaedros

    let addDode = document.getElementById('addDode')

    addDode.addEventListener('click', ()=>{

        geometry = new THREE.DodecahedronGeometry( 1, 0 );

        if(textura){
            material = new THREE.MeshBasicMaterial({ 
                color: 0x808080,
                transparent:true,
                map: new THREE.TextureLoader().load(textura) 
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
        });
        }

        let dodecaedro = new THREE.Mesh(geometry,material);

        dodecaedro.position.set(0, 1, 0);

        scene.add(dodecaedro);
        register.push(dodecaedro);
    })

    // Botón para agregar icosaedros

    let addIco = document.getElementById('addIco')

    addIco.addEventListener('click', ()=>{

        geometry = new THREE.IcosahedronGeometry( 1, 0 );

        if(textura){
            material = new THREE.MeshBasicMaterial({ 
                color: 0x808080,
                transparent:true,
                map: new THREE.TextureLoader().load(textura) 
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
        });
        }

        let icosaedro = new THREE.Mesh(geometry,material);

        icosaedro.position.set(0, 1, 0);

        scene.add(icosaedro);
        register.push(icosaedro);
    })

    // Botón para agregar anillos

    let addRing = document.getElementById('addRing')

    addRing.addEventListener('click', ()=>{

        geometry = new THREE.TorusGeometry( 1, 0.3, 16, 100 );

        if(textura){
            material = new THREE.MeshBasicMaterial({ 
                color: 0x808080,
                transparent:true,
                map: new THREE.TextureLoader().load(textura) 
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
        });
        }

        let ring = new THREE.Mesh( geometry, material );

        ring.position.set(0, 1, 0);
        
        scene.add( ring );
        register.push(ring);
    })

    // Botón para agregar tubos

    let addTube = document.getElementById('addTube')

    addTube.addEventListener('click', ()=>{

        class CustomSinCurve extends THREE.Curve {

            constructor( scale = 1 ) {
                super();
                this.scale = scale;
            }
        
            getPoint( t, optionalTarget = new THREE.Vector3() ) {
        
                const tx = t * 3 - 1.5;
                const ty = Math.sin( 2 * Math.PI * t );
                const tz = 0;
        
                return optionalTarget.set( tx, ty, tz ).multiplyScalar( this.scale );
            }
        }
        
        let path = new CustomSinCurve( 5 );
        geometry = new THREE.TubeGeometry( path, 20, 2, 8, false );

        if(textura){
            material = new THREE.MeshBasicMaterial({ 
                color: 0x808080,
                transparent:true,
                map: new THREE.TextureLoader().load(textura) 
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
        });
        }

        let tube = new THREE.Mesh( geometry, material );

        tube.position.set(0, 1, 0);
        tube.scale.set(0.5, 0.5, 0.5);

        scene.add( tube );
        register.push(tube);
    })

    // Botón para agregar corazones

    let addHeart = document.getElementById('addHeart')

    addHeart.addEventListener('click', ()=>{

        let x = 0, y = 0;

        let heartShape = new THREE.Shape();

        heartShape.moveTo( x + 5, y + 5 );
        heartShape.bezierCurveTo( x + 5, y + 5, x + 4, y, x, y );
        heartShape.bezierCurveTo( x - 6, y, x - 6, y + 7,x - 6, y + 7 );
        heartShape.bezierCurveTo( x - 6, y + 11, x - 3, y + 15.4, x + 5, y + 19 );
        heartShape.bezierCurveTo( x + 12, y + 15.4, x + 16, y + 11, x + 16, y + 7 );
        heartShape.bezierCurveTo( x + 16, y + 7, x + 16, y, x + 10, y );
        heartShape.bezierCurveTo( x + 7, y, x + 5, y + 5, x + 5, y + 5 );

        geometry = new THREE.ShapeGeometry( heartShape );

        if(textura){
            material = new THREE.MeshBasicMaterial({ 
                color: 0x808080,
                transparent:true,
                map: new THREE.TextureLoader().load(textura),
                side: THREE.DoubleSide
            });
        }else{
            material = new THREE.MeshBasicMaterial({ 
            color: 0x808080,
            transparent:true,
            side: THREE.DoubleSide
        });
        }

        let heart = new THREE.Mesh( geometry, material ) ;

        heart.scale.set(0.5, 0.5, 0.5);
        heart.position.set(0, 10, 0);
        heart.rotation.z = 3.15;

        scene.add( heart );
        register.push(heart);
    })

    // Eventos para la movilidad y transformación de los objetos seleccionados (ABSOLUTAMENTE NO TOCAR)

    window.addEventListener('click', ()=>{
        if (selectedObject){
            console.log('Soltando Objeto');
            controls.detach(selectedObject);
            dControls.deactivate();
            dControls.dispose();
            selectedObject = null
            return;
        }
        
        raycaster.setFromCamera(mouse, camera);
        const intersects = raycaster.intersectObjects(register);

        if(intersects.length > 0 ) {
            selectedObject = intersects[0].object;
            console.log('Seleccionado');
            console.log(register);

            function configureControls(mode, object) {
                controls.setMode(mode, object);
                scene.add(controls);
                controls.addEventListener('dragging-changed', (e) => {
                    orbit.enabled = !e.value;
                });
                controls.attach(object);
            }
            

            document.addEventListener('keydown', (event)=>{
                if(selectedObject==null){
                    console.log('No ha seleccionado ningún objeto');
                }else if(event.keyCode === 82){
                    configureControls('rotate', selectedObject);
                    dControls.deactivate();
                    dControls.dispose();
                }else if(event.keyCode === 69 || event.keyCode === 101){
                    configureControls('scale', selectedObject)
                    dControls.deactivate();
                    dControls.dispose();
                }else if(event.keyCode === 84){
                    configureControls('translate', selectedObject)
                    dControls.deactivate();
                    dControls.dispose();
                }else if(event.keyCode === DELETE_KEY || event.keyCode === BACKSPACE_KEY){
                    register = register.filter((object) => object !== selectedObject);
                    scene.remove(selectedObject);
                    controls.detach(selectedObject);
                    dControls.deactivate();
                    dControls.dispose();
                    selectedObject=null;
                }
            })

            dControls = new DragControls([selectedObject], camera, renderer.domElement);
            dControls.addEventListener('dragstart', ()=>{
                orbit.enabled = false;
                console.log('Ya lo puede mover');
            })
            dControls.addEventListener('dragend', ()=>{
                orbit.enabled = true;
            })

            if (selectedObject) {
                // Obtén la escala del objeto
                const scale = selectedObject.scale;
            
                // Las dimensiones en los ejes x, y, z son:
                const width = selectedObject.geometry.parameters.width * scale.x;
                const height = selectedObject.geometry.parameters.height * scale.y;
                const depth = selectedObject.geometry.parameters.depth * scale.z;
            
                console.log('Ancho: ' + width);
                console.log('Alto: ' + height);
                console.log('Profundidad: ' + depth);
            }

            const colores = [document.getElementById('rojo'), document.getElementById('amarillo'), document.getElementById('coral'), document.getElementById('naranja'), document.getElementById('verdeC'), document.getElementById('verdeO'), document.getElementById('azulC'), document.getElementById('azulO'), document.getElementById('indigo'), document.getElementById('purpura'), document.getElementById('violeta'), document.getElementById('marron'), document.getElementById('blanco'), document.getElementById('gris'), document.getElementById('negro')];
            const materialP = [document.getElementById('madera_balso'), document.getElementById('madera_mdf'), document.getElementById('madera_triplex'), document.getElementById('carton_paja'), document.getElementById('carton_industrial'), document.getElementById('carton_durex'), document.getElementById('carton_duplex'), document.getElementById('carton_canson'), document.getElementById('papel_opalina'), document.getElementById('papel_arana'), document.getElementById('papel_nube')];

            function cambiarColor(color) {
                if (selectedObject) {
                    if (selectedObject.material) {
                        selectedObject.material.color.set(color);
                    }
                }
            }

            const textureLoader = new THREE.TextureLoader();

            function cambiarTextura(urlTexture){

                const newTexture = textureLoader.load(urlTexture)

                if (selectedObject) {
                    if (selectedObject.material.map) {
                        selectedObject.material.map = newTexture;
                        selectedObject.material.needsUpdate = true;
                    } else {
                        selectedObject.material = new THREE.MeshBasicMaterial({ map: newTexture });
                    }
                }
            }

            colores[0].addEventListener('click', ()=>{
                cambiarColor(0xFF0000);
            })
            colores[1].addEventListener('click', ()=>{
                cambiarColor(0xFFFF00);
            })
            colores[2].addEventListener('click', ()=>{
                cambiarColor(0xFF7F50);
            })
            colores[3].addEventListener('click', ()=>{
                cambiarColor(0xFFA500);
            })
            colores[4].addEventListener('click', ()=>{
                cambiarColor(0x32CD32);
            })
            colores[5].addEventListener('click', ()=>{
                cambiarColor(0x008000);
            })
            colores[6].addEventListener('click', ()=>{
                cambiarColor(0x00BFFF);
            })
            colores[7].addEventListener('click', ()=>{
                cambiarColor(0x1E90FF);
            })
            colores[8].addEventListener('click', ()=>{
                cambiarColor(0x4B0082);
            })
            colores[9].addEventListener('click', ()=>{
                cambiarColor(0x800080);
            })
            colores[10].addEventListener('click', ()=>{
                cambiarColor(0x9370DB);
            })
            colores[11].addEventListener('click', ()=>{
                cambiarColor(0x8B4513);
            })
            colores[12].addEventListener('click', ()=>{
                cambiarColor(0xFFFAFA);
            })
            colores[13].addEventListener('click', ()=>{
                cambiarColor(0x808080);
            })
            colores[14].addEventListener('click', ()=>{
                cambiarColor(0x000000);
            })

            materialP[0].addEventListener('click', ()=>{
                cambiarTextura('./texturas/madera_balso.jpg');
            })
            materialP[1].addEventListener('click', ()=>{
                cambiarTextura('./texturas/madera_mdf.jpg');
            })
            materialP[2].addEventListener('click', ()=>{
                cambiarTextura('./texturas/madera_triplex.jpg');
            })
            materialP[3].addEventListener('click', ()=>{
                cambiarTextura('./texturas/carton_paja.jpg');
            })
            materialP[4].addEventListener('click', ()=>{
                cambiarTextura('./texturas/carton_industrial.jpg');
            })
            materialP[5].addEventListener('click', ()=>{
                cambiarTextura('./texturas/carton_durex.jpg');
            })
            materialP[6].addEventListener('click', ()=>{
                cambiarTextura('./texturas/carton_duplex.jpg');
            })
            materialP[7].addEventListener('click', ()=>{
                cambiarTextura('./texturas/carton_canson.jpg');
            })
            materialP[8].addEventListener('click', ()=>{
                cambiarTextura('./texturas/papel_opalina.jpg');
            })
            materialP[9].addEventListener('click', ()=>{
                cambiarTextura('./texturas/papel_arana.png');
            })
            materialP[10].addEventListener('click', ()=>{
                cambiarTextura('./texturas/papel_nube.jpg');
            })

        }
    });

    const finish = document.getElementById('save');
    finish.addEventListener('click', ()=>{
        exportar(scene);
    })

    animate();
}

// Identificadores del objeto cubo
function resetMaterial() {
    for (let i=0; i < register.length; i++) {
        if(register[i].material) {
            register[i].material.opacity = 1.0;
        }
    }
}
function hoverObject() {
    resetMaterial();
    raycaster.setFromCamera(mouse, camera);
    const intersects = raycaster.intersectObjects(register);
    for (let i=0; i < intersects.length; i++ ) {
        intersects[i].object.material.transparent = true;
        intersects[i].object.material.opacity = 0.5;
    }
}

// Renderizador

function animate(){
    hoverObject();
    requestAnimationFrame(animate);
    renderer.render(scene, camera);
}

// Exportador

function exportar(scene){
    const exporter = new GLTFExporter();
    console.log('Exportando');
    exporter.parse(scene, (gltf) => {
        // `gltf` contiene la representación en formato GLTF del modelo
        // Puedes descargarlo como un archivo GLTF
        const gltfBlob = new Blob([JSON.stringify(gltf)], { type: 'model/gltf+json' });
        const url = URL.createObjectURL(gltfBlob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'modelo.gltf';
        a.click();
        URL.revokeObjectURL(url);
      }, {});
}

// Redimensionador de la pantalla

function redimensionar(){
	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();
	renderer.setSize( window.innerWidth, window.innerHeight );
}

// Localizador por coordenadas

function onMouseMove ( event ){
    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = - (event.clientY / window.innerHeight) * 2 + 1;
}

const botonFin = document.getElementById('fin');
const botonCancelar = document.getElementById('cancelar');
botonFin.addEventListener('click', captureScene);
botonCancelar.addEventListener('click', animate);

function captureScene(){
    animate();
    renderAndCapture();
}

function renderAndCapture() {

    renderer.setSize(400, 250);
    // Renderiza la escena
    renderer.render(scene, camera);

    // Captura la representación de la escena como una imagen
    const imageDataURL = renderer.domElement.toDataURL('image/png');

    const originalWidth = window.innerWidth;
    const originalHeight = window.innerHeight;
    renderer.setSize(originalWidth, originalHeight);

    // Crea una nueva imagen en el documento con la imagen capturada
    const imageElement = document.createElement('img');
    imageElement.src = imageDataURL;

    // Agrega la imagen al contenedor en el HTML
    const imageContainer = document.getElementById('maqueta');
    imageContainer.innerHTML = '';
    imageContainer.appendChild(imageElement);
}


window.addEventListener('resize', redimensionar);
window.addEventListener('mousemove', onMouseMove, false);

init();