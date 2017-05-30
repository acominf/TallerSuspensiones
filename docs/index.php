<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Proyecto</title>
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
    <div class="slider">
	    <div class="images" id="imagenes">
        <div class="divImg" id="divImg"><img src="mapa.png"/></div>
        <div class="divImg" id="divImg"><img src="2.jpg"/></div>
        <div class="divImg" id="imgImg"><img src="3.jpg"/></div>
        <div class="divImg" id="imgImg"><img src="4.jpg"/></div>
	    </div>
	</div>
	<div class="controles" id="controles">
		<div class="flechas">
			<div class="atras" id="atras" onclick="cambio(0)" >
	   			<i class="fa fa-chevron-circle-left fa-5x" aria-hidden="true"></i>
			</div>
			<div class="delante" id="delante"  onclick="cambio(1)">
				<i class="fa fa-chevron-circle-right fa-5x" aria-hidden="true"></i>
			</div>
		</div>
		<div class="recorre" id="recorre" style="left: 374px; top: 9px"></div>
	</div>
</div>
    <main>  
    </main>
    <script src= "main.js"></script>
  </body>
</html>
