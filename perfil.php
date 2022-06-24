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
  <link rel="stylesheet" href="css/perfil.css" />
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
      <a id="session" href="cerrar_sesion.php">Cerrar Sesión</a>
    </section>
    </nav>
  </header>
  <?php
  $id_usu=$_SESSION["id_usuario"];
  $sql1 = "SELECT * from usuarios where id='$id_usu'";
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
  $activo= $row1[5];
  if ($activo == 1)
    $desc_activo = "Activo";
  else
    $desc_activo = "Inactivo";
  $ciudad= $row1[6];
  $sql3 = "SELECT * from ciudades where id='$ciudad'";
  $result3 = $mysqli->query($sql3);
  $row3 = $result3->fetch_array(MYSQLI_NUM);
  $name_ciudad=$row3[1];
  $id_departamento = $row3[2];

  $sql3 = "SELECT * from departamentos where id='$id_departamento'";
  $result3 = $mysqli->query($sql3);
  $row3 = $result3->fetch_array(MYSQLI_NUM);
  $departamento = $row3[1];

  $nombre_usuario= $row1[7];
  $apellido_usuario= $row1[8];
  $fecha_nac= $row1[9];
  $genero = $row1[10];
  if ($genero == 1)
    $desc_genero = "Masculino";
  else
    $desc_genero = "Femenino";
  
  ?>
  <main id="wrapper" class="container mx-auto">
    <section class="wrapper-inicio">
    <div class="wrapper-inicio-photo">
        <img id="photo" src="img/usuario.png" width="170" height="170" alt="foto de perfil" />
      </div>
      <div>
        <div>
          <h1>Perfil</h1>
          <?php
          if (isset($_GET["mensaje"])) {
            $mensaje = $_GET["mensaje"];
            if ($_GET["mensaje"] != "") {
            
            if ($mensaje == 1)
              echo "<p>Perfil actualizado correctamente.</p>";
            if ($mensaje == 2)
              echo "<p>Perfil no fue actualizado correctamente.</p>";                        
            }
          }
            ?>
          
          <div class="info">
            <div id="item1">
            <strong>Nombres: </strong><?php echo $nombre_usuario;?>
            <strong>Apellidos: </strong><?php echo $apellido_usuario;?>
            </div>
            <div id="item1">
            <strong>Fecha de nacimiento: </strong><?php echo $fecha_nac;?>
            <strong>Género: </strong><?php echo $desc_genero;?>
            </div>
            <div id="item1">
            <strong>Usuario: </strong><?php echo $login;?>
            <strong>Correo: </strong><?php echo $correo;?>
            </div>
            <div id="item1">
            <strong>Ciudad de residencia: </strong><?php echo $name_ciudad;?>
            <strong>Departamento de residencia: </strong><?php echo $departamento;?>
            </div>
          </div>                              
        </div>
      </div>
      <br>
        <div >                    
            <a id="edit" href="editar.php"> Editar perfil</a>                                      
      
        </div>
        
      
    </section>
    
  </main>

</body>

</html>