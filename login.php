<?php
// iniciamos la session;
session_start();

// si se envia el formulario
if($_POST){

  // tomamos los valores ingresados
  $usuario = trim($_POST['txtUsuario']);
  $clave = trim($_POST['txtClave']);

  // encriptamos la clave;
  $claveEncriptada = password_hash("admin123", PASSWORD_DEFAULT);

  // comprobar que el usuario sea admin y la clave admin123, si clase es similar a la clave encriptada,
  if($usuario == "admin" && password_verify($clave, $claveEncriptada)){

    // si esto es correcto creamos una variable con un inicio de sesion con el nombre del usuario
    $_SESSION["nombre"] = "Gastón Lell";
    
    // redireccionamos a la home
    header("Location: index.php");

  } else {
    // si no es correcto mostramos un msj de error
    $msg = "Usuario o clave incorrecta";
  }
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

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                  </div>

                  <!-- INICIO DE FORMULARIO -->
                  <form class="user" action="" method="POST">

                  <?php if(isset($msg)): ?>
                  <div class="alert alert-danger" role="alert">
                      <?php echo $msg; ?>
                  </div>
                  <?php endif ?>

                    <div class="form-group">
                      <input type="text" name="txtUsuario" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Ingrese su usuario...">
                    </div>
                    <div class="form-group">
                      <input type="password" name="txtClave" class="form-control form-control-user" id="exampleInputPassword" placeholder="Contraseña">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Recordar contraseña </label>
                      </div>
                    </div>
                    <button href="index.html" type="submit" class="btn btn-primary btn-user btn-block">
                      Ingresar
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Olvidaste la clave?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Crear una cuenta!</a>
                  </div>
                </div>
              </div>
            </div>
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

</body>

</html>
