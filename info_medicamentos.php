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
  <a id="back" href="info_formulario.php"></a>
    <section class="wrapper-inicio">
      <div class="wrapper-inicio-photo">
        <img id="photo" src="img/medico.png" width="400" height="500" alt="foto de perfil" />
      </div>
      <div class="wrapper-inicio-description">        
        <div>
          <h1>Tipos de Medicamentos:</h1>
          <p id="med1">
            Existen distintos tipos de medicamentos que pueden tener una repercusión negativa en la salud, especialmente en 
            la salud de los riñones si se consumen de forma desmesurada, a continuación se describen ciertos medicamentos perjudiciales para la salud si se consumen en exceso:
          </p>
          <ol>
            <li><strong>Aines</strong> (medicamentos antiinflamatorios no esteroides), algunos ejemplos son: celecoxib (Celebrex),
              diclofenaco (Voltaren), etodolaco (Lodine), indometacina (Indocin) o piroxicam (Feldene)</li>
            <li><strong>Antibióticos</strong>, algunos ejemplos son: amoxicilina, azitromicina (Zithromax), cefalexina (Keflex) o ciprofloxacina (Cipro)</li>
            <li><strong>Antifúngicos</strong>, algunos ejemplos son: Nistatina, Imidazol, clotrimazol, naftifina, caspofungina, Flucitosina, Yoduro de potasio, etcétera.</li>
            <li><strong>Inmunosupresores</strong>, algunos ejemplos son: Esteroides, Hidroxicloroquina, Sulfasalazina, Metotrexato, Azatioprina, entre otros.</li>
            <li><strong>Inhibidores de enzima convertidora</strong>, algunos ejemplos son: Benazepril, Captopril, entre otros.</li>
            <li><strong>Antivirales</strong>, algunos ejemplos son: Aciclovir, Amantadina, Ganciclovir, Idoxuridina, Rimantadina, entre otros. </li>
      
          </ol>              
    
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