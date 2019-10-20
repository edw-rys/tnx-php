<?php
class Tnx{
    // Properties
    private $framework  = "Tnx";
    private $version    = "1.0";
    private $uri        = [];
    
    public function __construct(){
        $this->init();
    }
    /** 
     * Método principal que ejecuta todos los métodos
     * @return void
    */
    private function init(){
        // Todos los métodos a ejecutar
        $this->init_session();
        $this->init_load_config();
        $this->init_load_functions();
        $this->init_autoload();
        $this->dispatch();
        
        return;
    }
    /** 
     * Método principal que ejecuta todos los métodos
     * @return void
    */
    private function init_session(){
        if(!isset($_SESSION)){
            session_start();
        }
        return;
    }
    /**
     * Método para cargar la configuración del sitio
     * 
     * @return void
     */
    private function init_load_config(){
        $FILE = 'tnx_config.php';
        if(!is_file('app/config/'.$FILE)){
            die(sprintf("Archivo no se encuentra, extrictamente requerido para el funcionamiento."));
        }
        require_once 'app/config/'.$FILE;
        return;
    }
    /**
     * Método para cargar las funciones del sistema del usuario
     * 
     */
    private function init_load_functions(){
        $FILE = 'tnx_core_functions.php';
        if(!is_file(FUNCTIONS.$FILE)){
            die(sprintf("Archivo de funciones core no se encuentra, extrictamente requerido para el funcionamiento."));
        }
        // Archivo d efunciones core
        require_once FUNCTIONS.$FILE;

        $FILE = 'custom_functions.php';
        if(!is_file(FUNCTIONS.$FILE)){
            die(sprintf("Archivo de funciones custom no se encuentra."));
        }
        // Archivo d efunciones custom
        require_once FUNCTIONS.$FILE;
        return;
    }
    /**
     * Método para cargar todos los archivos de forma automática
     * 
     * @return void
     */
    private function init_autoload(){
        
        // require_once CLASSES.'Db.php';
        // require_once CLASSES.'Model.php';
        // require_once CLASSES.'View.php';
        // require_once CLASSES.'Controller.php';
        require_once CLASSES.'Autoloader.php';
        Autoloader::init();
        return;
    }

    /**
     * Método para filtrar url
     * 
     * @return void
     */
    private function filter_url(){
        if(isset($_GET['uri'])){
            $this->uri = $_GET['uri'];
            $this->uri = rtrim($this->uri,'/');
            // limpiar str dañinas
            $this->uri = filter_var($this->uri , FILTER_SANITIZE_URL);
            $this->uri = explode('/',strtolower($this->uri));
            return $this->uri ;
        }
        return;
    }
    /**
     * Método para ejecutar y cargar de forma automática el controlador solicitado por el usuario
     * su método y pasar parámetros por él
     */
    private function dispatch(){
        // Filtrar url y separar la URI
        $this->filter_url();
        
        // Controller
        if(isset($this->uri[0])){
            $current_controller = $this->uri[0];
            unset($this->uri[0]);
        }else{
            $current_controller = DEFAULT_CONTROLLER;
        }
        $controller = ucwords($current_controller)."Controller";
        if(!class_exists($controller)){
            $controller = ucwords(DEFAULT_ERROR_CONTROLLER)."Controller";
            $current_controller = DEFAULT_ERROR_CONTROLLER;
        }

        // Method
        if(isset($this->uri[1])){
            $current_method = $this->uri[1];
            $current_method = str_replace('-','_',$current_method);
            
            // isset Method
            $current_method = method_exists($controller, $current_method)?$current_method:DEFAULT_METHOD;
            unset($this->uri[1]);
        }else{
            $current_method = DEFAULT_METHOD;
        }
        define('CONTROLLER',$current_controller);
        define('METHOD',$current_method);
        // Execute controller and method
        $controller = new $controller;
        $params = array_values(empty($this->uri)?[]:$this->uri);
        // llamada al método que solicita el usario
        if(empty($params)){
            call_user_func([$controller , $current_method]);
        }else{
            call_user_func_array([$controller , $current_method] , $params);
        }
        return;
    }

    public static function fly(){
        $tnx = new self();
        return;
    }
}