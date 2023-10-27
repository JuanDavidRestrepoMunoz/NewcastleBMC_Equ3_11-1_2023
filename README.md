Para el correcto funcionamiento del entorno 3D, es necesario cambiar las configuraciones Apache de XAMPP, se realiza entrando a disco local C, para luego ingresar a la carpeta de XAMPP y posteriormente a Apache, seguido de entrar a la carpeta conf y finalmente abrir el archivo httpd.conf
Dentro del archivo httpd.conf, se busca la sección nombrada "mime_module", para finalmente agrega en su interior AddType text/javascript .js

REALIZAR ESTOS CAMBIOS CON XAMPP SIN INICIAR