<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="SysKidney" />
  <link rel="stylesheet" href="css/inicio.css" />
  <link rel="icon" href="img/logo2.jpeg" />
  <title>SysKidney</title>
</head>

<body>
<a id="back" href="index.html">Volver</a>    
    <form action="validar.php" method="POST" autocomplete="off">
        <div id="login-box">
            <h1>Iniciar Sesión</h1> 

            <div class="form">
                <div class="item"> 
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <input type="text" placeholder="Usuario" name="username"> 
                </div>

                <div class="item"> 
                    <i class="fa fa-key" aria-hidden="true"></i>
                    <input type="password" placeholder="Contraseña" name="password"> 
                </div>

            </div>
            
            <button type="submit" value="Iniciar Sesión" name="Enviar">Ingresar</button><br><br>
            <p>¿No tiene cuenta registrada? </p>
            <a class="register" href="registrar.php">Regístrate aquí</a><br>   
            <?php
                
                if (isset($_GET["mensaje"]))
                 {
                 $mensaje = $_GET["mensaje"];
                    if ($_GET["mensaje"]!=""){
                ?>  	          
                    <br><br><u id="error">Datos Incorrectos:</u><br>
                    <strong id="error">                  
                    <?php 
                       if ($mensaje == 1)
                         echo "Las credenciales ingresadas no coinciden.";
                       if ($mensaje == 2)
                         echo "Las credenciales ingresadas no coinciden o se encuentra inactivo el usuario.";
                       if ($mensaje == 3)
                         echo "No ha ingresado en el sistema. Ha ocurrido un error. Por favor, intente de nuevo.";
                       if ($mensaje == 4)
                         echo "Su tipo de usuario, no tiene las credenciales suficientes para ingresar a esta opción.";            
                       if ($mensaje == 5)
                         echo "El usuario ya existe. Por favor, revise sus datos y vuelva a intentar.";            
                   }
                   unset($_GET['mensaje']);
                 }
                ?>
                    </strong>


        </div>
        
    </form>
</body>

</html>