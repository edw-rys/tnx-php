<?php 
include_once MODELS."ProductModel.php";
class ProductController{
    private $productModel ;
    public function __construct(){
        $this->productModel = new ProductModel();
    }
    public function index(){
        $data =[
            "title"     =>"Productos",
            "products"  => $this->productModel->get(),
        ];
        // printObj($data);
        View::render("products", $data);
    }
    public function view($id=0,$type="show"){
        $data = $this->queryById($id);
        if($type =="show"){
            include_once COMPONENTS."product/showProduct.php";
        }
        else if ($type =="get") {
            $data["products"]=[$data["product"]];
            include_once COMPONENTS."product/bodyTable.php";
        }
    }
    public function queryById($id=0){
        $data =[
            "title"     =>"Productos",
            "product"  => $this->productModel->get(["params"=>["id"=>$id], "condition" => "where id=:id","fetch"=>"one"]),
        ];
        return $data;
    }
    public function query($value=""){
        $data = [
            "title" => "Productos"
        ];
        if(!is_null($value)){
            $data =[
                "products" => $this->productModel->get([
                                "params"=>["value"=>$value] , 
                                "condition"=>"where name like concat('%',:value,'%');"
                                ]),
                "title" => "Productos"
            ];
        }
        include_once COMPONENTS."product/headerTable.php";
        include_once COMPONENTS."product/bodyTable.php";
        // echo json_encode($data);
    }
    public function new($id=null){
        $data = [
            "typesProduct"=> Model::sql(["sql"=>"select * from type_product;","params"=>[]]),
            "title" => "Productos",
            
        ];
        if(!is_null($id)){
            $data ["product"] = $this->productModel->get([
                                "params"=>["id"=>$id] , 
                                "condition"=>"where id=:id;",
                                "fetch"=>"one"
                                ]);
        }
        include_once COMPONENTS."product/formProduct.php";
    }
    public function insert(){
        if( isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["type"])){
            $this->productModel->name        = $_POST["name"];
            $this->productModel->type        = $_POST["type"];
            $this->productModel->description = $_POST["description"];
            if(isset($_POST["id"])){
                $this->productModel->id = $_POST["id"];
                $data = saveImage('image');
                $error = false;
                // var_dump($data);
                if($data["status"]=="success"){
                    $this->productModel->url_image = $data["url"];
                }else{
                    if(isset($_REQUEST['image-edit']) && !is_null($_REQUEST['image-edit'])){
                        $this->productModel->url_image = $_REQUEST['image-edit'];
                    }else{
                        $error = true;
                    }
                }
                // echo $this->productModel->url_image;
                // die();
                if(!$error){
                    $res = $this->productModel->update();
                    if($res){
                        $data = [
                            "status"    => "success",
                            "code"      => 200,
                            "message"   =>"Producto editado",
                            "id"        => $this->productModel->id
                        ];
                    }else{
                        $data = [
                            "status"    => "error",
                            "code"      => 400,
                            "message"   =>"No se pudo editar"
                        ];
                    }
                }
            }else{
                $data = saveImage('image');
                if($data["status"]=="success"){
                    $this->productModel->url_image = $data["url"];
                    $id = $this->productModel->add();
                    if($id){
                        $data = [
                            "status"    => "success",
                            "code"      => 200,
                            "message"   =>"Producto guardado",
                            "id"        => $id
                        ];
                    }else{
                        $data = [
                            "status"    => "error",
                            "code"      => 400,
                            "message"   =>"No se pudo Guardar"
                        ];
                    }
                }
            }
        }else{
            $data = [
                "status"    => "error",
                "code"      => 400,
                "message"   =>"Complete los datos"
            ];
        }
        echo json_encode($data);
    }

    public function delete($id=null){
        if(!is_null($id)){
            $this->productModel->id = $id;
            $res = $this->productModel->delete();
            if($res){
                $data = [
                    "status"    => "success",
                    "code"      => 200,
                    "message"   =>"Producto eliminado",
                ];
            }else{
                $data = [
                    "status"    => "error",
                    "code"      => 400,
                    "message"   =>"No se pudo editar"
                ];
            }
        }else{
            $data=[
                "status"    => "error",
                "code"      => 400,
                "message"   => "Error"
            ];
        }
        echo json_encode($data);
    }
}