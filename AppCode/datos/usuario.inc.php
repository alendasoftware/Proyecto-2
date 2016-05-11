<?php

// ##############################################################################
// # ARCHIVO:		usuario.inc.php - Versión 1.0
// # DESCRIPCION:	
// ##############################################################################

// *****************************************************************************
// * Clase phpUsuario
// *****************************************************************************

// Público
	
class phpUsuario{
    
    //Propiedades públicas  
    public $Nombre;
    public $Email;                
    public $Clave;
    public $Numero;
    public $Localidad;
    public $Poblacion;
    public $Direccion;
    public $CodigoPostal;
    public $Telefono;
    public $Fax;
    public $Avatar;   
    public $Token;
    public $Notificaciones;
    public $Pais;
    public $AvatarNombre;
    
    //Propiedades privadas  
    private $_Codigo;
    private $_FechaAlta;
    private $_FechaActivo;
    private $_FechaReactivacion;
    private $_FechaBaja;
    private $_TokenFecha;
    private $_Completo;
    private $_CadenaConsulta;

    //Objetos
    private $_objServidor;
    private $_objBasedato;
    private $_objParametros;
    private $_objUrlAmigable;
    private $_objCifrado;
    private $_objCookie;
    
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
       $this->_objCifrado = new phpCifrado();
       $this->_objCookie = new phpCookie();
       $this->Datos = new phpDatos(); 
     
       // Inicia propiedades        
		
	   $this->Inicia();
    } 	
    
    function __destruct() {
		
	   //Hay que destruir los objetos		        
	   unset($this->_objServidor);
       unset($this->_objBasedato);
       unset($this->_objParametros);
       unset($this->_objUrlAmigable);
       unset($this->_objCifrado);
       unset($this->_objCookie);
       unset($this->Datos);
       
    }

    //  *****************************************************************************
    //  * Inicio
    //  *****************************************************************************
    Public function Inicia(){
		
	   
        $this->_Codigo = 0;
       
        $this->Nombre = null;
        $this->Email = null;
        $this->Clave = null;
        $this->Localidad = null;
        $this->Poblacion = null;
        $this->Direccion = null;
        $this->CodigoPostal = null;
        $this->Telefono = null;
        $this->Fax = null;
        $this->Avatar = null;
        $this->Token = null;
        $this->Notificaciones = true;
        $this->Pais = null;
        $this->AvatarNombre = null;
        
        $this->_FechaAlta = new DateTime();
        $this->_FechaActivo = null;
        $this->_FechaReactivacion = null;
        $this->_FechaBaja = null;
       
        $this->_objCookie->Nombre = "user";

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
            $this->Datos->DataTable($this->_objBasedato->AbreConsulta("Select * FROM usuarios WHERE usu_codigo = " . $value));
            $this->Datos->index = 0;
            $this->ObtenerUsuario();
        }
        else
        {
            $this->ObtenerUsuario();
        }
    }

    public function Servidor()
    {
        return $this->_objServidor;
    }

    public function Activo()
    {
        return $this->_FechaActivo != null;
    }

    public function FechaReactivacion()
    {
        return $this->_FechaReactivacion;
    }
    
    public function FechaAlta()
    {
        return $this->_FechaAlta->format('Y-m-d H:i:s');
    }

    public function Estado()
    {
        $strEstado = "";

        if ($this->_FechaBaja!=null) {
            $strEstado = "<span class='label label-important'>Eliminado</span>";
        }else{
            if ($this->_FechaActivo!=null) { 
                $strEstado = "<span class='label label-success'>Active</span>";
            }else{ 
                $strEstado = "<span class='label label-warning'>Pendiente</span>";
            }
        }
        return $strEstado;
    }

    // *****************************************************************************
    // * Métodos Públicos
    // *****************************************************************************
    Public function DevuelveCadena(){
		
	    $strValor = "";
		$strValor .= "Codigo:" . $this->_Codigo . ";";
        $strValor .= "Nombre: " . $this->Nombre . ";";
        $strValor .= "Email: " . $this->Email . ";";
        $strValor .= "Clave: " . $this->Clave . ";";
        $strValor .= "Poblacion: " . $this->Poblacion . ";";
        $strValor .= "Direccion: " . $this->Direccion . ";";
        $strValor .= "CodigoPostal: " . $this->CodigoPostal . ";";
        $strValor .= "Telefono: " . $this->Telefono . ";";
        $strValor .= "Fax: " . $this->Fax . ";";
        $strValor .= "Avatar: " . $this->Avatar . ";";
        $strValor .= "Token: " . $this->Token . ";";
        $strValor .= "Notificaciones: " . $this->Notificaciones . ";";
        $strValor .= "FechaAlta: " . $this->_FechaAlta->format('Y-m-d H:i:s') . ";";
        $strValor .= "FechaActivo: " . $this->_FechaActivo->format('Y-m-d H:i:s') . ";";
        $strValor .= "FechaReactivacion: " . $this->_FechaReactivacion ->format('Y-m-d H:i:s'). ";";
        $strValor .= "FechaBaja: " . $this->_FechaBaja->format('Y-m-d H:i:s') . ";";
        $strValor .= "TokenFecha: " . $this->_TokenFecha->format('Y-m-d H:i:s') . ";";
        $strValor .= "Pais: " . $this->Pais . ";";
        $strValor .= "AvatarNombre: " . $this->AvatarNombre . ";";
        
    	return $strValor;

    } 
	
    public function DibujaPanelFicha()
    {
        $html = "";

        $html .= $this->Nombre;

        return $html;
    }
    
    public Function Lee()
    {
        if ($this->Datos->NumeroElementos() > 0) $this->setCodigo($this->Datos->index);
    }

    public Function Consulta()
    {
        $cadenaConsulta = "Select * FROM usuarios WHERE 1=1";
        $cadenaConsulta .= " ORDER BY usu_fecha_alta";

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public function ConsultaParticipacion($intTop)
    {
        $cadenaConsulta = "Select"; 
        $cadenaConsulta .= " * FROM usuarios WHERE 1=1";
        $cadenaConsulta .= " AND usu_codigo IN (SELECT par_usuario FROM participacion)";
        $cadenaConsulta .= " ORDER BY usu_fecha_alta DESC";
        if ($intTop>0) $cadenaConsulta .= " LIMIT ". $intTop;
        
        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }
    
    public Function ConsultaValida($strEmail, $strClave)
    {
        $cadenaConsulta = "Select * FROM usuarios WHERE 1=1";
        $cadenaConsulta .= " AND usuarios.usu_correo = '" . $strEmail . "'";
        $cadenaConsulta .= " AND usuarios.usu_clave = '" . $strClave . "'";
        $cadenaConsulta .= " AND usu_fecha_activo IS NOT NULL";
        $cadenaConsulta .= " AND usu_fecha_baja IS NULL";

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public Function ConsultaExisteEmail($strEmail, $intCodigo)
    {
        $cadenaConsulta = "Select * FROM usuarios WHERE 1=1";
        if (($strEmail!=null) && ($strEmail!="") ) $cadenaConsulta .= " AND usuarios.usu_correo = '" . $strEmail . "'";
        $cadenaConsulta .= " AND (now() <= usu_fecha_baja + " . vbDiasBajaDefinitiva;
        $cadenaConsulta .= " OR usu_fecha_activo is not null)";
        if ($intCodigo > 0) $cadenaConsulta .= " AND usu_codigo<>" . $intCodigo; 

        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public Function ConsultaRecuperacion($strToken)
    {
        $cadenaConsulta = "Select * FROM usuarios WHERE 1=1";
        if (($strToken != null) && ($strToken != "")) $cadenaConsulta .= " AND usuarios.usu_token = '" . $strToken . "'";
        $cadenaConsulta .= " AND (usu_fecha_activo IS NOT NULL OR usu_fecha_baja IS NOT NULL)";
        
        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public Function ConsultaRecupera($strEmail)
    {
        $cadenaConsulta = "Select * FROM usuarios WHERE 1=1";
        if (($strEmail != null) && ($strEmail != "")) $cadenaConsulta .= " AND usuarios.usu_correo = '" . $strEmail . "'";
        $cadenaConsulta .= " ORDER BY usu_codigo DESC";
        $this->_CadenaConsulta = $cadenaConsulta;
        $this->Datos->DataTable($this->_objBasedato->AbreConsulta($this->_CadenaConsulta));
        $this->_Completo = true;
    }

    public Function Agrega()
    {
        
        $intValor  = 0;
        $objUsuario = new phpUsuario();

        if (($this->Email==null) || ($this->Email == "")) $this->_objServidor->Error = vbMensajeEmailNoExiste;
        if ($this->_objServidor->Error == "")
        {
            if ($this->ExisteEmail($this->Email)) $this->_objServidor->Error = vbMensajeEmailExiste;
        }
        if (($this->_objServidor->Error == "") && (($this->AvatarNombre==null) || ($this->AvatarNombre == ""))) $this->_objServidor->Error =  vbMensajeNombreNoExiste;
        if (($this->_objServidor->Error == "") && (($this->Clave==null) || ($this->Clave == ""))) $this->_objServidor->Error =  vbMensajeClaveNoExiste;

        if ($this->_objServidor->Error== "")
        {
            $this->_objCifrado->Texto = $this->Clave;
            $this->_FechaAlta = new DateTime();

            $strConsulta;
            $strConsulta = "INSERT INTO usuarios (";

            $strConsulta .= " usu_correo";
            $strConsulta .= ", usu_nombre";
            $strConsulta .= ", usu_clave";
            $strConsulta .= ", usu_localidad";
            $strConsulta .= ", usu_poblacion";
            $strConsulta .= ", usu_direccion";
            $strConsulta .= ", usu_codigo_postal";
            $strConsulta .= ", usu_telefono";
            $strConsulta .= ", usu_fax";
            $strConsulta .= ", usu_notificaciones";
            $strConsulta .= ", usu_fecha_alta";
            $strConsulta .= ", usu_pais";
            $strConsulta .= ", usu_avatar_nombre";

            $strConsulta .= ") VALUES (";

            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Email, 0);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Nombre, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->_objCifrado->Md5(), 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Localidad, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Poblacion, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Direccion, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->CodigoPostal, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Telefono, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Fax, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaBooleano($this->Notificaciones, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->_FechaAlta->format('Y-m-d H:i:s'), 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->Pais, 1);
            $strConsulta .= $this->_objBasedato->InsertCadenaTexto($this->AvatarNombre, 1);
           
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
        
        if ($this->getCodigo()==0) $this->_objServidor->Error = vbMmensajeUsuarioNoEncontrado; 
        if (($this->_objServidor->Error == "") && (($this->AvatarNombre==null) || ($this->AvatarNombre == ""))) $this->_objServidor->Error = vbMensajeNombreNoExiste;
        if (($this->_objServidor->Error == "") && (!$this->Activo())) $this->_objServidor->Error = vbMensajeNoActivo;
        
        if ($this->_objServidor->Error=="") {
            
            $strConsulta;
            $strConsulta = "UPDATE usuarios SET ";
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("usu_nombre", $this->Nombre, 0);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("usu_localidad", $this->Localidad, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("usu_poblacion", $this->Poblacion, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("usu_direccion", $this->Direccion, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("usu_codigo_postal", $this->CodigoPostal, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("usu_telefono", $this->Telefono, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("usu_fax", $this->Fax, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaBooleano("usu_notificaciones", $this->Notificaciones, 1);
            if (($this->Avatar!=null)&&($this->Avatar!="")) $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("usu_avatar", $this->Avatar, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("usu_pais", $this->Pais, 1);
            $strConsulta .= $this->_objBasedato->ActualizaCadenaTexto("usu_avatar_nombre", $this->AvatarNombre, 1);

            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND usu_codigo=" . $this->getCodigo();

            $blnValor = $this->_objBasedato->ActualizaDatos($strConsulta);
            if (!$blnValor) $this->_objServidor->Error = "Error: Operación no realizada, se han producido errores intentelo pasados unos minutos.";
        }
    
        return $blnValor;
    }

    public Function Elimina($intCodigo)
    {   
        $blnValor = false;

        $FechaBaja = new DateTime();

        $strConsulta;
        $strConsulta = "UPDATE usuarios SET";
        $strConsulta .= " usu_fecha_baja = '" . $FechaBaja->format('Y-m-d H:i:s') . "'";
        $strConsulta .= " , usu_fecha_activo = null";
        $strConsulta .= " WHERE 1=1";
        $strConsulta .= " AND usu_codigo=" . $intCodigo;

        $blnValor = $this->_objBasedato->ActualizaDatos($strConsulta);

        if ($blnValor)
        {
            $this->Desconecta();           
            $this->ComunicacionEliminaUsuario();
        }
        return $blnValor;
    }

    public Function Activa()
    {
        $blnValor = false;
        
        if ($this->getCodigo() ==0) $this->_objServidor->Error = vbMmensajeUsuarioNoEncontrado;
        
        if ($this->_objServidor->Error=="") {

            $strConsulta;
            $strConsulta = "UPDATE usuarios SET";
            $strConsulta .= " usu_fecha_activo = '" . $this->_FechaAlta->format('Y-m-d H:i:s') . "'";
            $strConsulta .= " , usu_fecha_baja = null";
            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND usu_codigo=" . $this->getCodigo();

            $blnValor = $this->_objBasedato->ActualizaDatos($strConsulta);
        }       

        return $blnValor;
    }

    public Function ModificaClave($strClave)
    {       
        $blnValor = false;

        if ($this->getCodigo() == 0) $this->_objServidor->Error = vbMmensajeUsuarioNoEncontrado;
        if (($this->_objServidor->Error == "") && (($strClave == null) || ($strClave == ""))) $this->_objServidor->Error = vbMensajeClaveNoExiste;

        if ($this->_objServidor->Error=="") {

            $this->_objCifrado->Texto = $strClave;

            $strConsulta;
            $strConsulta = "UPDATE usuarios SET";
            $strConsulta .= " usu_clave = '" . $this->_objCifrado->Md5() . "'";
            $strConsulta .= " , usu_fecha_activo = '" . $this->_FechaAlta->format('Y-m-d H:i:s') . "'";
            $strConsulta .= " , usu_fecha_baja = null";
            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND usu_codigo = " . $this->getCodigo();

            $blnValor = $this->_objBasedato->ActualizaDatos($strConsulta);
        }

        return $blnValor;
    }

    public Function Desactiva()
    {           
        if ($this->getCodigo()==0) $this->_objServidor->Error = vbMmensajeUsuarioNoEncontrado;
        
        $FechaBaja = new DateTime();

        if ($this->_objServidor->Error=="") {

            $strConsulta;
            $strConsulta = "UPDATE usuarios SET";
            $strConsulta .= " usu_fecha_activo = null";
            $strConsulta .= " , usu_fecha_baja = '" . $FechaBaja->format('Y-m-d H:i:s') . "'";
            $strConsulta .= " WHERE 1=1";
            $strConsulta .= " AND usu_codigo=" . $this->getCodigo();

            if ($this->_objBasedato->ActualizaDatos($strConsulta)) {
                $this->Desconecta();
                $this->ComunicacionDesactivaUsuario();
            }
        }
        
    }
    
    public Function Valida($strEmail, $strClave)
    {   
        $intValor = 0;

        $this->_objCifrado->Texto = $strClave;

        $objUsuario = new phpUsuario();
        $objUsuario->ConsultaValida($strEmail, $this->_objCifrado->Md5());

        if ($objUsuario->Datos->NumeroElementos() != 1) $this->_objServidor->Error = vbMmensajeUsuarioNoRegistradoNoActivo;

        if ($this->_objServidor->Error == "")
        {
            $objUsuario->Lee();
            $intValor = $objUsuario->getCodigo();            
        }

        unset($objUsuario);

        return $intValor;
             
    }

    public Function Recupera($strEmail)
    {   
        $blnValor = false;

        $dtmToken = new DateTime();

        if (($strEmail == null) || ($strEmail == "")) $this->_objServidor->Error = vbMensajeEmailNoExiste;

        if ($this->_objServidor->Error=="") {

            $objUsuario = new phpUsuario();
            $objUsuario->ConsultaRecupera($strEmail);

            if ($objUsuario->Datos->NumeroElementos() > 0)
            {
                $objUsuario->Lee();
                $this->setCodigo($objUsuario->getCodigo());

                if ($this->Activo() || ($objUsuario->_FechaBaja!=null)) 
                {
                    //Comprobamos Si dispone de Token
                    if ($this->ExisteToken()) {
                        if ($this->CaducadoToken($dtmToken)) {
                            $this->CambiaToken($dtmToken, $this->getCodigo() . $this->Email . $dtmToken->format('Y-m-d H:i:s'));    
                        }else{
                           $this-> ActualizaToken($dtmToken);
                        }
                    }else{
                        $this->CambiaToken($dtmToken, $this->getCodigo() . $this->Email . $dtmToken->format('Y-m-d H:i:s'));                        
                    } 
                    
                    $strConsulta;
                    $strConsulta = "UPDATE usuarios SET";                    
                    if ($this->Token!=null) {
                        $strConsulta .= " usu_token= '" . $this->Token . "'";
                        $strConsulta .= ", usu_fecha_reactivacion = '" . $this->_TokenFecha->format('Y-m-d H:i:s') . "'";   
                    }
                    $strConsulta .= " WHERE 1=1";
                    $strConsulta .= " AND usu_codigo = " . $this->getCodigo();
                    if ($this->_objBasedato->ActualizaDatos($strConsulta)){
                        $blnValor = true;
                        $this->ComunicacionRecupera();
                    }else{
                        $this->_objServidor->Error = "Se produjo un error al actualizar los datos."; 
                    }
                    
                }else{
                    $this->_objServidor->Error = vbMensajeNoActivo;
                }

            }
            else
            {
                $this->_objServidor->Error = vbMensajeRecuperacionNoEncontrada;
            }   

            unset($objUsuario); 
        }
        
        return $blnValor;
    }

    public Function CompruebaRecuperacion($strToken)
    {   
        if (($strToken == null) || ($strToken == "")) $this->_objServidor->Error = vbMensajeErrorRecuperacionSolicitada;

        if ($this->_objServidor->Error=="") 
        {
            $objUsuario = new phpUsuario();

            $objUsuario->ConsultaRecuperacion($strToken);

            if ($objUsuario->Datos->NumeroElementos() > 0)
            {
                $objUsuario->Lee();
                $objUsuario->setCodigo($objUsuario->getCodigo());

                if ($this->CaducadoToken($objUsuario->FechaReactivacion)) $this->_objServidor->Error = vbMensajeRecuperacionCaducada;                  

            }else{
                $this->_objServidor->Error = vbMensajeErrorRecuperacionSolicitada;
            }   

            unset($objUsuario);         
        }
    }
    
    public Function Conecta()
    {    
        if ($this->getCodigo()==0) $this->_objServidor->Error = vbMmensajeUsuarioNoEncontrado;

        if ($this->_objServidor->Error=="") 
        {
            $this->_objCookie->Valor = $this->getCodigo();
            $this->_objCookie->Agrega();            
        }
    }
    
    public Function Desconecta()
    {
        if ($this->getCodigo() > 0) $this->_objCookie->Valor = $this->getCodigo();
        if ($this->Conectado()) $this->_objCookie->Elimina();
    }

    public Function Conectado()
    {   
        $this->_objServidor->Error="";
                        
        $strValor = $this->_objCookie->Lee();

        return (($strValor != null) && ($strValor != ""));                
    }

    public Function ExisteEmail($strEmail)
    {
        $blnExiste = false;

        $objUsuario = new phpUsuario();

        $objUsuario->ConsultaExisteEmail($strEmail, $this->getCodigo());

        if ($objUsuario->Datos->NumeroElementos() > 0) $blnExiste = true;

        unset($objUsuario);

        return $blnExiste;
    }

    public Function ComunicacionAgergaUsuario($strMemsaje)
    {
        $objComunicacion = new phpComunicacion();
        $objComunicacion->Para = $this->Email;
        $objComunicacion->Cc = $this->_objParametros->CorreoAdmin;
        $objComunicacion->Asunto = vbPageAuthor . " - Alta de cuenta";
        $objComunicacion->Saludo = "Estimado/a: " . utf8_decode($this->AvatarNombre);

        $this->_objCifrado->Texto = $this->Nombre . $this->Email;
 
        $objComunicacion->Cuerpo = "<br/><br/>Para activar su cuenta pulse el siguiente enlace:";
        $objComunicacion->Cuerpo .= "<br/><br/><a style=\"color: #BB750E;text-decoration:none;\" href=\"" . $this->_objParametros->Directorio . "/controlUsuario.php?uS=" . $this->getCodigo() . "&uA=" . $this->_objCifrado->Md5() . "\">Activar cuenta</a>";

        $objComunicacion->Cuerpo .= "<hr/><br/>Datos de registro.<hr/>";
        $objComunicacion->Cuerpo .= "Localidad: " . utf8_decode($this->Localidad) . "<br/>";
        $objComunicacion->Cuerpo .= "Población: " . utf8_decode($this->Poblacion) . "<br/>";
        $objComunicacion->Cuerpo .= "Dirección: " . utf8_decode($this->Direccion) . "<br/>";
        $objComunicacion->Cuerpo .= "Código postal: " . $this->CodigoPostal . "<br/>";
        $objComunicacion->Cuerpo .= "Teléfono: " . $this->Telefono . "<br/>";
        $objComunicacion->Cuerpo .= "Fax: " . $this->Fax . "<br/>";
        $objComunicacion->Cuerpo .= "Notificaciones: " . $this->Notificaciones . "<br/><br/><hr/>";
        $objComunicacion->Cuerpo .= $strMemsaje;
        
        $objComunicacion->EnviaEmail();

        unset($objComunicacion);
    }

    public Function ComunicacionDesactivaUsuario()
    {
        $objComunicacion = new phpComunicacion();
        $objComunicacion->Para = $this->Email;
        $objComunicacion->Cc = $this->_objParametros->CorreoAdmin;
        $objComunicacion->Asunto = vbPageAuthor . " - Baja de la cuenta";
        $objComunicacion->Saludo = "Estimado/a: " . utf8_decode($this->AvatarNombre);

        $objComunicacion->Cuerpo = "<br/><br/>Hemos dado de baja provicional su cuenta, dispone de 30 días para reactivarla si cambia de idea, solo tiene que entrar en nuestra web e iniciar el proceso de recuperación de contraseña, o bien pulse en:";
        $objComunicacion->Cuerpo .= "<br/><br/><a style=\"color: #BB750E;text-decoration:none;\" href=\"" . $this->_objParametros->Directorio . "/recuperar.php\">Recuperar cuenta</a>";

        $objComunicacion->EnviaEmail();

        unset($objComunicacion);
    }

    public Function ComunicacionRecupera()
    {
        $objComunicacion = new phpComunicacion();
        $objComunicacion->Para = $this->Email;
        $objComunicacion->Cc = $this->_objParametros->CorreoAdmin;
        $objComunicacion->Asunto = vbPageAuthor . " - Recuperar contraseña";
        $objComunicacion->Saludo = "Estimado/a: " . utf8_decode($this->AvatarNombre);

        $objComunicacion->Cuerpo = "<br/><br/>Para recuperar su contraseña pulse el siguiente enlace:";
        $objComunicacion->Cuerpo .= "<br/><br/><a style=\"color: #BB750E;text-decoration:none;\" href=\"" . $this->_objParametros->Directorio . "/controlUsuario.php?uS=" . $this->getCodigo() . "&uT=" . $this->Token . "\">Recuperar contraseña</a>";

        $objComunicacion->EnviaEmail();

        unset($objComunicacion);
    }

    public Function ComunicacionEliminaUsuario()
    {
        
    }

    // *****************************************************************************
    // * Métodos Privados
    // *****************************************************************************
    private Function ObtenerUsuario()
    {
        if ($this->Datos->NumeroElementos() > 0)
        {
            
            $this->_Codigo = intval($this->Datos->Valor("usu_codigo"));    
            $this->Nombre = $this->Datos->Valor("usu_nombre");
            $this->Email = $this->Datos->Valor("usu_correo");
            $this->Clave = $this->Datos->Valor("usu_clave");
            $this->Localidad = $this->Datos->Valor("usu_localidad");
            $this->Poblacion = $this->Datos->Valor("usu_poblacion");
            $this->Direccion = $this->Datos->Valor("usu_direccion");
            $this->CodigoPostal = $this->Datos->Valor("usu_codigo_postal");
            $this->Telefono = $this->Datos->Valor("usu_telefono");
            $this->Fax = $this->Datos->Valor("usu_fax");
            $this->Avatar = $this->Datos->Valor("usu_avatar");
            $this->Token = $this->Datos->Valor("usu_token");
            $this->Notificaciones = $this->Datos->Valor("usu_notificaciones");
            $this->Pais = $this->Datos->Valor("usu_pais");
            $this->AvatarNombre = $this->Datos->Valor("usu_avatar_nombre");
           
            $this->_FechaAlta = new DateTime($this->Datos->Valor("usu_fecha_alta"));
            $this->_FechaActivo = null;
            if (($this->Datos->Valor("usu_fecha_activo")!=null)  && ($this->Datos->Valor("usu_fecha_activo")!="")) $this->_FechaActivo = new DateTime($this->Datos->Valor("usu_fecha_activo"));
            $this->_FechaReactivacion = null;
            if (($this->Datos->Valor("usu_fecha_reactivacion")!=null)  && ($this->Datos->Valor("usu_fecha_reactivacion")!="")) $this->_FechaReactivacion = new DateTime($this->Datos->Valor("usu_fecha_reactivacion"));
            $this->_FechaBaja = null;
            if (($this->Datos->Valor("usu_fecha_baja")!=null)  && ($this->Datos->Valor("usu_fecha_baja")!="")) $this->_FechaBaja = new DateTime($this->Datos->Valor("usu_fecha_baja"));
            $this->_TokenFecha = new DateTime($this->Datos->Valor("usu_token_fecha"));            
        }
    }
    
    private Function CambiaToken($dateToken, $strToken)
    {
        
        $this->_objCifrado->Texto = $strToken;
        $this->_TokenFecha = $dateToken;
        $this->Token = $this->_objCifrado->Md5();
    }

    private Function ActualizaToken($dateToken)
    {
        $this->_TokenFecha = $dateToken;
    }

    private Function ExisteToken()
    {
        return ($this->Token != "");
    }

    private Function CaducadoToken($dateToken)
    {
        $fechaActual = new DateTime();
        return  $fechaActual->diff($dateToken)->h;
    }
}

?>