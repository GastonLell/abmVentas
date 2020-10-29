<?php
include_once "config.php";

class TipoProducto{
    private $idtipoproducto;
    private $nombre;
    

    public function __construct(){

    }
    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function cargarFormulario($request){
        $this->nombre = isset($request['txtNombre']) ? $request['txtNombre'] : "";
    }
    public function insertar(){

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $sql = $mysqli->query("INSERT INTO tipoproducto (nombre) VALUES('$this->nombre')");

        if(!$sql){
            printf("Error en la consulta a base de datos" .$sql);
        }
        $this->idtipoproducto = $mysqli->insert_id;

        $mysqli->close();
    }
    public function actualizar(){

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $sql = $mysqli->query(
            "UPDATE tipoproducto SET
            nombre = '$this->nombre'
            WHERE $idtipoproducto = " .$this->idtipoproducto
        );
        
        if(!$sql) {
            printf("Error en query:  %s\r", $mysqli->error . " " . $sql);
        }
    
        $mysqli->close();

    }
    public function eliminar(){

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $sql = $mysqli->query(
            "DELETE FROM tipoproducto WHERE idtipoproducto = " .$this->idtipoproducto
        );

        
        if(!$sql) {
            printf("Error en query:  %s\r", $mysqli->error . " " . $sql);
        }
    
        $mysqli->close();

    }
    public function obtenerPorId(){

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $resultado = $mysqli->query(
            "SELECT idtipoproducto, nombre FROM tipoproducto
            WHERE idtipoproducto = " .$this->idtipoproducto
        );
        if(!$resultado){
            printf("Error en query: %\r", $mysqli->error . " " .$resultado);
        }
        if($fila = $resultado->fetch_assoc()){
            $this->idtipoproducto = $fila['idtipoproducto'];
            $this->nombre = $fila['nombre'];
        }
        $mysqli->close();
    }
    public function obtenerTodos(){
        $aTipoProductos = null;

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $resultado = $mysqli->query(
            "SELECT idtipoproducto, nombre FROM tipoproducto"
        );
        if($resultado){
            while($fila = $resultado->fetch_assoc()){
                $obj = new TipoProducto();
                $obj->idtipoproducto = $fila['idtipoproducto'];
                $obj->nombre = $fila['nombre'];
                $aTipoProductos[] = $obj;
            }
        }
        return $aTipoProductos;

    }

}
