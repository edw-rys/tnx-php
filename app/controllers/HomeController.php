<?php
class HomeController {
    public function __construct() {}
    
    public function index(){
        $data=[
            "title"=>"Inicio"
        ];
        View::render("home", $data);
    }

    public function static($page="home"){
        $data=[
            "title"=>$page
        ];
        View::render($page, $data);
    }
}
