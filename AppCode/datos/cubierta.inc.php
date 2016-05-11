<?php

// ##############################################################################
// # ARCHIVO:		cubierta.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCubierta
// *****************************************************************************

// Público
class phpCubierta{
    
    //Propiedades públicas  
    public $Nombre; 
    public $Descripcion;
    public $Planta;
    
    //Propiedades privadas  
    private $_Codigo;
    private $_Buque;
    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_objBasedato;
    private $_objParametros;
    private $_objUrlAmigable;
    private $_objBuque;
    
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
       $this->_objBuque = null;
     
	   // Inicia propiedades        
		
	   $this->Inicia();
    } 	
    
    function __destruct() {
		
	   //Hay que destruir los objetos		        
	   unset($this->_objBasedato);
       unset($this->_objParametros);
       unset($this->_objUrlAmigable);
       unset($this->Datos);
       
       if (is_object($this->_objBuque)) unset($this->_objBuque);
    
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->Nombre = null;
        $this->Descripcion = null;
        $this->Planta = null;
        $this->_Codigo = 0;
        $this->_Buque = 0;

        $this->_Completo = false;
        $this->_CadenaConsulta = null;
    }	

    public function ReiniciaObjetos()
    {
        //Destruir Objetos  
        if (is_object($this->_objBuque)) unset($this->_objBuque);
        $this->_objEmpresa = null;       
     
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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM cubiertas WHERE cub_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerCubierta();
        }
        else
        {
            $this->ObtenerCubierta();
        }
    }

    public function Buque()
    {
        if (($this->_objBuque == null) && ($this->getCodigo() != 0) && ($this->_Buque != 0))
        {
            $this->_objBuque = new phpEmpresa();
            $this->_objBuque->setCodigo($this->_Buque);
        }
        return $this->_objBuque;
        
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		$strValor .= "Codigo:" . $this->_Codigo . ";";
        $strValor .= "Buque:" . $this->_Buque . ";";
    	$strValor .= "Nombre:" . $this->Nombre . ";";
        $strValor .= "Descripcion:" . $this->Descripcion . ";";
        
    	return $strValor;

    } 
	
    public function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public function Consulta($intBuque)
    {
        $cadenaConsulta = "Select * FROM cubiertas WHERE 1=1";
        
        if (!is_null($intBuque) && ($intBuque>0)) $cadenaConsulta .= " AND cub_buque = " . $intBuque;

        $cadenaConsulta .= " ORDER BY cub_planta";

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function ObtenerCubierta()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("cub_codigo"));    
            $this->_Buque = intval($this->Datos->Valor("cub_buque"));    
            $this->Nombre = $this->Datos->Valor("cub_nombre");
            $this->Descripcion = $this->Datos->Valor("cub_descripcion");  
            $this->Planta = $this->Datos->Valor("cub_planta");  
           
        }
    }
}

?>