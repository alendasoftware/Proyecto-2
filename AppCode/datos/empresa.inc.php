<?php

// ##############################################################################
// # ARCHIVO:		empresa.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCifrado
// *****************************************************************************

// Público
	
class phpEmpresa{
    
    //Propiedades públicas  
    public $Nombre; 
    public $Descripcion;
    public $Logo;
    public $Web;

    //Propiedades privadas  
    private $_Codigo;
    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_objServidor;
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
       $this->_objServidor = new phpServidor();
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
	   unset($this->_objServidor);
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
        $this->Logo = null;
        $this->Web = null;

        $this->_Codigo = 0;
        
        $this->_Completo = false;
        $this->_CadenaConsulta = null;
    }	

    public function ReiniciaObjetos()
    {
        //Destruir Objetos        
        if (is_object($this->_objBuque)) unset($this->_objBuque);
        $this->_objBuque = null;
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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM empresas WHERE emp_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerEmpresa();
        }
        else
        {
            $this->ObtenerEmpresa();
        }
    }

    public function UrlAmigableListado($objTraductor)
    {
        return $this->_objUrlAmigable->Amigable("cruceros.php?cod=" . vbPaginaCruceros . "&nom=" . $objTraductor->Traducir("Listado") . " " . $objTraductor->Traducir("Productos"));
    }

    public function UrlAmigable()
    {
        return $this->_objUrlAmigable->Amigable("crucero.php?id=" . $this->getCodigo() . "&cod=" . vbPaginaCruceros . "&nom=" . $this->Nombre);
    }

    public function UrlAmigableBuscador()
    {
        return $this->_objUrlAmigable->Amigable("crucero.php?cod=" . vbPaginaCruceros . "&nom=Buscar buques");
    }

    public function Servidor()
    {
        return $this->_objServidor;
    }

    public function Buque()
    {
        if (($this->_objBuque == null) && ($this->getCodigo() != 0))
        {
            $this->_objBuque = new phpBuque();
            $this->_objBuque->Consulta($this->getCodigo());
        }
        return $this->_objBuque;    
    }

    // *****************************************************************************
    // * Métodos Públicos
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

    public Function Agrega()
    {
        
        $intValor  = 0;
       
        if (($this->Nombre==null) || ($this->Nombre == "")) $this->_objServidor->Error = "No ha introducido el nombre";
       
        if ($this->_objServidor->Error== "")
        {
            $strConsulta;
            $strConsulta = "INSERT INTO empresas (";

            $strConsulta .= " emp_nombre";
            $strConsulta .= ", emp_web";
            $strConsulta .= ", emp_descripcion";
            $strConsulta .= ", emp_logo";
            
            $strConsulta .= ") VALUES (";

            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Nombre, 0);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Web, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Descripcion, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Logo, 1);
            
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

    public Function Modifica()
    {   
        $blnValor = false;
        
        if ($this->getCodigo()==0) $this->_objServidor->Error = "No se encuentra el registro"; 
        if (($this->_objServidor->Error == "") && (($this->Nombre==null) || ($this->Nombre == ""))) $this->_objServidor->Error = "No ha introducido el nombre";
        
        if ($this->_objServidor->Error=="") {
            
            $strConsulta;
            $strConsulta = "UPDATE empresas SET ";
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("emp_nombre", $this->Nombre, 0);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("emp_web", $this->Web, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("emp_descripcion", $this->Descripcion, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("emp_logo", $this->Logo, 1);
            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND emp_codigo=" . $this->getCodigo();

            $blnValor = $this->_objBasedato->ActualizaDatos($strConsulta);
            if (!$blnValor) $this->_objServidor->Error = "Error: Operación no realizada, se han producido errores intentelo pasados unos minutos.";
        }
    
        return $blnValor;
    }

    public Function Elimina()
    {   
        $blnValor = false;
        
        if ($this->getCodigo()==0) $this->_objServidor->Error = "No se encuentra el registro"; 
        
        if ($this->_objServidor->Error=="") {
            
            $strConsulta;
            $strConsulta = "DELETE FROM empresas";
            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND emp_codigo=" . $this->getCodigo();

            $blnValor = $this->_objBasedato->ActualizaDatos($strConsulta);
            if (!$blnValor) $this->_objServidor->Error = "Error: Operación no realizada, se han producido errores intentelo pasados unos minutos.";
        }
    
        return $blnValor;
    }

    public function DibujaHome($strClase, $strEtiqueta)
    {
        $html = "";

        $html .= "<div class=\"portfolio-item " . $strClase . " col-xs-12 col-sm-4 col-md-3\">";
            $html .= "<div class=\"recent-work-wrap\">";
            $html .= "<img src=\"" . $this->_objParametros->Directorio . "/subidas/empresas/" . $this->Logo .  "\" alt=\"" . $this->Nombre . "\">";
                $html .= "<div class=\"overlay\">";
                    $html .= "<div class=\"recent-work-inner\">";
                    $html .= "<h3><a href=\"" . $this->UrlAmigable() . "\">" . $this->Nombre . "</a></h3>";
                        $html .= "<p>" . $this->Descripcion . "</p>";
                        $html .= "<a class=\"preview\" href=\"" . $this->UrlAmigable() . "\"><i class=\"fa fa-eye\"></i> " . $strEtiqueta . "</a>";
                    $html .= "</div>"; 
                $html .= "</div>";
            $html .= "</div>";
        $html .= "</div><!--/.portfolio-item-->";

        return $html;
    }

    public function DibujaFichaVacia()
    {
        $html = "";

        $html .= "<div class=\"col-md-8\">";
        $html .= "<div class=\"blog-item\">";
        $html .= "<h3>Producto no encontrado</h3>";
        $html .= "</div>";
        $html .= "</div><!--/.blog-item-->";

        return $html;
    }

    public function DibujaFicha($objTraductor)
    {
        $html = "";

        $html .= "<div class=\"col-md-8\">";
            $html .= "<div class=\"blog-item\">";
            
                if (($this->Logo != null) && ($this->Logo != "")) $html .= "<img class='img-responsive img-blog' width='100%' alt='' src='" . $this->_objParametros->Directorio . "/subidas/empresas/" . $this->Logo . "' />";                  
                $html .= "<div class=\"row\">";  
                    $html .= "<div class=\"col-xs-12 col-sm-12 blog-content\">";
                        $html .= "<h3>" . $this->Descripcion . "</h3>"; ;                
                    $html .= "</div>";
                $html .= "</div>";
            $html .= "</div><!--/.blog-item-->";
            
            //Acciones
            //producto += "<div class=\"media reply_section\">";
            //producto += "<div class=\"pull-left post_reply text-center\">";
            //producto += "&nbsp;";
            //producto += "</div>";
            //producto += "<div class=\"media-body post_reply_content\">";

            //Documentos
            //producto += "</div>";
            //producto += "</div>";

        $html .= "</div><!--/.col-md-8-->";

        return $html;
    }

    public function DibujaPanelFicha()
    {
        $html = "";


        $objElementoFormulario = new phpElementoformulario();
        
        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "Codigo";
        $objElementoFormulario->Nombre = "Codigo";
        $objElementoFormulario->Valor = $this->getCodigo();
        $objElementoFormulario->Visible = false;
        $html .= $objElementoFormulario->AbreDibujo();

        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "emp_nombre";
        $objElementoFormulario->Nombre = "Nombre";
        $objElementoFormulario->Valor = $this->Nombre;
        $objElementoFormulario->Requerido = true;
        $objElementoFormulario->Longitud = 255;
        $objElementoFormulario->setTipo(vbTipoTextoPanel);
        $html .= $objElementoFormulario->AbreDibujo();

        $objElementoFormulario->Reinicia();
        $objElementoFormulario->Id = "emp_web";
        $objElementoFormulario->Nombre = "Web";
        $objElementoFormulario->Valor = $this->Web;
        $objElementoFormulario->Longitud = 255;
        $objElementoFormulario->setTipo(vbTipoTextoPanel);
        $html .= $objElementoFormulario->AbreDibujo();

        return $html;
    }

    public function DibujaEtiquetaTodos($intTipo, $objTraductor)
    {
        $html = "";

        $html .= "<li><a class=\"btn btn-xs btn-primary";
        if ($intTipo == 0) $html .= " active";
        $html .= "\" href=\"" . $this->UrlAmigableListado($objTraductor) . "\">". $objTraductor->Traducir("Todos") . "</a></li>&nbsp;";
        return $html;
    }


    public function DibujaEtiqueta($intTipo)
    {
        $html = "";

        $html .= "<li><a class=\"btn btn-xs btn-primary";
        if ($intTipo == $this->getCodigo()) $html .=" active";
        $html .= "\" href=\"" . $this->UrlAmigable() . "\">" . $this->Nombre . "</a></li>&nbsp;";
        return $html;
    }

    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function ObtenerEmpresa()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("emp_codigo"));    
            $this->Nombre = $this->Datos->Valor("emp_nombre");
            $this->Descripcion = $this->Datos->Valor("emp_descripcion");   
            if ((is_null($this->Descripcion))||($this->Descripcion=="")) $this->Descripcion = "Lorem ipsum dolor sit ame consectetur adipisicing elit";
            $this->Logo = $this->Datos->Valor("emp_logo");  
            $this->Web = $this->Datos->Valor("emp_web");  
        }
    }

}

?>