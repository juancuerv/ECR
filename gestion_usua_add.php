<?php
include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.

// LAs siguientes son l�neas de c�digo HTML simple, para crear una p�gina web
session_start();
if ($_SESSION["autenticado"] != "SIx3")
{
  header('Location: inicio.php?mensaje=3');
}
else
{      
  $mysqli = new mysqli($host, $user, $pw, $db);
  $sqlusu = "SELECT * from tipo_usuario where id='1'"; 
  $resultusu = $mysqli->query($sqlusu);
  $rowusu = $resultusu->fetch_array(MYSQLI_NUM);
  $desc_tipo_usuario = $rowusu[1];
  if ($_SESSION["tipo_usuario"] != $desc_tipo_usuario)
    header('Location: inicio.php?mensaje=4');
}                           
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="SysKidney" />
  <link rel="stylesheet" href="css/add_edit.css" />
  <link rel="icon" href="img/logo2.jpeg" />
  <title>SysKidney</title>
</head>

<body>
  <header>
    <nav class="container mx-auto navbar">
      <section class="navbar-list">      
      <img id="navbar-logo" src="img/logo.png" width="100" height="100" alt="logo SysKidney" />  
      <a href="gestion_usua.php">Gestión de Usuarios</a>                    
      <a id="session" href="cerrar_sesion.php">Cerrar Sesión</a>
      </section>
    </nav>
  </header>
  <main id="wrapper" class="container mx-auto">
  <section class="wrapper-gestion">
  <?php
  if ((isset($_POST["enviado"]))) {

    $nombre_usuario = $_POST["nombre_usuario"];
    $apellido_usuario = $_POST["apellido_usuario"];
    $correo = $_POST["correo"];
    $genero = $_POST["genero"];
    $num_id = $_POST["num_id"];
    $fecha = $_POST['fecha_nac'];
    $tipo_usuario = $_POST["tipo_usuario"];
    $ciudad = $_POST["ciudad"];
    $departamento = $_POST["departamento"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $passwordcmp = $_POST["passwordcmp"];
    $activo = $_POST["activo"];
    if($password!=$passwordcmp){
      header('Location:gestion_usua.php?mensaje=6');
    }
    else{
    $password_enc = md5($password);
    $mysqli = new mysqli($host, $user, $pw, $db);
    $sqlcon = "SELECT * from usuarios where num_id='$num_id'";
    $resultcon = $mysqli->query($sqlcon);
    $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
    $numero_filas = $resultcon->num_rows;
  if ($numero_filas > 0) {
    header('Location:gestion_usua.php?mensaje=5');
  } else {
    
    $sql = "INSERT INTO usuarios(id, num_id, login, pass, tipo_usuario, activo, ciudades_id, nombres, apellidos, fecha_nac, genero, correo) 
    VALUES (NULL, '$num_id','$login','$password_enc','$tipo_usuario', 1 ,'$ciudad','$nombre_usuario', '$apellido_usuario', '$fecha', '$genero', '$correo')";            
    $result1 = $mysqli->query($sql);          
         

  //echo "result es...".$result1;
  if ($result1 == 1 ) {
    header('Location:gestion_usua.php?mensaje=3');
  } else
    header('Location:gestion_usua.php?mensaje=4');
  }
  }
  } else {
  ?>
  <a id="back" href="gestion_usua.php"></a>        
  <h1 id="registrar">Registrar usuario</h1>
  <div class="formulario">             
  <form method=POST action="gestion_usua_add.php" onsubmit="return confirm('¿Está seguro de agregar al usuario?');">
  <div class="formulario item1">      
    <p>Nombres:</p> 
    <input type="text" name=nombre_usuario placeholder="" value="" required>
  </div>    
  <div class="formulario item1">       
    <p>Apellidos:</p> 
    <input type="text" name=apellido_usuario placeholder="" value="" required>
    </div>
    <div class="formulario item1">       
    <p>Correo:</p> 
    <input type="email" name=correo placeholder="" value="" required>
    </div>
  <div class="formulario item1">  
    <p>Genero:</p> 
    <select class="select-css" name=genero required>
    <option value="1"> Masculino  &emsp;&emsp;</option>
    <option value="2"> Femenino   &emsp;&emsp;   </option>
    </select>
  </div>
  <div class="formulario item1">           
    <p>Número de identificación:</p> 
    <input type="text" name=num_id placeholder="" value="" required>
    </div>
  <div class="formulario item1">
    <p>Fecha de nacimiento:</p>            
    <input type="date" name=fecha_nac placeholder="" value="" required>
    </div>
  <div class="formulario item1">           
    <p>Tipo de usuario:</p> 
    <select class="select-css" name=tipo_usuario required>  
    
    <?php 	
    $sql6 = "SELECT * from tipo_usuario order by id DESC";
    $result6 = $mysqli->query($sql6);
    while($row6 = $result6->fetch_array(MYSQLI_NUM)) {
      $tipo_usuario_con = $row6[0];
      $desc_tipo_usuario_con = $row6[1];
      
        ?>   
        <option value="<?php echo $tipo_usuario_con; ?>"> <?php echo $desc_tipo_usuario_con; ?></option>  
        <?php
       
    }
    ?>

    </select>		  
    </div>



    <div class="formulario item1">           
    <p>Municipio de residencia:</p> 
    <select class="select-css" name=ciudad required>  
    
    <?php 	
    $sql6 = "SELECT * from ciudades order by nombre DESC";
    $result6 = $mysqli->query($sql6);
    while($row6 = $result6->fetch_array(MYSQLI_NUM)) {
      $ciudad_con = $row6[0];
      $name_ciudad_con = $row6[1];      
        ?>   
        <option value="<?php echo $ciudad_con; ?>"> <?php echo $name_ciudad_con; ?></option>  
        <?php       
    }
    ?>

    </select>		  
    </div>
    
    <div class="formulario item1">  
      <p>Usuario:</p> 
      <input type="text" name=login placeholder="" value="" required>                      
    </div>
    <div class="formulario item1">  
      <p>Contraseña:</p> 
      <input type="password" name=password placeholder="" value="" required>                  
    </div>

    <div class="formulario item1">  
      <p>Confirmar contraseña:</p> 
      <input type="password" name=passwordcmp placeholder="" value="" required>                  
    </div>
    
        
    <input id="save" type=submit value="Guardar" name="Guardar">    
    <input type="hidden" value="S" name="enviado">
    <br><br><br>

  </form>                      
                  
  <?php
  }
  ?>  
  </section>
</body>
</html>