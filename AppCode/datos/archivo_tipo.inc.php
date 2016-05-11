<?php

// ##############################################################################
// # ARCHIVO:		archivo_tipo.inc.php - Versi�n 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCifrado
// *****************************************************************************

// P�blico
	
class phpArchivoTipo{
    
    //Propiedades p�blicas  
    public $Nombre; 
    
    //Propiedades privadas  
    private $_Codigo;
    
    //Objetos
    private $_objBasedato;
   
    public $Datos;
    
    // *****************************************************************************
    // * Creaci�n y eliminaci�n
    // *****************************************************************************
    Public function __construct(){				
		
	   //Crea objetos		
       $this->_objBasedato = new phpBasedato();
       $this->_objBasedato->Conexion();   
       $this->Datos = new phpDatos(); 

	   // Inicia propiedades        
		
	   $this->Inicia();
    } 	
    
    function __destruct() {
		
	   //Hay que destruir los objetos		        
	   unset($this->_objBasedato);
       unset($this->Datos);
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->Nombre = null;
      
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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM tipos_archivos WHERE tar_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerArchivo();
        }
        else
        {
            $this->ObtenerArchivo();
        }
    }

    // *****************************************************************************
    // * M�todos P�blicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		
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
        $cadenaConsulta = "Select * FROM empresas WHERE 1=1";
        $cadenaConsulta .= " ORDER BY emp_nombre";

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    // *****************************************************************************
    // * M�todos Privados
    // *****************************************************************************
    private function ObtenerArchivo()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("tar_codigo"));    
            $this->Nombre = $this->Datos->Valor("tar_nombre");            
        }
    }

}

?>