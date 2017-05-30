<?php
session_start();
if(!isset($_SESSION['usuario']))
    header('Location: index.php');
if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $usuario=$_SESSION['usuario'];
        $rfc=$_POST['rfc'];
        $nombre=$_POST['nombre'];
        $calle=$_POST['calle'];
        $numero=$_POST['numero'];
        $colonia=$_POST['colonia'];
        $cp=$_POST['cp'];
        $municipio=$_POST['municipio'];
        $estado=$_POST['estado'];
        $email=$_POST['email'];
        $errores='';

        $conexion= new mysqli('localhost','root','','proyecto');
        if($conexion->connect_error)
            die($conexion->connect_error);
        $consulta="INSERT INTO datosrfc VALUES('$rfc','$nombre','$calle','$numero','$colonia','$cp','$municipio','$estado','$email')";
        $resultado= $conexion->query($consulta);
        if(!$resultado)
            die("Error: " . $conexion->error);
        echo "Datos agregados"
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
    <title>Document</title>
</head>
<body>
    <h1>Datos de Facturacion</h1>
    <form method="POST">
        RFC: <input type="text" name= "rfc"><br>
        Nombre: <input type="text" name= "nombre"><br>
        Calle: <input type="text" name= "calle"><br>
        Numero: <input type="text" name= "numero"><br>
        Colonia: <input type="text" name="colonia"><br>
        Cp: <input type="text" name="cp"><br>
        Municipio: <input type="text" name="municipio"><br>
        Estado: <input type="text" name="estado"><br>
        Email: <input type="text" name="email"><br>
        <input type="submit" value="Facturas">
    </form>
    <a href='cerrarSesion.php'>Cerrar Sesion</a>
</body>
</html>