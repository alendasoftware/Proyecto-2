<?php
// ##############################################################################
// # ARCHIVO:		basedato.inc - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpBaseDato
// *****************************************************************************

// Público
	
class phpBaseDato{
    
    //Propiedades públicas  
    
    //Propiedades privadas 
    private $db; 
    private $_Host; 
    private $_Basedato;	
    private $_Usuario;	
    private $_Clave;

    private $_Servidor;

    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){				
		
	    //Crea objetos		
        $this->_Servidor = new phpServidor();

	    // Inicia propiedades        
	    $this->db = null;	
	    $this->Inicia();
    } 	
    
    function __destruct() {
		
	    //Hay que destruir los objetos		        
        unset($this->_Servidor);
	    if (is_object($this->db)) $this->db->close();
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
	
	   if ($this->_Servidor->Entorno() == vbServidorEntornoDesarrollo){	
            $this->_Host = vbBasedatoDesarrolloHost;
            $this->_Basedato = vbBasedatoDesarrollo;		
            $this->_Usuario = vbBasedatoDesarrolloUsuario;   
        	$this->_Clave = vbBasedatoDesarrolloClave;   			 
	    }else{
		    $this->_Host = vbBasedatoProduccionHost;
            $this->_Basedato = vbBasedatoProduccion;		
            $this->_Usuario = vbBasedatoProduccionUsuario;   
        	$this->_Clave = vbBasedatoProduccionClave;
        }
		
    }	

    // *****************************************************************************
    // * Propiedades
    // *****************************************************************************  
    public function Conexion(){
	   
        if (is_null($this->db)) {
            $this->db = new mysqli($this->_Host, $this->_Usuario, $this->_Clave, $this->_Basedato);
	        
            $this->db->set_charset("utf8");

            if($this->db->connect_errno > 0){
                $this->Servidor->Error = 'Imposible conectar [' . $this->db->connect_error . ']';                
            }            
        } 	
        return $this->db;
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		
        $strValor .= "_Host:" . $this->_Basedato . ";";
	    $strValor .= "_Basedato:" . $this->_Basedato . ";";
        $strValor .= "_Usuario:" . $this->_Usuario . ";";
	    $strValor .= "_Clave:" . $this->_Clave . ";";
	
	    return $strValor;
    } 
	
    
    public function AbreConsulta($Consulta)
    {
        $DataTable = null;

        if ($Consulta != "")
        {
	       if(!$DataTable = $this->db->query($Consulta)) $this->Servidor->Error = 'Ocurrio un error ejecutando la consulta [' . $this->db->error . ']';
        }

        return $DataTable;
    }
    
    public function ActualizaDatos($Consulta)
    {
        $numRowsAffected = 0;

    	if(!$DataTable = $this->db->query($Consulta)) {
    	    $this->Servidor->Error = 'Ocurrio un error ejecutando la consulta [' . $this->db->error . ']';
    	}else{	
            $numRowsAffected = $this->db->affected_rows;
    	}
        
        return $numRowsAffected >= 0;
    }

    public function InsertaDatos($Consulta)
    {
        $this->db->query($Consulta);
        return $this->db->insert_id;
    }

    public function ActualizaCadenaTexto($Campo, $Dato, $Tipo)
    {
        $strCadena = "";

        if ($Tipo == 1) $strCadena .= ",";
        if (($Dato != null) && ($Dato != ""))
        {
            $strCadena .= $Campo . " = '" . $Dato . "'";
        }
        else
        {
            $strCadena .= $Campo . " = null";
        }

        return $strCadena;
    }

    public function ActualizaCadenaNumero($Campo, $Dato, $Tipo)
    {
        $strCadena = "";

        if ($Tipo == 1) $strCadena .= ",";
        if ($Dato>=0)
        {
            $strCadena .= $Campo . " = " . $Dato;
        }
        else
        {
            $strCadena .= ·Campo . " = null";
        }

        return $strCadena;
    }

    public function ActualizaCadenaBooleano($Campo, $Dato, $Tipo)
    {
        $strCadena = "";

        if ($Tipo == 1) $strCadena .= ",";
        if ($Dato)
        {
            $strCadena .= $Campo . " = true";
        }
        else
        {
            $strCadena .= $Campo . " = false";
        }

        return $strCadena;
    }

    public function InsertCadenaTexto($Dato, $Tipo)
    {
        $strCadena="";
        
        if ($Tipo == 1) $strCadena .= ",";
        if (($Dato != null) && ($Dato != ""))
        {
            $strCadena .= "'" . $Dato . "'";
        }else{
            $strCadena .= "null";
        }
        
        return $strCadena;
    }

    public function InsertCadenaNumero($Dato, $Tipo)
    {
        $strCadena="";
        
        if ($Tipo == 1) $strCadena .= ",";
        if ($Dato>=0)
        {
            $strCadena .= $Dato;
        }else{
            $strCadena .= "null";
        }
        
        return $strCadena;
    }

    public function InsertCadenaBooleano($Dato, $Tipo)
    {
        $strCadena = "";

        if ($Tipo == 1) $strCadena .= ",";
        if ($Dato)
        {
            $strCadena .= "true";
        }else{
            $strCadena .= "false";
        }
        
        return $strCadena;
    }
    
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
     

}

?>