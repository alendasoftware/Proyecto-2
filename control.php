<?Php

//Inclución de librerías
require ('AppCode/principal.inc.php');

$objComunicacion = new phpComunicacion();
        
header('Content-type: application/json');

$Accion = "";
if (isset($_GET['Accion'])) $Accion = $_GET['Accion'];   

$Recaptcha = "";
if (isset($_POST['g-recaptcha-response'])) $Recaptcha = $_POST['g-recaptcha-response'];   

if ((($Recaptcha == null) || ($Recaptcha == "")) && ($Accion != "comment-form")) $Accion = "error-captcha";

switch ($Accion)
{
    case "error-captcha":
        echo "{\"error\":\"" . $objTraductor->Traducir("ERRORreCAPTCHA") . "\"}";
        break;

    case "contact-form":
        $objComunicacion->Para = $objParametros->CorreoAdmin;
        $objComunicacion->Asunto = $_POST['subject'];
        $objComunicacion->Cc = $_POST["email"];
        $objComunicacion->Idioma = $objTraductor->getIdioma();

        $objComunicacion->Cuerpo = $objTraductor->Traducir("Nombre") . ": " . $_POST["name"] . "<br/>";
        $objComunicacion->Cuerpo .= "Email: " . $_POST["email"] . "<br/>";
        $objComunicacion->Cuerpo .= $objTraductor->Traducir("Telefono") . ": " . $_POST["telefono"] . "<br/>";
        $objComunicacion->Cuerpo .= "<br/>" . $_POST["message"];
        
        $objComunicacion->EnviaEmail();

        if (!$objComunicacion->Debug)
        {
            if ($objComunicacion->Error == "")
            {
                echo "{\"message\":\"" . $objTraductor->Traducir("MensajeCorrecto") . "\"}";
            }
            else
            {
                echo ("{\"error\":\"" . $objComunicacion->Error . "\"}");
            }
        }
        else
        {
            echo ($objComunicacion->Html);
        }
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
                DibujaSuccess("Opinión registrada satisfactoriamente");       
            }else{
                DibujaError($objParticipacion->Servidor()->Error);     
            }

        }else{    
            DibujaError("Usuario no conectado, para poder dar su opinión debe estar logeado.");            
        }
        break;                  
}

Function DibujaSuccess($strSuccess){
    echo "{\"message\":\"" . utf8_encode($strSuccess) . "\"}";  
}

Function DibujaError($strError){
    echo ("{\"error\":\"" . utf8_encode($strError) . "\"}");    
}

// Releases the resources of the response.  
exit();
?>