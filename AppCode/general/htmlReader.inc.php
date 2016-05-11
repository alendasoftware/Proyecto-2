<?php

// ##############################################################################
// # ARCHIVO:		htmlReader.inc - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpHtmlReader
// *****************************************************************************

// Público
	
class phpHtmlReader{
    
    //Propiedades públicas  
    Public $Texto;	
	public $page;
    public $ruta;

    private $_codeHtml;
    private $_urHtml;

    private $_Servidor;
    private $_Parametros;

    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){				
		
	    //Crea objetos		
        $this->_Servidor = new phpServidor();
        $this->_Parametros = new phpParametros();

	    // Inicia propiedades        
		
	    $this->Inicia();
    } 	
    
    function __destruct() {
		
	    //Hay que destruir los objetos		        
	    unset($this->_Servidor);
        unset($this->_Parametros);
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->page = null;
        $this->ruta = $this->_Parametros->DirectorioRaiz . "/page/";

        $this->_urHtml = "http://";
        $this->_urHtml .= $this->_Servidor->ServidorActual;
        if ($this->_Servidor->Entorno() == vbServidorEntornoDesarrollo) $this->_urHtml .= ":" . $_SERVER['SERVER_PORT'];      
		
    }	

    // *****************************************************************************
    // * Propiedades
    // *****************************************************************************  
    

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    public function Html()
    {
        if (($this->page != null) && ($this->page != ""))
        {
            try
            {
                $doc = $this->get_data($this->_urHtml . $this->ruta . $this->page); 
                $this->_codeHtml = $doc;                
            }
            catch (Exception $e){ 
                $this->_codeHtml = ""; 
            }
        }
        else
        {
            $this->_codeHtml = "";
        }
        return $this->_codeHtml;        
    }
    
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function get_data($url)
    {
        $data = "";
        if ($this->curl_exists($url))
        {
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
            $data = curl_exec($ch);
            curl_close($ch);
        }
        return $data;
    }

    private function curl_exists($url)
    {  
      $file_headers = @get_headers($url);
      return ($file_headers[0] != 'HTTP/1.1 404 Not Found');
    }
}

?>