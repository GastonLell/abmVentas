<?php
include_once "config.php";
include_once "entidades/producto.php";
include_once "entidades/tipoproducto.php";
include_once('entidades/venta.php');

$venta = new Venta();

$producto1 = new Producto();
$producto1->cargarFormulario($_REQUEST);

$tipoProducto = new TipoProducto();
$tipos = $tipoProducto->obtenerTodos();

if($_POST){
  if(isset($_POST['btnGuardar'])){
    if(isset($_GET['id']) && $_GET['id'] > 0){
      $producto1->actualizar();
      $mensaje = "Producto actualizado correctamente";
    }else {
      $producto1->insertar();
      $mensaje = "Producto actualizado correctamente";
    }
  } else if(isset($_POST["btnBorrar"])){
    $cantidadProductos = $venta->obtenerProductosEnVenta($producto1->idproducto);
      if($cantidadProductos > 0){
        $mensaje = "No se puede eliminar el producto, existe en catalogo de ventas";
      } else {
        $producto1->eliminar();
        $mensaje = "Producto eliminado correctamente";
      }
    
  }

  
} 



if(isset($_GET['id']) && $_GET['id'] > 0){
  $producto1->idproducto = $_GET['id'];
  $producto1->obtenerPorId();
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

  <title>Edición de producto</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
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
            <h2 class="h3 bt-3 text-gray-800 mb-4">Productos</h2>
          </div>
          <form action="" method="POST" enctype="multipart/form-data">

            <div class="botones-crud mb-3">
              <a href="productos.php" class="mr-2 btn btn-primary">Listado</a>
              <a href="producto-formulario.php" class="mr-2 btn btn-primary">Nuevo</a>
              <button name="btnGuardar" class="mr-2 btn btn-success">Guardar</button>
              <button name="btnBorrar" class="btn btn-danger">Borrar</button>
            </div>
            <div>
              <div class="row">
                <div class="form-group col-sm-6 col-12">
                  <label for="txtNombre">Nombre: </label>
                  <input type="text" id="txtNombre" name="txtNombre" class="form-control" 
                  value="<?php echo $producto1->nombre ?>"
                  required>
                </div>
                <div class="form-group col-12 col-sm-6 ">
                  <label for="txtTipoProducto">Tipo de producto: </label>
                  <select name="lstTipoProducto" id="lstTipoProducto" class="selectpicker form-control" data-live-search="true"
                  value="<?php echo $producto1->tipoProducto ?>" >
                  <option value=""  selected>Seleccionar</option>

                  <?php foreach($tipos as $tipo) : ?>
                    <option value="<?= $tipo->idtipoproducto ?>"><?= $tipo->nombre ?></option>
                  <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group col-12 col-sm-6">
                  <label for="txtCantidad">Cantidad: </label>
                  <input type="number" id="txtCantidad" name="txtCantidad" class="form-control"
                  value="<?php echo $producto1->cantidad ?>"
                   required>
                </div>
                <div class="form-group col-12 col-sm-6">
                  <label for="txtPrecio">Precio: </label>
                  <input type="number" id="txtPrecio" name="txtPrecio" class="form-control" 
                  value="<?php echo $producto1->precio ?>"
                  required>
                </div>
                <div class="form-group col-12">
                  <label for="txtDescripcion">Descripcion: </label>
                  <textarea type="text" name="txtDescripcion" id="txtDescripcion">
                  <?php echo $producto1->descripcion ?>
                  </textarea>
                </div>
                <div class="form-group col-12 col-sm-6">
                  <label for="archivo">Imagen: </label>
                  <input type="file" name="archivo" id="archivo" class="form-control-file">
                  <img src="" class="img-thumbnail">
                </div>
                  
              </div>
            </div>
          </form>

          <?php if(isset($_POST['btnGuardar'])) : ?>
          <div  class="alert alert-success" role="alert">
           <?= $mensaje ?>
          </div>
          <?php elseif(isset($_POST['btnBorrar'])) : ?>
            <div  class="alert alert-danger" role="alert">
             <?= $mensaje ?>
            </div>
          <?php endif ?>
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

  <script>
    ClassicEditor
      .create(document.querySelector('#txtDescripcion'))
      .catch( error => {
        console.error(error);
      });
  </script>
</body>

</html>
