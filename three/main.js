import * as THREE from 'three';
import * as three from './three.module.js';
import {OrbitControls} from './OrbitControls.js';

var scene = new THREE.Scene();
//scene.background = new THREE.Color(0x666666)
var camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );

var renderer = new THREE.WebGLRenderer({alpha: true});
renderer.setSize( window.innerWidth, window.innerHeight );
document.body.appendChild( renderer.domElement );

// CUBO
var geometry = new THREE.BoxGeometry( 10, 10, 10 );
var material = new THREE.MeshStandardMaterial();
var cube = new THREE.Mesh( geometry, material );
cube.position.set(0 ,20 ,0);
cube.castShadow = true;
scene.add( cube );

//ESFERA
var geometry = new THREE.SphereGeometry( 2, 32, 32, 0 );
var material = new THREE.MeshStandardMaterial();
var esfera = new THREE.Mesh( geometry, material );
esfera.position.set(3 ,5 ,0);
esfera.castShadow = true;
scene.add( esfera );

// LUZ
var light = new THREE.DirectionalLight(0xffffff, 1, 100);
light.position.set(-1, 2, 2);
light.castShadow = true;
scene.add(light);

var grid = new THREE.GridHelper(100, 100);
scene.add(grid);

// PLANO
var planeGeometry = new THREE.PlaneGeometry(20, 20, 32, 32);
var planeMaterial = new THREE.MeshStandardMaterial();
var plane = new THREE.Mesh(planeGeometry, planeMaterial);
plane.receiveShadow = true;
plane.castShadow = true;
plane.position.set(0, 0, 0);
plane.rotation.x = -1.56789;
scene.add(plane);

camera.position.z = 10;
camera.rotation.z = 0;
camera.position.y = 1;
camera.rotation.y = 0;
camera.position.x = 1;
camera.rotation.x = 0;

const controls = new OrbitControls(camera, renderer.domElement);

const loader = new THREE.TextureLoader();
loader.load('frionel.jpeg', (texture) => {
    material.map = texture
	render();
});

// ACTUALIZAR PÁGINA
window.addEventListener('resize', redimensionar);
function redimensionar(){
	camera.aspect = window.innerWidth / window.innerHeight;
	camera.updateProjectionMatrix();
	renderer.setSize( window.innerWidth, window.innerHeight );
	renderer.render(scene, camera);
}

function render() {
	requestAnimationFrame(render);
	renderer.render(scene, camera);
}