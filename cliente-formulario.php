<?php

include_once('config.php');
include_once('entidades/cliente.php');

$cliente = new Cliente();
$cliente->cargarFormulario($_REQUEST);

if($_POST){
  if(isset(($_POST["btnGuardar"]))){
    if(isset($_GET['id']) && $_GET['id'] > 0){
      $cliente->actualizar();
      $mensajeCorrecto = "Cliente actualizado correctamente";
    } else {
      $cliente->insertar();
    } 
  }else if(isset($_POST["btnBorrar"])){
    $cliente->eliminar();
  }
}
if(isset($_GET['id']) && $_GET['id'] > 0){
  $cliente->idcliente = $_GET['id'];
  $cliente->obtenerPorId();
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

  <title>Edición de cliente</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">
  <form action="" method="POST" enctype="multipart/form-date">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include('menu.php') ?>

    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include('navbar.php') ?>

        <div class="pl-4">
          <h2 class="h3 bt-3 text-gray-800 mb-4">Cliente</h2>
        </div>
        <div class="botones-crud ml-4 mb-3">
          <a href="clientes.php" class="mr-2 btn btn-primary">Listado</a>
          <button class="mr-2 btn btn-primary">Nuevo</button>
          <button name="btnGuardar" type="submit" id="btnGuardar"class="mr-2 btn btn-success">Guardar</button>
          <button name="btnBorrar" class="btn btn-danger">Borrar</button>
        </div>
          
        <div class="row px-4">
          <div class="form-group col-12 col-sm-6">
            <label for="txtNombre" class="text-muted">Nombre:</label>
            <input type="text" class="form-control" id="txtNombre"  name="txtNombre"
              value="<?= $cliente->nombre ?>" required>
          </div>
          <div class="form-group col-12 col-sm-6">
            <label for="txtCuit" class="text-muted">CUIT:</label>
            <input type="text" class="form-control" id="txtCuit" name="txtCuit" 
            value="<?= $cliente->cuit ?>"
            required maxlength="11">
          </div>
          <div class="form-group col-12 col-sm-6">
            <label for="txtFechaNac" class="text-muted">Fecha de nacimiento:</label>
            <input type="date" class="form-control" id="txtFechaNac" name="txtFechaNac"
            value="<?= $cliente->fecha_nac ?>"
            >
          </div>
          <div class="form-group col-12 col-sm-6">
            <label for="txtTelefono" class="text-muted">Teléfono:</label>
            <input type="text" class="form-control" id="txtTelefono" name="txtTelefono"
            value="<?= $cliente->telefono ?>"
            >
          </div>
          <div class="form-group col-12 col-sm-6">
            <label for="txtCorreo" class="text-muted">Correo:</label>
            <input type="email" class="form-control" id="txtCorreo" name="txtCorreo" 
            value="<?= $cliente->correo ?>"
            required>
          </div>

        </div>
        <?php if(isset($mensajeCorrecto)) : ?>
          <div class="alert alert-success" role="alert">
            <?= $mensajeCorrecto ?>
          </div>
        <?php endif ?>


      </div>

    </div>

  </div>

  </form>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  
</body>
</html>