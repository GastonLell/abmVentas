<?php
include_once "config.php";
include_once "entidades/venta.php";
include_once "entidades/cliente.php";
include_once "entidades/producto.php";

$venta = new Venta();
$venta->cargarFormulario($_REQUEST);

$cliente = new Cliente();
$listadoClientes = $cliente->obtenerTodos();

$producto = new Producto();
$listaProductos = $producto->obtenerTodos();
if($_POST){
  if(isset($_POST['btnGuardar'])){
    if(isset($_GET['id']) && $_GET['id'] > 0){
      $venta->actualizar();
    } else {
      $venta->insertar();
      $venta->descontarStock($venta->fk_idproducto, $venta->cantidad);
    }
  } else if(isset($_POST['btnBorrar'])){
    $venta->eliminar();
  }
}

if(isset($_GET['id']) && $_GET['id'] > 0){
  $venta->idventa = $_GET['id'];
  $venta->obtenerPorId();

}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edición de venta</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include_once('menu.php') ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include_once('navbar.php') ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div>
            <h2 class="h3 bt-3 text-gray-800 mb-4">Venta</h2>
          </div>
          <form action="" method="POST" enctype="multipart/form-date">

            <div class="mb-3">
              <a href="ventas.php" class="mr-2 btn btn-primary">Listado</a>
              <a href="venta-formulario.php" class="mr-2 btn btn-primary">Nuevo</a>
              <button name="btnGuardar" class="mr-2 btn btn-success">Guardar</button>
              <button name="btnBorrar" class="btn btn-danger">Borrar</button>
            </div>
            
            <div class="row">
              <div class="form-group col-sm-6 col-12">
                <label for="txtFecha">Fecha: </label>
                <input type="date" id="txtFecha" name="txtFecha" class="form-control" 
                value="<?php echo isset($_GET['id']) ? date('Y-m-d', strtotime($venta->fecha)) : '' ?>"
                required>
              </div>
              <div class="form-group col-sm-6 col-12">
                <label for="txtHora">Hora: </label>
                <input type="time" id="txtHora" name="txtHora" class="form-control" 
                value="<?php echo isset($_GET['id']) ? date('H:i', strtotime($venta->hora)) : '' ?>"
                required>
              </div>
              <div class="form-group col-12 col-sm-6 ">
                <label for="lstCliente">Cliente: </label>
                <select name="lstCliente" id="lstCliente" class="selectpicker form-control" data-live-search="true" required>
                  <option value="" <?= isset($_GET['id']) ? '' : 'selected' ?>>Seleccionar</option>

                  <?php foreach($listadoClientes as $lista): ?>
                    <option value="<?= $lista->idcliente ?>"
                      <?php echo isset($_GET['id']) ? 'selected' : '' ?>
                      ><?= $lista->nombre ?>
                    </option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group col-12 col-sm-6 ">
                <label for="lstProducto">Producto: </label>
                <select name="lstProducto" id="lstProducto" class="selectpicker form-control" data-live-search="true" required>
                  <option value="" <?= isset($_GET['id']) ? "" : "selected" ?>>Seleccionar</option>
                  
                  <?php foreach($listaProductos as $lista) : ?>
                  <option <?= isset($_GET['id']) ? 'selected' : '' ?>
                  value="<?= $lista->idproducto ?>"><?= $lista->nombre ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group col-12 col-sm-6">
                <label for="txtPrecioUni">Precio unitario: </label>
                <input type="number" id="txtPrecioUni" name="txtPrecioUni" class="form-control"
                 value="<?= isset($_GET['id']) ? $venta->precioUnitario : 0 ?>" 
                 required>
              </div>
              <div class="form-group col-12 col-sm-6">
                <label for="txtCantidad">Cantidad: </label>
                <input type="number" id="txtCantidad" name="txtCantidad" class="form-control" 
                value="<?= (isset($_GET['id'])) ? $venta->cantidad : 0 ?>" 
                required>
              </div>
              <div class="form-group col-12 col-sm-6">
                <label for="txtTotal">Total: </label>
                <input type="number" id="txtTotal" name="txtTotal" class="form-control"
                value="<?= (isset($_GET['id'])) ? $venta->total : 0 ?>" 
                required>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- select bootstrap -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>


</body>

</html>
