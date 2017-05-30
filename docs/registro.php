<?php
    session_start();
    $ubicacion='localhost';
    $usuario='root';
    $contServ='';
    $bd='proyecto';

    if(isset(($_SESSION['usuario'])))
    {
        header('Location: index.php');
    }
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $usuario=$_POST['usuario'];
        $nombre=$_POST['nombre'];
        $telefono=$_POST['telefono'];
        $rfc=$_POST['rfc'];
        $contraseña=$_POST['contraseña'];
        $contraseña2=$_POST['contraseña2'];
        $errores='';
        if(empty($usuario) or empty($contraseña) or empty($contraseña2))
        {
            $errores.='<p>Usuario o contraseña vacios</p>';
        }
        else if($contraseña!=$contraseña2)
        {
            $errores.='<p>Las contraseñas no coinciden</p>';
        }
        else
        {
            $conexion= new mysqli('localhost','root','','proyecto');
            if($conexion->connect_error)
                die($conexion->connect_error);
            $consulta="SELECT * FROM clientes WHERE usuario='$usuario'";
            $resultado= $conexion->query($consulta);
            if(!$resultado)
                die($conexion->error);
            if($resultado->num_rows != 0)
            {
                $errores.='<p>El usuario ya existe</p>';
            }
            else
            {
                $contraseña=hash('md5','$o#'.$contraseña.'@8!');
                $consulta="INSERT INTO clientes VALUES(NULL,'$usuario','$contraseña','$telefono','$nombre','$rfc')";
                $conexion->query($consulta);
                if(!$resultado)
                    die($conexion->error);
                header('Location:contenido.php');
            }
            $conexion->close();
        }
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
    <h1>Formulario de Registro</h1>
    <form method="POST">
        Usuario: <input type="text" name= "usuario"> <br> 
        Nombre: <input type="text" name= "nombre"><br>
        Telefono: <input type="text" name= "telefono"><br>
        RFC: <input type="text" name= "rfc"><br>
        Contraseña: <input type="password" name= "contraseña"> <br>
        Contraseña Nuevamente: <input type="password" name= "contraseña2"><br>
        <input type="submit" value="Registrar">
    </form>
    <p>Ya tienes cuenta??</p> <br>
    <a href="sesion.php">Ingresa a tu cuenta</a>
</body>
</html>