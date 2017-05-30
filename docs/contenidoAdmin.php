<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contenido Administrador</title>
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
    
    <form method="POST">
        <h1> Citas </h1>
        <input  type = "submit" name="mostrar" value = "Mostrar"><br>
        <h1> Eliminar Citas </h1>
        <h4>Escribe ID para eliminar:</h4>
        <input  type = "text" name = "nombreDelete"><br>
        <input  type = "submit" name="eliminar" value = "Eliminar">
    </form>
    <footer>
        <a href='cerrarSesion.php'>Cerrar Sesion</a>
    </footer>
</body>
</html>

<?php
        session_start();
        if(!isset($_SESSION['usuario']))
            header('Location: index.php');
class Ejemplo1
{ 
    //Variable privada para la conexion
    private $conexion;

    //Primer metodo el "CONSTRUCTOR"
    function __construct($ubicacion, $usuario, $contra, $baseDatos) 
    {
       //El constructor abrirá la conexión e informará de los posibles errores.
       $this->conexion = new mysqli($ubicacion, $usuario, $contra, $baseDatos);
       if($this->conexion->connect_error)
            die($this->conexion->connect_error);
    }

    //Segundo metodo el "DESTRUCTOR"
    function __destruct() 
    {
       //Un destructor que cierre la conexión.
       $this->conexion->close();
    }

    //Tercer metodo "ejecutar"
    function ejecutar($consultaSQL)
    {
        $resultado = $this->conexion->query($consultaSQL);
        if(!$resultado)
            die($this->conexion->error);
        $arrayP = array();
        for($i=0; $i < $resultado->num_rows; $i++)
        {
            $resultado->data_seek($i);
            $renglon = $resultado->fetch_array(MYSQLI_ASSOC);
            $var1 = 'ID: '.$renglon['id'].'<br>';
            $var2 = 'Usuario: '.$renglon['usuario'].'<br>';
            $var3 = 'Horario: '.$renglon['horario'].'<br>';
            $var4 = 'Dia: '.$renglon['dia'].'<br>';
            $var5 = 'Comentarios: '.$renglon['comentarios'].'<br>';
            $arrayS = array($var1, $var2, $var3, $var4,$var5);
            array_push($arrayP,$arrayS);
        }
        $resultado->close();
        return $arrayP;
    }

    //Cuarto metodo "imprimir"
    function imprimir($unaTabla)
    {
        //Imprimir la tabla en HTML utilizando la etiqueta <table> y los ciclos foreach de PHP.
        echo '<table>';
        foreach($unaTabla as $ren)
        {
            echo '<tr>';
            foreach($ren as $col)
            {
                echo '<td>'.$col.'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }

    function eliminarUsu($id)
    {
        //$resultado = $this->conexion->query("DELETE FROM usuarios WHERE nombre = '$nombreUsu'");
        $resultado = $this->conexion->prepare("DELETE FROM citas WHERE id = ?");
        $resultado->bind_param("s",$id);
        $resultado->execute();
        if(!$resultado)
            die($this->conexion->error);
    }
}
    $myObj = new Ejemplo1('localhost','root','','proyecto');

    if(isset($_POST['mostrar']))
    {
        //Consultas
        $laTabla = $myObj->ejecutar("SELECT * FROM citas");
        $myObj->imprimir($laTabla);
    }

    if(isset($_POST['eliminar']))
    {
        //Bajas
        $idDelete = $_POST["nombreDelete"];
        if(trim($idDelete) != "")
            $myObj->eliminarUsu($idDelete);
        else
            echo '<h1>ERROR! FALTAN DATOS</h1>';
    }

?>