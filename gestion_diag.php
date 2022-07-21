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
    

    <p id="noti">
      <?php
      if ($mensaje == 1)
        echo "El análisis fue procesado correctamente. Se le notificará al paciente por correo.";
      if ($mensaje == 2)
        echo "El análisis no fue procesado. Hubo un error, por favor, repita el procedimiento. Lo sentimos.";      
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
        <th>Apellidos</th>
        <th>ID Formulario</th>
        <th>Analizar</th>        
      </tr>
    </thead>
<?php

$mysqli = new mysqli($host, $user, $pw, $db);
$med_id = $_SESSION["id_medico"];
$c1="u.num_id, u.nombres, u.apellidos, f.id";
$c2= "formularios f, usuarios u, formularios_medicos fu where fu.estado='1' and fu.formulario_id=f.id and f.usuario_id=u.id and fu.medico_id='$med_id'";
if ((isset($_POST["enviado"]))) 
{
  $id_con = $_POST["id_con"];  
  $name_con = $_POST["name_con"];
  
  

  $sql1 = "SELECT $c1 from $c2 order by u.num_id";
  if ($id_con == "") {
    if ($name_con != "")
    $sql1 = "SELECT $c1 from $c2 and u.nombres LIKE '$name_con%' order by u.num_id";
    else
    $sql1 = "SELECT $c1 from $c2 order by u.num_id";
  }
  else{
    if ($name_con !="")
    $sql1 = "SELECT $c1 from $c2 and u.num_id LIKE '$id_con%' and u.nombres LIKE '$name_con%' order by u.nombres";
    else
    $sql1 = "SELECT $c1 from $c2 and u.num_id LIKE '$id_con%' order by u.num_id";
    
  }    
  
} 
else
  $sql1 = "SELECT $c1 from $c2 order by u.num_id";
  $result1 = $mysqli->query($sql1);
  while ($row = $result1->fetch_array(MYSQLI_NUM)) {    
  $num_id = $row[0];       
  $nombres = $row[1];
  $apellidos = $row[2];
  $id_form = $row[3];
  $id_form_enc = md5($id_form);  
  
?>

  <tr>
    <td><?php echo $num_id; ?></td>
    <td><?php echo $nombres; ?></td>
    <td><?php echo $apellidos; ?></td>
    <td><?php echo $id_form; ?></td>
    <td><a href="analizar.php?id_form_enc=<?php echo $id_form_enc; ?>"> <img src="icons/analisis.png" style="border-radius: 1rem;" width=30 height=30></a></td>   

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