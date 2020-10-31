<?php
include_once "config.php";

class Venta {
    private $idventa;
    private $fk_idcliente;
    private $fk_idproducto;
    private $fecha;
    private $hora;
    private $fechaCon;
    private $cantidad;
    private $precioUnitario;
    private $total;
    

    public function __construct(){

    }
    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function cargarFormulario($request){
        $this->fk_idcliente = isset($request['lstCliente']) ? $request['lstCliente'] : "";
        $this->fk_idproducto = isset($request['lstProducto']) ? $request['lstProducto'] : "";
        $this->fecha = isset($request['txtFecha']) ? $request['txtFecha'] : "";
        $this->hora = isset($request['txtHora']) ? $request['txtHora'] : "";
        $this->fechaCon = $this->fecha . " " .$this->hora;
        $this->cantidad = isset($request['txtCantidad']) ? $request['txtCantidad'] : "";
        $this->precioUnitario = isset($request['txtPrecioUni']) ? $request['txtPrecioUni'] : "";
        $this->total = isset($request['txtTotal']) ? $request['txtTotal'] : "";
    }

    public function insertar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);
        
        $sql = $mysqli->query(
            "INSERT INTO ventas (
            fk_idcliente,
            fk_idproducto,
            fecha,
            cantidad,
            preciounitario,
            total )
            VALUES (
            '" . $this->fk_idcliente ."',
            '" . $this->fk_idproducto ."',
            '" . $this->fechaCon ."',
            '" . $this->cantidad ."',
            '" . $this->precioUnitario ."',
            '" . $this->total ."'
        );"
        );


        if(!$sql) {
            printf("Error en query:  %s\r", $mysqli->error . " " . $sql);
        }
        $this->idventa = $mysqli->insert_id;

        $mysqli->close();
    }
    public function actualizar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $sql = $mysqli->query(
            "UPDATE ventas SET
            fk_idcliente = '$this->fk_idcliente',
            fk_idproducto = '$this->fk_idproducto',
            fecha = '$this->fechaCon',
            cantidad = '$this->cantidad',
            preciounitario = '$this->precioUnitario',
            total = '$this->total'
            WHERE idventa = '$this->idventa'
            "
        );

        if(!$sql) {
            printf("Error en query:  %s\r", $mysqli->error . " " . $sql);
        }

        $mysqli->close();

    }
    public function eliminar(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $sql = $mysqli->query(
            "DELETE FROM ventas WHERE idventa = '$this->idventa' "
        );

        if(!$sql){
            printf("Error en query: %s\r", $mysqli->error . " " . $sql);
        }

        $mysqli->close();

    }
    public function obtenerPorId(){
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $resultado = $mysqli->query("
        SELECT idventa, fk_idcliente, fk_idproducto, fecha, cantidad, preciounitario, total
        FROM ventas
        WHERE idventa = " .$this->idventa
        );

        if(!$resultado){
            printf("Error en query: %s\r", $mysqli->error . " " . $sql);
        }
        if($fila = $resultado->fetch_assoc()){
            $this->idventa = $fila['idventa'];
            $this->fk_idcliente = $fila['fk_idcliente'];
            $this->fk_idproducto = $fila['fk_idproducto'];
            $this->fecha = $fila['fecha'];
            $this->cantidad = $fila['cantidad'];
            $this->precioUnitario = $fila['preciounitario'];
            $this->total = $fila['total'];
        }
        
        $mysqli->close();
    }
    public function obtenerTodos(){
        $aVentas = null;

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        $resultado = $mysqli->query(
            "SELECT 
                A.idventa,
                A.fecha,
                A.preciounitario,
                A.fk_idcliente,
                A.cantidad,
                A.total,
                B.nombre AS nombre_cliente,
                A.fk_idproducto,
                C.nombre AS nombre_producto
            FROM ventas A
            INNER JOIN clientes B ON B.idcliente = A.fk_idcliente
            INNER JOIN productos C ON C.idproducto = A.fk_idproducto"
        );

        if(!$resultado){
            printf("Error en query: %s\r", $mysqli->error . " " . $resultado);
        }

        while($fila = $resultado->fetch_assoc()){
            $obj = new Venta;
            $obj->idventa = $fila['idventa'];
            $obj->fk_idclietne = $fila['fk_idcliente'];
            $obj->fk_idproducto = $fila['fk_idproducto'];
            $obj->cantidad = $fila['cantidad'];
            $obj->preciounitario = $fila['preciounitario'];
            $obj->nombre_cliente = $fila['nombre_cliente'];
            $obj->nombre_producto = $fila['nombre_producto'];
            $obj->total = $fila['total'];
            $aVentas[] = $obj;
        }
        return $aVentas;
    }
    public function obtenerVentasClientes($id){
        $cantidad = 0;

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);


        $sql =  "select COUNT(*) as cantidad FROM ventas WHERE fk_idcliente = $id ";
        

        if(!$resultado = $mysqli->query($sql)){
            printf("Error en query: %s\r", $mysqli->error . " " . $sql);
        }

        if($fila = $resultado->fetch_assoc()){
            $cantidad = $fila['cantidad'];
        }
        
        $mysqli->close();

        return $cantidad;
    }
    public function obtenerProductosEnVenta($id){
        $cantidad = 0;

        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);


        $sql =  "select COUNT(*) as cantidad FROM ventas WHERE fk_idproducto = $id ";
        

        if(!$resultado = $mysqli->query($sql)){
            printf("Error en query: %s\r", $mysqli->error . " " . $sql);
        }

        if($fila = $resultado->fetch_assoc()){
            $cantidad = $fila['cantidad'];
        }
        
        $mysqli->close();

        return $cantidad;
    }
    public function descontarStock($id, $cantidad){
        // conectar con base de datos
        $mysqli = new mysqli(Config::BBDD_HOST, Config::BBDD_USUARIO, Config::BBDD_CLAVE, Config::BBDD_NOMBRE);

        // solicitar la cantidad actual
        $cantidadStock = $mysqli->query("SELECT cantidad FROM productos WHERE idproducto = $id");
        
        // convierto la cantidad solicitada en un array
        $fila = $cantidadStock->fetch_assoc();

        // restar la cantidad de la venta de la actual
        $cantidadDevolver = $fila['cantidad'] - $this->cantidad;

        // actualizar la cantidad de los productos
        $mysqli->query("UPDATE productos SET cantidad = '$cantidadDevolver' WHERE idproducto = $id");

        
        $mysqli->close();
    }
}


?>