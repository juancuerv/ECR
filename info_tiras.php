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
    <section class="wrapper-tiras bk1">
      <a id="back" href="home_cliente.php"></a>
      <h1>Pasos para realizar el escaneo de tiras reactivos</h1>
      
      <div class="tiras-container">
        <div class="tiras">
        <a href="https://diagnosticoencasa.com/guia-utilizacion-tiras-reactivas-en-analisis-de-orina/" target="blanck">
          <h3>Paso N° 1</h3>            
          <img id="tiras1" src="img/tiras/tiras.jpg" alt="ejemplo de tiras" />    
        </a>
        <div>    
          <p>El segundo paso, después de que poseas las tiras, es llevar a cabo la prueba, para ello se recomienda:</p>
          <ol>
            <li>Contar con un frasco de orina estéril.</li>
            <li>Previamente a la toma de la muestra, realizar una limpieza de tus genitales y de tu zona urinaria.</li>
            <li>Realizar la toma de la muestra en las primeras horas de la mañana, justo cuando te levantas puesto que es la mejor.</li>
          </ol>           
        </div>
        </div>
      </div>
      
      <div class="tiras-container">
        <div class="tiras">
        <a href="https://diagnosticoencasa.com/guia-utilizacion-tiras-reactivas-en-analisis-de-orina/" target="blanck">
          <h3>Paso N° 2</h3>            
          <img id="tiras1" src="img/tiras/frasco.jpg" alt="frasco vacío" />    
        </a>
        <div>            
          <p>El primer paso es comprar las tiras reactivas. Existen dos presentaciones:</p>
          <ol>
            <li>Bote con 100 tiras reactivas.</li>
            <li>Sobres con tiras reactivas individuales.</li>
          </ol>
          <p> Asegúrate que la tira o el frasco estén completamente sellados y sin daños en sus envolturas.</p>        
        </div>
        </div>
      </div>

      
      <div class="tiras-container">
        <div class="tiras">
        <a href="https://diagnosticoencasa.com/guia-utilizacion-tiras-reactivas-en-analisis-de-orina/" target="blanck">
          <h3>Paso N° 3</h3>            
          <img id="tiras1" src="img/tiras/frasco_orina.jpg" alt="falta de aire" />    
        </a>
        <div>         
          <p>El tercer paso es tomar la muestra:</p>
          <ol>
            <li>Dirígete a tu inodoro inicia la micción y justo a la mitad de la misma te recomendamos frenarla.</li>
            <li>Con el frasco estéril que mencionamos continua la micción pero ya recogiendo la muestra en el frasco.</li>
            <li>Se necesitan al menos 20 mL de orina para que se sumerja adecuadamente la tira.</li>
          </ol>
          <p> Asegúrate que la tira o el frasco estén completamente sellados y sin daños en sus envolturas.</p>        
        </div>
        </div>
      </div>

      <div class="tiras-container">
        <div class="tiras">
        <a href="https://diagnosticoencasa.com/guia-utilizacion-tiras-reactivas-en-analisis-de-orina/" target="blanck">
          <h3>Paso N° 4</h3>            
          <img id="tiras1" src="img/tiras/tira-reactiva.jpg" alt="abrir tira reactiva" />    
        </a>
        <div>                 
          <p>El cuarto paso es abrir las tiras adquiridas con las siguientes recomendaciones:</p>
          <ol>
            <li>Si has adquirido un frasco, toma una de las tiras por el extremo libre de almohadillas, y almacena las restantes en un lugar fresco, en donde no se expongan a luz solar.</li>
            <li>En el caso que hayas adquirido una tira individual en sobre, esta deberás abrirla con el cuidado de no romper la tira tomándola de la misma manera que mencionamos previamente.</li>            
          </ol>          
        </div>
        </div>
      </div>

      <div class="tiras-container">
        <div class="tiras">
        <a href="https://diagnosticoencasa.com/guia-utilizacion-tiras-reactivas-en-analisis-de-orina/" target="blanck">
          <h3>Paso N° 5</h3><br><br>        
          <img id="tiras1" src="img/tiras/tira_frasco.jpg" alt="usar tira reactiva" />    
        </a>
        <div>                         
          <p>El quinto paso es usar las tiras con las siguientes recomendaciones:</p>
          <ol>
            <li>El análisis de la orina deberás realizarlo antes de 2 horas de haber realizado la toma de muestra, puesto que mientras más tiempo pase hay mayor riesgo de alteración en sus componentes.</li>
            <li>Sumerge la tira reactiva en la orina, sin superar los 2-3 segundos.</li>
            <li>Con un papel absorbente limpio, drena el exceso de orina en la tira dando ligeros toquecitos en el lateral de la tira.</li>
            <li>Deposita la tira en una superficie limpia y plana y espera a que los reactivos cambien de color.</li>
            <li>Evalúa ahora los colores de referencia en el paquete con los que tiene tu tira luego de haber esperado al menos 90 segundos.</li>            
          </ol>          
        </div>
        </div>
      </div>

      <div class="tiras-container">
        <div class="tiras">
        <a href="https://diagnosticoencasa.com/guia-utilizacion-tiras-reactivas-en-analisis-de-orina/" target="blanck">
          <h3>Paso N° 6</h3>            
          <img id="tiras1" src="img/tiras/especialista.jpg" alt="interpretar resultados" />    
        </a>
        <div>                 
          <p>El sexto paso es interpretar los resultados. SysKidney se encargará de interpretar los resultados y de brindar un diagnóstico aproximado. </p>
          <p>Para ello, se deberá subir una foto con buena resolución y en formato png, con el fin de utilizar un algoritmo de análisis de imágenes que determinará si los colores de la tira ha cambiado.</p>
          <p>Si ha cambiado, se le asignará un médico, el cual le pedirá realizar más exámenes y comenzará el seguimiento junto con el tratamiento de la enfermedad, todo mediante SysKidney.</p>
        </div>
        </div>
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