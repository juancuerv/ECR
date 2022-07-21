                                                       
<?php

// PROGRAMA DE VALIDACION DE USUARIOS
                   
                                                       
$login = $_POST["username"];
$passwd = $_POST["password"];

$passwd_comp = md5($passwd);
session_start();

//echo "login es...".$login;
//echo "password es...".$passwd;

include ("conexion.php");

$mysqli = new mysqli($host, $user, $pw, $db);
       
$sql = "SELECT * from usuarios where login = '$login'";
$result1 = $mysqli->query($sql);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$numero_filas = $result1->num_rows;
if ($numero_filas > 0)
  {
    $passwdc = $row1[3];

    if ($passwdc == $passwd_comp)
      {
        $_SESSION["autenticado"]= "SIx3";
        $tipo_usuario = $row1[4];
        $nombre_usuario = $row1[2];
        $nombres = $row1[7];
        $sql2 = "SELECT * from tipo_usuario where id='$tipo_usuario'";
        $result2 = $mysqli->query($sql2);
        $row2 = $result2->fetch_array(MYSQLI_NUM);
        $desc_tipo_usu = $row2[1];
        $_SESSION["tipo_usuario"]= $desc_tipo_usu;
        $_SESSION["nombre_usuario"]= $nombre_usuario;  
        $_SESSION["nombres"]= $nombres;  
        $_SESSION["id_usuario"]= $row1[0];  
        
        if ($tipo_usuario == 1)
            header("Location: gestion_usua.php");
        elseif($tipo_usuario == 2)
            header("Location: home_cliente.php");
        else{
        $sql2 = "SELECT * from medicos where usuario_id='$row1[0]'";
        $result2 = $mysqli->query($sql2);
        $row2 = $result2->fetch_array(MYSQLI_NUM);        
        $_SESSION["id_medico"]=$row2[0];
        header("Location: home_medico.php");
      }
            
      }
    else 
     {
      header('Location: inicio.php?mensaje=1');
     }
  }
else
  {
    header('Location: inicio.php?mensaje=2');
 }  
?>
