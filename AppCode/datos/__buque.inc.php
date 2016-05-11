<?php

// ##############################################################################
// # ARCHIVO:		buque.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpCifrado
// *****************************************************************************

// Público
	
class phpBuque{
    
    //Propiedades públicas  
    public $Nombre; 
    public $Descripcion;
    public $DescripcionCorta;
    public $FichaTecnica;
    public $Web;
    public $Construccion;
    public $Tonelaje;
    public $Tripulantes;
    public $Pasajeros;
    public $Cubiertas;
    public $Eslora;
    public $Manga;
    public $Balcon;
    public $Camarotes;
    public $CamarotesInt;
    public $CamarotesExt;
    public $Propina;

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
    private $_objSliderCubierta;
    private $_objCubierta;    

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
        $this->_objSliderCubierta = null;
        $this->_objCubierta = null;
        
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
       if (is_object($this->_objSliderCubierta)) unset($this->_objSliderCubierta);
       if (is_object($this->_objCubierta)) unset($this->_objCubierta);

    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->Nombre = null;
        $this->Descripcion = null;
        $this->DescripcionCorta = null;
        $this->FichaTecnica = null;
        $this->Web = null;        
        $this->Construccion = null;
        $this->Tonelaje = null;
        $this->Tripulantes = null;
        $this->Pasajeros = null;
        $this->Cubiertas = null;
        $this->Eslora = null;
        $this->Manga = null;
        $this->Balcon = null;
        $this->Camarotes = null;
        $this->CamarotesInt = null;
        $this->CamarotesExt = null;
        $this->Propina = null;
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
        if (is_object($this->_objSliderCubierta)) unset($this->_objSliderCubierta);
        $this->_objSliderCubierta = null;  
        if (is_object($this->_objCubierta)) unset($this->_objCubierta);
        $this->_objCubierta = null;       
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

    public function UrlAmigableCubiertas()
    {
        return $this->_objUrlAmigable->Amigable("buque.php?id=" . $this->getCodigo() . "&cod=" . vbPaginaCruceros . "&nav=1&nom=" . $this->Nombre);
    }
    public function UrlAmigableCamarotes()
    {
        return $this->_objUrlAmigable->Amigable("buque.php?id=" . $this->getCodigo() . "&cod=" . vbPaginaCruceros . "&nav=2&nom=" . $this->Nombre);
    }
    public function UrlAmigableOpiniones()
    {
        return $this->_objUrlAmigable->Amigable("buque.php?id=" . $this->getCodigo() . "&cod=" . vbPaginaCruceros . "&nav=3&nom=" . $this->Nombre);
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

    public function SliderCubierta()
    {
        if (($this->_objSliderCubierta == null) && ($this->getCodigo() != 0))
        {
            $this->_objSliderCubierta = new phpArchivo();
            $this->_objSliderCubierta->ConsultaBuques($this->getCodigo(),vbArchivoTipoImagen,vbGrupoImagenSliderCubierta);
        }
        return $this->_objSliderCubierta;    
    }

    public function Cubierta()
    {
        if (($this->_objCubierta == null) && ($this->getCodigo() != 0))
        {
            $this->_objCubierta = new phpCubierta();
            $this->_objCubierta->Consulta($this->getCodigo());
        }
        return $this->_objCubierta;    
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
        $strValor .= "Construccion:" . $this->Construccion . ";";
        $strValor .= "Tonelaje:" . $this->Tonelaje . ";";
        $strValor .= "Tripulantes:" . $this->Tripulantes . ";";
        $strValor .= "Pasajeros:" . $this->Pasajeros . ";";
        $strValor .= "Cubiertas:" . $this->Cubiertas . ";";
        $strValor .= "Eslora:" . $this->Eslora . ";";
        $strValor .= "Manga:" . $this->Manga . ";";
        $strValor .= "Balcon:" . $this->Balcon . ";";
        $strValor .= "Camarotes:" . $this->Camarotes . ";";
        $strValor .= "CamarotesInt:" . $this->CamarotesInt . ";";
        $strValor .= "CamarotesExt:" . $this->CamarotesExt . ";";
        $strValor .= "Propina:" . $this->Propina . ";";
        
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

    public function ConsultaBuscador($FormText)
    {
        $cadenaConsulta = "Select * FROM buques WHERE 1=1";
        
        if (!is_null($FormText) && ($FormText!="")) $cadenaConsulta .= " AND buq_nombre LIKE '%" . $FormText . "%'";

        $cadenaConsulta .= " ORDER BY buq_nombre";
       
        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }
    
    public function ConsultaValorados($intTop)
    {
        
        $cadenaConsulta = "Select * from(";
        $cadenaConsulta .= " Select *,(puntuacion/total) AS Media  FROM";
        $cadenaConsulta .= " (";
        $cadenaConsulta .= " Select  *,";
        $cadenaConsulta .= " (Select sum(ppr_puntuacion) FROM participacion INNER JOIN participacion_preguntas ON participacion_preguntas.ppr_participacion = participacion.par_codigo WHERE participacion.par_buque=buq_codigo) AS puntuacion";
        $cadenaConsulta .= " ,(Select count(*) FROM participacion INNER JOIN participacion_preguntas ON participacion_preguntas.ppr_participacion = participacion.par_codigo WHERE participacion.par_buque=buq_codigo) AS total  ";
        $cadenaConsulta .= " FROM buques";
        $cadenaConsulta .= " ) AS Buques";
        $cadenaConsulta .= " ) AS T1";
        $cadenaConsulta .= " WHERE Media>0";
        $cadenaConsulta .= " ORDER By Media DESC";
        $cadenaConsulta .= " LIMIT " . $intTop;
        
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

    public function DibujaFicha($nav, $objTraductor, $objUsuario)
    {
        $objSections = new phpSections();

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
              
              //$strClass="";
              //if ($nav==1) $strClass="active";
              //$html .= "<li role=\"presentation\" class=\"" . $strClass ."\"><a href=\"" . $this->UrlAmigableCubiertas() . "\">Cubiertas</a></li>";

              $strClass="";
              if ($nav==3) $strClass="active";
              $html .= "<li role=\"presentation\" class=\"" . $strClass ."\"><a href=\"" . $this->UrlAmigableOpiniones() . "\">Opiniones</a></li>";
              
              $strClass="";
              if ($nav==2) $strClass="active";
              $html .= "<li role=\"presentation\" class=\"" . $strClass ." enlaceExternoBuque\">";
              if (($this->Web!=null) & ($this->Web!="")){
                    $html .= "<a target=\"_blank\" href=\"http://" . $this->Web . "\">";
              }else{
                    $html .= "<a target=\"_blank\" href=\"http://" . $this->Empresa()->Web  . "\">";
              }
              $html .= "Toda la informaci&oacute;n del buque aqu&iacute;<i class=\"fa fa-eye\"></i></a></li>";


            $html .= "</ul></div>";

            $html .= "<div class=\"col-xs-12 col-sm-12 blog-content\">";
            
            switch ($nav) {
                case 0:
                    //$html .= "<h2>" . $this->Empresa()->Descripcion . "</h2>";
                    $html .= $this->Descripcion;
                    break;

                case 1:
                    $html .= "<div class=\"cubiertas\">";
                    if ($this->SliderCubierta()->Datos->NumeroElementos() > 0)
                    {
                        $this->SliderCubierta()->Lee();
                        $html .= "<img class='img-responsive img-blog' width='100%' alt='' src='" . $this->_objParametros->Directorio . "/subidas/buques/" . $this->getCodigo() . "/slider/". $this->SliderCubierta()->Nombre ."' />";
                    }

                    if ($this->Cubierta()->Datos->NumeroElementos() > 0)
                    {
                        while (!$this->Cubierta()->Datos->Eof())
                        {
                            $this->Cubierta()->Lee();   
                            $html .= "<div class=\"row\">";
                            $html .= "<div class=\"col-xs-12 col-sm-12 blog-content\">";
                            $html .= "<h2>". $this->Cubierta()->Planta . " - " . $this->Cubierta()->Nombre . "</h2>";
                            $html .= $this->Cubierta()->Descripcion;    
                            $html .= "</div>";    
                            $html .= "</div>";  
                            $this->Cubierta()->Datos->Siguiente();        
                            $this->Cubierta()->ReiniciaObjetos();        
                        }
                    }
                    $html .= "</div>";    
                    break;

                case 2:
                    //$html .= $this->PaginaCamarotes();
                    break;

                case 3:
                    //SectionOpinion
                    $objParticipacion = new phpParticipacion;
                    $objParticipacion->ConsultaBuque(0,$this->getCodigo()); 
                    $NumeroElementos = $objParticipacion->Datos->NumeroElementos();

                    if ($NumeroElementos > 0){
                        $html  .= "<h1 id=\"comments_title\">" . $NumeroElementos;
                        if ($NumeroElementos == 1){
                            $html  .= " Opini&oacute;n</h1>";
                        }else{
                            $html  .= " Opiniones</h1>";
                        }
                        while (!$objParticipacion->Datos->Eof())
                        {
                            $objParticipacion->Lee();  
                            $html .= $objParticipacion->DibujaOpinion(false);
                            $objParticipacion->Datos->Siguiente();        
                            $objParticipacion->ReiniciaObjetos();     
                        }     
                    }else{
                       $html .= "<h2>Aun no existen opiniones de este barco, sea el primero en opinar</h2>";
                    }
                    unset($objParticipacion);
                    break;                    
            }
            $html .= "</div>";

            if ($nav==0){                   
                $html .= "<div class=\"col-xs-12 col-sm-12 blog-content\">";
                    $html .= "<div class=\"buquefichatecnica\">";
                        if ((!is_null($this->FichaTecnica))&&($this->FichaTecnica!="")) {
                            $html .= $this->FichaTecnica;
                        }else{
                            $html .= $this->DibujaFichaTecnica();    
                        }
                    $html .= "</div>";
                $html .= "</div>";
            }

        $html .= "</div><!--/.row-->";

        $blnDibujaOpiniar = true;
        $objCookieUsuario = new phpCookie();
        $objCookieUsuario->Nombre = vbCookieUser;
        if ($objUsuario->Conectado()){
            $objUsuario->setCodigo($objCookieUsuario->Lee());
            $objParticipacion = new phpParticipacion;
            $objParticipacion->ConsultaUsuarioBuque($objUsuario->getCodigo(), $this->getCodigo()); 
            if ($objParticipacion->Datos->NumeroElementos()>0) $blnDibujaOpiniar = false;     
        }  
        if ($blnDibujaOpiniar) {
            $html  .= $objSections->SectionOpinion($objTraductor, $this->_objParametros, $this->getCodigo(), $objUsuario);
        }else{
            $html  .= "<div class=\"alert alert-info\" role=\"alert\">";
            $html  .= "<span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>";
            $html  .= "<span class=\"sr-only\">Error:</span> Ya ha opinado sobre este buque. Si desea emitir otra opini&oacute;n distinta elimine primero la opini&oacute;n dada con anterioridad. Para ello acceda al apartado de ";
            $html  .= "<span class=\"label label-info\"><i class=\"fa fa-comment\"></i>&nbsp;OPINIONES</span> de su perfil.";
            $html  .= "</div>";

        }   
        unset($objParticipacion);
        unset($objCookieUsuario);

        $html .= "</div><!--/.blog-item-->";

        $html .= "</div><!--/.col-md-8-->";

        unset($objSections);

        return $html;
    }

    public function DibujaFichaTecnica()
    {
        $html = "";

        $html .= "<div class=\"row pageSection\" data-pagesectionname=\"technicaldetails\">";
            $html .= "<div class=\"col-xs-12 col-sm-12 col-md-7 col-lg-7\">";
                $html .= "<div id=\"panelFichaTecnica\" class=\"panel-group box mt-0\">";

                    $html .= "<div id=\"panelFicha_1\" class=\"panel\">";

                        $html .= "<a class=\"visible panel-heading p-10 bg-grisPalido\" data-parent=\"#panelFichaTecnica\" data-toggle=\"collapse\" href=\"#fichaGeneral\">";
                            $html .= "<h4 class=\"gris margin0 pull-left\">General:</h4>";
                            $html .= "<span class=\"fa fa-angle-up angleClose gris fa-2x pull-right\"></span>";
                        $html .= "</a>";
                        $html .= "<div id=\"fichaGeneral\" class=\"fichaGeneral panel-collapse collapse in mt-10\">";
                            $html .= "<ul class=\"ul-table ul-condensed visible mb-20 puntuaciones\">";
                                
                                $html .= $this->DibujaElementoFichaTecnica("Año de Construcción", $this->Construccion);
                                $html .= $this->DibujaElementoFichaTecnica("Capacidad de Pasajeros", $this->Pasajeros);
                                $html .= $this->DibujaElementoFichaTecnica("Nº. de Tripulantes", $this->Tripulantes);                                
                                $html .= $this->DibujaElementoFichaTecnica("Nº. de Cubiertas", $this->Cubiertas);
                                //$html .= $this->DibujaElementoFichaTecnica("Nº Camarotes", $this->Camarotes);
                                $html .= $this->DibujaElementoFichaTecnica("Nº. de Camarotes Interiores", $this->CamarotesInt);
                                $html .= $this->DibujaElementoFichaTecnica("Nº. de Camarotes Exteriores", $this->CamarotesExt);
                                $html .= $this->DibujaElementoFichaTecnica("Nº. de Camarotes con Balcón y Suite", $this->Balcon);
                                $html .= $this->DibujaElementoFichaTecnica("Eslora (Largo)", $this->Eslora);
                                $html .= $this->DibujaElementoFichaTecnica("Manga (Ancho)", $this->Manga);
                                $html .= $this->DibujaElementoFichaTecnica("Tonelaje", $this->Tonelaje);

                            $html .= "</ul>";
                        $html .= "</div>";       
                    $html .= "</div>";  

                $html .= "</div>";
            $html .= "</div>";

            $html .= "<div class=\"col-xs-12 col-sm-12 col-md-5 col-lg-5 mt-sm-20\">";
                $html .= "<!-- Normas de propina -->";
                $html .= "<div class=\"notasPropina mb-20\">";
                    $html .= "<div class=\"rotuloSimple pb-0 mb-10\">";
                        $html .= "<h4 class=\"gris margin0\">Normas de propina:</h4>";
                    $html .= "</div>";
                    $html .= "<p class=\"txtMedio\">" . $this->Propina . "</p>";
                $html .= "</div>";
            $html .= "</div>";

        $html .= "</div>";
        
        return $html;
    }    
    
    public function DibujaElementoFichaTecnica($strNombre, $strValor)
    {
        $html = "";
        
        if (is_null($strValor) || ($strValor=="")) $strValor = "-";
        
        $html .= "<li class=\"col-xxs-12 col-xs-12 col-sm-6 col-md-6\">";
            $html .= "<div class=\"row row-narrow\">";
                $html .= "<div class=\"col-xs-8 col-md-7 col-lg-7 contEllipsis\"><span class=\"txtMedio ellipsis\">" . utf8_encode($strNombre) . "</span></div>";
                $html .= "<div class=\"col-xs-4 col-md-5 col-lg-5 text-right-sm text-right-xs\"><span class=\"subtituloDestacado mr-md-20 mr-lg-20\">" . utf8_encode($strValor) . "</span></div>";
            $html .= "</div>";
        $html .= "</li>";

        return $html;

    }    
    public function DibujaPanelFicha()
    {
        $html = "";

        $html .= $this->Nombre;

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

    public function PaginaCamarotes()
    {
        $pageContent = new phpHtmlReader();
        $pageContent->ruta = $this->_objParametros->DirectorioRaiz . "/subidas/buques/";
        $pageContent->page = $this->getCodigo() . "/camarotes.html";
        
        return $pageContent->Html();
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
            $this->FichaTecnica = $this->Datos->Valor("buq_ficha_tecnica");  
            $this->DescripcionCorta = $this->Datos->Valor("buq_descripcion_corta");  
            if ((!is_null($this->DescripcionCorta))&&($this->DescripcionCorta=="")) {
                $this->DescripcionCorta = $this->recortar_texto($this->DescripcionCorta, 150, '...');
            }
            $this->Web = $this->Datos->Valor("buq_web");              
            $this->Construccion = $this->Datos->Valor("buq_construccion"); 
            $this->Tonelaje = $this->Datos->Valor("buq_tonelaje"); 
            $this->Tripulantes = $this->Datos->Valor("buq_tripulantes"); 
            $this->Pasajeros = $this->Datos->Valor("buq_pasajeros"); 
            $this->Eslora = $this->Datos->Valor("buq_eslora"); 
            $this->Manga = $this->Datos->Valor("buq_manga"); 
            //$this->Camarotes = $this->Datos->Valor("buq_camarotes"); 
            $this->CamarotesInt = $this->Datos->Valor("buq_camarotes_int"); 
            $this->CamarotesExt = $this->Datos->Valor("buq_camarotes_ext"); 
            $this->Balcon = $this->Datos->Valor("buq_camarotes_balcon"); 
            $this->Cubiertas = $this->Datos->Valor("buq_cubiertas"); 
            $this->Propina = $this->Datos->Valor("buq_propina");    
            if ((is_null($this->Propina))||($this->Propina=="")) $this->Propina = "No hay informaci&oacute;n disponible";
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