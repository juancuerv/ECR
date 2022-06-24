<?php
include "conexion.php";  // Conexi�n tiene la informaci�n sobre la conexi�n de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aqu� se hace la conexi�n a la base de datos.
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

<body>

  <main id="wrapper" class="container mx-auto">
  <section class="wrapper-gestion">
  <?php
  if ((isset($_POST["enviado"]))) {

    $nombre_usuario = $_POST["nombre_usuario"];
    $apellido_usuario = $_POST["apellido_usuario"];
    $correo = $_POST["correo"];
    $genero = $_POST["genero"];
    $num_id = $_POST["num_id"];
    $fecha = $_POST['fecha_nac'];
    $ciudad = $_POST["ciudad"];
    $departamento = $_POST["departamento"];
    $login = $_POST["login"];
    $password = $_POST["password"];
    $passwordcmp = $_POST["passwordcmp"];
    if($password!=$passwordcmp){
      header('Location:inicio.php?mensaje=1');
    }
    else{
    $password_enc = md5($password);
    $mysqli = new mysqli($host, $user, $pw, $db);
    $sqlcon = "SELECT * from usuarios where num_id='$num_id'";
    $resultcon = $mysqli->query($sqlcon);
    $rowcon = $resultcon->fetch_array(MYSQLI_NUM);
    $numero_filas = $resultcon->num_rows;
  if ($numero_filas > 0) {
    header('Location:inicio.php?mensaje=5');
  } else {
    
    $sql = "INSERT INTO usuarios(id, num_id, login, pass, tipo_usuario, activo, ciudades_id, nombres, apellidos, fecha_nac, genero, correo) 
    VALUES (NULL, '$num_id','$login','$password_enc', 2, 1 ,'$ciudad','$nombre_usuario', '$apellido_usuario', '$fecha', '$genero', '$correo')";            
    $result1 = $mysqli->query($sql);          
         

  //echo "result es...".$result1;
  if ($result1 == 1 ) {
    session_start();
    $_SESSION["autenticado"]= "SIx3";
    $tipo_usuario = 2;
    $sql2 = "SELECT * from tipo_usuario where id='$tipo_usuario'";
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_array(MYSQLI_NUM);
    $desc_tipo_usu = $row2[1];
    $_SESSION["tipo_usuario"]= $desc_tipo_usu;
    $_SESSION["nombre_usuario"]= $login;  
    $_SESSION["nombres"]= $nombre_usuario;  
    $sql2 = "SELECT MAX(id) from usuarios";
    $result2 = $mysqli->query($sql2);
    $row2 = $result2->fetch_array(MYSQLI_NUM);
    $_SESSION["id_usuario"]= $row2[1];
    header('Location:home_cliente.php');
    
  
  } else
    header('Location:inicio.php?mensaje=3');
  }
  }
  } else {
  ?>
  <a id="back" href="inicio.php"></a>        
  <h1 id="registrar">Registrar usuario</h1>
  <div class="formulario">             
  <form method=POST action="registrar.php" onsubmit="return confirm('¿Está seguro de que la información que proporciona es correcta?');">
  <div class="formulario item1">      
    <p>Nombres:</p> 
    <input type="text" name=nombre_usuario placeholder="" value="" required>
  </div>    
  <div class="formulario item1">       
    <p>Apellidos:</p> 
    <input type="text" name=apellido_usuario placeholder="" value="" required>
    </div>
    <div class="formulario item1">       
    <p>Correo:</p> 
    <input type="email" name=correo placeholder="" value="" required>
    </div>
  <div class="formulario item1">  
    <p>Genero:</p> 
    <select class="select-css" name=genero required>
    <option value="1"> Masculino  &emsp;&emsp;</option>
    <option value="2"> Femenino   &emsp;&emsp;   </option>
    </select>
  </div>
  <div class="formulario item1">           
    <p>Número de identificación:</p> 
    <input type="text" name=num_id placeholder="" value="" required>
    </div>
  <div class="formulario item1">
    <p>Fecha de nacimiento:</p>            
    <input type="date" name=fecha_nac placeholder="" value="" required>
    </div>

    <div class="formulario item1">           
    <p>Municipio de residencia:</p> 
    <select class="select-css" name=ciudad required>  
    
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
      <input type="text" name=login placeholder="" value="" required>                      
    </div>
    <div class="formulario item1">  
      <p>Contraseña:</p> 
      <input type="password" name=password placeholder="" value="" required>                  
    </div>

    <div class="formulario item1">  
      <p>Confirmar contraseña:</p> 
      <input type="password" name=passwordcmp placeholder="" value="" required>                  
    </div>
    
        
    <input id="save" type=submit value="Registrar" name="Registrar">    
    <input type="hidden" value="S" name="enviado">
    <br><br><br>

  </form>                      
                  
  <?php
  }
  ?>  
  </section>
</body>
</html>