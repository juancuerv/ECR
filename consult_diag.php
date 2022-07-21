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
  <link rel="stylesheet" href="css/consult_diag.css" />
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
  
  <main id="wrapper" class="container mx-auto">
  <?php
  $id_usu=$_SESSION["id_usuario"];    
  $sql1 = "SELECT fu.formulario_id, fu.recomendacion, fu.medico_id FROM formularios_medicos fu where fu.estado='0'";
  $result1 = $mysqli->query($sql1);
  while ($row = $result1->fetch_array(MYSQLI_NUM)) { 
    $f_id=$row[0];    
    $rec=$row[1];       
    $m_id=$row[2];    
    
    $sql2 = "SELECT id FROM formularios where usuario_id='$id_usu'";
    $result2 = $mysqli->query($sql2);
    while ($row2 = $result2->fetch_array(MYSQLI_NUM)) { 
    $id_f=$row2[0];

    if($id_f==$f_id){
    $sql2 = "SELECT usuario_id FROM medicos where id='$m_id'";
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_array(MYSQLI_NUM);
    $id_u=$row2[0];

    $sql2 = "SELECT nombres, apellidos, genero FROM usuarios where id='$id_u'";
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_array(MYSQLI_NUM);
    $nombresm=$row2[0];
    $apellidosm=$row2[1];
    $generom=$row2[2];
    if($generom==1){
    $desc_gen="el doctor";}
    else{
    $desc_gen="la doctora";}

    $sql2 = "SELECT descripcion, fecha_recomendacion FROM recomendaciones where id='$rec'";
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_array(MYSQLI_NUM);
    $desc=$row2[0];
    $fecha=$row2[1];  
  
  ?>
    <section class="wrapper-inicio">
        <div>
        <h3>Formulario <?php echo $id_f;?>:</h3>
        <p> Para el formulario <?php echo "$id_f, $desc_gen $nombresm $apellidosm en<br>
          la fecha $fecha, recomendó lo siguiente ";?>:          
        </p>                                               
        </div>
        <div >
          <h3>Recomendaciones:</h3>
          <aside class="details">
            <textarea id="desc" readonly><?php echo $desc;?></textarea>             
          </aside>
        </div>
    </section>
    <?php
   }
  }
  }
    ?>
    
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