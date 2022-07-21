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
  <link rel="stylesheet" href="css/gestion.css" />
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
  <div class="search-list">
              
  <form action="gestion_usua.php" method="POST">            
    <div class="formulario">
    <p>Número de identificación: <input class="formulario item0" type="search" name=id_con value="" min="1" pattern="^[0-9]+"></p>                                                                   
    <p class="formulario item1">Estado de Usuarios: </p><select class="formulario item2" name=estado>
    <?php
    if (isset($_POST["estado"])) {
      $estado = $_POST["estado"];
      if ($_POST["estado"] != "") {
        if ($estado == "2") {
          echo "<option value=" . $estado . "> Todos los usuarios</option>";
          echo "<option value=1> Usuarios activos</option>";
          echo "<option value=0> Usuarios inactivos</option>";
        } else if ($estado == "1") {
          echo "<option value=" . $estado . "> Usuarios activos</option>";
          echo "<option value=2> Todos los usuarios </option>";
          echo "<option value=0> Usuarios inactivos</option>";
        } else if ($estado == "0") {
          echo "<option value=" . $estado . "> Usuarios inactivos</option>";
          echo "<option value=2> Todos los usuarios</option>";
          echo "<option value=1> Usuarios activos</option>";
        }
      }
    } else {
    ?>
      <option value=2> Todos los usuarios</option>
      <option value=1> Usuarios activos </option>
      <option value=0> Usuarios inactivos </option>
    <?php
    }
    ?>
  </select>
  <p class="formulario item4">Tipo de Usuarios: </p><select class="formulario item5" name=tipo>
    <?php
    if (isset($_POST["tipo"])) {
      $tipo= $_POST["tipo"];
      if ($_POST["tipo"] != "") {
        if ($tipo == "1") {
          echo "<option value=" . $tipo . "> Todos los usuarios</option>";
          echo "<option value=2> Usuarios Pacientes</option>";
          echo "<option value=3> Usuarios Médicos</option>";
        } else if ($tipo == "2") {
          echo "<option value=" . $tipo . "> Usuarios Pacientes</option>";
          echo "<option value=1> Todos los usuarios </option>";
          echo "<option value=3> Usuarios Médicos</option>";
        } else if ($tipo == "3") {
          echo "<option value=" . $tipo . "> Usuarios Médicos</option>";
          echo "<option value=2> Todos los usuarios</option>";
          echo "<option value=1> Usuarios Pacientes</option>";
        }
      }
    } else {
    ?>
      <option value=1> Todos los usuarios</option>
      <option value=2> Usuarios Pacientes </option>
      <option value=3> Usuarios Médicos </option>
    <?php
    }
    ?>
  </select>
  <input class="formulario item6" type="submit" name=Consultar value="Consultar">             
  <input type="hidden" value="1" name="enviado">
  </div>
  </form>
  <a id="add" href="gestion_usua_add.php">Añadir Usuario</a>           
  </div>
  <h3>Usuarios Registrados</h3> 
  <?php
    if (isset($_GET["mensaje"])) {
    $mensaje = $_GET["mensaje"];
    if ($_GET["mensaje"] != "") { ?>
        
    <p id="noti">
      <?php
      
      if ($mensaje == 1)
        echo "Usuario actualizado correctamente.";
      if ($mensaje == 2)
        echo "Usuario no fue actualizado correctamente.";
      if ($mensaje == 3)
        echo "Usuario creado correctamente.";
      if ($mensaje == 4)
        echo "Usuario no fue creado. Se presentó un inconveniente";
      if ($mensaje == 5)
        echo "Usuario no fue creado. Ya existe un usuario con el mismo ID.";
      if ($mensaje == 6)
        echo "Usuario no fue creado. La contraseña no coincide.";
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
    $sql1 = "SELECT * FROM usuarios WHERE num_id LIKE '$id_con%' and activo=$estado and tipo_usuario=$tipo order by nombres";
    if (($estado == "2")&&($tipo!=1))
    $sql1 = "SELECT * from usuarios where num_id LIKE '$id_con%' and tipo_usuario=$tipo order by nombres";
    if (($estado != "2")&&($tipo==1))
    $sql1 = "SELECT * from usuarios where num_id LIKE '$id_con%' and activo=$estado order by nombres";
    else
    $sql1 = "SELECT * from usuarios where num_id LIKE '$id_con%' order by nombres";
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