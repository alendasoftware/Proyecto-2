<?Php
//Inclución de librerías
require ('AppCode/principal.inc.php');

/////////////////////////////////////////////////////////////////

$intCodigo = 0;
$strError = "";
$strSession = session_id();

$strUa = "";
$strUt = "";
$strUs = "";

if (isset($_GET['uA'])) $strUa = $_GET["uA"];
if (isset($_GET['uT'])) $strUt = $_GET["uT"];
if (isset($_GET['uS'])) $strUs = $_GET["uS"];

if ($strUs==$strSession) {
    switch ($strUa)
    {
        case "inserta":
            $objUsuario->Email = $_POST["email"];
            $objUsuario->Nombre = RecogeParametro("name");
            $objUsuario->AvatarNombre = RecogeParametro("nameavatar");
            $objUsuario->Pais = RecogeParametro("country");
            $objUsuario->Localidad = RecogeParametro("city");
            $objUsuario->Poblacion = RecogeParametro("poblation");
            $objUsuario->Direccion = RecogeParametro("direction");
            $objUsuario->CodigoPostal = RecogeParametro("postal");
            $objUsuario->Telefono = RecogeParametro("telephone");
            $objUsuario->Fax = RecogeParametro("fax");
            $objUsuario->Notificaciones = ($_POST["legal"]=="Sí");

            if (ValidarRecaptcha($objServidor))
            {

                if (($_POST["password"] != "") && ($_POST["password"] == $_POST["passwordRepeat"]))
                {
                    $objUsuario->Clave = $_POST["password"];
                    if ($objUsuario->Agrega() > 0)
                    {
                        $objUsuario->ComunicacionAgergaUsuario($_POST["message"]);
                        ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Su alta se ha registrado de forma satisfactoria. Hemos enviado un correo para confirmar el alta. Siga las instrucciones del correo para acceder a la zona de usuarios.");
                        Redirect($objParametros->Directorio . "/index.php");                           
                    }
                    else
                    {
                        ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", $objUsuario->Servidor()->Error);
                        Redirect($objParametros->Directorio . "/registro.php");                       
                    }
                }
                else
                {
                    ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "La clave y su repetición no coinciden");
                    Redirect($objParametros->Directorio . "/registro.php");                       
                }
            }
            else
            {
                ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "ERROR: reCAPTCHA");
                Redirect($objParametros->Directorio . "/registro.php");                       
            }
            break;

        case "modifica":
            
            if ($objUsuario->Conectado()){
                 if (ValidarRecaptcha($objServidor))
                 {

                    $objUsuario->setCodigo($objCookieUsuario->Lee());

                    $objUsuario->Nombre = RecogeParametro("usu_nombre");
                    $objUsuario->AvatarNombre = RecogeParametro("usu_avatar_nombre");
                    $objUsuario->Pais = RecogeParametro("usu_pais");
                    $objUsuario->Localidad = RecogeParametro("usu_localidad");
                    $objUsuario->Poblacion = RecogeParametro("usu_poblacion");
                    $objUsuario->Direccion = RecogeParametro("usu_direccion");
                    $objUsuario->CodigoPostal = RecogeParametro("usu_codigo_postal");
                    $objUsuario->Telefono = RecogeParametro("usu_telefono");
                    $objUsuario->Fax = RecogeParametro("usu_fax");
                    
                    //file-upload
                    $target_path = "subidas/usuarios/";
                    $handle = new Upload($_FILES['uploadedfile']);
                    if ($handle->uploaded) {
                        $handle->image_resize = true;
                        $handle->image_ratio_crop = true;
                        $handle->image_y = 200;
                        $handle->image_x = 200;
                        $handle->file_name_body_pre = $objUsuario->getCodigo() . "_";

                        $handle->Process($target_path);
                        if ($handle->processed) {    
                            $objUsuario->Avatar = $handle->file_dst_name;
                        }      

                        $handle-> Clean();  
                    }    
                    
                    //$target_path = "subidas/usuarios/";
                    //$target_path .= $objUsuario->getCodigo() . "_" . basename( $_FILES['uploadedfile']['name']); 
                    //if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) { 
                        //$objUsuario->Avatar =  $objUsuario->getCodigo() . "_" . basename( $_FILES['uploadedfile']['name']);
                    //} 

                    if (($_POST["usu_clave"] != "") && ($_POST["usu_clave"] == $_POST["usu_clave_repetir"])) $objUsuario->ModificaClave($_POST["usu_clave"]);

                    if ($objUsuario->Modifica())
                    {
                        ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Su cuenta ha sido modificada correctamente.");
                    }
                    else
                    {
                        ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", $objUsuario->Servidor()->Error);
                    }                     
                 }
                 else {
                     ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "ERROR: reCAPTCHA");
                 }
                 Redirect($objParametros->Directorio . "/usuario.php");                                          
            }else{
                ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "No existe ningún usuario en sesión.");
                Redirect($objParametros->Directorio . "/index.php");            
            }
            break;

        case "modificaPassword":
            if ($_POST["usu_relogin_us"]!="") {
                if (ValidarRecaptcha($objServidor))
                {
                    if (($_POST["usu_clave"] != null) && ($_POST["usu_clave"] != ""))
                    {

                        $objUsuario->setCodigo($_POST["usu_relogin_us"]);

                        $objUsuario->ModificaClave($_POST["usu_clave"]);
                        ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Su contraseña ha sido modificada correctamente.");
                        $objUsuario->Conecta();

                        Redirect($objParametros->Directorio . "/usuario.php"); 
                    }
                    else
                    {
                        if ($_POST["usu_clave"] == "")
                        {
                            ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "Por favor, cambie su contraseña para poder utilizar la plataforma.");
                        }
                        else
                        {
                            ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "ERROR: La contraseña y su repetición no coinciden.");
                        }
                        Redirect($objParametros->Directorio . "/relogin.php?relogin-us=" . $strUs); 

                    }
                }
                else
                {
                    ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "ERROR: reCAPTCHA");
                    Redirect($objParametros->Directorio . "/relogin.php?relogin-us=" . $strUs); 
                }
            }else{
                ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "No existe ningún usuario en sesión.");
                Redirect($objParametros->Directorio . "/index.php");  
            }
            break;       
        
        case "eliminaAvatar":
            break;

        case "comment-form":

            if ($objUsuario->Conectado()){
                $objUsuario->setCodigo($objCookieUsuario->Lee());
                $objParticipacion->Opinion = $objFormulario->RecogeParametro("message");    
                $objParticipacion->setUsuario($objUsuario->getCodigo());
                $objParticipacion->setBuque($objFormulario->RecogeParametro("buque"));
                if ($objParticipacion->Agrega() > 0){                
                    //file-upload
                    $target_path = "subidas/usuarios/";
                    
                    for ($i = 1; $i <= 3; $i++) {
                        
                        if ($i>1) {
                            $handle = new Upload($_FILES['uploadedfile' . $i]);
                        }else{
                            $handle = new Upload($_FILES['uploadedfile']);
                        }

                        if ($handle->uploaded) {
                            $handle->image_resize = true;
                            $handle->image_ratio_crop = true;
                            $handle->image_x                 = 200;
                            $handle->image_y                 = 150;
                            $handle->file_name_body_pre = $objParticipacion->getCodigo() . "_";
                            $handle->file_name_body_add = "_p";

                            $handle->Process($target_path);
                            if ($handle->processed) {    
                                
                                $handle->image_resize = true;
                                $handle->image_ratio_crop = true;
                                $handle->image_x                 = 1024;
                                $handle->image_y                 = 768;
                                $handle->file_name_body_pre = $objParticipacion->getCodigo() . "_";                        
                                $handle->Process($target_path);

                                $objArchivo = new phpArchivo();
                                $objParticipacionArchivos = new phpParticipacionArchivos();
                                
                                $objArchivo->Nombre = $handle->file_dst_name;
                                $objArchivo->Grupo = vbGrupoImagenParticipacion;
                                $objArchivo->setTipo(vbArchivoTipoImagen);
                                $intArchivo = $objArchivo->Agrega();
                                if ( $intArchivo > 0){                            
                                    $objParticipacionArchivos->setParticipacion($objParticipacion->getCodigo());
                                    $objParticipacionArchivos->setArchivo($intArchivo);
                                    $objParticipacionArchivos->Agrega();                           
                                }
                                
                                unset($objArchivo);
                                unset($objParticipacionArchivos);
                            }      

                            $handle-> Clean();  
                        } 
                    }    

                    $objPregunta = new phpPregunta();
                    $objParticipacionPreguntas = new phpParticipacionPreguntas();

                    $objPregunta->Consulta();
                    if ($objPregunta->Datos->NumeroElementos() > 0)
                    {
                        while (!$objPregunta->Datos->Eof())
                        {
                            $objPregunta->Lee();
                            $objParticipacionPreguntas->setParticipacion($objParticipacion->getCodigo());
                            $objParticipacionPreguntas->setPregunta($objPregunta->getCodigo());
                            $objParticipacionPreguntas->Puntuacion = $objFormulario->RecogeParametro("pregunta_" . $objPregunta->getCodigo());
                            $objParticipacionPreguntas->Agrega();                          
                            $objPregunta->ReiniciaObjetos();
                            $objPregunta->Datos->Siguiente();
                        }
                    }
                    unset($objPregunta); 
                    unset($objParticipacionPreguntas);  
                    ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Opinión registrada satisfactoriamente");                    
                }else{
                    ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", $objParticipacion->Servidor()->Error);  
                }
                $objBuque = new phpBuque();
                $objBuque->setCodigo($objFormulario->RecogeParametro("buque"));
                Redirect($objBuque->UrlOpiniones());    
                unset($objBuque); 
            }else{    
                ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "Usuario no conectado, para poder dar su opinión debe estar logeado.");  
                Redirect($objParametros->Directorio . "/index.php");   
            }
            break;   

        case "eliminaParticipacion":
            
           if ($objUsuario->Conectado()){
                $objUsuario->setCodigo($objCookieUsuario->Lee());
                $objParticipacion = new phpParticipacion();
                $objParticipacion->setCodigo(RecogeParametro("par_codigo"));
                if ($objParticipacion->Elimina()){
                    ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Su participación ha sido eliminada correctamente.");
                }
                else
                {
                    ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", $objParticipacion->Servidor()->Error);
                } 
                Redirect($objParametros->Directorio . "/opiniones.php?cod=12&id=" . $objUsuario->getCodigo() . "&nom=Opinar"); 
            }else{
                ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "No existe ningún usuario en sesión.");
                Redirect($objParametros->Directorio . "/index.php");            
            }
            break;

        case "valida": case "validaHome":
            $_SESSION["usu_email"] = $_POST["usu_email"];
            $_SESSION["usu_clave"] = $_POST["usu_clave"];

            $bolContinuar = ($strUa == "validaHome");
            if ($strUa == "valida") $bolContinuar = (ValidarRecaptcha($objServidor));

            if ($bolContinuar)
            {
                $intCodigo = $objUsuario->Valida($_POST["usu_email"], $_POST["usu_clave"]);

                if ($intCodigo > 0)
                {
                    
                    $objUsuario->setCodigo($intCodigo);
                    $objUsuario->Conecta();

                    //ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Usuario registrado satisfactoriamente.");
                    //Redirect($objParametros->Directorio . "/usuario.php");      
                    if (strrpos($_SERVER['HTTP_REFERER'], "login.php")>0){
                        Redirect($objParametros->Directorio . "/index.php");      
                    }else{
                        Redirect($_SERVER['HTTP_REFERER']);      
                    }
                    unset($_SESSION["usu_email"]);
                    unset($_SESSION["usu_clave"]);
                }
                else
                {
                    ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "Usuario no válido. Hay problemas con la cuenta que ha solicitado.<br/>Revise el correo electrónico y/o la clave.");
                    Redirect($objParametros->Directorio . "/login.php");                       
                }
            }
            else
            {
                ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "ERROR: reCAPTCHA");
                Redirect($objParametros->Directorio . "/login.php");   
            }            
            break;        

        case "elimina":
            if ($objUsuario->Conectado()){
                $objUsuario->setCodigo($objCookieUsuario->Lee());
                $objUsuario->Desactiva();
                ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Su cuenta se ha eliminado correctamente.");                        
            }else{
                ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "No existe ningún usuario en sesión.");                        
            }
            Redirect($objParametros->Directorio . "/index.php"); 
            break;     

        case "desconecta":
            
            if ($objUsuario->Conectado()) $objUsuario->Desconecta();
            
            ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Usuario desconectado satisfactoriamente.");
            Redirect($objParametros->Directorio . "/index.php");  

            break;

        case "recupera":                    
            if (ValidarRecaptcha($objServidor))
            {
                $_SESSION["usu_email"] = $_POST["usu_email"];

                if ($objUsuario->Recupera($_POST["usu_email"]))
                {
                    $_SESSION["usu_email"] = "";
                    ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Le hemos mandado un correo electrónico con instrucciones para recuperar su contraseña. Síguelas para entrar de nuevo.");
                    Redirect($objParametros->Directorio . "/index.php"); 
                }else{
                    ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "Su cuenta no ha sido recuperada satisfactoriamente. Hay problemas con el correo electrónico que ha enviado, la cuenta no existe o no ha sido activada.");
                    Redirect($objParametros->Directorio . "/recuperar.php");         
                }
            }
            else
            {
                ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "ERROR: reCAPTCHA");
                Redirect($objParametros->Directorio . "/recuperar.php");  
            }
            break;
    }
}else{
    //activación
    if (($strUa != null) && ($strUa != "") && ($strUs != ""))
    {
        $objUsuarioActivacion = new phpUsuario();
        $objUsuarioActivacion->setCodigo($strUs);

        $objCifrado->Texto = $objUsuarioActivacion->Nombre . $objUsuarioActivacion->Email;

        if ($objCifrado->Md5() == $strUa) {
            $objUsuarioActivacion->Activa();               
            ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Su cuenta ha sido activada satisfactoriamente. Si lo desea ya puede acceder al sistema.");                    
        }else{                
            ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", "Su cuenta no ha sido activada satisfactoriamente. Hay problemas con la activación que ha solicitado, la cuenta no existe.");
        }
        Redirect($objParametros->Directorio . "/index.php");        
    }
    else
    {                
        $objUsuario->CompruebaRecuperacion($strUt);

        if ($objUsuario->Servidor->Error == "") {
            ponMensaje($objCookieSistema, $objCookieSistemaTexto, "1", "Ahora, cambie su clave en el siguiente formulario y pulse en guardar cambios.");
            Redirect($objParametros->Directorio . "/relogin.php?relogin-us=" . $strUs);           
        }else{
            ponMensaje($objCookieSistema, $objCookieSistemaTexto, "0", $objUsuario->Servidor->Error);
            Redirect($objParametros->Directorio . "/index.php");   
        }                
    }  
}

Function ponMensaje($objCookieSistema, $objCookieSistemaTexto, $strTipo, $strTexto)
{
    $objCookieSistema->Valor = $strTipo;
    $objCookieSistema->Agrega();
    
    $objCookieSistemaTexto->Valor = utf8_encode($strTexto);
    $objCookieSistemaTexto->Agrega();                        
}

// Releases the resources of the response.  
Function Redirect($url)
{
    header('Location: ' . $url);

    exit();
}

Function ValidarRecaptcha($objServidor)
{
    if ($objServidor->Entorno() == vbServidorEntornoDesarrollo){
        return true;
    }else{
       return (($_POST["g-recaptcha-response"] != null) && ($_POST["g-recaptcha-response"] != ""));
    }
}

Function RecogeParametro($strParametro)
{
    $strValor = null;

    if (isset($_POST[$strParametro])) $strValor = $_POST[$strParametro];

    return $strValor;
}
?>