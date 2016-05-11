<?php

// ##############################################################################
// # ARCHIVO:		participacionArchivos.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpParticipacionArchivos
// *****************************************************************************

// Público
class phpParticipacionArchivos{
    
    //Propiedades públicas  
    
    //Propiedades privadas  
    private $_Codigo;
    private $_Participacion;
    public $_Archivo;
    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_objServidor;
    private $_objBasedato;
    private $_objParametros;
    private $_objUrlAmigable;
    private $_objParticipacion;
    private $_objArchivo;

    public $Datos;
    
    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){				
		
	   //Crea objetos		
       $this->_objServidor = new phpServidor();
       $this->_objBasedato = new phpBasedato();
       $this->_objBasedato->Conexion();   
       $this->_objParametros = new phpParametros();           
       $this->_objUrlAmigable = new phpUrlAmigable();   
       $this->Datos = new phpDatos(); 
       $this->_objParticipacion = null;
       $this->_objArchivo = null;
	   // Inicia propiedades        
		
	   $this->Inicia();
    } 	
    
    function __destruct() {
		
	   //Hay que destruir los objetos
       unset($this->_objServidor);		        
	   unset($this->_objBasedato);
       unset($this->_objParametros);
       unset($this->_objUrlAmigable);
       unset($this->Datos);
       if (is_object($this->_objParticipacion)) unset($this->_objParticipacion);
       if (is_object($this->_objArchivo)) unset($this->_objArchivo);
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->Puntuacion = null;
        $this->_Codigo = 0;
    
        $this->_Completo = false;
        $this->_CadenaConsulta = null;
    }	

    public function ReiniciaObjetos()
    {
        //Destruir Objetos  
        if (is_object($this->_objParticipacion)) unset($this->_objParticipacion);
        $this->_objParticipacion = null;       
        if (is_object($this->_objArchivo)) unset($this->_objArchivo);
        $this->_objArchivo = null;   
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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM participacion_archivos WHERE pra_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerParticipacionArchivo();
        }
        else
        {
            $this->ObtenerParticipacionArchivo();
        }
    }

    public function setParticipacion($value)
    {
        if ($value > 0) $this->_Participacion = $value;
    }

    public function setArchivo($value)
    {
        if ($value > 0) $this->_Archivo = $value;
    }

    public function Servidor()
    {
        return $this->_objServidor;
    }

    public function Participacion()
    {
        if (($this->_objParticipacion == null) && ($this->getCodigo() != 0) && ($this->_Participacion != 0))
        {
            $this->_objParticipacion = new phpParticipacion();
            $this->_objParticipacion->setCodigo($this->_Participacion);
        }
        return $this->_objParticipacion;
        
    }
    
    public function Archivo()
    {
        if (($this->_objArchivo == null) && ($this->getCodigo() != 0) && ($this->_Archivo != 0))
        {
            $this->_objArchivo = new phpArchivo();

            $this->_objArchivo->setCodigo($this->_Archivo);
        }
        return $this->_objArchivo;
        
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		$strValor .= "Codigo:" . $this->_Codigo . ";";
        $strValor .= "Participacion:" . $this->_Participacion . ";";
        $strValor .= "Archivo:" . $this->_Archivo . ";";
       
    	return $strValor;

    } 
	
    public function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public function Consulta($intParticipacion)
    {
        $cadenaConsulta = "Select * FROM participacion_archivos WHERE 1=1";
        
        if (!is_null($intParticipacion) && ($intParticipacion>0)) $cadenaConsulta .= " AND pra_participacion = " . $intParticipacion;


        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public Function Agrega()
    {
        
        $intValor  = 0;
        
        if (($this->_Participacion==null) || ($this->_Participacion == "")) $this->_objServidor->Error = "No ha introducido la participación";
        if (($this->_objServidor->Error == "") && (($this->_Archivo==null) || ($this->_Archivo == ""))) $this->_objServidor->Error =  "No ha introducido el archivo";

        if ($this->_objServidor->Error== "")
        {
            $strConsulta;
            $strConsulta = "INSERT INTO participacion_archivos (";

            $strConsulta .= " pra_participacion";
            $strConsulta .= ", pra_archivo";
            
            $strConsulta .= ") VALUES (";

            $strConsulta .= $this->_objBasedato->InsertCadenaNumero($this->_Participacion, 0);
            $strConsulta .= $this->_objBasedato->InsertCadenaNumero($this->_Archivo, 1);
            
            $strConsulta .= ")";
            
            $intValor = $this->_objBasedato->InsertaDatos($strConsulta);

            if ($intValor > 0)
            {
                $this->setCodigo($intValor);
            }
            else
            {
                $this->_objServidor->Error = "Error: Operación no realizada, se han producido errores intentelo pasados unos minutos.";
            }
            
        }
        
        return $intValor;
                    
    }

    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function ObtenerParticipacionArchivo()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("pra_codigo"));    
            $this->_Participacion = $this->Datos->Valor("pra_participacion");  
            $this->_Archivo = $this->Datos->Valor("pra_archivo");  
           
        }
    }
}

?>