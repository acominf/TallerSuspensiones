var listaImg;
	var opacidad;
	var listaTex;
	var cont;
	var interval;
	var sentido;
	function inicio(){
		listaImg= document.getElementById("imagenes").children;
		cont=0;
		opacidad = 1;
		sentido=0;

		for(i=0 ; i<listaImg.length; i++)
		{
			document.getElementById("recorre").innerHTML += "<div class="+"'mark'>"+"<i class='fa fa-square fa-2x'" + "aria-hidden='true' onclick=" + "'cambiaMark("+ i+")'" +"></i>" + "</div>";
		}
		listaImg[cont].style.opacity = String(opacidad);
		listaImg[cont].style.visibility = "visible";
	    interval = setInterval(recorridoImagen,30);
	}
	function cambiaMark(index)
	{
		clearInterval(interval);
		listaImg[cont].style.visibility = "hidden";
		listaImg[cont].style.opacity = 0;
		cont = index;
		opacidad=1;
		direccion= 0;
		listaImg[cont].style.visibility = "visible";
		listaImg[cont].style.opacity = 1;
		interval = setInterval(recorridoImagen,30);
	}
	
	function cambio(dir)
	{
		clearInterval(interval);
		listaImg[cont].style.visibility = "hidden";
		listaImg[cont].style.opacity = 0;
		if(dir==0)
		{
			if(cont == 0)
			{
				cont = listaImg.length-1;
			}else
			{
				cont = cont-1;
			}
		}else
		{
			if(cont == listaImg.length-1)
			{
				cont = 0;
			}else
			{
				cont = cont+1;
			}
		}
		opacidad=1;
		direccion= 0;
		listaImg[cont].style.visibility = "visible";
		listaImg[cont].style.opacity = 1;;
		interval = setInterval(recorridoImagen,30);
	}
	function recorridoImagen()
	{
		
		if(sentido==0)
		{
		
			disminuyeOpacidad();
		}else
		{
			aumentaOpacidad();
		}
	}
	function aumentaOpacidad()
	{
		opacidad = opacidad+0.01;
		if(opacidad < 1){
		       listaImg[cont].style.opacity = String(opacidad);
		}else
		 {
		    sentido=0;   
		 }
	}
	function disminuyeOpacidad()
	{

		opacidad = opacidad-0.01;
		if(opacidad < 0)
		{
			sentido=1;
			listaImg[cont].style.visibility = "hidden";
			listaImg[cont].style.opacity = 0;
			cont++;
			if(cont > listaImg.length-1 )
			{
				cont=0;
			}
			listaImg[cont].style.visibility = "visible";
			listaImg[cont].style.opacity = 0;
		}else
		{
			 listaImg[cont].style.opacity = String(opacidad);
		}
	}