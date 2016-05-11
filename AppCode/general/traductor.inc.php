<?php

// ##############################################################################
// # ARCHIVO:		traductor.inc - Versi�n 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCifrado
// *****************************************************************************

// P�blico
	
class phpTraductor{
    
    //Propiedades p�blicas  
    public $Error;        // si ha habido un error en la carga, lo pone a true, EOC false
    public $Iniciado;
    public $EstiloFuente;

    //Propiedades Privadas
    private $xmlObjeto;
    private $nodoActual;
    private $_Idioma;
    
    private $_Parametros;
    private $_Cookie;
    private $_UrlAmigable;

    // *****************************************************************************
    // * Creaci�n y eliminaci�n
    // *****************************************************************************
    Public function __construct(){				
		
	    //Crea objetos		
        $this->xmlObjeto = new DOMDocument();
        $this->_Parametros = new phpParametros();
        $this->_Cookie = new phpCookie();
        $this->_UrlAmigable = new phpUrlAmigable();

	    // Inicia propiedades        
		
	    $this->ReiniciaObjetos();
        //if ($this->_UrlAmigable->Activa)
        //{
            //$_Idioma = HttpContext.Current.Request.RequestContext.RouteData.Values["lang"].ToString();
        //}
        //else        
        //{
            if (isset($_GET['lang']))
            {
                $this->setIdioma($_GET['lang']);    
            }
            else
            {
                $this->setIdioma("");    
            }        
        //}
    } 	
    
    function __destruct() {
		
	   //Hay que destruir los objetos		        
	   unset($this->xmlObjeto);
       unset($this->_Parametros);
       unset($this->_Cookie);
       unset($this->_UrlAmigable);
    }

    public function ReiniciaObjetos()
    {
        $this->Iniciado = false;
        $this->EstiloFuente = 0;
        $this->_Cookie->Nombre = vbCookieLanguage;        
    }


    // *****************************************************************************
    // * Propiedades
    // *****************************************************************************  
    
    Public function getIdioma(){
        return $this->_Idioma;
    }    
    
    Public function setIdioma($value){
        if (($value == vbEtiquetaBdEsp) || ($value == vbEtiquetaBdIng))
        {
            $this->_Idioma = $value;
            $this->_Cookie->Valor = $this->_Idioma;
            if ($this->_Cookie->Existe()) $this->_Cookie->Elimina();
            $this->_Cookie->Agrega();
        }
        else
        {
            if ($this->_Cookie->Existe())
            {
                $this->_Idioma = $this->_Cookie->Lee();
            }
            else
            {
                //Idioma por defecto cuando no existe cookie, ni parametro                        
                switch ($this->ObtenerCultura()){ 
                    case "en": 
                        $this->_Idioma = vbEtiquetaBdIng;
                        break; 
                    default: 
                        $this->_Idioma = vbEtiquetaBdEsp; 
                }                                                             
            }
        }
    }

    // *****************************************************************************
    // * M�todos P�blicos
    // *****************************************************************************
    public function Traducir($strEtiqueta)
    {
        $strTraduccion = "";

        if (!$this->Iniciado) $this->Inicia();

        $this->Error = 0;

        try
        {

            $xpath = new DOMXpath($this->xmlObjeto);
            $this->nodoActual = $xpath->query("//termino[etiqueta='" . $strEtiqueta . "']");
            
            switch ($this->EstiloFuente)
            {

                case 0: 
                    $strTraduccion = $this->nodoActual->item(0)->childNodes->item(3)->nodeValue; //Normal
                    break;

                case 1: $strTraduccion = strtoupper($this->nodoActual->item(0)->childNodes->item(3)->nodeValue); //En May�sculas
                    break;

                case 2: $strTraduccion = strtolower($this->nodoActual->item(0)->childNodes->item(3)->nodeValue); //En Min�sculas
                    break;

                case 3: $strTraduccion = ucfirst($this->nodoActual->item(0)->childNodes->item(3)->nodeValue); //En Capital
                    break;
            }

        }
        catch(Exception $e)
        {
            $strTraduccion = "<b>Etiqueta Err�nea:</b>" . $strEtiqueta . "<br />";
            $this->Error = 1;
        }

        return $strTraduccion;
    }
    
    // *****************************************************************************
    // * M�todos Privados
    // *****************************************************************************
    private function Inicia(){
        
        $strArchivoXML = $this->_Parametros->Directorio . "/idiomas/diccionario_" . $this->_Idioma . ".xml";
        try
        {
            $this->xmlObjeto->load($strArchivoXML);
            $this->Iniciado = true;
        }
        catch(Exception $e)
        {
            $this->Error = 1;
            $this->Iniciado = false;
        }
    }

    public function ObtenerCultura()
    {
        return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); 
    }
}

?>