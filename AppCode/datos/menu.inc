<?php

// ##############################################################################
// # ARCHIVO:		menu.inc - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################
// # HISTORIA:		v1.0 - 20/03/14 - Creación (Dcornejo)
// ##############################################################################

// *****************************************************************************
// * Clase phpMenu
// *****************************************************************************

// Público
	
class phpMenu{
    
    //Propiedades públicas  
    public $PaginaInicio; //Página de incio

    //Propiedades Públicas    
    public $Nombre; 
    public $Padre;
    public $Orden;
    public $Url;
    public $UrlHtml;
    public $UrlBd;
    public $Extra;
    public $Visible;
    public $Title;
    public $Keywords;
    public $Description;
    
    //Propiedades Privadas    
    public $Actual;
    private $_Codigo;
    private $_AbsolutePath;    

    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_Parametros;
    private $_objBasedato;
    private $_Traductor;
    private $_UrlAmigable;
    
    public $Datos;
    
    // *****************************************************************************
    // * Creación y eliminación
    // *****************************************************************************
    Public function __construct(){				
		
	    //Crea objetos		
        $this->_Parametros = new phpParametros();
        $this->_objBasedato = new phpBasedato();
        $this->_objBasedato->Conexion();
        $this->_Traductor = new phpTraductor();
        $this->_UrlAmigable = new phpUrlAmigable();
        $this->Datos = new phpDatos();

        $this->PaginaInicio = 1;

        $_AbsolutePath = $_SERVER['DOCUMENT_ROOT'];

	    // Inicia propiedades        
		$this->Inicia();
    } 	
    
    function __destruct() {
		
	    //Hay que destruir los objetos		        
	    unset($this->_Parametros);
        unset($this->_objBasedato);
        unset($this->_Traductor);
        unset($this->_UrlAmigable);
        unset($this->Datos);
       
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->Nombre = null;
        $this->Padre = 0;
        $this->Orden = 0;
        $this->Url = null;
        $this->UrlHtml = null;
        $this->UrlBd = "index.php";
        $this->Extra = false;
        $this->Visible = false;
        $this->Title = vbPageTitle;
        $this->Keywords = vbPageKeyWords;
        $this->Description = vbPageDescription;

        $this->_Codigo = 0;
        $this->Actual = $this->PaginaInicio;

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
    public function UrlAmigable()
    {
        return $this->_UrlAmigable->Amigable($this->Url);
    }

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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM páginas WHERE pág_código = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerPagina();
        }
        else
        {
            $this->ObtenerPagina();
        }
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    public function DevuelveCadena()
    {
        $Cadena = "";
        $Cadena .= "Codigo: " . $this->getCodigo() . ";";
        $Cadena .= "Nombre: " . $this->Nombre . ";";
        $Cadena .= "Padre: " . $this->Padre . ";";
        $Cadena .= "Orden: " . $this->Orden . ";";
        $Cadena .= "Url: " . $this->Url . ";";
        $Cadena .= "UrlHtml: " . $this->UrlHtml . ";";        
        $Cadena .= "UrlBd: " . $this->UrlBd . ";";        
        $Cadena .= "Extra: " . $this->Extra . ";";
        $Cadena .= "Visible: " . $this->Visible . ";";
        $Cadena .= "Title: " . $this->Title . ";";
        $Cadena .= "Keywords: " . $this->Keywords . ";";
        $Cadena .= "Description: " . $this->Description . ";";

        return $Cadena;
    }

    public function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public function Consulta($Padre, $Extra)
    {
        $cadenaConsulta = "Select * FROM páginas WHERE 1=1 AND pág_visible=1";
        if ($Padre > 0) $cadenaConsulta .= " AND pág_padre=" . $Padre;
        if ($Extra){
            $cadenaConsulta .= " AND pág_extra=1";
        }else{
            $cadenaConsulta .= " AND pág_extra=0";    
        }
        $cadenaConsulta .= " ORDER BY pág_orden";

        $this->_CadenaConsulta = $cadenaConsulta;
       
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function ConsultaSitemap($Extra)
    {
        $cadenaConsulta = "Select * FROM páginas WHERE 1=1 AND pág_visible=1";
        $cadenaConsulta .= " AND pág_url<>''";
        $cadenaConsulta .= " ORDER BY pág_extra DESC, pág_padre, pág_orden";

        $this->_CadenaConsulta = $cadenaConsulta;

        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }
    
    public function DibujaHead()
    {
        $pagina = "";

        $pagina .= "<meta charset=\"utf-8\">";
        $pagina .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
        $pagina .= "<!-- core CSS -->";
        $pagina .= "<link href=\"" . $this->_Parametros->Directorio . "/css/bootstrap.min.css\" rel=\"stylesheet\">";
        $pagina .= "<link href=\"" . $this->_Parametros->Directorio . "/css/font-awesome.min.css\" rel=\"stylesheet\">";
        $pagina .= "<link href=\"" . $this->_Parametros->Directorio . "/css/animate.min.css\" rel=\"stylesheet\">";
        $pagina .= "<link href=\"" . $this->_Parametros->Directorio . "/css/prettyPhoto.css\" rel=\"stylesheet\">";
        $pagina .= "<link href=\"" . $this->_Parametros->Directorio . "/css/main.css\" rel=\"stylesheet\">";
        $pagina .= "<link href=\"" . $this->_Parametros->Directorio . "/css/responsive.css\" rel=\"stylesheet\">";
        $pagina .= "<!--[if lt IE 9]>";
        $pagina .= "<script src=\"" . $this->_Parametros->Directorio . "/js/html5shiv.js\"></script>";
        $pagina .= "<script src=\"" . $this->_Parametros->Directorio . "/js/respond.min.js\"></script>";        
        $pagina .= "<![endif]-->";
        $pagina .= "<script src=\"https://www.google.com/recaptcha/api.js?hl=" . $this->_Traductor->getIdioma() . "\"></script>";
        $pagina .= "<link rel=\"shortcut icon\" href=\"" . $this->_Parametros->Directorio . "/images/ico/favicon.ico\">";
        $pagina .= "<link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"" . $this->_Parametros->Directorio . "/images/ico/apple-touch-icon-144-precomposed.png\">";
        $pagina .= "<link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"" . $this->_Parametros->Directorio . "/images/ico/apple-touch-icon-114-precomposed.png\">";
        $pagina .= "<link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"" . $this->_Parametros->Directorio . "/images/ico/apple-touch-icon-72-precomposed.png\">";
        $pagina .= "<link rel=\"apple-touch-icon-precomposed\" href=\"" . $this->_Parametros->Directorio . "/images/ico/apple-touch-icon-57-precomposed.png\">";
        

        return $pagina;
    }

    public function DibujaMenu()
    {
        $menu = "";
        $menu = $this->DibujaOpcionInicio();
        
        if ($this->Datos->NumeroElementos() > 0)
        {
            while (!$this->Datos->Eof())
            {
                $this->Lee();

                $_Hijos = new phpMenu();
                $_Hijos->Consulta($this->_Codigo, false);
                if ($_Hijos->Datos->NumeroElementos() > 0)
                {
                    $menu .= $this->DibujaOpcionMenuHijos($_Hijos); 
                }
                else
                {
                    $menu .= $this->DibujaOpcionMenu();
                }
                unset($_Hijos);

                $this->Datos->Siguiente();                
            }
        
        }
        return $menu;
    }

    public function DibujaOpcionInicio()
    {
        $menu = "";

        $menu .= "<li";
        if ($this->PaginaInicio == $this->Actual) $menu .= " class=\"active\"";

        switch ($this->_Traductor->getIdioma())
        {
            case "es":
                $menu .= "><a href=\"" . $this->_UrlAmigable->Amigable(null) . "\" title=\"Inicio\">Inicio</a></li>";
                break;
                
            case "en":
                $menu .= "><a href=\"" . $this->_UrlAmigable->Amigable(null) . "\" title=\"Home\">Home</a></li>";
                break;
                
            default:
                $menu .= "><a href=\"" .$this->_UrlAmigable->Amigable(null) . "\" title=\"Inicio\">Inicio</a></li>";
                break;
        }
        
        return $menu;
    }

    public function DibujaOpcionMenu()
    {
        $menu = "";
       
        $menu .= "<li";

        if ($this->_Codigo == $this->Actual) $menu .= " class=\"active\"";
        $menu .= "><a href=\"" . $this->_UrlAmigable->Amigable($this->Url) . "\" title=\"" . $this->Nombre . "\">" . $this->Nombre . "</a></li>";

        return $menu;
    }

    public function DibujaOpcionMenuHijos($Hijos)
    {
        $menu = "";
        $PaginaActual = new phpMenu();
        $PaginaActual->setCodigo($this->Actual);

        $menu .= "<li class=\"dropdown";
        if (($this->_Codigo == $this->Actual) || ($this->_Codigo == $PaginaActual->Padre)) $menu .= " active";
        
        $menu .= "\">";
        $menu .= "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">" . $this->Nombre . " <i class=\"fa fa-angle-down\"></i></a>";
        $menu .= "<ul class=\"dropdown-menu\">";

        while (!($Hijos->Datos->Eof()))
        {
            $Hijos->Lee();
            $menu .= "<li";
            if (($this->_Codigo == $this->Actual)) $menu .= " class=\"active\"";
            $menu .= "><a href=\"" . $this->_UrlAmigable->Amigable($Hijos->Url) . "\">" . $Hijos->Nombre . "</a></li>";
            $Hijos->Datos->Siguiente();
        }
        
        $menu .= "</ul>";
        $menu .= "</li>";
        
        unset($PaginaActual);

        return $menu;
    }
    
     public function DibujaBanderas()
    {
        $menu = "";
        
        $menu .= "<a href=\"" . $this->_UrlAmigable->Amigable(vbPaginaInicio . "?lang=es") . "\" title=\"Versión en Español\"><img alt=\"Español\" src=\"" . $this->_Parametros->Directorio . "/images/banderaEsp.jpg\"></a>&nbsp;";
        $menu .= "<a href=\"" . $this->_UrlAmigable->Amigable(vbPaginaInicio . "?lang=en") . "\" title=\"English version\"><img alt=\"English\" src=\"" . $this->_Parametros->Directorio . "/images/banderaIng.jpg\"></a>";

        return $menu;
    }
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************

    private function ObtenerPagina()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("pág_código"));

            $this->Nombre = $this->Datos->Valor("pág_nombre");
            if (($this->Datos->Valor("pág_padre") != null) && ($this->Datos->Valor("pág_padre") != "")) $this->Padre = intval($this->Datos->Valor("pág_padre"));
            if (($this->Datos->Valor("pág_orden") != null) && ($this->Datos->Valor("pág_orden") != "")) $this->Orden = intval($this->Datos->Valor("pág_orden"));
            $this->Url = $this->Datos->Valor("pág_url");
            $this->UrlBd = $this->Url;
            if (($this->Url == null) || ($this->Url == "")) $this->Url = "pagina.php";
            if (($this->Url != null) && ($this->Url != "")) $this->Url .= "?cod=" . $this->_Codigo;
            if (($this->Url != null) && ($this->Url != "")) $this->Url .= "&nom=" . $this->Nombre;
            if (strrpos($this->Url,".html")>0) $this->UrlHtml = $this->Url;
            
            $this->Extra = $this->Datos->Valor("pág_extra");
            $this->Visible = $this->Datos->Valor("pág_visible");
            if (($this->Datos->Valor("pág_title") != null) && ($this->Datos->Valor("pág_title") != "")) $this->Title = $this->Datos->Valor("pág_title");
            if (($this->Datos->Valor("pág_description") != null) && ($this->Datos->Valor("pág_description") != "")) $this->Description = $this->Datos->Valor("pág_description");
            if (($this->Datos->Valor("pág_keywords") != null) && ($this->Datos->Valor("pág_keywords") != "")) $this->Keywords = $this->Datos->Valor("pág_keywords");

        }
    }
}

?>