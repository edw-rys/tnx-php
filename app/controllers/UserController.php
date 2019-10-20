<?php 
class UserController{

    public function __construct(){
    }
    public function index(){}
    public function query(){
        try{
            $users = Db::query("SELECT * from tests",array());
            echo "<pre>";
            print_r($users);
            echo "</pre>";
        }catch(PDOException $e){
            $e->getTrace();
        }
    }
}