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
  $sqlusu = "SELECT * from tipo_usuario where id='3'"; 
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
  <link rel="stylesheet" href="css/gestion_diag.css" />
  <link rel="icon" href="img/logo2.jpeg" />
  <title>SysKidney</title>
</head>

<body>
  <header>
    <nav class="container mx-auto navbar">
    <section class="navbar-list">      
      <img id="navbar-logo" src="img/logo.png" width="100" height="100" alt="logo SysKidney" />  
      <a href="home_medico.php">Inicio</a>                          
      <a href="gestion_diag.php">Consultar Estado del Paciente</a>                                          
      <a href="contacto_medico.php">Contacto</a>                                              
      <a id="session" href="cerrar_sesion.php">Cerrar Sesión</a>
    </section>
    </nav>
  </header>
  
              
  <form action="gestion_diag.php" method="POST">                
  <div class="search-list">  
  <div>
    <p>Número de identificación: <input id="search1" type="search" name=id_con value="" min="1" pattern="^[0-9]+"></p>                                                                            
    <p>Nombre de paciente: <input id="search2" type="search" name=name_con value=""></p>                                                                            
    </div>
    <div>
    <input id="consult" type="submit" name=Consultar value="Consultar">             
    <input type="hidden" value="1" name="enviado">  
    </div>
    </div>
  </form>  
  
  <h3>Pacientes Asignados</h3> 
  <?php
    if (isset($_GET["mensaje"])) {
    $mensaje = $_GET["mensaje"];
    if ($_GET["mensaje"] != "") { ?>
    

    <tr>
      <?php
      if ($mensaje == 1)
        echo "<p>El análisis fue procesado correctamente. Se le notificará al paciente por correo.";
      if ($mensaje == 2)
        echo "<p>El análisis no fue procesado. Hubo un error, por favor, repita el procedimiento. Lo sentimos.";      
      ?>
    </p>
    <?php
    }
    }
  ?>     
  <table>
    <thead>
      <tr>
        <th>Número de identificación</th>
        <th>Nombres</th>
        <th>Apellido</th>
        <th>Correo</th>
        <th>Usuario</th>
        <th>Tipo de Usuario</th>
        <th>Género</th>
        <th>Estado</th>
        <th>Modificar</th>        
      </tr>
    </thead>
<?php

$mysqli = new mysqli($host, $user, $pw, $db);
if ((isset($_POST["enviado"]))) 
{
  $id_con = $_POST["id_con"];  
  $estado = $_POST["estado"];
  $tipo = $_POST["tipo"];

  $sql1 = "SELECT * from usuarios order by nombres";
  if ($id_con == "") {
    if (($estado != "2")&&($tipo!=1))
    $sql1 = "SELECT * from usuarios where activo=$estado and tipo_usuario=$tipo order by nombres";
    if (($estado == "2")&&($tipo!=1))
    $sql1 = "SELECT * from usuarios where tipo_usuario=$tipo order by nombres";
    if (($estado != "2")&&($tipo==1))
    $sql1 = "SELECT * from usuarios where activo=$estado order by nombres";    
  }
  if ($id_con != "") {
    if (($estado != "2")&&($tipo!=1))
    $sql1 = "SELECT * FROM usuarios WHERE num_id='$id_con' and activo=$estado and tipo_usuario=$tipo order by nombres";
    if (($estado == "2")&&($tipo!=1))
    $sql1 = "SELECT * from usuarios where num_id='$id_con' and tipo_usuario=$tipo order by nombres";
    if (($estado != "2")&&($tipo==1))
    $sql1 = "SELECT * from usuarios where num_id='$id_con' and activo=$estado order by nombres";
    else
    $sql1 = "SELECT * from usuarios where num_id='$id_con' order by nombres";
  }
  
} 
else
  $sql1 = "SELECT * from usuarios order by nombres";
  $result1 = $mysqli->query($sql1);
  while ($row = $result1->fetch_array(MYSQLI_NUM)) {    
  $id_usu = $row[0];   
  $id_usu_enc = md5($id_usu);  
  $num_id = $row[1];
  $nombres = $row[7];
  $apellidos = $row[8];
  $usuario = $row[2];
  $correo = $row[11];
  $genero = $row[10];
  $sql2 = "SELECT * from genero where id='$genero'";
  $result2 = $mysqli->query($sql2);
  $row2 = $result2->fetch_array(MYSQLI_NUM);
  $desc_genero = $row2[1];

  $activo=$row[5];
  if ($activo == 1)
    $desc_activo = "Activo";
  else
    $desc_activo = "Inactivo";

  $tipo_usu = $row[4];
  $sql3 = "SELECT * from tipo_usuario where id='$tipo_usu'";
  $result3 = $mysqli->query($sql3);
  $row3 = $result3->fetch_array(MYSQLI_NUM);
  $desc_tipo_usuario = $row3[1];
  
?>

  <tr>
    <td><?php echo $num_id; ?></td>
    <td><?php echo $nombres; ?></td>
    <td><?php echo $apellidos; ?></td>
    <td><?php echo $correo; ?></td>
    <td><?php echo $usuario; ?></td>
    <td><?php echo $desc_tipo_usuario; ?></td>    
    <td><?php echo $desc_genero; ?></td>
    <td><?php echo $desc_activo; ?></td>
    <td><a href="gestion_usua_mod.php?id_usu=<?php echo $id_usu_enc; ?>"> <img src="icons/modificar.png" width=30 height=30></a></td>    
  </tr>       
<?php
}
?>
</table>
</section>
<footer>
    
  </footer>
</body>


</html>