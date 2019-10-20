<?php
class View{
    public static function render($view , $data=[]){
        // convert array assoc to object
        $obj = to_object($data);
        if(!is_file(VIEWS.CONTROLLER.DS.$view."View.php")){
            die(sprintf("No existe la vista %sView en ela carpeta %s", $view, CONTROLLER));
        }
        require_once HEADER;
        require_once VIEWS.CONTROLLER.DS.$view."View.php";
        require_once FOOTER;
        exit();
    }
}
