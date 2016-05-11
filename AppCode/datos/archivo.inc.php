<?php

// ##############################################################################
// # ARCHIVO:       archivov2.inc.php - Versión 1.0
// # DESCRIPCION:   
// ##############################################################################

// *****************************************************************************
// * Clase phpArchivoV2
// *****************************************************************************

// Público
class phpArchivo{
    
    //Propiedades públicas  
    public $Nombre; 
    public $Observaciones;

    //Propiedades privadas  
    private $_Codigo;
    private $_Tipo;
    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_objServidor;
    private $_objBasedato;
    private $_objParametros;
    private $_objTipo;

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
       $this->Datos = new phpDatos(); 
       $this->_objTipo = null;
     
       // Inicia propiedades        
        
       $this->Inicia();
    }   
    
    function __destruct() {
        
       //Hay que destruir los objetos               
       unset($this->_objServidor); 
       unset($this->_objBasedato);
       unset($this->_objParametros);
       unset($this->Datos);
       if (is_object($this->_objTipo)) unset($this->_objTipo);
       
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
        
        $this->Nombre = null;
        $this->Observaciones = null;

        $this->_Codigo = 0;
        $this->_Tipo = null;
    
        $this->_Completo = false;
        $this->_CadenaConsulta = null;
    }   

    public function ReiniciaObjetos()
    {
        //Destruir Objetos    
        if (is_object($this->_objTipo)) unset($this->_objTipo);
        $this->_objTipo = null;  
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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM archivos WHERE arc_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerArchivo();
        }
        else
        {
            $this->ObtenerArchivo();
        }
    }

    public function Servidor()
    {
        return $this->_objServidor;
    }
    
    public function setTipo($value)
    {
        if ($value > 0) $this->_Tipo = $value;
    }

    public function Tipo()
    {
        if (($this->_objTipo == null) && (getCodigo() != 0) && ($this->_Tipo != 0))
        {
            $this->_objTipo = new phpArchivoTipo();
            $this->_objTipo->setCodigo($this->_Tipo);
        }
        return $this->_objTipo;
        
    }

    public function ArchivoGrande()
    {
        /*if (!is_null($this->Nombre) && ($this->Nombre!=""))
        {
            return str_replace($this->Nombre, ".jpg", "_g.jpg");
        }else{
            return "";
        }   */     
        return $this->Nombre;
    }

    public function ArchivoNormal()
    {
        if (!is_null($this->Nombre) && ($this->Nombre!=""))
        {
            return str_replace(".jpg", "_p.jpg",$this->Nombre);
        }else{
            return "";
        }        
    }
    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
        
        $strValor = "";
        $strValor .= "Codigo:" . $this->_Codigo . ";";
        $strValor .= "Nombre:" . $this->Nombre . ";";
        $strValor .= "Observaciones:" . $this->Observaciones . ";";

        return $strValor;

    } 
    
    public function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public function Consulta()
    {
        $cadenaConsulta = "Select * FROM Archivos WHERE 1=1";
        
        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function ConsultaEmpresas($intEmpresa, $intTipo, $strGrupo)
    {
        $cadenaConsulta = "SELECT archivos.* FROM archivos INNER JOIN empresas_archivos ON archivos.arc_codigo = empresas_archivos.ema_archivo";
        $cadenaConsulta .= " WHERE 1=1";
        $cadenaConsulta .= " AND empresas_archivos.ema_empresa = " . $intEmpresa;
        $cadenaConsulta .= " AND archivos.arc_tipo = " . $intTipo;
        if (!is_null($strGrupo)&&($strGrupo!="")) $cadenaConsulta .= " AND archivos.arc_grupo = '" . $strGrupo . "'";
        $cadenaConsulta .= " ORDER BY ema_orden";

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function ConsultaBuques($intBuque, $intTipo, $strGrupo)
    {
        $cadenaConsulta = "SELECT archivos.* FROM archivos INNER JOIN buques_archivos ON archivos.arc_codigo = buques_archivos.bua_archivo";
        $cadenaConsulta .= " WHERE 1=1";
        $cadenaConsulta .= " AND buques_archivos.bua_buque = " . $intBuque;
        $cadenaConsulta .= " AND archivos.arc_tipo = " . $intTipo;
        if (!is_null($strGrupo)&&($strGrupo!="")) $cadenaConsulta .= " AND archivos.arc_grupo = '" . $strGrupo . "'";
        $cadenaConsulta .= " ORDER BY bua_orden";

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function ConsultaCamarotes($intCamarote, $intTipo, $strGrupo)
    {
        $cadenaConsulta = "SELECT archivos.* FROM archivos INNER JOIN camarotes_archivos ON archivos.arc_codigo = camarotes_archivos.caa_archivo";
        $cadenaConsulta .= " WHERE 1=1";
        $cadenaConsulta .= " AND camarotes_archivos.caa_camarote = " . $intCamarote;
        $cadenaConsulta .= " AND archivos.arc_tipo = " . $intTipo;
        if (!is_null($strGrupo)&&($strGrupo!="")) $cadenaConsulta .= " AND archivos.arc_grupo = '" . $strGrupo . "'";
        $cadenaConsulta .= " ORDER BY caa_orden";


        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function ConsultaParticipacion($intParticipacion, $intTipo, $strGrupo)
    {
        $cadenaConsulta = "SELECT archivos.* FROM archivos INNER JOIN participacion_archivos ON archivos.arc_codigo = participacion_archivos.pra_archivo";
        $cadenaConsulta .= " WHERE 1=1";
        if (!is_null($strGrupo)&&($strGrupo!="")) $cadenaConsulta .= " AND participacion_archivos.pra_participacion = " . $intParticipacion;
        $cadenaConsulta .= " AND archivos.arc_tipo = " . $intTipo;
        if (!is_null($strGrupo)&&($strGrupo!="")) $cadenaConsulta .= " AND archivos.arc_grupo = '" . $strGrupo . "'";
       
        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function DibujaAbreGaleria($strEtiqueta)
    {
        $archivo = "";

        $archivo .= "<div class=\"widget archieve\">";
        $archivo .= "<h3><i class=\"fa fa-2x fa-file-text-o\"></i>" . $strEtiqueta . "</h3>";
        $archivo .= "<div class=\"row\">";
        $archivo .= "<div class=\"col-sm-12\">";
        $archivo .= "<ul class=\"blog_archieve\">";

        return $archivo;
    }

    public function DibujaCierraGaleria()
    {
        $archivo = "";
        
        $archivo .= "</ul>";
        $archivo .= "</div>";
        $archivo .= "</div>";
        $archivo .= "</div>";
        $archivo .= "<!--/.archieve-->";
        
        return $archivo;
    }

    public function DibujaGaleria($strRuta)
    {
        $archivo = "";

        $archivo .= "<li><a target=\"_blank\" href=\"" . $this->_objParametros->UrlSubidas . "/" . $strRuta . $this->Nombre . "\"><i class=\"fa fa-angle-double-right\"></i> " . $this->Nombre . "</a></li>";

        return $archivo;
    }

    public function DibujaAbreImagen($strEtiqueta)
    {
        $archivo = "";

        $archivo .= "<div class=\"widget blog_gallery\">";
        $archivo .= "<h3><i class=\"fa fa-2x fa-picture-o\"></i>" . $strEtiqueta . "</h3>";
        $archivo .= "<ul class=\"sidebar-gallery\">";

        return $archivo;
    }

    public function DibujaCierraImagen()
    {
        $archivo = "";

        $archivo .= "</ul>";
        $archivo .= "</div><!--/.blog_gallery-->";

        return $archivo;
    }

    public function DibujaImagen($strRuta)
    {
        $archivo = "";

        $archivo .= "<li><a class=\"preview\" href=\"" . $this->_objParametros->UrlSubidas .  "/" . $strRuta . $this->ArchivoGrande() . "\" rel=\"prettyPhoto[pp_gal]\"><img src=\"" . $this->_objParametros->UrlSubidas .  "/" . $strRuta . $this->ArchivoNormal() . "\" alt=\"" . $this->Observaciones . "\" width=\"100px\" height=\"63px\"/></a></li>";

        return $archivo;
    }

    public function DibujaImagenPreview($strRuta)
    {
        $archivo = "";

        $archivo .= "<a class=\"preview\" href=\"" . $this->_objParametros->UrlSubidas .  "/" . $strRuta . $this->ArchivoGrande() . "\" rel=\"prettyPhoto[pp_gal]\"><img src=\"" . $this->_objParametros->UrlSubidas .  "/" . $strRuta . $this->ArchivoNormal() . "\" alt=\"" . $this->Observaciones . "\" width=\"100px\" height=\"63px\"/></a>";

        return $archivo;
    }

    public Function Agrega()
    {
        
        $intValor  = 0;
        
        if (($this->Nombre==null) || ($this->Nombre == "")) $this->_objServidor->Error = "No ha introducido el nombre del archivo";
        if (($this->_objServidor->Error == "") && (($this->_Tipo==null) || ($this->_Tipo == ""))) $this->_objServidor->Error =  "No ha introducido el tipo del archivo";

        if ($this->_objServidor->Error== "")
        {
            $strConsulta;
            $strConsulta = "INSERT INTO archivos (";

            $strConsulta .= " arc_nombre";
            $strConsulta .= ", arc_grupo";
            $strConsulta .= ", arc_tipo";
            
            $strConsulta .= ") VALUES (";

            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Nombre, 0);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Grupo, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaNumero($this->_Tipo, 1);
            
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

    public Function Elimina()
    {   
        $blnValor = false;
        
        if ($this->getCodigo()==0) $this->_objServidor->Error = "No se encuentra el registro"; 
        
        if ($this->_objServidor->Error=="") {
            
            //eliminamos archivo físico

            //eliminamos en participacion_archivos
            $strConsulta = "";
            $strConsulta .= "DELETE FROM participacion_archivos";
            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND pra_archivo=" . $this->getCodigo();
            $blnValor = $this->_objBasedato->ActualizaDatos($strConsulta);

            //eliminamos archivo
            $strConsulta = "";
            $strConsulta .= "DELETE FROM archivos";
            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND arc_codigo=" . $this->getCodigo();
            $blnValor = $this->_objBasedato->ActualizaDatos($strConsulta);

            if (!$blnValor) $this->_objServidor->Error = "Error: Operación no realizada, se han producido errores intentelo pasados unos minutos.";
        }
    
        return $blnValor;
    }

    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private function ObtenerArchivo()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            $this->_Codigo = intval($this->Datos->Valor("arc_codigo"));    
            $this->Nombre = $this->Datos->Valor("arc_nombre");
            $this->Observaciones = $this->Datos->Valor("arc_observaciones");   
            $this->_Tipo = $this->Datos->Valor("arc_tipo");          
           
        }
    }
}

?>