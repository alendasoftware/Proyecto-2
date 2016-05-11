<?php

// ##############################################################################
// # ARCHIVO:		cookie.inc - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCookie
// *****************************************************************************

// Público
	
class phpCookie{
    
    //Propiedades públicas  
    Public $Nombre;	
    Public $Valor;	
    Public $Cifrar;
    Public $Dias;
    Public $Path;
    Public $Session;

    //Propiedades privadas
    Private $_Servidor;
    Private $_Parametros;
    Private $_Cifrado;	

    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){				
		
		//Crea objetos		
    	$this->_Servidor = new phpServidor();
    	$this->_Parametros = new phpParametros();
    	$this->_Cifrado = null;

		// Inicia propiedades
        $this->Cifrar = false;
       
		$this->Inicia();

    } 	    
    
    function __destruct() {
		
		//Hay que destruir los objetos	
        unset($this->_Servidor);
        unset($this->_Parametros);
        if (is_object($this->_Cifrado)) unset($this->_Cifrado);

    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
		$this->Nombre = null;
        $this->Valor = null;
		$this->Dias = 365; 
        $this->Path = null;
		$this->Session = false;
    }	

    // *****************************************************************************
    // * Propiedades
    // *****************************************************************************  
    Public function Cifrado(){
    	
		if (is_null($this->_Cifrado)){
			$this->_Cifrado = new phpCifrado();	
		}
    	
    	return $this->_Cifrado;
    }

    Public function ProyectoConNombre(){
		
		$strValor = "";
		$strValor .= ($this->_Parametros->Proyecto) . "_" . $this->Nombre;

		return $strValor;
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
		$strValor = "";
			
		$strValor .= "Nombre:" . $this->Nombre . ";";
		$strValor .= "ProyectoConNombre:" . $this->ProyectoConNombre() . ";";
		$strValor .= "Valor:" . $this->Valor . ";";
		$strValor .= "Dias:" . $this->Dias . ";";
		$strValor .= "Path:" . $this->Path . ";";

		return $strValor;

    } 
	
    Public function Agrega(){
		
		$this->_Servidor->Error = "";

		if (($this->Nombre==null) || $this->Nombre=="") $this->_Servidor->Error = "No existe el nombre de la cookie";
			
		if ($this->_Servidor->Error == "") {
				
            if (!($this->Valor==null) && ($this->Valor!="") && $this->Cifrar) {
                $this->Cifrado()->Texto = $this->Valor;
                $this->Valor = $this->Cifrado()->Md5();
            }
					
		    $this->Almacena();
				
		}

    } 

    Public function Lee(){
		
		$strValor = "";

		if (($this->Nombre==null) || $this->Nombre=="") $this->_Servidor->Error = "No existe el nombre de la cookie";
			
		if (($this->_Servidor->Error == "") && $this->Existe()) {
            if (!$this->Session){     
                $strValor = $_COOKIE[$this->ProyectoConNombre()];			
		    }else{
                $strValor = $_SESSION[$this->ProyectoConNombre()];   
            }
        }	
		return $strValor;
		
    } 

    Public function Elimina(){
		
		$this->_Servidor->Error = "";

		if (($this->Nombre==null) || $this->Nombre=="") $this->_Servidor->Error = "No existe el nombre de la cookie";
			
		if ($this->_Servidor->Error == "") {
            if (!$this->Session){
                //setCookie($this->ProyectoConNombre(), null, time()-1000,$this->Path);
                setCookie($this->ProyectoConNombre(), null, time()-1000);
            }else{
                unset($_SESSION[$this->ProyectoConNombre()]);
            }    
		}

    }

    Public function Existe(){
		
		$blnExiste = false;
		
        if (($this->Nombre==null) || $this->Nombre=="") $this->_Servidor->Error = "No existe el nombre de la cookie";
		
		if ($this->_Servidor->Error == "") {
            if (!$this->Session){
                $blnExiste = isset($_COOKIE[$this->ProyectoConNombre()]);
            }else{
                $blnExiste = isset($_SESSION[$this->ProyectoConNombre()]);
            }	    	
		}
		return $blnExiste;
    }

    public function DibujaAviso($objTraductor)
    {
        $strHtml = "";
        $strHtml .= "<div class=\"container\">";
        $strHtml .= "<div class=\"row\">";
        $strHtml .= "<div class=\"col-sm-12\">";
        $strHtml .= "<div class=\"alert alert-warning\" role=\"alert\">";
        $strHtml .= "<strong>" . $objTraductor->Traducir("UsoCookies") . ": </strong>";
        $strHtml .= $objTraductor->Traducir("UsoCookiesDescription");
        $strHtml .= "</div>";
        $strHtml .= "</div>";
        $strHtml .= "</div>";
        $strHtml .= "</div>";
        return $strHtml;
    }
    
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    Private function Almacena(){
	
		if (!$this->Session){
            setCookie($this->ProyectoConNombre(), $this->Valor, time() + (60*60*24*$this->Dias));
        }else{
            $_SESSION[$this->ProyectoConNombre()] = $this->Valor;
        }
        
    }

}

?>
