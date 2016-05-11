<?php

// ##############################################################################
// # ARCHIVO:		participacionPreguntas.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpParticipacionPregunta
// *****************************************************************************

// Público
class phpParticipacionPreguntas{
    
    //Propiedades públicas  
    public $Puntuacion; 
    
    //Propiedades privadas  
    private $_Codigo;
    private $_Participacion;
    private $_Pregunta;
    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_objServidor;
    private $_objBasedato;
    private $_objParametros;
    private $_objUrlAmigable;
    private $_objParticipacion;
    private $_objPregunta;

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
       $this->_objPregunta = null;
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
       if (is_object($this->_objPregunta)) unset($this->_objPregunta);
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
        if (is_object($this->_objPregunta)) unset($this->_objPregunta);
        $this->_objPregunta = null;   
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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM participacion_preguntas WHERE ppr_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerParticipacionPregunta();
        }
        else
        {
            $this->ObtenerParticipacionPregunta();
        }
    }

    public function setParticipacion($value)
    {
        if ($value > 0) $this->_Participacion = $value;
    }

    public function setPregunta($value)
    {
        if ($value > 0) $this->_Pregunta = $value;
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
    
    public function Pregunta()
    {
        if (($this->_objPregunta == null) && ($this->getCodigo() != 0) && ($this->_Pregunta != 0))
        {
            $this->_objPregunta = new phpPregunta();
            $this->_objPregunta->setCodigo($this->_Pregunta);
        }
        return $this->_objPregunta;
        
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		$strValor .= "Codigo:" . $this->_Codigo . ";";
        $strValor .= "Participacion:" . $this->_Participacion . ";";
        $strValor .= "Pregunta:" . $this->_Pregunta . ";";
        $strValor .= "Puntuacion:" . $this->Puntuacion . ";";        

    	return $strValor;

    } 
	
    public function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public function Consulta($intParticipacion)
    {
        $cadenaConsulta = "Select * FROM participacion_preguntas WHERE 1=1";
        
        if (!is_null($intParticipacion) && ($intParticipacion>0)) $cadenaConsulta .= " AND ppr_participacion = " . $intParticipacion;

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public Function Agrega()
    {
        
        $intValor  = 0;
        
        if (($this->Puntuacion==null) || ($this->Puntuacion == "")) $this->_objServidor->Error = "No ha introducido la puntuación";
        if (($this->_objServidor->Error == "") && (($this->_Participacion==null) || ($this->_Participacion == ""))) $this->_objServidor->Error =  "No ha introducido la participación";
        if (($this->_objServidor->Error == "") && (($this->_Pregunta==null) || ($this->_Pregunta == ""))) $this->_objServidor->Error =  "No ha introducido la pregunta";

        if ($this->_objServidor->Error== "")
        {
            $strConsulta;
            $strConsulta = "INSERT INTO participacion_preguntas (";

            $strConsulta .= " ppr_participacion";
            $strConsulta .= ", ppr_pregunta";
            $strConsulta .= ", ppr_puntuacion";
            
            $strConsulta .= ") VALUES (";

            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->_Participacion, 0);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->_Pregunta, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Puntuacion, 1);
            
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

    public function Media()
    {
        $intValor = 0;

        if ($this->Datos->NumeroElementos() > 0){
            while (!$this->Datos->Eof())
            {
                $this->Lee();  
                $intValor += $this->Puntuacion;
                $this->Datos->Siguiente();        
                $this->ReiniciaObjetos();     
            }
            $intValor = round($intValor / $this->Datos->NumeroElementos(),1);   
        }
        return $intValor;
    }

    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function ObtenerParticipacionPregunta()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("ppr_codigo"));    
            $this->Puntuacion = $this->Datos->Valor("ppr_puntuacion");
            $this->_Participacion = $this->Datos->Valor("ppr_participacion");  
            $this->_Pregunta = $this->Datos->Valor("ppr_pregunta");  
           
        }
    }
}

?>