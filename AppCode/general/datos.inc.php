<?php

// ##############################################################################
// # ARCHIVO:		datos.inc - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCifrado
// *****************************************************************************

// Público
	
class phpDatos{
    
    //Propiedades públicas  
    public $pageSize;

    //Propiedades Privadas
    public $_Datos;

    private $index;
    private $totalIndex;

    //Paginación
    private $Paginacion; 
    private $Pagina;
    private $PaginaTotal;

    //Objetos
    private $_Servidor;
    private $_UrlAmigable;
	

    // ****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){				
		
	    //Crea objetos		
        $this->_Servidor = new phpServidor();
        $this->_UrlAmigable = new phpUrlAmigable();

	    //Inicia propiedades        		
	    $this->Inicia();

    } 	
    
    function __destruct() {
		
	    //Hay que destruir los objetos		        
	    unset($this->_Servidor);
        unset($this->_UrlAmigable);
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	   //$this->_Datos = new DataTable();
        
        $this->Paginacion = false;
        $this->Pagina = 1;
        $this->PaginaTotal = 0;
        $this->index = 0;
        $this->totalIndex = 0;    
    
        $this->pageSize = 4; 
		
    }	

    // *****************************************************************************
    // * Propiedades
    // *****************************************************************************  
    public function __get($property) {
	    if (property_exists($this, $property)) {
        	return $this->$property;
        }	
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
          	$this->$property = $value;
        }
    }
        
    public function DataTable($DataTable)
    {
	    $this->_Datos = $DataTable;
        $this->index = 0;
        $this->totalIndex = $this->NumeroElementos() - 1;

        $this->PaginaTotal = $this->NumeroElementos() / $this->pageSize;
        if ($this->NumeroElementos() > $this->PaginaTotal * $this->pageSize) $this->PaginaTotal++;

        if (($this->Pagina < 1) || ($this->Pagina > $this->PaginaTotal)) $this->Pagina = 1;

        if (($this->Paginacion) && ($this->totalIndex > $this->pageSize))
        {
            $this->index = ($this->pageSize * $this->Pagina) - $this->pageSize;
            $this->totalIndex = ($this->index + $this->pageSize) - 1;

            if ($this->totalIndex >= $this->NumeroElementos()) $this->totalIndex = $this->NumeroElementos() - 1;                
        }

    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    public function Eof()
    {
        return (($this->index) > $this->totalIndex);
    }

    public function NumeroElementos()
    {
        return $this->_Datos->num_rows;
    }

    public function Siguiente()
    {
        $this->index++;
    }

    public function Primero()
    {
        $this->index=0;
    }

    public function Valor($strCampo)
    {   

        $this->_Datos->data_seek($this->index);

        /* obtener fila */
        $fila = $this->_Datos->fetch_assoc();
        
        return $fila[$strCampo];
    }
	
    public function Dato($strCampo, $varDato){
	    //$this->_Datos.Rows[_index][strCampo] = strDato;
    }
    
    /*	
    public void DatoCadena(String strCampo, String strDato)
    {
        _Datos.Rows[_index][strCampo] = strDato;
    }

    public void DatoFecha(String strCampo, DateTime dateDato)
    {
        _Datos.Rows[_index][strCampo] = dateDato;
    }

    public void DatoEntero(String strCampo, int intDato)
    {
        _Datos.Rows[_index][strCampo] = intDato;
    }

    public void DatoBooleano(String strCampo, Boolean bolDato)
    {
        _Datos.Rows[_index][strCampo] = bolDato;
    }

    public void DatoNulo(String strCampo)
    {
        _Datos.Rows[_index][strCampo] = "";
    }
    */

    public function CadenaPaginacion($enlace, $anterior, $siguiente)
    {
        $cadenaPaginacion = "";
        $i = 1;

        if ($this->Pagina > 1) $cadenaPaginacion .= "<li><a href=\"" . $this->_UrlAmigable->Amigable($enlace . "&pag=" . ($this->Pagina - 1)) . "\"><i class=\"fa fa-long-arrow-left\"></i>" . $anterior . "</a></li>";

        while (i <= $this->PaginaTotal)
        {
            $cadenaPaginacion .= "<li class=\"";

            if ($i == $this->Pagina) $cadenaPaginacion .= "active";

            $cadenaPaginacion .= "\"><a href=\"" . $this->_UrlAmigable->Amigable($enlace . "&pag=" . $i) . "\">" . $i . "</a></li>";
            $i++;
        }

        if ($this->Pagina < $this->PaginaTotal) $cadenaPaginacion .= "<li><a href=\"" . $this->_UrlAmigable->Amigable($enlace . "&pag=" . ($this->Pagina + 1)) . "\">" . $siguiente . "<i class=\"fa fa-long-arrow-right\"></i></a></li>";

        return $cadenaPaginacion;
    }
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
     

}

?>