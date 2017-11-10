<!--Crea la conexión a la base de datos-->
<?php
include("clase/conectar.php");
?> 

<!DOCTYPE html>
<html >
<head>
<title>ROXANNA</title>
</head>
<body>
  <div class="login">
    <div class="login-screen">
      <div class="app-title">
        <h1>Ingresa tus Datos</h1>
      </div>
      <form method="post">
      <div class="login-form">
        <div class="control-group">
        <label>Nombre de Usuario:</label>
        <input type="text"placeholder="Nombre de Usuario" name="nickname" required />
        </div>

        <div class="control-group">
        <label>Contraseña:</label>
        <input type="password" placeholder="Contraseña" name="password" />
        </div>

        <button type="submit" name="boton" value="Entrar" class="btn btn-info">Entrar</button></form>
      </div>
    </div>
  </div>
</body>
</html>


<!--Abrimos PHP para verificar si el logeo es correcto-->
<?php
session_start();

if(isset($_POST["boton"])){//Abrimos if isset
$nickname = $_POST["nickname"];
$password = $_POST["password"];

$query = $conn->prepare("SELECT COUNT(id_usuario) FROM materias WHERE nickname = '$nickname' and passwd = '$password'");
$query->execute();
$count = $query->fetchColumn();

//Verificamos si los datos enviados estan registrados en la base de datos
if($count == "1"){//Abrimos if count
          $_SESSION["nickname"]= $nickname;
          $_SESSION["valida"]="yes";
          header('location: inicio.php');
}//Cerramos if count
else{//Mostramos mensaje que los datos ingresados no existen
        ?>
        <!--Aca estoy cerrando PHP y es puro HTML-->
        <div class="alert alert-danger"><b>¡Error!</b> Los datos son incorrectos</div>
        <script>
            document.getElementById("password").focus();
        </script>
        <!--Aca estoy abriendo PHP-->
        <?php 
      }//Terminamos de mostrar el mensaje que los datos ingresados no existen
}//Cerramos if isset
?>
