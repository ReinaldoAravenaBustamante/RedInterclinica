
<!DOCTYPE html>
<html lang="es">
  <?php require_once("template/header.html");?>
  <title>Soporte</title>
  <body>
  <br>
  <br>
  <br>
  <br>
  <br>
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container">
    <div class="row">
      <div class="col-md-offset-5 col-md-3">
        <div class="form-login">
          <center><img width="150" height="40" src="media/imagenes/logo.png"></center>
          <br>
          <br>
          <form class="text-left" action="login.php" method="post">
            <input type="text" id="correo" name="correo" class="form-control input-sm chat-input" placeholder="Correo" />
            </br>
            <input id="pass" name= "pass" class="form-control input-sm chat-input" type="password" placeholder="Contraseña" />
            </br>
            <div class="wrapper">
              <span class="group-btn">
                <button type="submit" class="btn btn-primary btn-md">Ingresar <i class="fa fa-sign-in"></i></button>
              </span>
            </div>
          </form>
          <br>
          <center><a href="funcionarios/recuperar_pass.php">¿Olvido su contraseña?</a></center>
        </div>
      </div>
    </div>
  </div>
    <?php require_once("template/footer.html"); ?>
  </body>
</html>
