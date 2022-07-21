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
  <link rel="stylesheet" href="css/analizar.css" />
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
  <main id="wrapper" class="container mx-auto">
  <section class="wrapper-formulario">
  <?php
  if ((isset($_POST["enviado"]))) {
    $usuario= $_SESSION["id_usuario"];
    $num_orina = $_POST["num_orina"];
    $num_miccion = $_POST["num_miccion"];
    
    $mysqli = new mysqli($host, $user, $pw, $db);       
    $sql = "INSERT INTO formularios(id, num_orina, num_miccion, presion, diabetes, medicamento, acido, reumaticas, enf_renales, quistes_ren, color_orina, porc_riesgo, usuario_id) 
    VALUES (NULL, '$num_orina','$num_miccion','$presion','$diabetes', '$medicamento' ,'$acido','$reumaticas', '$enf_renal', '$quiste', '$color', '$Porc', '$usuario')";            
    $result1 = $mysqli->query($sql);          

  if ($result1 == 1 ) {
    header('Location:gestion_diag.php?mensaje=1');
  } else
    header('Location:gestion_diag.php');
  }

  else {
    $id_form_enc = $_GET["id_form_enc"];
  $mysqli = new mysqli($host, $user, $pw, $db);
  $sqlenc = "SELECT * from formularios";
  $resultenc = $mysqli->query($sqlenc);
  while($rowenc = $resultenc->fetch_array(MYSQLI_NUM))
  {  
    $id_form  = $rowenc[0];
    if (md5($id_form) == $id_form_enc)
      $id_form_enc = $id_form;
  }
  $sql1 = "SELECT * from formularios where id='$id_form_enc'";
  $result1 = $mysqli->query($sql1);
  $row1 = $result1->fetch_array(MYSQLI_NUM);
  $num_orina = $row1[1];
  $num_miccion = $row1[2];
  $presion = $row1[3];

  $diabetes = $row1[4];
  if ($diabetes == 1)
  $desc_diabetes = "Sí";
  else  
  $desc_diabetes = "No";

  $medicamento = $row1[5];  
  
  $acido = $row1[6];
  if ($acido == 1)
  $desc_acido = "Sí";
  else  
  $desc_acido = "No";

  $reumaticas = $row1[7];
  if ($reumaticas == 1)
  $desc_reumaticas = "Sí";
  else  
  $desc_reumaticas = "No";

  $enf_renal = $row1[8];
  if ($enf_renal == 1)
  $desc_enf_renal = "Sí";
  else  
  $desc_enf_renal = "No";

  $quiste = $row1[9];
  if ($quiste == 1)
  $desc_quiste = "Sí";
  else  
  $desc_quiste = "No";
  
  $color = $row1[10];  

  $porc_riesgo=$row1[11];
  
  
?>
  <a id="back" href="diagnostico.php"></a>        
  <h3 id="title">Formulario ECR #<?php echo $id_form_enc ?></h3>
  <div class="formulario">             
  <div class="formulario item1">      
    <p>Número de veces que orina en 24 horas:</p> 
    <input type="number" name=num_orina placeholder="" value="<?php echo $num_orina; ?>" min="0" pattern="^[0-9]+" readonly>
  </div>    
  <div class="formulario item1">       
    <p>¿Cuántas veces se levanta en la noche para orinar?</p> 
    <input type="number" name=num_miccion placeholder="" value="<?php echo $num_miccion; ?>" min="0" pattern="^[0-9]+" readonly>
    </div>
  <div class="formulario item1">  
    <p>Presión arterial:</p> 
    <input type="text" name=presion placeholder="" value="<?php echo $presion; ?>"  readonly>
  </div>             
  <div class="formulario item1">
  <p>¿Padece de diabetes?</p>     
    <input type="text" name=diabetes placeholder="" value="<?php echo $desc_diabetes; ?>"  readonly>
  </div>            
  <div class="formulario item1">               
    <p>¿Padece enfermedades reumáticas? (Artritis, Lupus, Gota, entre otras)</p>     
    <input type="text" name=reumaticas placeholder="" value="<?php echo $desc_reumaticas; ?>"  readonly>
  </div>
  <div class="formulario item1">             
    <p>¿Familiares con enfermedades renales?</p>       
    <input type="text" name=enf_renal placeholder="" value="<?php echo $desc_enf_renal; ?>"  readonly>
  </div>
  <div class="formulario item1">              
    <p>¿Familiares con quistes renales?</p>     
    <input type="text" name=quiste placeholder="" value="<?php echo $desc_quiste; ?>"  readonly>
  </div>
  <div class="formulario item1">              
    <p>¿Padece de ácido úrico?</p> 
    <input type="text" name=acido placeholder="" value="<?php echo $desc_acido; ?>"  readonly>
  </div>
  <div class="formulario item1">
    <p>Medicamento consumido con más frecuencia (más de 3 veces a la semana):</p>                
    <?php 	
    $sql = "SELECT descripcion from medicamentos where id='$medicamento'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_array(MYSQLI_NUM);
    $medicamento_con = $row[0];
    ?>
    <input type="text" name=medicamento placeholder="" value="<?php echo $medicamento_con; ?>"  readonly>              
    </div>
  
  <div class="formulario item1">
    <p>¿Cómo es su orina?</p>            
    <?php 	
    $sql = "SELECT descripcion from color_orina where id='$color'";
    $result = $mysqli->query($sql);
    $row = $result->fetch_array(MYSQLI_NUM);
    $color_con = $row[0];       
    ?>
    <input type="text" name=color placeholder="" value="<?php echo $color_con; ?>"  readonly>              
    </div>    
  <div class="formulario item1">          
    <p>Porcentaje de riesgo</p> 
    <input type="number" name=riesgo placeholder="" value="<?php echo $porc_riesgo; ?>"  readonly>
  </div>            
    <br><br><br>
  <?php
  }
  ?>  
  </section>
  <section class="wrapper-formulario">
     
  </section>  
</body>
</html>