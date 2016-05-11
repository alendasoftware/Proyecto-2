function leeElementoPagina(strNombre, objVentana)
{
	if (objVentana==undefined) objVentana=window
	if (!objVentana.document.all)
		obj=objVentana.document.all[strNombre]
	else
		obj=objVentana.document.getElementById(strNombre)
	return obj
}

function abreimagen(imagen)
	{		
		
		var cad1, cad2, img, pos1, pos2, des;
		var des= imagen.name;				
		var ruta= imagen.src;	//Obtengo la ruta
		var nombre= imagen.alt;	//Obtengo el nombre
		pos1=ruta.lastIndexOf(".",ruta.lenght);	//Hallo la posición donde está '.'
		pos2=ruta.lastIndexOf("/",ruta.lenght);	//Hallo la posición donde está '/'
		
		cad1= ruta.substring(0,pos1);	//desde el punto hacia el principio es la 1ª cadena
		cad2= ruta.substring(pos1, ruta.length)	//desde el punto hasta el final la segunda		
		
		img=ruta.substring(pos2+1, ruta.length) //desde la barra ultima hasta el final para quedarnos con el fichero de imagen
		
		ruta=cad1+"_g"+cad2;	//Compongo la nueva ruta con la imagen en GRANDE

		ampliar=abre_url('ampliar.aspx?des='+des+'&nombre='+nombre+'&ima='+ruta+'&com='+img, 600, 600, 100, 100);
	}

function abregaleria(imagen)
	{		
		
		var cad1, cad2, img, pos1, pos2, des;
		var des= imagen.name;				
		var ruta= imagen.src;	//Obtengo la ruta
		var nombre= imagen.alt;	//Obtengo el nombre
		pos1=ruta.lastIndexOf(".",ruta.lenght);	//Hallo la posición donde está '.'
		pos2=ruta.lastIndexOf("/",ruta.lenght);	//Hallo la posición donde está '/'
		
		cad1= ruta.substring(0,pos1);	//desde el punto hacia el principio es la 1ª cadena
		cad2= ruta.substring(pos1, ruta.length)	//desde el punto hasta el final la segunda		
		
		img=ruta.substring(pos2+1, ruta.length) //desde la barra ultima hasta el final para quedarnos con el fichero de imagen
		
		ruta=cad1+"_g"+cad2;	//Compongo la nueva ruta con la imagen en GRANDE

		ampliar=abre_url('ampliarGaleria.aspx?des='+des+'&nombre='+nombre+'&ima='+ruta+'&com='+img, 600, 600, 100, 100);
	}
		
function abreimagensubDirectorio(imagen)
	{		
		
		var cad1, cad2, img, pos1, pos2;
						
		var ruta= imagen.src;	//Obtengo la ruta
		pos1=ruta.lastIndexOf(".",ruta.lenght);	//Hallo la posición donde está '.'
		pos2=ruta.lastIndexOf("/",ruta.lenght);	//Hallo la posición donde está '/'
		
		cad1= ruta.substring(0,pos1);	//desde el punto hacia el principio es la 1ª cadena
		cad2= ruta.substring(pos1, ruta.length)	//desde el punto hasta el final la segunda		
		
		img=ruta.substring(pos2+1, ruta.length) //desde la barra ultima hasta el final para quedarnos con el fichero de imagen
		
		ruta=cad1+"_g"+cad2;	//Compongo la nueva ruta con la imagen en GRANDE

		ampliar=abre_url('../ampliar.aspx?ima='+ruta+'&com='+img, 40, 30, 100, 100);
	}
		
function abre_url(url, ancho, alto, leftPos, topPos)
{
	var w = 800, h = 600;

	if (document.all || document.layers)
	{
	   w = screen.availWidth;
	   h = screen.availHeight;
	}
	if (leftPos==undefined) leftPos = (w-ancho)/2;
	if (topPos==undefined) topPos = (h-alto)/2;
	return window.open(url,null,'directories=no,location=no,menubar=no,status=no,titlebar=no,toolbar=no,resizable=no,width='+ancho+',height='+alto + ',top=' + topPos + ',left=' + leftPos);
}

function abre_politica(ancho,alto)
{
	var w = 800, h = 600;
    var url = "politica.aspx"
	
	if (document.all || document.layers)
	{
	   w = screen.availWidth;
	   h = screen.availHeight;
	}
	var leftPos = (w-ancho)/2;
	var topPos = (h-alto)/2;
	window.open(url,null,'directories=no,location=no,menubar=no,status=no,titlebar=no,toolbar=no,resizable=no,width='+ancho+',height='+alto + ',top=' + topPos + ',left=' + leftPos);
	
}

function ponSelectorGestor(cbd1,cbd2,strNombre, strValor1, strCodigo, strValor2)
	{
		if (strValor1==''){
			var valor1=leeElementoPagina(strNombre+"_1");
			strValor1=valor1.value;
		}
		if (strValor2==''){
			var valor2=leeElementoPagina(strCodigo+"_1");
			strValor2=valor2.value;
		}
		
		window.close()
		
		var obj;
		obj=leeElementoPagina(cbd1, window.opener)
		if (obj!=null)
		{
			obj.value=strValor1
			//if (obj.onchange!=null) alert(obj.onchange())
		}
	    
	    obj=leeElementoPagina(cbd2, window.opener)
	
		if (obj!=null)
		{
			obj.value=strValor2;
		//	if (obj.onchange!=null) obj.onchange()
		}
	
	}
function ponSelectorGestorImagen(cbd1,cbd2,strNombre, strValor1, strCodigo, strValor2)
	{
		if (strValor1==''){
			var valor1=leeElementoPagina(strNombre+"_1");
			strValor1=valor1.value;
		}
		var valor2=leeElementoPagina(strCodigo+"_1");
		strValor2=valor2.value;
		
		window.close()
		
		var obj;
		obj=leeElementoPagina("txtUrl", window.opener)
		if (obj!=null)
		{
			obj.value=strValor1
			//if (obj.onchange!=null) alert(obj.onchange())
		}
	    
	    obj=leeElementoPagina("txtAlt", window.opener)
	
		if (obj!=null)
		{
			obj.value=strValor2;
		//	if (obj.onchange!=null) obj.onchange()
		}
		
		obj=leeElementoPagina("txtHSpace", window.opener)
	
		if (obj!=null)
		{
			obj.value="10";
		//	if (obj.onchange!=null) obj.onchange()
		}
		
		obj=leeElementoPagina("txtVSpace", window.opener)
	
		if (obj!=null)
		{
			obj.value="8";
		//	if (obj.onchange!=null) obj.onchange()
		}
	
	
	}
function ponSelectorGestorArchivo(cbd1,cbd2,strNombre, strValor1, strCodigo, strValor2)
	{
		if (strValor1==''){
			var valor1=leeElementoPagina(strNombre+"_1");
			strValor1=valor1.value;
		}
		if (strValor2==''){
			var valor2=leeElementoPagina(strCodigo+"_1");
			strValor2=valor2.value;
		}
		
		window.close()
		
		var obj;
		obj=leeElementoPagina("txtUrl", window.opener)
		if (obj!=null)
		{
			obj.value=strValor1
			//if (obj.onchange!=null) alert(obj.onchange())
		}
	    
	    obj=leeElementoPagina(cbd2, window.opener)
	
		if (obj!=null)
		{
			obj.value=strValor2;
		//	if (obj.onchange!=null) obj.onchange()
		}
	
	}
function elimina(codigo)
{
    
    if (confirm('¿Estas seguro que desea eliminar el registro?')){ 		
	    if (codigo!=""){
		    window.open('editor.aspx?modo=3&cod=' + codigo,'_top');
	    }else {
		    alert("ERROR. NO se puede eliminar.")
	    }
    }
}

function eliminaAdjunto(codigo)
{
    
    if (confirm('¿Estas seguro que desea eliminar el registro?')){ 		
	    if (codigo!=""){
		    window.open('adjuntos_editor.aspx?modo=3&cod=' + codigo,'_top');
	    }else {
		    alert("ERROR. NO se puede eliminar.")
	    }
    }
}

function eliminaVideo(codigo)
{
    
    if (confirm('¿Estas seguro que desea eliminar el registro?')){ 		
	    if (codigo!=""){
		    window.open('videos_editor.aspx?modo=3&cod=' + codigo,'_top');
	    }else {
		    alert("ERROR. NO se puede eliminar.")
	    }
    }
}

var novdetid="";

function despliega(id)
{
    //alert(id);
    var obj;
    var novdet;
    novdetid=id;
    novdet="novdet"+id;
    obj=leeElementoPagina(novdet);
    obj.style.display="";
    
    obj=leeElementoPagina("novdetaci"+id);
    obj.style.display="none";
    
    obj=leeElementoPagina("novdetpli"+id);
    obj.style.display="";
    
}

function pliega(id)
{
    //alert(id);
    var obj;
    var novdet;
    novdetid=id;
    novdet="novdet"+id;
    obj=leeElementoPagina(novdet);
    obj.style.display="none";
    
    obj=leeElementoPagina("novdetaci"+id);
    obj.style.display="";
    
    obj=leeElementoPagina("novdetpli"+id);
    obj.style.display="none";
    
}

function noVoto(){
    alert("No se puede votar dos veces.");
}


/********************************* CAPA NOTICIAS Y EVENTOS ***********************/
var activa,nombre,pagina;
pagina = 0;
activa = 0;
nombre = "noticiaContenido";

function tabPortada(sw) {     
    if (activa==sw){
        return false;
    }
    $("#"+nombre+activa).fadeOut("slow");            
    $("#"+nombre+sw).fadeIn("slow");
    $("#"+nombre+activa).hide();
    
    bgActiva = $("#n"+activa).css("background-color");
    bgSw= $("#n"+sw).css("background-color");
    colorActiva = $("#a"+activa).css("color");
    colorSw= $("#a"+sw).css("color");
    
    $("#n"+activa).css("background",bgSw);  
    $("#n"+sw).css("background",bgActiva);
    $("#a"+activa).css("color",colorSw);  
    $("#a"+sw).css("color",colorActiva);
    
    activa=sw;
            
} 

function tabProductos(capaProducto, sw) {     
    if (activoProducto==sw){
        return false;
    }
    $("#"+capaProducto+activoProducto).fadeOut("slow");    
    
    $("#"+capaProducto+sw).fadeIn("slow");          
    
    $("#"+capaProducto+activoProducto).hide();
                    
    activoProducto=sw;
}  

function setfirst(){
    setTimeout(t, 500);
}

function gup( name ){
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp ( regexS );
	var tmpURL = window.location.href;
	var results = regex.exec( tmpURL );
	if( results == null )
		return"";
	else
		return results[1];
}


function abreUrlDescarga()
{
      var param = gup( 'codPro' );
      parent.location='aplicaciones_topografia.aspx?cd=1&cod=150&codPro=' + param; 
}

function abreUrlProducto()
{
      var param = gup( 'codPro' );
      parent.location='aplicaciones_topografia.aspx?cod=150&codPro=' + param; 
}


function abreUrlFormacion()
{
      var param = gup( 'codPro' );
      parent.location='formacion.aspx?cod=176'; 
}

function abreUrlComprar()
{
      var cod = gup( 'cod' );
      var codProducto = gup( 'codPro' );
      parent.location='tpv_confirmar.aspx?pPro=S&cod=' + cod + '&codPro=' + codProducto + '&paginaRet=1';
}


function t(){
    var rndTab;
    rndTab=(Math.floor(Math.random()*totalProductos))+1;
    tabProductos('productoHome_',rndTab);
    setTimeout(t, 1000*8);
}



