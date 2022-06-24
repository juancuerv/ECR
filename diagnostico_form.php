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
  <link rel="stylesheet" href="css/home_cliente.css" />
  <link rel="icon" href="img/logo2.jpeg" />
  <title>SysKidney</title>
</head>

<body onload="porc()">
  <header>
  <nav class="container mx-auto navbar">
    <section class="navbar-list">      
      <img id="navbar-logo" src="img/logo.png" width="100" height="100" alt="logo SysKidney" />  
      <a href="home_cliente.php">Inicio</a>                    
      <a href="diagnostico.php">Diagnóstico de ECR</a>                    
      <a href="gestion_diag.php">Consultar Diagnósticos</a>                                          
      <a href="contacto.php">Contacto</a>                    
      <a id="profile" href="gestion_usua.php"><?php echo $_SESSION["nombres"]?></a>                    
      <a id="session" href="cerrar_sesion.php">Cerrar Sesión</a>
    </section>
    </nav>
  </header>    
  <?php
  $id_usu= $_SESSION["id_usuario"];
  $sql = "SELECT MAX(id) from formularios where usuario_id='$id_usu'"; 
  $result = $mysqli->query($sql);
  $row = $result->fetch_array(MYSQLI_NUM);
  $id_form = $row[0];
  $sql = "SELECT porc_riesgo from formularios where id='$id_form'"; 
  $result = $mysqli->query($sql);
  $row = $result->fetch_array(MYSQLI_NUM);
  $Porc = $row[0];

?>
  <main id="wrapper" class="container mx-auto">
    <section class="wrapper-inicio" >
        <div >
          <h1>Resultados:</h1>
          <p>
            Después realizar el análisis de la información que proporcionaste, SysKidney te indica que posees un: <strong id="porcentaje"><?php echo $Porc ?>%</strong> de probabilidad de padecer la Enfermedad Crónica Renal.                       
          </p>
          <p>¡Recuerda! El objetivo de SysKidney es apoyar a las personas con el diagnóstico, no se debe tomar como un sustito del personal médico. Siempre consulta con tu médico de cabecera.</p>
                    
        </div>
        <div >
          <h3>Complete nuevamente el formulario, si así lo desea</h3>
          <aside class="details">
            <a href="formulario.php">            
              <p>Formulario ECR</p>
            </a>            
          <h3>O escanee su tira reactiva para obtener otro tipo de diagnóstico</h3>
            <a href="tiras.php">            
              <p>Escaneo de tiras reactivas</p>
            </a>                                 
          </aside>
        </div>          
    </section>
  </main>
  <footer>
    <section class="footer-items">
      <div class="container-socialmedia">      
        <div class="socialmedia">
          
          <a href="https://www.freseniuskidneycare.com/es/kidney-disease/ckd/kidney-function-tests" target="blanck">
            <img src="icons/fresenius.png" width="100" height="30" alt="fresenius" />
          </a>
          <a href="https://medlineplus.gov/spanish/ency/article/000471.htm" target="blanck">
            <img src="icons/medical.png" width="30" height="30" alt="medical" />
          </a> 
          <a href="mailto:syskidney@gmail.com">
            <img src="icons/gmail.png" width="30" height="30" alt="gmail" />
          </a>
        </div>
    </section>
  </footer>
</body>


</html>