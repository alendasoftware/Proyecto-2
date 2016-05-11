<?php

// ##############################################################################
// # ARCHIVO:		banner.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCifrado
// *****************************************************************************

// Público
	
class phpBanner{
    
    //Propiedades públicas  
    public $Nombre; 
    public $Descripcion;
    public $Fondo;
    public $Recorte;
    public $Enlace;
	public $Buque;
    public $EnlaceLogo;
    
    //Propiedades privadas  
    private $_Codigo;
    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_objBasedato;
    private $_objParametros;

    public $Datos;

    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){				
		
	   //Crea objetos		
       $this->_objBasedato = new phpBasedato();
       $this->_objBasedato->Conexion();       
       $this->_objParametros = new phpParametros();
       $this->Datos = new phpDatos(); 
	   // Inicia propiedades        
		
	   $this->Inicia();
    } 	
    
    function __destruct() {
		
	   //Hay que destruir los objetos		        
	   unset($this->_objBasedato);
       unset($this->_objParametros);
       unset($this->Datos);
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->Nombre = null;
        $this->Descripcion = null;
        $this->Fondo = null;
        $this->Recorte = null;
        $this->Enlace = null;
        $this->EnlaceLogo = null;
        $this->Buque = 0;

        $this->_Codigo = 0;
        
        $this->_Completo = false;
        $this->_CadenaConsulta = null;
    }	

    public function ReiniciaObjetos()
    {
        //Destruir Objetos        
    }

    // *****************************************************************************
    // * Propiedades
    // *****************************************************************************  
    public function CadenaConsulta()
    {
        return $this->_CadenaConsulta;
    }

    public function getCodigo()
    {
        return $this->_Codigo;
    }

    public function setCodigo($value)
    {

        if ((!$this->_Completo) && ($value > 0))
        {
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM archivos inner join buques_archivos on buques_archivos.bua_archivo = archivos.arc_codigo inner join buques on buques.buq_codigo = buques_archivos.bua_buque WHERE arc_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerBanner();
        }
        else
        {
            $this->ObtenerBanner();
        }
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		
    	$strValor .= "Nombre:" . $this->Nombre . ";";
        $strValor .= "Descripcion:" . $this->Descripcion . ";";
        $strValor .= "Fondo:" . $this->Fondo . ";";
        $strValor .= "Recorte:" . $this->Recorte . ";";
        $strValor .= "Enlace:" . $this->Enlace . ";";
    	
    	return $strValor;

    } 
	
    public function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public function Consulta_Deprecated()
    {
        $cadenaConsulta = "Select * FROM banners WHERE 1=1";
        
        $this->_CadenaConsulta = $cadenaConsulta;
       
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function Consulta()
    {
        $cadenaConsulta = "Select * FROM archivos inner join buques_archivos on buques_archivos.bua_archivo = archivos.arc_codigo inner join buques on buques.buq_codigo = buques_archivos.bua_buque WHERE 1=1 AND arc_grupo='". vbGrupoImagenSlider ."' ORDER BY RAND() LIMIT 5";
        
        $this->_CadenaConsulta = $cadenaConsulta;
       
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }
    

    public function DibujaSlider($strEtiqueta)
    {
        $html = "";

        $html .= "<div class=\"item";
        if ($this->Datos->index == 0) $html .= " active";
        $html .= "\" style=\"background-image: url(" . $this->_objParametros->Directorio . "/subidas/buques/" . $this->Buque ."/slider/" . $this->Fondo .")\">";
        $html .= "<div class=\"container\">";
        $html .= "<div class=\"row slide-margin\">";
        $html .= "<div class=\"col-sm-6\">";
        $html .= "<div class=\"carousel-content\">";
        //$html .= "<h1 class=\"animation animated-item-1\">" . $this->Nombre . "</h1>";
        //$html .= "<h2 class=\"animation animated-item-2\">" . $this->Descripcion . "</h2>";
        //$html .= "<a class=\"btn-slide animation animated-item-3\" href=\"" . $this->Enlace . "\">" . $strEtiqueta . "</a>";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "<div class=\"col-sm-6 hidden-xs animation animated-item-4\">";
        $html .= "<div class=\"slider-img\">";
        $html .= "<a href=\"" . $this->EnlaceLogo . "\">";
        $html .= "<img src=\"" . $this->_objParametros->Directorio . "/subidas/empresas/" . $this->Recorte . "\" class=\"img-responsive\">";
        $html .= "</a>";
        $html .= "<h1 class=\"animation animated-item-1\">" . $this->Nombre . "</h1>";
        $html .= "<h2 class=\"animation animated-item-2\">" . $this->Descripcion . "</h2>";
        $html .= "<a class=\"btn-slide animation animated-item-3\" href=\"" . $this->Enlace . "\">" . $strEtiqueta . "</a>";
        
        $html .= "</div>";
        $html .= "</div>";

        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div><!--/.item-->";

        return $html;
    }
    
    public function DibujaSelectorSlider()
    {
        $html = "";

        $html .= "<li data-target=\"#main-slider\" data-slide-to=\"" . $this->Datos->index . "\"";
        if ($this->Datos->index == 0) $html .= "class=\"active\"";
        $html .= "></li>";

        return $html;
    }

    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function ObtenerBanner()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            //$this->_Codigo = intval($this->Datos->Valor("ban_codigo"));    
            //$this->Nombre = $this->Datos->Valor("ban_nombre");
            //$this->Descripcion = $this->Datos->Valor("ban_descripcion");
            //$this->Fondo = $this->Datos->Valor("ban_archivo");
            //$this->Recorte = $this->Datos->Valor("ban_archivo_recorte");            
            //$this->Enlace = $this->Datos->Valor("ban_enlace");        
            
            $objBuque = new phpBuque();
            $objBuque->setCodigo($this->Datos->Valor("buq_codigo"));

            $this->_Codigo = intval($this->Datos->Valor("arc_codigo"));    
            $this->Nombre = $this->Datos->Valor("buq_nombre");
            $this->Descripcion = $objBuque->DescripcionCorta;
            $this->Fondo = $this->Datos->Valor("arc_nombre");
            $this->Recorte = $objBuque->Empresa()->Logo;
            $this->Buque = $objBuque->getCodigo();

            $this->Enlace = $objBuque->UrlAmigable();
            $this->EnlaceLogo = $objBuque->Empresa()->UrlAmigable();
            
            unset($objBuque);
        }
    }

}

?>