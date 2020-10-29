<?php 
include_once "config.php";
include_once "entidades/producto.php";


$productos = new Producto();
$aProductos = $productos->obtenerTodos();
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
          
          <h2 class="h3 bt-3 text-gray-800 mb-4">Listado de productos</h2>
          
          <div class="mb-3 col-12 pl-0">
            <a href="producto-formulario.php" class="btn btn-primary">Nuevo</a>
          </div>
          <div>
          <table class="table table-hover border">
            <thead>
              <tr>
                <th scope="col">Foto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($aProductos as $producto):  ?>
              <tr>
                <td>
                  <img src="img/<?= $producto->imagen ?>" style="width: 100px;" class="img-thumbnail">
                </td>
                <td><?php echo $producto->nombre ?></td>
                <td><?php echo $producto->cantidad ?></td>
                <td><?php echo $producto->precio ?></td>
                <td style="width: 110px;">
                  <a href="producto-formulario.php?id=<?php echo $producto->idproducto ?>"><i class="fas fa-search"></i></a>   
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