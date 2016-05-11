<?php
require ('general/constantes.inc.php');

require ('general/servidor.inc.php');
require ('general/parametros.inc.php');
require ('general/urlAmigable.inc.php');
require ('general/traductor.inc.php');
require ('general/basedato.inc.php');
require ('general/datos.inc.php');

require ('general/cifrado.inc.php');
require ('general/email.inc.php');
require ('general/cookie.inc.php');
require ('general/comunicacion.inc.php');
require ('general/htmlReader.inc.php');
require ('general/formulario.inc.php');
require ('general/elementoFormulario.inc.php');
require ('general/upload.php');

require ('general/sections.inc.php');

// LIBRERIAS DE DATOS
include('datos/menu.inc.php');
include('datos/banner.inc.php');
include('datos/archivo_tipo.inc.php');
include('datos/archivo.inc.php');
include('datos/empresa.inc.php');
include('datos/buque.inc.php');
include('datos/cubierta.inc.php');
include('datos/faq.inc.php');
include('datos/usuario.inc.php');
include('datos/participacion.inc.php');
include('datos/pregunta.inc.php');
include('datos/participacion_preguntas.inc.php');
include('datos/participacion_archivos.inc.php');

//session_id();
//session_name(vbServidorTest);
session_start();

//Creación del objeto servidor
$objServidor = new phpServidor();
//if ($objServidor->ControlURL) $objServidor->ChequeaURL;

//Creación del objeto parametros
$objParametros = new phpParametros();

//Creación del objeto basedato
$objBasedato = new phpBasedato();
$objBasedato->Conexion();

//Creación del objeto traductor
$objTraductor = new phpTraductor();

//Creación del objeto urlAmigable
$objUrlAmigable = new phpUrlAmigable();

//Creación del objeto formulario
$objFormulario = new phpFormulario();

//Creación del objeto menu
$objMenu = new phpMenu();
$objMenu->Actual = $objUrlAmigable->Cod();
if ($objMenu->Actual==0) $objMenu->Actual = $objMenu->PaginaInicio;
$objMenu->setCodigo($objMenu->Actual);

//Creación del objeto sections
$objSections = new phpSections();

//Creación el usuario
$objUsuario = new phpUsuario();

//Creación del cifrado
$objCifrado = new phpCifrado();

//Creación el usuario
$objParticipacion = new phpParticipacion();

include ('plantilla/section_cookie.inc');
include ('plantilla/mensajeSistema.inc');
?>