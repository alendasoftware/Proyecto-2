<?php

// ##############################################################################
// # ARCHIVO:		faq.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCifrado
// *****************************************************************************

// Público
	
class phpFaq{
    
    //Propiedades públicas  
    public $Nombre; 
    public $Descripcion;
   
    //Propiedades privadas  
    private $_Codigo;
    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_objBasedato;
    private $_objParametros;
    private $_objUrlAmigable;
  
    public $Datos;
    
    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){				
		
	   //Crea objetos		
       $this->_objBasedato = new phpBasedato();
       $this->_objBasedato->Conexion();   
       $this->_objParametros = new phpParametros();           
       $this->_objUrlAmigable = new phpUrlAmigable();   
       $this->Datos = new phpDatos(); 
     
       // Inicia propiedades        
		
	   $this->Inicia();
    } 	
    
    function __destruct() {
		
	   //Hay que destruir los objetos		        
	   unset($this->_objBasedato);
       unset($this->_objParametros);
       unset($this->_objUrlAmigable);
       unset($this->Datos);
       
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->Nombre = null;
        $this->Descripcion = null;
       
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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM faqs WHERE faq_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerFaq();
        }
        else
        {
            $this->ObtenerFaq();
        }
    }

    public function UrlAmigable()
    {
        return $this->_objUrlAmigable->Amigable("buque.php?id=" . $this->getCodigo() . "&cod=" . vbPaginaCruceros . "&nom=" . $this->Nombre);
    }

    public function UrlAmigableListado($intEmpresa,$objTraductor)
    {
        return $this->_objUrlAmigable->Amigable("crucero.php?id=" . $intEmpresa . "&cod=" . vbPaginaCruceros . "&nom=" . $objTraductor->Traducir("Listado") . " " . $objTraductor->Traducir("Productos"));
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		$strValor .= "Codigo:" . $this->_Codigo . ";";
        $strValor .= "Nombre:" . $this->Nombre . ";";
        $strValor .= "Descripcion:" . $this->Descripcion . ";";
      
    	return $strValor;

    } 
	
    public function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public function Consulta()
    {
        $cadenaConsulta = "Select * FROM faqs WHERE 1=1";
        
        $cadenaConsulta .= " ORDER BY faq_orden";

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }


    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function ObtenerFaq()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("faq_codigo"));    
            $this->Nombre = $this->Datos->Valor("faq_nombre");
            $this->Descripcion = $this->Datos->Valor("faq_descripcion");  
            if ((is_null($this->Descripcion))||($this->Descripcion=="")) $this->Descripcion = "Lorem ipsum dolor sit ame consectetur adipisicing elit"; 
            
        }
    }

}

?>