<?php
session_start();
if(!isset($_SESSION['usuario']))
    header('Location: index.php');
if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $usuario=$_SESSION['usuario'];
        $horario=$_POST['horario'];
        $dia=$_POST['dia'];
        $comentarios=$_POST['coment'];
        $errores='';
        if(empty($usuario))
        {
            $errores.='<p>Usuario vacios</p>';
        }

            $conexion= new mysqli('localhost','root','','proyecto');
            if($conexion->connect_error)
                die($conexion->connect_error);
            $consulta="SELECT * FROM citas WHERE horario='$horario' AND dia='$dia'";
            $resultado= $conexion->query($consulta);
            if(!$resultado)
                die("Error: " . $conexion->error);
            if($resultado->num_rows != 0)
            {
                $errores.='<p>El dia y hora estan no estan disponibles</p>';
            }
            else
            {
                $consulta="INSERT INTO citas VALUES(NULL,'$usuario','$horario','$dia','$comentarios')";
                $resultado= $conexion->query($consulta);
                if(!$resultado)
                    die("Error: " . $conexion->error);
                echo "Cita agendada";
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
    <title>Agenda tu cita</title>
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
      <a href="sesion.php">Comentarios</a>
    </div>
    <h1>Programa tu Cita</h1>
    <form method="POST">
        Dia: <input type="text" name= "dia"> <br>
        Horario: <input type="text" name= "horario"><br>
        Comentarios: <input type="text" name="coment"><br>
        <input type="submit" value="Agendar">
    </form>
    <a href='actualiza.php'>Actualiza tus datos</a> <br>
    <a href='datosRfc.php'>Ingresa tus datos de facturacion</a> <br>
    <a href='cerrarSesion.php'>Cerrar Sesion</a>
</body>
</html>