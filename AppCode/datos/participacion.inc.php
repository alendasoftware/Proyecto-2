<?php

// ##############################################################################
// # ARCHIVO:		participacion.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpParticipacion
// *****************************************************************************

// Público
	
class phpParticipacion{
    
    //Propiedades públicas  
    public $Opinion; 
    
    //Propiedades privadas  
    private $_Codigo;
    private $_Usuario;
    private $_Buque;
    private $_Fecha;
    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_objServidor;
    private $_objBasedato;
    private $_objParametros;
    private $_objUrlAmigable;
    private $_objUsuario;
    private $_objBuque;
    private $_objParticipacionPreguntas;
    private $_objParticipacionArchivos;

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
       $this->_objUsuario = null;
       $this->_objBuque = null;
       $this->_objParticipacionPreguntas = null;
       $this->_objParticipacionArchivos = null;

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
       
       if (is_object($this->_objUsuario)) unset($this->_objUsuario);
       if (is_object($this->_objBuque)) unset($this->_objBuque);
       if (is_object($this->_objParticipacionPreguntas)) unset($this->_objParticipacionPreguntas);
       if (is_object($this->_objParticipacionArchivos)) unset($this->_objParticipacionArchivos);
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	    $this->Opinion = null;
        
        $this->_Codigo = 0;
        $this->_Usuario = 0;
        $this->_Buque = 0;
        $this->_Fecha = new DateTime();

        $this->_Completo = false;
        $this->_CadenaConsulta = null;
    }	

    public function ReiniciaObjetos()
    {
        //Destruir Objetos  
        if (is_object($this->_objUsuario)) unset($this->_objUsuario);
        if (is_object($this->_objBuque)) unset($this->_objBuque);
        if (is_object($this->_objParticipacionPreguntas)) unset($this->_objParticipacionPreguntas);
        if (is_object($this->_objParticipacionArchivos)) unset($this->_objParticipacionArchivos);
        $this->_objUsuario = null;
        $this->_objBuque = null;
        $this->_objParticipacionPreguntas = null;
        $this->_objParticipacionArchivos = null;
    }

    public function ParticipacionPreguntas()
    {
        if (($this->_objParticipacionPreguntas == null) && ($this->getCodigo() != 0))
        {
            $this->_objParticipacionPreguntas = new phpParticipacionPreguntas();
            $this->_objParticipacionPreguntas->Consulta($this->getCodigo());
        }
        return $this->_objParticipacionPreguntas;        
    }


    public function ParticipacionArchivos()
    {
        if (($this->_objParticipacionArchivos == null) && ($this->getCodigo() != 0))
        {
            $this->_objParticipacionArchivos = new phpParticipacionArchivos();
            $this->_objParticipacionArchivos->Consulta($this->getCodigo());
        }
        return $this->_objParticipacionArchivos;        
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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM participacion WHERE par_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerParticipacion();
        }
        else
        {
            $this->ObtenerParticipacion();
        }
    }

    public function Usuario()
    {
        
        if (($this->_objUsuario == null) && ($this->getCodigo() != 0) && ($this->_Usuario != 0))
        {
            $this->_objUsuario = new phpUsuario();
            $this->_objUsuario->setCodigo($this->_Usuario);          
        }
        return $this->_objUsuario;
        
    }

    public function setUsuario($value)
    {
        if ($value > 0) $this->_Usuario = $value;
    }
    
    public function Buque()
    {
        if (($this->_objBuque == null) && ($this->getCodigo() != 0) && ($this->_Buque != 0))
        {
            $this->_objBuque = new phpBuque();
            $this->_objBuque->setCodigo($this->_Buque);        
        }
        return $this->_objBuque;
        
    }

    public function setBuque($value)
    {
        if ($value > 0) $this->_Buque = $value;
    }

    public function Servidor()
    {
        return $this->_objServidor;
    }

    public function Fecha()
    {
        return $this->_Fecha;
    }

    public function Media()
    {
        $intValor = 0;

        if ($this->Datos->NumeroElementos() > 0){
            while (!$this->Datos->Eof())
            {
                $this->Lee();  
                $intValor += $this->ParticipacionPreguntas()->Media();
                $this->Datos->Siguiente();        
                $this->ReiniciaObjetos();     
            }
            $intValor = round($intValor / $this->Datos->NumeroElementos(),1);            
        }

        return $intValor;
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		$strValor .= "Codigo:" . $this->_Codigo . ";";
        $strValor .= "Usuario:" . $this->_Usuario . ";";
    	$strValor .= "Buque:" . $this->_Buque . ";";
        $strValor .= "Opinion:" . $this->Opinion . ";";
        $strValor .= "Fecha:" . $this->Fecha()->format('Y-m-d H:i:s') . ";";

    	return $strValor;

    } 
	
    public function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public function Consulta($intTop)
    {
        $cadenaConsulta = "SELECT"; 
        $cadenaConsulta .= " * FROM participacion WHERE 1=1";
        $cadenaConsulta .= " ORDER BY par_fecha DESC, par_codigo DESC";
        if ($intTop>0) $cadenaConsulta .= " LIMIT ". $intTop;
        
        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function ConsultaBuque($intTop, $intbuque)
    {
        $cadenaConsulta = "SELECT"; 
        $cadenaConsulta .= " * FROM participacion WHERE 1=1";
        $cadenaConsulta .= " AND par_buque=" . $intbuque;
        $cadenaConsulta .= " ORDER BY par_fecha DESC";
        if ($intTop>0) $cadenaConsulta .= " LIMIT ". $intTop;
        
        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function ConsultaUsuario($intTop, $intUsuario)
    {
        $cadenaConsulta = "Select"; 
        $cadenaConsulta .= " * FROM participacion WHERE 1=1";
        $cadenaConsulta .= " AND par_usuario=" . $intUsuario;
        $cadenaConsulta .= " ORDER BY par_fecha DESC";
        if ($intTop>0) $cadenaConsulta .= " LIMIT ". $intTop;
        
        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }
    public function ConsultaUsuarioBuque($intUsuario, $intBuque)
    {
        $cadenaConsulta = "Select"; 
        $cadenaConsulta .= " * FROM participacion WHERE 1=1";
        $cadenaConsulta .= " AND par_usuario=" . $intUsuario;
        $cadenaConsulta .= " AND par_buque=" . $intBuque;
        $cadenaConsulta .= " ORDER BY par_fecha DESC";
        
        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }
   
    public Function Agrega()
    {
        
        $intValor  = 0;
        
        if (($this->_Usuario==null) || ($this->_Usuario == "")) $this->_objServidor->Error = "No existe Usuario";
        if (($this->_objServidor->Error == "") && (($this->Opinion==null) || ($this->Opinion == ""))) $this->_objServidor->Error =  "No ha introducido una opinión";
      
        if ($this->_objServidor->Error== "")
        {
            $strConsulta;
            $strConsulta = "INSERT INTO participacion (";

            $strConsulta .= " par_usuario";
            $strConsulta .= ", par_buque";
            $strConsulta .= ", par_opinion";
            $strConsulta .= ", par_fecha";
            
            $strConsulta .= ") VALUES (";

            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->_Usuario, 0);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->_Buque, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Opinion, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->_Fecha->format('Y-m-d H:i:s'), 1);

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
        
        if ($this->getCodigo()==0) $this->_objServidor->Error = "No existe participación"; 
        if (($this->_objServidor->Error == "") && (($this->_Usuario==null) || ($this->_Usuario == ""))) $this->_objServidor->Error = "No existe Usuario";
        if (($this->_objServidor->Error == "") && (($this->Opinion==null) || ($this->Opinion == ""))) $this->_objServidor->Error =  "No ha introducido una opinión";
        
        if ($this->_objServidor->Error=="") {
            
            $strConsulta;
            $strConsulta = "UPDATE participacion SET ";
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("par_usuario", $this->_Usuario, 0);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("par_buque", $this->_Buque, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("par_opinion", $this->Poblacion, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("par_fecha", $this->_Fecha->format('Y-m-d H:i:s'), 1);
            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND par_codigo=" . $this->getCodigo();

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
            
            //Se borra participacion_preguntas
            $strConsulta = "";
            $strConsulta .= "DELETE FROM participacion_preguntas";
            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND ppr_participacion=" . $this->getCodigo();
            $blnValor = $this->_objBasedato->ActualizaDatos($strConsulta);

            //Se recorren los archivos y se eliminan
            if ($this->ParticipacionArchivos()->Datos->NumeroElementos() > 0){
                while (!$this->ParticipacionArchivos()->Datos->Eof())
                {
                    $this->ParticipacionArchivos()->Lee();  
                    $this->ParticipacionArchivos()->Archivo()->Elimina();
                    $this->ParticipacionArchivos()->Datos->Siguiente();        
                    $this->ParticipacionArchivos()->ReiniciaObjetos();     
                }
            }

            //Se recorren la participacion
            $strConsulta = "";
            $strConsulta .= "DELETE FROM participacion";
            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND par_codigo=" . $this->getCodigo();

            $blnValor = $this->_objBasedato->ActualizaDatos($strConsulta);
            if (!$blnValor) $this->_objServidor->Error = "Error: Operación no realizada, se han producido errores intentelo pasados unos minutos.";
        }
    
        return $blnValor;
    }

     public Function DibujaOpinion($blnElimina)
    { 
        $strHtml = "";
        $strHtml .= "<div class=\"col-xs-12 col-sm-12 blog-content\">";
            $strHtml .= "<div class=\"tabOpinionesBarco\">";
                $strHtml .= "<div class=\"row\">";
                    $strHtml .= "<div class=\"col-md-12 col-xs-12\">";
                        $strHtml .= "<div class=\"row\"><!--row elementoListaOpinionUsuario-->";
                            $strHtml .= "<div class=\"col-md-12\">";
                                $strHtml .= "<div class=\"elementoListaOpinionUsuario\">";
                                    $strHtml .= "<div class=\"col-md-2 col-xs-12 text-center capaValoracionesResumen\">";
                                    if (($this->Usuario()->Avatar!=null)&&($this->Usuario()->Avatar!="")) {
                                        $strHtml .= "<img class=\"img-responsive imagenIconoUser\" title=\"" . $this->Usuario()->AvatarNombre . " - " . $this->_Fecha . "\" alt=\"" . $this->Usuario()->AvatarNombre . " - " . $this->_Fecha . "\" src=\"" . $this->_objParametros->Directorio . "/subidas/usuarios/" . $this->Usuario()->Avatar . "\">";                                         
                                    }else{
                                        $strHtml .= "<img class=\"img-responsive img-circle\" alt=\"" . $this->Usuario()->AvatarNombre . "\" src=\"". $this->_objParametros->Directorio . "/images/testimonials1.png\">";
                                    }
                                    $strHtml .= "</div>";
                                    $strHtml .= "<div class=\"col-md-3 col-xs-12 capaValoracionesResumen\">";
                                        $strHtml .= "<h3>" . $this->Usuario()->AvatarNombre . "</h3>";
                                        $strHtml .= "<h4><a title=\"" . $this->Buque()->Nombre . "\" href=\"" . $this->Buque()->UrlAmigable() . "\">" . $this->Buque()->Nombre . "</a></h4>"; 
                                        $strHtml .= "<h5>" . $this->_Fecha . "</h5>";
                                        $strHtml .= "<i>";
                                        $strHtml .= "\"" . $this->Opinion . "\"";
                                        $strHtml .= "</i>";
                                        if ($blnElimina){
                                            $objCookieUsuario = new phpCookie();
                                            $objCookieUsuario->Nombre = vbCookieUser;
                                            $objUsuario = new phpUsuario();
                                            if ($objUsuario->Conectado()){
                                                $objUsuario->setCodigo($objCookieUsuario->Lee());
                                                if ($this->Usuario()->getCodigo()==$objUsuario->getCodigo()){
                                                    $strHtml .= "<div><br/>";
                                                    $strHtml .= "<form id=\"participacion-eliminar-form\" class=\"contact-form\" enctype=\"multipart/form-data\" action=\"" . $this->_objParametros->Directorio . "/controlUsuario.php?uS=" . session_id() . "&uA=eliminaParticipacion\" method=\"post\" name=\"participacion-eliminar-form\">";
                                                    $strHtml .= "<input name=\"par_codigo\" type=\"text\" style=\"display:none\" value=\"" . $this->getCodigo() . "\"/>";
                                                    $strHtml .= "<button class=\"btn btn-danger\" type=\"submmit\"><i class=\"fa fa-trash-o fa-lg\"></i> Eliminar</button>";
                                                    $strHtml .= "</form>";
                                                    $strHtml .= "</div>";
                                                }    
                                            } 
                                            unset($objUsuario);     
                                            unset($objCookieUsuario);    
                                        }
                                    $strHtml .= "</div>";
                                    $strHtml .= "<div class=\"col-md-7 col-xs-12 capaValoracionesResumen\">";
                                        
                                        if ($this->ParticipacionPreguntas()->Datos->NumeroElementos() > 0){
                                        while (!$this->ParticipacionPreguntas()->Datos->Eof())
                                        {
                                            $this->ParticipacionPreguntas()->Lee(); 
                                            $intPuntuacion = $this->ParticipacionPreguntas()->Puntuacion;
                                            
                                            $strHtml .= "<!--pregunta-->";
                                            $strHtml .= "<div class=\"row\">";
                                                $strHtml .= "<div class=\"col-md-6 col-xs-6\">";
                                                    $strHtml .= $this->ParticipacionPreguntas()->Pregunta()->Nombre;
                                                $strHtml .= "</div>";
                                                $strHtml .= "<div class=\"col-md-6 col-xs-6\">";                                                    
                                                $j=1;
                                                for ($i=1;$i<=$intPuntuacion;$i++){
                                                    $strHtml .= "<i class=\"fa fa-2x fa-anchor marcado\">&nbsp;</i>";
                                                    $j++;
                                                }
                                              
                                                for ($i=$j;$j<=5;$j++){
                                                    $strHtml .= "<i class=\"fa fa-2x fa-anchor\">&nbsp;</i>";                                                
                                                }                                                   
                                                $strHtml .= "</div>";
                                            $strHtml .= "</div>";

                                            $this->ParticipacionPreguntas()->Datos->Siguiente();        
                                            $this->ParticipacionPreguntas()->ReiniciaObjetos();     
                                        }
                                        
                                    }

                                        $strHtml .= "<div class=\"row\">";
                                            $strHtml .= "<div class=\"col-md-12\">";
                                                $strHtml .= "<ul class=\"sidebar-gallery\">";
                                                    $strHtml .= "<!--imagen-->";
                                                    if ($this->ParticipacionArchivos()->Datos->NumeroElementos()>0){
                                                        while (!$this->ParticipacionArchivos()->Datos->Eof())
                                                        {
                                                            $this->ParticipacionArchivos()->Lee(); 
                                                            $strHtml .= "<li><a class=\"preview\" href=\"" . $this->_objParametros->UrlSubidas . "/usuarios/" . $this->ParticipacionArchivos()->Archivo()->ArchivoGrande() . "\" rel=\"prettyPhoto[pp_gal]\"><img src=\"" . $this->_objParametros->UrlSubidas . "/usuarios/" . $this->ParticipacionArchivos()->Archivo()->ArchivoNormal() . "\" alt=\"\" width=\"107px\" height=\"63px\" data-pin-nopin=\"true\"></a></li>";                
                                                            $this->ParticipacionArchivos()->Datos->Siguiente();        
                                                            $this->ParticipacionArchivos()->ReiniciaObjetos();     
                                                        }
                                                    }    
                                                    
                                                $strHtml .= "</ul>";
                                            $strHtml .= "</div>";
                                        $strHtml .= "</div>";
                                    $strHtml .= "</div>";
                                $strHtml .= "</div> ";
                            $strHtml .= "</div>";
                        $strHtml .= "</div><!--row elementoListaOpinionUsuario-->";

                    $strHtml .= "</div>";
                $strHtml .= "</div>";
            $strHtml .= "</div>";
        $strHtml .= "</div>";    

        return $strHtml;
    }         
            
    public Function DibujaOpinionDerecha()
    { 
        $strHtml = "";
        $strHtml .= "<div class=\"media comment_section\">";
            $strHtml .= "<div class=\"pull-left post_comments\">";
            if (($this->Usuario()->Avatar!=null)&&($this->Usuario()->Avatar!="")) {
                $strHtml .= "<img class=\"img-circle\" alt=\"" . $this->Usuario()->AvatarNombre . "\" src=\"" . $this->_objParametros->Directorio . "/subidas/usuarios/" . $this->Usuario()->Avatar . "\">";                                
            }else{
                $strHtml .= "<img class=\"img-circle\" alt=\"" . $this->Usuario()->AvatarNombre . "\" src=\"". $this->_objParametros->Directorio . "/images/testimonials1.png\">";
            }
            $strHtml .= "</div>";
            $strHtml .= "<div class=\"media-body post_reply_comments\">";
                $strHtml .= "<h3>" . $this->Usuario()->AvatarNombre . "</h3>";
                $strHtml .= "<h4>" . $this->_Fecha ."</h4>";
                
                /*if ($this->ParticipacionArchivos()->Datos->NumeroElementos()>0){
                    $this->ParticipacionArchivos()->Lee();
                    $strHtml .= $this->ParticipacionArchivos()->Archivo()->DibujaImagenPreview("usuarios/");                   
                }*/   
                
                $strHtml .= "<p>" . $this->Opinion . "</p>";                
            $strHtml .= "</div>";
        $strHtml .= "</div>";

        return $strHtml;
    }

    public Function DibujaOpinionHome()
    {   
        $strHtml = "";

        $strHtml .= "<div class=\"media testimonial-inner\">";
        $strHtml .= "<div class=\"pull-left\">";
        if (($this->Usuario()->Avatar!=null)&&($this->Usuario()->Avatar!="")) {
            $strHtml .= "<img width=\"75px\" class=\"img-responsive img-circle\" alt=\"" . $this->Usuario()->AvatarNombre . "\" src=\"" . $this->_objParametros->Directorio . "/subidas/usuarios/" . $this->Usuario()->Avatar . "\">";                                
        }else{
            $strHtml .= "<img width=\"75px\" class=\"img-responsive img-circle\" alt=\"" . $this->Usuario()->AvatarNombre . "\" src=\"". $this->_objParametros->Directorio . "/images/testimonials1.png\">";
        }
        $strHtml .= "</div>";

        $strHtml .= "<div class=\"media-body\">";
            $strHtml .= "<div class=\"row\">";
                $strHtml .= "<div class=\"col-md-12 col-xs-12\">";
                    $strHtml .= "<strong>" . $this->Usuario()->AvatarNombre . "</strong>";
                    $strHtml .= "<em>" . $this->_Fecha ."</em>";
                    $strHtml .= "</div>";
                    $strHtml .= "</div>";
                    $strHtml .= "<div class=\"row\">";
                    $strHtml .= "<div class=\"col-md-9 col-xs-12\">";
                    $strHtml .= "<a title=\"" . $this->Buque()->Nombre . "\" href=\"" . $this->Buque()->UrlAmigable() . "\">" . $this->Buque()->Nombre . "</a>";
                    $strHtml .= "<p>\"" . $this->Opinion . "\"</p>";
                    $strHtml .= "<span> </span>";
                $strHtml .= "</div>";
            $strHtml .= "</div>";
        $strHtml .= "</div>";
        
        $strHtml .= "</div>";

        return $strHtml;
    }

    public Function DibujaPuntuacion($blnCorta)
    {
        $strHtml = "";

        $intMedia = $this->Media();
        $intMediaEntero = round($intMedia,0);

        $strClaseMedia = "verde";
        if ($intMediaEntero<=3) $strClaseMedia = "amarillo";
        
        if (!$this->Datos->NumeroElementos()>0) $intMedia = "-";                         

        $strHtml .= "<div class=\"valoracionBarco " . $strClaseMedia . "\">";
           $strHtml .= "<div class=\"numeroValoracionBarco\">" . $intMedia . "</div>";
           
           if (!$blnCorta){
               $strHtml .= "<div class=\"puntosValoracionBarco\">";
                   
                   $j=1;
                   for ($i=1;$i<=$intMediaEntero;$i++){
                        $strHtml .= "<i class=\"fa fa-circle\"></i>";
                        $j++;
                   }
                  
                   for ($i=$j;$j<=5;$j++){
                        $strHtml .= "<i class=\"fa fa-circle noMarcada\"></i>";                                                
                   }

               $strHtml .= "</div>";
               $NumeroElementos = $this->Datos->NumeroElementos(); 
           
               if ($NumeroElementos>0){
                    if ($NumeroElementos==1){
                        $strHtml .= "<div class=\"opinionesValoracionBarco\">Basado en " . $NumeroElementos ." opini&oacute;n</div>";
                    }else{
                        $strHtml .= "<div class=\"opinionesValoracionBarco\">Basado en " . $NumeroElementos ." opiniones</div>";
                    }

               }else{
                    $strHtml .= "<div class=\"opinionesValoracionBarco\">A&uacute;n no se han registrado opiniones</div>";
               }
            } 
        $strHtml .= "</div>";
       
        return $strHtml;
    }
    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function ObtenerParticipacion()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("par_codigo"));    
            $this->Opinion = $this->Datos->Valor("par_opinion");
            $this->_Usuario = intval($this->Datos->Valor("par_usuario"));   
            $this->_Buque = intval($this->Datos->Valor("par_buque"));   
            $this->_Fecha = $this->Datos->Valor("par_fecha");   

        }
    }
    
}

?>