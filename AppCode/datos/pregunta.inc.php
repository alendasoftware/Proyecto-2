<?php

// ##############################################################################
// # ARCHIVO:		pregunta.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpPregunta
// *****************************************************************************

// Público
class phpPregunta{
    
    //Propiedades públicas  
    public $Nombre; 
    public $Orden;
    
    //Propiedades privadas  
    private $_Codigo;
    private $_Buque;
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
        $this->Orden = null;
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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM preguntas WHERE pre_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerPregunta();
        }
        else
        {
            $this->ObtenerPregunta();
        }
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		$strValor .= "Codigo:" . $this->_Codigo . ";";
        $strValor .= "Nombre:" . $this->Nombre . ";";
        $strValor .= "Orden:" . $this->Orden . ";";
        
    	return $strValor;

    } 
	
    public function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public function Consulta()
    {
        $cadenaConsulta = "Select * FROM preguntas WHERE 1=1";
        
        $cadenaConsulta .= " ORDER BY pre_orden";

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function ObtenerPregunta()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("pre_codigo"));    
            $this->Nombre = $this->Datos->Valor("pre_nombre");
            $this->Planta = $this->Datos->Valor("pre_orden");  
           
        }
    }
}

?>