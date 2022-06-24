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
  <link rel="stylesheet" href="css/formulario.css" />
  <link rel="icon" href="img/logo2.jpeg" />  
  <title>SysKidney</title>
</head>
  
<body>
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
  <main id="wrapper" class="container mx-auto">
  <section class="wrapper-formulario">
  <?php
  if ((isset($_POST["enviado"]))) {
    $usuario= $_SESSION["id_usuario"];
    $num_orina = $_POST["num_orina"];
    $num_miccion = $_POST["num_miccion"];
    $presion = $_POST["presion"];
    $diabetes = $_POST["diabetes"];
    $reumaticas = $_POST['reumaticas'];
    $enf_renal = $_POST["enf_renal"];
    $quiste = $_POST["quistes_renal"];
    $acido = $_POST["acido"];
    $medicamento = $_POST["medicamento"];
    $color = $_POST["color"];
    //Lógica difusa para iable Orina
     $a= 3-$num_orina;
   $b= $a/3;
   $c=$num_orina*1;
   $h= $c/3;
   $d=5-$num_orina;
   $e=$d/2;
   $f=$num_orina-3;
   $g=$f/2;
  
   $OM=max(min(1,$b), min($h,$e));
   $OMax= max($OM, min($g,1));
   $num_orinaf=$OMax*6;
  
  //Lógica difusa para iable Miccion
   $i=2-$num_miccion;
   $j=$num_miccion-1;
   $k= 3-$num_miccion;
   $l=$num_miccion-2;
   $MM=max(min(1,$i),min($j,$k));
   $MMax= max($MM, min($l,1));
   $num_miccionf=$MMax*3;

  //Lógica difusa para iable presion
   $m=130-$presion;
   $n= $m/130;
   $o= $presion-120;
   $p= $o/10;
   $q=140-$presion;
   $r=$q/10;
   $s=$presion-130;
   $t=$s/10;

   $PM=max(min(1,$n), min($p,$r));
   $PMax=max($PM, min($t,1));
   $presionf= $PMax*6;

  //Lógica difusa para iable diabetes
   $diabetesf;
  if($diabetes==1){
    $diabetesf=2;
  }
  else{
    $diabetesf=1;
  }  
  
  //Lógica difusa para iable medicamentos
   $acidof;
  if($acido==1){
    $acidof=2;
  }
  else{
    $acidof=1;
  }
  //Lógica difusa para iable medicamentos
   $reumaticasf;
  if($reumaticas==1){
    $reumaticasf=2;
  }
  else{
   $reumaticasf=1;
  }
  //Lógica difusa para iable medicamentos
   $enf_renalf;
  if($enf_renal==1){
    $enf_renalf=5;
  }
  else{
    $enf_renalf=1;
  }
  //Lógica difusa para iable medicamentos
   $quistef;
  if($quiste==1){
    $quistef=2;
  }
  else{
    $quistef=1;
  }
  

   $salida= $num_orinaf+$num_miccionf+$presionf+$diabetesf+$medicamento+$acidof+$reumaticasf+$enf_renalf+$quistef;
   $u=16.5-$salida;
   $v1=$u/4.5;
   $w=$salida-12;
   $x=$w/4.5;
   $y=33-$salida;
   $z=$y/16.5;
   $a1=$salida-16.5;
   $b1=$a1/16.5;
  
   $SM =max(min(1,$v1), min($x,$z));
   $SMax= max($SM,min($b1,1));
   $salidaf=$SMax*100;
   $Porc=round($salidaf,2);

    $mysqli = new mysqli($host, $user, $pw, $db);       
    $sql = "INSERT INTO formularios(id, num_orina, num_miccion, presion, diabetes, medicamento, acido, reumaticas, enf_renales, quistes_ren, color_orina, porc_riesgo, usuario_id) 
    VALUES (NULL, '$num_orina','$num_miccion','$presion','$diabetes', '$medicamento' ,'$acido','$reumaticas', '$enf_renal', '$quiste', '$color', '$Porc', '$usuario')";            
    $result1 = $mysqli->query($sql);          

  if ($result1 == 1 ) {
    header('Location:diagnostico_form.php');
  } else
    header('Location:diagnostico_form.php');
  }  
  else {
  ?>
  <a id="back" href="diagnostico.php"></a>        
  <h1 id="registrar">Formulario ECR</h1>
  <div class="formulario">             
  <form name="form1" method=POST action="formulario.php" onsubmit="return confirm('¿Confirma la información proporcionada?');">
  <div class="formulario item1">      
    <p>Número de veces que orina en 24 horas:</p> 
    <input type="number" name=num_orina placeholder="" value="" min="0" pattern="^[0-9]+" required>
  </div>    
  <div class="formulario item1">       
    <p>¿Cuántas veces se levanta en la noche para orinar?</p> 
    <input type="number" name=num_miccion placeholder="" value="" min="0" pattern="^[0-9]+" required>
    </div>
  <div class="formulario item1">  
    <p>Presión arterial:</p> 
    <input type="text" name=presion placeholder="Ejemplo: 130" value=""  required>
  </div>
  <div class="formulario item1">           
  <div>
  <p>¿Padece de diabetes?</p> 
    </div> 
    <div class="formulario radio1">
    <label for="Si">Sí</label><input type="radio" id="Si" name="diabetes" value="1">
    <label for="No">No</label><input type="radio" id="No" name="diabetes" value="0" checked>
    </div>        
    </div>
  <div class="formulario item1">           
    <div>
    <p>¿Padece enfermedades reumáticas? (Artritis, Lupus, Gota, entre otras)</p> 
    </div> 
    <div class="formulario radio1">
    <label for="Si">Sí</label><input type="radio" id="Si" name="reumaticas" value="1">
    <label for="No">No</label><input type="radio" id="No" name="reumaticas" value="0" checked>
    </div>    
    </div>
  <div class="formulario item1">           
    <div>
    <p>¿Familiares con enfermedades renales?</p> 
    </div> 
    <div class="formulario radio1">
    <label for="Si">Sí</label><input type="radio" id="Si" name="enf_renal" value="1">
    <label for="No">No</label><input type="radio" id="No" name="enf_renal" value="0" checked>
    </div>
    </div>
  <div class="formulario item1">          
    <div>
    <p>¿Familiares con quistes renales?</p> 
    </div> 
    <div class="formulario radio1">
    <label for="Si">Sí</label><input type="radio" id="Si" name="quistes_renal" value="1">
    <label for="No">No</label><input type="radio" id="No" name="quistes_renal" value="0" checked>
    </div>
    </div>
    <div class="formulario item1">          
    <div>
    <p>¿Padece de ácido úrico?</p> 
    </div> 
    <div class="formulario radio1">
    <label for="Si">Sí</label><input type="radio" id="Si" name="acido" value="1">
    <label for="No">No</label><input type="radio" id="No" name="acido" value="0" checked>
    </div>
  </div>
  <div class="formulario item1">
    <p>Medicamento consumido con más frecuencia (más de 3 veces a la semana):</p>            
    <select class="select-css" name=medicamento required>
    <?php 	
    $sql = "SELECT * from medicamentos order by id";
    $result = $mysqli->query($sql);
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $medicamento_con = $row[0];
      $desc_medicamento_con = $row[1];
      if ($medicamento_con != $medicamento) {
        ?>   
        <option value="<?php echo $medicamento_con; ?>"> <?php echo $desc_medicamento_con; ?>&ensp;&ensp;&ensp;</option>  
        <?php
        }   
    }
    ?>
    </select>
    </div>
  
  <div class="formulario item1">
    <p>¿Cómo es su orina?</p>            
    <select class="select-css" name=color required>
    <?php 	
    $sql = "SELECT * from color_orina order by id";
    $result = $mysqli->query($sql);
    while($row = $result->fetch_array(MYSQLI_NUM)) {
      $color_con = $row[0];
      $desc_color_con = $row[1];
      if ($color_con != $color) {
        ?>   
        <option value="<?php echo $color_con; ?>"> <?php echo $desc_color_con; ?>&ensp;&ensp;&ensp;</option>  
        <?php
        }   
    }
    ?>
    </select>
    </div>
    
        
    <input id="send" type=submit value="Diagnosticar" name="Diagnosticar">    
    <input type="hidden" name="enviado">    
    <br><br><br>

  </form>                                     
  <?php
  }
  ?>  
  </section>
</body>
</html>