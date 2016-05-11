<?php

// ##############################################################################
// # ARCHIVO:		urlAmigable.inc - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCifrado
// *****************************************************************************

// Público
	
class phpUrlAmigable{
    
    //Propiedades públicas  
    public $Activa;
    public $CodigoPagina;	
	
    private $_Parametros;
    
    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){				
		
    	//Crea objetos		
        $this->_Parametros = new phpParametros();

    	// Inicia propiedades        
    	$this->Inicia();
    } 	
    
    function __destruct() {
		
	   //Hay que destruir los objetos		        
	   unset($this->_Parametros);
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
        $this->Activa = true;
        $this->CodigoPagina = 0;    
		
    }	

    // *****************************************************************************
    // * Propiedades
    // *****************************************************************************  
    

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		
	    $strValor .= "Activa:" . $this->Activa . ";";
    	$strValor .= "CodigoPagina:" . $this->CodigoPagina . ";";
    	
    	return $strValor;
    } 
	    
    public function Amigable($Url)
    {
        $urlAmigable = "";
        
        
        
        if ($this->Activa){
            if (($Url == null) || ($Url == "")) $Url = vbPaginaInicio;
            
            if (strpos($Url,".php") > 0) $urlAmigable = strtoupper(substr($Url, 0, 1)) . substr($Url, 1, strpos($Url,".php")-1);
            
            if (strpos($Url,".html") > 0) $urlAmigable = "Pagina";

            if (strpos($Url,"lang=") > 0)
            {
                $urlAmigable .= $this->ParametroAmigable($Url, "lang=");
            }
            else 
            {                    
                $urlAmigable .= "/es";
            }
            
            if (strpos($Url,"?") > 0)
            {
                //cod
                if (strpos($Url,"cod=") > 0) $urlAmigable .= $this->ParametroAmigable($Url, "cod=");

                //id
                if (strpos($Url,"id=") > 0) $urlAmigable .= $this->ParametroAmigable($Url, "id=");

                //pag
                if (strpos($Url,"pag=") > 0) $urlAmigable .= $this->ParametroAmigable($Url, "pag=");

                //tag
                if (strpos($Url,"tag=") > 0) $urlAmigable .= $this->ParametroAmigable($Url, "tag=");

                //nav
                if (strpos($Url,"nav=") > 0) $urlAmigable .= $this->ParametroAmigable($Url, "nav=");

                //nom
                if (strpos($Url,"nom=") > 0) $urlAmigable .= $this->ParametroAmigable($Url, "nom=");  
            }
                       
	    }else{
            $urlAmigable = $Url;
        }
        $urlAmigable = $this->_Parametros->Directorio . "/" . $urlAmigable;
        
        return $urlAmigable;
    }	
    
    public function Cod()
    {
        $Valor = 0;

        if (isset($_GET['cod'])) $Valor = intval($_GET['cod']);         
        
        return $Valor;
    }

    public function Id()
    {
        $Valor = 0;

        if (isset($_GET['id'])) $Valor = intval($_GET['id']);         
        
        return $Valor;
    }

    public function Tag()
    {
        $Valor = "";

        if (isset($_GET['tag'])) $Valor = $_GET['tag'];         
        
        return $Valor;
    }

    public function Nav()
    {
        $Valor = "";

        if (isset($_GET['nav'])) $Valor = intval($_GET['nav']);            
        
        return $Valor;
    }
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function ParametroAmigable($url, $parametro)
    {
        $Valor = "";

        $posInicio = strpos($url, $parametro) + strlen($parametro); //para saltar el igual
        
        
        $urlResto = substr($url, $posInicio, strlen($url));

        if (strpos($urlResto,"&") > 0) //hay más parámetros
        {
            $Valor .= substr($urlResto,0,strpos($urlResto,"&"));
        }
        else //no hay más parámetros
        {
            $Valor .= $urlResto;
        }

        if ($parametro == "nom=") $Valor = $this->titleToSeoURL($Valor);

        $Valor = "/" . $Valor;
 
        return $Valor;
    }
    
    public function titleToSeoURL($string)
    {
        //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
        $string = strtolower($string);
        //Strip any unwanted characters
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "_", $string);
        return $string;

    }  
    public function traza($texto)
    {
        echo $texto;
        exit();
    }
}

?>