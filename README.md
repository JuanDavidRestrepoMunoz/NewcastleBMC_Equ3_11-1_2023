Para el correcto funcionamiento del entorno 3D, es necesario cambiar las configuraciones Apache de XAMPP, se realiza entrando a disco local C, para luego ingresar a la carpeta de XAMPP y posteriormente a Apache, seguido de entrar a la carpeta conf y finalmente abrir el archivo httpd.conf
Dentro del archivo httpd.conf, se busca la sección nombrada "mime_module", para finalmente agrega en su interior AddType text/javascript .js

REALIZAR ESTOS CAMBIOS CON XAMPP SIN INICIAR

Para cargar imagenes pesadas debe seguir los siguientes pasos:

Abre el archivo de configuración de MySQL (my.ini o my.cnf) en tu entorno XAMPP. Puedes encontrar este archivo en la carpeta de configuración de MySQL en XAMPP.

Busca la sección que contiene la configuración de max_allowed_packet.

Aumenta el valor de max_allowed_packet a un número mayor. Por ejemplo, puedes configurarlo en 16M para permitir paquetes de hasta 16 megabytes