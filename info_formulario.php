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

<body>
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
  <a id="back" href="home_cliente.php"></a>
    <section class="wrapper-inicio">
      <div class="wrapper-inicio-photo">
        <img id="photo" src="img/medico.png" width="400" height="500" alt="foto de perfil" />
      </div>
      <div class="wrapper-inicio-description">        
        <div>
          <h1>Formulario ECR</h1>
          <p>
            El formulario que se debe completar, consiste en proporcionar información personal e importante para determinar el porcentaje de probabilidad
            que tiene de padecer la enfermedad, se encontrará que el formulario requiere:
          </p>
          <ol>
            <li>Número de veces que orina en 24 horas</li>
            <li>Número de micciones por la noche </li>
            <li>Presión arterial del paciente</li>
            <li>Diabetes</li>
            <li>Consumo de medicamentos con frecuencia (más de 3 veces a la semana). Conoce los tipos de medicamentos considerados <a id="med" href="info_medicamentos.php">aquí</a>.</li>
            <li>Padecer ácido úrico (Def: el ácido úrico se produce cuando el metabolismo desintegra las purinas, que proceden en gran parte de la dieta, aunque el organismo también las fabrica. Estas sustancias se encuentran en algunos alimentos y bebidas como el hígado, las anchoas, las judías, la caballa o la cerveza, entre otros).</li>
            <li>Enfermedades reumáticas (Artritis, Lupus, Gota, entre otras)</li>
            <li>Familiares con enfermedades renales</li>
            <li>Familiares con quistes renales</li>
            <li>Color de orina</li>
          </ol>              
          <p>Requerimos que la información proporcionada sea lo más veraz y acertada posible para realizar un diagnóstico correcto.</p>                                           
        </div>             
        <a id="btn_formulario" href="formulario.php">¡Llena el formulario!</a>
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