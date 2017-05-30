<?php
    session_start();

    $ubicacion='localhost';
    $usuario='root';
    $contServ='';
    $bd='proyecto';

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $conexion= new mysqli($ubicacion,$usuario,$contServ,$bd);
        if($conexion->connect_error)
            die($conexion->connect_error);

        $usuario=$conexion->real_escape_string($_POST['usuario']);
        $contraseña=$conexion->real_escape_string($_POST['contraseña']);
        $contraseña=hash('md5','$o#'. $contraseña .'@8!');

        $consulta="SELECT * FROM administrador WHERE usuario='$usuario' AND contrasena='$contraseña'";
        $resultado= $conexion->query($consulta);
        if(!$resultado)
            die("Error: " . $conexion->error);

        if($resultado->num_rows == 1)
        {
            header('Location:contenidoAdmin.php');
            $_SESSION['usuario']= $usuario;
        }
        else
            echo "Usuario o contraseña no valido";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Iniciar Sesion</title>
    <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="estiloProyecto.css" type="text/css">
  </head>
  <body onload="inicio()">
    <div class="encabezadotema">
        <h1>Suspensiones Pancho</h1>
    </div>
    <div class="menutema">
      <a href="index.php">Home</a>
      <a href="informacion.html">Informacion</a>
      <a href="sesion.php">Citas</a>
      <a href="sesionAdmin.php">Admin</a>
      <a href="comentarios.php">Comentarios</a>
    </div>
    <h1>Administrador</h1>
    <form method="POST">
        Usuario: <input type="text" name= "usuario"> <br>
        Contraseña: <input type="password" name= "contraseña"> <br>
        <input type="submit">
    </form>
</body>
</html>