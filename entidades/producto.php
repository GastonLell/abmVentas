<?php
include_once "config.php";

class Producto{
    private $idproducto;
    private $nombre;
    private $cantidad;
    private $precio;
    private $imagen;
    private $fk_idtipoproducto;
    private $descripcion;

    public function __construct(){
        
    }
    public function __get($atributo){
        return $this->$atributo;
    }
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function cargarFormulario($request){
        $this->idproducto = isset($request['id']) ? $request['id'] : "";
        $this->nombre = isset($request['txtNombre']) ? $request['txtNombre'] : "";
        $this->cantidad = isset($request['txtCantidad']) ? $request['txtCantidad'] : "";
        $this->precio = isset($request['txtPrecio']) ? $request['txtPrecio'] : "";
        $this->descripcion = isset($request['txtDescripcion']) ? $request['txtDescripcion'] : "";
        $this->fk_idtipoproducto = isset($request['lstTipoProducto']) ? $request['lstTipoProducto'] : "";

        if(isset($_FILES['archivo'])){
            if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){ 
                $nombreAleatorio = date("Ymdhmsi"); 
                $archivo_tmp = $_FILES["archivo"]["tmp_name"]; 
                $nombreArchivo = $_FILES["archivo"]["name"]; 
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                $nombreImagen = $nombreAleatorio . "." .$extension; 
                move_uploaded_file($archivo_tmp, "img/$nombreImagen");
                $this->imagen = $nombreImagen;
            }
        }
        
    }
    public function insertar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $sql = "INSERT INTO productos (
            nombre,
            cantidad,
            precio,
            descripcion,
            imagen,
            fk_idtipoproducto
        ) VALUES (
            '" . $this->nombre ."',
            '" . $this->cantidad ."',
            '" . $this->precio ."',
            '" . $this->descripcion ."',
            '" . $this->imagen ."',
            '" . $this->fk_idtipoproducto ."'
        ); ";


        if(!$mysqli->query($sql)) {
            printf("Error en query:  %s\r", $mysqli->error . " " . $sql);
        }

        $this->idproducto = $mysqli->insert_id;

        $mysqli->close();

    }

    public function actualizar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $sql = "UPDATE productos SET
        nombre = '" . $this->nombre ."',
        cantidad = '" . $this->cantidad ."',
        precio = '" . $this->precio ."',
        descripcion = '" . $this->descripcion ."',
        fk_idtipoproducto = '" . $this->fk_idtipoproducto ."'
        WHERE idproducto = " . $this->idproducto;

        if(!$mysqli->query($sql)) {
            printf("Error en query:  %s\r", $mysqli->error . " " . $sql);
        }

        $mysqli->close();
    }

    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $sql = "DELETE FROM productos WHERE idproducto = " . $this->idproducto;

        if(!$mysqli->query($sql)){
            printf("Error en query: %s\r", $mysqli->error . " " . $sql);
        }
        $mysqli->close();
    }

    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $resultado = $mysqli->query(
            "SELECT idproducto, nombre, cantidad, precio, descripcion, imagen, fk_idtipoproducto
            FROM productos
            WHERE idproducto = " .$this->idproducto 
        );

        if(!$resultado){
            printf("Error en query: %s\r", $mysqli->error . " " . $resultado);
        }
        if($fila = $resultado->fetch_assoc()){
            $this->idproducto = $fila['idproducto'];
            $this->nombre = $fila['nombre'];
            $this->cantidad = $fila['cantidad'];
            $this->precio = $fila['precio'];
            $this->descripcion = $fila['descripcion'];
            $this->fk_idtipoproducto = $fila['fk_idtipoproducto'];    
        }
        
        $mysqli->close();

    }

    public function obtenerTodos(){
        $aProductos = null;

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $resultado = $mysqli->query(
            "SELECT idproducto, nombre, cantidad, precio, descripcion, imagen, fk_idtipoproducto
            FROM productos"
        );
        if(!$resultado){
            printf("Error en query %s/r", $mysqli->error ." " .$sql);
        }
    
        if($resultado){
            while($fila = $resultado->fetch_assoc()){
                $obj = new Producto();
                $obj->idproducto = $fila["idproducto"];
                $obj->nombre = $fila["nombre"];
                $obj->cantidad = $fila["cantidad"];
                $obj->precio = $fila["precio"];
                $obj->descripcion = $fila["descripcion"];
                $obj->imagen = $fila["imagen"];
                $obj->fk_idtipoproducto = $fila["fk_idtipoproducto"];
                $aProductos[] = $obj;
            }
            return $aProductos;
        }
    }
   
}

?>