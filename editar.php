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
  $sqlusu = "SELECT * from tipo_usuario where id='2'"; 
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

<body id="home">
  <header>
  <nav class="container mx-auto navbar">
    <section class="navbar-list">      
      <img id="navbar-logo" src="img/logo.png" width="100" height="100" alt="logo SysKidney" />  
      <a href="home_cliente.php">Inicio</a>                    
      <a href="diagnostico.php">Diagnóstico de ECR</a>                    
      <a href="gestion_diag.php">Consultar Diagnósticos</a>                                          
      <a href="contacto.php">Contacto</a>                    
      <a id="profile" href="perfil.php"><?php echo $_SESSION["nombres"]?></a>                    
      <a id="close" href="cerrar_sesion.php">Cerrar Sesión</a>
    </section>
    </nav>
  </header>
  <main id="wrapper" class="container mx-auto">
  <section class="wrapper-contacto">    
  <?php

  if ((isset($_POST["enviado"]))) {

    $id_usu_enc = $_POST["id_usu"];
    $nombre_usuario = $_POST["nombre_usuario"];
    $apellido_usuario = $_POST["apellido_usuario"];
    $correo = $_POST["correo"];
    $genero = $_POST["genero"];
    $num_id = $_POST["num_id"];
    $fecha_nac = $_POST['fecha_nac'];
    $ciudad = $_POST["ciudad"]; 
    $login = $_POST["login"];
    $password = $_POST["password"];
    $passwordcmp = $_POST["passwordcmp"];
  
    if($password!=$passwordcmp){
      header('Location:perfil.php?mensaje=2');
    }
    else{
    $mysqli = new mysqli($host, $user, $pw, $db);
    $sqlu1 = "UPDATE usuarios set nombres='$nombre_usuario' where id='$id_usu_enc'"; 
    $resultsqlu1 = $mysqli->query($sqlu1);
    $sqlu2 = "UPDATE usuarios set apellidos='$apellido_usuario' where id='$id_usu_enc'"; 
    $resultsqlu2 = $mysqli->query($sqlu2);
    $sqlu3 = "UPDATE usuarios set login='$login' where id='$id_usu_enc'"; 
    $resultsqlu3 = $mysqli->query($sqlu3);
    $sqlu4 = "UPDATE usuarios set genero='$genero' where id='$id_usu_enc'"; 
    $resultsqlu4 = $mysqli->query($sqlu4);
    $sqlu5 = "UPDATE usuarios set num_id='$num_id' where id='$id_usu_enc'"; 
    $resultsqlu5 = $mysqli->query($sqlu5);
    $sqlu6 = "UPDATE usuarios set fecha_nac='$fecha_nac' where id='$id_usu_enc'"; 
    $resultsqlu6 = $mysqli->query($sqlu6);
    $sqlu8 = "UPDATE usuarios set ciudades_id='$ciudad' where id='$id_usu_enc'"; 
    $resultsqlu8 = $mysqli->query($sqlu8);    
    if ($password != "") {
      $password_enc = md5($password);
      $sqlu10 = "UPDATE usuarios set pass='$password_enc' where id='$id_usu_enc'"; 
      $resultsqlu10 = $mysqli->query($sqlu10);
    }
    else{
      header('Location: perfil.php?mensaje=2');  
    }
    $sqlu11 = "UPDATE usuarios set correo='$correo' where id='$id_usu_enc'"; 
      $resultsqlu11 = $mysqli->query($sqlu11);
    }
  if (($resultsqlu1 == 1) && ($resultsqlu2 == 1) && ($resultsqlu3 == 1) && ($resultsqlu4 == 1) && ($resultsqlu5 == 1) && ($resultsqlu6 == 1)&& ($resultsqlu11 == 1)&& ($resultsqlu8 == 1))
    header('Location: perfil.php?mensaje=1');
  else
    header('Location: perfil.php?mensaje=2');
  } else {

  $id_usu_enc = $_SESSION["id_usuario"];
  $sql1 = "SELECT * from usuarios where id='$id_usu_enc'";
  $result1 = $mysqli->query($sql1);
  $row1 = $result1->fetch_array(MYSQLI_NUM);
  $num_id = $row1[1];
  $login = $row1[2];
  $correo = $row1[11];
  $password = $row1[3];
  $tipo_usuario  = $row1[4];
  $sql3 = "SELECT * from tipo_usuario where id='$tipo_usuario'";
  $result3 = $mysqli->query($sql3);
  $row3 = $result3->fetch_array(MYSQLI_NUM);
  $desc_tipo_usuario = $row3[1];    
  $ciudad= $row1[6];
  $sql3 = "SELECT * from ciudades where id='$ciudad'";
  $result3 = $mysqli->query($sql3);
  $row3 = $result3->fetch_array(MYSQLI_NUM);
  $name_ciudad=$row3[1];
  $id_departamento = $row3[2];  
  $nombre_usuario= $row1[7];
  $apellido_usuario= $row1[8];
  $fecha_nac= $row1[9];
  $genero = $row1[10];
  if ($genero == 1)
    $desc_genero = "Masculino";
  else
    $desc_genero = "Femenino";
  
  

  
  
  ?>

  <a id="back" href="perfil.php"></a>        
  <h1 id="registrar">Modificar usuario</h1>
  <div class="formulario">             
  <form method=POST action="editar.php" onsubmit="return confirm('¿Confirma la información proporcionada?');">
  <div class="formulario item1">      
  <p>Nombres:</p> 
  <input type="text" name=nombre_usuario placeholder="" value="<?php echo $nombre_usuario; ?>" required>
  </div>    
  <div class="formulario item1">       
  <p>Apellidos:</p> 
  <input type="text" name=apellido_usuario placeholder="" value="<?php echo $apellido_usuario; ?>" required>
  </div>
  <div class="formulario item1">      
  <p>Correo:</p> 
  <input type="email" name=correo placeholder="" value="<?php echo $correo; ?>" required>
  </div>    
  <div class="formulario item1">  
  <p>Genero:</p> 
  <select class="select-css" name=genero required>
    <option value="<?php echo $genero; ?>"> <?php echo $desc_genero; ?>&ensp;&ensp;&ensp;</option>
    <?php
    $genero_con = 1;
    $desc_genero_con = "Masculino";
    if ($genero_con != $genero) {
    ?>
      <option value="<?php echo $genero_con; ?>"> <?php echo $desc_genero_con; ?> &ensp;&ensp; </option>
    <?php
    } else {
    ?>
      <option value="2"> Femenino</option>
    <?php
    }
    ?>
  </select>
  </div>
  <div class="formulario item1">           
  <p>Número de identificación:</p> 
  <input type="text" name=num_id placeholder="" value="<?php echo $num_id; ?>" required>
  </div>
  <div class="formulario item1">
  <p>Fecha de nacimiento:</p>            
  <input type="date" name=fecha_nac placeholder="" value="<?php echo $fecha_nac; ?>" required>
  </div>
    

  <div class="formulario item1">           
  <p>Municipio de residencia:</p> 
  <select class="select-css" name=ciudad required>  
  <option value="<?php echo $ciudad; ?>"> <?php echo $name_ciudad; ?>&ensp;&ensp;&ensp;&ensp;</option>
  <?php 	
  $sql6 = "SELECT * from ciudades order by nombre DESC";
  $result6 = $mysqli->query($sql6);
  while($row6 = $result6->fetch_array(MYSQLI_NUM)) {
  $ciudad_con = $row6[0];
  $name_ciudad_con = $row6[1];
  if ($ciudad_con != $ciudad) {
  ?>   
  <option value="<?php echo $ciudad_con; ?>"> <?php echo $name_ciudad_con; ?>&ensp;&ensp;&ensp;</option>  
  <?php
  }   
  }
  ?>

  </select>		  
  </div>

  <div class="formulario item1">  
  <p>Usuario:</p> 
  <input type="text" name=login placeholder="" value="<?php echo $login; ?>" required>                      
  </div>
  <div class="formulario item1">  
  <p>Contraseña (dejar en blanco si no desea cambiarla):</p> 
  <input type="password" name=password placeholder="" value="" >                  
  </div>

  <div class="formulario item1">  
  <p>Confirmar contraseña:</p> 
  <input type="password" name=passwordcmp placeholder="" value="" >                  
  </div>

  <input type="hidden" value="S" name="enviado">
  <input type="hidden" value="<?php echo $id_usu_enc; ?>" name="id_usu">
  <input id="edit" type=submit value="Modificar" name="Modificar">    
  <input type="hidden" value="S" name="enviado">
  <br><br><br>

  </form>                      
          
  <?php
  }
  ?>  
  </section>
</body>
</html>