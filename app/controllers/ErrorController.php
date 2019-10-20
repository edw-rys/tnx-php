<?php 
class ErrorController{
    public function index() {
        $data=[
            "tittle"=>"Page not found"
        ];
        View::render("404", $data);
    }
}
