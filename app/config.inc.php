<?php
//info de la base de datos
define('NOMBRE_SERVIDOR', 'localhost');
define('NOMBRE_USUARIO', 'root');
define('PASSWORD', 'toor');
define('NOMBRE_BD', 'helpus');

//rutas de la web
define("SERVIDOR", "http://localhost/");
define("INICIO",SERVIDOR."inicio.php");
define("PERFIL",SERVIDOR."perfil.php");

//recursos
define("RUTA_CSS", SERVIDOR . "/css/");
define("RUTA_JS", SERVIDOR . "/js/");
define("RUTA_IMAGES", SERVIDOR . "/css/images/");
define("DIRECTORIO_RAIZ", realpath(dirname(__FILE__)."/..")); //para php < 5.3
// realpath(__DIR__."/..") para php 5.3+
