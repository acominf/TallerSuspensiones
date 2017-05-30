<?php
session_start();
if(!isset($_SESSION['usuario']))
    header('Location: index.php');
if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $usuario=$_SESSION['usuario'];
        $telefono=$_POST['telefono'];
        $rfc=$_POST['rfc'];
        $errores='';

        $conexion= new mysqli('localhost','root','','proyecto');
        if($conexion->connect_error)
            die($conexion->connect_error);
        $consulta="SELECT * FROM clientes WHERE usuario='$usuario'";
        $resultado= $conexion->query($consulta);
        if(!$resultado)
            die("Error: " . $conexion->error);
        if($resultado->num_rows == 1)
        {
            $consulta="UPDATE clientes SET telefono ='$telefono' WHERE usuario='$usuario'";
            $resultado= $conexion->query($consulta);
            if(!$resultado)
                die("Error: " . $conexion->error);
            echo "Datos actulizados";
        }
        $conexion->close();
        echo $errores;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualiza tus datos</title>
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
      <a href="sesionAdmin.php">Administrador</a>
      <a href="sesion.php">Comentarios</a>
    </div>
    <h1>Actualiza tus Datos</h1>
    <form method="POST">
        Telefono: <input type="text" name= "telefono"><br>
        RFC: <input type="text" name= "rfc"><br>
        <input type="submit" value="Actualizar">
    </form>
    <a href='cerrarSesion.php'>Cerrar Sesion</a>
</body>
</html>