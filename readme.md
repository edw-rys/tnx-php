# Tnx Template

_Plantilla de php enfocada en el modelo MVC:_
### MVC
**Modelo: Se enfoca en la manipulación de los datos, conexión con el gestor de base de datos MYSQL.**

**Controlador: Se encarga de comunicar la vista con el modelo.**

**Vista: Es el que muestra la información que generó el controlador luego de comunicarse con el modelo, siempre y la llamada al modelo sea necesaria.**

## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._


### Pre-requisitos 📋

_Que cosas necesitas para el funcionamiento._

```
Cualquier navegador actual.
Un servidor local para conectarse con php. 
Motor de base de datos MySql.
Compilador de archivos scss o sass, puede usar un módulo de nodejs o prepros.
```

## Estructura
**Estructura de carpetas** \
__app__\
_->classes_\
_->config_\
_->controllers_\
_->functions_\
_->models_\
__assets__\
_->css_\
_->favicon_\
_->fonts_\
_->images_\
_->js_\
_->upload_\
_->pluggins_\
__resources__\
_->sass_\
__templates__\
_->components_\
_->includes_\
_->modules_\
_->views_\


__URL__\
http://127.0.0.1:80/Controlador/metodo/parametros_del_controlador/parametro_"
### Y las pruebas de estilo de codificación ⌨️
#### config
_app/config/tnx_config.php_\
_Modifique las constantes necesarias, BASEPATH, PORT, LDB_NAME, LDB_USER, LDB_PASS_\
```php
constantes más importantes
LANG => lenguaje del sistema
URL  => dirección url del sistema web
PORT =>Puerto web, por defecto es el purto 80
MODELS => modelos
HEADER => header HTML
FOOTER => footer HTML
NAVIGATION => NavBar 
IMAGES  => Directorio de imágenes
CSS     => Directorio de archivos css
JS     => Directorio de archivos javascript
ROUTEFILES => directorio de archivos
COMPONENTS => Directorio de componentes
```

#### Controllers
**Nuevo modelo**
```php
class PruebaModel extends Model
{

    public $id;
    public $name;
    public $email;

    public function __construct() {
    }
    /**
     * Método para retornar un producto
     * @return ["class" || "object anonimus" || Index ASSOC]
     */
    public function get($params =null){
        // Función interna de la clase DB
        $params = parent::clearData($params);
        $sql="SELECT ".$params["_sql_params"]." from test ";
        if( !is_null($params["condition"]) ){
            $sql  = $sql . $params["condition"];
        }
        try{
            return parent::sql([
                "sql"           => $sql, //sentencia
                "params"        => $params["params"],
                "type"          => "query",
                "fetch"         => isset($params["fetch"])?$params["fetch"]:null,
                "fetch_type"    => isset($params["fetch_type"])?$params["fetch_type"]:null,
                "class"         => (isset($params["fetch_type"]) && $params["fetch_type"]=="class")?"Prueba":null,
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
    public function insert(){
      $sql = 'INSERT INTO test (name, email, created_at) VALUES (:name, :email, , now())';
        $prueba = 
        [
            'name'          => $this->name,
            'email'         => $this->email,
        ];
      try {
        return ($this->id = parent::sql(
                [
                    "sql"   =>$sql, 
                    "params"=>$prueba,
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
        $sql = 'UPDATE test SET name=:name, email=:email WHERE id=:id';
        $test = 
        [
            'id'              => $this->id,
            'name'            => $this->name,
            'email'           => $this->email,
        ];

        try {
        return parent::sql([
            "sql"       => $sql,
            "type"      => "update",
            "params"    => $test,
        ]);
        } catch (Exception $e) {
            die($e);
        }
    }
    public function delete()
    {
        $sql = 'DELETE from test WHERE id=:id;';
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
```

**Nuevo controlador**
```php
<?php 
// Incluir el modelo
include_once MODELS."PruebaModel.php";
class NewController{
    // Crear un atributo del modelo
    private $model;
    public function __construct() {
        // Inicializar
        $this->model = new PruebaModel();
    }

    // El método index es obligatorio en cada controlador, este es el que se llama por defecto
    public function index() {
        $data=[
            "tittle"=>"Page not found" //título de la pagina
        ];

        View::render("new", $data); //Renderizar vista
    }
    // Para recibir parámetros, estos deben ser enviador en la URL
    public function funcionPruebaGet($data){
        // Comunicación con el modelo
        // query
        $allData = $this->model->get([
            // Parámetros a pasar (opcionales)
            "condition" => "where id=:id",
            "type"      =>"", // {query : default, insert, update, delete}
            "fetch"     =>"one", // {ALL: default, one} All-> obtiene todos los valores, one -> sólo el primero de la consulta a la BD 
            "class"     =>"PruebaModel", // Retorna los datos como objetos de clase
            "fetch_type"=>"obj",// {obj : default, assoc,class} obj-> Retorna los datos como un objeto anónimo, assoc-> retorna los datos con índice asociativo, class -> retorna los datos como objetos de una clase especificada
            "params"    => [] ,//  Parámetros dentro de la sentencia sql
            "_sql_params"=>"" // {*:default , name} -> parámetros a obtener de la sentencia
        ]);
        $data = [
            "title"     =>"Consulta DB",
            "All Data"  => $allData
        ];
        echo json_encode($data); // Uso en caso de llamada con ajax
        View::render("new", $data); //Renderizar vista
    }
    public function insert(){
        // Params -> name , email
        if(isset($_POST["name"]) && isset($_POST["email"])){
            $this->model->name  = $_POST["name"];
            $this->model->email = $_POST["email"];
            // Edición
            if(isset($_POST["id"])){
                $this->model->id = $_POST["id"];
                $value = $this->model->update(); //Return boolean
                if($id>0){
                    $data = [
                        "status"    => "success",
                        "code"      => 200,
                        "message"   => "Editado"
                    ];
                }else{
                    $data = [
                        "status"    => "error",
                        "code"      => 400,
                        "message"   => "Error al editar"
                    ];
                }
            }else{
                $id = $this->model->insert(); //Return id
                if($id>0){
                    $data = [
                        "status"    => "success",
                        "code"      => 200,
                        "message"   => "Guardado"
                    ];
                }else{
                    $data = [
                        "status"    => "error",
                        "code"      => 400,
                        "message"   => "Error al guardar"
                    ];
                }
            }
        }else{
            $data = [
                "status"    => "error",
                "code"      => 400,
                "message"   => "Error de parámetros"
            ];
        }
        echo json_encode($data); // Uso en caso de llamada con ajax
        View::render("new", $data); //Renderizar vista
    }
    public function delete($id=null){
        if(!is_null($id)){
            $this->model->id  = $id;
            $res = $this->delete();
            if($res){
                $data = [
                    "status"    => "success",
                    "code"      => 200,
                    "message"   => "Eliminado"
                ];
            }else{
                $data = [
                    "status"    => "error",
                    "code"      => 400,
                    "message"   => "Error al eliminar"
                ];
            }
        }
        echo json_encode($data); // Uso en caso de llamada con ajax
        View::render("new", $data); //Renderizar vista
    }
}
```
**Nueva vista**
```php
<div>
    <h1>View</h1>
<div>
<?php
    $data["allData"];// datos obtenidos en la consulta
    foreach ($data["allData"] as $value) {
        echo "<p>".$value->name;."</p>"
    }
?>
```

**Uso funciones de php**
_app/functions/tnx_core_functions.php_
```php
to_object($array);// return object anonymous
saveImage("name-input-file");// save image in ROUTEFILES (global variable), return $data_array
generateRandomString($size);// return a random string 
printObj($object); // Print the intended object in the HTML view

// Funciones de clases estáticas
Redirect::to(""); // redirect to index 
Redirect::to("prueba"); // redirect to URL/prueba
DB::sql();              // query to database
View::render("view",$data); // Shows the view located in the current driver folder
```

**Uso funciones de javascript**
```javascript
// Toggle -> add and remove class
toggle("#id","ocultar");
addClass(elementHTML, "class1 class2 class2");
removeClass(elementHTML, "class1 class2 class2");
createElement("a",{"class":"clase",href:"https://google.com"},"Google");
// return element HTML
getHTML("<p>hola</p>")

// Modal
activeModal("<p>Content</p>");
removeModal();
activeModalFree("<p>Content</p>");
cleanModalFree();
viewImage("assets/image/image.jpg")

// Use message with toastr
// This use JQUERY
toastr.error("title","message");
toastr.info("title","message");
toastr.success("title","message");
toastr.warning("title","message");

```
**Uso de estilos con sass**
_resources/sass_\
_Crear un archivo en components_
```scss
.class{
    with: 100%;
    .content{
        background:red;
    }
}
```
_Importar ese archivo en styles.scss_

```scss
@import "components/newComponent";

```
**Uso de estilos con css**
_En el caso de no usar sass, cree un archivo de css en el directorio assets/css e importelo en el archivo de header de php_

**Uso del ejemplo: Módulo productos implementado**
_Encender Apache_
_Importar el archivo db.sql ubicado en la raíz del presente proyecto_
_Dirigirse a la URL 127.0.0.1:SU_PUERTO_WEB/product_
__
## Construido con 🛠️

* [PHP](http://php.net/manual/es/index.php) - Lenguaje de programación del lado del servidor
* [JavaScript](https://developer.mozilla.org/es/docs/Web/JavaScript) - Lenguaje de programación del lado del cliente
* [HTML 5](https://developer.mozilla.org/es/docs/HTML/HTML5) - Lenguaje de enmarcado
* [CSS 3](https://developer.mozilla.org/es/docs/Archive/CSS3) - Lenguaje de hojas de estilos
* [SASS](https://sass-lang.com/) - Preprocesador de css
* [MySql](https://www.mysql.com/) - Motor de base de datos

## Autor ✒️

* **Edward Reyes** - [edw-rys](https://github.com/edw-rys)
---
## Screenshot Example

![alt text](https://raw.githubusercontent.com/edw-rys/template_tnx/master/assets/images/screenshot/picture_1.png)
![alt text](https://raw.githubusercontent.com/edw-rys/template_tnx/master/assets/images/screenshot/picture_2.png)
![alt text](https://raw.githubusercontent.com/edw-rys/template_tnx/master/assets/images/screenshot/picture_3.png)
![alt text](https://raw.githubusercontent.com/edw-rys/template_tnx/master/assets/images/screenshot/picture_4.png)
![alt text](https://raw.githubusercontent.com/edw-rys/template_tnx/master/assets/images/screenshot/picture_5.png)