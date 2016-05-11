<?php

// ##############################################################################
// # ARCHIVO:		buque.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCifrado
// *****************************************************************************

// Público
	
class phpCamarote{
    
    //Propiedades públicas  
    public $Nombre; 
    public $Descripcion;
    public $DescripcionCorta;
    public $FichaTecnica;

    //Propiedades privadas  
    private $_Codigo;
    private $_Empresa;
    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_objBasedato;
    private $_objParametros;
    private $_objUrlAmigable;
    private $_objEmpresa;
    private $_objArchivo;
    private $_objImagen;
    private $_objSlider;

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
       $this->_objEmpresa = null;
       $this->_objArchivo = null;
       $this->_objImagen = null;
       $this->_objSlider = null;

	   // Inicia propiedades        
		
	   $this->Inicia();
    } 	
    
    function __destruct() {
		
	   //Hay que destruir los objetos		        
	   unset($this->_objBasedato);
       unset($this->_objParametros);
       unset($this->_objUrlAmigable);
       unset($this->Datos);
       
       if (is_object($this->_objEmpresa)) unset($this->_objEmpresa);
       if (is_object($this->_objArchivo)) unset($this->_objArchivo);
       if (is_object($this->_objImagen)) unset($this->_objImagen);
       if (is_object($this->_objSlider)) unset($this->_objSlider);

    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->Nombre = null;
        $this->Descripcion = null;
        $this->DescripcionCorta = null;
        $this->FichaTecnica = null;

        $this->_Codigo = 0;
        $this->_Empresa = 0;

        $this->_Completo = false;
        $this->_CadenaConsulta = null;
    }	

    public function ReiniciaObjetos()
    {
        //Destruir Objetos  
        if (is_object($this->_objEmpresa)) unset($this->_objEmpresa);
        $this->_objEmpresa = null;       
        if (is_object($this->_objArchivo)) unset($this->_objArchivo);
        $this->_objArchivo = null;       
        if (is_object($this->_objImagen)) unset($this->_objImagen);
        $this->_objImagen = null;       
        if (is_object($this->_objSlider)) unset($this->_objSlider);
        $this->_objSlider = null;       
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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM buques WHERE buq_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerBuque();
        }
        else
        {
            $this->ObtenerBuque();
        }
    }

    public function UrlAmigable()
    {
        return $this->_objUrlAmigable->Amigable("buque.php?id=" . $this->getCodigo() . "&cod=" . vbPaginaCruceros . "&nom=" . $this->Nombre);
    }

    public function UrlAmigableCamarotes()
    {
        return $this->_objUrlAmigable->Amigable("buque.php?id=" . $this->getCodigo() . "&cod=" . vbPaginaCruceros . "&nav=1&nom=" . $this->Nombre);
    }

    public function UrlAmigableCubiertas()
    {
        return $this->_objUrlAmigable->Amigable("buque.php?id=" . $this->getCodigo() . "&cod=" . vbPaginaCruceros . "&nav=2&nom=" . $this->Nombre);
    }

    public function UrlAmigableListado($intEmpresa,$objTraductor)
    {
        return $this->_objUrlAmigable->Amigable("crucero.php?id=" . $intEmpresa . "&cod=" . vbPaginaCruceros . "&nom=" . $objTraductor->Traducir("Listado") . " " . $objTraductor->Traducir("Productos"));
    }

    public function Empresa()
    {
        if (($this->_objEmpresa == null) && ($this->getCodigo() != 0) && ($this->_Empresa != 0))
        {
            $this->_objEmpresa = new phpEmpresa();
            $this->_objEmpresa->setCodigo($this->_Empresa);
        }
        return $this->_objEmpresa;
        
    }

    public function Archivo()
    {
        if (($this->_objArchivo == null) && ($this->getCodigo() != 0))
        {
            $this->_objArchivo = new phpArchivo();
            $this->_objArchivo->ConsultaBuques($this->getCodigo(),vbArchivoTipoArchivo,null);
        }
        return $this->_objArchivo;        
    }

    public function Imagen()
    {
        if (($this->_objImagen == null) && ($this->getCodigo() != 0))
        {
            $this->_objImagen = new phpArchivo();
            $this->_objImagen->ConsultaBuques($this->getCodigo(),vbArchivoTipoImagen,vbGrupoImagen);
        }
        return $this->_objImagen;    
    }

    public function Slider()
    {
        if (($this->_objSlider == null) && ($this->getCodigo() != 0))
        {
            $this->_objSlider = new phpArchivo();
            $this->_objSlider->ConsultaBuques($this->getCodigo(),vbArchivoTipoImagen,vbGrupoImagenSlider);
        }
        return $this->_objSlider;    
    }
    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		$strValor .= "Codigo:" . $this->_Codigo . ";";
        $strValor .= "Empresa:" . $this->_Empresa . ";";
    	$strValor .= "Nombre:" . $this->Nombre . ";";
        $strValor .= "Descripcion:" . $this->Descripcion . ";";
        $strValor .= "FichaTecnica:" . $this->FichaTecnica . ";";

    	return $strValor;

    } 
	
    public function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public function Consulta($intEmpresa)
    {
        $cadenaConsulta = "Select * FROM buques WHERE 1=1";
        
        if (!is_null($intEmpresa) && ($intEmpresa>0)) $cadenaConsulta .= " AND buq_empresa = " . $intEmpresa;

        $cadenaConsulta .= " ORDER BY buq_nombre";

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function DibujaListaIcono()
    {
        $html = "";

        $html .= "<div class=\"col-md-4 col-sm-6 wow fadeInDown\" data-wow-duration=\"1000ms\" data-wow-delay=\"600ms\">";
            $html .= "<div class=\"feature-wrap\">";
            $html .= "<a href=\"" . $this->UrlAmigable() . "\" title=\"" . $this->Nombre . "\">";
            $html .= "<i class=\"fa fa-gears\"></i>";
            $html .= "</a>";
            $html .= "<h2>" . $this->Nombre . "</h2>";
            //$html .= "<h3>" . $this->Descripcion . "</h3>";                
            $html .= "</div>";
        $html .= "</div><!--/.col-md-4-->";

        return $html;
    }

    public function DibujaListaImagen()
    {
        $html = "";
        $html .= "<div class=\"col-sm-6 col-md-4\">";
            $html .= "<div class=\"media services-wrap wow fadeInDown animated\" style=\"visibility: visible; animation-name: fadeInDown;\">";
                $html .= "<div>";
                    $html .= "<a href=\"" . $this->UrlAmigable() . "\" title=\"" . $this->Nombre . "\">";                    
                    if ($this->Slider()->Datos->NumeroElementos() > 0)
                    {
                        $this->Slider()->Lee();
                        $html .= "<img class=\"img-responsive\" width=\"100%\" src=\"" . $this->_objParametros->Directorio . "/subidas/buques/" . $this->getCodigo() . "/slider/". $this->Slider()->ArchivoNormal() ."\">";                    
                    }else{
                        $html .= "<img class=\"img-responsive\" width=\"100%\" src=\"" . $this->_objParametros->Directorio . "/subidas/buques/header.jpg\">";                        
                    }
                    $html .= "</a>";
                $html .= "</div>";
                $html .= "<div class=\"media-body\">";
                    $html .= "<h3 class=\"media-heading\">" . $this->Nombre . "</h3>";
                    $html .= "<p>" . $this->DescripcionCorta . "</p>";
                $html .= "</div>";
            $html .= "</div>";
        $html .= "</div>";

        return $html;
    }

    public function DibujaFicha($nav, $objTraductor)
    {
        $html = "";

        $html .= "<div class=\"col-md-8\">";
        $html .= "<div class=\"blog-item\">";
        if ($this->Slider()->Datos->NumeroElementos() > 0)
        {
            $this->Slider()->Lee();
            $html .= "<img class='img-responsive img-blog' width='100%' alt='' src='" . $this->_objParametros->Directorio . "/subidas/buques/" . $this->getCodigo() . "/slider/". $this->Slider()->Nombre ."' />";
        }
        $html .= "<div class=\"row\">";
        
            $html .= "<div class=\"col-md-12\"><ul class=\"nav nav-tabs\">";
              $strClass="";
              if ($nav==0) $strClass="active";
              $html .= "<li role=\"presentation\" class=\"" . $strClass ."\"><a href=\"" . $this->UrlAmigable() . "\">Descripci&oacute;n</a></li>";
              
              $strClass="";
              if ($nav==1) $strClass="active";
              $html .= "<li role=\"presentation\" class=\"" . $strClass ."\"><a href=\"" . $this->UrlAmigableCamarotes() . "\">Camarotes</a></li>";
              
              $strClass="";
              if ($nav==2) $strClass="active";
              $html .= "<li role=\"presentation\" class=\"" . $strClass ."\"><a href=\"" . $this->UrlAmigableCubiertas() . "\">Cubiertas</a></li>";
            $html .= "</ul></div>";

            $html .= "<div class=\"col-xs-12 col-sm-12 blog-content\">";
            
            switch ($nav) {
                case 0:
                    $html .= "<h2>" . $this->Empresa()->Descripcion . "</h2>";
                    $html .= $this->Descripcion;
                    break;

                case 1:
                    $html .= "<section id=\"services\" class=\"service-item\">";
                        $html .= "<div class=\"container\">";
                            $html .= "<div class=\"row\">";
                              

                            $html .= "</div>";
                        $html .= "</div>";
                    $html .= "</section>";  
                    break;

                case 2:
                    break;
            }
            

            $html .= "</div>";

            if ($nav==0){   
                $html .= "<div class=\"col-xs-12 col-sm-12 blog-content\">";
                    $html .= "<div class=\"buquefichatecnica\">" . $this->FichaTecnica . "</div>";
                $html .= "</div>";
            }

        $html .= "</div><!--/.row-->";

        $html .= "</div><!--/.blog-item-->";

        $html .= "</div><!--/.col-md-8-->";

        return $html;
    }

    public function DibujaEtiquetaTodos($intTipo, $intEmpresa, $objTraductor)
    {
        $html = "";

        $html .= "<li><a class=\"btn btn-xs btn-primary";
        if ($intTipo == 0) $html .= " active";
        $html .= "\" href=\"" . $this->UrlAmigableListado($intEmpresa,$objTraductor) . "\">". $objTraductor->Traducir("Todos") . "</a></li>&nbsp;";
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
    private function ObtenerBuque()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("buq_codigo"));    
            $this->_Empresa = intval($this->Datos->Valor("buq_empresa"));    
            $this->Nombre = $this->Datos->Valor("buq_nombre");
            $this->Descripcion = $this->Datos->Valor("buq_descripcion");  
            if ((is_null($this->Descripcion))||($this->Descripcion=="")) $this->Descripcion = "Lorem ipsum dolor sit ame consectetur adipisicing elit"; 
            $this->FichaTecnica = $this->Datos->Valor("buq_ficha_tecnica");  
            $this->DescripcionCorta = $this->Datos->Valor("buq_descripcion_corta");  
            if ((is_null($this->DescripcionCorta))||($this->DescripcionCorta=="")) {
                $this->DescripcionCorta = "Lorem ipsum dolor sit ame consectetur adipisicing elit"; 
            }else{
               $this->DescripcionCorta = $this->recortar_texto($this->DescripcionCorta, 150, '...');
            }
        }
    }

    private function recortar_texto($texto,$tamano,$colilla) {
        $texto=substr($texto, 0,$tamano);
        $index=strrpos($texto, " ");
        $texto=substr($texto, 0,$index); $texto.=$colilla;
        return $texto;
    }
}

?>