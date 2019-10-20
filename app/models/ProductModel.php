<?php 

class ProductModel extends Model
{

    public $id;
    public $name;
    public $type;
    public $description;
    public $url_image;
    public $created_at;
    public $updated_at;
    public function __construct() {
    }
    /**
     * Método para retornar un producto
     * @return ["class" || "object anonimus" || Index ASSOC]
     */
    public function get($params =null){
        $params = parent::clearData($params);
        $sql="SELECT ".$params["_sql_params"]." from product inner join type_product as t on t.id_type = product.type_id ";
        if( !is_null($params["condition"]) ){
            $sql  = $sql . $params["condition"];
        }
        try{
            return parent::sql([
                "sql"           => $sql,
                "params"        => $params["params"],
                "type"          => "query",
                "fetch"         => isset($params["fetch"])?$params["fetch"]:null,
                "fetch_type"    => isset($params["fetch_type"])?$params["fetch_type"]:null,
                "class"         => (isset($params["fetch_type"]) && $params["fetch_type"]=="class")?"Product":null,
            ]);
        }catch(Exception $ex){
            die($ex);
        }
    }    
    /**
     * Método para agregar un nuevo producto
     *
     * @return integer
     */
    public function add(){
      $sql = 'INSERT INTO product (name, type_id, description, url_image, created_at) VALUES (:name, :type_id, :description, :url_image, now())';
        $product = 
        [
            'name'          => $this->name,
            'type_id'       => $this->type,
            'description'   => $this->description,
            'url_image'     => $this->url_image,
        ];
      try {
        return ($this->id = parent::sql(
                [
                    "sql"   =>$sql, 
                    "params"=>$product,
                    "type"  =>"insert"
                ]
                )) ? $this->id : false;
      } catch (Exception $ex) {
            die($ex);
      }
    }

  /**
   * Método para actualizar un registor en la db
   *
   * @return bool
   */
    public function update()
    {
        $sql = 'UPDATE product SET name=:name, type_id=:type_id, url_image=:url_image ,description=:description WHERE id=:id';
        $product = 
        [
            'id'              => $this->id,
            'name'            => $this->name,
            'description'     => $this->description,
            'type_id'            => $this->type,
            'url_image'     => $this->url_image,
        ];

        try {
        return parent::sql([
            "sql"       => $sql,
            "type"      => "update",
            "params"    => $product,
        ]);
        } catch (Exception $e) {
            die($e);
        }
    }
    public function delete()
    {
        $sql = 'DELETE from product WHERE id=:id;';
        $params = [
            "sql"       => $sql,
            'params'    => ["id"=>$this->id],
            "type"      => "delete"
        ];

        try {
        return parent::sql($params);
        } catch (Exception $e) {
        throw $e;
        }
    }
}