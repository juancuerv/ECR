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
  <link rel="stylesheet" href="css/contacto.css" />
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
      <a href="consult_diag.php">Consultar Diagnósticos</a>                                          
      <a href="contacto.php">Contacto</a>                    
      <a id="profile" href="perfil.php"><?php echo $_SESSION["nombres"]?></a>                    
      <a id="session" href="cerrar_sesion.php">Cerrar Sesión</a>
    </section>
    </nav>
  </header>    
  <?php
  $id_usu=$_SESSION["id_usuario"];
  $nombre=$_SESSION["nombres"];
  $sql1 = "SELECT apellidos, correo from usuarios where id='$id_usu'";
  $result1 = $mysqli->query($sql1);
  $row = $result1->fetch_array(MYSQLI_NUM);
  $apellidos=$row[0];
  $correo=$row[1];
  
  ?>
  <main id="wrapper" class="container mx-auto">
    <section class="wrapper-contacto">
      <h1>Formulario de contacto</h1>
      <div id="formulario">
        <form action="https://formsubmit.co/649231b8d576db1c8b15842933129323" method="POST" onsubmit="return alert('Su correo ha sido enviado correctamente. Pronto nos contactaremos con usted.')">
          <input type="text" placeholder="Nombre" name="Nombre" value="<?php echo $nombre?> <?php echo $apellidos?>">
          <input type="text" placeholder="Correo" name="Correo" value="<?php echo $correo?>">
          <input type="text" placeholder="Asunto" name="Asunto">
          <textarea placeholder="Mensaje" name="Mensaje"></textarea>
          <button type="submit" value="Enviar">Enviar</button>
          <input type="hidden" name="_next" value="http://localhost/ecr/home_cliente.php">
          <input type="hidden" name="_captcha" value="false">
           
        </form>
      </div>
      <br />
      
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