<?php 
include_once "config.php";
include_once "entidades/venta.php";


$venta = new Venta();
$aVenta = $venta->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Listado de productos</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <?php include('menu.php') ?>

    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <?php include('navbar.php') ?>

        <div class="container-fluid">
          
          <h2 class="h3 bt-3 text-gray-800 mb-4">Listado de ventas</h2>
          
          <div class="mb-3 col-12 pl-0">
            <a href="venta-formulario.php" class="btn btn-primary">Nuevo</a>
          </div>
          <div>
          <table class="table table-hover border">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Cantidad</th>
                    <th>Producto</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($aVenta as $venta): ?>
                  <tr>
                    <td><?= date_format(date_create($venta->fecha), "d/m/Y H:i") ?></td>
                    <td><?= $venta->cantidad ?></td>
                    <td><?= $venta->nombre_producto ?></td>
                    <td><?= $venta->nombre_cliente ?></td>
                    <td><?= number_format($venta->total, 2, ",", ".") ?></td>
                    <td style="width: 110px;">
                      <a href="venta-formulario.php?id=<?= $venta->idventa?>"><i class="fas fa-search"></i></a>   
                    </td>
                  </tr>
                <?php endforeach ?>

            </tbody>

          </table>

          </div>

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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>
  
</body>
</html>