<?php

// ##############################################################################
// # ARCHIVO:		comunicacion.inc.php - Versión 1.1
// # DESCRIPCION:	Librería de gestión de comunicación
// ##############################################################################

// *****************************************************************************
// * Clase phpComunicacion
// *****************************************************************************

// Público

class phpComunicacion{
    
	 //Propiedades Públicas  
    public $Proyecto;
    public $UrlProyecto;
    public $CorreoAdmin;
    public $RutaLogo;
    public $Saludo;
    public $Despedida;
    public $ProteccionDatos;
    public $ProteccionDatosEn;
    public $Importante;
    public $Debug;
    public $Html;
    public $Idioma;
    public $Error;	
    public $De;			 
	public $Para;		 
	public $ParaNombre;	 
	public $Asunto;		 
	public $Cc;			 
	public $Cco;
    public $Cuerpo;

    //Propiedades Privadas 
    private $_Parametros;

	// *****************************************************************************
	// * Creación y eliminación
	// *****************************************************************************
	Public function __construct(){			
		
	    // Crea objetos
		$this->_Parametros = new phpParametros();

	    // Inicia propiedades
        $this->Inicia();

	}
    
        
    function __destruct() {
		
	    //Hay que destruir los objetos
		unset($this->_Parametros);
	}

	// *****************************************************************************
	// * Inicio
	// *****************************************************************************
	Public function Inicia(){

		$this->Proyecto = $this->_Parametros->ProyectoPara;
        $this->UrlProyecto = $this->_Parametros->Url;
        $this->CorreoAdmin = $this->_Parametros->CorreoAdmin;
        $this->RutaLogo = $this->_Parametros->Directorio . "/images/logoCorreo.png";
        $this->Saludo = null;
        $this->Despedida = $this->_Parametros->Despedida;
        $this->ProteccionDatos = $this->_Parametros->ProteccionDatos;
        $this->ProteccionDatosEn = $this->_Parametros->ProteccionDatosEn;
        $this->Importante = false;
        $this->Idioma = "es";
        $this->Error = "";
        $this->De = null;
        $this->Para = null;
        $this->ParaNombre = null;
        $this->Asunto = null;
        $this->Cc = null;
        $this->Cco = null;
        $this->Cuerpo = null;
        $this->Debug = false;
        $this->Html = "";
    }

	// *****************************************************************************
	// * Propiedades
	// ***************************************************************************** 
    

	// *****************************************************************************
	// * Métodos Públicos
	// *****************************************************************************
	Public Function DevuelveCadena(){
  	
        $strValor = "";
		
		$strValor .= "Proyecto:" . $this->Proyecto . ";";
	    $strValor .= "UrlProyecto:" . $this->UrlProyecto . ";";
	    $strValor .= "CorreoAdmin:" . $this->CorreoAdmin . ";";
	    $strValor .= "RutaLogoCorreo:" . $this->RutaLogoCorreo . ";";
	    $strValor .= "TitularidadAvisoCorreo:" . $this->TitularidadAvisoCorreo . ";";
	    $strValor .= "TitularidadDireccionAvisoCorreo:" . $this->TitularidadDireccionAvisoCorreo . ";";
	    $strValor .= "Saludo:" . $this->Saludo . ";";
	    $strValor .= "Despedida:" . $this->Despedida . ";";
	    $strValor .= "De:" . $this->De . ";";
	    $strValor .= "Para:" . $this->Para . ";";
	    $strValor .= "ParaNombre:" . $this->ParaNombre . ";";
	    $strValor .= "Asunto:" . $this->Asunto . ";";
	    $strValor .= "Cc:" . $this->Cc . ";";
	    $strValor .= "Cco:" . $this->Cco . ";";
	    $strValor .= "Cuerpo:" . $this->Cuerpo . ";";

        return $strValor;

     }			
  	
     Public Function EnviaEmail(){
		
	    $strCuerpo = "";
        $anchoEmail = "600";
         
        if (($this->Para==null) || ($this->Para=="")) $this->Error = "No ha introducido el para";
	    if (($this->Error == "") && (($this->CorreoAdmin==null) || ($this->CorreoAdmin==""))) $this->Error = "No se encuentra el correo de administracción";

		if ($this->Error == "")
		{	
			//FROM
			if (($this->De != null) && ($this->De != "")) 
            {
				if (($this->Proyecto != null) && ($this->Proyecto != ""))  {
                    $this->De = $this->Proyecto . " <" . $this->De . ">";
				}
            }else{
				if (($this->Proyecto != null) && ($this->Proyecto != ""))  {
					$this->De = $this->Proyecto . " <" . $this->CorreoAdmin . ">";
				}else{
					$this->De = $this->CorreoAdmin;
				}
            }
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            // Additional headers
            $headers .= 'To: ' . $this->Para . "\r\n";
            $headers .= 'From: ' . $this->De . "\r\n";
             	
			//CC
            if (($this->Cc != null) && ($this->Cc != "")) $headers .= 'Cc: ' . $this->Cc . "\r\n";
            
            //CCO
            if (!($this->Cco==null) && ($this->Cco!="")) $headers .= 'Bcc: ' . $this->Cco . "\r\n";
            
            //RutaLogoCorreo -> src completo
			$strCuerpo = "<!DOCTYPE html>";
            $strCuerpo .= "<head><title>Aplitop:" . $this->Proyecto . "</title>";
            $strCuerpo .= "<meta charset=\"utf-8\">";
            $strCuerpo .= "</head>";
            $strCuerpo .= "<html lang=\"es\">";
            $strCuerpo .= "<body style=\"font-family:Arial, Sans serif;font-size:12px;background-color:#e4e4e4;color:#444;\"><table width=\"" . $anchoEmail . "px\" border=\"0\" align=\"center\"><tr><td style=\"text-align:justify;background-color:#fff;border-top:solid 3px #e0e0e0;padding:10px;\">";
			
            //''''''''''''''''''''
			// Cabecera
			if (($this->RutaLogo != null) && ($this->RutaLogo != "")) $strCuerpo .= "<img src='" . $this->RutaLogo . "' alt='" . $this->Proyecto . "' /><br/><br/>";
			
    		// Saludo	
		    if (($this->Saludo != null) && ($this->Saludo != "")) {
                $strCuerpo .= $this->Saludo;
            }else{
                if (($this->ParaNombre != null) && ($this->ParaNombre != "")) $strCuerpo .= "Hola, " . $this->ParaNombre . "<br/>";
            }
            
            // Cuerpo
			$strCuerpo .= $this->Cuerpo . "<br/>";
						
			// Pie
            if (($this->Despedida != null) && ($this->Despedida != "")) {
                $strCuerpo .= $this->Despedida . "<br/>";
            }else{
			    $strCuerpo .= "Un saludo<br/>";
			    if (($this->Proyecto != null) && ($this->Proyecto != "")) $strCuerpo .= "Fdo.: " . $this->Proyecto . "<br/>";
			    if (($this->UrlProyecto != null) && ($this->UrlProyecto != "")) $strCuerpo .= $this->UrlProyecto;            
			}
            
			//Protección Datos 
            if ($this->Idioma == vbEtiquetaBdEsp) if (($this->ProteccionDatos != null) && ($this->ProteccionDatos != "")) $strCuerpo .= "<p style=\"text-align:justify;font-size:10px;color:#333333;\">" . $this->ProteccionDatos . "</p>";
            if ($this->Idioma == vbEtiquetaBdIng) if (($this->ProteccionDatosEn != null) && ($this->ProteccionDatosEn != "")) $strCuerpo .= "<p style=\"text-align:justify;font-size:10px;color:#333333;\">" . $this->ProteccionDatosEn . "</p>";

			$strCuerpo .= "</td></tr></table></body>";
            $strCuerpo .= "</html>";

            $this->Html = $strCuerpo;

            if (!$this->Debug)
            {
                // Mail it
            	mail($this->Para, $this->Asunto, $strCuerpo, $headers);
            }                            
			
		}

	}
		
}

?>