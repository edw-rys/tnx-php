<?php
// System constants
/* 
    * Saber si estamos de forma local o remota
    * true  -> local
    * false -> remota
*/
define("IS_LOCAL"           , in_array($_SERVER["REMOTE_ADDR"], ['127.0.0.1','::1']));

// Definir el timezone del sistema
date_default_timezone_set('America/Guayaquil');

// Lenguaje
define('LANG'               ,'es');

// Ruta base de nuestro proyecto
define("BASEPATH", IS_LOCAL ? '/template_tnx/' : '___PRODUCTION___');

// Sal del sistema
define('AUTH_SALT'          ,'TNX_UPP_@S5249A6');

// Puerto y URL
define('PORT'               , "81");
define('URL'                , IS_LOCAL ?'http://127.0.0.1:'.PORT.BASEPATH :"__URL_PRODUCTION__");

// Las rutas de directorios y archivos
define('DS'                 , DIRECTORY_SEPARATOR);
define('ROOT'               , getcwd().DS);

define('APP'                , ROOT.'app'.DS);

define('CLASSES'            , APP.'classes'.DS);
define('CONFIG'             , APP.'config'.DS);
define('CONTROLLERS'        , APP.'controllers'.DS);
define('FUNCTIONS'          , APP.'functions'.DS);
define('MODELS'             , APP.'models'.DS);

define('TEMPLATES'          , ROOT.'templates'.DS);
define('INCLUDES'           , TEMPLATES.'includes'.DS);
define('MODULES'            , TEMPLATES.'modules'.DS);
define('VIEWS'              , TEMPLATES.'views'.DS);
define('COMPONENTS'         , TEMPLATES.'components'.DS);

define("HEADER"             , INCLUDES."header.php");
define("FOOTER"             , INCLUDES."footer.php");
define("PANELS"             , COMPONENTS."panels.php");
define("NAVIGATION"         , COMPONENTS."navbar.php");

// Rutas de archivos o assets con base URL
define('ASSETS'             , URL.'assets/');
define('CSS'                , ASSETS.'css/');
define('FAVICON'            , ASSETS.'favicon/');
define('FONTS'              , ASSETS.'fonts/');
define('IMAGES'             , ASSETS.'images/');
define('JS'                 , ASSETS.'js/');
define('PLUGINS'            , ASSETS.'plugins/');
define('UPLOADS'            , ASSETS.'uploads/');
define("ROUTEFILES"         , 'assets/images/products/');

// Credenciales de la base de datos
// Set para conexión local o de desarrollo
define('LDB_ENGINE'         , 'mysql');
define('LDB_HOST'           , 'localhost');
define('LDB_NAME'           , 'products_test');
define('LDB_USER'           , 'root');
define('LDB_PASS'           , 'root');
define('LDB_CHARSET'        , 'utf8');

// Set para conexión en producción o servidor real
define('DB_ENGINE'          , 'mysql');
define('DB_HOST'            , 'localhost');
define('DB_NAME'            , 'products_test');
define('DB_USER'            , '___REMOTE DB___');
define('DB_PASS'            , '___REMOTE DB___');
define('DB_CHARSET'         , '___REMOTE CHARTSET___');

// El controlador por defecto / el método por defecto / y el controlador de errores por defecto
define('DEFAULT_CONTROLLER'      , 'home');
define('DEFAULT_ERROR_CONTROLLER', 'error');
define('DEFAULT_METHOD'          , 'index');
